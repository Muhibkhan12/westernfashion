@extends('layouts.shop')
@section('title', 'Your cart')

@section('content')
<h1 class="font-display text-3xl mb-8">Your cart</h1>

@if($lines->isEmpty())
  <p class="text-ink/60 mb-6">Your cart is empty.</p>
  <a href="{{ route('shop.products') }}" class="btn">Continue shopping</a>
@else
<div class="grid lg:grid-cols-[1fr_340px] gap-12">
  <div class="divide-y divide-ink/10 border-y border-ink/10">
    @foreach($lines as $l)
      <div class="flex gap-4 py-5">
        <div class="w-24 aspect-[3/4] bg-paperdeep overflow-hidden shrink-0">
          @if($l['image'])<img src="{{ $l['image'] }}" alt="" class="w-full h-full object-cover">@endif
        </div>

        <div class="flex-1">
          <p class="font-display text-[16px]">{{ $l['name'] }}</p>
          <p class="text-[11px] font-mono uppercase tracking-tag text-ink/50 mt-1">
            {{ $l['color'] ? $l['color'].' · ' : '' }}Size {{ $l['size'] }}
          </p>
          <p class="text-[13px] font-mono mt-2">${{ number_format($l['unit_price'], 2) }}</p>

          @unless($l['ok'])
            <p class="text-[12px] text-brick mt-2">{{ $l['stock'] > 0 ? "Only {$l['stock']} left." : 'Sold out.' }}</p>
          @endunless

          <div class="flex items-center gap-4 mt-3">
            <form method="POST" action="{{ route('cart.update', $l['variant_id']) }}" class="flex items-center gap-2">
              @csrf @method('PATCH')
              <input type="number" name="qty" min="0" max="10" value="{{ $l['qty'] }}" class="field !w-16 !py-1.5 text-center" aria-label="Quantity">
              <button class="text-[11px] font-mono uppercase tracking-tag underline">Update</button>
            </form>
            <form method="POST" action="{{ route('cart.destroy', $l['variant_id']) }}">
              @csrf @method('DELETE')
              <button class="text-[11px] font-mono uppercase tracking-tag text-ink/50 underline">Remove</button>
            </form>
          </div>
        </div>

        <p class="font-mono text-[14px]">${{ number_format($l['line_total'], 2) }}</p>
      </div>
    @endforeach
  </div>

  <aside class="lg:sticky lg:top-8 lg:self-start border border-ink/10 p-6">
    <dl class="space-y-3 text-[13px]">
      <div class="flex justify-between"><dt class="text-ink/60">Subtotal</dt><dd class="font-mono">${{ number_format($totals['subtotal'], 2) }}</dd></div>
      <div class="flex justify-between"><dt class="text-ink/60">Shipping</dt><dd class="font-mono">{{ $totals['shipping'] > 0 ? '$'.number_format($totals['shipping'], 2) : 'Free' }}</dd></div>
      @if(($totals['discount'] ?? 0) > 0)
        <div class="flex justify-between"><dt class="text-ink/60">Discount</dt><dd class="font-mono">−${{ number_format($totals['discount'], 2) }}</dd></div>
      @endif
      <div class="flex justify-between border-t border-ink/10 pt-3 text-[15px]"><dt>Total</dt><dd class="font-mono">${{ number_format($totals['total'], 2) }}</dd></div>
    </dl>

    @if($lines->contains(fn ($l) => ! $l['ok']))
      <button class="btn w-full mt-6" disabled>Fix stock issues to continue</button>
    @else
      <a href="{{ route('checkout.show') }}" class="btn w-full mt-6">Checkout</a>
    @endif

    <a href="{{ route('shop.products') }}" class="block text-center text-[11px] font-mono uppercase tracking-tag underline mt-4 text-ink/50">Continue shopping</a>
  </aside>
</div>
@endif
@endsection