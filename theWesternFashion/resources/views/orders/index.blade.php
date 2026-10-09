@extends('layouts.shop')
@section('title', 'My orders')

@section('content')
<div class="max-w-4xl mx-auto">

  {{-- Header --}}
  <div class="flex flex-wrap items-end justify-between gap-4 mb-8">
    <div>
      <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-3">Account</p>
      <h1 class="font-display text-3xl md:text-4xl">My orders</h1>
    </div>
    @if($orders->total())
      <p class="text-[11px] font-mono uppercase tracking-tag text-ink/50">
        {{ $orders->total() }} {{ Str::plural('order', $orders->total()) }}
      </p>
    @endif
  </div>

  @forelse($orders as $o)
    @php
      $statusStyles = [
        'delivered'  => 'bg-ink text-paper',
        'shipped'    => 'border border-ink text-ink',
        'processing' => 'bg-paperdeep text-ink/70',
        'pending'    => 'bg-paperdeep text-ink/70',
        'cancelled'  => 'border border-ink/15 text-ink/40',
      ];
      $statusKey = strtolower($o->status);
      $statusClass = $statusStyles[$statusKey] ?? 'bg-paperdeep text-ink/70';
    @endphp

    <a href="{{ route('orders.show', $o) }}"
       class="group flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-ink/10 py-5 px-2 sm:px-3 hover:bg-paperdeep/60 transition-colors">

      {{-- Left: order number + date --}}
      <div class="flex items-center gap-4 min-w-0">
        <div class="w-10 h-10 shrink-0 grid place-items-center rounded-full bg-paperdeep text-ink/40 group-hover:bg-ink group-hover:text-paper transition-colors">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 7h12l1 13H5L6 7zm3 0a3 3 0 0 1 6 0"/>
          </svg>
        </div>
        <div class="min-w-0">
          <p class="font-mono text-[13px] truncate group-hover:text-brick transition-colors">{{ $o->order_number }}</p>
          <p class="text-[12px] text-ink/50">{{ $o->created_at->format('M j, Y') }}</p>
        </div>
      </div>

      {{-- Right: total + status --}}
      <div class="flex items-center justify-between sm:justify-end gap-4 sm:gap-6 pl-14 sm:pl-0">
        <div class="text-right">
          <p class="font-mono text-[13px]">${{ number_format($o->total, 2) }}</p>
          <p class="text-[10px] font-mono uppercase tracking-tag text-ink/40">{{ $o->payment_status }}</p>
        </div>

        <span class="shrink-0 text-[10px] font-mono uppercase tracking-tag px-2.5 py-1 rounded-full {{ $statusClass }}">
          {{ $o->status }}
        </span>

        <span class="hidden sm:inline text-ink/30 group-hover:text-ink group-hover:translate-x-0.5 transition-all">→</span>
      </div>
    </a>
  @empty
    <div class="text-center py-16 md:py-24 border border-ink/10 max-w-md mx-auto">
      <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-4">Nothing yet</p>
      <h2 class="font-display text-2xl mb-3">No orders yet.</h2>
      <p class="text-[14px] text-ink/60 mb-8 max-w-xs mx-auto leading-relaxed">
        Once you place an order, it'll show up here so you can track it and reorder favorites.
      </p>
      <a href="{{ route('shop.products') }}" class="btn">Start shopping</a>
    </div>
  @endforelse

  {{-- Pagination --}}
  @if($orders->hasPages())
    <div class="mt-10">
      {{ $orders->links() }}
    </div>
  @endif

</div>
@endsection