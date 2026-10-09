{{--
  resources/views/User/sidebar.blade.php
  Usage on every user page (right after <body>):   @include('User.sidebar')
  Optional badge for in-progress orders:           @include('User.sidebar', ['activeOrders' => $activeOrders])
  Mobile: any button with  data-sidebar-open  (or id="menu-btn" / "sidebar-toggle") opens the drawer.
--}}
@php
  // ---- who is logged in ----
  $me        = auth()->user();
  $meName    = $me->name ?? 'Guest';
  $meEmail   = $me->email ?? '';
  $initials  = collect(preg_split('/\s+/', trim($meName)))->filter()->take(2)
                 ->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))->implode('') ?: 'U';

  // ---- badges ----
  $activeOrdersCount = (int) ($activeOrders ?? 0);
  $cartCount         = (int) app(\App\Services\CartService::class)->count();

  // ---- which page is active (based on the routes in web.php) ----
  $isOverview = request()->is('user-dashboard');
  $isOrders   = request()->routeIs('orders.*') || request()->is('user-order');
  $isWishlist = request()->is('user-wishlist');
  $isBrowse   = request()->routeIs('shop.*');
  $isCart     = request()->routeIs('cart.*');

  $cls = fn (bool $on) => 'nav-link' . ($on ? ' is-active' : '');
  $cur = fn (bool $on) => $on ? 'aria-current="page"' : '';
@endphp

<!-- Mobile backdrop -->
<div id="sidebar-overlay" class="fixed inset-0 z-30 bg-black/40 opacity-0 pointer-events-none transition-opacity duration-200 lg:hidden" aria-hidden="true"></div>

<aside
  id="sidebar"
  class="fixed inset-y-0 left-0 z-40 flex w-64 -translate-x-full flex-col border-r border-neutral-200 bg-white transition-transform duration-200 ease-out lg:translate-x-0"
  aria-label="Account navigation"
>
  <!-- Brand -->
  <div class="flex h-16 items-center justify-between px-6">
    <a href="{{ url('/home') }}" class="flex items-center gap-2.5">
      <span class="grid h-8 w-8 place-items-center rounded-md bg-black text-white">
        <span class="font-serif text-lg leading-none">w</span>
      </span>
      <span class="font-serif text-xl leading-none tracking-tight text-black">thewesternfashion</span>
    </a>
    <button id="sidebar-close" type="button" class="rounded-md p-1.5 text-neutral-500 hover:bg-neutral-100 hover:text-black lg:hidden" aria-label="Close menu">
      <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6L6 18"/></svg>
    </button>
  </div>

  <!-- Navigation -->
  <nav class="flex-1 overflow-y-auto px-3 py-4">
    <p class="px-3 pb-2 text-xs font-medium text-neutral-400">My account</p>
    <ul class="space-y-0.5">
      <li>
        <a href="{{ url('/user-dashboard') }}" class="{{ $cls($isOverview) }}" {!! $cur($isOverview) !!}>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9" rx="1"/><rect x="14" y="3" width="7" height="5" rx="1"/><rect x="14" y="12" width="7" height="9" rx="1"/><rect x="3" y="16" width="7" height="5" rx="1"/></svg>
          Overview
        </a>
      </li>
      <li>
        <a href="{{ route('orders.index') }}" class="{{ $cls($isOrders) }}" {!! $cur($isOrders) !!}>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
          My orders
          @if ($activeOrdersCount > 0)
            <span class="badge ml-auto rounded-full bg-black px-2 py-0.5 text-[11px] font-medium text-white">{{ $activeOrdersCount > 99 ? '99+' : $activeOrdersCount }}</span>
          @endif
        </a>
      </li>
      <li>
        <a href="{{ url('/user-wishlist') }}" class="{{ $cls($isWishlist) }}" {!! $cur($isWishlist) !!}>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1-1.1a5.5 5.5 0 0 0-7.8 7.8l1 1.1L12 21l7.8-7.5 1-1.1a5.5 5.5 0 0 0 0-7.8z"/></svg>
          Wishlist
        </a>
      </li>
    </ul>

    <p class="px-3 pb-2 pt-6 text-xs font-medium text-neutral-400">Shop</p>
    <ul class="space-y-0.5">
      <li>
        <a href="{{ route('shop.products') }}" class="{{ $cls($isBrowse) }}" {!! $cur($isBrowse) !!}>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M20.6 13.4 13.4 20.6a2 2 0 0 1-2.8 0L2 12V2h10l8.6 8.6a2 2 0 0 1 0 2.8z"/><circle cx="7" cy="7" r="1.2"/></svg>
          Browse jackets
        </a>
      </li>
      <li>
        <a href="{{ route('cart.index') }}" class="{{ $cls($isCart) }}" {!! $cur($isCart) !!}>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M6 6h15l-1.5 9h-12z"/><path d="M6 6 5 3H2"/><circle cx="9" cy="20" r="1"/><circle cx="18" cy="20" r="1"/></svg>
          Cart
          @if ($cartCount > 0)
            <span class="badge ml-auto rounded-full bg-black px-2 py-0.5 text-[11px] font-medium text-white">{{ $cartCount > 99 ? '99+' : $cartCount }}</span>
          @endif
        </a>
      </li>
    </ul>

    {{-- No routes for these yet in web.php, so they're shown as "Soon" instead of dead "#" links.
         When you add a route: replace href="#" with it and remove is-disabled / aria-disabled / tabindex / the Soon pill. --}}
    <p class="px-3 pb-2 pt-6 text-xs font-medium text-neutral-400">Settings</p>
    <ul class="space-y-0.5">
      <li>
        <a href="#" class="nav-link is-disabled" aria-disabled="true" tabindex="-1" title="Coming soon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          Addresses <span class="soon">Soon</span>
        </a>
      </li>
      <li>
        <a href="#" class="nav-link is-disabled" aria-disabled="true" tabindex="-1" title="Coming soon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4.4 3.6-8 8-8s8 3.6 8 8"/></svg>
          Profile &amp; security <span class="soon">Soon</span>
        </a>
      </li>
    </ul>
  </nav>

  <!-- Back to store + user card + logout (POST /logout needs a CSRF token, so it's a real form) -->
  <div class="border-t border-neutral-200 p-3">
    <a href="{{ url('/home') }}" class="nav-link mb-1">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
      Back to store
    </a>
    <div class="flex items-center gap-3 rounded-lg p-2 hover:bg-neutral-50">
      <div class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-black text-sm font-medium text-white">{{ $initials }}</div>
      <div class="min-w-0 flex-1">
        <p class="truncate text-sm font-medium text-black">{{ $meName }}</p>
        <p class="truncate text-xs text-neutral-500">{{ $meEmail }}</p>
      </div>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="rounded-md p-1.5 text-neutral-400 hover:bg-neutral-100 hover:text-black" aria-label="Log out" title="Log out">
          <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="m16 17 5-5-5-5"/><path d="M21 12H9"/></svg>
        </button>
      </form>
    </div>
  </div>
</aside>

<style>
  /* Sidebar link styles — kept here so the partial is self-contained */
  #sidebar .nav-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.5rem 0.75rem;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: #525252;
    transition: background-color 0.15s, color 0.15s;
  }
  #sidebar .nav-link svg { width: 1.125rem; height: 1.125rem; flex-shrink: 0; }
  #sidebar .nav-link:hover { background: #f5f5f5; color: #000; }
  #sidebar .nav-link:focus-visible { outline: 2px solid #000; outline-offset: 2px; }
  #sidebar .nav-link.is-active { background: #000; color: #fff; }
  #sidebar .nav-link.is-active .badge { background: #fff; color: #000; }

  /* pages that have no route yet */
  #sidebar .nav-link.is-disabled { color: #a3a3a3; cursor: not-allowed; }
  #sidebar .nav-link.is-disabled:hover { background: transparent; color: #a3a3a3; }
  #sidebar .nav-link .soon { margin-left: auto; font-size: 10px; letter-spacing: .04em; text-transform: uppercase; color: #a3a3a3; border: 1px solid #e5e5e5; border-radius: 9999px; padding: 1px 7px; }

  @media (prefers-reduced-motion: reduce) { #sidebar, #sidebar-overlay { transition: none; } }
</style>

<script>
  (function () {
    const sb = document.getElementById('sidebar'), ov = document.getElementById('sidebar-overlay'),
          closeBtn = document.getElementById('sidebar-close'), desktop = matchMedia('(min-width:1024px)');
    let open = false, lastFocus = null;

    // below lg the closed sidebar is off-screen: keep it out of the tab order
    const sync = () => sb.toggleAttribute('inert', !desktop.matches && !open);

    function setOpen(o) {
      open = o;
      sb.classList.toggle('-translate-x-full', !o);
      sb.classList.toggle('translate-x-0', o);
      ov.classList.toggle('opacity-0', !o);
      ov.classList.toggle('pointer-events-none', !o);
      document.body.style.overflow = o && !desktop.matches ? 'hidden' : '';
      sync();
      if (o) { lastFocus = document.activeElement; setTimeout(() => closeBtn.focus(), 50); }
      else if (lastFocus) { lastFocus.focus && lastFocus.focus({ preventScroll: true }); lastFocus = null; }
    }

    // any hamburger button on the page can open it
    document.addEventListener('click', (e) => {
      if (e.target.closest('[data-sidebar-open], #menu-btn, #sidebar-toggle, #sidebar-open')) { e.preventDefault(); setOpen(true); }
    });
    closeBtn.addEventListener('click', () => setOpen(false));
    ov.addEventListener('click', () => setOpen(false));
    addEventListener('keydown', (e) => { if (e.key === 'Escape' && open) setOpen(false); });
    desktop.addEventListener('change', () => { if (open) setOpen(false); else sync(); });

    // tapping a real link closes the drawer; "Soon" items do nothing
    sb.querySelectorAll('a.nav-link').forEach(a => a.addEventListener('click', (e) => {
      if (a.getAttribute('aria-disabled') === 'true') { e.preventDefault(); return; }
      if (!desktop.matches) setOpen(false);
    }));

    // keep the active link visible in a long nav
    const cur = sb.querySelector('[aria-current="page"]');
    if (cur) cur.scrollIntoView({ block: 'nearest' });

    sync();
    window.UserSidebar = { open: () => setOpen(true), close: () => setOpen(false) };
  })();
</script>