<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class ShopController extends Controller
{
    // PUBLIC LIST -> resources/views/products.blade.php
    public function index()
    {
        $products = Product::with(['category', 'images', 'variants'])
            ->where('status', 1)          // sirf active products
            ->latest()
            ->get();

        $items = $products->map(function ($p) {
            $hasSale  = $p->sale_price !== null;
            $price    = (float) ($hasSale ? $p->sale_price : $p->price);
            $oldPrice = $hasSale ? (float) $p->price : null;
            $stock    = (int) $p->variants->sum('stock');

            // primary image pehle
            $images = $p->images
                ->sortBy(fn ($img) => $img->is_primary ? 0 : 1)
                ->map(fn ($img) => asset('storage/' . $img->image_path))
                ->values();

            $colors = $p->variants
                ->pluck('color')
                ->filter()
                ->map(fn ($c) => Str::title(trim($c)))
                ->unique()
                ->map(fn ($c) => ['name' => $c, 'hex' => $this->colorHex($c)])
                ->values();

            $badge = null;
            if ($stock <= 0)       $badge = 'Sold out';
            elseif ($hasSale)      $badge = 'Sale';
            elseif ($p->featured)  $badge = 'Featured';

            return [
                'id'       => $p->id,
                'name'     => $p->name,
                'brand'    => $p->category->name ?? 'The Western Fashion',
                'cat'      => $p->category_id,
                'price'    => $price,
                'oldPrice' => $oldPrice,
                'badge'    => $badge,
                'inStock'  => $stock > 0,
                'images'   => $images,
                'colors'   => $colors,
                'sizes'    => $p->variants->pluck('size')->unique()->values(),
            ];
        })->values();

        $categories = Category::whereHas('products', fn ($q) => $q->where('status', 1))
            ->orderBy('name')
            ->get(['id', 'name']);

        // filter lists DB se
        $allColors = $items->pluck('colors')->flatten(1)->unique('name')->values();

        $order    = ['XXS', 'XS', 'S', 'M', 'L', 'XL', 'XXL', '3XL'];
        $allSizes = $items->pluck('sizes')->flatten()->unique()->values()
            ->sortBy(function ($s) use ($order) {
                $i = array_search(strtoupper($s), $order);
                return $i === false ? 100 : $i;
            })->values();

        $minPrice = $items->count() ? (int) (floor($items->min('price') / 10) * 10) : 0;
        $maxPrice = $items->count() ? (int) (ceil($items->max('price') / 10) * 10) : 100;
        if ($maxPrice <= $minPrice) $maxPrice = $minPrice + 10;

        return view('products', compact('items', 'categories', 'allColors', 'allSizes', 'minPrice', 'maxPrice'));
    }

// PUBLIC SINGLE PRODUCT -> resources/views/show.blade.php
public function show(Product $product)
{
    abort_unless($product->status === 'active', 404);

    $product->load(['category', 'images', 'variants']);

    $hasSale  = $product->sale_price !== null;
    $price    = (float) ($hasSale ? $product->sale_price : $product->price);
    $oldPrice = $hasSale ? (float) $product->price : null;

    // primary image pehle
    $images = $product->images
        ->sortBy(fn ($img) => $img->is_primary ? 0 : 1)
        ->map(fn ($img) => asset('storage/' . $img->image_path))
        ->values();

    $variants = $product->variants->map(fn ($v) => [
        'id'    => $v->id,
        'sku'   => $v->sku,
        'size'  => $v->size,
        'color' => $v->color ? Str::title(trim($v->color)) : null,
        'stock' => (int) $v->stock,
    ])->values();

    $colors = $variants->pluck('color')->filter()->unique()->values()
        ->map(fn ($c) => ['name' => $c, 'hex' => $this->colorHex($c)]);

    $totalStock = (int) $variants->sum('stock');

    $related = Product::with(['images', 'variants'])
        ->where('status', 1)
        ->where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->latest()
        ->take(4)
        ->get();

    return view('show', compact(
        'product', 'images', 'variants', 'colors',
        'price', 'oldPrice', 'hasSale', 'totalStock', 'related'
    ));
}

    private function colorHex(string $name): string
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
        if (str_starts_with($name, '#')) return $name;   // agar hex hi save kiya ho

        return '#BDBDBD';
    }
}