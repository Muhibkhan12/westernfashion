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
  a:focus-visible, button:focus-visible { outline:1.5px solid #9A3D28; outline-offset:4px; }

  .ul { background-image:linear-gradient(currentColor,currentColor); background-position:0 100%; background-repeat:no-repeat; background-size:0% 1px; transition:background-size .4s cubic-bezier(.2,.7,.2,1); }
  .ul:hover, .ul.on { background-size:100% 1px; }
  .rule { height:1px; background:rgba(28,26,22,.12); transform-origin:left; transform:scaleX(0); transition:transform 1.2s cubic-bezier(.77,0,.18,1); }
  .rule.in { transform:scaleX(1); }

  /* reveals */
  [data-r] { opacity:0; transform:translateY(24px); transition:opacity .9s cubic-bezier(.2,.7,.2,1) var(--d,0s), transform .9s cubic-bezier(.2,.7,.2,1) var(--d,0s); }
  [data-r].in { opacity:1; transform:none; }
  .mask { clip-path:inset(0 0 100% 0); transition:clip-path 1.3s cubic-bezier(.77,0,.18,1); } .mask.in { clip-path:inset(0); }
  .line { display:block; overflow:hidden; padding-bottom:.1em; }
  .line > span { display:block; transform:translateY(110%) rotate(3deg); transform-origin:left; animation:up 1.1s cubic-bezier(.2,.7,.2,1) forwards; animation-delay:calc(.3s + var(--i) * .14s); }
  .split .line > span { animation:none; transition:transform 1s cubic-bezier(.2,.7,.2,1) calc(var(--i) * .1s); } .split.in .line > span { transform:none; }
  @keyframes up { to { transform:none; } }
  .fade-in { opacity:0; animation:fi 1s ease forwards; animation-delay:var(--d,0s); } @keyframes fi { to { opacity:1; } }
  .hero-zoom { animation:zo 2s cubic-bezier(.2,.7,.2,1) both; } @keyframes zo { from { transform:scale(1.14); } }
  .par { position:absolute; left:0; width:100%; height:100%; object-fit:cover; transform:scale(1.2); will-change:transform; }
  .cue { width:1px; height:44px; background:linear-gradient(#fff,transparent); transform-origin:top; animation:cue 1.9s ease-in-out infinite; } @keyframes cue { 0% { transform:scaleY(0); } 50% { transform:scaleY(1); } 100% { transform:scaleY(1); opacity:0; } }


  .w { opacity:.14; transition:opacity .35s ease; } .w.lit { opacity:1; }
  .card-img { transition:transform 1.2s cubic-bezier(.2,.7,.2,1); } .group:hover .card-img { transform:scale(1.06); }
  .mag { transition:transform .35s cubic-bezier(.2,.7,.2,1), background .3s, color .3s; }
  .tab { position:relative; padding-bottom:6px; color:rgba(28,26,22,.45); transition:color .3s; } .tab.active, .tab:hover { color:#1C1A16; }
  #tabBar { position:absolute; bottom:0; height:1px; background:#1C1A16; transition:left .45s cubic-bezier(.77,0,.18,1), width .45s cubic-bezier(.77,0,.18,1); }
  #grid { transition:opacity .25s ease, transform .25s ease; } #grid.out { opacity:0; transform:translateY(10px); }
  #rv { transition:opacity .45s ease, transform .45s ease; } #rv.out { opacity:0; transform:translateY(12px); }
  .hs-track::-webkit-scrollbar { display:none; }

  @media (prefers-reduced-motion:reduce) {
    [data-r], .line > span, .fade-in { opacity:1; transform:none; animation:none; transition:none; } .mask { clip-path:none; } .rule { transform:none; }
    .cue, .hero-zoom { animation:none; } .par { transform:none; } .w { opacity:1; }
  }
</style>
</head>
<body class="antialiased bg-white">

@include('partials.header')

<!-- Hero -->
<section id="hero" class="relative h-[88vh] min-h-[560px] overflow-hidden bg-ink">
  <div class="absolute inset-0 hero-zoom">
    <img data-p="0.18" class="par" src="https://images.unsplash.com/photo-1551028719-00167b16eac5?q=80&w=1800&auto=format&fit=crop" alt="Model wearing a quilted field jacket">
  </div>
  <div class="absolute inset-0 bg-gradient-to-t from-black/65 via-black/15 to-black/35"></div>
  <div id="heroC" class="relative z-10 h-full max-w-[1440px] mx-auto px-6 md:px-10 flex flex-col justify-end pb-16 md:pb-24 text-paper">
    <p class="fade-in text-[11px] font-mono tracking-tag uppercase text-paper/70 mb-6" style="--d:.2s">Capsule № 04 — AW '23</p>
    <h1 class="font-display text-5xl sm:text-6xl md:text-[6.5rem] leading-[1] mb-10 max-w-4xl">
      <span class="line" style="--i:0"><span>A Jacket Capsule</span></span>
      <span class="line" style="--i:1"><span>by <em class="italic">Michael Brooks</em></span></span>
    </h1>
    <div class="fade-in flex flex-wrap items-center gap-8" style="--d:1.1s">
      <a href="{{ route('shop.products') }}" class="mag group inline-flex items-center gap-3 bg-paper text-ink text-[11px] font-mono uppercase tracking-tag px-8 py-4 hover:bg-transparent hover:text-paper border border-paper">
        Explore Collection <span class="transition-transform duration-300 group-hover:translate-x-1">→</span>
      </a>
      <a href="#new" class="text-[11px] font-mono uppercase tracking-tag ul text-paper pb-0.5">New in</a>
    </div>
  </div>
  <div class="hidden md:flex flex-col items-center gap-3 absolute right-10 bottom-24 z-10 text-[10px] font-mono uppercase tracking-tag text-paper/70">
    <span class="[writing-mode:vertical-rl] rotate-180">Scroll</span><span class="cue"></span>
  </div>
</section>

<!-- Trust strip -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10">
  <div class="grid grid-cols-2 md:grid-cols-4 gap-y-3 py-6 text-[11px] font-mono uppercase tracking-tag text-ink/60" data-r>
    <p>Free shipping over $150</p><p>30-day returns</p><p>Encrypted checkout</p><p>Small-batch made</p>
  </div>
  <div class="rule" data-rule></div>
</section>

<!-- Statement: words fill on scroll -->
<section class="max-w-[1100px] mx-auto px-6 md:px-10 py-28 md:py-44">
  <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-8" data-r>The idea</p>
  <p id="words" class="font-display text-3xl sm:text-4xl md:text-6xl leading-[1.15]">Under-the-radar jackets, consciously made for comfort, style, and elegance. Cut once, worn for years.</p>
</section>

<!-- New jackets: pinned horizontal scroll -->
<section id="new">
  <div id="hs" class="relative">
    <div class="sticky top-0 h-screen flex flex-col justify-center overflow-hidden">
      <div class="max-w-[1440px] w-full mx-auto px-6 md:px-10 flex items-end justify-between mb-8 md:mb-10">
        <div data-r>
          <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-3">Just Landed</p>
          <h2 class="font-display text-4xl md:text-6xl">New Jackets</h2>
        </div>
        <a href="{{ route('shop.products') }}" class="text-[11px] font-mono uppercase tracking-tag ul pb-0.5">Shop New In</a>
      </div>
      <div id="hsTrack" class="flex gap-5 md:gap-8 px-6 md:px-10 will-change-transform w-max"></div>
      <div class="max-w-[1440px] w-full mx-auto px-6 md:px-10 mt-8 md:mt-10">
        <div class="h-px bg-ink/10"><div id="hsLine" class="h-px bg-ink origin-left" style="transform:scaleX(0)"></div></div>
      </div>
    </div>
  </div>
</section>

<!-- Promo: image grows full-bleed on scroll -->
<section class="my-24 md:my-40">
  <div id="grow" class="relative h-[70vh] min-h-[420px] overflow-hidden" style="clip-path:inset(10% 10% 10% 10%)">
    <img data-p="0.14" class="par" src="https://images.unsplash.com/photo-1548624149-f9061a9a2151?q=80&w=1800&auto=format&fit=crop" alt="Model wearing an outerwear jacket">
    <div class="absolute inset-0 bg-black/40"></div>
    <div class="relative z-10 h-full flex flex-col items-center justify-center text-center px-6 text-paper">
      <p class="text-[11px] font-mono tracking-tag uppercase text-paper/70 mb-5" data-r>Outerwear Edit</p>
      <h3 class="font-display text-4xl md:text-7xl mb-9 max-w-2xl leading-[1.05]" data-r style="--d:.1s">Extra 20% off all jackets</h3>
      <a href="{{ route('shop.products') }}" class="mag bg-paper text-ink text-[11px] font-mono uppercase tracking-tag px-8 py-4 border border-paper hover:bg-transparent hover:text-paper">Shop the Sale →</a>
    </div>
  </div>
</section>

<!-- Featured -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 py-10 md:py-20 grid grid-cols-1 md:grid-cols-12 gap-14 md:gap-8 items-center">
  <div class="md:col-span-5" data-r>
    <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-4">Featured</p>
    <h2 class="font-display text-3xl md:text-5xl leading-[1.1] mb-10 max-w-md">The cropped leather jacket.</h2>
    <ul class="max-w-sm">
      <li class="rule" data-rule></li>
      <li><a href="{{ route('shop.products') }}" class="group flex items-center justify-between py-5 text-lg font-display-sm transition-all duration-300 hover:pl-3">Women's Jackets <span class="font-mono text-sm transition-transform duration-300 group-hover:translate-x-1 group-hover:-translate-y-1">↗</span></a></li>
      <li class="rule" data-rule></li>
      <li><a href="{{ route('shop.products') }}" class="group flex items-center justify-between py-5 text-lg font-display-sm transition-all duration-300 hover:pl-3">Men's Jackets <span class="font-mono text-sm transition-transform duration-300 group-hover:translate-x-1 group-hover:-translate-y-1">↗</span></a></li>
      <li class="rule" data-rule></li>
      <li><a href="{{ route('shop.products') }}" class="group flex items-center justify-between py-5 text-lg font-display-sm transition-all duration-300 hover:pl-3">All Jackets <span class="font-mono text-sm transition-transform duration-300 group-hover:translate-x-1 group-hover:-translate-y-1">↗</span></a></li>
      <li class="rule" data-rule></li>
    </ul>
  </div>
  <div class="md:col-span-6 md:col-start-7">
    <div class="relative h-[480px] md:h-[640px] overflow-hidden bg-paperdeep mask">
      <img data-p="0.1" class="par" src="https://images.unsplash.com/photo-1521223890158-f9f7c3d5d504?q=80&w=900&auto=format&fit=crop" alt="Cropped leather jacket">
    </div>
    <div class="flex items-center justify-between pt-4" data-r>
      <p class="text-[15px] font-display-sm">Cropped Leather Jacket</p>
      <span class="text-[15px] font-mono">$400.00</span>
    </div>
  </div>
</section>

<!-- Best sellers -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 pt-24 pb-28">
  <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10" data-r>
    <div>
      <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-4">Customer Favorites</p>
      <h2 class="font-display text-4xl md:text-6xl">Best Selling Jackets</h2>
    </div>
    <a href="{{ route('shop.products') }}" class="text-[11px] font-mono uppercase tracking-tag ul pb-0.5 self-start md:self-auto">View All</a>
  </div>
  <div id="filters" class="relative flex flex-wrap gap-x-8 gap-y-2 mb-12 border-b border-ink/10" data-r><span id="tabBar"></span></div>
  <div id="grid" class="grid grid-cols-2 md:grid-cols-4 gap-x-5 gap-y-12"></div>
</section>

<!-- Story -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 py-16 md:py-28 grid grid-cols-1 md:grid-cols-2 gap-14 md:gap-24">
  <div class="md:sticky md:top-24 self-start relative h-[420px] md:h-[640px] overflow-hidden mask">
    <img data-p="0.12" class="par" src="https://images.unsplash.com/photo-1544441893-675973e31985?q=80&w=900&auto=format&fit=crop" alt="A shearling aviator jacket in the workshop">
  </div>
  <div class="md:py-24" data-r>
    <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-4">Our Story</p>
    <h2 class="font-display text-3xl md:text-5xl leading-[1.1] mb-8 max-w-md">Built on quiet craftsmanship, one small run at a time.</h2>
    <p class="text-[14px] leading-relaxed text-ink/70 mb-4 max-w-md">The Western Fashion began in a single-room Portland workshop in 2016, where founder Michael Brooks set out to make jackets that lasted longer than a season. Every piece is still cut, sewn, and finished in small batches by the same close-knit team.</p>
    <p class="text-[14px] leading-relaxed text-ink/70 mb-12 max-w-md">We work with mills we've known for years, favor natural fibers over synthetics, and would rather make less and make it well.</p>
    <div class="rule" data-rule></div>
    <div class="grid grid-cols-3 gap-4 max-w-md py-8">
      <div><p class="font-display text-4xl md:text-5xl"><span data-count="10">0</span>+</p><p class="text-[10px] font-mono uppercase tracking-tag text-ink/50 mt-2">Years</p></div>
      <div><p class="font-display text-4xl md:text-5xl"><span data-count="4.8" data-dec="1">0</span></p><p class="text-[10px] font-mono uppercase tracking-tag text-ink/50 mt-2">Avg rating</p></div>
      <div><p class="font-display text-4xl md:text-5xl"><span data-count="312">0</span></p><p class="text-[10px] font-mono uppercase tracking-tag text-ink/50 mt-2">Reviews</p></div>
    </div>
    <div class="rule mb-8" data-rule></div>
    <a href="{{ url('/about') }}" class="text-[11px] font-mono uppercase tracking-tag ul pb-0.5">Read our full story →</a>
  </div>
</section>

<!-- Reviews -->
<section class="bg-paperdeep py-24 md:py-36">
  <div class="max-w-[960px] mx-auto px-6 md:px-10 text-center">
    <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-10" data-r>4.8 / 5 · 312 reviews</p>
    <div id="rv" class="min-h-[300px] md:min-h-[260px]">
      <p id="rvStars" class="mb-6 tracking-widest"></p>
      <p id="rvText" class="font-display text-2xl md:text-4xl leading-[1.3] mb-8"></p>
      <p id="rvBy" class="text-[11px] font-mono uppercase tracking-tag text-ink/50"></p>
    </div>
    <div class="flex items-center justify-center gap-6 mt-8">
      <button id="reviewPrev" aria-label="Previous review" class="w-11 h-11 rounded-full border border-ink/15 hover:bg-ink hover:text-paper transition">←</button>
      <span id="rvCount" class="text-[11px] font-mono tracking-tag w-12"></span>
      <button id="reviewNext" aria-label="Next review" class="w-11 h-11 rounded-full border border-ink/15 hover:bg-ink hover:text-paper transition">→</button>
    </div>
  </div>
</section>

<!-- Newsletter -->
<section class="bg-ink text-paper">
  <div class="max-w-[1440px] mx-auto px-6 md:px-10 py-24 md:py-32 text-center">
    <p class="text-[11px] font-mono tracking-tag uppercase text-paper/50 mb-6" data-r>Join the list</p>
    <h2 class="split font-display text-4xl md:text-7xl mb-6" data-r-split>
      <span class="line" style="--i:0"><span>10% off your</span></span>
      <span class="line" style="--i:1"><span><em class="italic">first jacket</em></span></span>
    </h2>
    <p class="text-[14px] text-paper/60 mb-10 max-w-md mx-auto" data-r>Early access to new arrivals, restocks, and the occasional workshop note from Michael.</p>
    <form class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto" onsubmit="return false;" data-r>
      <input type="email" required placeholder="Email address" class="flex-1 bg-transparent border-b border-paper/30 px-1 py-4 text-[13px] outline-none placeholder:text-paper/40 focus:border-paper transition">
      <button class="mag bg-paper text-ink text-[11px] font-mono uppercase tracking-tag px-8 py-4 border border-paper hover:bg-transparent hover:text-paper">Sign Up</button>
    </form>
  </div>
</section>

<!-- Footer -->
<footer class="bg-white overflow-hidden">
  <div class="max-w-[1440px] mx-auto px-6 md:px-10 pt-16 pb-10 grid grid-cols-2 md:grid-cols-4 gap-10">
    <div class="col-span-2">
      <p class="text-[13px] text-ink/60 max-w-xs leading-relaxed">Under-the-radar jackets, consciously made for comfort, style, and elegance.</p>
    </div>
    <div>
      <p class="text-[11px] font-mono uppercase tracking-tag text-brick mb-4">Shop</p>
      <ul class="space-y-2.5 text-[13px]">
        <li><a href="{{ route('shop.products') }}" class="ul">All Jackets</a></li>
        <li><a href="{{ route('cart.index') }}" class="ul">Cart</a></li>
        <li><a href="{{ route('orders.index') }}" class="ul">My Orders</a></li>
      </ul>
    </div>
    <div>
      <p class="text-[11px] font-mono uppercase tracking-tag text-brick mb-4">Company</p>
      <ul class="space-y-2.5 text-[13px]">
        <li><a href="{{ url('/about') }}" class="ul">About</a></li>
        <li><a href="{{ url('/contact') }}" class="ul">Contact</a></li>
      </ul>
    </div>
  </div>
  <p id="bigMark" class="font-display uppercase text-center leading-none whitespace-nowrap select-none text-ink/90" style="font-size:7.4vw; letter-spacing:.04em; will-change:transform">The Western Fashion</p>
  <div class="py-6 text-center text-[11px] font-mono text-ink/40 tracking-tag uppercase">© {{ date('Y') }} The Western Fashion. All rights reserved.</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/lenis@1.1.18/dist/lenis.min.js"></script>
<script>
  const SHOP = "{{ route('shop.products') }}";
  const U = (id, w = 600) => `https://images.unsplash.com/photo-${id}?q=80&w=${w}&auto=format&fit=crop`;
  const SW = { a:["#1C1A16","#3B5BA5","#9A3D28"], b:["#1C1A16","#3B5BA5"], c:["#1C1A16","#9A3D28"], d:["#1C1A16","#EDE9E3"] };
  const $ = (s) => document.querySelector(s);
  const clamp = (v, a = 0, b = 1) => Math.min(b, Math.max(a, v));

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
    { name:"Oversized Wool Jacket", price:420, badge:"New", sw:SW.b, img:U("1591047139829-d91aecb6caea", 900) },
    { name:"Shearling Aviator Jacket", price:480, badge:"New", sw:SW.c, img:U("1544441893-675973e31985") },
    { name:"Belted Trench Jacket", price:390, badge:"New", sw:SW.d, img:U("1548624149-f9061a9a2151") },
    { name:"Quilted Puffer Jacket", price:260, badge:"New", sw:SW.a, img:U("1551028719-00167b16eac5") },
    { name:"Camel Wool Jacket", price:400, badge:"New", sw:SW.a, img:U("1544923246-77307dd654cb") },
  ];
  const reviews = [
    ["Amelia R.","Camel Wool Jacket",5,"Even better in person. The wool feels heavy and warm without being bulky, and the tailoring around the shoulders is excellent."],
    ["James T.","Cropped Leather Jacket",5,"Worn almost daily since it arrived. The leather has started to soften nicely and the stitching feels genuinely well made."],
    ["Priya N.","Waxed Cotton Field Jacket",4,"Beautiful jacket and fast shipping. Sizing runs slightly large, so go down a size if you're between two."],
    ["Daniel K.","Oversized Wool Jacket",5,"On another level compared to mass-market stuff. Thick, warm, holds its shape after washing. Worth every dollar."],
    ["Sofia M.","Quilted Field Jacket",5,"Ordered for fall hikes and it's held up through wind and light rain. The quilting pattern is a nice touch too."],
  ];

  /* ---------- builders ---------- */
  const price = (p) => p.old ? `<span class="text-brick mr-2">$${p.price.toFixed(2)}</span><span class="line-through text-ink/40">$${p.old.toFixed(2)}</span>` : `$${p.price.toFixed(2)}`;
  const card = (p, i = 0, cls = '') => `
    <a href="${SHOP}" data-r style="--d:${(i % 4) * .08}s" class="group block ${cls}">
      <div class="relative overflow-hidden bg-paperdeep aspect-[3/4]">
        <img loading="lazy" src="${p.img}" alt="${p.name}" class="card-img absolute inset-0 w-full h-full object-cover">
        ${p.badge ? `<span class="absolute top-3 left-3 z-10 text-[10px] font-mono uppercase tracking-tag px-2.5 py-1 ${p.badge === 'Sale' ? 'bg-brick text-paper' : p.badge === 'New' ? 'bg-ink text-paper' : 'bg-white text-ink/70'}">${p.badge}</span>` : ''}
        <span class="absolute inset-x-0 bottom-0 translate-y-full group-hover:translate-y-0 transition duration-500 bg-ink text-paper text-[10px] font-mono uppercase tracking-tag text-center py-3">View jacket →</span>
      </div>
      <div class="pt-3 flex items-start justify-between gap-3">
        <div>
          <p class="text-[14px] font-display-sm mb-1.5">${p.name}</p>
          <div class="flex items-center gap-1.5">${p.sw.map(c => `<span class="w-2.5 h-2.5 rounded-full border border-ink/10" style="background:${c}"></span>`).join('')}</div>
        </div>
        <p class="text-[13px] font-mono whitespace-nowrap">${price(p)}</p>
      </div>
    </a>`;

  $('#hsTrack').innerHTML = fresh.map((p, i) => card(p, i, 'w-[68vw] sm:w-[40vw] md:w-[26vw] max-w-[420px] shrink-0')).join('');

  const filters = ["all","leather","denim","field","wool"], fEl = $('#filters'), bar = $('#tabBar');
  fEl.insertAdjacentHTML('beforeend', filters.map((f, i) => `<button data-f="${f}" class="tab ${i ? '' : 'active'} text-[11px] font-mono uppercase tracking-tag">${f}</button>`).join(''));
  const moveBar = (b) => { bar.style.left = b.offsetLeft + 'px'; bar.style.width = b.offsetWidth + 'px'; };

  const grid = $('#grid');
  function renderGrid(f = 'all') {
    grid.innerHTML = products.filter(p => f === 'all' || p.cat === f).map((p, i) => card(p, i)).join('');
    grid.querySelectorAll('[data-r]').forEach(el => io.observe(el));
  }
  fEl.addEventListener('click', (e) => {
    const b = e.target.closest('.tab'); if (!b) return;
    fEl.querySelectorAll('.tab').forEach(x => x.classList.remove('active'));
    b.classList.add('active'); moveBar(b);
    grid.classList.add('out');
    setTimeout(() => { renderGrid(b.dataset.f); grid.classList.remove('out'); }, 250);
  });

  /* ---------- statement words ---------- */
  const wEl = $('#words');
  wEl.innerHTML = wEl.textContent.split(' ').map(w => `<span class="w">${w}</span>`).join(' ');
  const wSpans = [...wEl.querySelectorAll('.w')];

  /* ---------- reveal / counters ---------- */
  const io = new IntersectionObserver((es) => es.forEach(e => {
    if (!e.isIntersecting) return;
    e.target.classList.add('in'); io.unobserve(e.target);
    e.target.querySelectorAll('[data-count]').forEach(count);
  }), { threshold: .15, rootMargin: '0px 0px -6% 0px' });
  document.querySelectorAll('[data-r], .mask, [data-rule], .split').forEach(el => io.observe(el));
  renderGrid();
  requestAnimationFrame(() => moveBar(fEl.querySelector('.tab.active')));

  function count(el) {
    const end = parseFloat(el.dataset.count), dec = +(el.dataset.dec || 0), t0 = performance.now();
    (function tick(t) {
      const k = Math.min(1, (t - t0) / 1600), e = 1 - Math.pow(1 - k, 3);
      el.textContent = (end * e).toFixed(dec);
      if (k < 1) requestAnimationFrame(tick);
    })(t0);
  }

  /* ---------- smooth scroll ---------- */
  const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
  let lenis = null;
  if (window.Lenis && !reduce) {
    lenis = new Lenis({ duration: 1.25, easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)) });
    window.lenis = lenis;
    document.querySelectorAll('a[href^="#"]:not([href="#"])').forEach(a => a.addEventListener('click', (e) => {
      const t = document.querySelector(a.getAttribute('href')); if (t) { e.preventDefault(); lenis.scrollTo(t, { offset: -70 }); }
    }));
  }

  /* ---------- scroll-driven engine (one loop) ---------- */
  const hero = $('#hero'), heroC = $('#heroC'), grow = $('#grow'),
        hs = $('#hs'), hsT = $('#hsTrack'), hsL = $('#hsLine'), mark = $('#bigMark'),
        pars = [...document.querySelectorAll('[data-p]')];
  let dist = 0;
  const measure = () => { dist = Math.max(0, hsT.scrollWidth - innerWidth); hs.style.height = (innerHeight + dist) + 'px'; moveBar(fEl.querySelector('.tab.active')); };
  addEventListener('resize', measure); addEventListener('load', measure); measure();

  function update() {
    const y = scrollY, vh = innerHeight, max = document.documentElement.scrollHeight - vh;

    if (y < vh * 1.2) { const k = clamp(y / (vh * .6)); heroC.style.opacity = 1 - k; heroC.style.transform = `translate3d(0,${y * .25}px,0)`; }

    const r = hs.getBoundingClientRect(), p = clamp(-r.top / Math.max(1, r.height - vh));
    hsT.style.transform = `translate3d(${-p * dist}px,0,0)`; hsL.style.transform = `scaleX(${p})`;

    const g = grow.getBoundingClientRect(), gp = clamp((vh - g.top) / (vh * .8)), ins = (1 - gp) * 10;
    grow.style.clipPath = `inset(${ins}% ${ins}% ${ins}% ${ins}%)`;

    const wr = wEl.getBoundingClientRect(), wp = clamp((vh * .85 - wr.top) / (vh * .55)), lit = Math.round(wp * wSpans.length);
    wSpans.forEach((s, i) => s.classList.toggle('lit', i < lit));

    if (!reduce) {
      pars.forEach(img => {
        const b = img.parentElement.getBoundingClientRect();
        if (b.bottom < -100 || b.top > vh + 100) return;
        const lim = b.height * .09, off = clamp((b.top + b.height / 2 - vh / 2) * -parseFloat(img.dataset.p), -lim, lim);
        img.style.transform = `translate3d(0,${off}px,0) scale(1.2)`;
      });
      const m = mark.getBoundingClientRect(); mark.style.transform = `translate3d(0,${clamp((m.top - vh) / vh, -1, 0) * -40 + 0}px,0)`;
    }
  }
  (function raf(t) { lenis && lenis.raf(t); update(); requestAnimationFrame(raf); })(0);

  /* ---------- magnetic buttons ---------- */
  if (matchMedia('(hover:hover)').matches && !reduce) document.querySelectorAll('.mag').forEach(el => {
    el.addEventListener('mousemove', (e) => { const b = el.getBoundingClientRect(); el.style.transform = `translate(${(e.clientX - b.left - b.width / 2) * .18}px,${(e.clientY - b.top - b.height / 2) * .3}px)`; });
    el.addEventListener('mouseleave', () => el.style.transform = '');
  });

  /* ---------- reviews (crossfade) ---------- */
  const rv = $('#rv'); let cur = 0, auto;
  function show(i) {
    cur = (i + reviews.length) % reviews.length;
    rv.classList.add('out');
    setTimeout(() => {
      const [n, item, rate, text] = reviews[cur];
      $('#rvStars').innerHTML = [0,1,2,3,4].map(k => `<span style="color:${k < rate ? '#1C1A16' : 'rgba(28,26,22,.2)'}">★</span>`).join('');
      $('#rvText').textContent = `“${text}”`;
      $('#rvBy').textContent = `${n} — ${item}`;
      $('#rvCount').textContent = `${cur + 1} / ${reviews.length}`;
      rv.classList.remove('out');
    }, 450);
  }
  const restart = () => { clearInterval(auto); auto = setInterval(() => show(cur + 1), 6500); };
  $('#reviewPrev').onclick = () => { show(cur - 1); restart(); };
  $('#reviewNext').onclick = () => { show(cur + 1); restart(); };
  show(0); restart();

</script>
</body>
</html>