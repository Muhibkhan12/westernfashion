{{-- resources/views/partials/header.blade.php --}}
{{-- Usage: @include('partials.header') right after <body> --}}
{{-- Needs on the page: Tailwind (with the paper/ink/brick colors + font-display/font-mono config) and the Fraunces / Space Mono fonts. --}}

<style>
  /* ---- header partial styles ---- */
  .ul { background-image:linear-gradient(currentColor,currentColor); background-position:0 100%; background-repeat:no-repeat; background-size:0% 1px; transition:background-size .4s cubic-bezier(.2,.7,.2,1); }
  .ul:hover, .ul.on { background-size:100% 1px; }
  .tracking-tag { letter-spacing:.14em; } .tracking-wordmark { letter-spacing:.16em; }
  .marquee { display:flex; width:max-content; animation:mq 40s linear infinite; } @keyframes mq { to { transform:translateX(-50%); } }

  #hdr { transition:transform .5s cubic-bezier(.2,.7,.2,1), box-shadow .3s; }
  #hdr.hide { transform:translateY(-100%); }
  #hdr.stuck { box-shadow:0 8px 30px -20px rgba(28,26,22,.35); }

  #menu { clip-path:circle(0 at 28px 28px); transition:clip-path .8s cubic-bezier(.77,0,.18,1); pointer-events:none; }
  #menu.open { clip-path:circle(150% at 28px 28px); pointer-events:auto; }
  #menu a { opacity:0; transform:translateY(28px); transition:.6s cubic-bezier(.2,.7,.2,1); }
  #menu.open a { opacity:1; transform:none; transition-delay:calc(.3s + var(--i) * .08s); }

  #hdr a:focus-visible, #hdr button:focus-visible, #menu a:focus-visible, #menu button:focus-visible { outline:1.5px solid #9A3D28; outline-offset:4px; }

  @media (prefers-reduced-motion:reduce) { .marquee { animation:none; } }
</style>

<!-- Scroll progress bar -->
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

<!-- Announcement marquee -->
<div class="bg-ink text-paper overflow-hidden py-2">
  <div class="marquee text-[11px] font-mono tracking-tag uppercase" id="mq"></div>
</div>

<!-- Header -->
<header id="hdr" class="sticky top-0 z-40 bg-white/90 backdrop-blur-md">
  <div class="max-w-[1440px] mx-auto grid grid-cols-3 items-center px-6 md:px-10 py-4">
    <div class="flex items-center gap-6">
      <button id="menuBtn" aria-label="Menu" class="flex items-center">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="3" y1="8" x2="21" y2="8"/><line x1="3" y1="16" x2="15" y2="16"/></svg>
      </button>
      <nav class="hidden md:flex items-center gap-6 text-[11px] font-mono uppercase tracking-tag">
        <a href="{{ route('shop.products') }}" class="ul pb-0.5">Catalog</a>
        <a href="{{ url('/about') }}" class="ul pb-0.5">About</a>
        <a href="{{ url('/contact') }}" class="ul pb-0.5">Contact</a>
      </nav>
    </div>
    <a href="{{ url('/') }}" class="font-display text-center text-base sm:text-xl md:text-2xl tracking-wordmark uppercase whitespace-nowrap">The Western Fashion</a>
    <div class="flex items-center justify-end gap-4 md:gap-5 text-[11px] font-mono uppercase tracking-tag">
      <button id="darkToggle" class="hidden sm:flex items-center gap-1.5" aria-label="Toggle dark mode">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
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

<script>
  (function () {
    const $ = (s) => document.querySelector(s);

    /* marquee text */
    $('#mq').innerHTML = Array(4).fill(["Midseason sale — 20% off, auto-applied","Free shipping over $150","Small-batch jackets","30-day returns"]
      .map(t => `<span class="px-8">${t}</span><span class="text-paper/40">✦</span>`).join('')).join('');

    /* scroll progress + hide/show header */
    const hdr = $('#hdr'), prog = $('#progress');
    let lastY = 0, ticking = false;
    function onScroll() {
      const y = window.scrollY, max = document.documentElement.scrollHeight - innerHeight;
      prog.style.transform = `scaleX(${max > 0 ? y / max : 0})`;
      hdr.classList.toggle('stuck', y > 20);
      hdr.classList.toggle('hide', y > 300 && y > lastY + 4);
      if (y < lastY - 4) hdr.classList.remove('hide');
      lastY = y; ticking = false;
    }
    addEventListener('scroll', () => { if (!ticking) { ticking = true; requestAnimationFrame(onScroll); } }, { passive: true });
    addEventListener('resize', onScroll); onScroll();

    /* fullscreen menu (pauses Lenis if the page exposes it as window.lenis) */
    const menu = $('#menu');
    const setMenu = (open) => {
      menu.classList.toggle('open', open);
      if (window.lenis) open ? window.lenis.stop() : window.lenis.start();
      document.body.style.overflow = open ? 'hidden' : '';
    };
    $('#menuBtn').addEventListener('click', () => setMenu(true));
    $('#menuClose').addEventListener('click', () => setMenu(false));
    menu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => setMenu(false)));
    addEventListener('keydown', (e) => e.key === 'Escape' && setMenu(false));

    /* dark toggle */
    $('#darkToggle').addEventListener('click', () => {
      const on = document.body.classList.toggle('invert-mode');
      document.body.style.filter = on ? 'invert(1) hue-rotate(180deg)' : 'none';
    });
  })();
</script>