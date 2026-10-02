<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // 1. Show all products
    public function index()
    {
        // "with" loads related data in one go (faster)
        $products = Product::with(['category', 'images', 'variants'])
                           ->latest()
                           ->paginate(10);

        return view('products.index', compact('products'));
    }

    // 2. Show the "add product" form
    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    // 3. Save a new product
    public function store(Request $request)
    {
        $request->validate([
            'category_id'      => 'required|exists:categories,id',
            'name'             => 'required|max:255',
            'description'      => 'nullable',
            'price'            => 'required|numeric|min:0',
            'sale_price'       => 'nullable|numeric|min:0|lt:price',
            'status'           => 'required',
            'images.*'         => 'nullable|image|max:2048',
            'variants.*.sku'   => 'required|distinct|unique:product_variants,sku',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',
        ]);

        // Create the product
        $product = Product::create([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'slug'        => $this->makeSlug($request->name),
            'description' => $request->description,
            'price'       => $request->price,
            'sale_price'  => $request->sale_price,
            'status'      => $request->status,
            'featured'    => $request->has('featured'), // checkbox
        ]);

        $this->saveImages($request, $product);
        $this->saveVariants($request, $product);

        return redirect()->route('products.index')
                         ->with('success', 'Product added!');
    }

    // 4. Show one product
    public function show(Product $product)
    {
        $product->load(['category', 'images', 'variants']);

        return view('products.show', compact('product'));
    }

    // 5. Show the "edit product" form
    public function edit(Product $product)
    {
        $product->load(['images', 'variants']);
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    // 6. Save changes to a product
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id'      => 'required|exists:categories,id',
            'name'             => 'required|max:255',
            'description'      => 'nullable',
            'price'            => 'required|numeric|min:0',
            'sale_price'       => 'nullable|numeric|min:0|lt:price',
            'status'           => 'required',
            'images.*'         => 'nullable|image|max:2048',
            'variants.*.sku'   => 'required|distinct',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',
        ]);

        $product->update([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'slug'        => $this->makeSlug($request->name, $product->id),
            'description' => $request->description,
            'price'       => $request->price,
            'sale_price'  => $request->sale_price,
            'status'      => $request->status,
            'featured'    => $request->has('featured'),
        ]);

        // Add any newly uploaded images (old ones stay)
        $this->saveImages($request, $product);

        // Variants: delete the old ones and save the submitted list again
        if ($request->has('variants')) {
            $product->variants()->delete();
            $this->saveVariants($request, $product);
        }

        return redirect()->route('products.index')
                         ->with('success', 'Product updated!');
    }

    // 7. Delete a product
    public function destroy(Product $product)
    {
        // Delete image files from the disk
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        // Delete database rows (images and variants first, then the product)
        $product->images()->delete();
        $product->variants()->delete();
        $product->delete();

        return redirect()->route('products.index')
                         ->with('success', 'Product deleted!');
    }

    // 8. Delete a single image (used from the edit page)
    public function destroyImage(ProductImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Image deleted!');
    }

    // ---------------------------------------------------------
    // Helper functions (used by the methods above)
    // ---------------------------------------------------------

    // Save uploaded images
    private function saveImages(Request $request, Product $product)
    {
        if (!$request->hasFile('images')) {
            return;
        }

        // If the product has no images yet, the first upload becomes primary
        $hasPrimary = $product->images()->where('is_primary', true)->exists();
        $order = $product->images()->count();

        foreach ($request->file('images') as $file) {
            $path = $file->store('products', 'public');

            $product->images()->create([
                'image_path' => $path,
                'is_primary' => !$hasPrimary,
                'sort_order' => $order++,
            ]);

            $hasPrimary = true; // only the very first one is primary
        }
    }

    // Save variants (size, color, sku, price, stock)
    private function saveVariants(Request $request, Product $product)
    {
        if (!$request->has('variants')) {
            return;
        }

        foreach ($request->variants as $variant) {
            $product->variants()->create([
                'sku'   => $variant['sku'],
                'size'  => $variant['size'] ?? null,
                'color' => $variant['color'] ?? null,
                'price' => $variant['price'],
                'stock' => $variant['stock'],
            ]);
        }
    }

    // Make a unique slug like "red-t-shirt" (adds -1, -2 if it already exists)
    private function makeSlug($name, $ignoreId = null)
    {
        $slug = Str::slug($name);
        $original = $slug;
        $count = 1;

        while (Product::where('slug', $slug)->where('id', '!=', $ignoreId)->exists()) {
            $slug = $original . '-' . $count++;
        }

        return $slug;
    }
}