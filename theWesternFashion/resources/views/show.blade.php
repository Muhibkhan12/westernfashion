<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $product->name }} — The Western Fashion</title>
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
  html { -webkit-text-size-adjust:100%; }
  body { font-family:'Inter Tight',sans-serif; background:#fff; color:#1C1A16; overflow-x:hidden; }
  .font-display { font-family:'Fraunces',serif; font-variation-settings:'opsz' 40; }
  .font-display-sm { font-family:'Fraunces',serif; font-variation-settings:'opsz' 18; }
  .font-mono { font-family:'Space Mono',monospace; }
  .tracking-tag { letter-spacing:.14em; } .tracking-wordmark { letter-spacing:.16em; }
  ::selection { background:#1C1A16; color:#fff; }
  html.lenis, html.lenis body { height:auto; } .lenis.lenis-smooth { scroll-behavior:auto!important; }
  html:not(.lenis) { scroll-behavior:smooth; }
  a:focus-visible, button:focus-visible, input:focus-visible { outline:1.5px solid #9A3D28; outline-offset:4px; }

  .ul { background-image:linear-gradient(currentColor,currentColor); background-position:0 100%; background-repeat:no-repeat; background-size:0% 1px; transition:background-size .4s cubic-bezier(.2,.7,.2,1); }
  .ul:hover, .ul.on { background-size:100% 1px; }
  .t-title { font-size:clamp(2rem,5.2vw,3.5rem); }
  .t-h2 { font-size:clamp(1.75rem,4.4vw,3rem); }

  /* reveals */
  [data-r] { opacity:0; transform:translateY(24px); transition:opacity .9s cubic-bezier(.2,.7,.2,1) var(--d,0s), transform .9s cubic-bezier(.2,.7,.2,1) var(--d,0s); }
  [data-r].in { opacity:1; transform:none; }
  .line { display:block; overflow:hidden; padding-bottom:.1em; }
  .line > span { display:block; transform:translateY(110%) rotate(3deg); transform-origin:left; animation:up 1.1s cubic-bezier(.2,.7,.2,1) forwards; animation-delay:calc(.2s + var(--i) * .14s); }
  @keyframes up { to { transform:none; } }
  .fade-in { opacity:0; animation:fi 1s ease forwards; animation-delay:var(--d,0s); } @keyframes fi { to { opacity:1; } }
  .rule { height:1px; background:rgba(28,26,22,.12); transform-origin:left; transform:scaleX(0); transition:transform 1.2s cubic-bezier(.77,0,.18,1); } .rule.in { transform:scaleX(1); }

  /* gallery */
  #mainWrap { cursor:default; touch-action:pan-y; }
  #mainImage { transition:opacity .28s ease, transform .6s cubic-bezier(.2,.7,.2,1); transform-origin:var(--zx,50%) var(--zy,50%); }
  #mainImage.swap { opacity:0; }
  #mainWrap.zoom { cursor:zoom-in; } #mainWrap.zoom.zooming #mainImage { transform:scale(1.9); }
  .thumb { position:relative; opacity:.55; transition:opacity .3s; } .thumb:hover, .thumb.active { opacity:1; }
  .thumb::after { content:''; position:absolute; left:0; right:0; bottom:0; height:2px; background:#1C1A16; transform:scaleX(0); transform-origin:left; transition:transform .5s cubic-bezier(.77,0,.18,1); }
  .thumb.active::after { transform:scaleX(1); }
  .g-arrow { transition:background .25s, color .25s, opacity .3s; } .g-arrow:hover { background:#1C1A16; color:#fff; }
  #thumbs { scrollbar-width:none; } #thumbs::-webkit-scrollbar { display:none; }

  /* selectors */
  .swatch-btn { width:28px; height:28px; border-radius:50%; border:1.5px solid rgba(28,26,22,.15); position:relative; transition:transform .3s cubic-bezier(.2,.7,.2,1); }
  .swatch-btn:hover { transform:scale(1.1); }
  .swatch-btn::after { content:''; position:absolute; inset:-5px; border:1.5px solid #1C1A16; border-radius:50%; transform:scale(.7); opacity:0; transition:transform .35s cubic-bezier(.2,.7,.2,1), opacity .25s; }
  .swatch-btn.active::after { transform:none; opacity:1; }
  .size-btn { border:1px solid rgba(28,26,22,.2); transition:background .25s, color .25s, border-color .25s, transform .25s; }
  .size-btn:hover:not(:disabled):not(.active) { border-color:#1C1A16; }
  .size-btn:active:not(:disabled) { transform:scale(.95); }
  .size-btn.active { background:#1C1A16; color:#fff; border-color:#1C1A16; }
  .size-btn:disabled { color:rgba(28,26,22,.3); border-style:dashed; cursor:not-allowed; text-decoration:line-through; }
  .cta { transition:background .3s, color .3s, opacity .3s, transform .3s cubic-bezier(.2,.7,.2,1); }
  .cta:not(:disabled):active { transform:scale(.985); }
  .shake { animation:shake .45s; } @keyframes shake { 20%,60% { transform:translateX(-5px); } 40%,80% { transform:translateX(5px); } }

  /* cards */
  .card-img { transition:transform 1.2s cubic-bezier(.2,.7,.2,1); } .group:hover .card-img { transform:scale(1.05); }

  #toast { transition:transform .45s cubic-bezier(.2,.7,.2,1), opacity .35s ease; }
  #stickyBar { transition:transform .5s cubic-bezier(.2,.7,.2,1); }

  input[type="email"] { font-size:16px; } @media (min-width:640px) { input[type="email"] { font-size:13px; } }
  @media (prefers-reduced-motion:reduce) {
    [data-r], .line > span, .fade-in { opacity:1; transform:none; animation:none; transition:none; } .rule { transform:none; }
    #mainImage, #stickyBar, #toast { transition:none; } .shake { animation:none; }
  }
</style>
</head>
<body class="antialiased bg-white">

@include('partials.header')

<!-- Breadcrumb -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 pt-8 md:pt-12 pb-6">
  <p class="fade-in text-[11px] font-mono uppercase tracking-tag text-ink/45 leading-relaxed" style="--d:.1s">
    <a href="{{ url('/') }}" class="ul pb-0.5">Home</a> /
    <a href="{{ route('shop.products') }}" class="ul pb-0.5">All Jackets</a>
    @if($product->category)
      / <a href="{{ route('shop.products', ['category' => $product->category_id]) }}" class="ul pb-0.5">{{ $product->category->name }}</a>
    @endif
    / <span class="text-ink/70">{{ $product->name }}</span>
  </p>
</section>

<!-- Product -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 pb-20 md:pb-28 grid grid-cols-1 lg:grid-cols-[1.1fr_1fr] gap-10 lg:gap-16">

  <!-- Gallery -->
  <div class="min-w-0 fade-in" style="--d:.15s">
    <div class="grid grid-cols-1 md:grid-cols-[80px_1fr] gap-3 md:gap-4">

      <!-- Thumbs -->
      <div id="thumbs" class="order-2 md:order-1 flex md:flex-col gap-2.5 md:gap-3 overflow-x-auto md:overflow-visible">
        @foreach($images as $i => $src)
          <button type="button" class="thumb {{ $i === 0 ? 'active' : '' }} shrink-0 w-16 md:w-full bg-paperdeep aspect-[3/4] overflow-hidden" data-index="{{ $i }}" aria-label="Show image {{ $i + 1 }}">
            <img src="{{ $src }}" alt="{{ $product->name }} thumbnail {{ $i + 1 }}" loading="lazy" class="w-full h-full object-cover">
          </button>
        @endforeach
      </div>

      <!-- Main image -->
      <div id="mainWrap" class="order-1 md:order-2 relative bg-paperdeep aspect-[3/4] overflow-hidden">
        @if($images->count())
          <img id="mainImage" src="{{ $images[0] }}" alt="{{ $product->name }}" class="absolute inset-0 w-full h-full object-cover" draggable="false">
        @else
          <div class="absolute inset-0 flex items-center justify-center text-[11px] font-mono uppercase tracking-tag text-ink/30">No image</div>
        @endif

        @if($totalStock <= 0)
          <span class="absolute top-4 left-4 z-10 text-[10px] font-mono uppercase tracking-tag px-3 py-1.5 bg-white text-ink/70">Sold out</span>
        @elseif($hasSale)
          <span class="absolute top-4 left-4 z-10 text-[10px] font-mono uppercase tracking-tag px-3 py-1.5 bg-brick text-paper">Sale</span>
        @elseif($product->featured)
          <span class="absolute top-4 left-4 z-10 text-[10px] font-mono uppercase tracking-tag px-3 py-1.5 bg-ink text-paper">Featured</span>
        @endif

        @if($images->count() > 1)
          <button type="button" id="gPrev" class="g-arrow absolute left-3 top-1/2 -translate-y-1/2 z-10 w-11 h-11 rounded-full bg-white/90 flex items-center justify-center" aria-label="Previous image">←</button>
          <button type="button" id="gNext" class="g-arrow absolute right-3 top-1/2 -translate-y-1/2 z-10 w-11 h-11 rounded-full bg-white/90 flex items-center justify-center" aria-label="Next image">→</button>
          <p id="gCount" class="absolute bottom-4 right-4 z-10 text-[10px] font-mono tracking-tag bg-white/90 px-2.5 py-1" aria-live="polite"></p>
        @endif
      </div>
    </div>
  </div>

  <!-- Details -->
  <div class="min-w-0 lg:sticky lg:top-24 lg:self-start">
    <p class="fade-in text-[10px] font-mono uppercase tracking-tag text-ink/50 mb-4" style="--d:.2s">{{ $product->category->name ?? 'The Western Fashion' }}</p>
    <h1 class="t-title font-display leading-[1.05] mb-5"><span class="line" style="--i:0"><span>{{ $product->name }}</span></span></h1>

    <p class="fade-in text-[20px] font-mono mb-6" style="--d:.5s">
      @if($oldPrice)
        <span class="text-brick mr-3" id="priceNow"></span><span class="line-through text-ink/40 text-[16px]" id="priceOld"></span>
      @else
        <span id="priceNow"></span>
      @endif
    </p>

    @if($product->description)
      <p class="text-[14px] text-ink/70 leading-relaxed mb-8 max-w-md" data-r>{!! nl2br(e($product->description)) !!}</p>
    @endif

    <div class="rule mb-8" data-rule></div>

    <!-- Color -->
    @if($colors->count())
      <div class="mb-7" data-r>
        <div class="flex items-center justify-between mb-4">
          <p class="text-[13px] font-display-sm">Color</p>
          <p id="colorLabel" class="text-[11px] font-mono uppercase tracking-tag text-ink/50"></p>
        </div>
        <div id="colorList" class="flex flex-wrap gap-4 p-1"></div>
      </div>
    @endif

    <!-- Size -->
    <div id="sizeBlock" class="mb-7" data-r style="--d:.05s">
      <div class="flex items-center justify-between mb-4">
        <p class="text-[13px] font-display-sm">Size</p>
        <p id="sizeLabel" class="text-[11px] font-mono uppercase tracking-tag text-ink/50"></p>
      </div>
      <div id="sizeList" class="flex flex-wrap gap-2"></div>
    </div>

    <!-- Stock message -->
    <p id="stockMsg" class="text-[12px] font-mono text-ink/60 mb-6 min-h-[18px]" aria-live="polite"></p>

    <!-- Qty + Add to cart -->
    <div class="flex items-stretch gap-3 mb-3">
      <div class="flex items-center border border-ink/20">
        <button type="button" id="qtyMinus" class="w-11 h-14 text-lg hover:bg-paperdeep transition" aria-label="Decrease quantity">−</button>
        <span id="qtyValue" class="w-8 text-center text-[13px] font-mono" aria-live="polite">1</span>
        <button type="button" id="qtyPlus" class="w-11 h-14 text-lg hover:bg-paperdeep transition" aria-label="Increase quantity">+</button>
      </div>
      <button type="button" id="addToCart" disabled
        class="cta flex-1 bg-ink text-paper text-[11px] font-mono uppercase tracking-tag py-4 border border-ink disabled:opacity-40 disabled:cursor-not-allowed hover:bg-transparent hover:text-ink">
        Select a size
      </button>
    </div>

    <!-- Buy now -->
    <button type="button" id="buyNow" disabled
      class="cta w-full border border-ink text-ink text-[11px] font-mono uppercase tracking-tag py-4 mb-4 disabled:opacity-40 disabled:cursor-not-allowed hover:bg-ink hover:text-paper">
      Buy now
    </button>

    <p id="skuLine" class="text-[11px] font-mono text-ink/40 mb-8 min-h-[16px]"></p>

    <div class="rule mb-6" data-rule></div>

    <ul class="space-y-2.5 text-[12px] text-ink/60 font-mono" data-r>
      <li>— Free shipping on orders over $150</li>
      <li>— 30-day easy returns</li>
      <li>— Midseason sale auto-applied at checkout</li>
    </ul>
  </div>
</section>

<!-- Related -->
@if($related->count())
  <section class="max-w-[1440px] mx-auto px-6 md:px-10 pb-20 md:pb-28">
    <div class="rule mb-12" data-rule></div>
    <div class="flex flex-wrap items-end justify-between gap-x-6 gap-y-3 mb-10" data-r>
      <h2 class="t-h2 font-display leading-[1.1]">You may also like</h2>
      <a href="{{ route('shop.products') }}" class="text-[11px] font-mono uppercase tracking-tag ul pb-0.5">View all</a>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-x-4 sm:gap-x-5 gap-y-10 md:gap-y-12">
      @foreach($related as $r)
        @php
          $rSale   = $r->sale_price !== null;
          $rPrice  = (float) ($rSale ? $r->sale_price : $r->price);
          $rOld    = $rSale ? (float) $r->price : null;
          $rImg    = $r->images->sortBy(fn ($i) => $i->is_primary ? 0 : 1)->first();
          $rStock  = (int) $r->variants->sum('stock');
        @endphp
        <a href="{{ route('shop.show', $r->id) }}" class="group block" data-r style="--d:{{ ($loop->index % 4) * .08 }}s">
          <div class="relative bg-paperdeep aspect-[3/4] overflow-hidden mb-3">
            @if($rImg)
              <img src="{{ asset('storage/' . $rImg->image_path) }}" alt="{{ $r->name }}" loading="lazy" class="card-img absolute inset-0 w-full h-full object-cover">
            @else
              <div class="absolute inset-0 flex items-center justify-center text-[11px] font-mono uppercase tracking-tag text-ink/30">No image</div>
            @endif

            @if($rStock <= 0)
              <span class="absolute top-3 left-3 z-10 text-[10px] font-mono uppercase tracking-tag px-2.5 py-1 bg-white text-ink/70">Sold out</span>
            @elseif($rSale)
              <span class="absolute top-3 left-3 z-10 text-[10px] font-mono uppercase tracking-tag px-2.5 py-1 bg-brick text-paper">Sale</span>
            @endif
            <span class="absolute inset-x-0 bottom-0 z-10 translate-y-full group-hover:translate-y-0 transition duration-500 bg-ink text-paper text-[10px] font-mono uppercase tracking-tag text-center py-3">View jacket →</span>
          </div>
          <div class="flex flex-col gap-1.5 sm:flex-row sm:items-start sm:justify-between sm:gap-3">
            <div class="min-w-0">
              <p class="text-[10px] font-mono uppercase tracking-tag text-ink/50 mb-1">{{ $product->category->name ?? '' }}</p>
              <p class="text-[14px] font-display-sm">{{ $r->name }}</p>
            </div>
            <p class="text-[13px] font-mono whitespace-nowrap">
              @if($rOld)
                <span class="text-brick mr-2 js-price" data-v="{{ $rPrice }}"></span><span class="line-through text-ink/40 js-price" data-v="{{ $rOld }}"></span>
              @else
                <span class="js-price" data-v="{{ $rPrice }}"></span>
              @endif
            </p>
          </div>
        </a>
      @endforeach
    </div>
  </section>
@endif

<!-- Mobile sticky add-to-cart (appears when the main button scrolls out of view) -->
<div id="stickyBar" class="lg:hidden fixed inset-x-0 bottom-0 z-40 bg-white/95 backdrop-blur border-t border-ink/10 translate-y-full" inert style="padding-bottom:max(.75rem, env(safe-area-inset-bottom))">
  <div class="px-5 pt-3 flex items-center gap-4">
    <div class="min-w-0">
      <p class="truncate text-[13px] font-display-sm">{{ $product->name }}</p>
      <p id="barPrice" class="text-[12px] font-mono text-ink/70"></p>
    </div>
    <button type="button" id="barBtn" class="cta ml-auto shrink-0 bg-ink text-paper text-[11px] font-mono uppercase tracking-tag px-6 py-3.5 border border-ink disabled:opacity-40 disabled:cursor-not-allowed">Select a size</button>
  </div>
</div>

<!-- Toast -->
<div id="toast" class="fixed bottom-24 lg:bottom-6 left-1/2 -translate-x-1/2 translate-y-24 opacity-0 bg-ink text-paper text-[11px] font-mono uppercase tracking-tag px-5 py-3 z-50 pointer-events-none max-w-[90vw] text-center" role="status" aria-live="polite"></div>

<!-- Footer -->
<footer class="bg-white overflow-hidden border-t border-ink/10">
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
  <p id="bigMark" class="font-display uppercase text-center leading-none whitespace-nowrap select-none text-ink/90" style="letter-spacing:.04em"><span class="inline-block">The Western Fashion</span></p>
  <div class="py-6 pb-24 lg:pb-6 text-center text-[11px] font-mono text-ink/40 tracking-tag uppercase">© {{ date('Y') }} The Western Fashion. All rights reserved.</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/lenis@1.1.18/dist/lenis.min.js"></script>
<script>
  // ---------- DATA FROM DATABASE (ShopController@show) ----------
  const PRODUCT_ID   = @json($product->id);
  const PRODUCT_NAME = @json($product->name);
  const IMAGES       = Object.values(@json($images));
  const VARIANTS     = @json($variants);   // [{id, sku, size, color, stock}]
  const COLORS       = @json($colors);     // [{name, hex}]
  const PRICE        = {{ $price }};
  const OLD_PRICE    = {!! $oldPrice ? $oldPrice : 'null' !!};
  const SIZE_ORDER   = ["XXS", "XS", "S", "M", "L", "XL", "XXL", "3XL"];

  const $ = (s) => document.querySelector(s);
  const byId = (id) => document.getElementById(id);
  const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;

  function twfFormatPrice(n) {
    return Number(n).toLocaleString("en-US", { style: "currency", currency: "USD", minimumFractionDigits: 0, maximumFractionDigits: 2 });
  }

  // prices
  byId("priceNow").textContent = twfFormatPrice(PRICE);
  const priceOldEl = byId("priceOld");
  if (priceOldEl && OLD_PRICE) priceOldEl.textContent = twfFormatPrice(OLD_PRICE);
  byId("barPrice").textContent = twfFormatPrice(PRICE);
  document.querySelectorAll(".js-price").forEach(el => el.textContent = twfFormatPrice(el.dataset.v));

  // ---------- GALLERY ----------
  const mainImage = byId("mainImage"), mainWrap = byId("mainWrap"), thumbs = [...document.querySelectorAll("#thumbs .thumb")];
  const gCount = byId("gCount");
  let gi = 0, swapToken = 0;
  IMAGES.forEach(src => { const im = new Image(); im.src = src; });   // preload

  function showImage(i) {
    if (!mainImage || !IMAGES.length) return;
    gi = (i + IMAGES.length) % IMAGES.length;
    const token = ++swapToken;
    mainWrap.classList.remove("zooming");
    mainImage.classList.add("swap");
    setTimeout(() => {
      if (token !== swapToken) return;
      mainImage.src = IMAGES[gi];
      const done = () => mainImage.classList.remove("swap");
      mainImage.complete ? done() : (mainImage.onload = done);
    }, reduce ? 0 : 200);
    thumbs.forEach((b, k) => b.classList.toggle("active", k === gi));
    thumbs[gi] && thumbs[gi].scrollIntoView({ block: "nearest", inline: "center", behavior: reduce ? "auto" : "smooth" });
    if (gCount) gCount.textContent = `${gi + 1} / ${IMAGES.length}`;
  }
  thumbs.forEach(btn => btn.addEventListener("click", () => showImage(Number(btn.dataset.index))));
  byId("gPrev") && byId("gPrev").addEventListener("click", () => showImage(gi - 1));
  byId("gNext") && byId("gNext").addEventListener("click", () => showImage(gi + 1));
  if (gCount) gCount.textContent = `1 / ${IMAGES.length}`;

  if (mainWrap && IMAGES.length) {
    // swipe on touch screens
    let tx = 0, ty = 0;
    mainWrap.addEventListener("touchstart", e => { tx = e.touches[0].clientX; ty = e.touches[0].clientY; }, { passive: true });
    mainWrap.addEventListener("touchend", e => {
      const dx = e.changedTouches[0].clientX - tx, dy = e.changedTouches[0].clientY - ty;
      if (Math.abs(dx) > 45 && Math.abs(dx) > Math.abs(dy) * 1.5) showImage(gi + (dx < 0 ? 1 : -1));
    }, { passive: true });

    // hover zoom on mouse devices
    if (matchMedia("(hover:hover) and (pointer:fine)").matches && !reduce) {
      mainWrap.classList.add("zoom");
      mainWrap.addEventListener("mouseenter", () => mainWrap.classList.add("zooming"));
      mainWrap.addEventListener("mouseleave", () => mainWrap.classList.remove("zooming"));
      mainWrap.addEventListener("mousemove", e => {
        const r = mainWrap.getBoundingClientRect();
        mainImage.style.setProperty("--zx", ((e.clientX - r.left) / r.width * 100) + "%");
        mainImage.style.setProperty("--zy", ((e.clientY - r.top) / r.height * 100) + "%");
      });
    }
    // arrow keys when the gallery has focus
    byId("thumbs").addEventListener("keydown", e => { if (e.key === "ArrowRight" || e.key === "ArrowDown") showImage(gi + 1); if (e.key === "ArrowLeft" || e.key === "ArrowUp") showImage(gi - 1); });
  }

  // ---------- VARIANT SELECTION ----------
  const hasColors = COLORS.length > 0;
  const state = { color: null, size: null, qty: 1 };

  const colorListEl = byId("colorList"), colorLabelEl = byId("colorLabel"), sizeListEl = byId("sizeList"), sizeLabelEl = byId("sizeLabel"),
        stockMsgEl = byId("stockMsg"), skuLineEl = byId("skuLine"), qtyValueEl = byId("qtyValue"),
        addBtn = byId("addToCart"), buyBtn = byId("buyNow"), barBtn = byId("barBtn");

  // variants visible for the chosen color (or all, if the product has no colors)
  function variantsForColor() { return hasColors ? VARIANTS.filter(v => v.color === state.color) : VARIANTS; }

  function sortedSizes(list) {
    return [...list].sort((a, b) => {
      const ia = SIZE_ORDER.indexOf(String(a.size).toUpperCase()), ib = SIZE_ORDER.indexOf(String(b.size).toUpperCase());
      return (ia === -1 ? 100 : ia) - (ib === -1 ? 100 : ib);
    });
  }

  function currentVariant() {
    if (!state.size) return null;
    return variantsForColor().find(v => v.size === state.size) || null;
  }

  function renderColors() {
    if (!hasColors) return;
    colorListEl.innerHTML = "";
    COLORS.forEach(c => {
      const btn = document.createElement("button");
      btn.type = "button";
      btn.className = `swatch-btn ${state.color === c.name ? "active" : ""}`;
      btn.style.background = c.hex;
      btn.title = c.name;
      btn.setAttribute("aria-label", c.name);
      btn.setAttribute("aria-pressed", String(state.color === c.name));
      btn.addEventListener("click", () => {
        state.color = c.name;
        // reset the size if it is missing or out of stock in this color
        const match = variantsForColor().find(v => v.size === state.size);
        if (!match || match.stock <= 0) state.size = null;
        state.qty = 1;
        render();
      });
      colorListEl.appendChild(btn);
    });
    colorLabelEl.textContent = state.color || "";
  }

  function renderSizes() {
    sizeListEl.innerHTML = "";
    sortedSizes(variantsForColor()).forEach(v => {
      const btn = document.createElement("button");
      btn.type = "button";
      btn.disabled = v.stock <= 0;
      btn.className = `size-btn min-w-12 h-12 px-3 text-[11px] font-mono ${state.size === v.size ? "active" : ""}`;
      btn.textContent = v.size;
      btn.setAttribute("aria-pressed", String(state.size === v.size));
      btn.addEventListener("click", () => { state.size = v.size; state.qty = 1; render(); });
      sizeListEl.appendChild(btn);
    });
    sizeLabelEl.textContent = state.size || "";
  }

  function syncBar() {
    barBtn.textContent = addBtn.textContent;
    // with no size chosen the bar button stays enabled so it can scroll to the size picker
    barBtn.disabled = addBtn.disabled && currentVariant() !== null;
  }

  function renderStatus() {
    const v = currentVariant();

    if (!v) {
      stockMsgEl.textContent = "";
      skuLineEl.textContent = "";
      addBtn.disabled = true; addBtn.textContent = "Select a size";
      buyBtn.disabled = true; buyBtn.textContent = "Buy now";
      qtyValueEl.textContent = state.qty;
      syncBar();
      return;
    }

    if (v.stock <= 0) {
      stockMsgEl.textContent = "Sold out in this size.";
      addBtn.disabled = true; addBtn.textContent = "Sold out";
      buyBtn.disabled = true;
    } else {
      stockMsgEl.textContent = v.stock <= 5 ? `Only ${v.stock} left — order soon.` : "In stock.";
      addBtn.disabled = false; addBtn.textContent = "Add to cart";
      buyBtn.disabled = false; buyBtn.textContent = "Buy now";
    }

    if (state.qty > v.stock) state.qty = Math.max(1, v.stock);
    qtyValueEl.textContent = state.qty;
    skuLineEl.textContent = v.sku ? `SKU: ${v.sku}` : "";
    syncBar();
  }

  function render() { renderColors(); renderSizes(); renderStatus(); }

  // qty
  byId("qtyMinus").addEventListener("click", () => { if (state.qty > 1) { state.qty--; renderStatus(); } });
  byId("qtyPlus").addEventListener("click", () => {
    const v = currentVariant(), max = v ? v.stock : 10;
    if (state.qty < max) { state.qty++; renderStatus(); }
  });

  // toast
  const toast = byId("toast");
  let toastTimer;
  function showToast(msg) {
    toast.textContent = msg;
    toast.classList.remove("translate-y-24", "opacity-0");
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => toast.classList.add("translate-y-24", "opacity-0"), 2600);
  }

  // keep the header cart badge in step with the server's count
  function updateHeaderCart(n) {
    const a = document.querySelector('#hdr a[aria-label^="Cart"]');
    if (!a) return;
    let b = a.querySelector(".badge");
    if (n > 0) {
      if (!b) { b = document.createElement("span"); b.className = "badge"; a.appendChild(b); }
      b.textContent = n; b.style.animation = "none"; void b.offsetWidth; b.style.animation = "";
    } else if (b) b.remove();
  }

  // ---------- ADD TO CART / BUY NOW ----------
  async function postToCart(variantId, qty) {
    const res = await fetch("{{ route('cart.add') }}", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "Accept": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({ variant_id: variantId, qty })
    });
    const data = await res.json().catch(() => ({}));
    if (!res.ok) {
      const firstError = data.errors ? Object.values(data.errors)[0][0] : null;
      throw new Error(firstError || data.message || "Could not add to cart");
    }
    return data;
  }

  async function addToCart() {
    const v = currentVariant();
    if (!v || v.stock <= 0) return;

    addBtn.disabled = true; buyBtn.disabled = true; addBtn.textContent = "Adding…"; syncBar();
    try {
      const data = await postToCart(v.id, state.qty);
      updateHeaderCart(Number(data.count) || 0);
      showToast(`Added ${state.qty} × ${PRODUCT_NAME}`);
      addBtn.textContent = "Added ✓"; syncBar();
      await new Promise(r => setTimeout(r, 1200));
    } catch (e) {
      showToast(e.message);
    } finally {
      renderStatus();
    }
  }
  addBtn.addEventListener("click", addToCart);

  buyBtn.addEventListener("click", async () => {
    const v = currentVariant();
    if (!v || v.stock <= 0) return;

    addBtn.disabled = true; buyBtn.disabled = true; buyBtn.textContent = "Please wait…"; syncBar();
    try {
      await postToCart(v.id, state.qty);
      window.location.href = "{{ route('checkout.show') }}";
    } catch (e) {
      showToast(e.message);
      renderStatus();
    }
  });

  // mobile sticky bar: add to cart, or jump to the size picker if nothing is selected yet
  barBtn.addEventListener("click", () => {
    if (currentVariant()) return addToCart();
    const block = byId("sizeBlock");
    block.scrollIntoView({ behavior: reduce ? "auto" : "smooth", block: "center" });
    sizeListEl.classList.remove("shake"); void sizeListEl.offsetWidth; sizeListEl.classList.add("shake");
    showToast("Please choose a size");
  });
  const bar = byId("stickyBar");
  new IntersectionObserver(([e]) => {
    const show = !e.isIntersecting;
    bar.classList.toggle("translate-y-full", !show);
    bar.toggleAttribute("inert", !show);
  }, { threshold: 0 }).observe(addBtn);

  // ---------- INIT ----------
  if (hasColors) {
    // first color that has stock, otherwise the first color
    const inStockColor = COLORS.find(c => VARIANTS.some(v => v.color === c.name && v.stock > 0));
    state.color = (inStockColor || COLORS[0]).name;
  }
  // if only one size is in stock, select it automatically
  const initial = variantsForColor().filter(v => v.stock > 0);
  if (initial.length === 1) state.size = initial[0].size;

  render();

  /* ---------- reveals, smooth scroll, footer wordmark ---------- */
  const io = new IntersectionObserver(es => es.forEach(e => {
    if (!e.isIntersecting) return;
    e.target.classList.add("in"); io.unobserve(e.target);
  }), { threshold: .12, rootMargin: "0px 0px -6% 0px" });
  document.querySelectorAll("[data-r], [data-rule]").forEach(el => io.observe(el));

  let lenis = null;
  if (window.Lenis && !reduce) {
    lenis = new Lenis({ duration: 1.25, easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)) });
    window.lenis = lenis;
    (function raf(t) { lenis.raf(t); requestAnimationFrame(raf); })(0);
  }

  const mark = byId("bigMark");
  const fitMark = () => { mark.style.fontSize = "100px"; const w = mark.firstElementChild.getBoundingClientRect().width; mark.style.fontSize = (100 * mark.parentElement.clientWidth * .94 / w) + "px"; };
  let lastW = innerWidth;
  addEventListener("resize", () => { if (innerWidth !== lastW) { lastW = innerWidth; fitMark(); } });
  addEventListener("load", fitMark);
  if (document.fonts && document.fonts.ready) document.fonts.ready.then(fitMark);
  fitMark();
</script>
</body>
</html>