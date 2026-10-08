<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\Payments\PaymentGateway;

class PaymentController extends Controller
{
    public function start(Order $order, PaymentGateway $gateway)
    {
        abort_unless((string) $order->user_id === (string) auth()->id(), 404);

        if (! $order->isPayable()) {
            return redirect()->route('orders.show', $order)
                ->with('error', 'This order can’t be paid.');
        }

        try {
            return redirect()->away($gateway->createCheckout($order));
        } catch (\RuntimeException $e) {
            return redirect()->route('orders.show', $order)
                ->with('error', 'Online payment isn’t available yet. Your order is saved.');
        }
    }
}