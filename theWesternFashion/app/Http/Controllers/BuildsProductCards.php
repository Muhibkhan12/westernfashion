<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;

/**
 * Turns a Product (with category, images, variants loaded) into the small array the
 * storefront cards need. Same rules as ShopController: sale price, sold-out, colors.
 */
trait BuildsProductCards
{
    protected function card(Product $p, ?string $defaultBadge = null): array
    {
        $hasSale = $p->sale_price !== null;
        $stock   = (int) $p->variants->sum('stock');

        $image = $p->images->sortBy(fn ($img) => $img->is_primary ? 0 : 1)->first();

        $colors = $p->variants->pluck('color')->filter()
            ->map(fn ($c) => Str::title(trim($c)))->unique()
            ->map(fn ($c) => ['name' => $c, 'hex' => $this->colorHex($c)])
            ->values();

        $badge = match (true) {
            $stock <= 0 => 'Sold out',
            $hasSale    => 'Sale',
            default     => $defaultBadge ?? ($p->featured ? 'Featured' : null),
        };

        return [
            'id'       => $p->id,
            'url'      => route('shop.show', $p->id),
            'name'     => $p->name,
            'category' => $p->category->name ?? 'The Western Fashion',
            'cat'      => $p->category->slug ?? $p->category_id,
            'price'    => (float) ($hasSale ? $p->sale_price : $p->price),
            'oldPrice' => $hasSale ? (float) $p->price : null,
            'badge'    => $badge,
            'img'      => $image ? asset('storage/' . $image->image_path) : null,
            'colors'   => $colors,
        ];
    }

    protected function colorHex(string $name): string
    {
        $map = [
            'Ink' => '#1C1A16', 'Black' => '#111111', 'White' => '#FFFFFF',
            'Slate Blue' => '#3B5BA5', 'Blue' => '#2F55A4', 'Navy' => '#1F2A44',
            'Brick' => '#9A3D28', 'Red' => '#B3261E', 'Bone' => '#EDE9E3',
            'Beige' => '#D8C9A8', 'Brown' => '#6B4A2F', 'Tan' => '#B08A5B',
            'Olive' => '#57624A', 'Sage' => '#57624A', 'Green' => '#3F6B3A',
            'Grey' => '#8A8A8A', 'Gray' => '#8A8A8A', 'Cream' => '#F3EBDD',
        ];

        if (isset($map[$name])) return $map[$name];
        if (str_starts_with($name, '#')) return $name;

        return '#BDBDBD';
    }
}