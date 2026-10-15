@extends('layouts.shop')
@section('title', 'Test payment')

@section('content')
<div class="max-w-md mx-auto border border-ink/10 p-8 text-center">
  <p class="text-[11px] font-mono uppercase tracking-tag text-brick mb-4">Test mode · no real money</p>
  <h1 class="font-display text-3xl mb-2">Pretend PayPal</h1>
  <p class="text-[13px] text-ink/60 mb-8">
    You are paying <span class="font-mono text-ink">${{ number_format($order->total, 2) }}</span>
    for order <span class="font-mono text-ink">{{ $order->order_number }}</span>.
  </p>

  <a href="{{ route('payment.return', ['order' => $order, 'token' => $order->provider_order_id, 'PayerID' => 'FAKEPAYER']) }}"
     class="btn w-full block">Approve payment</a>

  <a href="{{ route('payment.cancel', $order) }}"
     class="mt-4 inline-block text-[11px] font-mono uppercase tracking-tag text-ink/50 underline">Cancel and go back</a>
</div>
@endsection 