<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>My account · thewesternfashion</title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet" />

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Manrope', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            serif: ['"Instrument Serif"', 'Georgia', 'serif'],
          },
        },
      },
    };
  </script>

  <style>
    :focus-visible { outline: 2px solid #000; outline-offset: 2px; }
    .tabular { font-variant-numeric: tabular-nums; }
    @media (prefers-reduced-motion: reduce) { * { transition: none !important; } }
  </style>
</head>

@php
  $money     = fn ($n) => '$' . number_format((float) $n, 2);
  $firstName = explode(' ', trim($user->name ?? '') ?: 'there')[0];

  // status (stored in capitals) -> label + badge style
  $badge = [
    'DELIVERED'  => 'bg-black text-white',
    'SHIPPED'    => 'border border-black text-black',
    'PROCESSING' => 'border border-neutral-400 text-neutral-700',
    'CONFIRMED'  => 'bg-neutral-100 text-neutral-700',
    'PENDING'    => 'bg-neutral-100 text-neutral-700',
    'CANCELLED'  => 'border border-neutral-200 text-neutral-400',
  ];

  $cards = [
    ['Total orders',  $stats['orders'],             'All time'],
    ['In progress',   $stats['inProgress'],         'Not delivered yet'],
    ['Delivered',     $stats['delivered'],          'Arrived safely'],
    ['Total spent',   $money($stats['spent']),      'Excludes cancelled orders'],
  ];
@endphp

<body class="bg-neutral-50 font-sans text-black antialiased">

  {{-- Sidebar (its own backdrop, open/close logic and active-link highlighting are inside the partial) --}}
  @include('User.sidebar')

  <div class="lg:pl-64">

    <!-- Top bar -->
    <header class="sticky top-0 z-20 flex h-16 items-center gap-3 border-b border-neutral-200 bg-white/90 px-4 backdrop-blur sm:px-6 lg:px-8">
      <button id="menu-btn" data-sidebar-open type="button" class="rounded-md p-2 text-neutral-600 hover:bg-neutral-100 lg:hidden" aria-label="Open menu" aria-controls="sidebar">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h10"/></svg>
      </button>
      <p class="text-sm font-medium">My account</p>
      <div class="ml-auto flex items-center gap-2">
        <a href="{{ route('shop.products') }}" class="hidden items-center gap-2 rounded-lg bg-black px-3.5 py-2 text-sm font-medium text-white hover:bg-neutral-800 sm:inline-flex">
          Continue shopping
        </a>
      </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">

      <!-- Greeting -->
      <div>
        <h1 class="font-serif text-4xl tracking-tight">Welcome back, {{ $firstName }}</h1>
        <p class="mt-1 text-sm text-neutral-500">Here's a look at your orders and account.</p>
      </div>

      <!-- Stats -->
      <section class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4" aria-label="Account summary">
        @foreach ($cards as [$label, $value, $note])
          <div class="rounded-xl border border-neutral-200 bg-white p-5">
            <p class="text-sm text-neutral-500">{{ $label }}</p>
            <p class="tabular mt-2 text-3xl font-semibold tracking-tight">{{ $value }}</p>
            <p class="mt-3 text-xs text-neutral-400">{{ $note }}</p>
          </div>
        @endforeach
      </section>

      <div class="mt-4 grid gap-4 lg:grid-cols-3">

        <!-- Recent orders -->
        <div class="rounded-xl border border-neutral-200 bg-white lg:col-span-2">
          <div class="flex items-center justify-between p-6 pb-4">
            <h2 class="text-base font-semibold">Recent orders</h2>
            <a href="{{ route('orders.index') }}" class="text-sm font-medium text-neutral-500 hover:text-black">View all</a>
          </div>

          @if ($recent->isEmpty())
            <div class="px-6 pb-8 pt-2 text-center">
              <p class="text-sm text-neutral-500">You haven't placed an order yet.</p>
              <a href="{{ route('shop.products') }}" class="mt-4 inline-flex items-center rounded-lg bg-black px-4 py-2 text-sm font-medium text-white hover:bg-neutral-800">Browse jackets</a>
            </div>
          @else
            <ul class="divide-y divide-neutral-100 px-2 pb-2 sm:px-3">
              @foreach ($recent as $o)
                @php $status = strtoupper($o->status ?? 'PENDING'); $n = (int) $o->items_count; @endphp
                <li>
                  <a href="{{ route('orders.show', $o) }}" class="flex items-center justify-between gap-3 rounded-lg px-3 py-3.5 hover:bg-neutral-50">
                    <div class="min-w-0">
                      <p class="truncate font-medium">#{{ $o->order_number }}</p>
                      <p class="text-xs text-neutral-500">{{ $o->created_at->format('M j, Y') }} · {{ $n }} {{ $n === 1 ? 'item' : 'items' }}</p>
                    </div>
                    <div class="flex shrink-0 items-center gap-3">
                      <span class="rounded-full px-2.5 py-0.5 text-xs font-medium {{ $badge[$status] ?? $badge['PENDING'] }}">{{ ucfirst(strtolower($status)) }}</span>
                      <span class="tabular w-20 text-right text-sm font-medium">{{ $money($o->total) }}</span>
                    </div>
                  </a>
                </li>
              @endforeach
            </ul>
          @endif
        </div>

        <!-- Address -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 lg:self-start">
          <div class="flex items-center justify-between">
            <h2 class="text-base font-semibold">Last shipping address</h2>
            <span class="text-sm font-medium text-neutral-300" title="Coming soon">Edit</span>
          </div>

          @if ($lastOrder)
            <div class="mt-3 text-sm text-neutral-600">
              <p class="font-medium text-black">{{ $lastOrder->customer_name }}</p>
              <p>{{ $lastOrder->shipping_address }}</p>
              <p>{{ $lastOrder->shipping_city }}@if($lastOrder->shipping_state), {{ $lastOrder->shipping_state }}@endif {{ $lastOrder->shipping_postal }}</p>
              <p>{{ $lastOrder->shipping_country }}</p>
              <p class="mt-2 tabular text-neutral-500">{{ $lastOrder->customer_phone }}</p>
            </div>
            <p class="mt-4 text-xs text-neutral-400">Taken from your most recent order.</p>
          @else
            <p class="mt-3 text-sm text-neutral-500">Your address will appear here after your first order.</p>
          @endif
        </div>
      </div>

      <footer class="mt-10 pb-4 text-xs text-neutral-400">© {{ date('Y') }} thewesternfashion.</footer>
    </main>
  </div>
</body>
</html>