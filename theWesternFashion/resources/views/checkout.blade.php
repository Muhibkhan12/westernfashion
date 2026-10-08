<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Checkout — The Western Fashion</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;1,9..144,400&family=Inter+Tight:wght@400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<script>
  tailwind.config = { theme: { extend: {
    colors: { paper:'#FFFFFF', paperdeep:'#F4F4F4', ink:'#1C1A16', brick:'#9A3D28', sage:'#57624A' },
    fontFamily: { display:['"Fraunces"','serif'], body:['"Inter Tight"','sans-serif'], mono:['"Space Mono"','monospace'] }
  }}}
</script>
<style>
  html { scroll-behavior:smooth; }
  body { font-family:'Inter Tight',sans-serif; background:#fff; color:#1C1A16; }
  .font-display { font-family:'Fraunces',serif; font-variation-settings:'opsz' 40; }
  .font-display-sm { font-family:'Fraunces',serif; font-variation-settings:'opsz' 18; }
  .font-mono { font-family:'Space Mono',monospace; }
  .tracking-tag { letter-spacing:.14em; } .tracking-wordmark { letter-spacing:.16em; }
  ::selection { background:#1C1A16; color:#fff; }
  .underline-link { background-image:linear-gradient(#1C1A16,#1C1A16); background-position:0 100%; background-repeat:no-repeat; background-size:0% 1px; transition:background-size .35s ease; }
  .underline-link:hover { background-size:100% 1px; }
  .stitch { border:none; border-top:1.5px dashed rgba(28,26,22,.28); }

  [data-r] { opacity:0; transform:translateY(26px); transition:opacity .8s cubic-bezier(.2,.7,.2,1) var(--d,0s), transform .8s cubic-bezier(.2,.7,.2,1) var(--d,0s); }
  [data-r].in { opacity:1; transform:none; }

  /* floating-label fields */
  .fl { position:relative; }
  .fl input, .fl select { width:100%; border:1px solid rgba(28,26,22,.2); background:#fff; padding:1.45rem .95rem .5rem; font-size:14px; outline:none; border-radius:0; transition:border-color .2s, box-shadow .2s; appearance:none; }
  .fl input:focus, .fl select:focus { border-color:#1C1A16; box-shadow:0 0 0 4px rgba(28,26,22,.06); }
  .fl input.err, .fl select.err { border-color:#9A3D28; }
  .fl label { position:absolute; left:.95rem; top:1.05rem; font-size:14px; color:rgba(28,26,22,.5); pointer-events:none; transition:all .2s ease; }
  .fl input:focus + label, .fl input:not(:placeholder-shown) + label, .fl.sel label { top:.5rem; font-size:9.5px; letter-spacing:.12em; text-transform:uppercase; font-family:'Space Mono',monospace; }
  .fl.sel::after { content:'▾'; position:absolute; right:1rem; top:1.2rem; font-size:12px; pointer-events:none; color:rgba(28,26,22,.5); }

  .btn-main { background:#1C1A16; color:#fff; border:1px solid #1C1A16; transition:all .3s ease; }
  .btn-main:hover:not(:disabled) { background:#fff; color:#1C1A16; }
  .btn-main:disabled { opacity:.55; cursor:wait; }
  @keyframes spin { to { transform:rotate(360deg); } } .spin { animation:spin .8s linear infinite; }
  @media (prefers-reduced-motion:reduce) { [data-r] { opacity:1; transform:none; transition:none; } }
</style>
</head>
<body class="antialiased bg-white">

@php
  $free  = \App\Services\CartService::FREE_SHIPPING_OVER;
  $left  = max(0, $free - $totals['subtotal']);
  $pct   = min(100, round($totals['subtotal'] / $free * 100));
  $hold  = \App\Services\OrderService::UNPAID_EXPIRY_MINUTES;
  $count = $lines->sum('qty');

  // [name, label, type, default, grid span, autocomplete, required]
  $groups = [
    ['01', 'Contact', [
      ['customer_name',  'Full name', 'text',  $user->name,  'sm:col-span-3', 'name',  true],
      ['customer_phone', 'Phone',     'tel',   '',           'sm:col-span-3', 'tel',   true],
      ['customer_email', 'Email',     'email', $user->email, 'sm:col-span-6', 'email', true],
    ]],
    ['02', 'Shipping address', [
      ['shipping_address', 'Address (street, apartment, suite)', 'text', '', 'sm:col-span-6', 'street-address', true],
      ['shipping_city',    'City',              'text', '', 'sm:col-span-2', 'address-level2', true],
      ['shipping_state',   'State / Province',  'text', '', 'sm:col-span-2', 'address-level1', false],
      ['shipping_postal',  'Postal code',       'text', '', 'sm:col-span-2', 'postal-code',    true],
      ['shipping_country', 'Country',           'select', '', 'sm:col-span-6', 'country',      true],
    ]],
  ];
@endphp

<div class="bg-ink text-paper text-[11px] font-mono tracking-tag uppercase text-center py-2 px-4">
  Free shipping on orders over ${{ number_format($free, 0) }} — 30-day easy returns
</div>

<!-- Header -->
<header class="border-b border-ink/10 bg-white/90 backdrop-blur-md sticky top-0 z-40">
  <div class="max-w-[1200px] mx-auto flex items-center justify-between px-6 md:px-10 py-4">
    <a href="{{ route('cart.index') }}" class="text-[11px] font-mono uppercase tracking-tag underline-link">← Back to cart</a>
    <a href="{{ url('/') }}" class="font-display text-lg sm:text-xl md:text-2xl tracking-wordmark uppercase whitespace-nowrap">The Western Fashion</a>
    <span class="flex items-center gap-1.5 text-[11px] font-mono uppercase tracking-tag text-ink/60">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="10" width="18" height="10" rx="1.5"/><path d="M7 10V7a5 5 0 0 1 10 0v3"/></svg>
      <span class="hidden sm:inline">Secure</span>
    </span>
  </div>
</header>

<main class="max-w-[1200px] mx-auto px-6 md:px-10 pt-10 pb-24">

  <!-- Stepper -->
  <ol class="flex items-center gap-3 text-[11px] font-mono uppercase tracking-tag mb-10" data-r>
    <li class="flex items-center gap-2 text-ink/40"><span class="w-6 h-6 rounded-full bg-sage text-white flex items-center justify-center">✓</span> Cart</li>
    <li class="flex-1 max-w-16 stitch"></li>
    <li class="flex items-center gap-2"><span class="w-6 h-6 rounded-full bg-ink text-white flex items-center justify-center">2</span> Details</li>
    <li class="flex-1 max-w-16 stitch"></li>
    <li class="flex items-center gap-2 text-ink/40"><span class="w-6 h-6 rounded-full border border-ink/25 flex items-center justify-center">3</span> Payment</li>
  </ol>

  <div class="mb-10" data-r style="--d:.05s">
    <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-3">Almost there</p>
    <h1 class="font-display text-4xl md:text-5xl">Checkout</h1>
  </div>

  {{-- Messages --}}
  @if(session('error'))
    <div class="mb-6 border border-brick/40 bg-brick/10 text-brick px-4 py-3 text-[13px]">{{ session('error') }}</div>
  @endif
  @if($errors->has('cart'))
    <div class="mb-6 border border-brick/40 bg-brick/10 text-brick px-4 py-3 text-[13px]">{{ $errors->first('cart') }}</div>
  @endif
  @if($errors->any() && ! $errors->has('cart'))
    <div class="mb-6 border border-brick/40 bg-brick/10 text-brick px-4 py-3 text-[13px]">Please fix the highlighted fields below.</div>
  @endif

  <div class="grid lg:grid-cols-[1fr_400px] gap-12 lg:gap-16 items-start">

    <!-- Form -->
    <form method="POST" action="{{ route('checkout.store') }}" id="checkoutForm" class="space-y-12" novalidate>
      @csrf

      @foreach($groups as $gi => [$num, $title, $fields])
        <section data-r style="--d:{{ .1 + $gi * .08 }}s">
          <div class="flex items-baseline gap-4 mb-6">
            <span class="text-[11px] font-mono text-brick">{{ $num }}</span>
            <h2 class="font-display text-2xl">{{ $title }}</h2>
            <span class="flex-1 stitch self-center"></span>
          </div>

          <div class="grid sm:grid-cols-6 gap-4">
            @foreach($fields as [$name, $label, $type, $default, $span, $ac, $req])
              <div class="fl {{ $span }} {{ $type === 'select' ? 'sel' : '' }}">
                @if($type === 'select')
                  <select id="{{ $name }}" name="{{ $name }}" autocomplete="{{ $ac }}" @required($req) class="@error($name) err @enderror">
                    <option value="">Select country</option>
                    @foreach($countries as $code => $cname)
                      <option value="{{ $code }}" @selected(old($name) === $code)>{{ $cname }}</option>
                    @endforeach
                  </select>
                  <label for="{{ $name }}">{{ $label }}</label>
                @else
                  <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" placeholder=" " autocomplete="{{ $ac }}"
                         value="{{ old($name, $default) }}" @required($req) class="@error($name) err @enderror">
                  <label for="{{ $name }}">{{ $label }}</label>
                @endif
                @error($name)<p class="text-brick text-[12px] mt-1.5">{{ $message }}</p>@enderror
              </div>
            @endforeach
          </div>
        </section>
      @endforeach

      <!-- Payment note -->
      <section data-r style="--d:.26s">
        <div class="flex items-baseline gap-4 mb-6">
          <span class="text-[11px] font-mono text-brick">03</span>
          <h2 class="font-display text-2xl">Payment</h2>
          <span class="flex-1 stitch self-center"></span>
        </div>
        <div class="bg-paperdeep p-5 flex items-start gap-4">
          <svg class="shrink-0 mt-0.5" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="10" width="18" height="10" rx="1.5"/><path d="M7 10V7a5 5 0 0 1 10 0v3"/></svg>
          <div class="text-[13px] leading-relaxed text-ink/70">
            <p class="text-ink font-medium mb-1">Pay securely on the next step</p>
            We save your order first, then take you to payment. Your items are held for {{ $hold }} minutes while you pay.
          </div>
        </div>
      </section>
    </form>

    <!-- Summary -->
    <aside class="lg:sticky lg:top-24" data-r style="--d:.15s">
      <div class="border border-ink/10 p-6 md:p-7">
        <div class="flex items-center justify-between mb-5">
          <h2 class="font-display text-2xl">Order summary</h2>
          <span class="text-[11px] font-mono uppercase tracking-tag text-ink/50">{{ $count }} {{ $count === 1 ? 'item' : 'items' }}</span>
        </div>

        <ul class="space-y-4 mb-6 max-h-[320px] overflow-y-auto pr-1">
          @foreach($lines as $l)
            <li class="flex gap-4">
              <div class="relative w-16 aspect-[3/4] bg-paperdeep shrink-0">
                @if($l['image'])<img src="{{ $l['image'] }}" alt="" class="w-full h-full object-cover">@endif
                <span class="absolute -top-2 -right-2 w-5 h-5 rounded-full bg-ink text-white text-[10px] font-mono flex items-center justify-center">{{ $l['qty'] }}</span>
              </div>
              <div class="flex-1 min-w-0">
                <p class="font-display-sm text-[15px] truncate">{{ $l['name'] }}</p>
                <p class="text-[11px] font-mono uppercase tracking-tag text-ink/50 mt-1">{{ $l['color'] ? $l['color'].' · ' : '' }}Size {{ $l['size'] }}</p>
              </div>
              <p class="font-mono text-[13px]">${{ number_format($l['line_total'], 2) }}</p>
            </li>
          @endforeach
        </ul>

        <!-- Free shipping progress -->
        <div class="mb-6">
          <p class="text-[12px] text-ink/70 mb-2">
            @if($left > 0) Add <b class="font-mono">${{ number_format($left, 2) }}</b> more for free shipping @else <span class="text-sage font-medium">You've unlocked free shipping ✓</span> @endif
          </p>
          <div class="h-1 bg-ink/10 overflow-hidden"><div id="bar" class="h-full bg-sage transition-all duration-[1400ms] ease-out" style="width:0" data-w="{{ $pct }}"></div></div>
        </div>

        <hr class="stitch mb-5">

        <dl class="space-y-3 text-[13px]">
          <div class="flex justify-between"><dt class="text-ink/60">Subtotal</dt><dd class="font-mono">${{ number_format($totals['subtotal'], 2) }}</dd></div>
          <div class="flex justify-between"><dt class="text-ink/60">Shipping</dt><dd class="font-mono">{{ $totals['shipping'] > 0 ? '$'.number_format($totals['shipping'], 2) : 'Free' }}</dd></div>
          @if(($totals['discount'] ?? 0) > 0)
            <div class="flex justify-between"><dt class="text-ink/60">Discount</dt><dd class="font-mono text-sage">−${{ number_format($totals['discount'], 2) }}</dd></div>
          @endif
          <div class="flex justify-between border-t border-ink/10 pt-4 text-[17px]"><dt class="font-display-sm">Total</dt><dd class="font-mono">${{ number_format($totals['total'], 2) }}</dd></div>
        </dl>

        <button type="submit" form="checkoutForm" id="placeBtn"
                class="btn-main w-full mt-7 py-4 text-[11px] font-mono uppercase tracking-tag flex items-center justify-center gap-2">
          <span id="placeLabel">Place order · ${{ number_format($totals['total'], 2) }}</span>
          <svg id="placeSpin" class="spin hidden" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12a9 9 0 1 1-6.2-8.55"/></svg>
        </button>

        <ul class="mt-6 space-y-2 text-[12px] font-mono text-ink/50">
          <li>— 30-day easy returns</li>
          <li>— Encrypted, secure checkout</li>
          <li>— Midseason sale auto-applied</li>
        </ul>
      </div>
    </aside>
  </div>
</main>

<footer class="border-t border-ink/10 py-5 text-center text-[11px] font-mono text-ink/40 tracking-tag uppercase">
  © {{ date('Y') }} The Western Fashion. All rights reserved.
</footer>

<script>
  // reveal on scroll
  const io = new IntersectionObserver((es) => es.forEach(e => {
    if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); }
  }), { threshold: .1 });
  document.querySelectorAll('[data-r]').forEach(el => io.observe(el));

  // animate the free-shipping bar
  const bar = document.getElementById('bar');
  requestAnimationFrame(() => setTimeout(() => bar.style.width = bar.dataset.w + '%', 400));

  // block double submits
  const form = document.getElementById('checkoutForm');
  form.addEventListener('submit', (e) => {
    if (!form.checkValidity()) { e.preventDefault(); form.reportValidity(); return; }
    const btn = document.getElementById('placeBtn');
    btn.disabled = true;
    document.getElementById('placeLabel').textContent = 'Placing order…';
    document.getElementById('placeSpin').classList.remove('hidden');
  });

  // scroll to the first field with an error
  const firstErr = document.querySelector('.err');
  if (firstErr) firstErr.scrollIntoView({ behavior: 'smooth', block: 'center' });
</script>
</body>
</html>