<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Services\CartService;
use App\Services\OrderService;

class CheckoutController extends Controller
{
    public function __construct(private CartService $cart, private OrderService $orders) {}

    public function show()
    {
        $lines = $this->cart->lines();

        if ($lines->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
        if ($lines->contains(fn ($l) => ! $l['ok'])) {
            return redirect()->route('cart.index')->with('error', 'Some items are out of stock. Please update your cart.');
        }

        $totals = $this->cart->totals($lines->sum('line_total'));

        return view('checkout', [
            'lines'     => $lines,
            'totals'    => $totals,
            'user'      => auth()->user(),
            'countries' => CheckoutRequest::COUNTRIES,
        ]);
    }

    public function store(CheckoutRequest $request)
    {
        $order = $this->orders->createFromCart($request->user(), $request->validated());

        $this->cart->clear();

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order placed. Complete payment to confirm it.');
    }
}