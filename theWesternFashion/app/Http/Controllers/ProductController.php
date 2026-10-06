<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // 1. LIST -> resources/views/Admin/products.blade.php
    public function index()
    {
        $products = Product::with(['category', 'images', 'variants'])
                           ->latest()
                           ->paginate(10);

        return view('Admin.products', compact('products'));
    }

    // 2. CREATE -> resources/views/Admin/addProducts.blade.php (empty form)
    public function create()
    {
        $categories = Category::all();

        return view('Admin.addProducts', [
            'product'    => null,
            'categories' => $categories,
        ]);
    }

    // 3. STORE: save a new product
    public function store(Request $request)
    {
        $data = $this->validateProduct($request);

        DB::transaction(function () use ($request, $data) {
            $product = Product::create([
                'category_id' => $data['category_id'],
                'name'        => $data['name'],
                'slug'        => $this->makeSlug($data['name']),
                'description' => $data['description'] ?? null,
                'price'       => $data['price'],
                'sale_price'  => $data['sale_price'] ?? null,
                'status'      => $data['status'],
                'featured'    => $request->has('featured'),
            ]);

            $this->saveImages($request, $product);
            $this->saveVariants($data, $product);
        });

        $message = $data['status'] === 'active' ? 'Product published!' : 'Draft saved!';

        return redirect()->route('products.index')->with('success', $message);
    }

    // 4. SHOW -> resources/views/Admin/productShow.blade.php
    public function show(Product $product)
    {
        $product->load(['category', 'images', 'variants']);

        return view('Admin.productShow', compact('product'));
    }

    // 5. EDIT -> resources/views/Admin/addProducts.blade.php (filled form)
    public function edit(Product $product)
    {
        $product->load(['images', 'variants']);
        $categories = Category::all();

        return view('Admin.addProducts', compact('product', 'categories'));
    }

    // 6. UPDATE: save changes
    public function update(Request $request, Product $product)
    {
        $data = $this->validateProduct($request);

        DB::transaction(function () use ($request, $data, $product) {
            $product->update([
                'category_id' => $data['category_id'],
                'name'        => $data['name'],
                'slug'        => $this->makeSlug($data['name'], $product->id),
                'description' => $data['description'] ?? null,
                'price'       => $data['price'],
                'sale_price'  => $data['sale_price'] ?? null,
                'status'      => $data['status'],
                'featured'    => $request->has('featured'),
            ]);

            $this->saveImages($request, $product);

            $product->variants()->delete();
            $this->saveVariants($data, $product);
        });

        return redirect()->route('products.index')
                         ->with('success', 'Product updated!');
    }

    // 7. DESTROY: delete a product
    public function destroy(Product $product)
    {
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $product->images()->delete();
        $product->variants()->delete();
        $product->delete();

        return redirect()->route('products.index')
                         ->with('success', 'Product deleted!');
    }

    // 8. Delete ONE image (red button on the edit page)
    public function destroyImage(ProductImage $image)
    {
        $product    = $image->product;
        $wasPrimary = $image->is_primary;

        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        if ($wasPrimary) {
            $next = $product->images()->first();
            if ($next) {
                $next->update(['is_primary' => true]);
            }
        }

        return back()->with('success', 'Image deleted!');
    }

    // ---------------------------------------------------------
    // Helper functions
    // ---------------------------------------------------------

    private function validateProduct(Request $request)
    {
        return $request->validate([
            'category_id'      => 'required|exists:categories,id',
            'name'             => 'required|max:255',
            'description'      => 'nullable|max:600',
            'price'            => 'required|numeric|gt:0',
            'sale_price'       => 'nullable|numeric|gt:0|lt:price',
            'status'           => 'required|in:draft,active',
            'sku_prefix'       => 'nullable|max:50',
            'images'           => 'nullable|array|max:5',
            'images.*'         => 'image|mimes:jpg,jpeg,png|max:2048',
            'variants'         => 'required|array|min:1',
            'variants.*.sku'   => 'nullable|max:100',
            'variants.*.size'  => 'required|max:50|distinct',
            'variants.*.color' => 'nullable|max:50',
            'variants.*.stock' => 'nullable|integer|min:0',
        ], [
            'variants.required'        => 'Add at least one size.',
            'variants.*.size.required' => 'Every size row needs a size name.',
            'variants.*.size.distinct' => 'Size names must be unique.',
        ]);
    }

    private function saveImages(Request $request, Product $product)
    {
        if (!$request->hasFile('images')) {
            return;
        }

        $hasPrimary = $product->images()->where('is_primary', true)->exists();
        $order      = $product->images()->count();

        foreach ($request->file('images') as $file) {
            $path = $file->store('products', 'public');

            $product->images()->create([
                'image_path' => $path,
                'is_primary' => !$hasPrimary,
                'sort_order' => $order++,
            ]);

            $hasPrimary = true;
        }
    }

    private function saveVariants(array $data, Product $product)
    {
        $prefix = $data['sku_prefix'] ?? $product->slug;
        $price  = $data['sale_price'] ?? $data['price'];

        $rows = collect($data['variants'])->sortByDesc(fn ($row) => !empty($row['sku']));

        foreach ($rows as $row) {
            $sku = $row['sku'] ?? null;

            if (!$sku) {
                $sku = $this->makeSku($prefix, $row['size']);
            }

            $product->variants()->create([
                'sku'   => $sku,
                'size'  => $row['size'],
                'color' => $row['color'] ?? null,
                'price' => $price,
                'stock' => $row['stock'] ?? 0,
            ]);
        }
    }

    private function makeSku($prefix, $size)
    {
        $sku      = strtoupper(Str::slug($prefix . ' ' . $size));
        $original = $sku;
        $count    = 1;

        while (ProductVariant::where('sku', $sku)->exists()) {
            $sku = $original . '-' . $count++;
        }

        return $sku;
    }

    private function makeSlug($name, $ignoreId = null)
    {
        $slug     = Str::slug($name);
        $original = $slug;
        $count    = 1;

        while (Product::where('slug', $slug)->where('id', '!=', $ignoreId)->exists()) {
            $slug = $original . '-' . $count++;
        }

        return $slug;
    }
}