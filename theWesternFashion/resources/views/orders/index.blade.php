@extends('layouts.shop')
@section('title', 'My orders')

@section('content')
<h1 class="font-display text-3xl mb-8">My orders</h1>

@forelse($orders as $o)
  <a href="{{ route('orders.show', $o) }}" class="flex items-center justify-between border-b border-ink/10 py-4 hover:bg-paperdeep px-2">
    <div>
      <p class="font-mono text-[13px]">{{ $o->order_number }}</p>
      <p class="text-[12px] text-ink/50">{{ $o->created_at->format('M j, Y') }}</p>
    </div>
    <div class="text-right">
      <p class="font-mono text-[13px]">${{ number_format($o->total, 2) }}</p>
      <p class="text-[10px] font-mono uppercase tracking-tag text-ink/50">{{ $o->status }} · {{ $o->payment_status }}</p>
    </div>
  </a>
@empty
  <p class="text-ink/60">No orders yet.</p>
@endforelse

<div class="mt-6">{{ $orders->links() }}</div>
@endsection