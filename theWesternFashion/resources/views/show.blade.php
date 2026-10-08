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
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,400;0,9..144,500;0,9..144,600;1,9..144,400;1,9..144,500&family=Inter+Tight:wght@400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          paper: '#FFFFFF',
          paperdeep: '#F4F4F4',
          ink: '#1C1A16',
          brick: '#9A3D28',
          sage: '#57624A',
          card: '#FFFFFF',
        },
        fontFamily: {
          display: ['"Fraunces"', 'serif'],
          body: ['"Inter Tight"', 'sans-serif'],
          mono: ['"Space Mono"', 'monospace'],
        },
      }
    }
  }
</script>
<style>
  html { scroll-behavior: smooth; }
  body { font-family: 'Inter Tight', sans-serif; background: #FFFFFF; color: #1C1A16; }
  .font-display { font-family: 'Fraunces', serif; font-variation-settings: 'opsz' 40; }
  .font-display-sm { font-family: 'Fraunces', serif; font-variation-settings: 'opsz' 18; }
  .font-mono { font-family: 'Space Mono', monospace; }
  .tracking-tag { letter-spacing: 0.14em; }
  .tracking-wordmark { letter-spacing: 0.16em; }

  ::selection { background: #1C1A16; color: #FFFFFF; }

  .underline-link { background-image: linear-gradient(#1C1A16,#1C1A16); background-position: 0 100%; background-repeat: no-repeat; background-size: 0% 1px; transition: background-size .3s ease; }
  .underline-link:hover { background-size: 100% 1px; }

  .stitch { border: none; border-top: 1.5px dashed rgba(28,26,22,0.28); }

  .hang-tag { position: relative; padding-left: 20px; }
  .hang-tag::before { content: ''; position: absolute; left: 7px; top: 50%; transform: translateY(-50%); width: 5px; height: 5px; border-radius: 50%; background: currentColor; opacity: 0.55; }

  .swatch-btn { width: 26px; height: 26px; border-radius: 50%; border: 1.5px solid rgba(28,26,22,0.15); position: relative; }
  .swatch-btn.active::after { content: ''; position: absolute; inset: -5px; border: 1.5px solid #1C1A16; border-radius: 50%; }

  .size-btn { border: 1px solid rgba(28,26,22,0.2); transition: all .15s ease; }
  .size-btn:hover:not(:disabled):not(.active) { border-color: #1C1A16; }
  .size-btn.active { background: #1C1A16; color: #FFFFFF; border-color: #1C1A16; }
  .size-btn:disabled { color: rgba(28,26,22,0.3); border-style: dashed; cursor: not-allowed; text-decoration: line-through; }

  .thumb { border: 1.5px solid transparent; opacity: .6; transition: all .2s ease; }
  .thumb:hover { opacity: 1; }
  .thumb.active { border-color: #1C1A16; opacity: 1; }

  .fade-in { animation: fadeIn .4s ease both; }
  @keyframes fadeIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: none; } }

  #toast { transition: transform .35s cubic-bezier(.65,0,.35,1), opacity .35s ease; }
</style>
</head>
<body class="antialiased bg-white">

<!-- Top promo bar -->
<div class="bg-ink text-paper text-[11px] font-mono tracking-tag uppercase text-center py-2 px-4">
  Midseason Sale — 20% Off, Auto-Applied at Checkout — Limited Time
</div>

<!-- Header -->
<header class="sticky top-0 z-40 bg-white/92 backdrop-blur border-b border-ink/10">
  <div class="max-w-[1440px] mx-auto flex items-center justify-between px-6 md:px-10 py-4">
    <div class="flex items-center gap-6">
      <button class="flex items-center gap-2 text-[11px] font-mono uppercase tracking-tag">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
      </button>
      <nav class="hidden md:flex items-center gap-6 text-[11px] font-mono uppercase tracking-tag">
        <a href="#" class="underline-link pb-0.5">Presets</a>
        <a href="{{ route('shop.products') }}" class="underline-link pb-0.5">Catalog</a>
        <a href="{{ url('/about') }}" class="underline-link pb-0.5">About</a>
        <a href="#" class="underline-link pb-0.5">Journal</a>
      </nav>
    </div>

    <a href="{{ url('/') }}" class="font-display text-lg sm:text-xl md:text-2xl tracking-wordmark uppercase whitespace-nowrap">The Western Fashion</a>

    <div class="flex items-center gap-4 md:gap-5 text-[11px] font-mono uppercase tracking-tag">
      <button class="hidden sm:flex items-center gap-1.5">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <span class="hidden lg:inline">Search</span>
      </button>
      <span class="hidden sm:inline text-ink/25">|</span>
      <span class="hidden sm:inline">CA</span>
      <span class="hidden sm:inline">EN</span>
      <button aria-label="Account">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4.4 3.6-8 8-8s8 3.6 8 8"/></svg>
      </button>
      <a href="{{ route('cart.index') }}" aria-label="Cart" class="relative">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 6h15l-1.5 9h-12z"/><path d="M6 6 5 3H2"/><circle cx="9" cy="20" r="1"/><circle cx="18" cy="20" r="1"/></svg>
        <span id="cartCount" class="absolute -top-2 -right-3 text-[10px] font-mono">{{ app(\App\Services\CartService::class)->count() ?: '' }}</span>
      </a>
    </div>
  </div>
</header>

<!-- Breadcrumb -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 pt-10 pb-6">
  <p class="text-[11px] font-mono uppercase tracking-tag text-ink/45">
    <a href="{{ url('/') }}" class="underline-link">Home</a> /
    <a href="{{ route('shop.products') }}" class="underline-link">All Jackets</a>
    @if($product->category)
      / <a href="{{ route('shop.products', ['category' => $product->category_id]) }}" class="underline-link">{{ $product->category->name }}</a>
    @endif
    / <span class="text-ink/70">{{ $product->name }}</span>
  </p>
</section>

<!-- Product -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 pb-20 grid grid-cols-1 lg:grid-cols-[1.1fr_1fr] gap-10 lg:gap-16">

  <!-- Gallery -->
  <div class="fade-in">
    <div class="grid grid-cols-[72px_1fr] gap-4">

      <!-- Thumbs -->
      <div class="flex flex-col gap-3 order-1" id="thumbs">
        @foreach($images as $i => $src)
          <button type="button" class="thumb {{ $i === 0 ? 'active' : '' }} bg-paperdeep aspect-[3/4] overflow-hidden" data-index="{{ $i }}" aria-label="Image {{ $i + 1 }}">
            <img src="{{ $src }}" alt="{{ $product->name }} thumbnail {{ $i + 1 }}" class="w-full h-full object-cover">
          </button>
        @endforeach
      </div>

      <!-- Main image -->
      <div class="relative bg-paperdeep aspect-[3/4] overflow-hidden order-2">
        @if($images->count())
          <img id="mainImage" src="{{ $images[0] }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
        @else
          <div class="w-full h-full flex items-center justify-center text-[11px] font-mono uppercase tracking-tag text-ink/30">No image</div>
        @endif

        @if($totalStock <= 0)
          <span class="hang-tag absolute top-4 right-4 text-[10px] font-mono uppercase tracking-tag px-3 py-1.5 bg-white/95 text-ink/70">Sold out</span>
        @elseif($hasSale)
          <span class="hang-tag absolute top-4 right-4 text-[10px] font-mono uppercase tracking-tag px-3 py-1.5 bg-brick text-paper">Sale</span>
        @elseif($product->featured)
          <span class="hang-tag absolute top-4 right-4 text-[10px] font-mono uppercase tracking-tag px-3 py-1.5 bg-ink/90 text-paper">Featured</span>
        @endif
      </div>
    </div>
  </div>

  <!-- Details -->
  <div class="lg:sticky lg:top-24 lg:self-start fade-in">
    <p class="text-[10px] font-mono uppercase tracking-tag text-ink/50 mb-3">{{ $product->category->name ?? 'The Western Fashion' }}</p>
    <h1 class="font-display text-3xl md:text-4xl mb-5">{{ $product->name }}</h1>

    <p class="text-[20px] font-mono mb-6">
      @if($oldPrice)
        <span class="text-brick mr-3" id="priceNow"></span><span class="line-through text-ink/40 text-[16px]" id="priceOld"></span>
      @else
        <span id="priceNow"></span>
      @endif
    </p>

    @if($product->description)
      <p class="text-[14px] text-ink/70 leading-relaxed mb-8 max-w-md">{!! nl2br(e($product->description)) !!}</p>
    @endif

    <hr class="stitch mb-8">

    <!-- Color -->
    @if($colors->count())
      <div class="mb-7">
        <div class="flex items-center justify-between mb-4">
          <p class="text-[13px] font-display-sm">Color</p>
          <p id="colorLabel" class="text-[11px] font-mono uppercase tracking-tag text-ink/50"></p>
        </div>
        <div id="colorList" class="flex flex-wrap gap-4"></div>
      </div>
    @endif

    <!-- Size -->
    <div class="mb-7">
      <div class="flex items-center justify-between mb-4">
        <p class="text-[13px] font-display-sm">Size</p>
        <p id="sizeLabel" class="text-[11px] font-mono uppercase tracking-tag text-ink/50"></p>
      </div>
      <div id="sizeList" class="flex flex-wrap gap-2"></div>
    </div>

    <!-- Stock message -->
    <p id="stockMsg" class="text-[12px] font-mono text-ink/60 mb-6 min-h-[18px]"></p>

    <!-- Qty + Add to cart -->
    <div class="flex items-stretch gap-3 mb-4">
      <div class="flex items-center border border-ink/20">
        <button type="button" id="qtyMinus" class="w-10 h-12 text-lg" aria-label="Decrease quantity">−</button>
        <span id="qtyValue" class="w-8 text-center text-[13px] font-mono">1</span>
        <button type="button" id="qtyPlus" class="w-10 h-12 text-lg" aria-label="Increase quantity">+</button>
      </div>
      <button type="button" id="addToCart" disabled
        class="flex-1 bg-ink text-paper text-[11px] font-mono uppercase tracking-tag py-4 transition disabled:opacity-40 disabled:cursor-not-allowed hover:bg-ink/90">
        Select a size
      </button>
    </div>

    <!-- Buy now -->
    <button type="button" id="buyNow" disabled
      class="w-full border border-ink text-ink text-[11px] font-mono uppercase tracking-tag py-4 mb-4 transition disabled:opacity-40 disabled:cursor-not-allowed hover:bg-ink hover:text-paper">
      Buy now
    </button>

    <p id="skuLine" class="text-[11px] font-mono text-ink/40 mb-8 min-h-[16px]"></p>

    <hr class="stitch mb-6">

    <ul class="space-y-2.5 text-[12px] text-ink/60 font-mono">
      <li>— Free shipping on orders over $150</li>
      <li>— 30-day easy returns</li>
      <li>— Midseason sale auto-applied at checkout</li>
    </ul>
  </div>
</section>

<!-- Related -->
@if($related->count())
  <section class="max-w-[1440px] mx-auto px-6 md:px-10 pb-24">
    <hr class="stitch mb-12">
    <div class="flex items-end justify-between mb-8">
      <h2 class="font-display text-2xl md:text-3xl">You may also like</h2>
      <a href="{{ route('shop.products') }}" class="text-[11px] font-mono uppercase tracking-tag underline-link">View all</a>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-x-5 gap-y-12">
      @foreach($related as $r)
        @php
          $rSale   = $r->sale_price !== null;
          $rPrice  = (float) ($rSale ? $r->sale_price : $r->price);
          $rOld    = $rSale ? (float) $r->price : null;
          $rImg    = $r->images->sortBy(fn ($i) => $i->is_primary ? 0 : 1)->first();
          $rStock  = (int) $r->variants->sum('stock');
        @endphp
        <a href="{{ route('shop.show', $r->id) }}" class="group block">
          <div class="relative bg-paperdeep aspect-[3/4] overflow-hidden mb-3">
            @if($rImg)
              <img src="{{ asset('storage/' . $rImg->image_path) }}" alt="{{ $r->name }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-[1.03] transition duration-500">
            @else
              <div class="w-full h-full flex items-center justify-center text-[11px] font-mono uppercase tracking-tag text-ink/30">No image</div>
            @endif

            @if($rStock <= 0)
              <span class="hang-tag absolute top-3 right-3 text-[10px] font-mono uppercase tracking-tag px-3 py-1.5 bg-white/95 text-ink/70">Sold out</span>
            @elseif($rSale)
              <span class="hang-tag absolute top-3 right-3 text-[10px] font-mono uppercase tracking-tag px-3 py-1.5 bg-brick text-paper">Sale</span>
            @endif
          </div>
          <p class="text-[10px] font-mono uppercase tracking-tag text-ink/50 mb-1">{{ $product->category->name ?? '' }}</p>
          <p class="text-[14px] font-display-sm underline-link mb-1.5">{{ $r->name }}</p>
          <p class="text-[14px] font-mono">
            @if($rOld)
              <span class="text-brick mr-2 js-price" data-v="{{ $rPrice }}"></span><span class="line-through text-ink/40 js-price" data-v="{{ $rOld }}"></span>
            @else
              <span class="js-price" data-v="{{ $rPrice }}"></span>
            @endif
          </p>
        </a>
      @endforeach
    </div>
  </section>
@endif

<!-- Toast -->
<div id="toast" class="fixed bottom-6 left-1/2 -translate-x-1/2 translate-y-24 opacity-0 bg-ink text-paper text-[11px] font-mono uppercase tracking-tag px-5 py-3 z-50 pointer-events-none"></div>

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
        <li><a href="#" class="underline-link">Women's Jackets</a></li>
        <li><a href="#" class="underline-link">Men's Jackets</a></li>
      </ul>
    </div>
    <div>
      <p class="text-[11px] font-mono uppercase tracking-tag text-brick mb-4">Company</p>
      <ul class="space-y-2.5 text-[13px]">
        <li><a href="{{ url('/about') }}" class="underline-link">About</a></li>
        <li><a href="#" class="underline-link">Journal</a></li>
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
  <div class="border-t border-ink/10 py-5 text-center text-[11px] font-mono text-ink/40 tracking-tag uppercase">
    © {{ date('Y') }} The Western Fashion. All rights reserved.
  </div>
</footer>

<script>
  // ---------- DATA FROM DATABASE (ShopController@show) ----------
  const PRODUCT_ID   = @json($product->id);
  const PRODUCT_NAME = @json($product->name);
  const IMAGES       = @json($images);
  const VARIANTS     = @json($variants);   // [{id, sku, size, color, stock}]
  const COLORS       = @json($colors);     // [{name, hex}]
  const PRICE        = {{ $price }};
  const OLD_PRICE    = {!! $oldPrice ? $oldPrice : 'null' !!};
  const SIZE_ORDER   = ["XXS", "XS", "S", "M", "L", "XL", "XXL", "3XL"];

  function esc(str) {
    return String(str ?? "").replace(/[&<>"']/g, ch => ({
      "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;"
    }[ch]));
  }

  function twfFormatPrice(n) {
    return Number(n).toLocaleString("en-US", {
      style: "currency", currency: "USD",
      minimumFractionDigits: 0, maximumFractionDigits: 2
    });
  }

  // prices
  document.getElementById("priceNow").textContent = twfFormatPrice(PRICE);
  const priceOldEl = document.getElementById("priceOld");
  if (priceOldEl && OLD_PRICE) priceOldEl.textContent = twfFormatPrice(OLD_PRICE);
  document.querySelectorAll(".js-price").forEach(el => el.textContent = twfFormatPrice(el.dataset.v));

  // ---------- GALLERY ----------
  const mainImage = document.getElementById("mainImage");
  document.querySelectorAll("#thumbs .thumb").forEach(btn => {
    btn.addEventListener("click", () => {
      const i = Number(btn.dataset.index);
      if (mainImage && IMAGES[i]) mainImage.src = IMAGES[i];
      document.querySelectorAll("#thumbs .thumb").forEach(b => b.classList.remove("active"));
      btn.classList.add("active");
    });
  });

  // ---------- VARIANT SELECTION ----------
  const hasColors = COLORS.length > 0;
  const state = { color: null, size: null, qty: 1 };

  const colorListEl  = document.getElementById("colorList");
  const colorLabelEl = document.getElementById("colorLabel");
  const sizeListEl   = document.getElementById("sizeList");
  const sizeLabelEl  = document.getElementById("sizeLabel");
  const stockMsgEl   = document.getElementById("stockMsg");
  const skuLineEl    = document.getElementById("skuLine");
  const qtyValueEl   = document.getElementById("qtyValue");
  const addBtn       = document.getElementById("addToCart");
  const buyBtn       = document.getElementById("buyNow");

  // variants visible for the chosen color (or all, if the product has no colors)
  function variantsForColor() {
    return hasColors ? VARIANTS.filter(v => v.color === state.color) : VARIANTS;
  }

  function sortedSizes(list) {
    return [...list].sort((a, b) => {
      const ia = SIZE_ORDER.indexOf(String(a.size).toUpperCase());
      const ib = SIZE_ORDER.indexOf(String(b.size).toUpperCase());
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
      btn.className = `size-btn min-w-11 h-11 px-3 text-[11px] font-mono ${state.size === v.size ? "active" : ""}`;
      btn.textContent = v.size;
      btn.addEventListener("click", () => {
        state.size = v.size;
        state.qty = 1;
        render();
      });
      sizeListEl.appendChild(btn);
    });
    sizeLabelEl.textContent = state.size || "";
  }

  function renderStatus() {
    const v = currentVariant();

    if (!v) {
      stockMsgEl.textContent = "";
      skuLineEl.textContent = "";
      addBtn.disabled = true;
      addBtn.textContent = "Select a size";
      buyBtn.disabled = true;
      buyBtn.textContent = "Buy now";
      qtyValueEl.textContent = state.qty;
      return;
    }

    if (v.stock <= 0) {
      stockMsgEl.textContent = "Sold out in this size.";
      addBtn.disabled = true;
      addBtn.textContent = "Sold out";
      buyBtn.disabled = true;
    } else {
      stockMsgEl.textContent = v.stock <= 5 ? `Only ${v.stock} left — order soon.` : "In stock.";
      addBtn.disabled = false;
      addBtn.textContent = "Add to cart";
      buyBtn.disabled = false;
      buyBtn.textContent = "Buy now";
    }

    if (state.qty > v.stock) state.qty = Math.max(1, v.stock);
    qtyValueEl.textContent = state.qty;
    skuLineEl.textContent = v.sku ? `SKU: ${v.sku}` : "";
  }

  function render() {
    renderColors();
    renderSizes();
    renderStatus();
  }

  // qty
  document.getElementById("qtyMinus").addEventListener("click", () => {
    if (state.qty > 1) { state.qty--; renderStatus(); }
  });
  document.getElementById("qtyPlus").addEventListener("click", () => {
    const v = currentVariant();
    const max = v ? v.stock : 10;
    if (state.qty < max) { state.qty++; renderStatus(); }
  });

  // toast
  const toast = document.getElementById("toast");
  let toastTimer;
  function showToast(msg) {
    toast.textContent = msg;
    toast.classList.remove("translate-y-24", "opacity-0");
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => toast.classList.add("translate-y-24", "opacity-0"), 2600);
  }

  // ---------- ADD TO CART / BUY NOW ----------
  const cartCountEl = document.getElementById("cartCount");

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

  addBtn.addEventListener("click", async () => {
    const v = currentVariant();
    if (!v || v.stock <= 0) return;

    addBtn.disabled = true;
    buyBtn.disabled = true;
    try {
      const data = await postToCart(v.id, state.qty);
      if (cartCountEl) cartCountEl.textContent = data.count || "";
      showToast(`Added ${state.qty} × ${PRODUCT_NAME}`);
    } catch (e) {
      showToast(e.message);
    } finally {
      renderStatus();
    }
  });

  buyBtn.addEventListener("click", async () => {
    const v = currentVariant();
    if (!v || v.stock <= 0) return;

    addBtn.disabled = true;
    buyBtn.disabled = true;
    buyBtn.textContent = "Please wait…";
    try {
      await postToCart(v.id, state.qty);
      window.location.href = "{{ route('checkout.show') }}";
    } catch (e) {
      showToast(e.message);
      renderStatus();
    }
  });

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
</script>
</body>
</html>