<?php

namespace App\Services;

use App\Models\Order;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class OrderService
{
    const UNPAID_EXPIRY_MINUTES = 30;

    public function __construct(private CartService $cart) {}

    /** Turns the session cart into a pending order and reserves stock. */
    public function createFromCart(User $user, array $data): Order
    {
        return DB::transaction(function () use ($user, $data) {
            $cart = $this->cart->raw();

            if (! $cart) {
                throw ValidationException::withMessages(['cart' => 'Your cart is empty.']);
            }

            // Lock the variant rows so two checkouts can't take the same last item
            $variants = ProductVariant::with(['product.images'])
                ->whereIn('id', array_keys($cart))
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            $items    = [];
            $subtotal = 0.0;

            foreach ($cart as $variantId => $qty) {
                $v = $variants->get($variantId);
                $p = $v?->product;

                if (! $v || ! $p || ! $this->cart->isActive($p)) {
                    throw ValidationException::withMessages(['cart' => 'One of the items in your cart is no longer available.']);
                }
                if ($v->stock < $qty) {
                    throw ValidationException::withMessages([
                        'cart' => $v->stock > 0
                            ? "Only {$v->stock} left of {$p->name} ({$v->size})."
                            : "{$p->name} ({$v->size}) just sold out.",
                    ]);
                }

                $unit  = $this->cart->unitPrice($p);
                $line  = round($unit * $qty, 2);
                $image = $p->images->sortBy(fn ($i) => $i->is_primary ? 0 : 1)->first();

                $items[] = [
                    'product_id'   => $p->id,
                    'variant_id'   => $v->id,
                    'product_name' => $p->name,
                    'sku'          => $v->sku,
                    'size'         => $v->size,
                    'color'        => $v->color,
                    'image_path'   => $image?->image_path,
                    'unit_price'   => $unit,
                    'quantity'     => $qty,
                    'subtotal'     => $line,
                ];

                $subtotal += $line;
                $v->decrement('stock', $qty); // reserve
            }

            $t = $this->cart->totals($subtotal);

            $order = Order::create([
                'order_number'   => $this->makeNumber(),
                'user_id'        => $user->id,
                'status'         => 'PENDING',
                'payment_status' => 'PENDING',
                'payment_method' => 'ONLINE',
                'subtotal'       => $t['subtotal'],
                'shipping'       => $t['shipping'],
                'discount'       => $t['discount'],
                'total'          => $t['total'],
            ] + $data);

            $order->items()->createMany($items);

            return $order;
        });
    }

    /** Called by the payment webhook later. Safe to call twice. */
    public function markPaid(Order $order, string $reference, string $method = 'gateway'): void
    {
        DB::transaction(function () use ($order, $reference, $method) {
            $order = Order::whereKey($order->id)->lockForUpdate()->first();

            if ($order->payment_status === 'PAID') return;

            $order->update([
                'payment_status'    => 'PAID',
                'status'            => 'CONFIRMED',
                'payment_method'    => $method,
                'payment_reference' => $reference,
                'paid_at'           => now(),
            ]);
        });
    }

    /** Cancels an unpaid order and gives the reserved stock back. */
    public function cancel(Order $order): bool
    {
        return DB::transaction(function () use ($order) {
            $order = Order::with('items')->whereKey($order->id)->lockForUpdate()->first();

            if (! $order->isCancellable()) return false;

            foreach ($order->items as $item) {
                if ($item->variant_id) {
                    ProductVariant::whereKey($item->variant_id)->increment('stock', $item->quantity);
                }
            }

            $order->update(['status' => 'CANCELLED', 'cancelled_at' => now()]);
            return true;
        });
    }

    /** Cancels unpaid orders older than the expiry window. Returns how many were cancelled. */
    public function expireStale(): int
    {
        $n = 0;

        Order::where('status', 'PENDING')
            ->where('payment_status', 'PENDING')
            ->where('created_at', '<', now()->subMinutes(self::UNPAID_EXPIRY_MINUTES))
            ->each(function (Order $o) use (&$n) {
                $n += $this->cancel($o) ? 1 : 0;
            });

        return $n;
    }

    private function makeNumber(): string
    {
        do {
            $n = 'TWF-' . strtoupper(Str::random(8));
        } while (Order::where('order_number', $n)->exists());

        return $n;
    }
}
