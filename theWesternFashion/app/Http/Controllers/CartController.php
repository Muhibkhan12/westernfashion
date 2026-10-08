<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(private CartService $cart) {}

    public function index()
    {
        $lines  = $this->cart->lines();
        $totals = $this->cart->totals($lines->sum('line_total'));

        return view('cart', compact('lines', 'totals'));
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'variant_id' => ['required', 'uuid', 'exists:product_variants,id'],
            'qty'        => ['required', 'integer', 'min:1', 'max:' . CartService::MAX_QTY],
        ]);

        $this->cart->add($data['variant_id'], (int) $data['qty']);

        return $request->expectsJson()
            ? response()->json(['count' => $this->cart->count()])
            : redirect()->route('cart.index')->with('success', 'Added to your cart.');
    }

    public function update(Request $request, string $variant)
    {
        $data = $request->validate([
            'qty' => ['required', 'integer', 'min:0', 'max:' . CartService::MAX_QTY],
        ]);

        $this->cart->set($variant, (int) $data['qty']);

        return back();
    }

    public function destroy(string $variant)
    {
        $this->cart->remove($variant);

        return back()->with('success', 'Item removed.');
    }
}