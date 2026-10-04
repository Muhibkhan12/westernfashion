<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>My account · thewesternfashion</title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet" />

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Manrope', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            serif: ['"Instrument Serif"', 'Georgia', 'serif'],
          },
        },
      },
    };
  </script>

  <style>
    :focus-visible { outline: 2px solid #000; outline-offset: 2px; }
    .tabular { font-variant-numeric: tabular-nums; }
    @media (prefers-reduced-motion: reduce) { * { transition: none !important; } }
  </style>
</head>

<body data-page="overview" class="bg-neutral-50 font-sans text-black antialiased">

  <!-- Sidebar is injected here from user-sidebar.html -->
   @include('User.sidebar')
  <div id="sidebar-slot"></div>
  <div id="overlay" class="fixed inset-0 z-30 hidden bg-black/40 lg:hidden"></div>

  <div class="lg:pl-64">

    <!-- Top bar -->
    <header class="sticky top-0 z-20 flex h-16 items-center gap-3 border-b border-neutral-200 bg-white/90 px-4 backdrop-blur sm:px-6 lg:px-8">
      <button id="menu-btn" class="rounded-md p-2 text-neutral-600 hover:bg-neutral-100 lg:hidden" aria-label="Open menu">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h10"/></svg>
      </button>
      <p class="text-sm font-medium">My account</p>
      <div class="ml-auto flex items-center gap-2">
        <button class="relative rounded-md p-2 text-neutral-600 hover:bg-neutral-100" aria-label="Notifications">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 1 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
          <span class="absolute right-2 top-2 h-1.5 w-1.5 rounded-full bg-black"></span>
        </button>
        <a href="#" class="hidden items-center gap-2 rounded-lg bg-black px-3.5 py-2 text-sm font-medium text-white hover:bg-neutral-800 sm:inline-flex">
          Continue shopping
        </a>
      </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">

      <!-- Greeting -->
      <div>
        <h1 id="greeting" class="font-serif text-4xl tracking-tight">Welcome back, Emily</h1>
        <p class="mt-1 text-sm text-neutral-500">Here's a look at your orders, wishlist and account.</p>
      </div>

      <!-- Stats -->
      <section id="stats" class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4" aria-label="Account summary"></section>

      <div class="mt-4 grid gap-4 lg:grid-cols-3">

        <!-- Recent orders -->
        <div class="rounded-xl border border-neutral-200 bg-white lg:col-span-2">
          <div class="flex items-center justify-between p-6 pb-4">
            <h2 class="text-base font-semibold">Recent orders</h2>
            <a href="#" class="text-sm font-medium text-neutral-500 hover:text-black">View all</a>
          </div>
          <ul id="orders-list" class="divide-y divide-neutral-100 px-6 pb-2"></ul>
        </div>

        <!-- Account + address -->
        <div class="space-y-4">
          <div class="rounded-xl border border-neutral-200 bg-white p-6">
            <div class="flex items-center justify-between">
              <h2 class="text-base font-semibold">Default address</h2>
              <a href="#" class="text-sm font-medium text-neutral-500 hover:text-black">Edit</a>
            </div>
            <div class="mt-3 text-sm text-neutral-600">
              <p class="font-medium text-black">Emily Carter</p>
              <p>412 Lonestar Drive</p>
              <p>Austin, TX 78701</p>
              <p>United States</p>
              <p class="mt-2 tabular text-neutral-500">+1 555 0172</p>
            </div>
          </div>

          <div class="rounded-xl border border-neutral-200 bg-white p-6">
            <div class="flex items-center justify-between">
              <h2 class="text-base font-semibold">Loyalty points</h2>
              <span class="rounded-full bg-black px-2 py-0.5 text-[11px] font-medium text-white">Silver tier</span>
            </div>
            <p id="points-total" class="tabular mt-2 text-3xl font-semibold tracking-tight">0</p>
            <div class="mt-3 h-1.5 w-full rounded-full bg-neutral-100">
              <div id="points-bar" class="h-1.5 rounded-full bg-black" style="width:0%"></div>
            </div>
            <p id="points-note" class="mt-2 text-xs text-neutral-500"></p>
          </div>
        </div>
      </div>

      <!-- Wishlist -->
      <section class="mt-4 rounded-xl border border-neutral-200 bg-white p-6">
        <div class="flex items-center justify-between">
          <h2 class="text-base font-semibold">From your wishlist</h2>
          <a href="#" class="text-sm font-medium text-neutral-500 hover:text-black">View wishlist</a>
        </div>
        <div id="wishlist" class="mt-5 grid grid-cols-2 gap-4 sm:grid-cols-4"></div>
      </section>

      <footer class="mt-10 pb-4 text-xs text-neutral-400">© <span id="year"></span> thewesternfashion.</footer>
    </main>
  </div>

  <script>
    /* ---------------------------------------------------------------
       1. Load the sidebar partial (user-sidebar.html)
       Needs a local server: fetch() fails when opened via file://
       Try VS Code Live Server, `npx serve`, or `python -m http.server`.
    ---------------------------------------------------------------- */

    function initSidebar() {
      const sidebar = document.getElementById('sidebar');
      const page = document.body.dataset.page;
      const active = sidebar.querySelector(`[data-nav="${page}"]`);
      if (active) { active.classList.add('is-active'); active.setAttribute('aria-current', 'page'); }

      const open  = () => { sidebar.classList.remove('-translate-x-full'); overlay.classList.remove('hidden'); };
      const close = () => { sidebar.classList.add('-translate-x-full');    overlay.classList.add('hidden'); };

      document.getElementById('menu-btn').addEventListener('click', open);
      document.getElementById('sidebar-close').addEventListener('click', close);
      overlay.addEventListener('click', close);
      document.addEventListener('keydown', e => { if (e.key === 'Escape') close(); });
    }

    /* ---------------------------------------------------------------
       2. Data (replace with your API)
    ---------------------------------------------------------------- */
    const money = n => new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(n);

    const customer = { firstName: 'Emily', orders: 9, totalSpent: 742, wishlistCount: 5, points: 640, nextTier: 1000 };

    const orders = [
      { id: 'TWF-2840', date: 'Sep 21, 2026', status: 'Shipped',   items: 1, total: 129 },
      { id: 'TWF-2779', date: 'Aug 30, 2026', status: 'Delivered', total: 94,  items: 2 },
      { id: 'TWF-2701', date: 'Aug 2, 2026',  status: 'Delivered', total: 168, items: 1 },
      { id: 'TWF-2634', date: 'Jul 11, 2026', status: 'Delivered', total: 58,  items: 1 },
    ];

    const wishlist = [
      { name: 'Felt Rancher Hat', price: 72 },
      { name: 'Tooled Leather Boots', price: 210 },
      { name: 'Bandana Print Scarf', price: 18 },
      { name: 'Denim Vest', price: 64 },
    ];

    const statusBadge = {
      Delivered: 'bg-black text-white',
      Shipped:   'border border-black text-black',
      Pending:   'bg-neutral-100 text-neutral-700',
      Cancelled: 'border border-neutral-200 text-neutral-400',
    };
    const initials = n => n.split(' ').slice(0, 2).map(w => w[0]).join('');

    /* ---------------------------------------------------------------
       3. Render
    ---------------------------------------------------------------- */
    document.getElementById('greeting').textContent = `Welcome back, ${customer.firstName}`;
    document.getElementById('year').textContent = new Date().getFullYear();

    const activeOrders = orders.filter(o => o.status === 'Shipped' || o.status === 'Pending').length;
    const stats = [
      { label: 'Total orders',  value: customer.orders,            note: 'All time' },
      { label: 'Active orders', value: activeOrders,                note: 'On their way to you' },
      { label: 'Wishlist',      value: customer.wishlistCount,      note: 'Saved for later' },
      { label: 'Total spent',   value: money(customer.totalSpent),  note: 'All time' },
    ];
    document.getElementById('stats').innerHTML = stats.map(s => `
      <div class="rounded-xl border border-neutral-200 bg-white p-5">
        <p class="text-sm text-neutral-500">${s.label}</p>
        <p class="tabular mt-2 text-3xl font-semibold tracking-tight">${s.value}</p>
        <p class="mt-3 text-xs text-neutral-400">${s.note}</p>
      </div>`).join('');

    document.getElementById('orders-list').innerHTML = orders.map(o => `
      <li class="flex items-center justify-between gap-3 py-3.5">
        <div class="min-w-0">
          <p class="font-medium">#${o.id}</p>
          <p class="text-xs text-neutral-500">${o.date} · ${o.items} ${o.items === 1 ? 'item' : 'items'}</p>
        </div>
        <div class="flex items-center gap-3">
          <span class="rounded-full px-2.5 py-0.5 text-xs font-medium ${statusBadge[o.status]}">${o.status}</span>
          <span class="tabular w-16 text-right text-sm font-medium">${money(o.total)}</span>
        </div>
      </li>`).join('');

    const pct = Math.min(100, Math.round((customer.points / customer.nextTier) * 100));
    document.getElementById('points-total').textContent = customer.points.toLocaleString();
    document.getElementById('points-bar').style.width = `${pct}%`;
    document.getElementById('points-note').textContent =
      `${customer.nextTier - customer.points} points to Gold tier`;

    document.getElementById('wishlist').innerHTML = wishlist.map(p => `
      <div class="rounded-lg border border-neutral-200 p-3">
        <div class="grid aspect-square place-items-center rounded-md bg-neutral-100">
          <span class="font-serif text-2xl text-neutral-300">${initials(p.name)}</span>
        </div>
        <p class="mt-2 truncate text-sm font-medium">${p.name}</p>
        <p class="tabular text-sm text-neutral-500">${money(p.price)}</p>
      </div>`).join('');
  </script>
</body>
</html>