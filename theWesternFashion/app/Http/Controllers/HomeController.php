<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BuildsProductCards;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Product;

class HomeController extends Controller
{
    use BuildsProductCards;

    private const NEW_COUNT  = 5;
    private const BEST_COUNT = 8;

    public function index()
    {
        // only active products, with everything a card needs
        $active = fn () => Product::with(['category', 'images', 'variants'])->where('status', 1);

        // ---- New jackets: the newest products ----
        $fresh = $active()->latest()->take(self::NEW_COUNT)->get()
            ->map(fn ($p) => $this->card($p, 'New'))->values();

        // ---- Best sellers: most units sold (cancelled orders ignored) ----
        $ranked = OrderItem::query()
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->whereNotNull('order_items.product_id')
            ->where(fn ($q) => $q->whereNull('orders.status')->orWhere('orders.status', '!=', 'CANCELLED'))
            ->groupBy('order_items.product_id')
            ->selectRaw('order_items.product_id, SUM(order_items.quantity) as units')
            ->orderByDesc('units')
            ->limit(self::BEST_COUNT)
            ->pluck('product_id')
            ->all();

        $best = $active()->whereIn('id', $ranked)->get()
            ->sortBy(fn ($p) => array_search($p->id, $ranked))->values();

        // not enough sales yet? fill up with featured, then newest, so the section is never empty
        if ($best->count() < self::BEST_COUNT) {
            $fill = $active()->whereNotIn('id', $best->pluck('id'))
                ->orderByDesc('featured')->latest()
                ->take(self::BEST_COUNT - $best->count())->get();
            $best = $best->concat($fill);
        }
        $best = $best->map(fn ($p) => $this->card($p))->values();

        // filter tabs = the categories that appear in the best-seller list
        $tabs = $best->unique('cat')
            ->map(fn ($c) => ['key' => $c['cat'], 'label' => $c['category']])
            ->values();

        // ---- Featured: newest product marked "featured", else the top seller ----
        $featuredModel = $active()->where('featured', true)->latest()->first();
        $featured = $featuredModel ? $this->card($featuredModel) : $best->first();

        // ---- Category links next to the featured product ----
        $navCats = Category::whereHas('products', fn ($q) => $q->where('status', 1))
            ->orderBy('name')->take(4)->get(['id', 'name']);

        return view('index', compact('fresh', 'best', 'tabs', 'featured', 'navCats'));
    }
}