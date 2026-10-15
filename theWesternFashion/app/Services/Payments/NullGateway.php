<?php

namespace App\Services\Payments;

use App\Models\Order;
use Illuminate\Http\Request;

/**
 * Used when no payment gateway is configured. Every online payment attempt fails
 * with a friendly message (PaymentController catches the exception).
 */
class NullGateway implements PaymentGateway
{
    public function createCheckout(Order $order): string
    {
        throw new \RuntimeException('No payment gateway is configured.');
    }

    public function capture(Order $order, string $providerOrderId): array
    {
        throw new \RuntimeException('No payment gateway is configured.');
    }

    public function refund(Order $order, ?string $captureId = null): bool
    {
        return false;
    }

    public function verifyWebhook(Request $request): bool
    {
        return false; // never trust webhooks when nothing is configured
    }
}