<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard · thewesternfashion admin</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet" />

  <!-- Tailwind CSS (CDN) -->
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

<body data-page="dashboard" class="bg-neutral-50 font-sans text-black antialiased">

    @include('admin.sidebar')

  <!-- Sidebar is injected here from sidebar.html -->
  <div id="sidebar-slot"></div>

  <!-- Mobile overlay -->
  <div id="overlay" class="fixed inset-0 z-30 hidden bg-black/40 lg:hidden"></div>

  <div class="lg:pl-64">

    <!-- Top bar -->
    <header class="sticky top-0 z-20 flex h-16 items-center gap-3 border-b border-neutral-200 bg-white/90 px-4 backdrop-blur sm:px-6 lg:px-8">
      <button id="menu-btn" class="rounded-md p-2 text-neutral-600 hover:bg-neutral-100 lg:hidden" aria-label="Open menu">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h10"/></svg>
      </button>

      <div class="relative max-w-md flex-1">
        <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-neutral-400" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
        <input id="search" type="search" placeholder="Search orders, customers, products"
          class="w-full rounded-lg border border-neutral-200 bg-neutral-50 py-2 pl-9 pr-3 text-sm placeholder:text-neutral-400 focus:border-black focus:bg-white focus:outline-none" />
      </div>

      <div class="ml-auto flex items-center gap-2">
        <button class="relative rounded-md p-2 text-neutral-600 hover:bg-neutral-100" aria-label="Notifications">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 1 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
          <span class="absolute right-2 top-2 h-1.5 w-1.5 rounded-full bg-black"></span>
        </button>
        <button class="hidden items-center gap-2 rounded-lg bg-black px-3.5 py-2 text-sm font-medium text-white hover:bg-neutral-800 sm:inline-flex">
          <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
          Add product
        </button>
      </div>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

      <!-- Page heading -->
      <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
          <h1 id="greeting" class="font-serif text-4xl tracking-tight">Good morning, Ayesha</h1>
          <p class="mt-1 text-sm text-neutral-500">Here's how the store is doing today.</p>
        </div>
        <div class="flex items-center gap-2">
          <select id="range" class="rounded-lg border border-neutral-200 bg-white px-3 py-2 text-sm font-medium focus:border-black focus:outline-none" aria-label="Date range">
            <option value="7D">Last 7 days</option>
            <option value="30D">Last 30 days</option>
            <option value="12M">Last 12 months</option>
          </select>
          <button class="rounded-lg border border-neutral-200 bg-white px-3 py-2 text-sm font-medium hover:border-black">Export report</button>
        </div>
      </div>

      <!-- Stats -->
      <section id="stats" class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4" aria-label="Key numbers"></section>

      <!-- Chart + categories -->
      <section class="mt-4 grid gap-4 lg:grid-cols-3">
        <div class="rounded-xl border border-neutral-200 bg-white p-6 lg:col-span-2">
          <div class="flex flex-wrap items-start justify-between gap-4">
            <div>
              <h2 class="text-sm font-medium text-neutral-500">Revenue</h2>
              <p id="chart-total" class="tabular mt-1 text-3xl font-semibold tracking-tight">$0</p>
            </div>
            <div class="inline-flex rounded-lg border border-neutral-200 p-0.5 text-xs font-medium" role="tablist" id="chart-tabs">
              <button data-range="7D"  class="chart-tab rounded-md px-3 py-1.5">7D</button>
              <button data-range="30D" class="chart-tab rounded-md px-3 py-1.5">30D</button>
              <button data-range="12M" class="chart-tab rounded-md px-3 py-1.5">12M</button>
            </div>
          </div>

          <div id="chart-wrap" class="relative mt-6">
            <svg id="chart" viewBox="0 0 800 280" class="block h-auto w-full" role="img" aria-label="Revenue over time"></svg>
            <div id="tooltip" class="pointer-events-none absolute z-10 hidden -translate-x-1/2 rounded-md bg-black px-2.5 py-1.5 text-xs text-white shadow-lg">
              <p id="tt-label" class="text-neutral-400"></p>
              <p id="tt-value" class="tabular font-semibold"></p>
            </div>
          </div>
        </div>

        <div class="rounded-xl border border-neutral-200 bg-white p-6">
          <h2 class="text-sm font-medium text-neutral-500">Sales by category</h2>
          <ul id="categories" class="mt-5 space-y-5"></ul>
        </div>
      </section>

      <!-- Orders + products -->
      <section class="mt-4 grid gap-4 lg:grid-cols-3">
        <div class="rounded-xl border border-neutral-200 bg-white lg:col-span-2">
          <div class="flex flex-wrap items-center justify-between gap-3 p-6 pb-4">
            <h2 class="text-base font-semibold">Recent orders</h2>
            <div class="inline-flex rounded-lg border border-neutral-200 p-0.5 text-xs font-medium" id="order-tabs">
              <button data-status="All"       class="order-tab rounded-md px-3 py-1.5">All</button>
              <button data-status="Pending"   class="order-tab rounded-md px-3 py-1.5">Pending</button>
              <button data-status="Shipped"   class="order-tab rounded-md px-3 py-1.5">Shipped</button>
              <button data-status="Delivered" class="order-tab rounded-md px-3 py-1.5">Delivered</button>
            </div>
          </div>

          <div class="overflow-x-auto">
            <table class="w-full min-w-[640px] text-left text-sm">
              <thead>
                <tr class="border-y border-neutral-200 bg-neutral-50 text-xs text-neutral-500">
                  <th class="px-6 py-2.5 font-medium">Order</th>
                  <th class="px-3 py-2.5 font-medium">Customer</th>
                  <th class="px-3 py-2.5 font-medium">Date</th>
                  <th class="px-3 py-2.5 font-medium">Status</th>
                  <th class="px-6 py-2.5 text-right font-medium">Total</th>
                </tr>
              </thead>
              <tbody id="orders-body" class="divide-y divide-neutral-100"></tbody>
            </table>
          </div>
          <div id="orders-empty" class="hidden px-6 py-12 text-center text-sm text-neutral-500">
            No orders match your search. Try a different name or order number.
          </div>
        </div>

        <div class="space-y-4">
          <div class="rounded-xl border border-neutral-200 bg-white p-6">
            <h2 class="text-base font-semibold">Best sellers</h2>
            <ul id="top-products" class="mt-5 space-y-4"></ul>
          </div>

          <div class="rounded-xl border border-neutral-200 bg-white p-6">
            <div class="flex items-center justify-between">
              <h2 class="text-base font-semibold">Low stock</h2>
              <span class="rounded-full bg-black px-2 py-0.5 text-[11px] font-medium text-white">3 items</span>
            </div>
            <ul id="low-stock" class="mt-4 divide-y divide-neutral-100"></ul>
          </div>
        </div>
      </section>

      <footer class="mt-10 pb-4 text-xs text-neutral-400">© <span id="year"></span> thewesternfashion. Admin panel.</footer>
    </main>
  </div>

  <script>
    /* ---------------------------------------------------------------
       1. Load the sidebar partial (sidebar.html)
       Note: fetch() needs a local server (VS Code Live Server, or
       `npx serve`, or `python -m http.server`), not file://
    ---------------------------------------------------------------- */
    const sidebarSlot = document.getElementById('sidebar-slot');
    const overlay = document.getElementById('overlay');

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
    const money = n => new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD', maximumFractionDigits: 0 }).format(n);

    const stats = [
      { label: 'Revenue',         value: '$48,290', delta: '+12.4%', up: true  },
      { label: 'Orders',          value: '1,284',   delta: '+8.1%',  up: true  },
      { label: 'New customers',   value: '412',     delta: '+4.6%',  up: true  },
      { label: 'Avg. order value', value: '$37.60', delta: '-2.3%',  up: false },
    ];

    const categories = [
      { name: 'Outerwear',   pct: 38 },
      { name: 'Denim',       pct: 27 },
      { name: 'Boots & shoes', pct: 21 },
      { name: 'Accessories', pct: 14 },
    ];

    const topProducts = [
      { name: 'Suede Fringe Jacket',   sold: 214, price: 129 },
      { name: 'Ranch Wash Jeans',      sold: 188, price: 74 },
      { name: 'Leather Western Boots', sold: 152, price: 168 },
      { name: 'Straw Cowboy Hat',      sold: 121, price: 46 },
      { name: 'Concho Leather Belt',   sold: 96,  price: 38 },
    ];

    const lowStock = [
      { name: 'Leather Western Boots · Size 9', left: 3 },
      { name: 'Suede Fringe Jacket · M',        left: 4 },
      { name: 'Turquoise Bolo Tie',             left: 2 },
    ];

    const orders = [
      { id: 'TWF-2841', customer: 'Hamza Sheikh',   date: 'Sep 21', status: 'Pending',   total: 203 },
      { id: 'TWF-2840', customer: 'Emily Carter',   date: 'Sep 21', status: 'Shipped',   total: 129 },
      { id: 'TWF-2839', customer: 'Sana Malik',     date: 'Sep 20', status: 'Delivered', total: 74  },
      { id: 'TWF-2838', customer: 'Jake Morrison',  date: 'Sep 20', status: 'Delivered', total: 214 },
      { id: 'TWF-2837', customer: 'Noor Fatima',    date: 'Sep 19', status: 'Cancelled', total: 46  },
      { id: 'TWF-2836', customer: 'Daniel Brooks',  date: 'Sep 19', status: 'Shipped',   total: 168 },
      { id: 'TWF-2835', customer: 'Areeba Khan',    date: 'Sep 18', status: 'Pending',   total: 112 },
      { id: 'TWF-2834', customer: 'Luke Hendricks', date: 'Sep 18', status: 'Delivered', total: 84  },
    ];

    // Revenue series per range
    const seeded = (() => { let s = 7; return () => (s = (s * 9301 + 49297) % 233280) / 233280; })();
    const series = {
      '7D':  { labels: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
               values: [3200, 4100, 3600, 5200, 4800, 6900, 6100] },
      '30D': { labels: Array.from({ length: 30 }, (_, i) => `Day ${i + 1}`),
               values: Array.from({ length: 30 }, (_, i) => Math.round(3000 + i * 55 + Math.sin(i / 2.2) * 700 + seeded() * 900)) },
      '12M': { labels: ['Oct','Nov','Dec','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep'],
               values: [28000, 31000, 29000, 36000, 41000, 38000, 44000, 47000, 43000, 52000, 58000, 64000] },
    };

    /* ---------------------------------------------------------------
       3. Render: greeting, stats, categories, products, stock
    ---------------------------------------------------------------- */
    const hour = new Date().getHours();
    document.getElementById('greeting').textContent =
      `Good ${hour < 12 ? 'morning' : hour < 18 ? 'afternoon' : 'evening'}, Ayesha`;
    document.getElementById('year').textContent = new Date().getFullYear();

    document.getElementById('stats').innerHTML = stats.map(s => `
      <div class="rounded-xl border border-neutral-200 bg-white p-5">
        <p class="text-sm text-neutral-500">${s.label}</p>
        <p class="tabular mt-2 text-3xl font-semibold tracking-tight">${s.value}</p>
        <p class="mt-3 flex items-center gap-1.5 text-xs">
          <span class="inline-flex items-center gap-0.5 rounded-full px-1.5 py-0.5 font-medium ${s.up ? 'bg-black text-white' : 'border border-neutral-300 text-neutral-700'}">
            <svg class="h-3 w-3 ${s.up ? '' : 'rotate-180'}" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17 17 7M8 7h9v9"/></svg>
            ${s.delta.replace('-', '')}
          </span>
          <span class="text-neutral-400">vs last period</span>
        </p>
      </div>`).join('');

    document.getElementById('categories').innerHTML = categories.map(c => `
      <li>
        <div class="mb-1.5 flex items-center justify-between text-sm">
          <span class="font-medium">${c.name}</span>
          <span class="tabular text-neutral-500">${c.pct}%</span>
        </div>
        <div class="h-1.5 w-full rounded-full bg-neutral-100">
          <div class="h-1.5 rounded-full bg-black" style="width:${c.pct}%"></div>
        </div>
      </li>`).join('');

    const maxSold = Math.max(...topProducts.map(p => p.sold));
    document.getElementById('top-products').innerHTML = topProducts.map(p => `
      <li>
        <div class="flex items-center justify-between text-sm">
          <span class="font-medium">${p.name}</span>
          <span class="tabular text-neutral-500">${p.sold} sold</span>
        </div>
        <div class="mt-2 h-1 w-full rounded-full bg-neutral-100">
          <div class="h-1 rounded-full bg-black" style="width:${(p.sold / maxSold) * 100}%"></div>
        </div>
      </li>`).join('');

    document.getElementById('low-stock').innerHTML = lowStock.map(i => `
      <li class="flex items-center justify-between gap-3 py-3 text-sm">
        <div class="min-w-0">
          <p class="truncate font-medium">${i.name}</p>
          <p class="text-xs text-neutral-500">${i.left} left</p>
        </div>
        <button class="shrink-0 rounded-md border border-neutral-200 px-2.5 py-1 text-xs font-medium hover:border-black">Restock</button>
      </li>`).join('');

    /* ---------------------------------------------------------------
       4. Orders table (status tabs + search)
    ---------------------------------------------------------------- */
    const badge = {
      Delivered: 'bg-black text-white',
      Shipped:   'border border-black text-black',
      Pending:   'bg-neutral-100 text-neutral-700',
      Cancelled: 'border border-neutral-200 text-neutral-400',
    };
    let statusFilter = 'All';
    let query = '';

    function renderOrders() {
      const q = query.trim().toLowerCase();
      const rows = orders.filter(o =>
        (statusFilter === 'All' || o.status === statusFilter) &&
        (!q || o.id.toLowerCase().includes(q) || o.customer.toLowerCase().includes(q)));

      document.getElementById('orders-body').innerHTML = rows.map(o => `
        <tr class="hover:bg-neutral-50">
          <td class="px-6 py-3.5 font-medium">#${o.id}</td>
          <td class="px-3 py-3.5">${o.customer}</td>
          <td class="px-3 py-3.5 text-neutral-500">${o.date}</td>
          <td class="px-3 py-3.5"><span class="inline-block rounded-full px-2.5 py-0.5 text-xs font-medium ${badge[o.status]}">${o.status}</span></td>
          <td class="tabular px-6 py-3.5 text-right font-medium">${money(o.total)}</td>
        </tr>`).join('');
      document.getElementById('orders-empty').classList.toggle('hidden', rows.length > 0);

      document.querySelectorAll('.order-tab').forEach(b => {
        const on = b.dataset.status === statusFilter;
        b.className = `order-tab rounded-md px-3 py-1.5 ${on ? 'bg-black text-white' : 'text-neutral-600 hover:text-black'}`;
      });
    }

    document.getElementById('order-tabs').addEventListener('click', e => {
      const b = e.target.closest('.order-tab'); if (!b) return;
      statusFilter = b.dataset.status; renderOrders();
    });
    document.getElementById('search').addEventListener('input', e => { query = e.target.value; renderOrders(); });
    renderOrders();

    /* ---------------------------------------------------------------
       5. Revenue chart (pure SVG, no library)
    ---------------------------------------------------------------- */
    const svg = document.getElementById('chart');
    const tooltip = document.getElementById('tooltip');
    const W = 800, H = 280, PL = 48, PR = 12, PT = 12, PB = 28;
    let current = '7D', pts = [];

    // Round the y-axis max up so 4 gridlines land on clean numbers
    function niceMax(v) {
      const mag = Math.pow(10, Math.floor(Math.log10(v / 4)));
      const m = [1, 2, 2.5, 5, 10].find(k => k * mag * 4 >= v);
      return m * mag * 4;
    }
    const kfmt = n => n >= 1000 ? `$${+(n / 1000).toFixed(1)}k` : `$${n}`;

    function drawChart(range) {
      current = range;
      const { labels, values } = series[range];
      const max = niceMax(Math.max(...values));
      const n = values.length;
      const x = i => PL + (i / (n - 1)) * (W - PL - PR);
      const y = v => PT + (1 - v / max) * (H - PT - PB);
      pts = values.map((v, i) => ({ x: x(i), y: y(v), v, label: labels[i] }));

      const line = pts.map((p, i) => `${i ? 'L' : 'M'}${p.x.toFixed(1)},${p.y.toFixed(1)}`).join(' ');
      const area = `${line} L${pts[n - 1].x},${H - PB} L${pts[0].x},${H - PB} Z`;

      let grid = '';
      for (let i = 0; i <= 4; i++) {
        const v = (max / 4) * i, yy = y(v);
        grid += `<line x1="${PL}" x2="${W - PR}" y1="${yy}" y2="${yy}" stroke="#e5e5e5" ${i ? 'stroke-dasharray="3 4"' : ''}/>` +
                `<text x="${PL - 10}" y="${yy + 4}" text-anchor="end" font-size="11" fill="#a3a3a3">${kfmt(v)}</text>`;
      }
      const step = Math.ceil(n / 7);
      const xl = labels.map((l, i) => i % step === 0
        ? `<text x="${x(i)}" y="${H - 8}" text-anchor="middle" font-size="11" fill="#a3a3a3">${l}</text>` : '').join('');

      svg.innerHTML = `
        <defs>
          <linearGradient id="fade" x1="0" x2="0" y1="0" y2="1">
            <stop offset="0" stop-color="#000" stop-opacity="0.08"/>
            <stop offset="1" stop-color="#000" stop-opacity="0"/>
          </linearGradient>
        </defs>
        ${grid}${xl}
        <path d="${area}" fill="url(#fade)"/>
        <path d="${line}" fill="none" stroke="#000" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"/>
        <g id="hover" style="display:none">
          <line id="h-line" y1="${PT}" y2="${H - PB}" stroke="#000" stroke-opacity=".2"/>
          <circle id="h-dot" r="5" fill="#fff" stroke="#000" stroke-width="2"/>
        </g>`;

      document.getElementById('chart-total').textContent =
        money(values.reduce((a, b) => a + b, 0));

      document.querySelectorAll('.chart-tab').forEach(b => {
        const on = b.dataset.range === range;
        b.className = `chart-tab rounded-md px-3 py-1.5 ${on ? 'bg-black text-white' : 'text-neutral-600 hover:text-black'}`;
      });
      document.getElementById('range').value = range;
    }

    svg.addEventListener('mousemove', e => {
      const r = svg.getBoundingClientRect();
      const px = ((e.clientX - r.left) / r.width) * W;
      const i = Math.max(0, Math.min(pts.length - 1, Math.round(((px - PL) / (W - PL - PR)) * (pts.length - 1))));
      const p = pts[i];
      const hover = svg.querySelector('#hover');
      hover.style.display = '';
      svg.querySelector('#h-line').setAttribute('x1', p.x);
      svg.querySelector('#h-line').setAttribute('x2', p.x);
      svg.querySelector('#h-dot').setAttribute('cx', p.x);
      svg.querySelector('#h-dot').setAttribute('cy', p.y);
      document.getElementById('tt-label').textContent = p.label;
      document.getElementById('tt-value').textContent = money(p.v);
      tooltip.classList.remove('hidden');
      tooltip.style.left = `${(p.x / W) * r.width}px`;
      tooltip.style.top = `${Math.max(0, (p.y / H) * r.height - 58)}px`;
    });
    svg.addEventListener('mouseleave', () => {
      tooltip.classList.add('hidden');
      const h = svg.querySelector('#hover'); if (h) h.style.display = 'none';
    });

    document.getElementById('chart-tabs').addEventListener('click', e => {
      const b = e.target.closest('.chart-tab'); if (b) drawChart(b.dataset.range);
    });
    document.getElementById('range').addEventListener('change', e => drawChart(e.target.value));
    drawChart('7D');
  </script>
</body>
</html>