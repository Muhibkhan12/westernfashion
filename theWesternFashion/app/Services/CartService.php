<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

class CartService
{
    const KEY                 = 'cart';
    const MAX_QTY             = 10;
    const FREE_SHIPPING_OVER  = 150.00; // matches your product page copy
    const FLAT_SHIPPING       = 10.00;  // placeholder
    const TAX_RATE            = 0.0;    // placeholder

    /** @return array<int,int> variant_id => qty */
    public function raw(): array
    {
        return session(self::KEY, []);
    }

    public function count(): int
    {
        return (int) array_sum($this->raw());
    }

    public function clear(): void
    {
        session()->forget(self::KEY);
    }

    public function add(string $variantId, int $qty): void
    {
        $this->set($variantId, ($this->raw()[$variantId] ?? 0) + $qty);
    }

    public function set(string $variantId, int $qty): void
    {
        if ($qty <= 0) {
            $this->remove($variantId);
            return;
        }

        $variant = ProductVariant::with('product')->find($variantId);

        if (! $variant || ! $variant->product || ! $this->isActive($variant->product)) {
            throw ValidationException::withMessages(['variant_id' => 'This item is not available.']);
        }

        $qty = min($qty, self::MAX_QTY);

        if ($qty > (int) $variant->stock) {
            throw ValidationException::withMessages([
                'qty' => $variant->stock > 0 ? "Only {$variant->stock} left in stock." : 'Sold out in this size.',
            ]);
        }

        $cart = $this->raw();
        $cart[$variantId] = $qty;
        session([self::KEY => $cart]);
    }

    public function remove(string $variantId): void
    {
        $cart = $this->raw();
        unset($cart[$variantId]);
        session([self::KEY => $cart]);
    }

    /** Cart lines with fresh prices/stock from the DB. */
    public function lines(): Collection
    {
        $cart = $this->raw();
        if (! $cart) return collect();

        $variants = ProductVariant::with(['product.images'])
            ->whereIn('id', array_keys($cart))
            ->get()
            ->keyBy('id');

        return collect($cart)->map(function ($qty, $id) use ($variants) {
            $v = $variants->get($id);
            $p = $v?->product;
            if (! $v || ! $p || ! $this->isActive($p)) return null;

            $image = $p->images->sortBy(fn ($i) => $i->is_primary ? 0 : 1)->first();
            $unit  = $this->unitPrice($p);

            return [
                'variant_id' => $v->id,
                'product_id' => $p->id,
                'name'       => $p->name,
                'sku'        => $v->sku,
                'size'       => $v->size,
                'color'      => $v->color,
                'image'      => $image ? asset('storage/' . $image->image_path) : null,
                'unit_price' => $unit,
                'old_price'  => $p->sale_price !== null ? (float) $p->price : null,
                'qty'        => (int) $qty,
                'stock'      => (int) $v->stock,
                'line_total' => round($unit * $qty, 2),
                'ok'         => $v->stock >= $qty && $v->stock > 0,
            ];
        })->filter()->values();
    }

        public function totals(float $subtotal): array
    {
        $subtotal = round($subtotal, 2);
        $shipping = ($subtotal <= 0 || $subtotal >= self::FREE_SHIPPING_OVER) ? 0.0 : self::FLAT_SHIPPING;
        $discount = 0.0; // promo logic goes here later

        return [
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'discount' => $discount,
            'total'    => round($subtotal + $shipping - $discount, 2),
        ];
    }

    public function unitPrice(Product $p): float
    {
        return (float) ($p->sale_price !== null ? $p->sale_price : $p->price);
    }

    // Your ShopController checks status as 1 in index() and 'active' in show(); accept both.
    public function isActive(Product $p): bool
    {
        return in_array((string) $p->status, ['1', 'active'], true);
    }
}
