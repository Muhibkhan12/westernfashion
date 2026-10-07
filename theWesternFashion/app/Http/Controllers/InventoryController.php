<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /** GET /admin-inventory */
    public function index()
    {
        $products = Product::withInventory()
            ->get()
            ->map(fn ($p) => $this->transform($p));

        return view('Admin.inventory', [          // ← capital A
            'products'   => $products,
            'categories' => Category::orderBy('name')->pluck('name'),
        ]);
    }

    /** PATCH /admin-inventory/{product}/variants — save the drawer */
    public function updateVariants(Request $request, Product $product): JsonResponse
    {
        $data = $request->validate([
            'reorder_level'    => 'required|integer|min:0',
            'variants'         => 'required|array',
            'variants.*.id'    => 'required|uuid|exists:product_variants,id',
            'variants.*.stock' => 'required|integer|min:0',
        ]);

        // Security: submitted variant IDs must match the product's own variants.
        $submitted = collect($data['variants'])->pluck('id')->sort()->values();
        $actual    = $product->variants->pluck('id')->sort()->values();

        abort_unless($submitted->all() === $actual->all(), 422,
            'Variant list does not match this product.');

        $product->update(['reorder_level' => $data['reorder_level']]);

        foreach ($data['variants'] as $row) {
            ProductVariant::where('id', $row['id'])
                ->where('product_id', $product->id)
                ->update(['stock' => $row['stock']]);
        }

        $product->load(['category', 'variants']);  // ← also load category

        return response()->json([
            'ok'      => true,
            'product' => $this->transform($product),
        ]);
    }

    /** Convert a Product into the shape the JS expects. */
    private function transform(Product $p): array
    {
        return [
            'id'            => $p->id,
            'name'          => $p->name,
            'sku'           => $p->variants->first()->sku ?? '',
            'category'      => $p->category?->name ?? 'Uncategorised',
            'price'         => (float) ($p->sale_price ?: $p->price),
            'reorder_level' => (int) $p->reorder_level,
            'status'        => $p->getRawOriginal('status') ? 'active' : 'draft',
            'variants'      => $p->variants->map(fn ($v) => [
                'id'    => $v->id,
                'size'  => $v->size ?: ($v->color ?: 'Default'),
                'stock' => (int) $v->stock,
            ])->values(),
        ];
    }
}