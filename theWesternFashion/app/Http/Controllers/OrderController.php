<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;

class OrderController extends Controller
{
    public function __construct(private OrderService $orders) {}

    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->latest()->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $this->own($order);
        $order->load('items');

        return view('orders.show', compact('order'));
    }

    public function cancel(Order $order)
    {
        $this->own($order);

        return $this->orders->cancel($order)
            ? redirect()->route('orders.show', $order)->with('success', 'Order cancelled.')
            : back()->with('error', 'This order can no longer be cancelled.');
    }

    private function own(Order $order): void
    {
        abort_unless((string) $order->user_id === (string) auth()->id(), 404);
    }
}