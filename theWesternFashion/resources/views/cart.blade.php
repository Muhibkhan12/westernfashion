@extends('layouts.shop')
@section('title', 'Your cart')

@section('content')
<div class="max-w-[1440px] mx-auto px-6 md:px-10 py-10 md:py-16">

  {{-- Header --}}
  <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-10 md:mb-14">
    <div>
      <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-3">Bag</p>
      <h1 class="font-display text-3xl md:text-4xl">Your cart</h1>
    </div>
    @if(!$lines->isEmpty())
      <p class="text-[12px] font-mono uppercase tracking-tag text-ink/50">
        {{ $lines->sum('qty') }} {{ Str::plural('item', $lines->sum('qty')) }}
      </p>
    @endif
  </div>

  @if($lines->isEmpty())
    {{-- Empty state --}}
    <div class="max-w-md mx-auto text-center py-16 md:py-24 border border-ink/10">
      <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-5">Nothing here yet</p>
      <h2 class="font-display text-2xl md:text-3xl mb-4">Your cart is empty.</h2>
      <p class="text-[14px] text-ink/60 leading-relaxed mb-8 max-w-xs mx-auto">
        Browse our latest jackets and find something worth wearing for years.
      </p>
      <a href="{{ route('shop.products') }}" class="btn">Continue shopping</a>
    </div>
  @else
    <div class="grid lg:grid-cols-[1fr_360px] gap-12 lg:gap-16 items-start">

      {{-- Cart lines --}}
      <div>
        {{-- Desktop column labels --}}
        <div class="hidden md:grid grid-cols-[1fr_120px_100px] gap-4 pb-3 border-b border-ink/10 text-[10px] font-mono uppercase tracking-tag text-ink/40">
          <span>Item</span>
          <span class="text-center">Quantity</span>
          <span class="text-right">Total</span>
        </div>

        <div class="divide-y divide-ink/10 border-b border-ink/10">
          @foreach($lines as $l)
            <div class="py-6 md:py-7 grid grid-cols-1 md:grid-cols-[1fr_120px_100px] gap-4 md:gap-4 items-start">

              {{-- Product --}}
              <div class="flex gap-4 md:gap-5">
                <a href="{{ route('shop.products') }}" class="w-24 md:w-28 aspect-[3/4] bg-paperdeep overflow-hidden shrink-0 group">
                  @if($l['image'])
                    <img src="{{ $l['image'] }}" alt="{{ $l['name'] }}"
                         class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                  @endif
                </a>

                <div class="flex-1 min-w-0">
                  <div class="flex items-start justify-between gap-3">
                    <a href="{{ route('shop.products') }}" class="font-display text-[16px] md:text-[17px] leading-snug hover:text-brick transition">
                      {{ $l['name'] }}
                    </a>
                    <p class="font-mono text-[14px] md:hidden whitespace-nowrap">${{ number_format($l['line_total'], 2) }}</p>
                  </div>

                  <p class="text-[11px] font-mono uppercase tracking-tag text-ink/50 mt-1.5">
                    {{ $l['color'] ? $l['color'].' · ' : '' }}Size {{ $l['size'] }}
                  </p>
                  <p class="text-[13px] font-mono mt-2 text-ink/70">${{ number_format($l['unit_price'], 2) }}</p>

                  @unless($l['ok'])
                    <p class="inline-flex items-center gap-1.5 text-[11px] font-mono uppercase tracking-tag text-brick mt-3">
                      <span class="w-1.5 h-1.5 rounded-full bg-brick"></span>
                      {{ $l['stock'] > 0 ? "Only {$l['stock']} left" : 'Sold out' }}
                    </p>
                  @endunless

                  {{-- Mobile quantity + remove --}}
                  <div class="flex items-center gap-5 mt-4 md:hidden">
                    <form method="POST" action="{{ route('cart.update', $l['variant_id']) }}" class="flex items-center gap-2">
                      @csrf @method('PATCH')
                      <input type="number" name="qty" min="0" max="10" value="{{ $l['qty'] }}"
                             class="field !w-16 !py-1.5 text-center" aria-label="Quantity">
                      <button class="text-[11px] font-mono uppercase tracking-tag underline">Update</button>
                    </form>
                    <form method="POST" action="{{ route('cart.destroy', $l['variant_id']) }}">
                      @csrf @method('DELETE')
                      <button class="text-[11px] font-mono uppercase tracking-tag text-ink/50 underline">Remove</button>
                    </form>
                  </div>
                </div>
              </div>

              {{-- Desktop quantity --}}
              <div class="hidden md:flex justify-center pt-1">
                <form method="POST" action="{{ route('cart.update', $l['variant_id']) }}" class="flex items-center gap-2">
                  @csrf @method('PATCH')
                  <input type="number" name="qty" min="0" max="10" value="{{ $l['qty'] }}"
                         class="field !w-16 !py-1.5 text-center" aria-label="Quantity">
                  <button class="text-[11px] font-mono uppercase tracking-tag underline">Update</button>
                </form>
              </div>

              {{-- Desktop total --}}
              <div class="hidden md:flex flex-col items-end gap-3 pt-1">
                <p class="font-mono text-[14px]">${{ number_format($l['line_total'], 2) }}</p>
                <form method="POST" action="{{ route('cart.destroy', $l['variant_id']) }}">
                  @csrf @method('DELETE')
                  <button class="text-[11px] font-mono uppercase tracking-tag text-ink/50 underline hover:text-brick transition">Remove</button>
                </form>
              </div>

            </div>
          @endforeach
        </div>

        {{-- Continue shopping (left) --}}
        <div class="mt-6">
          <a href="{{ route('shop.products') }}" class="inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-tag ul pb-0.5">
            <span>←</span> Continue shopping
          </a>
        </div>
      </div>

      {{-- Order summary --}}
      <aside class="lg:sticky lg:top-8 border border-ink/10 p-6 md:p-7 bg-white">
        <h2 class="font-display text-xl mb-6">Order summary</h2>

        <dl class="space-y-3.5 text-[13px]">
          <div class="flex justify-between">
            <dt class="text-ink/60">Subtotal</dt>
            <dd class="font-mono">${{ number_format($totals['subtotal'], 2) }}</dd>
          </div>
          <div class="flex justify-between">
            <dt class="text-ink/60">Shipping</dt>
            <dd class="font-mono">{{ $totals['shipping'] > 0 ? '$'.number_format($totals['shipping'], 2) : 'Free' }}</dd>
          </div>
          @if(($totals['discount'] ?? 0) > 0)
            <div class="flex justify-between text-brick">
              <dt>Discount</dt>
              <dd class="font-mono">−${{ number_format($totals['discount'], 2) }}</dd>
            </div>
          @endif
          <div class="flex justify-between border-t border-ink/10 pt-4 text-[15px]">
            <dt>Total</dt>
            <dd class="font-mono">${{ number_format($totals['total'], 2) }}</dd>
          </div>
        </dl>

        @if($lines->contains(fn ($l) => ! $l['ok']))
          <button class="btn w-full mt-7" disabled>Fix stock issues to continue</button>
          <p class="text-[11px] font-mono uppercase tracking-tag text-brick text-center mt-3">
            Some items are unavailable
          </p>
        @else
          <a href="{{ route('checkout.show') }}" class="btn w-full mt-7">Checkout</a>
        @endif

        {{-- Trust badges --}}
        <ul class="mt-6 pt-6 border-t border-ink/10 space-y-2.5 text-[11px] font-mono uppercase tracking-tag text-ink/50">
          <li class="flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-brick"></span> Free shipping over $150</li>
          <li class="flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-brick"></span> 30-day returns</li>
          <li class="flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-brick"></span> Encrypted checkout</li>
        </ul>
      </aside>

    </div>
  @endif
</div>
@endsection