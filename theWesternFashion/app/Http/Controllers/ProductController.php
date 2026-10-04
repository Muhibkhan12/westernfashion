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
    // 1. LIST: show all products
    public function index()
    {
        $products = Product::with(['category', 'images', 'variants'])
                           ->latest()
                           ->paginate(10);

        return view('products.index', compact('products'));
    }

    // 2. CREATE: show the empty form
    public function create()
    {
        $categories = Category::all();

        // The same view (products.form) is used for create AND edit.
        // "product => null" tells the view we are adding a new product.
        return view('products.form', [
            'product'    => null,
            'categories' => $categories,
        ]);
    }

    // 3. STORE: save a new product
    public function store(Request $request)
    {
        $data = $this->validateProduct($request);

        // A transaction = "all or nothing". If anything fails, nothing is saved.
        DB::transaction(function () use ($request, $data) {
            $product = Product::create([
                'category_id' => $data['category_id'],
                'name'        => $data['name'],
                'slug'        => $this->makeSlug($data['name']),
                'description' => $data['description'] ?? null,
                'price'       => $data['price'],
                'sale_price'  => $data['sale_price'] ?? null,
                'status'      => $data['status'],
                'featured'    => $request->has('featured'), // checkbox
            ]);

            $this->saveImages($request, $product);
            $this->saveVariants($data, $product);
        });

        $message = $data['status'] === 'active' ? 'Product published!' : 'Draft saved!';

        return redirect()->route('products.index')->with('success', $message);
    }

    // 4. SHOW: one product
    public function show(Product $product)
    {
        $product->load(['category', 'images', 'variants']);

        return view('products.show', compact('product'));
    }

    // 5. EDIT: show the form filled with the product's data
    public function edit(Product $product)
    {
        $product->load(['images', 'variants']);
        $categories = Category::all();

        return view('products.form', compact('product', 'categories'));
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

            // Add any newly uploaded images (existing ones stay)
            $this->saveImages($request, $product);

            // Variants: remove the old rows, then save the submitted list again
            $product->variants()->delete();
            $this->saveVariants($data, $product);
        });

        return redirect()->route('products.index')
                         ->with('success', 'Product updated!');
    }

    // 7. DESTROY: delete a product
    public function destroy(Product $product)
    {
        // Delete the image files from the disk
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        // Delete database rows (children first, then the product)
        $product->images()->delete();
        $product->variants()->delete();
        $product->delete();

        return redirect()->route('products.index')
                         ->with('success', 'Product deleted!');
    }

    // 8. Delete ONE image (the red button on the edit page)
    public function destroyImage(ProductImage $image)
    {
        $product    = $image->product;
        $wasPrimary = $image->is_primary;

        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        // If the cover image was deleted, make the next image the cover
        if ($wasPrimary) {
            $next = $product->images()->first();
            if ($next) {
                $next->update(['is_primary' => true]);
            }
        }

        return back()->with('success', 'Image deleted!');
    }

    // ---------------------------------------------------------
    // Helper functions (used by the methods above)
    // ---------------------------------------------------------

    // The validation rules, shared by store() and update()
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

    // Save uploaded images
    private function saveImages(Request $request, Product $product)
    {
        if (!$request->hasFile('images')) {
            return;
        }

        // The first image ever uploaded becomes the cover (is_primary)
        $hasPrimary = $product->images()->where('is_primary', true)->exists();
        $order      = $product->images()->count();

        foreach ($request->file('images') as $file) {
            $path = $file->store('products', 'public');

            $product->images()->create([
                'image_path' => $path,
                'is_primary' => !$hasPrimary,
                'sort_order' => $order++,
            ]);

            $hasPrimary = true; // only the very first one is the cover
        }
    }

    // Save variants (one row per size)
    private function saveVariants(array $data, Product $product)
    {
        // The form has no SKU per size, so we build one: PREFIX-SIZE (e.g. JACKET-M)
        $prefix = $data['sku_prefix'] ?? $product->slug;

        // Each variant uses the price the customer actually pays
        $price = $data['sale_price'] ?? $data['price'];

        // Rows that already have a SKU (from the edit page) go first,
        // so a newly generated SKU can never steal an existing one.
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

    // Make a unique SKU like "JACKET-M" (adds -1, -2 if it already exists)
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

    // Make a unique slug like "red-t-shirt" (adds -1, -2 if it already exists)
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