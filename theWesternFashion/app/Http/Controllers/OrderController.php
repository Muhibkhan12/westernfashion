<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ProductVariant;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function __construct(private OrderService $orders) {}

    /* ---------------- USER SIDE ---------------- */

    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->latest()->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $this->own($order);
        $order->load('items');

        return view('orders.show', compact('order'));
    }

    public function cancel(Order $order)
    {
        $this->own($order);

        return $this->orders->cancel($order)
            ? redirect()->route('orders.show', $order)->with('success', 'Order cancelled.')
            : back()->with('error', 'This order can no longer be cancelled.');
    }

    private function own(Order $order): void
    {
        abort_unless((string) $order->user_id === (string) auth()->id(), 404);
    }

    /* ---------------- ADMIN SIDE ---------------- */

    private const STATUSES = ['PENDING', 'CONFIRMED', 'PROCESSING', 'SHIPPED', 'DELIVERED', 'CANCELLED'];

    private const PAYMENT_LABELS = [
        'PENDING'  => 'Unpaid',
        'PAID'     => 'Paid',
        'FAILED'   => 'Failed',
        'REFUNDED' => 'Refunded',
    ];

    public function adminIndex()
    {
        $orders = Order::with('items')->latest()->get()->map(function ($o) {
            $items = $o->items->map(fn ($it) => [
                'title'   => $it->product_name ?: 'Item',
                'variant' => collect([$it->size, $it->color])->filter()->implode(' · '),
                'price'   => (float) $it->unit_price,
                'qty'     => (int) $it->quantity,
            ])->values()->all();

            $address = collect([
                $o->shipping_address,
                collect([$o->shipping_city, $o->shipping_state, $o->shipping_postal])->filter()->implode(', '),
                $o->shipping_country,
            ])->filter()->implode("\n");

            return [
                'key'      => (string) $o->id,
                'id'       => $o->order_number,
                'customer' => $o->customer_name ?: 'Guest',
                'email'    => strtolower((string) $o->customer_email),
                'phone'    => $o->customer_phone ?: '—',
                'address'  => $address ?: '—',
                'date'     => $o->created_at->toIso8601String(),
                'items'    => $items,
                'subtotal' => (float) $o->subtotal,
                'shipping' => (float) $o->shipping,
                'discount' => (float) $o->discount,
                'total'    => (float) $o->total,
                'status'   => ucfirst(strtolower((string) $o->status)),
                'payment'  => self::PAYMENT_LABELS[$o->payment_status] ?? 'Unpaid',
                'method'   => $o->payment_method ?: '—',
            ];
        })->values()->all();

        return view('Admin.orders', compact('orders'));
    }

public function adminUpdateStatus(Request $request, string $id)
{
    $order = Order::findOrFail($id);

    $request->merge(['status' => strtoupper((string) $request->input('status'))]);
    $data   = $request->validate(['status' => 'required|in:' . implode(',', self::STATUSES)]);
    $status = $data['status'];
    $now    = strtoupper((string) $order->status);

        if ($now === $status) {
            return response()->json(['status' => ucfirst(strtolower($status))]);
        }
        if ($now === 'CANCELLED') {
            return response()->json(['message' => 'Cancelled orders can\'t be changed.'], 422);
        }

        try {
            if ($status === 'CANCELLED') {
                if (! $this->adminCancel($order)) {
                    return response()->json(['message' => 'Delivered orders can\'t be cancelled.'], 422);
                }
            } else {
                $order->update(['status' => $status]);
            }
        } catch (\Throwable $e) {
            report($e);
            return response()->json(['message' => 'Server error: ' . Str::limit($e->getMessage(), 160)], 500);
        }

        return response()->json(['status' => ucfirst(strtolower($status))]);
    }

    /** Admin cancel: works at any stage before delivery and gives reserved stock back. */
    private function adminCancel(Order $order): bool
    {
        return DB::transaction(function () use ($order) {
            $o = Order::with('items')->whereKey($order->id)->lockForUpdate()->first();

            if (in_array($o->status, ['DELIVERED', 'CANCELLED'], true)) {
                return false;
            }

            foreach ($o->items as $item) {
                if ($item->variant_id) {
                    ProductVariant::whereKey($item->variant_id)->increment('stock', $item->quantity);
                }
            }

            $o->update(['status' => 'CANCELLED', 'cancelled_at' => now()]);
            return true;
        });
    }
}