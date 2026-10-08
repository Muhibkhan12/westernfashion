@extends('layouts.shop')
@section('title', 'Order '.$order->order_number)

@section('content')
@php
  $paid      = $order->payment_status === 'PAID';
  $cancelled = $order->status === 'CANCELLED';
  $steps     = ['PENDING' => 'Placed', 'CONFIRMED' => 'Confirmed', 'PROCESSING' => 'Processing', 'SHIPPED' => 'Shipped', 'DELIVERED' => 'Delivered'];
  $keys      = array_keys($steps);
  $current   = array_search($order->status, $keys, true);
  $hold      = \App\Services\OrderService::UNPAID_EXPIRY_MINUTES;
@endphp

<a href="{{ route('orders.index') }}" class="text-[11px] font-mono uppercase tracking-tag underline">← All orders</a>

<div class="flex flex-wrap items-center justify-between gap-4 mt-4 mb-8">
  <div>
    <p class="text-[11px] font-mono uppercase tracking-tag text-ink/50">Order</p>
    <h1 class="font-display text-3xl">{{ $order->order_number }}</h1>
    <p class="text-[12px] text-ink/50 mt-1">Placed {{ $order->created_at->format('M j, Y · g:i A') }}</p>
  </div>
  <div class="flex gap-2 text-[10px] font-mono uppercase tracking-tag">
    <span class="px-3 py-1.5 border {{ $cancelled ? 'border-brick/40 text-brick' : 'border-ink/20' }}">{{ $order->status }}</span>
    <span class="px-3 py-1.5 {{ $paid ? 'bg-sage text-white' : 'bg-brick/10 text-brick' }}">{{ $order->payment_status }}</span>
  </div>
</div>

@if(! $cancelled && $current !== false)
  <ol class="flex items-center gap-2 mb-10 text-[10px] font-mono uppercase tracking-tag overflow-x-auto">
    @foreach($steps as $key => $label)
      @php $i = array_search($key, $keys, true); @endphp
      <li class="flex items-center gap-2 shrink-0 {{ $i <= $current ? 'text-ink' : 'text-ink/30' }}">
        <span class="w-5 h-5 rounded-full flex items-center justify-center {{ $i <= $current ? 'bg-ink text-white' : 'border border-ink/25' }}">{{ $i < $current ? '✓' : $i + 1 }}</span>
        {{ $label }}
      </li>
      @if(! $loop->last)<li class="w-8 border-t border-dashed border-ink/25 shrink-0"></li>@endif
    @endforeach
  </ol>
@endif

<div class="grid lg:grid-cols-[1fr_340px] gap-12">
  <div>
    <div class="divide-y divide-ink/10 border-y border-ink/10 mb-8">
      @foreach($order->items as $i)
        <div class="flex gap-4 py-4">
          <div class="w-16 aspect-[3/4] bg-paperdeep overflow-hidden shrink-0">
            @if($i->image_path)<img src="{{ asset('storage/'.$i->image_path) }}" alt="" class="w-full h-full object-cover">@endif
          </div>
          <div class="flex-1 text-[13px]">
            <p class="font-display text-[15px]">{{ $i->product_name }}</p>
            <p class="text-[11px] font-mono uppercase tracking-tag text-ink/50 mt-1">
              {{ $i->color ? $i->color.' · ' : '' }}{{ $i->size ? 'Size '.$i->size.' · ' : '' }}Qty {{ $i->quantity }}
            </p>
            <p class="text-[12px] text-ink/50 mt-1">${{ number_format($i->unit_price, 2) }} each</p>
          </div>
          <p class="font-mono text-[13px]">${{ number_format($i->subtotal, 2) }}</p>
        </div>
      @endforeach
    </div>

    <h2 class="text-[11px] font-mono uppercase tracking-tag text-ink/50 mb-2">Shipping to</h2>
    <p class="text-[13px] leading-relaxed">
      {{ $order->customer_name }}<br>
      {{ $order->shipping_address }}<br>
      {{ $order->shipping_city }}@if($order->shipping_state), {{ $order->shipping_state }}@endif {{ $order->shipping_postal }}, {{ $order->shipping_country }}<br>
      {{ $order->customer_phone }} · {{ $order->customer_email }}
    </p>
  </div>

  <aside class="lg:self-start border border-ink/10 p-6">
    <dl class="space-y-3 text-[13px]">
      <div class="flex justify-between"><dt class="text-ink/60">Subtotal</dt><dd class="font-mono">${{ number_format($order->subtotal, 2) }}</dd></div>
      <div class="flex justify-between"><dt class="text-ink/60">Shipping</dt><dd class="font-mono">{{ $order->shipping > 0 ? '$'.number_format($order->shipping, 2) : 'Free' }}</dd></div>
      @if($order->discount > 0)
        <div class="flex justify-between"><dt class="text-ink/60">Discount</dt><dd class="font-mono">−${{ number_format($order->discount, 2) }}</dd></div>
      @endif
      <div class="flex justify-between border-t border-ink/10 pt-3 text-[15px]"><dt>Total</dt><dd class="font-mono">${{ number_format($order->total, 2) }}</dd></div>
    </dl>

    @if($order->isPayable())
      <form method="POST" action="{{ route('payment.start', $order) }}" class="mt-6">
        @csrf
        <button class="btn w-full">Pay now</button>
      </form>
      <p class="text-[11px] text-ink/50 mt-3">Unpaid orders are released after {{ $hold }} minutes.</p>

      <form method="POST" action="{{ route('orders.cancel', $order) }}" class="mt-4" onsubmit="return confirm('Cancel this order?')">
        @csrf
        <button class="text-[11px] font-mono uppercase tracking-tag text-ink/50 underline">Cancel order</button>
      </form>
    @elseif($paid)
      <p class="mt-6 text-[12px] text-sage">Paid{{ $order->paid_at ? ' on '.$order->paid_at->format('M j, Y') : '' }}. Thank you!</p>
    @elseif($cancelled)
      <p class="mt-6 text-[12px] text-brick">This order was cancelled.</p>
    @endif
  </aside>
</div>
@endsection