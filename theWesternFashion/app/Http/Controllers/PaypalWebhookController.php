<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;
use App\Services\Payments\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * PayPal calls this URL when a payment completes, even if the customer closed the tab before
 * returning to the site. Safe to receive the same event twice (markPaid is idempotent).
 */
class PaypalWebhookController extends Controller
{
    public function handle(Request $request, PaymentGateway $gateway, OrderService $orders)
    {
        if (! $gateway->verifyWebhook($request)) {
            Log::warning('PayPal webhook rejected (bad signature)');
            abort(400);
        }

        $event    = $request->input('event_type');
        $resource = (array) $request->input('resource', []);

        if ($event === 'PAYMENT.CAPTURE.COMPLETED') {
            $order = Order::find($resource['custom_id'] ?? null)
                ?? Order::where('order_number', $resource['invoice_id'] ?? '')->first();

            if ($order) {
                $amountOk = abs((float) ($resource['amount']['value'] ?? 0) - (float) $order->total) < 0.01;

                if ($amountOk && ! $orders->markPaid($order, (string) ($resource['id'] ?? ''), 'PAYPAL')) {
                    // paid after the order was cancelled/expired
                    $gateway->refund($order, $resource['id'] ?? null);
                }
            }
        } else {
            Log::info('PayPal webhook ignored', ['event' => $event]);
        }

        return response()->json(['ok' => true]);
    }
}