<?php

namespace App\Services\Payments;

use App\Models\Order;

interface PaymentGateway
{
    /** Create a payment session for the order and return the URL to send the customer to. */
    public function createCheckout(Order $order): string;
}