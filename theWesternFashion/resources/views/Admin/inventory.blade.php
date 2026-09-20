<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Inventory · thewesternfashion admin</title>

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

<body data-page="inventory" class="bg-neutral-50 font-sans text-black antialiased">

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
          <h1 class="font-serif text-4xl tracking-tight">Inventory</h1>
          <p class="mt-1 text-sm text-neutral-500">Track stock levels by size and restock before you sell out.</p>
        </div>
        <div class="flex items-center gap-2">
          <button id="export-btn" class="inline-flex items-center gap-2 rounded-lg border border-neutral-200 bg-white px-3.5 py-2 text-sm font-medium hover:border-black">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m7 10 5 5 5-5"/><path d="M12 15V3"/></svg>
            Export CSV
          </button>
          <button class="inline-flex items-center gap-2 rounded-lg bg-black px-3.5 py-2 text-sm font-medium text-white hover:bg-neutral-800">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
            Add product
          </button>
        </div>
      </div>

      <!-- Summary -->
      <section id="summary" class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4" aria-label="Inventory summary"></section>

      <!-- Restock alert -->
      <div id="alert" class="mt-4 hidden flex-wrap items-center justify-between gap-3 rounded-xl border border-black bg-white px-5 py-3.5 text-sm"></div>

      <!-- Table card -->
      <section class="mt-4 rounded-xl border border-neutral-200 bg-white">

        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-neutral-200 p-4 sm:px-6">
          <div id="status-tabs" class="flex flex-wrap gap-1 text-sm font-medium" role="tablist"></div>
          <div class="flex items-center gap-2">
            <select id="category" class="rounded-lg border border-neutral-200 bg-white px-3 py-2 text-sm focus:border-black focus:outline-none" aria-label="Category"></select>
            <select id="sort" class="rounded-lg border border-neutral-200 bg-white px-3 py-2 text-sm focus:border-black focus:outline-none" aria-label="Sort products">
              <option value="name">Name A–Z</option>
              <option value="low">Lowest stock first</option>
              <option value="high">Highest stock first</option>
              <option value="value">Highest stock value</option>
            </select>
          </div>
        </div>

        <div class="overflow-x-auto">
          <table class="w-full min-w-[820px] text-left text-sm">
            <thead>
              <tr class="border-b border-neutral-200 bg-neutral-50 text-xs text-neutral-500">
                <th class="px-6 py-2.5 font-medium">Product</th>
                <th class="px-3 py-2.5 font-medium">Category</th>
                <th class="px-3 py-2.5 font-medium">Stock</th>
                <th class="px-3 py-2.5 font-medium">Status</th>
                <th class="px-3 py-2.5 text-right font-medium">Price</th>
                <th class="px-6 py-2.5 text-right font-medium">Stock value</th>
              </tr>
            </thead>
            <tbody id="body" class="divide-y divide-neutral-100"></tbody>
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

  <!-- Stock drawer -->
  <div id="drawer-overlay" class="fixed inset-0 z-40 hidden bg-black/40"></div>
  <aside id="drawer" class="fixed inset-y-0 right-0 z-50 flex w-full max-w-md translate-x-full flex-col border-l border-neutral-200 bg-white shadow-xl" aria-label="Adjust stock" aria-hidden="true"></aside>

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
       [name, sku, category, price, reorder level, sizes, quantities]
    ---------------------------------------------------------------- */
    const money  = n => new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(n);
    const money0 = n => new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD', maximumFractionDigits: 0 }).format(n);
    const esc = s => String(s).replace(/[&<>"']/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));

    const APPAREL = ['S', 'M', 'L', 'XL'];
    const WAIST   = ['28', '30', '32', '34', '36'];
    const SHOE    = ['7', '8', '9', '10', '11'];

    const raw = [
      ['Suede Fringe Jacket',       'TWF-OW-001', 'Outerwear',   129, 12, APPAREL, [5, 2, 1, 1]],
      ['Shearling Trucker Jacket',  'TWF-OW-002', 'Outerwear',   189, 8,  APPAREL, [6, 9, 8, 4]],
      ['Waxed Canvas Duster',       'TWF-OW-003', 'Outerwear',   149, 8,  APPAREL, [3, 5, 4, 2]],
      ['Ranch Wash Jeans',          'TWF-DN-001', 'Denim',        74, 20, WAIST,   [12, 18, 22, 16, 9]],
      ['Bootcut Raw Denim',         'TWF-DN-002', 'Denim',        82, 20, WAIST,   [8, 11, 14, 7, 4]],
      ['Denim Vest',                'TWF-DN-003', 'Denim',        64, 10, APPAREL, [4, 6, 5, 3]],
      ['Rancher Denim Shirt',       'TWF-SH-001', 'Shirts',       58, 15, APPAREL, [10, 14, 12, 8]],
      ['Snap Button Western Shirt', 'TWF-SH-002', 'Shirts',       52, 15, APPAREL, [0, 0, 0, 0]],
      ['Plaid Flannel Shirt',       'TWF-SH-003', 'Shirts',       49, 15, APPAREL, [6, 9, 7, 5]],
      ['Leather Western Boots',     'TWF-FW-001', 'Footwear',    168, 14, SHOE,    [2, 4, 0, 3, 1]],
      ['Roper Ankle Boots',         'TWF-FW-002', 'Footwear',    139, 12, SHOE,    [5, 7, 9, 6, 4]],
      ['Tooled Leather Boots',      'TWF-FW-003', 'Footwear',    210, 10, SHOE,    [0, 0, 0, 0, 0]],
      ['Straw Cowboy Hat',          'TWF-AC-001', 'Accessories',  46, 15, ['S', 'M', 'L'], [11, 16, 13]],
      ['Felt Rancher Hat',          'TWF-AC-002', 'Accessories',  72, 10, ['S', 'M', 'L'], [4, 6, 3]],
      ['Concho Leather Belt',       'TWF-AC-003', 'Accessories',  38, 15, ['32', '34', '36', '38'], [9, 12, 10, 6]],
      ['Turquoise Bolo Tie',        'TWF-AC-004', 'Accessories',  32, 10, ['One size'], [2]],
      ['Bandana Print Scarf',       'TWF-AC-005', 'Accessories',  18, 25, ['One size'], [64]],
      ['Braided Leather Cuff',      'TWF-AC-006', 'Accessories',  28, 10, ['One size'], [18]],
    ];
    const products = raw.map(([name, sku, category, price, reorder, sizes, qty]) =>
      ({ name, sku, category, price, reorder, variants: sizes.map((size, i) => ({ size, qty: qty[i] })) }));

    /* ---------------------------------------------------------------
       3. State + helpers
    ---------------------------------------------------------------- */
    const PER_PAGE = 10;
    const state = { status: 'All', category: 'All', sort: 'name', q: '', page: 1 };

    const units  = p => p.variants.reduce((s, v) => s + v.qty, 0);
    const statusOf = (total, reorder) => total === 0 ? 'Out of stock' : total <= reorder ? 'Low stock' : 'In stock';
    const stockStatus = p => statusOf(units(p), p.reorder);

    const badge = {
      'In stock':     'border border-neutral-200 text-neutral-700',
      'Low stock':    'border border-black text-black',
      'Out of stock': 'bg-black text-white',
    };
    const initials = n => n.split(' ').slice(0, 2).map(w => w[0]).join('');

    function toast(msg) {
      const t = document.getElementById('toast');
      t.textContent = msg;
      t.classList.remove('opacity-0', 'translate-y-2');
      clearTimeout(toast.timer);
      toast.timer = setTimeout(() => t.classList.add('opacity-0', 'translate-y-2'), 2400);
    }

    function getFiltered() {
      const q = state.q.trim().toLowerCase();
      const list = products.filter(p =>
        (state.status === 'All' || stockStatus(p) === state.status) &&
        (state.category === 'All' || p.category === state.category) &&
        (!q || p.name.toLowerCase().includes(q) || p.sku.toLowerCase().includes(q)));
      const sorters = {
        name:  (a, b) => a.name.localeCompare(b.name),
        low:   (a, b) => units(a) - units(b),
        high:  (a, b) => units(b) - units(a),
        value: (a, b) => units(b) * b.price - units(a) * a.price,
      };
      return list.sort(sorters[state.sort]);
    }

    /* ---------------------------------------------------------------
       4. Render
    ---------------------------------------------------------------- */
    const categories = ['All', ...new Set(products.map(p => p.category))];
    document.getElementById('category').innerHTML =
      categories.map(c => `<option value="${c}">${c === 'All' ? 'All categories' : c}</option>`).join('');

    function renderSummary() {
      const low = products.filter(p => stockStatus(p) === 'Low stock').length;
      const out = products.filter(p => stockStatus(p) === 'Out of stock').length;
      const totalUnits = products.reduce((s, p) => s + units(p), 0);
      const value = products.reduce((s, p) => s + units(p) * p.price, 0);
      const cards = [
        ['Products',       products.length,               'Active in your catalog'],
        ['Units in stock', totalUnits.toLocaleString(),   `Worth ${money0(value)} at retail`],
        ['Low stock',      low,                           'At or below reorder level'],
        ['Out of stock',   out,                           'Hidden from buyers until restocked'],
      ];
      document.getElementById('summary').innerHTML = cards.map(([label, val, note]) => `
        <div class="rounded-xl border border-neutral-200 bg-white p-5">
          <p class="text-sm text-neutral-500">${label}</p>
          <p class="tabular mt-2 text-3xl font-semibold tracking-tight">${val}</p>
          <p class="mt-3 text-xs text-neutral-400">${note}</p>
        </div>`).join('');

      const alert = document.getElementById('alert');
      alert.classList.toggle('hidden', low + out === 0);
      alert.classList.toggle('flex', low + out > 0);
      alert.innerHTML = `
        <p><strong class="font-semibold">${low + out} ${low + out === 1 ? 'product needs' : 'products need'} restocking.</strong>
          <span class="text-neutral-500">${out} out of stock, ${low} running low.</span></p>
        <div class="flex gap-2">
          ${out ? `<button data-jump="Out of stock" class="rounded-md bg-black px-3 py-1.5 text-xs font-medium text-white hover:bg-neutral-800">View out of stock</button>` : ''}
          ${low ? `<button data-jump="Low stock" class="rounded-md border border-neutral-300 px-3 py-1.5 text-xs font-medium hover:border-black">View low stock</button>` : ''}
        </div>`;
    }

    function renderTabs() {
      const tabs = ['All', 'In stock', 'Low stock', 'Out of stock'];
      document.getElementById('status-tabs').innerHTML = tabs.map(t => {
        const count = t === 'All' ? products.length : products.filter(p => stockStatus(p) === t).length;
        const on = state.status === t;
        return `<button data-status="${t}" role="tab" aria-selected="${on}" class="rounded-lg px-3 py-1.5 ${on ? 'bg-black text-white' : 'text-neutral-600 hover:bg-neutral-100 hover:text-black'}">
          ${t} <span class="tabular ml-1 text-xs text-neutral-400">${count}</span></button>`;
      }).join('');
    }

    function render() {
      const rows = getFiltered();
      const pages = Math.max(1, Math.ceil(rows.length / PER_PAGE));
      state.page = Math.min(state.page, pages);
      const start = (state.page - 1) * PER_PAGE;
      const pageRows = rows.slice(start, start + PER_PAGE);

      renderSummary();
      renderTabs();

      document.getElementById('body').innerHTML = pageRows.map(p => {
        const u = units(p), s = stockStatus(p);
        const pct = Math.min(100, Math.round((u / (p.reorder * 3)) * 100));
        return `
        <tr data-sku="${p.sku}" class="cursor-pointer hover:bg-neutral-50">
          <td class="px-6 py-3.5">
            <div class="flex items-center gap-3">
              <div class="grid h-10 w-10 shrink-0 place-items-center rounded-lg bg-neutral-100 font-serif text-base text-neutral-600">${initials(p.name)}</div>
              <div class="min-w-0">
                <p class="truncate font-medium">${esc(p.name)}</p>
                <p class="text-xs text-neutral-500">${p.sku}</p>
              </div>
            </div>
          </td>
          <td class="px-3 py-3.5 text-neutral-500">${p.category}</td>
          <td class="px-3 py-3.5">
            <p class="tabular text-sm font-medium">${u} ${u === 1 ? 'unit' : 'units'}</p>
            <div class="mt-1.5 h-1 w-24 rounded-full bg-neutral-100"><div class="h-1 rounded-full bg-black" style="width:${pct}%"></div></div>
          </td>
          <td class="px-3 py-3.5"><span class="inline-block rounded-full px-2.5 py-0.5 text-xs font-medium ${badge[s]}">${s}</span></td>
          <td class="tabular px-3 py-3.5 text-right">${money(p.price)}</td>
          <td class="tabular px-6 py-3.5 text-right font-medium">${money0(u * p.price)}</td>
        </tr>`;
      }).join('');

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
    document.getElementById('alert').addEventListener('click', e => {
      const b = e.target.closest('[data-jump]'); if (!b) return;
      state.status = b.dataset.jump; state.page = 1; render();
      document.getElementById('status-tabs').scrollIntoView({ behavior: 'smooth', block: 'center' });
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
    document.getElementById('body').addEventListener('click', e => {
      const row = e.target.closest('tr[data-sku]'); if (row) openDrawer(row.dataset.sku);
    });

    document.getElementById('export-btn').addEventListener('click', () => {
      const head = ['Product', 'SKU', 'Category', 'Units', 'Reorder level', 'Status', 'Price'];
      const lines = getFiltered().map(p => [p.name, p.sku, p.category, units(p), p.reorder, stockStatus(p), p.price.toFixed(2)]
        .map(v => `"${String(v).replace(/"/g, '""')}"`).join(','));
      const blob = new Blob([[head.join(','), ...lines].join('\n')], { type: 'text/csv' });
      const a = Object.assign(document.createElement('a'), { href: URL.createObjectURL(blob), download: 'inventory.csv' });
      a.click(); URL.revokeObjectURL(a.href);
      toast('Inventory exported');
    });

    /* ---------------------------------------------------------------
       6. Stock drawer (adjust quantities per size + reorder level)
    ---------------------------------------------------------------- */
    const drawer = document.getElementById('drawer');
    const drawerOverlay = document.getElementById('drawer-overlay');
    let openSku = null;

    function drawerHTML(p) {
      const u = units(p), s = stockStatus(p);
      return `
      <div class="flex items-start justify-between border-b border-neutral-200 p-6">
        <div class="flex items-center gap-3">
          <div class="grid h-12 w-12 shrink-0 place-items-center rounded-lg bg-neutral-100 font-serif text-lg text-neutral-600">${initials(p.name)}</div>
          <div>
            <h2 class="text-lg font-semibold leading-tight tracking-tight">${esc(p.name)}</h2>
            <p class="text-xs text-neutral-500">${p.sku} · ${money(p.price)}</p>
          </div>
        </div>
        <button id="drawer-close" class="rounded-md p-1.5 text-neutral-500 hover:bg-neutral-100 hover:text-black" aria-label="Close">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6L6 18"/></svg>
        </button>
      </div>

      <div class="flex-1 space-y-7 overflow-y-auto p-6">
        <div class="flex items-center justify-between rounded-lg bg-neutral-50 px-4 py-3">
          <div>
            <p class="text-xs text-neutral-500">Total in stock</p>
            <p id="d-total" class="tabular text-2xl font-semibold tracking-tight">${u}</p>
          </div>
          <span id="d-status" class="rounded-full px-2.5 py-0.5 text-xs font-medium ${badge[s]}">${s}</span>
        </div>

        <section>
          <h3 class="text-sm font-semibold">Stock by size</h3>
          <ul class="mt-3 divide-y divide-neutral-100">
            ${p.variants.map((v, i) => `
              <li class="flex items-center justify-between py-2.5">
                <span class="text-sm font-medium">${esc(v.size)}</span>
                <div class="flex items-center">
                  <button data-step="-1" data-i="${i}" class="grid h-8 w-8 place-items-center rounded-l-lg border border-neutral-200 text-lg leading-none hover:border-black hover:z-10" aria-label="Decrease ${esc(v.size)}">−</button>
                  <input data-qty="${i}" type="number" min="0" value="${v.qty}" class="tabular h-8 w-14 border-y border-neutral-200 text-center text-sm focus:border-black focus:outline-none" aria-label="Quantity for ${esc(v.size)}" />
                  <button data-step="1" data-i="${i}" class="grid h-8 w-8 place-items-center rounded-r-lg border border-neutral-200 text-lg leading-none hover:border-black hover:z-10" aria-label="Increase ${esc(v.size)}">+</button>
                </div>
              </li>`).join('')}
          </ul>
        </section>

        <section>
          <label for="d-reorder" class="text-sm font-semibold">Reorder level</label>
          <p class="mt-1 text-xs text-neutral-500">Mark this product as low stock when total units fall to this number.</p>
          <input id="d-reorder" type="number" min="0" value="${p.reorder}" class="tabular mt-3 w-28 rounded-lg border border-neutral-200 px-3 py-2 text-sm focus:border-black focus:outline-none" />
        </section>
      </div>

      <div class="flex gap-2 border-t border-neutral-200 p-6">
        <button id="d-discard" class="flex-1 rounded-lg border border-neutral-200 px-4 py-2 text-sm font-medium hover:border-black">Discard</button>
        <button id="d-save" class="flex-1 rounded-lg bg-black px-4 py-2 text-sm font-medium text-white hover:bg-neutral-800">Save changes</button>
      </div>`;
    }

    // Recalculate total + status inside the drawer while editing
    function refreshDrawerLive() {
      const total = [...drawer.querySelectorAll('[data-qty]')].reduce((s, el) => s + (parseInt(el.value, 10) || 0), 0);
      const reorder = parseInt(document.getElementById('d-reorder').value, 10) || 0;
      const s = statusOf(total, reorder);
      document.getElementById('d-total').textContent = total;
      const chip = document.getElementById('d-status');
      chip.textContent = s;
      chip.className = `rounded-full px-2.5 py-0.5 text-xs font-medium ${badge[s]}`;
    }

    function openDrawer(sku) {
      const p = products.find(x => x.sku === sku); if (!p) return;
      openSku = sku;
      drawer.innerHTML = drawerHTML(p);
      drawer.setAttribute('aria-hidden', 'false');
      drawerOverlay.classList.remove('hidden');
      requestAnimationFrame(() => drawer.classList.remove('translate-x-full'));
      document.getElementById('drawer-close').focus();
    }
    function closeDrawer() {
      openSku = null;
      drawer.classList.add('translate-x-full');
      drawer.setAttribute('aria-hidden', 'true');
      drawerOverlay.classList.add('hidden');
    }

    drawer.addEventListener('click', e => {
      if (e.target.closest('#drawer-close') || e.target.closest('#d-discard')) return closeDrawer();

      const step = e.target.closest('[data-step]');
      if (step) {
        const input = drawer.querySelector(`[data-qty="${step.dataset.i}"]`);
        input.value = Math.max(0, (parseInt(input.value, 10) || 0) + +step.dataset.step);
        return refreshDrawerLive();
      }

      if (e.target.closest('#d-save')) {
        const p = products.find(x => x.sku === openSku); if (!p) return;
        drawer.querySelectorAll('[data-qty]').forEach(el => {
          p.variants[+el.dataset.qty].qty = Math.max(0, parseInt(el.value, 10) || 0);
        });
        p.reorder = Math.max(0, parseInt(document.getElementById('d-reorder').value, 10) || 0);
        closeDrawer(); render();
        toast(`${p.name} updated`);
      }
    });
    drawer.addEventListener('input', e => {
      if (e.target.matches('[data-qty], #d-reorder')) refreshDrawerLive();
    });
    drawerOverlay.addEventListener('click', closeDrawer);
    document.addEventListener('keydown', e => { if (e.key === 'Escape' && openSku) closeDrawer(); });

    render();
  </script>
</body>
</html>