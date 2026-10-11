<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function __construct(private CartService $cart) {}

    /** My wishlist page. */
    public function index()
    {
        $items = Wishlist::where('user_id', auth()->id())
            ->with(['product.images', 'product.variants', 'product.category'])
            ->latest()
            ->get()
            ->filter(fn ($w) => $w->product);   // skip products that were deleted meanwhile

        $wishlist = $items->map(function ($w) {
            $p     = $w->product;
            $image = $p->images->sortBy(fn ($i) => $i->is_primary ? 0 : 1)->first();
            $unit  = (float) $this->cart->unitPrice($p);
            $attrs = $p->getAttributes();

            // "was" price: first price-like column that is higher than the selling price
            $compare = null;
            foreach (['compare_at_price', 'compare_price', 'original_price', 'old_price', 'regular_price', 'price'] as $k) {
                if (isset($attrs[$k]) && (float) $attrs[$k] > $unit) {
                    $compare = (float) $attrs[$k];
                    break;
                }
            }

            return [
                'id'       => (string) $p->id,
                'name'     => $p->name,
                'category' => $p->category->name ?? '',
                'price'    => $unit,
                'compare'  => $compare,
                'inStock'  => $this->cart->isActive($p) && $p->variants->sum('stock') > 0,
                'image'    => $image?->image_path ? asset('storage/' . $image->image_path) : null,
                'url'      => route('shop.show', $p),
                'added'    => $w->created_at?->timestamp ?? 0,
            ];
        })->values()->all();

        return view('User.Wishlist', compact('items', 'wishlist'));
    }

    /**
     * Product ids the visitor has saved. Public on purpose: guests simply get an empty list,
     * so the heart buttons on shop pages can be painted without a login redirect.
     */
    public function ids(): JsonResponse
    {
        $ids = auth()->check()
            ? Wishlist::where('user_id', auth()->id())->pluck('product_id')->all()
            : [];

        return response()->json(['ids' => $ids])->header('Cache-Control', 'no-store');
    }

    /** Heart button: add if it isn't saved yet, remove if it is. */
    public function toggle(Request $request): JsonResponse
    {
        $data = $request->validate([
            'product_id' => ['required', 'uuid', 'exists:products,id'],
        ]);

        $mine = Wishlist::where('user_id', auth()->id());

        $existing = (clone $mine)->where('product_id', $data['product_id'])->first();

        if ($existing) {
            $existing->delete();
            $wished = false;
        } else {
            Wishlist::firstOrCreate(['user_id' => auth()->id(), 'product_id' => $data['product_id']]);
            $wished = true;
        }

        return response()->json([
            'wished' => $wished,
            'count'  => (clone $mine)->count(),
        ]);
    }

    /** "Remove" button on the wishlist page (plain form, no JavaScript needed). */
    public function destroy(string $product)
    {
        Wishlist::where('user_id', auth()->id())->where('product_id', $product)->delete();

        return back()->with('success', 'Removed from your wishlist.');
    }
}