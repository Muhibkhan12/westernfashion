<?php

namespace App\Services\Payments;

use App\Models\Order;

class NullGateway implements PaymentGateway
{
    public function createCheckout(Order $order): string
    {
        throw new \RuntimeException('Payment gateway not configured.');
    }
}