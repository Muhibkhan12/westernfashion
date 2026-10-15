<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;
use App\Services\Payments\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /** "Pay now": create the payment at the provider and send the customer there. */
    public function start(Order $order, PaymentGateway $gateway)
    {
        $this->own($order);

        if (! $order->isPayable()) {
            return redirect()->route('orders.show', $order)->with('error', 'This order can’t be paid.');
        }

        try {
            return redirect()->away($gateway->createCheckout($order));
        } catch (\Throwable $e) {
            report($e);
            return redirect()->route('orders.show', $order)
                ->with('error', 'Online payment isn’t available right now. Your order is saved.');
        }
    }

    /** The customer is back from the provider after approving: take the money, then mark the order paid. */
    public function approved(Request $request, Order $order, PaymentGateway $gateway, OrderService $orders)
    {
        $this->own($order);
        $back = fn () => redirect()->route('orders.show', $order);

        if ($order->payment_status === 'PAID') {
            return $back()->with('success', 'Payment received. Thank you!');
        }

        // only an order that is still waiting for payment, and only the payment we created for it
        $token = (string) $request->query('token');
        if (! $order->isPayable() || $token === '' || $token !== (string) $order->provider_order_id) {
            return $back()->with('error', 'This payment can’t be completed. If you were charged, please contact us with your order number.');
        }

        try {
            $result = $gateway->capture($order, $token);
        } catch (\Throwable $e) {
            report($e);
            return $back()->with('error', 'We couldn’t confirm your payment. If you were charged, please contact us with order ' . $order->order_number . '.');
        }

        if ($result['status'] === 'PENDING') {
            return $back()->with('success', 'Your payment is being processed. We’ll confirm your order as soon as it clears.');
        }

        // never trust the browser: check the amount and currency PayPal reports against our own order
        $amountOk   = abs((float) $result['amount'] - (float) $order->total) < 0.01;
        $currencyOk = strtoupper((string) $result['currency']) === strtoupper(config('paypal.currency'));

        if ($result['status'] !== 'COMPLETED' || ! $amountOk || ! $currencyOk || ! $result['capture_id']) {
            Log::error('Payment did not match the order', ['order' => $order->order_number, 'result' => $result]);
            return $back()->with('error', 'Your payment could not be verified. Please contact us with order ' . $order->order_number . '.');
        }

        if (! $orders->markPaid($order, $result['capture_id'], 'PAYPAL')) {
            // the order was cancelled/expired while the customer was paying: give the money straight back
            $gateway->refund($order, $result['capture_id']);
            return $back()->with('error', 'This order expired before your payment arrived, so it was refunded. Please place the order again.');
        }

        return $back()->with('success', 'Payment received. Thank you!');
    }

    /** The customer pressed "cancel" at the provider. Nothing was charged. */
    public function cancel(Order $order)
    {
        $this->own($order);

        return redirect()->route('orders.show', $order)
            ->with('error', 'Payment cancelled. Your order is still saved — you can pay when you’re ready.');
    }

    /** The pretend-PayPal approval page (only exists when PAYMENT_GATEWAY=fake). */
    public function mock(Order $order)
    {
        $this->own($order);
        abort_unless(config('services.payment.gateway') !== 'paypal', 404);
        abort_unless($order->isPayable() && $order->provider_order_id, 404);

        return view('payments.mock-paypal', compact('order'));
    }

    private function own(Order $order): void
    {
        abort_unless((string) $order->user_id === (string) auth()->id(), 404);
    }
}