{{-- resources/views/partials/header.blade.php --}}
{{-- Usage: @include('partials.header') right after <body> --}}
{{-- Needs on the page: Tailwind (with the paper/ink/brick colors + font-display/font-mono config) and the Fraunces / Space Mono fonts. --}}

@php
  $cartCount = (int) app(\App\Services\CartService::class)->count();
  $links = [
    ['Catalog', route('shop.products'), request()->routeIs('shop.*')],
    ['About',   url('/about'),          request()->is('about')],
    ['Contact', url('/contact'),        request()->is('contact')],
  ];
  $menuLinks = array_merge($links, [['Cart', route('cart.index'), request()->routeIs('cart.*')]]);
@endphp

<style>
  /* ---- header partial styles ---- */
  .ul { background-image:linear-gradient(currentColor,currentColor); background-position:0 100%; background-repeat:no-repeat; background-size:0% 1px; transition:background-size .4s cubic-bezier(.2,.7,.2,1); }
  .ul:hover, .ul.on { background-size:100% 1px; }
  .tracking-tag { letter-spacing:.14em; } .tracking-wordmark { letter-spacing:.16em; }

  /* header shell */
  #hdr { background:rgba(255,255,255,.96); transition:transform .55s cubic-bezier(.2,.7,.2,1), background .4s, box-shadow .4s; }
  #hdr.stuck { background:rgba(255,255,255,.8); -webkit-backdrop-filter:blur(14px) saturate(1.2); backdrop-filter:blur(14px) saturate(1.2); box-shadow:0 10px 30px -24px rgba(28,26,22,.45); }
  #hdr.hide { transform:translateY(-100%); }
  #hdr::after { content:''; position:absolute; left:0; right:0; bottom:0; height:1px; background:rgba(28,26,22,.1); transform:scaleX(0); transition:transform .7s cubic-bezier(.77,0,.18,1); }
  #hdr.stuck::after { transform:scaleX(1); }

  /* layout: [left | wordmark | right] — wordmark never gets crushed */
  .hdr-in { display:grid; grid-template-columns:1fr auto 1fr; align-items:center; column-gap:8px; max-width:1440px; margin-inline:auto; padding:14px 20px; transition:padding .45s cubic-bezier(.2,.7,.2,1); }
  #hdr.stuck .hdr-in { padding-block:10px; }
  @media (min-width:640px)  { .hdr-in { padding-inline:24px; column-gap:16px; } }
  @media (min-width:768px)  { .hdr-in { padding:20px 40px; } #hdr.stuck .hdr-in { padding-block:12px; } }

  /* wordmark scales from 320px phones to ultrawide */
  .wm { font-size:clamp(11px,3.5vw,15px); letter-spacing:.07em; transition:letter-spacing .7s cubic-bezier(.2,.7,.2,1); }
  @media (min-width:400px)  { .wm { letter-spacing:.1em; } }
  @media (min-width:640px)  { .wm { font-size:20px; letter-spacing:.16em; } }
  @media (min-width:1024px) { .wm { font-size:22px; } }
  @media (min-width:1280px) { .wm { font-size:24px; } }

  /* touch-friendly hit areas without changing the layout */
  .hit { display:inline-flex; padding:10px; margin:-10px; }

  /* rolling nav links (desktop) */
  .roll { position:relative; display:inline-block; overflow:hidden; height:1.5em; line-height:1.5em; vertical-align:bottom; }
  .roll span { display:block; transition:transform .55s cubic-bezier(.2,.7,.2,1); }
  .roll span::after { content:attr(data-t); display:block; color:#9A3D28; }
  .roll:focus-visible span { transform:translateY(-50%); }
  .roll[aria-current="page"]::before { content:''; position:absolute; left:0; right:0; bottom:2px; height:1px; background:currentColor; }

  /* menu button: two lines */
  #menuBtn i { display:block; height:1px; background:currentColor; transition:width .45s cubic-bezier(.2,.7,.2,1); }
  #menuBtn i:first-child { width:20px; } #menuBtn i:last-child { width:12px; margin-top:6px; }

  /* hover-only effects: skipped on touch screens so nothing gets "stuck" */
  @media (hover:hover) {
    .roll:hover span { transform:translateY(-50%); }
    .wm:hover { letter-spacing:.2em; }
    #menuBtn:hover i:last-child { width:20px; }
    #menu.open nav:hover .mlink a:not(:hover) { opacity:.3; }
    #menu .mlink a:hover { transform:translateX(18px); font-style:italic; }
    #menuClose:hover svg { transform:rotate(90deg); }
  }

  /* cart badge */
  .badge { position:absolute; top:3px; right:-1px; min-width:16px; height:16px; padding:0 4px; border-radius:999px; background:#9A3D28; color:#fff; font-size:9px; line-height:16px; text-align:center; letter-spacing:0; animation:pop .6s cubic-bezier(.2,.9,.3,1.4) .5s backwards; }
  @keyframes pop { from { transform:scale(0); } }

  /* dark toggle icon swap */
  .dk-ico { position:relative; display:block; width:16px; height:16px; }
  .dk-ico svg { position:absolute; inset:0; transition:transform .6s cubic-bezier(.2,.7,.2,1), opacity .4s; }
  .dk-ico .sun { opacity:0; transform:rotate(-90deg) scale(.5); }
  html.dark .dk-ico .moon { opacity:0; transform:rotate(90deg) scale(.5); }
  html.dark .dk-ico .sun { opacity:1; transform:none; }
  html.dark { filter:invert(1) hue-rotate(180deg); }
  html.dark img, html.dark video { filter:invert(1) hue-rotate(180deg); }

  /* fullscreen menu */
  #menu { overflow-y:auto; -webkit-overflow-scrolling:touch; overscroll-behavior:contain; padding-bottom:max(2rem, env(safe-area-inset-bottom)); clip-path:circle(0 at 28px 28px); transition:clip-path .9s cubic-bezier(.77,0,.18,1), visibility 0s .9s; pointer-events:none; visibility:hidden; }
  #menu.open { clip-path:circle(150% at 28px 28px); transition:clip-path .9s cubic-bezier(.77,0,.18,1); pointer-events:auto; visibility:visible; }
  .mtxt { font-size:clamp(2.25rem, min(11vw, 11vh), 6.5rem); line-height:1.05; }
  .mlink { overflow:hidden; padding-bottom:.08em; }
  .mlink a { display:inline-block; transition:transform .6s cubic-bezier(.2,.7,.2,1), opacity .4s; }
  #menu.open .mlink a { animation:mIn 1s cubic-bezier(.2,.7,.2,1) backwards; animation-delay:calc(.35s + var(--i) * .09s); }
  @keyframes mIn { from { transform:translateY(110%) rotate(3deg); } }
  .m-fade { opacity:0; transition:opacity .8s ease; } #menu.open .m-fade { opacity:1; transition-delay:.8s; }
  #menuClose svg { transition:transform .6s cubic-bezier(.2,.7,.2,1); }

  #hdr a:focus-visible, #hdr button:focus-visible, #menu a:focus-visible, #menu button:focus-visible { outline:1.5px solid #9A3D28; outline-offset:4px; }

  @media (prefers-reduced-motion:reduce) {
    .badge, #menu.open .mlink a { animation:none; }
    #hdr, .hdr-in, #menu, .roll span { transition:none; }
  }
</style>

<!-- Scroll progress bar -->
<div id="progress" class="fixed top-0 left-0 h-[2px] bg-brick z-[70] w-full origin-left" style="transform:scaleX(0)"></div>

<!-- Fullscreen menu -->
<div id="menu" class="fixed inset-0 z-[60] bg-ink text-paper flex flex-col px-6 sm:px-10 md:px-20 pt-6 md:pt-8" role="dialog" aria-modal="true" aria-label="Site menu" aria-hidden="true" inert>
  <button id="menuClose" class="self-start inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-tag py-2">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="5" y1="5" x2="19" y2="19"/><line x1="19" y1="5" x2="5" y2="19"/></svg> Close
  </button>

  <nav class="flex-1 flex flex-col justify-center gap-1 md:gap-3 py-6">
    @foreach ($menuLinks as $i => [$label, $href, $active])
      <div class="mlink">
        <a style="--i:{{ $i }}" href="{{ $href }}" class="mtxt font-display {{ $label === 'Cart' ? 'text-paper/50' : '' }}" @if($active) aria-current="page" @endif>{{ $label }}@if($label === 'Cart' && $cartCount)<sup class="font-mono text-[12px] tracking-tag ml-2 align-top text-paper/60">{{ $cartCount }}</sup>@endif</a>
      </div>
    @endforeach
  </nav>

  <div class="m-fade flex flex-wrap items-end justify-between gap-x-6 gap-y-5 text-[11px] font-mono uppercase tracking-tag text-paper/60">
    <p class="max-w-[16rem] normal-case tracking-normal font-body text-[13px] leading-relaxed">Under-the-radar jackets, consciously made for comfort, style, and elegance.</p>
    <div class="flex items-center gap-6">
      {{-- dark mode lives here on phones, where the header icon is hidden --}}
      <button class="dk sm:hidden inline-flex items-center gap-2 text-paper py-2" aria-label="Toggle dark mode" aria-pressed="false">
        <span class="dk-ico"><svg class="moon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg><svg class="sun" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg></span> Dark
      </button>
      <a href="{{ route('orders.index') }}" class="ul pb-0.5 text-paper py-2">My Orders ↗</a>
    </div>
  </div>
</div>

<!-- Header -->
<header id="hdr" class="sticky top-0 z-40">
  <div class="hdr-in">
    <div class="flex items-center gap-8 min-w-0">
      <button id="menuBtn" aria-label="Open menu" aria-expanded="false" aria-controls="menu" class="hit"><span><i></i><i></i></span></button>
      <nav class="hidden lg:flex items-center gap-6 xl:gap-7 text-[11px] font-mono uppercase tracking-tag" aria-label="Primary">
        @foreach ($links as [$label, $href, $active])
          <a href="{{ $href }}" class="roll" @if($active) aria-current="page" @endif><span data-t="{{ $label }}">{{ $label }}</span></a>
        @endforeach
      </nav>
    </div>

    <a href="{{ url('/') }}" class="wm font-display text-center uppercase whitespace-nowrap">The Western Fashion</a>

    <div class="flex items-center justify-end gap-5 md:gap-6 text-[11px] font-mono uppercase tracking-tag min-w-0">
      <button class="dk hit hidden sm:inline-flex" aria-label="Toggle dark mode" aria-pressed="false">
        <span class="dk-ico"><svg class="moon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg><svg class="sun" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg></span>
      </button>
      <a href="{{ route('orders.index') }}" aria-label="Account" class="hit relative transition-transform duration-300 hover:-translate-y-0.5">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4.4 3.6-8 8-8s8 3.6 8 8"/></svg>
      </a>
      <a href="{{ route('cart.index') }}" aria-label="Cart{{ $cartCount ? ' ('.$cartCount.' items)' : '' }}" class="hit relative transition-transform duration-300 hover:-translate-y-0.5">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 6h15l-1.5 9h-12z"/><path d="M6 6 5 3H2"/><circle cx="9" cy="20" r="1"/><circle cx="18" cy="20" r="1"/></svg>
        @if ($cartCount)<span class="badge">{{ $cartCount }}</span>@endif
      </a>
    </div>
  </div>
</header>

<script>
  (function () {
    const $ = (s) => document.querySelector(s);

    /* scroll progress + compact / hide-on-scroll header */
    const hdr = $('#hdr'), prog = $('#progress');
    let lastY = 0, ticking = false, menuOpen = false;
    function onScroll() {
      const y = Math.max(0, window.scrollY), max = document.documentElement.scrollHeight - innerHeight;
      prog.style.transform = `scaleX(${max > 0 ? Math.min(1, y / max) : 0})`;
      hdr.classList.toggle('stuck', y > 20);
      const goingDown = y > lastY + 4, goingUp = y < lastY - 4;
      if (y > 300 && goingDown && !menuOpen && !hdr.matches(':focus-within')) hdr.classList.add('hide');
      if (goingUp || y <= 300) hdr.classList.remove('hide');
      lastY = y; ticking = false;
    }
    addEventListener('scroll', () => { if (!ticking) { ticking = true; requestAnimationFrame(onScroll); } }, { passive: true });
    addEventListener('resize', onScroll); onScroll();

    /* fullscreen menu (pauses Lenis if the page exposes it as window.lenis) */
    const menu = $('#menu'), menuBtn = $('#menuBtn'), menuClose = $('#menuClose');
    function setMenu(open) {
      if (open === menuOpen) return;
      menuOpen = open;
      menu.classList.toggle('open', open);
      menu.toggleAttribute('inert', !open);
      menu.setAttribute('aria-hidden', String(!open));
      menuBtn.setAttribute('aria-expanded', String(open));
      if (window.lenis) open ? window.lenis.stop() : window.lenis.start();
      document.body.style.overflow = open ? 'hidden' : '';
      if (open) { hdr.classList.remove('hide'); setTimeout(() => menuClose.focus(), 50); }
      else menuBtn.focus({ preventScroll: true });
    }
    menuBtn.addEventListener('click', () => setMenu(true));
    menuClose.addEventListener('click', () => setMenu(false));
    menu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => setMenu(false)));
    addEventListener('keydown', (e) => { if (e.key === 'Escape') setMenu(false); });
    /* if the window is resized/rotated while the menu is open, keep it sane */
    addEventListener('orientationchange', () => setMenu(false));

    /* dark toggle (header icon on tablet/desktop, menu button on phones) — saved between pages */
    const darks = [...document.querySelectorAll('.dk')];
    const applyDark = (on) => {
      document.documentElement.classList.toggle('dark', on);
      document.body.classList.toggle('invert-mode', on);
      darks.forEach(b => b.setAttribute('aria-pressed', String(on)));
    };
    try { applyDark(localStorage.getItem('twf-dark') === '1'); } catch (e) {}
    darks.forEach(b => b.addEventListener('click', () => {
      const on = !document.documentElement.classList.contains('dark');
      applyDark(on);
      try { localStorage.setItem('twf-dark', on ? '1' : '0'); } catch (e) {}
    }));
  })();
</script>