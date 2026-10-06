<!--
  sidebar.html  —  thewesternfashion admin sidebar (partial)
  Loaded into dashboard.html via fetch(). Do not open on its own.
  To mark a page active, set <body data-page="orders"> etc. on that page.
-->
<aside
  id="sidebar"
  class="fixed inset-y-0 left-0 z-40 flex w-64 -translate-x-full flex-col border-r border-neutral-200 bg-white transition-transform duration-200 ease-out lg:translate-x-0"
  aria-label="Main navigation"
>
  <!-- Brand -->
  <div class="flex h-16 items-center justify-between px-6">
    <a href="dashboard.html" class="flex items-center gap-2.5">
      <span class="grid h-8 w-8 place-items-center rounded-md bg-black text-white">
        <span class="font-serif text-lg leading-none">w</span>
      </span>
      <span class="font-serif text-xl leading-none tracking-tight text-black">thewesternfashion</span>
    </a>
    <button id="sidebar-close" class="rounded-md p-1.5 text-neutral-500 hover:bg-neutral-100 hover:text-black lg:hidden" aria-label="Close menu">
      <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6L6 18"/></svg>
    </button>
  </div>

  <!-- Navigation -->
  <nav class="flex-1 overflow-y-auto px-3 py-4">
    <p class="px-3 pb-2 text-xs font-medium text-neutral-400">Store</p>
    <ul class="space-y-0.5">
      <li>
        <a href="dashboard.html" data-nav="dashboard" class="nav-link">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9" rx="1"/><rect x="14" y="3" width="7" height="5" rx="1"/><rect x="14" y="12" width="7" height="9" rx="1"/><rect x="3" y="16" width="7" height="5" rx="1"/></svg>
          Dashboard
        </a>
      </li>
      <li>
        <a href="#" data-nav="orders" class="nav-link">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
          Orders
          <span class="ml-auto rounded-full bg-black px-2 py-0.5 text-[11px] font-medium text-white">12</span>
        </a>
      </li>
      <li>
        <a href="#" data-nav="products" class="nav-link">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M20.6 13.4 13.4 20.6a2 2 0 0 1-2.8 0L2 12V2h10l8.6 8.6a2 2 0 0 1 0 2.8z"/><circle cx="7" cy="7" r="1.2"/></svg>
          Products
        </a>
      </li>
            <li>
        <a href="{{route('admin-add-products')}}" data-nav="products" class="nav-link">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M20.6 13.4 13.4 20.6a2 2 0 0 1-2.8 0L2 12V2h10l8.6 8.6a2 2 0 0 1 0 2.8z"/><circle cx="7" cy="7" r="1.2"/></svg>
          Add Products
        </a>
      </li>
      <li>
        <a href="#" data-nav="inventory" class="nav-link">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8 12 3 3 8v8l9 5 9-5z"/><path d="m3 8 9 5 9-5"/><path d="M12 13v8"/></svg>
          Inventory
        </a>
      </li>
      <li>
        <a href="#" data-nav="customers" class="nav-link">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M21 21v-2a4 4 0 0 0-3-3.9"/><path d="M16 3.1a4 4 0 0 1 0 7.8"/></svg>
          Customers
        </a>
      </li>
    </ul>

    <p class="px-3 pb-2 pt-6 text-xs font-medium text-neutral-400">Growth</p>
    <ul class="space-y-0.5">
      <li>
        <a href="#" data-nav="analytics" class="nav-link">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="m7 15 4-4 3 3 5-6"/></svg>
          Analytics
        </a>
      </li>
      <li>
        <a href="#" data-nav="discounts" class="nav-link">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="m19 5-14 14"/><circle cx="6.5" cy="6.5" r="2.5"/><circle cx="17.5" cy="17.5" r="2.5"/></svg>
          Discounts
        </a>
      </li>
      <li>
        <a href="#" data-nav="reviews" class="nav-link">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="m12 2 3.1 6.3 6.9 1-5 4.9 1.2 6.8L12 17.8 5.8 21l1.2-6.8-5-4.9 6.9-1z"/></svg>
          Reviews
        </a>
      </li>
    </ul>

    <p class="px-3 pb-2 pt-6 text-xs font-medium text-neutral-400">Account</p>
    <ul class="space-y-0.5">
      <li>
        <a href="#" data-nav="settings" class="nav-link">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.8l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.7 1.7 0 0 0-1.8-.3 1.7 1.7 0 0 0-1 1.5V21a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1.1-1.5 1.7 1.7 0 0 0-1.8.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1.7 1.7 0 0 0 .3-1.8 1.7 1.7 0 0 0-1.5-1H3a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.5-1.1 1.7 1.7 0 0 0-.3-1.8l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1a1.7 1.7 0 0 0 1.8.3H9a1.7 1.7 0 0 0 1-1.5V3a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.5 1.7 1.7 0 0 0 1.8-.3l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.8V9a1.7 1.7 0 0 0 1.5 1H21a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.5 1z"/></svg>
          Settings
        </a>
      </li>
      <li>
        <a href="#" data-nav="help" class="nav-link">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.1 9a3 3 0 0 1 5.8 1c0 2-3 3-3 3"/><path d="M12 17h.01"/></svg>
          Help center
        </a>
      </li>
    </ul>
  </nav>

  <!-- Admin card -->
  <div class="border-t border-neutral-200 p-3">
    <div class="flex items-center gap-3 rounded-lg p-2 hover:bg-neutral-50">
      <div class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-black text-sm font-medium text-white">AR</div>
      <div class="min-w-0 flex-1">
        <p class="truncate text-sm font-medium text-black">Ayesha Raza</p>
        <p class="truncate text-xs text-neutral-500">Store admin</p>
      </div>
      <button class="rounded-md p-1.5 text-neutral-400 hover:bg-neutral-100 hover:text-black" aria-label="Log out" title="Log out">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="m16 17 5-5-5-5"/><path d="M21 12H9"/></svg>
      </button>
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
  #sidebar .nav-link.is-active span { background: #fff; color: #000; }
</style>