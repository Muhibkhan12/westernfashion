<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>All Jackets — The Western Fashion</title>
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
  .t-h1 { font-size:clamp(2.4rem,8vw,5rem); }

  /* reveals */
  [data-r] { opacity:0; transform:translateY(24px); transition:opacity .8s cubic-bezier(.2,.7,.2,1) var(--d,0s), transform .8s cubic-bezier(.2,.7,.2,1) var(--d,0s); }
  [data-r].in { opacity:1; transform:none; }
  .line { display:block; overflow:hidden; padding-bottom:.1em; }
  .line > span { display:block; transform:translateY(110%) rotate(3deg); transform-origin:left; animation:up 1.1s cubic-bezier(.2,.7,.2,1) forwards; animation-delay:calc(.2s + var(--i) * .14s); }
  @keyframes up { to { transform:none; } }
  .fade-in { opacity:0; animation:fi 1s ease forwards; animation-delay:var(--d,0s); } @keyframes fi { to { opacity:1; } }

  /* cards */
  .card-img { transition:transform 1.2s cubic-bezier(.2,.7,.2,1); } .group:hover .card-img { transform:scale(1.05); }
  .card-alt { opacity:0; transition:opacity .7s ease, transform 1.2s cubic-bezier(.2,.7,.2,1); } .group:hover .card-alt { opacity:1; transform:scale(1.05); }
  #grid { transition:opacity .25s ease, transform .25s ease; } #grid.out { opacity:0; transform:translateY(10px); }

  /* filter controls */
  .swatch-btn { width:26px; height:26px; border-radius:50%; border:1.5px solid rgba(28,26,22,.15); position:relative; transition:transform .3s cubic-bezier(.2,.7,.2,1); }
  .swatch-btn:hover { transform:scale(1.1); }
  .swatch-btn::after { content:''; position:absolute; inset:-5px; border:1.5px solid #1C1A16; border-radius:50%; transform:scale(.7); opacity:0; transition:transform .35s cubic-bezier(.2,.7,.2,1), opacity .25s; }
  .swatch-btn.active::after { transform:none; opacity:1; }
  .size-btn { border:1px solid rgba(28,26,22,.2); transition:background .25s, color .25s, border-color .25s; }
  .size-btn:hover { border-color:#1C1A16; }
  .size-btn.active { background:#1C1A16; color:#fff; border-color:#1C1A16; }
  .cat-row { transition:color .25s, padding .35s cubic-bezier(.2,.7,.2,1); }
  .cat-row:hover { padding-left:6px; }
  .cat-dot { opacity:0; transform:scale(0); transition:opacity .2s, transform .3s cubic-bezier(.2,.9,.3,1.4); }
  .cat-row.active .cat-dot { opacity:1; transform:none; }
  .chip { display:inline-flex; align-items:center; gap:8px; border:1px solid rgba(28,26,22,.18); padding:6px 12px; font:11px 'Space Mono',monospace; letter-spacing:.08em; text-transform:uppercase; transition:background .25s, color .25s, border-color .25s; }
  .chip:hover { background:#1C1A16; color:#fff; border-color:#1C1A16; }

  input[type="range"] { -webkit-appearance:none; appearance:none; height:20px; background:transparent; width:100%; cursor:pointer; --p:100%; }
  input[type="range"]::-webkit-slider-runnable-track { height:2px; background:linear-gradient(to right,#1C1A16 var(--p),rgba(28,26,22,.2) var(--p)); }
  input[type="range"]::-webkit-slider-thumb { -webkit-appearance:none; width:16px; height:16px; border-radius:50%; background:#1C1A16; margin-top:-7px; transition:transform .25s; }
  input[type="range"]:active::-webkit-slider-thumb { transform:scale(1.25); }
  input[type="range"]::-moz-range-track { height:2px; background:rgba(28,26,22,.2); }
  input[type="range"]::-moz-range-progress { height:2px; background:#1C1A16; }
  input[type="range"]::-moz-range-thumb { width:16px; height:16px; border:none; border-radius:50%; background:#1C1A16; }

  /* mobile filter panel */
  #fOverlay { opacity:0; pointer-events:none; transition:opacity .4s ease; } #fOverlay.open { opacity:1; pointer-events:auto; }
  #fPanel { transform:translateX(100%); visibility:hidden; transition:transform .5s cubic-bezier(.77,0,.18,1), visibility 0s .5s; }
  #fPanel.open { transform:none; visibility:visible; transition:transform .5s cubic-bezier(.77,0,.18,1); }

  input[type="email"] { font-size:16px; } @media (min-width:640px) { input[type="email"] { font-size:13px; } }

  @media (prefers-reduced-motion:reduce) {
    [data-r], .line > span, .fade-in { opacity:1; transform:none; animation:none; transition:none; }
    #fPanel, #fOverlay { transition:none; }
  }
</style>
</head>
<body class="antialiased bg-white">

@include('partials.header')

<!-- Breadcrumb + title -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 pt-12 md:pt-20 pb-8 md:pb-12">
  <p class="fade-in text-[11px] font-mono uppercase tracking-tag text-ink/45 mb-6" style="--d:.1s">
    <a href="{{ url('/') }}" class="ul pb-0.5">Home</a> / All Jackets
  </p>
  <div class="flex flex-wrap items-end justify-between gap-x-6 gap-y-3">
    <h1 class="t-h1 font-display leading-[1]"><span class="line" style="--i:0"><span>All Jackets</span></span></h1>
    <p id="resultCount" class="fade-in text-[12px] font-mono text-ink/50 pb-2" style="--d:.6s" aria-live="polite"></p>
  </div>
</section>

<!-- Mobile / tablet filter bar -->
<div class="lg:hidden sticky top-0 z-30 bg-white/90 backdrop-blur border-y border-ink/10">
  <div class="max-w-[1440px] mx-auto px-6 md:px-10 py-3 flex items-center justify-between gap-4">
    <button id="mobileFilterBtn" class="inline-flex items-center gap-3 text-[11px] font-mono uppercase tracking-tag py-1" aria-controls="fPanel" aria-expanded="false">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="4" y1="7" x2="20" y2="7"/><circle cx="9" cy="7" r="2" fill="#fff"/><line x1="4" y1="17" x2="20" y2="17"/><circle cx="15" cy="17" r="2" fill="#fff"/></svg>
      Filters <span id="filterCount" class="hidden min-w-[18px] h-[18px] px-1 rounded-full bg-brick text-paper text-[10px] leading-[18px] text-center"></span>
    </button>
    <p id="resultCountBar" class="text-[11px] font-mono text-ink/50"></p>
  </div>
</div>

<!-- Main layout -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 pt-8 lg:pt-4 pb-20 md:pb-28 grid grid-cols-1 lg:grid-cols-[240px_1fr] gap-10 lg:gap-14">

  <!-- Sidebar (desktop) -->
  <aside class="hidden lg:block">
    <div class="sticky top-24">
      <div class="flex items-center justify-between mb-6">
        <p class="text-[11px] font-mono uppercase tracking-tag text-brick">Filters</p>
        <button id="clearFilters" class="text-[11px] font-mono uppercase tracking-tag ul pb-0.5 text-ink/50 hover:text-ink">Clear</button>
      </div>

      <div class="pb-7">
        <p class="text-[13px] font-display-sm mb-3">Category</p>
        <div id="catList" class="space-y-0.5"></div>
      </div>
      <div class="border-t border-ink/10 py-7">
        <p class="text-[13px] font-display-sm mb-3">Price</p>
        <input id="priceRange" type="range" step="10" aria-label="Maximum price">
        <div class="flex items-center justify-between mt-2 text-[11px] font-mono text-ink/60">
          <span id="priceMinLabel"></span><span id="priceValue"></span>
        </div>
      </div>
      <div class="border-t border-ink/10 py-7">
        <p class="text-[13px] font-display-sm mb-4">Color</p>
        <div id="colorList" class="flex flex-wrap gap-3.5"></div>
      </div>
      <div class="border-t border-ink/10 py-7">
        <p class="text-[13px] font-display-sm mb-4">Size</p>
        <div id="sizeList" class="flex flex-wrap gap-2"></div>
      </div>
      <div class="border-t border-ink/10 pt-7">
        <p class="text-[13px] font-display-sm mb-3">Availability</p>
        <label class="flex items-center gap-2.5 text-[13px] cursor-pointer">
          <input id="inStockOnly" type="checkbox" class="accent-ink w-4 h-4"> In stock only
        </label>
      </div>
    </div>
  </aside>

  <!-- Off-canvas filters (phones & tablets) -->
  <div id="fOverlay" class="lg:hidden fixed inset-0 bg-black/40 z-[55]"></div>
  <div id="fPanel" class="lg:hidden fixed top-0 right-0 h-full w-[88%] max-w-sm bg-white z-[56] flex flex-col" role="dialog" aria-modal="true" aria-label="Filters" aria-hidden="true" inert>
    <div class="flex items-center justify-between px-6 py-5 border-b border-ink/10">
      <p class="text-[11px] font-mono uppercase tracking-tag text-brick">Filters</p>
      <div class="flex items-center gap-5">
        <button id="clearFiltersMobile" class="text-[11px] font-mono uppercase tracking-tag ul pb-0.5 text-ink/50">Clear</button>
        <button id="mobileFilterClose" aria-label="Close filters" class="p-2 -m-2">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="4" y1="4" x2="20" y2="20"/><line x1="20" y1="4" x2="4" y2="20"/></svg>
        </button>
      </div>
    </div>
    <div class="flex-1 overflow-y-auto overscroll-contain px-6">
      <div class="py-7">
        <p class="text-[13px] font-display-sm mb-3">Category</p>
        <div id="catListMobile" class="space-y-0.5"></div>
      </div>
      <div class="border-t border-ink/10 py-7">
        <p class="text-[13px] font-display-sm mb-3">Price</p>
        <input id="priceRangeMobile" type="range" step="10" aria-label="Maximum price">
        <div class="flex items-center justify-between mt-2 text-[11px] font-mono text-ink/60">
          <span id="priceMinLabelMobile"></span><span id="priceValueMobile"></span>
        </div>
      </div>
      <div class="border-t border-ink/10 py-7">
        <p class="text-[13px] font-display-sm mb-4">Color</p>
        <div id="colorListMobile" class="flex flex-wrap gap-3.5"></div>
      </div>
      <div class="border-t border-ink/10 py-7">
        <p class="text-[13px] font-display-sm mb-4">Size</p>
        <div id="sizeListMobile" class="flex flex-wrap gap-2"></div>
      </div>
      <div class="border-t border-ink/10 py-7">
        <p class="text-[13px] font-display-sm mb-3">Availability</p>
        <label class="flex items-center gap-2.5 text-[13px] cursor-pointer">
          <input id="inStockOnlyMobile" type="checkbox" class="accent-ink w-4 h-4"> In stock only
        </label>
      </div>
    </div>
    <div class="px-6 pt-4 border-t border-ink/10" style="padding-bottom:max(1rem, env(safe-area-inset-bottom))">
      <button id="applyMobileFilters" class="w-full bg-ink text-paper text-[11px] font-mono uppercase tracking-tag py-4">Show results</button>
    </div>
  </div>

  <!-- Product grid -->
  <div class="min-w-0">
    <div id="chips" class="flex flex-wrap gap-2 mb-8 empty:hidden"></div>
    <div id="grid" class="grid grid-cols-2 md:grid-cols-3 2xl:grid-cols-4 gap-x-4 sm:gap-x-5 gap-y-10 md:gap-y-12"></div>
    <div id="emptyState" class="hidden py-20 text-center">
      <p class="font-display text-2xl md:text-3xl mb-3">Nothing matches those filters.</p>
      <p class="text-[13px] text-ink/50 mb-8">Try clearing a few to see more jackets.</p>
      <button id="emptyClear" class="mag bg-ink text-paper text-[11px] font-mono uppercase tracking-tag px-8 py-4 border border-ink hover:bg-transparent hover:text-ink transition">Clear filters</button>
    </div>
  </div>
</section>

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
  <div class="py-6 text-center text-[11px] font-mono text-ink/40 tracking-tag uppercase">© {{ date('Y') }} The Western Fashion. All rights reserved.</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/lenis@1.1.18/dist/lenis.min.js"></script>
<script>
  // ---------- DATA FROM DATABASE (ShopController@index) ----------
  const PRODUCTS   = @json($items);
  const DB_CATS    = @json($categories);
  const ALL_COLORS = @json($allColors);
  const ALL_SIZES  = @json($allSizes);
  const PRICE_MIN  = {{ $minPrice }};
  const PRICE_MAX  = {{ $maxPrice }};
  const SHOW_URL   = @json(url('/shop'));

  const CATS = [{ id: "all", label: "All Jackets" }].concat(
    DB_CATS.map(c => ({ id: c.id, label: c.name }))
  );
  const $ = (s) => document.querySelector(s);
  const byId = (id) => document.getElementById(id);
  const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;

  function esc(str) {
    return String(str ?? "").replace(/[&<>"']/g, ch => ({
      "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;"
    }[ch]));
  }
  function twfFormatPrice(n) {
    return Number(n).toLocaleString("en-US", { style: "currency", currency: "USD", minimumFractionDigits: 0, maximumFractionDigits: 2 });
  }

  const state = { cat: "all", maxPrice: PRICE_MAX, colors: new Set(), sizes: new Set(), inStockOnly: false };

  // slider setup (dynamic min/max from DB)
  ["priceRange", "priceRangeMobile"].forEach(id => { const el = byId(id); el.min = PRICE_MIN; el.max = PRICE_MAX; el.value = PRICE_MAX; });
  byId("priceMinLabel").textContent = twfFormatPrice(PRICE_MIN);
  byId("priceMinLabelMobile").textContent = twfFormatPrice(PRICE_MIN);

  // --- Sidebar controls (desktop + mobile kept in sync) ---
  const catCount = (id) => PRODUCTS.filter(p => id === "all" || p.cat === id).length;

  function buildCategoryList(containerId) {
    const el = byId(containerId); el.innerHTML = "";
    CATS.forEach(c => {
      const on = state.cat === c.id;
      const row = document.createElement("button");
      row.className = `cat-row w-full flex items-center gap-2.5 py-2 text-[13px] text-left ${on ? "active text-ink" : "text-ink/55 hover:text-ink"}`;
      row.setAttribute("aria-pressed", String(on));
      row.innerHTML = `<span class="cat-dot w-1.5 h-1.5 rounded-full bg-brick shrink-0"></span><span class="flex-1">${esc(c.label)}</span><span class="text-[10px] font-mono text-ink/35">${catCount(c.id)}</span>`;
      row.addEventListener("click", () => { state.cat = c.id; syncControls(); applyFilters(); });
      el.appendChild(row);
    });
  }
  function buildColorList(containerId) {
    const el = byId(containerId); el.innerHTML = "";
    ALL_COLORS.forEach(c => {
      const btn = document.createElement("button");
      btn.className = `swatch-btn ${state.colors.has(c.name) ? "active" : ""}`;
      btn.style.background = c.hex;
      btn.setAttribute("aria-label", c.name); btn.setAttribute("aria-pressed", String(state.colors.has(c.name))); btn.title = c.name;
      btn.addEventListener("click", () => { state.colors.has(c.name) ? state.colors.delete(c.name) : state.colors.add(c.name); syncControls(); applyFilters(); });
      el.appendChild(btn);
    });
  }
  function buildSizeList(containerId) {
    const el = byId(containerId); el.innerHTML = "";
    ALL_SIZES.forEach(s => {
      const btn = document.createElement("button");
      btn.className = `size-btn min-w-10 h-10 px-2.5 text-[11px] font-mono ${state.sizes.has(s) ? "active" : ""}`;
      btn.textContent = s; btn.setAttribute("aria-pressed", String(state.sizes.has(s)));
      btn.addEventListener("click", () => { state.sizes.has(s) ? state.sizes.delete(s) : state.sizes.add(s); syncControls(); applyFilters(); });
      el.appendChild(btn);
    });
  }

  function syncControls() {
    buildCategoryList("catList"); buildCategoryList("catListMobile");
    buildColorList("colorList"); buildColorList("colorListMobile");
    buildSizeList("sizeList"); buildSizeList("sizeListMobile");
    const pct = PRICE_MAX > PRICE_MIN ? ((state.maxPrice - PRICE_MIN) / (PRICE_MAX - PRICE_MIN)) * 100 : 100;
    ["priceRange", "priceRangeMobile"].forEach(id => { const r = byId(id); r.value = state.maxPrice; r.style.setProperty("--p", pct + "%"); });
    byId("priceValue").textContent = `Up to ${twfFormatPrice(state.maxPrice)}`;
    byId("priceValueMobile").textContent = byId("priceValue").textContent;
    byId("inStockOnly").checked = state.inStockOnly;
    byId("inStockOnlyMobile").checked = state.inStockOnly;
  }

  // slider drags re-filter without replaying the card animation
  ["priceRange", "priceRangeMobile"].forEach(id => {
    byId(id).addEventListener("input", e => { state.maxPrice = Number(e.target.value); syncControls(); applyFilters(false); });
  });
  ["inStockOnly", "inStockOnlyMobile"].forEach(id => {
    byId(id).addEventListener("change", e => { state.inStockOnly = e.target.checked; syncControls(); applyFilters(); });
  });

  function clearAll() {
    state.cat = "all"; state.maxPrice = PRICE_MAX; state.colors.clear(); state.sizes.clear(); state.inStockOnly = false;
    syncControls(); applyFilters();
  }
  ["clearFilters", "clearFiltersMobile", "emptyClear"].forEach(id => byId(id).addEventListener("click", clearAll));

  // --- Mobile panel ---
  const panel = byId("fPanel"), overlay = byId("fOverlay"), fBtn = byId("mobileFilterBtn");
  function setPanel(open) {
    panel.classList.toggle("open", open); overlay.classList.toggle("open", open);
    panel.toggleAttribute("inert", !open); panel.setAttribute("aria-hidden", String(!open));
    fBtn.setAttribute("aria-expanded", String(open));
    if (window.lenis) open ? window.lenis.stop() : window.lenis.start();
    document.body.style.overflow = open ? "hidden" : "";
    if (open) setTimeout(() => byId("mobileFilterClose").focus(), 50); else fBtn.focus({ preventScroll: true });
  }
  fBtn.addEventListener("click", () => setPanel(true));
  byId("mobileFilterClose").addEventListener("click", () => setPanel(false));
  byId("applyMobileFilters").addEventListener("click", () => setPanel(false));
  overlay.addEventListener("click", () => setPanel(false));
  addEventListener("keydown", e => { if (e.key === "Escape" && panel.classList.contains("open")) setPanel(false); });
  matchMedia("(min-width:1024px)").addEventListener("change", e => { if (e.matches && panel.classList.contains("open")) setPanel(false); });

  // --- Grid rendering ---
  const grid = byId("grid"), emptyState = byId("emptyState");

  function cardHtml(p, i, animate) {
    const priceHtml = p.oldPrice
      ? `<span class="text-brick mr-2">${twfFormatPrice(p.price)}</span><span class="line-through text-ink/40">${twfFormatPrice(p.oldPrice)}</span>`
      : twfFormatPrice(p.price);

    const imageHtml = p.images.length
      ? `<img src="${esc(p.images[0])}" alt="${esc(p.name)}" loading="lazy" class="card-img absolute inset-0 w-full h-full object-cover">` +
        (p.images[1] ? `<img src="${esc(p.images[1])}" alt="" loading="lazy" aria-hidden="true" class="card-alt absolute inset-0 w-full h-full object-cover">` : "")
      : `<div class="absolute inset-0 flex items-center justify-center text-[11px] font-mono uppercase tracking-tag text-ink/30">No image</div>`;

    const badgeClass = p.badge === "Sale" ? "bg-brick text-paper" : p.badge === "Sold out" ? "bg-white text-ink/70" : "bg-ink text-paper";

    return `
      <a href="${SHOW_URL}/${esc(p.id)}" data-r style="--d:${(i % 6) * .06}s" class="group block ${animate ? "" : "in"}">
        <div class="relative bg-paperdeep aspect-[3/4] overflow-hidden mb-3">
          ${imageHtml}
          ${p.badge ? `<span class="absolute top-3 left-3 z-10 text-[10px] font-mono uppercase tracking-tag px-2.5 py-1 ${badgeClass}">${esc(p.badge)}</span>` : ""}
          <span class="absolute inset-x-0 bottom-0 z-10 translate-y-full group-hover:translate-y-0 transition duration-500 bg-ink text-paper text-[10px] font-mono uppercase tracking-tag text-center py-3">View jacket →</span>
        </div>
        <div class="flex flex-col gap-1.5 sm:flex-row sm:items-start sm:justify-between sm:gap-3">
          <div class="min-w-0">
            <p class="text-[10px] font-mono uppercase tracking-tag text-ink/50 mb-1">${esc(p.brand)}</p>
            <p class="text-[14px] font-display-sm mb-2">${esc(p.name)}</p>
            <div class="flex items-center gap-1.5">${p.colors.map(c => `<span class="w-2.5 h-2.5 rounded-full border border-ink/10" style="background:${esc(c.hex)}"></span>`).join("")}</div>
          </div>
          <p class="text-[13px] font-mono whitespace-nowrap">${priceHtml}</p>
        </div>
      </a>`;
  }

  const io = new IntersectionObserver(es => es.forEach(e => {
    if (!e.isIntersecting) return;
    e.target.classList.add("in"); io.unobserve(e.target);
  }), { threshold: .12, rootMargin: "0px 0px -6% 0px" });

  function activeChips() {
    const chips = [];
    if (state.cat !== "all") chips.push([CATS.find(c => c.id === state.cat)?.label ?? state.cat, () => { state.cat = "all"; }]);
    if (state.maxPrice < PRICE_MAX) chips.push([`Up to ${twfFormatPrice(state.maxPrice)}`, () => { state.maxPrice = PRICE_MAX; }]);
    state.colors.forEach(c => chips.push([c, () => state.colors.delete(c)]));
    state.sizes.forEach(s => chips.push([`Size ${s}`, () => state.sizes.delete(s)]));
    if (state.inStockOnly) chips.push(["In stock", () => { state.inStockOnly = false; }]);
    return chips;
  }

  function renderChips() {
    const wrap = byId("chips"), chips = activeChips();
    wrap.innerHTML = "";
    chips.forEach(([label, remove]) => {
      const b = document.createElement("button");
      b.className = "chip"; b.setAttribute("aria-label", `Remove filter ${label}`);
      b.innerHTML = `${esc(label)} <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="4" y1="4" x2="20" y2="20"/><line x1="20" y1="4" x2="4" y2="20"/></svg>`;
      b.addEventListener("click", () => { remove(); syncControls(); applyFilters(); });
      wrap.appendChild(b);
    });
    const badge = byId("filterCount");
    badge.textContent = chips.length; badge.classList.toggle("hidden", chips.length === 0);
  }

  function applyFilters(animate = true) {
    const filtered = PRODUCTS.filter(p => {
      if (state.cat !== "all" && p.cat !== state.cat) return false;
      if (p.price > state.maxPrice) return false;
      if (state.colors.size && !p.colors.some(c => state.colors.has(c.name))) return false;
      if (state.sizes.size && !p.sizes.some(s => state.sizes.has(s))) return false;
      if (state.inStockOnly && !p.inStock) return false;
      return true;
    });

    const render = () => {
      grid.innerHTML = filtered.map((p, i) => cardHtml(p, i, animate)).join("");
      if (animate) grid.querySelectorAll("[data-r]").forEach(el => io.observe(el));
      grid.classList.toggle("hidden", filtered.length === 0);
      emptyState.classList.toggle("hidden", filtered.length !== 0);
      grid.classList.remove("out");
    };
    // quick fade-out / fade-in swap when the list changes (not while dragging the slider)
    if (animate && !reduce && grid.children.length) { grid.classList.add("out"); setTimeout(render, 220); } else render();

    const label = `${filtered.length} ${filtered.length === 1 ? "jacket" : "jackets"}`;
    byId("resultCount").textContent = label;
    byId("resultCountBar").textContent = label;
    byId("applyMobileFilters").textContent = `Show ${label}`;
    renderChips();
  }

  // --- Read ?category= from URL (category id or name both work) ---
  const params = new URLSearchParams(window.location.search);
  const initialCat = (params.get("category") || "").toLowerCase();
  if (initialCat) {
    const match = CATS.find(c => String(c.id).toLowerCase() === initialCat || c.label.toLowerCase() === initialCat);
    if (match) state.cat = match.id;
  }

  syncControls();
  applyFilters();

  /* ---------- smooth scroll (exposed so the header menu can pause it) ---------- */
  let lenis = null;
  if (window.Lenis && !reduce) {
    lenis = new Lenis({ duration: 1.25, easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)) });
    window.lenis = lenis;
    (function raf(t) { lenis.raf(t); requestAnimationFrame(raf); })(0);
  }

  /* ---------- footer wordmark fits any screen ---------- */
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