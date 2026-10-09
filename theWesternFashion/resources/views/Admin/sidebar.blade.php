{{--
  resources/views/Admin/partials/sidebar.blade.php   (put it wherever you keep admin partials)
  Usage, inside every admin page layout:   @include('Admin.partials.sidebar')
  Optional: pass a pending-orders count to show the badge →  @include('Admin.partials.sidebar', ['pendingOrders' => $pendingOrders])
  Mobile: any button with  data-sidebar-open  (or id="sidebar-toggle") opens the sidebar.
--}}
@php
  // ---- who is logged in ----
  $adminUser = auth()->user();
  $adminName = $adminUser->name ?? 'Admin';
  $initials  = collect(preg_split('/\s+/', trim($adminName)))->filter()->take(2)
                 ->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))->implode('') ?: 'A';
  $pending   = (int) ($pendingOrders ?? 0);

  // ---- which page is active (based on the routes in web.php) ----
  $isDash      = request()->is('admin-dashboard');
  $isOrders    = request()->is('admin-orders');
  $isProducts  = request()->routeIs('products.*') && ! request()->routeIs('products.create');
  $isAdd       = request()->routeIs('products.create');
  $isInventory = request()->is('admin-inventory*');
  $isCustomers = request()->is('admin-customers*');

  $cls = fn (bool $on) => 'nav-link' . ($on ? ' is-active' : '');
  $cur = fn (bool $on) => $on ? 'aria-current="page"' : '';
@endphp

<!-- Mobile backdrop -->
<div id="sidebar-overlay" class="fixed inset-0 z-30 bg-black/40 opacity-0 pointer-events-none transition-opacity duration-200 lg:hidden" aria-hidden="true"></div>

<aside
  id="sidebar"
  class="fixed inset-y-0 left-0 z-40 flex w-64 -translate-x-full flex-col border-r border-neutral-200 bg-white transition-transform duration-200 ease-out lg:translate-x-0"
  aria-label="Main navigation"
>
  <!-- Brand -->
  <div class="flex h-16 items-center justify-between px-6">
    <a href="{{ url('/admin-dashboard') }}" class="flex items-center gap-2.5">
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
    <p class="px-3 pb-2 text-xs font-medium text-neutral-400">Store</p>
    <ul class="space-y-0.5">
      <li>
        <a href="{{ url('/admin-dashboard') }}" class="{{ $cls($isDash) }}" {!! $cur($isDash) !!}>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9" rx="1"/><rect x="14" y="3" width="7" height="5" rx="1"/><rect x="14" y="12" width="7" height="9" rx="1"/><rect x="3" y="16" width="7" height="5" rx="1"/></svg>
          Dashboard
        </a>
      </li>
      <li>
        <a href="{{ url('/admin-orders') }}" class="{{ $cls($isOrders) }}" {!! $cur($isOrders) !!}>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
          Orders
          @if ($pending > 0)
            <span class="badge ml-auto rounded-full bg-black px-2 py-0.5 text-[11px] font-medium text-white">{{ $pending > 99 ? '99+' : $pending }}</span>
          @endif
        </a>
      </li>
      <li>
        <a href="{{ route('products.index') }}" class="{{ $cls($isProducts) }}" {!! $cur($isProducts) !!}>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M20.6 13.4 13.4 20.6a2 2 0 0 1-2.8 0L2 12V2h10l8.6 8.6a2 2 0 0 1 0 2.8z"/><circle cx="7" cy="7" r="1.2"/></svg>
          Products
        </a>
      </li>
      <li>
        <a href="{{ route('products.create') }}" class="{{ $cls($isAdd) }}" {!! $cur($isAdd) !!}>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 8v8M8 12h8"/></svg>
          Add Products
        </a>
      </li>
      <li>
        <a href="{{ url('/admin-inventory') }}" class="{{ $cls($isInventory) }}" {!! $cur($isInventory) !!}>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8 12 3 3 8v8l9 5 9-5z"/><path d="m3 8 9 5 9-5"/><path d="M12 13v8"/></svg>
          Inventory
        </a>
      </li>
      <li>
        <a href="{{ url('/admin-customers') }}" class="{{ $cls($isCustomers) }}" {!! $cur($isCustomers) !!}>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M21 21v-2a4 4 0 0 0-3-3.9"/><path d="M16 3.1a4 4 0 0 1 0 7.8"/></svg>
          Customers
        </a>
      </li>
    </ul>

    {{-- The links below have no routes in web.php yet, so they're shown as "Soon" instead of dead "#" links.
         When you add a route, replace href="#" with it and drop the is-disabled / aria-disabled / tabindex / Soon pill. --}}
    <p class="px-3 pb-2 pt-6 text-xs font-medium text-neutral-400">Growth</p>
    <ul class="space-y-0.5">
      <li>
        <a href="#" class="nav-link is-disabled" aria-disabled="true" tabindex="-1" title="Coming soon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="m7 15 4-4 3 3 5-6"/></svg>
          Analytics <span class="soon">Soon</span>
        </a>
      </li>
      <li>
        <a href="#" class="nav-link is-disabled" aria-disabled="true" tabindex="-1" title="Coming soon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="m19 5-14 14"/><circle cx="6.5" cy="6.5" r="2.5"/><circle cx="17.5" cy="17.5" r="2.5"/></svg>
          Discounts <span class="soon">Soon</span>
        </a>
      </li>
      <li>
        <a href="#" class="nav-link is-disabled" aria-disabled="true" tabindex="-1" title="Coming soon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="m12 2 3.1 6.3 6.9 1-5 4.9 1.2 6.8L12 17.8 5.8 21l1.2-6.8-5-4.9 6.9-1z"/></svg>
          Reviews <span class="soon">Soon</span>
        </a>
      </li>
    </ul>

    <p class="px-3 pb-2 pt-6 text-xs font-medium text-neutral-400">Account</p>
    <ul class="space-y-0.5">
      <li>
        <a href="#" class="nav-link is-disabled" aria-disabled="true" tabindex="-1" title="Coming soon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.8l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.7 1.7 0 0 0-1.8-.3 1.7 1.7 0 0 0-1 1.5V21a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1.1-1.5 1.7 1.7 0 0 0-1.8.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1.7 1.7 0 0 0 .3-1.8 1.7 1.7 0 0 0-1.5-1H3a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.5-1.1 1.7 1.7 0 0 0-.3-1.8l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1a1.7 1.7 0 0 0 1.8.3H9a1.7 1.7 0 0 0 1-1.5V3a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.5 1.7 1.7 0 0 0 1.8-.3l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.8V9a1.7 1.7 0 0 0 1.5 1H21a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.5 1z"/></svg>
          Settings <span class="soon">Soon</span>
        </a>
      </li>
      <li>
        <a href="#" class="nav-link is-disabled" aria-disabled="true" tabindex="-1" title="Coming soon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.1 9a3 3 0 0 1 5.8 1c0 2-3 3-3 3"/><path d="M12 17h.01"/></svg>
          Help center <span class="soon">Soon</span>
        </a>
      </li>
    </ul>
  </nav>

  <!-- Admin card + logout (POST /logout needs a CSRF token, so it's a real form) -->
  <div class="border-t border-neutral-200 p-3">
    <div class="flex items-center gap-3 rounded-lg p-2 hover:bg-neutral-50">
      <div class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-black text-sm font-medium text-white">{{ $initials }}</div>
      <div class="min-w-0 flex-1">
        <p class="truncate text-sm font-medium text-black">{{ $adminName }}</p>
        <p class="truncate text-xs text-neutral-500">Store admin</p>
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
      if (e.target.closest('[data-sidebar-open], #sidebar-toggle, #sidebar-open')) { e.preventDefault(); setOpen(true); }
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
    window.AdminSidebar = { open: () => setOpen(true), close: () => setOpen(false) };
  })();
</script>