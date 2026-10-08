<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'The Western Fashion')</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500&family=Inter+Tight:wght@400;500;600&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<script>
  tailwind.config = { theme: { extend: {
    colors: { ink: '#1C1A16', brick: '#9A3D28', sage: '#57624A', paperdeep: '#F4F4F4' },
    fontFamily: { display: ['"Fraunces"','serif'], body: ['"Inter Tight"','sans-serif'], mono: ['"Space Mono"','monospace'] }
  }}}
</script>
<style>
  body { font-family: 'Inter Tight', sans-serif; color: #1C1A16; }
  .tracking-tag { letter-spacing: .14em; }
  .field { width:100%; border:1px solid rgba(28,26,22,.2); padding:.7rem .85rem; font-size:14px; outline:none; background:#fff; }
  .field:focus { border-color:#1C1A16; }
  .btn { display:inline-block; text-align:center; background:#1C1A16; color:#fff; font-family:'Space Mono',monospace; font-size:11px; text-transform:uppercase; letter-spacing:.14em; padding:1rem 1.5rem; }
  .btn:hover { opacity:.9 } .btn:disabled { opacity:.4; cursor:not-allowed }
</style>
</head>
<body class="antialiased bg-white">
@inject('cartSvc', 'App\Services\CartService')

<header class="border-b border-ink/10">
  <div class="max-w-[1100px] mx-auto flex items-center justify-between px-6 py-4">
    <a href="{{ route('shop.products') }}" class="text-[11px] font-mono uppercase tracking-tag">← Catalog</a>
    <a href="{{ url('/') }}" class="font-display text-xl tracking-[.16em] uppercase">The Western Fashion</a>
    <div class="flex items-center gap-5 text-[11px] font-mono uppercase tracking-tag">
      @auth <a href="{{ route('orders.index') }}">Orders</a> @endauth
      <a href="{{ route('cart.index') }}">Cart ({{ $cartSvc->count() }})</a>
    </div>
  </div>
</header>

<main class="max-w-[1100px] mx-auto px-6 py-10">
  @if(session('success')) <div class="mb-6 border border-sage/40 bg-sage/10 text-sage px-4 py-3 text-[13px]">{{ session('success') }}</div> @endif
  @if(session('error'))   <div class="mb-6 border border-brick/40 bg-brick/10 text-brick px-4 py-3 text-[13px]">{{ session('error') }}</div> @endif
  @if($errors->has('cart')) <div class="mb-6 border border-brick/40 bg-brick/10 text-brick px-4 py-3 text-[13px]">{{ $errors->first('cart') }}</div> @endif
  @if($errors->has('qty') || $errors->has('variant_id'))
    <div class="mb-6 border border-brick/40 bg-brick/10 text-brick px-4 py-3 text-[13px]">
      {{ $errors->first('qty') ?: $errors->first('variant_id') }}
    </div>
  @endif
  @yield('content')
</main>
</body>
</html>