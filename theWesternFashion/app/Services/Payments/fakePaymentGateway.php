<?php

namespace App\Services\Payments;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * A pretend PayPal for practice (PAYMENT_GATEWAY=fake). No account, no internet, no real money.
 * "Checkout" is a local page with Approve / Cancel buttons; everything after that runs through
 * the same controller and OrderService code as the real thing.
 */
class FakePayPalGateway implements PaymentGateway
{
    public function createCheckout(Order $order): string
    {
        $order->update(['provider_order_id' => 'FAKE-' . Str::upper(Str::random(12))]);

        return route('payment.mock', $order);
    }

    public function capture(Order $order, string $providerOrderId): array
    {
        return [
            'status'     => 'COMPLETED',
            'capture_id' => 'FAKECAP-' . Str::upper(Str::random(10)),
            'amount'     => number_format((float) $order->total, 2, '.', ''),
            'currency'   => config('paypal.currency', 'USD'),
        ];
    }

    public function refund(Order $order, ?string $captureId = null): bool
    {
        return true;
    }

    public function verifyWebhook(Request $request): bool
    {
        return app()->environment('local'); // lets you POST test events by hand while developing
    }
}