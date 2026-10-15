<?php

namespace App\Services\Payments;

use App\Models\Order;
use Illuminate\Http\Request;

interface PaymentGateway
{
    /** Create the payment at the provider and return the URL to send the customer to. */
    public function createCheckout(Order $order): string;

    /**
     * After the customer approved: take the money.
     * @return array{status:string, capture_id:?string, amount:?string, currency:?string}
     */
    public function capture(Order $order, string $providerOrderId): array;

    /** Give the money back (full refund). $captureId defaults to the one saved on the order. */
    public function refund(Order $order, ?string $captureId = null): bool;

    /** True if a webhook request really came from the provider. */
    public function verifyWebhook(Request $request): bool;
}