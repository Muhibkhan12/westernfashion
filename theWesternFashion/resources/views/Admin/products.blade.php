<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Products · thewesternfashion admin</title>

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
    #drawer { transition: transform 0.2s ease-out; }
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
    input[type=number] { -moz-appearance: textfield; }
    @media (prefers-reduced-motion: reduce) { * { transition: none !important; } }
  </style>
</head>

<body data-page="products" class="bg-neutral-50 font-sans text-black antialiased">

@include('admin.sidebar')

  <!-- Sidebar is injected here from sidebar.html -->
  <div id="sidebar-slot"></div>
  <div id="overlay" class="fixed inset-0 z-30 hidden bg-black/40 lg:hidden"></div>

  <div class="lg:pl-64">

    <!-- Top bar -->
    <header class="sticky top-0 z-20 flex h-16 items-center gap-3 border-b border-neutral-200 bg-white/90 px-4 backdrop-blur sm:px-6 lg:px-8">
      <button id="menu-btn" class="rounded-md p-2 text-neutral-600 hover:bg-neutral-100 lg:hidden" aria-label="Open menu">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h10"/></svg>
      </button>

      <div class="relative max-w-md flex-1">
        <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-neutral-400" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
        <input id="search" type="search" placeholder="Search by product name or SKU"
          class="w-full rounded-lg border border-neutral-200 bg-neutral-50 py-2 pl-9 pr-3 text-sm placeholder:text-neutral-400 focus:border-black focus:bg-white focus:outline-none" />
      </div>

      <div class="ml-auto flex items-center gap-2">
        <button class="relative rounded-md p-2 text-neutral-600 hover:bg-neutral-100" aria-label="Notifications">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 1 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
          <span class="absolute right-2 top-2 h-1.5 w-1.5 rounded-full bg-black"></span>
        </button>
      </div>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

      <!-- Heading -->
      <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
          <h1 class="font-serif text-4xl tracking-tight">Products</h1>
          <p class="mt-1 text-sm text-neutral-500">Add products, set prices and choose what shows in your store.</p>
        </div>
        <div class="flex items-center gap-2">
          <button id="export-btn" class="inline-flex items-center gap-2 rounded-lg border border-neutral-200 bg-white px-3.5 py-2 text-sm font-medium hover:border-black">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m7 10 5 5 5-5"/><path d="M12 15V3"/></svg>
            Export CSV
          </button>
          <button id="add-btn" class="inline-flex items-center gap-2 rounded-lg bg-black px-3.5 py-2 text-sm font-medium text-white hover:bg-neutral-800">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
            Add product
          </button>
        </div>
      </div>

      <!-- Summary -->
      <section id="summary" class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4" aria-label="Product summary"></section>

      <!-- Catalog card -->
      <section class="mt-4 rounded-xl border border-neutral-200 bg-white">

        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-neutral-200 p-4 sm:px-6">
          <div id="status-tabs" class="flex flex-wrap gap-1 text-sm font-medium" role="tablist"></div>
          <div class="flex flex-wrap items-center gap-2">
            <select id="category" class="rounded-lg border border-neutral-200 bg-white px-3 py-2 text-sm focus:border-black focus:outline-none" aria-label="Category"></select>
            <select id="sort" class="rounded-lg border border-neutral-200 bg-white px-3 py-2 text-sm focus:border-black focus:outline-none" aria-label="Sort products">
              <option value="new">Newest first</option>
              <option value="best">Best selling</option>
              <option value="name">Name A–Z</option>
              <option value="low">Price: low to high</option>
              <option value="high">Price: high to low</option>
            </select>
            <div id="view-toggle" class="inline-flex rounded-lg border border-neutral-200 p-0.5">
              <button data-view="grid" class="rounded-md p-1.5" aria-label="Grid view">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
              </button>
              <button data-view="list" class="rounded-md p-1.5" aria-label="List view">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" stroke-linecap="round"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Grid view -->
        <div id="grid" class="grid gap-4 p-4 sm:grid-cols-2 sm:p-6 lg:grid-cols-3 xl:grid-cols-4"></div>

        <!-- List view -->
        <div id="list-wrap" class="hidden overflow-x-auto">
          <table class="w-full min-w-[820px] text-left text-sm">
            <thead>
              <tr class="border-b border-neutral-200 bg-neutral-50 text-xs text-neutral-500">
                <th class="px-6 py-2.5 font-medium">Product</th>
                <th class="px-3 py-2.5 font-medium">Category</th>
                <th class="px-3 py-2.5 font-medium">Status</th>
                <th class="px-3 py-2.5 font-medium">Stock</th>
                <th class="px-3 py-2.5 text-right font-medium">Sold</th>
                <th class="px-6 py-2.5 text-right font-medium">Price</th>
              </tr>
            </thead>
            <tbody id="list-body" class="divide-y divide-neutral-100"></tbody>
          </table>
        </div>

        <div id="empty" class="hidden px-6 py-16 text-center">
          <p class="text-sm font-medium">No products found</p>
          <p class="mt-1 text-sm text-neutral-500">Try a different name or SKU, or clear the filters.</p>
          <button id="reset-filters" class="mt-4 rounded-lg border border-neutral-200 px-3 py-1.5 text-sm font-medium hover:border-black">Clear filters</button>
        </div>

        <div class="flex flex-wrap items-center justify-between gap-3 border-t border-neutral-200 px-4 py-3 text-sm sm:px-6">
          <p id="page-info" class="text-neutral-500"></p>
          <div id="pager" class="flex items-center gap-1"></div>
        </div>
      </section>
    </main>
  </div>

  <!-- Product drawer (add / edit) -->
  <div id="drawer-overlay" class="fixed inset-0 z-40 hidden bg-black/40"></div>
  <aside id="drawer" class="fixed inset-y-0 right-0 z-50 flex w-full max-w-md translate-x-full flex-col border-l border-neutral-200 bg-white shadow-xl" aria-label="Product details" aria-hidden="true"></aside>

  <!-- Toast -->
  <div id="toast" class="pointer-events-none fixed bottom-6 left-1/2 z-[60] -translate-x-1/2 translate-y-2 rounded-lg bg-black px-4 py-2.5 text-sm font-medium text-white opacity-0 shadow-lg transition-all duration-200"></div>

  <script>
    /* ---------------------------------------------------------------
       1. Sidebar (needs a local server, same as the other pages)
    ---------------------------------------------------------------- */
    const sidebarSlot = document.getElementById('sidebar-slot');
    const overlay = document.getElementById('overlay');
    /* ---------------------------------------------------------------
       2. Placeholder data (replace with your API)
       [name, sku, category, price, compare-at, status, sold, stock, days since created, description]
    ---------------------------------------------------------------- */
    const money = n => new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(n);
    const esc = s => String(s).replace(/[&<>"']/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));
    const initials = n => n.split(' ').slice(0, 2).map(w => w[0]).join('');

    const CATEGORIES = ['Outerwear', 'Denim', 'Shirts', 'Footwear', 'Accessories'];
    const PREFIX = { Outerwear: 'OW', Denim: 'DN', Shirts: 'SH', Footwear: 'FW', Accessories: 'AC' };

    const raw = [
      ['Suede Fringe Jacket',       'TWF-OW-001', 'Outerwear',   129, 159, 'Active',   214, 9,  210, 'Soft split-suede jacket with hand-cut fringe on the yoke and sleeves.'],
      ['Shearling Trucker Jacket',  'TWF-OW-002', 'Outerwear',   189, null,'Active',    96, 27, 160, 'Classic trucker cut lined in warm shearling. Built for cold mornings.'],
      ['Waxed Canvas Duster',       'TWF-OW-003', 'Outerwear',   149, null,'Active',    58, 14, 120, 'Knee-length duster in waxed canvas that gets better with wear.'],
      ['Fringe Leather Vest',       'TWF-OW-004', 'Outerwear',    99, null,'Draft',      0, 0,  6,   'Full-grain leather vest with a fringe hem. Photos still to come.'],
      ['Ranch Wash Jeans',          'TWF-DN-001', 'Denim',        74, null,'Active',   188, 77, 300, 'Straight-leg jeans in a mid ranch wash with a comfortable rise.'],
      ['Bootcut Raw Denim',         'TWF-DN-002', 'Denim',        82, 95,  'Active',   131, 44, 240, 'Raw 13 oz denim cut to fit over boots. Will fade to you.'],
      ['Denim Vest',                'TWF-DN-003', 'Denim',        64, null,'Active',    47, 18, 90,  'Layering vest in rigid denim with brass snap buttons.'],
      ['Rancher Denim Shirt',       'TWF-SH-001', 'Shirts',       58, null,'Active',   102, 44, 200, 'Lightweight chambray shirt with pearl snaps and pointed yokes.'],
      ['Snap Button Western Shirt', 'TWF-SH-002', 'Shirts',       52, null,'Active',   143, 0,  180, 'Everyday western shirt with contrast piping and pearl snaps.'],
      ['Plaid Flannel Shirt',       'TWF-SH-003', 'Shirts',       49, 60,  'Active',    88, 27, 75,  'Brushed cotton flannel in a heritage plaid.'],
      ['Western Yoke Shirt',        'TWF-SH-004', 'Shirts',       61, null,'Draft',      0, 0,  4,   'Embroidered yoke shirt. Waiting on final size chart.'],
      ['Leather Western Boots',     'TWF-FW-001', 'Footwear',    168, null,'Active',   152, 10, 330, 'Goodyear-welted boots in oiled leather with a stacked heel.'],
      ['Roper Ankle Boots',         'TWF-FW-002', 'Footwear',    139, null,'Active',    74, 31, 140, 'Low-shaft roper boots with a cushioned insole.'],
      ['Tooled Leather Boots',      'TWF-FW-003', 'Footwear',    210, null,'Active',    39, 0,  100, 'Hand-tooled floral shaft with a snip toe.'],
      ['Straw Cowboy Hat',          'TWF-AC-001', 'Accessories',  46, null,'Active',   121, 40, 220, 'Breathable woven straw with a shaped brim for sunny days.'],
      ['Felt Rancher Hat',          'TWF-AC-002', 'Accessories',  72, null,'Active',    63, 13, 130, 'Wool felt hat with a pinch front and leather sweatband.'],
      ['Concho Leather Belt',       'TWF-AC-003', 'Accessories',  38, null,'Active',    96, 37, 250, 'Full-grain belt with silver-tone conchos.'],
      ['Turquoise Bolo Tie',        'TWF-AC-004', 'Accessories',  32, null,'Active',    54, 2,  110, 'Turquoise stone on a braided leather cord.'],
      ['Bandana Print Scarf',       'TWF-AC-005', 'Accessories',  18, null,'Active',    77, 64, 70,  'Soft cotton scarf in a classic paisley bandana print.'],
      ['Braided Leather Cuff',      'TWF-AC-006', 'Accessories',  28, null,'Active',    41, 18, 50,  'Hand-braided leather cuff with a snap closure.'],
      ['Silver Buckle Belt',        'TWF-AC-007', 'Accessories',  44, null,'Archived',  33, 0,  400, 'Discontinued. Kept for order history.'],
    ];
    let nextId = raw.length + 1;
    const products = raw.map(([name, sku, category, price, compare, status, sold, stock, age, description], i) =>
      ({ id: i + 1, name, sku, category, price, compare, status, sold, stock, age, description }));

    /* ---------------------------------------------------------------
       3. State + helpers
    ---------------------------------------------------------------- */
    const PER_PAGE = 12;
    const state = { status: 'All', category: 'All', sort: 'new', q: '', page: 1, view: 'grid' };

    function toast(msg) {
      const t = document.getElementById('toast');
      t.textContent = msg;
      t.classList.remove('opacity-0', 'translate-y-2');
      clearTimeout(toast.timer);
      toast.timer = setTimeout(() => t.classList.add('opacity-0', 'translate-y-2'), 2400);
    }

    const statusBadge = {
      Active:   'border border-neutral-200 text-neutral-700',
      Draft:    'bg-neutral-100 text-neutral-600',
      Archived: 'border border-neutral-200 text-neutral-400',
    };
    const badge = p => `<span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-0.5 text-xs font-medium ${statusBadge[p.status]}">${p.status === 'Active' ? '<span class="h-1.5 w-1.5 rounded-full bg-black"></span>' : ''}${p.status}</span>`;
    const stockLabel = p => p.stock === 0 ? 'Out of stock' : `${p.stock} in stock`;

    function getFiltered() {
      const q = state.q.trim().toLowerCase();
      const list = products.filter(p =>
        (state.status === 'All' || p.status === state.status) &&
        (state.category === 'All' || p.category === state.category) &&
        (!q || p.name.toLowerCase().includes(q) || p.sku.toLowerCase().includes(q)));
      const sorters = {
        new:  (a, b) => a.age - b.age,
        best: (a, b) => b.sold - a.sold,
        name: (a, b) => a.name.localeCompare(b.name),
        low:  (a, b) => a.price - b.price,
        high: (a, b) => b.price - a.price,
      };
      return list.sort(sorters[state.sort]);
    }

    /* ---------------------------------------------------------------
       4. Render
    ---------------------------------------------------------------- */
    document.getElementById('category').innerHTML =
      ['All', ...CATEGORIES].map(c => `<option value="${c}">${c === 'All' ? 'All categories' : c}</option>`).join('');

    function renderSummary() {
      const active = products.filter(p => p.status === 'Active');
      const drafts = products.filter(p => p.status === 'Draft').length;
      const avg = active.reduce((s, p) => s + p.price, 0) / (active.length || 1);
      const top = [...products].sort((a, b) => b.sold - a.sold)[0];
      const cards = [
        ['Products',    products.length, `${CATEGORIES.length} categories`],
        ['Live in store', active.length, 'Visible to shoppers'],
        ['Drafts',      drafts,          'Not published yet'],
        ['Avg. price',  money(avg),      `Best seller: ${top.name}`],
      ];
      document.getElementById('summary').innerHTML = cards.map(([label, val, note]) => `
        <div class="rounded-xl border border-neutral-200 bg-white p-5">
          <p class="text-sm text-neutral-500">${label}</p>
          <p class="tabular mt-2 text-3xl font-semibold tracking-tight">${val}</p>
          <p class="mt-3 truncate text-xs text-neutral-400">${esc(note)}</p>
        </div>`).join('');
    }

    function renderTabs() {
      const tabs = ['All', 'Active', 'Draft', 'Archived'];
      document.getElementById('status-tabs').innerHTML = tabs.map(t => {
        const count = t === 'All' ? products.length : products.filter(p => p.status === t).length;
        const on = state.status === t;
        return `<button data-status="${t}" role="tab" aria-selected="${on}" class="rounded-lg px-3 py-1.5 ${on ? 'bg-black text-white' : 'text-neutral-600 hover:bg-neutral-100 hover:text-black'}">
          ${t} <span class="tabular ml-1 text-xs text-neutral-400">${count}</span></button>`;
      }).join('');
      document.querySelectorAll('#view-toggle button').forEach(b => {
        const on = b.dataset.view === state.view;
        b.className = `rounded-md p-1.5 ${on ? 'bg-black text-white' : 'text-neutral-500 hover:text-black'}`;
        b.setAttribute('aria-pressed', on);
      });
    }

    function card(p) {
      const onSale = p.compare && p.compare > p.price;
      return `
      <article data-id="${p.id}" tabindex="0" class="group cursor-pointer overflow-hidden rounded-xl border border-neutral-200 bg-white hover:border-black">
        <div class="relative grid aspect-[4/3] place-items-center bg-neutral-100">
          <span class="font-serif text-5xl text-neutral-300">${initials(p.name)}</span>
          <div class="absolute left-3 top-3 flex gap-1.5">
            ${p.status !== 'Active' ? `<span class="rounded-full bg-white px-2 py-0.5 text-xs font-medium text-neutral-700">${p.status}</span>` : ''}
            ${onSale ? '<span class="rounded-full bg-black px-2 py-0.5 text-xs font-medium text-white">Sale</span>' : ''}
          </div>
        </div>
        <div class="p-4">
          <p class="truncate font-medium">${esc(p.name)}</p>
          <p class="mt-0.5 text-xs text-neutral-500">${p.category} · ${p.sku}</p>
          <div class="mt-3 flex items-baseline justify-between">
            <p class="tabular">
              <span class="font-semibold">${money(p.price)}</span>
              ${onSale ? `<span class="ml-1.5 text-xs text-neutral-400 line-through">${money(p.compare)}</span>` : ''}
            </p>
            <p class="tabular text-xs ${p.stock === 0 ? 'font-medium text-black' : 'text-neutral-500'}">${stockLabel(p)}</p>
          </div>
        </div>
      </article>`;
    }

    function row(p) {
      const onSale = p.compare && p.compare > p.price;
      return `
      <tr data-id="${p.id}" class="cursor-pointer hover:bg-neutral-50">
        <td class="px-6 py-3.5">
          <div class="flex items-center gap-3">
            <div class="grid h-10 w-10 shrink-0 place-items-center rounded-lg bg-neutral-100 font-serif text-base text-neutral-500">${initials(p.name)}</div>
            <div class="min-w-0">
              <p class="truncate font-medium">${esc(p.name)}</p>
              <p class="text-xs text-neutral-500">${p.sku}</p>
            </div>
          </div>
        </td>
        <td class="px-3 py-3.5 text-neutral-500">${p.category}</td>
        <td class="px-3 py-3.5">${badge(p)}</td>
        <td class="tabular px-3 py-3.5 ${p.stock === 0 ? 'font-medium' : 'text-neutral-500'}">${stockLabel(p)}</td>
        <td class="tabular px-3 py-3.5 text-right text-neutral-500">${p.sold}</td>
        <td class="tabular px-6 py-3.5 text-right font-medium">${money(p.price)}${onSale ? `<span class="ml-1.5 text-xs font-normal text-neutral-400 line-through">${money(p.compare)}</span>` : ''}</td>
      </tr>`;
    }

    function render() {
      const rows = getFiltered();
      const pages = Math.max(1, Math.ceil(rows.length / PER_PAGE));
      state.page = Math.min(state.page, pages);
      const start = (state.page - 1) * PER_PAGE;
      const pageRows = rows.slice(start, start + PER_PAGE);

      renderSummary();
      renderTabs();

      const grid = document.getElementById('grid');
      grid.classList.toggle('hidden', state.view !== 'grid' || rows.length === 0);
      document.getElementById('list-wrap').classList.toggle('hidden', state.view !== 'list' || rows.length === 0);
      grid.innerHTML = pageRows.map(card).join('');
      document.getElementById('list-body').innerHTML = pageRows.map(row).join('');
      document.getElementById('empty').classList.toggle('hidden', rows.length > 0);

      document.getElementById('page-info').textContent = rows.length
        ? `Showing ${start + 1}–${Math.min(start + PER_PAGE, rows.length)} of ${rows.length} products`
        : '0 products';
      const btn = (label, page, disabled, on) =>
        `<button data-page="${page}" ${disabled ? 'disabled' : ''} class="tabular min-w-[2rem] rounded-md px-2.5 py-1.5 text-sm font-medium ${on ? 'bg-black text-white' : 'text-neutral-600 hover:bg-neutral-100'} disabled:cursor-not-allowed disabled:opacity-30 disabled:hover:bg-transparent">${label}</button>`;
      let pager = btn('Prev', state.page - 1, state.page === 1, false);
      for (let p = 1; p <= pages; p++) pager += btn(p, p, false, p === state.page);
      pager += btn('Next', state.page + 1, state.page === pages, false);
      document.getElementById('pager').innerHTML = rows.length && pages > 1 ? pager : '';
    }

    /* ---------------------------------------------------------------
       5. Events
    ---------------------------------------------------------------- */
    document.getElementById('status-tabs').addEventListener('click', e => {
      const b = e.target.closest('[data-status]'); if (!b) return;
      state.status = b.dataset.status; state.page = 1; render();
    });
    document.getElementById('view-toggle').addEventListener('click', e => {
      const b = e.target.closest('[data-view]'); if (!b) return;
      state.view = b.dataset.view; render();
    });
    document.getElementById('category').addEventListener('change', e => { state.category = e.target.value; state.page = 1; render(); });
    document.getElementById('sort').addEventListener('change', e => { state.sort = e.target.value; state.page = 1; render(); });
    document.getElementById('search').addEventListener('input', e => { state.q = e.target.value; state.page = 1; render(); });
    document.getElementById('reset-filters').addEventListener('click', () => {
      Object.assign(state, { status: 'All', category: 'All', q: '', page: 1 });
      document.getElementById('category').value = 'All';
      document.getElementById('search').value = '';
      render();
    });
    document.getElementById('pager').addEventListener('click', e => {
      const b = e.target.closest('[data-page]'); if (!b || b.disabled) return;
      state.page = +b.dataset.page; render();
    });

    const openFromEvent = e => {
      const el = e.target.closest('[data-id]'); if (el) openDrawer(+el.dataset.id);
    };
    document.getElementById('grid').addEventListener('click', openFromEvent);
    document.getElementById('grid').addEventListener('keydown', e => { if (e.key === 'Enter') openFromEvent(e); });
    document.getElementById('list-body').addEventListener('click', openFromEvent);
    document.getElementById('add-btn').addEventListener('click', () => openDrawer(null));

    document.getElementById('export-btn').addEventListener('click', () => {
      const head = ['Name', 'SKU', 'Category', 'Status', 'Price', 'Compare-at price', 'Stock', 'Sold'];
      const lines = getFiltered().map(p => [p.name, p.sku, p.category, p.status, p.price.toFixed(2), p.compare ? p.compare.toFixed(2) : '', p.stock, p.sold]
        .map(v => `"${String(v).replace(/"/g, '""')}"`).join(','));
      const blob = new Blob([[head.join(','), ...lines].join('\n')], { type: 'text/csv' });
      const a = Object.assign(document.createElement('a'), { href: URL.createObjectURL(blob), download: 'products.csv' });
      a.click(); URL.revokeObjectURL(a.href);
      toast('Products exported');
    });

    /* ---------------------------------------------------------------
       6. Product drawer (add / edit form)
    ---------------------------------------------------------------- */
    const drawer = document.getElementById('drawer');
    const drawerOverlay = document.getElementById('drawer-overlay');
    let editingId = null;      // null = adding a new product
    let drawerOpen = false;
    let draftStatus = 'Draft';
    let deleteTimer = null;

    const field = 'mt-1.5 w-full rounded-lg border border-neutral-200 px-3 py-2 text-sm placeholder:text-neutral-400 focus:border-black focus:outline-none';

    function formHTML(p) {
      const isNew = !p;
      const v = p || { name: '', sku: '', category: CATEGORIES[0], price: '', compare: '', description: '', status: 'Draft' };
      return `
      <div class="flex items-start justify-between border-b border-neutral-200 p-6">
        <div>
          <h2 class="text-lg font-semibold tracking-tight">${isNew ? 'Add product' : 'Edit product'}</h2>
          <p class="text-xs text-neutral-500">${isNew ? 'Save as a draft first, publish when it\'s ready.' : `${v.sku} · ${v.sold} sold · ${stockLabel(v)}`}</p>
        </div>
        <button id="drawer-close" class="rounded-md p-1.5 text-neutral-500 hover:bg-neutral-100 hover:text-black" aria-label="Close">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6L6 18"/></svg>
        </button>
      </div>

      <div class="flex-1 space-y-5 overflow-y-auto p-6">
        <div>
          <label for="f-name" class="text-sm font-medium">Name</label>
          <input id="f-name" type="text" value="${esc(v.name)}" placeholder="e.g. Suede Fringe Jacket" class="${field}" />
          <p id="err-name" class="mt-1 hidden text-xs font-medium text-black"></p>
        </div>

        <div>
          <label for="f-desc" class="text-sm font-medium">Description</label>
          <textarea id="f-desc" rows="3" placeholder="What is it made of, and how does it fit?" class="${field} resize-none">${esc(v.description)}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
          <div>
            <label for="f-category" class="text-sm font-medium">Category</label>
            <select id="f-category" class="${field} bg-white">
              ${CATEGORIES.map(c => `<option ${c === v.category ? 'selected' : ''}>${c}</option>`).join('')}
            </select>
          </div>
          <div>
            <label for="f-sku" class="text-sm font-medium">SKU</label>
            <input id="f-sku" type="text" value="${esc(v.sku)}" placeholder="Auto-generated" class="${field}" />
            <p id="err-sku" class="mt-1 hidden text-xs font-medium text-black"></p>
          </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
          <div>
            <label for="f-price" class="text-sm font-medium">Price</label>
            <div class="relative">
              <span class="pointer-events-none absolute left-3 top-1/2 mt-0.5 -translate-y-1/2 text-sm text-neutral-400">$</span>
              <input id="f-price" type="number" min="0" step="0.01" value="${v.price}" placeholder="0.00" class="${field} pl-7" />
            </div>
            <p id="err-price" class="mt-1 hidden text-xs font-medium text-black"></p>
          </div>
          <div>
            <label for="f-compare" class="text-sm font-medium">Compare-at price</label>
            <div class="relative">
              <span class="pointer-events-none absolute left-3 top-1/2 mt-0.5 -translate-y-1/2 text-sm text-neutral-400">$</span>
              <input id="f-compare" type="number" min="0" step="0.01" value="${v.compare || ''}" placeholder="Optional" class="${field} pl-7" />
            </div>
            <p id="err-compare" class="mt-1 hidden text-xs font-medium text-black"></p>
          </div>
        </div>
        <p class="-mt-2 text-xs text-neutral-500">Set a compare-at price higher than the price to show the product as on sale.</p>

        <div>
          <p class="text-sm font-medium">Status</p>
          <div id="f-status" class="mt-1.5 inline-flex rounded-lg border border-neutral-200 p-0.5 text-sm font-medium" role="radiogroup" aria-label="Status"></div>
          <p id="status-hint" class="mt-2 text-xs text-neutral-500"></p>
        </div>
      </div>

      <div class="flex items-center gap-2 border-t border-neutral-200 p-6">
        ${isNew ? '' : '<button id="d-delete" class="mr-auto rounded-lg px-3 py-2 text-sm font-medium text-neutral-500 hover:text-black">Delete</button>'}
        <button id="d-cancel" class="rounded-lg border border-neutral-200 px-4 py-2 text-sm font-medium hover:border-black ${isNew ? 'flex-1' : ''}">Cancel</button>
        <button id="d-save" class="rounded-lg bg-black px-4 py-2 text-sm font-medium text-white hover:bg-neutral-800 ${isNew ? 'flex-1' : ''}">${isNew ? 'Add product' : 'Save changes'}</button>
      </div>`;
    }

    const statusHints = {
      Active:   'Shoppers can find and buy this product.',
      Draft:    'Only your team can see this product.',
      Archived: 'Hidden from the store but kept for order history.',
    };
    function renderStatusControl() {
      document.getElementById('f-status').innerHTML = ['Active', 'Draft', 'Archived'].map(s => `
        <button data-set-status="${s}" role="radio" aria-checked="${s === draftStatus}" class="rounded-md px-3.5 py-1.5 ${s === draftStatus ? 'bg-black text-white' : 'text-neutral-600 hover:text-black'}">${s}</button>`).join('');
      document.getElementById('status-hint').textContent = statusHints[draftStatus];
    }

    function openDrawer(id) {
      editingId = id;
      const p = id ? products.find(x => x.id === id) : null;
      if (id && !p) return;
      draftStatus = p ? p.status : 'Draft';
      drawer.innerHTML = formHTML(p);
      renderStatusControl();
      drawerOpen = true;
      drawer.setAttribute('aria-hidden', 'false');
      drawerOverlay.classList.remove('hidden');
      requestAnimationFrame(() => drawer.classList.remove('translate-x-full'));
      document.getElementById('f-name').focus();
    }
    function closeDrawer() {
      drawerOpen = false;
      clearTimeout(deleteTimer);
      drawer.classList.add('translate-x-full');
      drawer.setAttribute('aria-hidden', 'true');
      drawerOverlay.classList.add('hidden');
    }

    function showError(id, msg) {
      const el = document.getElementById(id);
      el.textContent = msg || '';
      el.classList.toggle('hidden', !msg);
    }

    function saveProduct() {
      const name = document.getElementById('f-name').value.trim();
      const description = document.getElementById('f-desc').value.trim();
      const category = document.getElementById('f-category').value;
      let sku = document.getElementById('f-sku').value.trim().toUpperCase();
      const price = parseFloat(document.getElementById('f-price').value);
      const compareRaw = document.getElementById('f-compare').value;
      const compare = compareRaw === '' ? null : parseFloat(compareRaw);

      // Validate
      let ok = true;
      showError('err-name', !name ? 'Enter a product name.' : ''); if (!name) ok = false;
      showError('err-price', !(price > 0) ? 'Enter a price greater than $0.' : ''); if (!(price > 0)) ok = false;
      const badCompare = compare !== null && !(compare > price);
      showError('err-compare', badCompare ? 'Must be higher than the price.' : ''); if (badCompare) ok = false;
      const dupe = sku && products.some(p => p.sku === sku && p.id !== editingId);
      showError('err-sku', dupe ? 'This SKU is already used.' : ''); if (dupe) ok = false;
      if (!ok) return;

      if (!sku) {
        const n = products.filter(p => p.category === category).length + 1;
        sku = `TWF-${PREFIX[category]}-${String(n).padStart(3, '0')}`;
        while (products.some(p => p.sku === sku && p.id !== editingId)) sku = sku.replace(/(\d+)$/, m => String(+m + 1).padStart(3, '0'));
      }

      if (editingId) {
        Object.assign(products.find(p => p.id === editingId), { name, description, category, sku, price, compare, status: draftStatus });
        toast(`${name} saved`);
      } else {
        products.push({ id: nextId++, name, description, category, sku, price, compare, status: draftStatus, sold: 0, stock: 0, age: 0 });
        state.status = 'All'; state.category = 'All'; state.q = ''; state.sort = 'new'; state.page = 1;
        document.getElementById('category').value = 'All';
        document.getElementById('sort').value = 'new';
        document.getElementById('search').value = '';
        toast(`${name} added`);
      }
      closeDrawer(); render();
    }

    drawer.addEventListener('click', e => {
      if (e.target.closest('#drawer-close') || e.target.closest('#d-cancel')) return closeDrawer();
      const s = e.target.closest('[data-set-status]');
      if (s) { draftStatus = s.dataset.setStatus; return renderStatusControl(); }
      if (e.target.closest('#d-save')) return saveProduct();

      const del = e.target.closest('#d-delete');
      if (del) {
        // Two-step delete: first click asks, second click confirms
        if (del.dataset.confirm) {
          const i = products.findIndex(p => p.id === editingId);
          const [gone] = products.splice(i, 1);
          closeDrawer(); render(); toast(`${gone.name} deleted`);
        } else {
          del.dataset.confirm = '1';
          del.textContent = 'Click again to delete';
          del.className = 'mr-auto rounded-lg border border-black px-3 py-2 text-sm font-medium text-black';
          deleteTimer = setTimeout(() => {
            del.removeAttribute('data-confirm'); del.textContent = 'Delete';
            del.className = 'mr-auto rounded-lg px-3 py-2 text-sm font-medium text-neutral-500 hover:text-black';
          }, 3000);
        }
      }
    });
    drawerOverlay.addEventListener('click', closeDrawer);
    document.addEventListener('keydown', e => { if (e.key === 'Escape' && drawerOpen) closeDrawer(); });

    render();
  </script>
</body>
</html>