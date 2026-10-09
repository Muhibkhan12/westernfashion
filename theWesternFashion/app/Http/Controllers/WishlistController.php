<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /** My wishlist page. */
    public function index()
    {
        $items = Wishlist::where('user_id', auth()->id())
            ->with(['product.images', 'product.variants', 'product.category'])
            ->latest()
            ->get()
            ->filter(fn ($w) => $w->product);   // skip products that were deleted meanwhile

        return view('User.Wishlist', compact('items'));
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