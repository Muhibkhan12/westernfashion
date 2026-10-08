<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>The Western Fashion — A Capsule Collection</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,400;0,9..144,500;1,9..144,400;1,9..144,500&family=Inter+Tight:wght@400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<script>
  tailwind.config = { theme: { extend: {
    colors: { paper:'#FFFFFF', paperdeep:'#F4F4F4', ink:'#1C1A16', brick:'#9A3D28', sage:'#57624A', card:'#FFFFFF' },
    fontFamily: { display:['"Fraunces"','serif'], body:['"Inter Tight"','sans-serif'], mono:['"Space Mono"','monospace'] }
  }}}
</script>
<style>
  body { font-family:'Inter Tight',sans-serif; background:#fff; color:#1C1A16; overflow-x:hidden; }
  .font-display { font-family:'Fraunces',serif; font-variation-settings:'opsz' 40; }
  .font-display-sm { font-family:'Fraunces',serif; font-variation-settings:'opsz' 18; }
  .font-mono { font-family:'Space Mono',monospace; }
  .tracking-tag { letter-spacing:.14em; } .tracking-wordmark { letter-spacing:.16em; }
  ::selection { background:#1C1A16; color:#fff; }
  html.lenis, html.lenis body { height:auto; } .lenis.lenis-smooth { scroll-behavior:auto!important; }
  html:not(.lenis) { scroll-behavior:smooth; }

  .underline-link { background-image:linear-gradient(#1C1A16,#1C1A16); background-position:0 100%; background-repeat:no-repeat; background-size:0% 1px; transition:background-size .35s ease; }
  .underline-link:hover { background-size:100% 1px; }
  .stitch { border:none; border-top:1.5px dashed rgba(28,26,22,.28); }
  .hang-tag { position:relative; padding-left:20px; }
  .hang-tag::before { content:''; position:absolute; left:7px; top:50%; transform:translateY(-50%); width:5px; height:5px; border-radius:50%; background:currentColor; opacity:.55; }

  /* reveal on scroll */
  [data-r] { opacity:0; transform:translateY(32px); transition:opacity .9s cubic-bezier(.2,.7,.2,1) var(--d,0s), transform .9s cubic-bezier(.2,.7,.2,1) var(--d,0s); }
  [data-r=left] { transform:translateX(-36px); } [data-r=zoom] { transform:scale(.94); }
  [data-r].in { opacity:1; transform:none; }
  .mask { clip-path:inset(0 0 100% 0); transition:clip-path 1.3s cubic-bezier(.77,0,.18,1); }
  .mask.in { clip-path:inset(0); }

  /* hero headline line-by-line */
  .line { display:block; overflow:hidden; padding-bottom:.08em; }
  .line > span { display:block; transform:translateY(110%); animation:up 1.1s cubic-bezier(.2,.7,.2,1) forwards; animation-delay:calc(.25s + var(--i) * .13s); }
  @keyframes up { to { transform:none; } }
  .fade-in { opacity:0; animation:fi 1s ease forwards; animation-delay:var(--d,0s); } @keyframes fi { to { opacity:1; } }

  .yoke-path { stroke-dasharray:1600; stroke-dashoffset:1600; animation:draw 2.4s cubic-bezier(.65,0,.35,1) .4s forwards; }
  @keyframes draw { to { stroke-dashoffset:0; } }

  .par { position:absolute; left:0; width:100%; height:100%; object-fit:cover; transform:scale(1.2); will-change:transform; }
  .marquee { display:flex; width:max-content; animation:mq 38s linear infinite; } @keyframes mq { to { transform:translateX(-50%); } }
  .scroll-cue::after { content:''; display:block; width:1px; height:46px; margin:10px auto 0; background:linear-gradient(#fff,transparent); animation:cue 1.8s ease-in-out infinite; transform-origin:top; }
  @keyframes cue { 0% { transform:scaleY(0); } 50% { transform:scaleY(1); } 100% { transform:scaleY(1); opacity:0; } }

  #hdr { transition:transform .5s cubic-bezier(.2,.7,.2,1), box-shadow .3s; } #hdr.hide { transform:translateY(-100%); } #hdr.stuck { box-shadow:0 8px 30px -18px rgba(28,26,22,.35); }
  #menu { clip-path:circle(0 at 28px 28px); transition:clip-path .8s cubic-bezier(.77,0,.18,1); pointer-events:none; }
  #menu.open { clip-path:circle(150% at 28px 28px); pointer-events:auto; }
  #menu a { opacity:0; transform:translateY(24px); transition:.6s cubic-bezier(.2,.7,.2,1); } #menu.open a { opacity:1; transform:none; transition-delay:calc(.3s + var(--i) * .08s); }

  .filter-pill { transition:all .3s ease; } .filter-pill.active { background:#1C1A16; color:#fff; border-color:#1C1A16; }
  #grid { transition:opacity .25s ease, transform .25s ease; } #grid.out { opacity:0; transform:translateY(10px); }
  .star { color:#1C1A16; } .star.empty { color:rgba(28,26,22,.2); }
  #reviewTrack { scroll-snap-type:x mandatory; scrollbar-width:none; } #reviewTrack::-webkit-scrollbar { display:none; }
  .review-slide { scroll-snap-align:center; transition:transform .5s ease; } .review-slide:hover { transform:translateY(-6px); }
  .review-dot { height:6px; width:6px; border-radius:3px; background:rgba(28,26,22,.25); transition:all .3s ease; } .review-dot.active { background:#1C1A16; width:22px; }

  @media (prefers-reduced-motion:reduce) {
    [data-r], .line > span, .fade-in { opacity:1; transform:none; animation:none; transition:none; } .mask { clip-path:none; }
    .yoke-path { stroke-dashoffset:0; animation:none; } .marquee { animation:none; } .par { transform:none; }
  }
</style>
</head>
<body class="antialiased bg-white">

<div id="progress" class="fixed top-0 left-0 h-[2px] bg-brick z-[70] w-full origin-left" style="transform:scaleX(0)"></div>

<!-- Fullscreen menu -->
<div id="menu" class="fixed inset-0 z-[60] bg-ink text-paper flex flex-col justify-center px-8 md:px-20">
  <button id="menuClose" class="absolute top-6 left-6 text-[11px] font-mono uppercase tracking-tag">✕ Close</button>
  <nav class="space-y-4">
    <a style="--i:0" href="{{ route('shop.products') }}" class="block font-display text-5xl md:text-7xl">Catalog</a>
    <a style="--i:1" href="{{ url('/about') }}" class="block font-display text-5xl md:text-7xl">About</a>
    <a style="--i:2" href="{{ url('/contact') }}" class="block font-display text-5xl md:text-7xl">Contact</a>
    <a style="--i:3" href="{{ route('cart.index') }}" class="block font-display text-5xl md:text-7xl text-paper/50">Cart</a>
  </nav>
</div>

<div class="bg-ink text-paper text-[11px] font-mono tracking-tag uppercase text-center py-2 px-4">
  Midseason Sale — 20% Off, Auto-Applied at Checkout — Limited Time
</div>

<!-- Header -->
<header id="hdr" class="sticky top-0 z-40 bg-white/90 backdrop-blur-md border-b border-ink/10">
  <div class="max-w-[1440px] mx-auto flex items-center justify-between px-6 md:px-10 py-4">
    <div class="flex items-center gap-6">
      <button id="menuBtn" aria-label="Menu" class="flex items-center gap-2 text-[11px] font-mono uppercase tracking-tag">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
      </button>
      <nav class="hidden md:flex items-center gap-6 text-[11px] font-mono uppercase tracking-tag">
        <a href="{{ route('shop.products') }}" class="underline-link pb-0.5">Catalog</a>
        <a href="{{ url('/about') }}" class="underline-link pb-0.5">About</a>
        <a href="{{ url('/contact') }}" class="underline-link pb-0.5">Contact</a>
      </nav>
    </div>
    <a href="{{ url('/') }}" class="font-display text-lg sm:text-xl md:text-2xl tracking-wordmark uppercase whitespace-nowrap">The Western Fashion</a>
    <div class="flex items-center gap-4 md:gap-5 text-[11px] font-mono uppercase tracking-tag">
      <button id="darkToggle" class="hidden sm:flex items-center gap-1.5">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
        <span class="hidden lg:inline">Dark</span>
      </button>
      <a href="{{ route('orders.index') }}" aria-label="Account">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4.4 3.6-8 8-8s8 3.6 8 8"/></svg>
      </a>
      <a href="{{ route('cart.index') }}" aria-label="Cart" class="relative">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 6h15l-1.5 9h-12z"/><path d="M6 6 5 3H2"/><circle cx="9" cy="20" r="1"/><circle cx="18" cy="20" r="1"/></svg>
        <span class="absolute -top-2 -right-3 text-[10px] font-mono">{{ app(\App\Services\CartService::class)->count() ?: '' }}</span>
      </a>
    </div>
  </div>
</header>

<!-- Hero -->
<section class="relative h-[640px] md:h-[780px] overflow-hidden bg-ink">
  <img data-p="0.18" class="par" src="https://images.unsplash.com/photo-1551028719-00167b16eac5?q=80&w=1800&auto=format&fit=crop" alt="Model wearing a quilted field jacket">
  <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/25 to-black/45"></div>

  <div class="relative z-10 h-full max-w-[1440px] mx-auto px-6 md:px-10 flex flex-col justify-end pb-24 md:pb-32 text-paper">
    <p class="fade-in text-[11px] font-mono tracking-tag uppercase text-paper/70 mb-6" style="--d:.2s">Capsule № 04 — AW '23</p>
    <h1 class="font-display text-5xl sm:text-6xl md:text-[5.5rem] leading-[1.02] mb-9 max-w-3xl">
      <span class="line" style="--i:0"><span>A Jacket Capsule</span></span>
      <span class="line" style="--i:1"><span>by <em class="italic">Michael Brooks</em></span></span>
    </h1>
    <div class="fade-in flex flex-wrap items-center gap-6" style="--d:1s">
      <a href="{{ route('shop.products') }}" class="group inline-flex items-center gap-3 bg-paper text-ink text-[11px] font-mono uppercase tracking-tag px-8 py-4 hover:bg-ink hover:text-paper border border-paper transition duration-300">
        Explore Collection <span class="transition-transform duration-300 group-hover:translate-x-1">→</span>
      </a>
      <a href="#new" class="text-[11px] font-mono uppercase tracking-tag underline-link text-paper" style="background-image:linear-gradient(#fff,#fff)">New in</a>
    </div>
  </div>

  <div class="scroll-cue hidden md:block absolute right-10 bottom-28 z-10 text-[10px] font-mono uppercase tracking-tag text-paper/70 text-center [writing-mode:vertical-rl] rotate-180">Scroll</div>

  <div class="absolute bottom-0 left-0 right-0 z-10">
    <svg viewBox="0 0 1440 70" class="w-full h-[46px] md:h-[70px]" preserveAspectRatio="none">
      <path class="yoke-path" d="M0,55 C 180,55 220,15 360,15 C 500,15 540,55 720,55 C 900,55 940,15 1080,15 C 1220,15 1260,55 1440,55" fill="none" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" opacity=".8"/>
      <path class="yoke-path" d="M0,63 C 180,63 220,23 360,23 C 500,23 540,63 720,63 C 900,63 940,23 1080,23 C 1220,23 1260,63 1440,63" fill="none" stroke="#FFFFFF" stroke-width="1.5" stroke-dasharray="1 9" stroke-linecap="round" opacity=".65"/>
    </svg>
  </div>
</section>

<!-- Marquee -->
<section class="border-b border-ink/10 overflow-hidden py-4 bg-white">
  <div class="marquee text-[11px] font-mono uppercase tracking-tag text-ink/70" id="mq"></div>
</section>

<!-- Trust bar -->
<section class="border-b border-ink/10">
  <div class="max-w-[1440px] mx-auto px-6 md:px-10 py-8 grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8" id="trust"></div>
</section>

<!-- New arrivals (bento) -->
<section id="new" class="max-w-[1440px] mx-auto px-6 md:px-10 pt-20 pb-8">
  <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12" data-r>
    <div>
      <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-4">Just Landed</p>
      <h2 class="font-display text-4xl md:text-5xl">New Jackets</h2>
    </div>
    <a href="{{ route('shop.products') }}" class="text-[11px] font-mono uppercase tracking-tag underline-link self-start md:self-auto">Shop New In</a>
  </div>
  <div id="new-grid" class="grid grid-cols-2 md:grid-cols-3 gap-x-5 gap-y-10"></div>
</section>

<!-- Promo banner -->
<section class="relative h-[360px] md:h-[460px] overflow-hidden my-20 mask" data-reveal-mask>
  <img data-p="0.14" class="par" src="https://images.unsplash.com/photo-1548624149-f9061a9a2151?q=80&w=1800&auto=format&fit=crop" alt="Model wearing an outerwear jacket">
  <div class="absolute inset-0 bg-black/45"></div>
  <div class="relative z-10 h-full flex flex-col items-center justify-center text-center px-6 text-paper">
    <p class="text-[11px] font-mono tracking-tag uppercase text-paper/70 mb-4" data-r>Outerwear Edit</p>
    <h3 class="font-display text-4xl md:text-6xl mb-8 max-w-xl leading-tight" data-r style="--d:.1s">Extra 20% Off All Jackets</h3>
    <a href="{{ route('shop.products') }}" class="bg-paper text-ink text-[11px] font-mono uppercase tracking-tag px-8 py-4 border border-paper hover:bg-transparent hover:text-paper transition duration-300" data-r style="--d:.2s">Shop the Sale →</a>
  </div>
</section>

<!-- Featured split -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 py-16 md:py-24 grid grid-cols-1 md:grid-cols-2 gap-14 md:gap-20 items-center">
  <div data-r="left">
    <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-4">Featured Items</p>
    <h2 class="font-display text-3xl md:text-5xl leading-[1.1] mb-10 max-w-md">Under-the-radar jackets, consciously made for comfort, style, and elegance.</h2>
    <ul class="max-w-sm">
      @foreach(["Women's Jackets", "Men's Jackets", "All Jackets"] as $n)
        <li class="stitch"><a href="{{ route('shop.products') }}" class="group flex items-center justify-between py-5 text-lg font-display-sm hover:pl-3 transition-all duration-300">{{ $n }} <span class="font-mono text-sm transition-transform duration-300 group-hover:translate-x-1 group-hover:-translate-y-1">↗</span></a></li>
      @endforeach
    </ul>
  </div>
  <div class="relative" data-r="zoom">
    <div class="relative h-[480px] md:h-[600px] overflow-hidden bg-paperdeep">
      <img data-p="0.1" class="par" src="https://images.unsplash.com/photo-1521223890158-f9f7c3d5d504?q=80&w=900&auto=format&fit=crop" alt="Cropped leather jacket">
      <span class="hang-tag absolute top-4 left-4 bg-white/95 text-[10px] font-mono uppercase tracking-tag px-4 py-2 z-10">Quick View</span>
    </div>
    <div class="absolute -bottom-6 left-6 right-6 md:left-10 md:right-10 bg-white shadow-lg px-5 py-4 flex items-center justify-between">
      <div>
        <p class="text-[10px] font-mono uppercase tracking-tag text-ink/50 mb-1">The Western Fashion</p>
        <p class="text-[15px] font-display-sm underline-link">Cropped Leather Jacket</p>
      </div>
      <span class="text-[15px] font-mono">$400.00</span>
    </div>
  </div>
</section>

<!-- Best sellers -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 pt-20 pb-24">
  <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-8" data-r>
    <div>
      <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-4">Customer Favorites</p>
      <h2 class="font-display text-4xl md:text-5xl">Best Selling Jackets</h2>
    </div>
    <a href="{{ route('shop.products') }}" class="text-[11px] font-mono uppercase tracking-tag underline-link self-start md:self-auto">View All</a>
  </div>
  <div id="filters" class="flex flex-wrap gap-2 mb-10" data-r></div>
  <div id="grid" class="grid grid-cols-2 md:grid-cols-4 gap-x-5 gap-y-12"></div>
</section>

<!-- Brand story + counters -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 py-16 md:py-24 grid grid-cols-1 md:grid-cols-2 gap-14 md:gap-20 items-center">
  <div class="relative h-[420px] md:h-[560px] overflow-hidden mask order-2 md:order-1" data-reveal-mask>
    <img data-p="0.12" class="par" src="https://images.unsplash.com/photo-1544441893-675973e31985?q=80&w=900&auto=format&fit=crop" alt="A shearling aviator jacket in the workshop">
  </div>
  <div class="order-1 md:order-2" data-r>
    <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-4">Our Story</p>
    <h2 class="font-display text-3xl md:text-5xl leading-[1.1] mb-6 max-w-md">Built on quiet craftsmanship, one small run of jackets at a time.</h2>
    <p class="text-[14px] leading-relaxed text-ink/70 mb-4 max-w-md">The Western Fashion began in a single-room Portland workshop in 2016, where founder Michael Brooks set out to make jackets that lasted longer than a season. Every piece is still cut, sewn, and finished in small batches by the same close-knit team.</p>
    <p class="text-[14px] leading-relaxed text-ink/70 mb-10 max-w-md">We work with mills we've known for years, favor natural fibers over synthetics, and would rather make less and make it well.</p>
    <div class="grid grid-cols-3 gap-4 max-w-md stitch pt-8 mb-8">
      <div><p class="font-display text-4xl"><span data-count="10">0</span>+</p><p class="text-[10px] font-mono uppercase tracking-tag text-ink/50 mt-1">Years</p></div>
      <div><p class="font-display text-4xl"><span data-count="4.8" data-dec="1">0</span></p><p class="text-[10px] font-mono uppercase tracking-tag text-ink/50 mt-1">Avg rating</p></div>
      <div><p class="font-display text-4xl"><span data-count="312">0</span></p><p class="text-[10px] font-mono uppercase tracking-tag text-ink/50 mt-1">Reviews</p></div>
    </div>
    <a href="{{ url('/about') }}" class="inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-tag underline-link">Read Our Full Story →</a>
  </div>
</section>

<!-- Reviews -->
<section class="bg-paperdeep py-20 md:py-28 overflow-hidden">
  <div class="max-w-[1440px] mx-auto px-6 md:px-10">
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12" data-r>
      <div>
        <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-4">Reviews</p>
        <h2 class="font-display text-4xl md:text-5xl">What Our Customers Say</h2>
      </div>
      <div class="flex items-center gap-3">
        <div class="flex text-lg"><span class="star">★★★★★</span></div>
        <span class="text-[13px] font-mono text-ink/60">4.8 / 5 · 312 reviews</span>
      </div>
    </div>
    <div class="relative" data-r>
      <div id="reviewTrack" class="flex overflow-x-auto gap-6 pb-2"></div>
      <button id="reviewPrev" aria-label="Previous review" class="hidden md:flex items-center justify-center absolute -left-5 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white border border-ink/10 hover:bg-ink hover:text-paper transition">←</button>
      <button id="reviewNext" aria-label="Next review" class="hidden md:flex items-center justify-center absolute -right-5 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white border border-ink/10 hover:bg-ink hover:text-paper transition">→</button>
    </div>
    <div id="reviewDots" class="flex items-center justify-center gap-2 mt-8"></div>
  </div>
</section>

<!-- Instagram -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 py-20 md:py-28">
  <div class="text-center mb-12" data-r>
    <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-4">Social</p>
    <h2 class="font-display text-4xl md:text-5xl mb-3">Follow Along</h2>
    <a href="#" class="text-[13px] underline-link">@thewesternfashion on Instagram</a>
  </div>
  <div id="insta" class="grid grid-cols-3 md:grid-cols-6 gap-2 md:gap-3"></div>
</section>

<!-- Newsletter -->
<section class="bg-ink text-paper">
  <div class="max-w-[1440px] mx-auto px-6 md:px-10 py-20 md:py-24 text-center" data-r>
    <p class="text-[11px] font-mono tracking-tag uppercase text-paper/50 mb-4">Join the List</p>
    <h2 class="font-display text-4xl md:text-5xl mb-4">Get 10% Off Your First Jacket</h2>
    <p class="text-[14px] text-paper/60 mb-8 max-w-md mx-auto">Sign up for early access to new arrivals, restocks, and the occasional workshop note from Michael.</p>
    <form class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto" onsubmit="return false;">
      <input type="email" required placeholder="Email address" class="flex-1 bg-transparent border border-paper/30 px-5 py-4 text-[13px] outline-none placeholder:text-paper/40 focus:border-paper/80 transition">
      <button class="bg-paper text-ink text-[11px] font-mono uppercase tracking-tag px-8 py-4 border border-paper hover:bg-transparent hover:text-paper transition duration-300">Sign Up</button>
    </form>
  </div>
</section>

<!-- Footer -->
<footer class="border-t border-ink/10 bg-white">
  <div class="max-w-[1440px] mx-auto px-6 md:px-10 py-14 grid grid-cols-2 md:grid-cols-5 gap-8">
    <div class="col-span-2">
      <p class="font-display text-lg sm:text-xl tracking-wordmark uppercase mb-3">The Western Fashion</p>
      <p class="text-[13px] text-ink/60 max-w-xs leading-relaxed">Under-the-radar jackets, consciously made for comfort, style, and elegance.</p>
    </div>
    <div>
      <p class="text-[11px] font-mono uppercase tracking-tag text-brick mb-4">Shop</p>
      <ul class="space-y-2.5 text-[13px]">
        <li><a href="{{ route('shop.products') }}" class="underline-link">All Jackets</a></li>
        <li><a href="{{ route('cart.index') }}" class="underline-link">Cart</a></li>
        <li><a href="{{ route('orders.index') }}" class="underline-link">My Orders</a></li>
      </ul>
    </div>
    <div>
      <p class="text-[11px] font-mono uppercase tracking-tag text-brick mb-4">Company</p>
      <ul class="space-y-2.5 text-[13px]">
        <li><a href="{{ url('/about') }}" class="underline-link">About</a></li>
        <li><a href="{{ url('/contact') }}" class="underline-link">Contact</a></li>
      </ul>
    </div>
    <div>
      <p class="text-[11px] font-mono uppercase tracking-tag text-brick mb-4">Newsletter</p>
      <div class="flex border-b border-ink/30 pb-2">
        <input type="email" placeholder="Email address" class="bg-transparent text-[13px] outline-none flex-1 placeholder:text-ink/40">
        <button class="text-[13px] font-mono">↗</button>
      </div>
    </div>
  </div>
  <div class="border-t border-ink/10 py-5 text-center text-[11px] font-mono text-ink/40 tracking-tag uppercase">© {{ date('Y') }} The Western Fashion. All rights reserved.</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/lenis@1.1.18/dist/lenis.min.js"></script>
<script>
  const SHOP = "{{ route('shop.products') }}";
  const U = (id, w = 600) => `https://images.unsplash.com/photo-${id}?q=80&w=${w}&auto=format&fit=crop`;
  const SW = { a:["#1C1A16","#3B5BA5","#9A3D28"], b:["#1C1A16","#3B5BA5"], c:["#1C1A16","#9A3D28"], d:["#1C1A16","#EDE9E3"] };

  const products = [
    { name:"Camel Wool Jacket", price:400, badge:"Sale", cat:"wool", sw:SW.a, img:U("1544923246-77307dd654cb") },
    { name:"Quilted Field Jacket", price:400, old:450, badge:"Sale", cat:"field", sw:SW.b, img:U("1551028719-00167b16eac5") },
    { name:"Cropped Leather Jacket", price:400, badge:"Sold out", cat:"leather", sw:SW.c, img:U("1521223890158-f9f7c3d5d504") },
    { name:"Denim Trucker Jacket", price:400, old:450, badge:"Sale", cat:"denim", sw:SW.c, img:U("1611312449408-fcece27cdbb7") },
    { name:"Shearling Aviator Jacket", price:480, cat:"leather", sw:SW.a, img:U("1544441893-675973e31985") },
    { name:"Oversized Wool Jacket", price:420, cat:"wool", sw:SW.a, img:U("1591047139829-d91aecb6caea") },
    { name:"Waxed Cotton Field Jacket", price:400, old:450, badge:"Sold out", cat:"field", sw:SW.d, img:U("1548624149-f9061a9a2151") },
    { name:"Classic Denim Jacket", price:380, cat:"denim", sw:SW.c, img:U("1544966503-7ba532cb2513") },
  ];
  const fresh = [
    { name:"Oversized Wool Jacket", price:420, badge:"New", sw:SW.b, img:U("1591047139829-d91aecb6caea", 1000) },
    { name:"Shearling Aviator Jacket", price:480, badge:"New", sw:SW.c, img:U("1544441893-675973e31985") },
    { name:"Belted Trench Jacket", price:390, badge:"New", sw:SW.d, img:U("1548624149-f9061a9a2151") },
    { name:"Quilted Puffer Jacket", price:260, badge:"New", sw:SW.a, img:U("1551028719-00167b16eac5") },
  ];
  const reviews = [
    ["Amelia R.","Camel Wool Jacket",5,"Even better in person. The wool feels heavy and warm without being bulky, and the tailoring around the shoulders is excellent."],
    ["James T.","Cropped Leather Jacket",5,"Worn almost daily since it arrived. The leather has started to soften nicely and the stitching feels genuinely well made."],
    ["Priya N.","Waxed Cotton Field Jacket",4,"Beautiful jacket and fast shipping. Sizing runs slightly large, so go down a size if you're between two."],
    ["Daniel K.","Oversized Wool Jacket",5,"On another level compared to mass-market stuff. Thick, warm, holds its shape after washing. Worth every dollar."],
    ["Sofia M.","Quilted Field Jacket",5,"Ordered for fall hikes and it's held up through wind and light rain. The quilting pattern is a nice touch too."],
  ];
  const trust = [
    ["Free Shipping","On orders over $150",'<path d="M3 7h13v10H3z"/><path d="M16 10h3l2 3v4h-5z"/><circle cx="7.5" cy="18" r="1.5"/><circle cx="17.5" cy="18" r="1.5"/>'],
    ["Easy Returns","30-day return window",'<path d="M21 12a9 9 0 1 1-3.5-7.1"/><polyline points="21 3 21 9 15 9"/>'],
    ["Secure Payment","Encrypted checkout",'<rect x="3" y="10" width="18" height="10" rx="1.5"/><path d="M7 10V7a5 5 0 0 1 10 0v3"/>'],
    ["Made With Care","Small-batch production",'<path d="M12 21s-7-4.35-9.5-9A5.5 5.5 0 0 1 12 6a5.5 5.5 0 0 1 9.5 6c-2.5 4.65-9.5 9-9.5 9z"/>'],
  ];
  const $ = (s) => document.querySelector(s);

  /* ---------- builders ---------- */
  $('#mq').innerHTML = Array(2).fill(["Free shipping over $150","Small-batch jackets","30-day returns","Midseason sale — 20% off","Made with care"].map(t => `<span class="px-8">${t}</span><span class="text-brick">✦</span>`).join('')).join('');

  $('#trust').innerHTML = trust.map(([t, s, p], i) => `
    <div class="flex items-center gap-3" data-r style="--d:${i * .08}s">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="shrink-0">${p}</svg>
      <div><p class="text-[11px] font-mono uppercase tracking-tag">${t}</p><p class="text-[11px] text-ink/50 mt-0.5">${s}</p></div>
    </div>`).join('');

  const badge = (b) => b ? `<span class="hang-tag absolute top-3 right-3 z-10 text-[10px] font-mono uppercase tracking-tag px-3 py-1.5 ${b === 'Sale' ? 'bg-brick text-paper' : b === 'New' ? 'bg-ink/90 text-paper' : 'bg-white/95 text-ink/70'}">${b}</span>` : '';
  const price = (p) => p.old ? `<span class="text-brick mr-2">$${p.price.toFixed(2)}</span><span class="line-through text-ink/40">$${p.old.toFixed(2)}</span>` : `$${p.price.toFixed(2)}`;

  const card = (p, i = 0, big = false) => `
    <a href="${SHOP}" data-r="zoom" style="--d:${i * .08}s" class="group flex flex-col ${big ? 'col-span-2 md:row-span-2' : ''}">
      <div class="relative overflow-hidden bg-paperdeep flex-1 ${big ? 'aspect-[4/3] md:aspect-auto md:min-h-[440px]' : 'aspect-[3/4]'}">
        <img loading="lazy" src="${p.img}" alt="${p.name}" class="absolute inset-0 w-full h-full object-cover transition duration-[1200ms] ease-out group-hover:scale-[1.07]">
        ${badge(p.badge)}
        <span class="absolute inset-x-0 bottom-0 translate-y-full group-hover:translate-y-0 transition duration-500 bg-ink text-paper text-[10px] font-mono uppercase tracking-tag text-center py-3">View jacket →</span>
      </div>
      <div class="pt-3">
        <div class="flex items-center gap-1.5 mb-2">${p.sw.map(c => `<span class="w-3 h-3 rounded-full border border-ink/10 transition-transform duration-300 group-hover:scale-110" style="background:${c}"></span>`).join('')}</div>
        <p class="text-[10px] font-mono uppercase tracking-tag text-ink/50 mb-1">The Western Fashion</p>
        <p class="${big ? 'text-xl' : 'text-[14px]'} font-display-sm underline-link mb-1.5">${p.name}</p>
        <p class="text-[14px] font-mono">${price(p)}</p>
      </div>
    </a>`;

  $('#new-grid').innerHTML = fresh.map((p, i) => card(p, i, i === 0)).join('');

  const filters = ["all","leather","denim","field","wool"];
  $('#filters').innerHTML = filters.map((f, i) => `<button data-f="${f}" class="filter-pill ${i ? '' : 'active'} border border-ink/15 px-5 py-2 text-[11px] font-mono uppercase tracking-tag hover:border-ink">${f}</button>`).join('');

  const grid = $('#grid');
  function renderGrid(f = 'all') {
    grid.innerHTML = products.filter(p => f === 'all' || p.cat === f).map((p, i) => card(p, i)).join('');
    grid.querySelectorAll('[data-r]').forEach(el => io.observe(el));
  }
  $('#filters').addEventListener('click', (e) => {
    const b = e.target.closest('.filter-pill'); if (!b) return;
    document.querySelectorAll('.filter-pill').forEach(x => x.classList.remove('active'));
    b.classList.add('active');
    grid.classList.add('out');
    setTimeout(() => { renderGrid(b.dataset.f); grid.classList.remove('out'); }, 250);
  });

  $('#insta').innerHTML = ["1544923246-77307dd654cb","1551028719-00167b16eac5","1521223890158-f9f7c3d5d504","1611312449408-fcece27cdbb7","1544441893-675973e31985","1591047139829-d91aecb6caea"].map((id, i) => `
    <a href="#" data-r="zoom" style="--d:${i * .06}s" class="relative aspect-square overflow-hidden group block">
      <img loading="lazy" src="${U(id, 400)}" alt="The Western Fashion on Instagram" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
      <div class="absolute inset-0 bg-black/0 group-hover:bg-black/35 transition duration-500"></div>
    </a>`).join('');

  /* ---------- reveal / counters / masks ---------- */
  const io = new IntersectionObserver((es) => es.forEach(e => {
    if (!e.isIntersecting) return;
    e.target.classList.add('in'); io.unobserve(e.target);
    e.target.querySelectorAll('[data-count]').forEach(count);
  }), { threshold: .15, rootMargin: '0px 0px -6% 0px' });
  document.querySelectorAll('[data-r], .mask').forEach(el => io.observe(el));
  renderGrid();

  function count(el) {
    const end = parseFloat(el.dataset.count), dec = +(el.dataset.dec || 0), t0 = performance.now();
    (function tick(t) {
      const k = Math.min(1, (t - t0) / 1600), e = 1 - Math.pow(1 - k, 3);
      el.textContent = (end * e).toFixed(dec);
      if (k < 1) requestAnimationFrame(tick);
    })(t0);
  }

  /* ---------- smooth scroll (Lenis) ---------- */
  const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
  let lenis = null;
  if (window.Lenis && !reduce) {
    lenis = new Lenis({ duration: 1.2, easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)) });
    (function raf(t) { lenis.raf(t); requestAnimationFrame(raf); })(0);
    document.querySelectorAll('a[href^="#"]:not([href="#"])').forEach(a => a.addEventListener('click', (e) => {
      const t = document.querySelector(a.getAttribute('href')); if (t) { e.preventDefault(); lenis.scrollTo(t, { offset: -70 }); }
    }));
  }

  /* ---------- scroll effects: progress, header, parallax ---------- */
  const hdr = $('#hdr'), bar = $('#progress'), pars = [...document.querySelectorAll('[data-p]')];
  let lastY = 0, ticking = false;
  function onScroll() {
    const y = scrollY, max = document.documentElement.scrollHeight - innerHeight;
    bar.style.transform = `scaleX(${max > 0 ? y / max : 0})`;
    hdr.classList.toggle('stuck', y > 20);
    hdr.classList.toggle('hide', y > 300 && y > lastY + 4);
    if (y < lastY - 4) hdr.classList.remove('hide');
    lastY = y;
    if (!reduce) pars.forEach(img => {
      const r = img.parentElement.getBoundingClientRect();
      if (r.bottom < -100 || r.top > innerHeight + 100) return;
      const lim = r.height * .09, off = Math.max(-lim, Math.min(lim, (r.top + r.height / 2 - innerHeight / 2) * -parseFloat(img.dataset.p)));
      img.style.transform = `translate3d(0,${off}px,0) scale(1.2)`;
    });
    ticking = false;
  }
  addEventListener('scroll', () => { if (!ticking) { ticking = true; requestAnimationFrame(onScroll); } }, { passive: true });
  addEventListener('resize', onScroll); onScroll();

  /* ---------- menu ---------- */
  const menu = $('#menu');
  const setMenu = (o) => { menu.classList.toggle('open', o); lenis && (o ? lenis.stop() : lenis.start()); document.body.style.overflow = o ? 'hidden' : ''; };
  $('#menuBtn').addEventListener('click', () => setMenu(true));
  $('#menuClose').addEventListener('click', () => setMenu(false));
  menu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => setMenu(false)));
  addEventListener('keydown', (e) => e.key === 'Escape' && setMenu(false));

  /* ---------- reviews slider ---------- */
  const track = $('#reviewTrack'), dots = $('#reviewDots');
  let cur = 0, auto;
  reviews.forEach(([name, item, rate, text], i) => {
    const s = document.createElement('div');
    s.className = 'review-slide shrink-0 w-[85%] sm:w-[420px] bg-white p-7 md:p-8';
    s.innerHTML = `
      <div class="flex text-sm mb-4">${[0,1,2,3,4].map(k => `<span class="star ${k < rate ? '' : 'empty'}">★</span>`).join('')}</div>
      <p class="text-[15px] leading-relaxed text-ink/80 mb-6 font-display-sm min-h-[96px]">"${text}"</p>
      <div class="flex items-center gap-3 stitch pt-5">
        <div class="w-9 h-9 rounded-full bg-paperdeep flex items-center justify-center text-[11px] font-mono shrink-0">${name.split(' ').map(w => w[0]).join('')}</div>
        <div><p class="text-[13px] font-medium">${name}</p><p class="text-[11px] font-mono text-ink/50">Purchased: ${item}</p></div>
      </div>`;
    track.appendChild(s);
    const d = document.createElement('button');
    d.className = 'review-dot' + (i ? '' : ' active'); d.setAttribute('aria-label', 'Review ' + (i + 1));
    d.onclick = () => { go(i); restart(); }; dots.appendChild(d);
  });
  function go(i) {
    cur = (i + reviews.length) % reviews.length;
    const t = track.children[cur];
    track.scrollTo({ left: t.offsetLeft - track.offsetLeft, behavior: 'smooth' });
    [...dots.children].forEach((d, k) => d.classList.toggle('active', k === cur));
  }
  const restart = () => { clearInterval(auto); auto = setInterval(() => go(cur + 1), 6000); };
  $('#reviewPrev').onclick = () => { go(cur - 1); restart(); };
  $('#reviewNext').onclick = () => { go(cur + 1); restart(); };
  let st; track.addEventListener('scroll', () => { clearTimeout(st); st = setTimeout(() => {
    const l = track.getBoundingClientRect().left; let best = 0, bd = 1e9;
    [...track.children].forEach((el, k) => { const d = Math.abs(el.getBoundingClientRect().left - l); if (d < bd) { bd = d; best = k; } });
    cur = best; [...dots.children].forEach((d, k) => d.classList.toggle('active', k === cur));
  }, 120); }, { passive: true });
  track.onmouseenter = () => clearInterval(auto); track.onmouseleave = restart; restart();

  /* ---------- dark toggle (unchanged behaviour) ---------- */
  $('#darkToggle').addEventListener('click', () => {
    const on = document.body.classList.toggle('invert-mode');
    document.body.style.filter = on ? 'invert(1) hue-rotate(180deg)' : 'none';
  });
</script>
</body>
</html>