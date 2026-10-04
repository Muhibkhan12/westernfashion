<!--
  user-sidebar.html  —  thewesternfashion customer account sidebar (partial)
  Loaded into user-dashboard.html via fetch(). Do not open on its own.
  To mark a page active, set <body data-page="orders"> etc. on that page.
-->
<aside
  id="sidebar"
  class="fixed inset-y-0 left-0 z-40 flex w-64 -translate-x-full flex-col border-r border-neutral-200 bg-white transition-transform duration-200 ease-out lg:translate-x-0"
  aria-label="Account navigation"
>
  <!-- Brand -->
  <div class="flex h-16 items-center justify-between px-6">
    <a href="user-dashboard.html" class="flex items-center gap-2.5">
      <span class="grid h-8 w-8 place-items-center rounded-md bg-black text-white">
        <span class="font-serif text-lg leading-none">w</span>
      </span>
      <span class="font-serif text-xl leading-none tracking-tight text-black">thewesternfashion</span>
    </a>
    <button id="sidebar-close" class="rounded-md p-1.5 text-neutral-500 hover:bg-neutral-100 hover:text-black lg:hidden" aria-label="Close menu">
      <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6L6 18"/></svg>
    </button>
  </div>

  <!-- Profile -->
  <div class="px-6 pb-4">
    <div class="flex items-center gap-3 rounded-lg border border-neutral-200 p-3">
      <div class="grid h-10 w-10 shrink-0 place-items-center rounded-full bg-black text-sm font-medium text-white">EC</div>
      <div class="min-w-0 flex-1">
        <p class="truncate text-sm font-medium text-black">Emily Carter</p>
        <p class="truncate text-xs text-neutral-500">emily.carter@example.com</p>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <nav class="flex-1 overflow-y-auto px-3 py-2">
    <p class="px-3 pb-2 text-xs font-medium text-neutral-400">My account</p>
    <ul class="space-y-0.5">
      <li>
        <a href="user-dashboard.html" data-nav="overview" class="nav-link">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9" rx="1"/><rect x="14" y="3" width="7" height="5" rx="1"/><rect x="14" y="12" width="7" height="9" rx="1"/><rect x="3" y="16" width="7" height="5" rx="1"/></svg>
          Overview
        </a>
      </li>
      <li>
        <a href="#" data-nav="orders" class="nav-link">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
          My orders
          <span class="ml-auto rounded-full bg-black px-2 py-0.5 text-[11px] font-medium text-white">2</span>
        </a>
      </li>
      <li>
        <a href="#" data-nav="wishlist" class="nav-link">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8Z"/></svg>
          Wishlist
        </a>
      </li>
      <li>
        <a href="#" data-nav="addresses" class="nav-link">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
          Addresses
        </a>
      </li>
      <li>
        <a href="#" data-nav="payment" class="nav-link">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
          Payment methods
        </a>
      </li>
    </ul>

    <p class="px-3 pb-2 pt-6 text-xs font-medium text-neutral-400">Settings</p>
    <ul class="space-y-0.5">
      <li>
        <a href="#" data-nav="profile" class="nav-link">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21v-1a8 8 0 0 1 16 0v1"/></svg>
          Profile
        </a>
      </li>
      <li>
        <a href="#" data-nav="notifications" class="nav-link">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 1 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
          Notifications
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

  <!-- Sign out -->
  <div class="border-t border-neutral-200 p-3">
    <a href="#" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-neutral-600 hover:bg-neutral-50 hover:text-black">
      <svg class="h-[1.125rem] w-[1.125rem]" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="m16 17 5-5-5-5"/><path d="M21 12H9"/></svg>
      Sign out
    </a>
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
</style>s