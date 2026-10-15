<?php

namespace App\Services\Payments;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

/**
 * Real PayPal (Orders v2) through the srmklive/paypal package.
 * Written from PayPal's documentation; test it against a sandbox before going live.
 */
class PayPalGateway implements PaymentGateway
{
    private function client(): PayPalClient
    {
        $paypal = new PayPalClient;
        $paypal->setApiCredentials(config('paypal'));

        $token = $paypal->getAccessToken();
        if (empty($token['access_token'])) {
            Log::error('PayPal login failed', ['response' => $token]);
            throw new \RuntimeException('Could not log in to PayPal.');
        }

        return $paypal;
    }

    private function amount(Order $order): string
    {
        return number_format((float) $order->total, 2, '.', '');
    }

    public function createCheckout(Order $order): string
    {
        $response = $this->client()->createOrder([
            'intent' => 'CAPTURE',
            'purchase_units' => [[
                'reference_id' => $order->order_number,
                'invoice_id'   => $order->order_number,
                'custom_id'    => (string) $order->id,
                'description'  => 'The Western Fashion order ' . $order->order_number,
                'amount'       => [
                    'currency_code' => config('paypal.currency'),
                    'value'         => $this->amount($order),
                ],
            ]],
            'application_context' => [
                'brand_name'          => config('app.name'),
                'user_action'         => 'PAY_NOW',
                'shipping_preference' => 'NO_SHIPPING', // we already collected the address
                'return_url'          => route('payment.return', $order),
                'cancel_url'          => route('payment.cancel', $order),
            ],
        ]);

        if (empty($response['id']) || isset($response['error'])) {
            Log::error('PayPal createOrder failed', ['order' => $order->order_number, 'response' => $response]);
            throw new \RuntimeException('PayPal could not create the payment.');
        }

        $link = collect($response['links'] ?? [])->first(fn ($l) => in_array($l['rel'] ?? '', ['approve', 'payer-action'], true));
        if (! $link) {
            throw new \RuntimeException('PayPal did not return an approval link.');
        }

        // remember which PayPal order belongs to this order, so the return trip can be checked
        $order->update(['provider_order_id' => $response['id']]);

        return $link['href'];
    }

    public function capture(Order $order, string $providerOrderId): array
    {
        $response = $this->client()->capturePaymentOrder($providerOrderId);

        if (isset($response['error'])) {
            Log::error('PayPal capture failed', ['order' => $order->order_number, 'response' => $response]);
            throw new \RuntimeException('PayPal could not capture the payment.');
        }

        $capture = $response['purchase_units'][0]['payments']['captures'][0] ?? null;

        return [
            'status'     => $capture['status'] ?? ($response['status'] ?? 'UNKNOWN'),
            'capture_id' => $capture['id'] ?? null,
            'amount'     => $capture['amount']['value'] ?? null,
            'currency'   => $capture['amount']['currency_code'] ?? null,
        ];
    }

    public function refund(Order $order, ?string $captureId = null): bool
    {
        $captureId ??= $order->payment_reference;
        if (! $captureId) return false;

        $response = $this->client()->refundCapturedPayment(
            $captureId,
            $order->order_number . '-REFUND',
            (float) $order->total,
            'Refund for order ' . $order->order_number
        );

        $ok = ($response['status'] ?? '') === 'COMPLETED';
        if (! $ok) Log::error('PayPal refund failed', ['order' => $order->order_number, 'response' => $response]);

        return $ok;
    }

    public function verifyWebhook(Request $request): bool
    {
        $webhookId = config('paypal.webhook_id');
        if (! $webhookId) return false;

        $result = $this->client()->verifyWebHook([
            'auth_algo'         => $request->header('PAYPAL-AUTH-ALGO'),
            'cert_url'          => $request->header('PAYPAL-CERT-URL'),
            'transmission_id'   => $request->header('PAYPAL-TRANSMISSION-ID'),
            'transmission_sig'  => $request->header('PAYPAL-TRANSMISSION-SIG'),
            'transmission_time' => $request->header('PAYPAL-TRANSMISSION-TIME'),
            'webhook_id'        => $webhookId,
            'webhook_event'     => $request->json()->all(),
        ]);

        return ($result['verification_status'] ?? '') === 'SUCCESS';
    }
}