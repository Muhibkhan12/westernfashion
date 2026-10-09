<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Orders · thewesternfashion admin</title>

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
    @media (prefers-reduced-motion: reduce) { * { transition: none !important; } }
  </style>
</head>

<body data-page="orders" class="bg-neutral-50 font-sans text-black antialiased">

  @include('Admin.sidebar')

  <div id="overlay" class="fixed inset-0 z-30 hidden bg-black/40 lg:hidden"></div>

  <div class="lg:pl-64">

    <!-- Top bar -->
    <header class="sticky top-0 z-20 flex h-16 items-center gap-3 border-b border-neutral-200 bg-white/90 px-4 backdrop-blur sm:px-6 lg:px-8">
      <button id="menu-btn" class="rounded-md p-2 text-neutral-600 hover:bg-neutral-100 lg:hidden" aria-label="Open menu">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h10"/></svg>
      </button>

      <div class="relative max-w-md flex-1">
        <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-neutral-400" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
        <input id="search" type="search" placeholder="Search by order number, customer or email"
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
          <h1 class="font-serif text-4xl tracking-tight">Orders</h1>
          <p class="mt-1 text-sm text-neutral-500">Review, fulfil and track every order in your store.</p>
        </div>
        <div class="flex items-center gap-2">
          <button id="export-btn" class="inline-flex items-center gap-2 rounded-lg border border-neutral-200 bg-white px-3.5 py-2 text-sm font-medium hover:border-black">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m7 10 5 5 5-5"/><path d="M12 15V3"/></svg>
            Export CSV
          </button>
        </div>
      </div>

      <!-- Summary -->
      <section id="summary" class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4" aria-label="Order summary"></section>

      <!-- Table card -->
      <section class="mt-4 rounded-xl border border-neutral-200 bg-white">

        <!-- Toolbar -->
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-neutral-200 p-4 sm:px-6">
          <div id="status-tabs" class="flex flex-wrap gap-1 text-sm font-medium" role="tablist"></div>
          <div class="flex items-center gap-2">
            <select id="payment" class="rounded-lg border border-neutral-200 bg-white px-3 py-2 text-sm focus:border-black focus:outline-none" aria-label="Payment status">
              <option value="All">All payments</option>
              <option value="Paid">Paid</option>
              <option value="Unpaid">Unpaid</option>
              <option value="Refunded">Refunded</option>
            </select>
            <select id="sort" class="rounded-lg border border-neutral-200 bg-white px-3 py-2 text-sm focus:border-black focus:outline-none" aria-label="Sort orders">
              <option value="new">Newest first</option>
              <option value="old">Oldest first</option>
              <option value="high">Highest total</option>
              <option value="low">Lowest total</option>
            </select>
          </div>
        </div>

        <!-- Bulk actions -->
        <div id="bulk" class="hidden items-center justify-between gap-3 border-b border-neutral-200 bg-neutral-50 px-4 py-2.5 text-sm sm:px-6">
          <span><strong id="bulk-count">0</strong> selected</span>
          <div class="flex items-center gap-2">
            <button id="bulk-ship" class="rounded-md bg-black px-3 py-1.5 text-xs font-medium text-white hover:bg-neutral-800">Mark as shipped</button>
            <button id="bulk-cancel" class="rounded-md border border-neutral-300 bg-white px-3 py-1.5 text-xs font-medium hover:border-black">Cancel orders</button>
            <button id="bulk-clear" class="px-2 py-1.5 text-xs font-medium text-neutral-500 hover:text-black">Clear</button>
          </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
          <table class="w-full min-w-[880px] text-left text-sm">
            <thead>
              <tr class="border-b border-neutral-200 bg-neutral-50 text-xs text-neutral-500">
                <th class="w-12 py-2.5 pl-6"><input id="check-all" type="checkbox" class="h-4 w-4 rounded border-neutral-300 accent-black" aria-label="Select all orders on this page" /></th>
                <th class="px-3 py-2.5 font-medium">Order</th>
                <th class="px-3 py-2.5 font-medium">Customer</th>
                <th class="px-3 py-2.5 font-medium">Date</th>
                <th class="px-3 py-2.5 font-medium">Items</th>
                <th class="px-3 py-2.5 font-medium">Payment</th>
                <th class="px-3 py-2.5 font-medium">Status</th>
                <th class="px-6 py-2.5 text-right font-medium">Total</th>
              </tr>
            </thead>
            <tbody id="orders-body" class="divide-y divide-neutral-100"></tbody>
          </table>
        </div>

        <div id="empty" class="hidden px-6 py-16 text-center">
          <p class="text-sm font-medium">No orders found</p>
          <p class="mt-1 text-sm text-neutral-500">Try a different search, or clear the filters.</p>
          <button id="reset-filters" class="mt-4 rounded-lg border border-neutral-200 px-3 py-1.5 text-sm font-medium hover:border-black">Clear filters</button>
        </div>

        <!-- Pagination -->
        <div class="flex flex-wrap items-center justify-between gap-3 border-t border-neutral-200 px-4 py-3 text-sm sm:px-6">
          <p id="page-info" class="text-neutral-500"></p>
          <div id="pager" class="flex items-center gap-1"></div>
        </div>
      </section>
    </main>
  </div>

  <!-- Order detail drawer -->
  <div id="drawer-overlay" class="fixed inset-0 z-40 hidden bg-black/40"></div>
  <aside id="drawer" class="fixed inset-y-0 right-0 z-50 flex w-full max-w-md translate-x-full flex-col border-l border-neutral-200 bg-white shadow-xl" aria-label="Order details" aria-hidden="true"></aside>

  <!-- Toast -->
  <div id="toast" class="pointer-events-none fixed bottom-6 left-1/2 z-[60] -translate-x-1/2 translate-y-2 rounded-lg bg-black px-4 py-2.5 text-sm font-medium text-white opacity-0 shadow-lg transition-all duration-200"></div>

  <script>
    /* ---------------------------------------------------------------
       1. Sidebar (partial is included via Blade, just wire it up)
    ---------------------------------------------------------------- */
    const overlay = document.getElementById('overlay');

    function initSidebar() {
      const sidebar = document.getElementById('sidebar');
      if (!sidebar) return;
      const page = document.body.dataset.page;
      const active = sidebar.querySelector(`[data-nav="${page}"]`);
      if (active) { active.classList.add('is-active'); active.setAttribute('aria-current', 'page'); }

      const open  = () => { sidebar.classList.remove('-translate-x-full'); overlay.classList.remove('hidden'); };
      const close = () => { sidebar.classList.add('-translate-x-full');    overlay.classList.add('hidden'); };

      document.getElementById('menu-btn').addEventListener('click', open);
      const closeBtn = document.getElementById('sidebar-close');
      if (closeBtn) closeBtn.addEventListener('click', close);
      overlay.addEventListener('click', close);
      document.addEventListener('keydown', e => { if (e.key === 'Escape') close(); });
    }
    initSidebar();

    /* ---------------------------------------------------------------
       2. Data from OrderController@adminIndex
    ---------------------------------------------------------------- */
    const money  = n => new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(n);
    const money0 = n => new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD', maximumFractionDigits: 0 }).format(n);
    const esc = s => String(s ?? '').replace(/[&<>"']/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));
    const fmtDate = d => d.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });

    const orders = @json($orders).map(o => ({ ...o, date: new Date(o.date) }));

    /* ---------------------------------------------------------------
       3. State + helpers
    ---------------------------------------------------------------- */
    const PER_PAGE = 10;
    const state = { status: 'All', payment: 'All', sort: 'new', q: '', page: 1, selected: new Set() };

    const statusBadge = {
      Delivered: 'bg-black text-white',
      Shipped:   'border border-black text-black',
      Pending:   'bg-neutral-100 text-neutral-700',
      Cancelled: 'border border-neutral-200 text-neutral-400',
    };
    const badgeFor = s => statusBadge[s] ?? statusBadge.Pending;
    const payDot = {
      Paid:     '<span class="h-1.5 w-1.5 rounded-full bg-black"></span>',
      Unpaid:   '<span class="h-1.5 w-1.5 rounded-full border border-neutral-400"></span>',
      Refunded: '<span class="h-1.5 w-1.5 rounded-full bg-neutral-300"></span>',
    };
    const dotFor = p => payDot[p] ?? payDot.Unpaid;

    function getFiltered() {
      const q = state.q.trim().toLowerCase();
      const list = orders.filter(o =>
        (state.status === 'All' || o.status === state.status) &&
        (state.payment === 'All' || o.payment === state.payment) &&
        (!q || o.id.toLowerCase().includes(q) || o.customer.toLowerCase().includes(q) || o.email.includes(q)));
      const sorters = {
        new:  (a, b) => b.date - a.date,
        old:  (a, b) => a.date - b.date,
        high: (a, b) => b.total - a.total,
        low:  (a, b) => a.total - b.total,
      };
      return list.sort(sorters[state.sort]);
    }

    function toast(msg) {
      const t = document.getElementById('toast');
      t.textContent = msg;
      t.classList.remove('opacity-0', 'translate-y-2');
      clearTimeout(toast.timer);
      toast.timer = setTimeout(() => t.classList.add('opacity-0', 'translate-y-2'), 2800);
    }

    /* Saves the status on the server. Returns { ok, message } */
    async function saveStatus(order, status) {
  try {
    const res = await fetch(`/admin-orders/${encodeURIComponent(order.key)}/status`, {
      method: 'PATCH',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      },
      body: JSON.stringify({ status: status.toLowerCase() }),
    });
    const data = await res.json().catch(() => ({}));
    if (!res.ok) {
      const reason =
        res.status === 419 ? 'Session expired. Refresh the page.' :
        res.status === 404 ? 'Route or order not found (404).' :
        res.status === 405 ? 'PATCH route is missing (405).' :
        res.status === 403 ? 'Not allowed (403).' :
        data.message || `Server error (${res.status}).`;
      console.error('Status update failed', res.status, data);
      return { ok: false, message: reason };
    }
    order.status = data.status || status;
    if (order.status === 'Cancelled' && order.payment === 'Paid') order.payment = 'Refunded';
    return { ok: true };
  } catch (e) {
    console.error(e);
    return { ok: false, message: 'Network error. Try again.' };
  }
}

    /* ---------------------------------------------------------------
       4. Render: summary, tabs, table, pagination
    ---------------------------------------------------------------- */
    function renderSummary() {
      const live = orders.filter(o => o.status !== 'Cancelled');
      const cards = [
        ['Total orders', orders.length,                                              'All time'],
        ['To fulfil',    orders.filter(o => o.status === 'Pending').length,          'Waiting to be shipped'],
        ['In transit',   orders.filter(o => o.status === 'Shipped').length,          'On the way to customers'],
        ['Revenue',      money0(live.reduce((s, o) => s + o.total, 0)),              'Excludes cancelled orders'],
      ];
      document.getElementById('summary').innerHTML = cards.map(([label, value, note]) => `
        <div class="rounded-xl border border-neutral-200 bg-white p-5">
          <p class="text-sm text-neutral-500">${label}</p>
          <p class="tabular mt-2 text-3xl font-semibold tracking-tight">${value}</p>
          <p class="mt-3 text-xs text-neutral-400">${note}</p>
        </div>`).join('');
    }

    function renderTabs() {
      const tabs = ['All', 'Pending', 'Shipped', 'Delivered', 'Cancelled'];
      document.getElementById('status-tabs').innerHTML = tabs.map(t => {
        const count = t === 'All' ? orders.length : orders.filter(o => o.status === t).length;
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

      document.getElementById('orders-body').innerHTML = pageRows.map(o => {
        const count = o.items.reduce((s, it) => s + it.qty, 0);
        return `
        <tr data-key="${esc(o.key)}" class="cursor-pointer hover:bg-neutral-50">
          <td class="w-12 py-3.5 pl-6"><input type="checkbox" data-check="${esc(o.key)}" class="h-4 w-4 rounded border-neutral-300 accent-black" aria-label="Select ${esc(o.id)}" ${state.selected.has(o.key) ? 'checked' : ''} /></td>
          <td class="px-3 py-3.5 font-medium">#${esc(o.id)}</td>
          <td class="px-3 py-3.5">
            <p class="font-medium">${esc(o.customer)}</p>
            <p class="text-xs text-neutral-500">${esc(o.email)}</p>
          </td>
          <td class="px-3 py-3.5 text-neutral-500">${fmtDate(o.date)}</td>
          <td class="px-3 py-3.5 text-neutral-500">${count} ${count === 1 ? 'item' : 'items'}</td>
          <td class="px-3 py-3.5"><span class="inline-flex items-center gap-2 text-neutral-700">${dotFor(o.payment)}${esc(o.payment)}</span></td>
          <td class="px-3 py-3.5"><span class="inline-block rounded-full px-2.5 py-0.5 text-xs font-medium ${badgeFor(o.status)}">${esc(o.status)}</span></td>
          <td class="tabular px-6 py-3.5 text-right font-medium">${money(o.total)}</td>
        </tr>`;
      }).join('');

      document.getElementById('empty').classList.toggle('hidden', rows.length > 0);

      const allChecked = pageRows.length > 0 && pageRows.every(o => state.selected.has(o.key));
      document.getElementById('check-all').checked = allChecked;

      const bulk = document.getElementById('bulk');
      bulk.classList.toggle('hidden', state.selected.size === 0);
      bulk.classList.toggle('flex', state.selected.size > 0);
      document.getElementById('bulk-count').textContent = state.selected.size;

      document.getElementById('page-info').textContent = rows.length
        ? `Showing ${start + 1}–${Math.min(start + PER_PAGE, rows.length)} of ${rows.length} orders`
        : '0 orders';
      const btn = (label, page, disabled, on) =>
        `<button data-page="${page}" ${disabled ? 'disabled' : ''} class="tabular min-w-[2rem] rounded-md px-2.5 py-1.5 text-sm font-medium ${on ? 'bg-black text-white' : 'text-neutral-600 hover:bg-neutral-100'} disabled:cursor-not-allowed disabled:opacity-30 disabled:hover:bg-transparent">${label}</button>`;
      let pager = btn('Prev', state.page - 1, state.page === 1, false);
      for (let p = 1; p <= pages; p++) pager += btn(p, p, false, p === state.page);
      pager += btn('Next', state.page + 1, state.page === pages, false);
      document.getElementById('pager').innerHTML = rows.length && pages > 1 ? pager : '';
    }

    /* ---------------------------------------------------------------
       5. Events: filters, selection, pagination, bulk actions
    ---------------------------------------------------------------- */
    document.getElementById('status-tabs').addEventListener('click', e => {
      const b = e.target.closest('[data-status]'); if (!b) return;
      state.status = b.dataset.status; state.page = 1; render();
    });
    document.getElementById('payment').addEventListener('change', e => { state.payment = e.target.value; state.page = 1; render(); });
    document.getElementById('sort').addEventListener('change', e => { state.sort = e.target.value; state.page = 1; render(); });
    document.getElementById('search').addEventListener('input', e => { state.q = e.target.value; state.page = 1; render(); });
    document.getElementById('reset-filters').addEventListener('click', () => {
      Object.assign(state, { status: 'All', payment: 'All', q: '', page: 1 });
      document.getElementById('payment').value = 'All';
      document.getElementById('search').value = '';
      render();
    });
    document.getElementById('pager').addEventListener('click', e => {
      const b = e.target.closest('[data-page]'); if (!b || b.disabled) return;
      state.page = +b.dataset.page; render();
    });

    document.getElementById('orders-body').addEventListener('click', e => {
      const check = e.target.closest('[data-check]');
      if (check) {
        check.checked ? state.selected.add(check.dataset.check) : state.selected.delete(check.dataset.check);
        render(); return;
      }
      const row = e.target.closest('tr[data-key]');
      if (row) openDrawer(row.dataset.key);
    });

    document.getElementById('check-all').addEventListener('change', e => {
      const rows = getFiltered().slice((state.page - 1) * PER_PAGE, state.page * PER_PAGE);
      rows.forEach(o => e.target.checked ? state.selected.add(o.key) : state.selected.delete(o.key));
      render();
    });

    async function bulkApply(fromStatuses, toStatus, doneWord, blockedMsg) {
      const targets = orders.filter(o => state.selected.has(o.key) && fromStatuses.includes(o.status));
      if (!targets.length) { toast(blockedMsg); return; }
      const results = await Promise.all(targets.map(o => saveStatus(o, toStatus)));
      const n = results.filter(r => r.ok).length;
      const failed = results.length - n;
      state.selected.clear(); render();
      toast(`${n} ${n === 1 ? 'order' : 'orders'} ${doneWord}` + (failed ? `, ${failed} failed` : ''));
    }

    document.getElementById('bulk-clear').addEventListener('click', () => { state.selected.clear(); render(); });
    document.getElementById('bulk-ship').addEventListener('click', () =>
      bulkApply(['Pending'], 'Shipped', 'marked as shipped', 'Only pending orders can be marked as shipped'));
    document.getElementById('bulk-cancel').addEventListener('click', () =>
      bulkApply(['Pending', 'Shipped'], 'Cancelled', 'cancelled', 'Delivered orders can\'t be cancelled'));

    /* Export the currently filtered list as CSV */
    document.getElementById('export-btn').addEventListener('click', () => {
      const head = ['Order', 'Customer', 'Email', 'Date', 'Items', 'Payment', 'Status', 'Total'];
      const lines = getFiltered().map(o => [
        o.id, o.customer, o.email, fmtDate(o.date),
        o.items.reduce((s, it) => s + it.qty, 0), o.payment, o.status, o.total.toFixed(2),
      ].map(v => `"${String(v).replace(/"/g, '""')}"`).join(','));
      const blob = new Blob([[head.join(','), ...lines].join('\n')], { type: 'text/csv' });
      const a = Object.assign(document.createElement('a'), { href: URL.createObjectURL(blob), download: 'orders.csv' });
      a.click(); URL.revokeObjectURL(a.href);
      toast('Orders exported');
    });

    /* ---------------------------------------------------------------
       6. Order detail drawer
    ---------------------------------------------------------------- */
    const drawer = document.getElementById('drawer');
    const drawerOverlay = document.getElementById('drawer-overlay');
    let openKey = null;

    function timeline(o) {
      const steps = [
        ['Order placed', true],
        ['Payment received', o.payment === 'Paid' || o.payment === 'Refunded'],
        ['Shipped', o.status === 'Shipped' || o.status === 'Delivered'],
        ['Delivered', o.status === 'Delivered'],
      ];
      if (o.status === 'Cancelled') steps.splice(2, 2, ['Cancelled', true]);
      return steps.map(([label, done], i) => `
        <li class="relative pl-7 ${i < steps.length - 1 ? 'pb-4' : ''}">
          ${i < steps.length - 1 ? '<span class="absolute left-[5px] top-3 h-full w-px bg-neutral-200"></span>' : ''}
          <span class="absolute left-0 top-1 h-[11px] w-[11px] rounded-full ${done ? 'bg-black' : 'border border-neutral-300 bg-white'}"></span>
          <p class="text-sm ${done ? 'font-medium text-black' : 'text-neutral-400'}">${label}</p>
        </li>`).join('');
    }

    function drawerHTML(o) {
      const locked = o.status === 'Cancelled';
      return `
      <div class="flex items-start justify-between border-b border-neutral-200 p-6">
        <div>
          <p class="text-xs text-neutral-500">${fmtDate(o.date)}</p>
          <h2 class="mt-0.5 text-xl font-semibold tracking-tight">#${esc(o.id)}</h2>
          <span class="mt-2 inline-block rounded-full px-2.5 py-0.5 text-xs font-medium ${badgeFor(o.status)}">${esc(o.status)}</span>
        </div>
        <button id="drawer-close" class="rounded-md p-1.5 text-neutral-500 hover:bg-neutral-100 hover:text-black" aria-label="Close order details">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6L6 18"/></svg>
        </button>
      </div>

      <div class="flex-1 space-y-7 overflow-y-auto p-6">
        <section>
          <h3 class="text-sm font-semibold">Items</h3>
          <ul class="mt-3 divide-y divide-neutral-100">
            ${o.items.map(it => `
              <li class="flex items-center justify-between gap-3 py-3 text-sm">
                <div class="min-w-0">
                  <p class="truncate font-medium">${esc(it.title)}</p>
                  <p class="text-xs text-neutral-500">Qty ${it.qty} × ${money(it.price)}</p>
                </div>
                <p class="tabular font-medium">${money(it.price * it.qty)}</p>
              </li>`).join('')}
          </ul>
          <dl class="tabular mt-2 space-y-1.5 border-t border-neutral-200 pt-3 text-sm">
            <div class="flex justify-between text-neutral-500"><dt>Subtotal</dt><dd>${money(o.subtotal)}</dd></div>
            <div class="flex justify-between text-neutral-500"><dt>Shipping</dt><dd>${o.shipping ? money(o.shipping) : 'Free'}</dd></div>
            <div class="flex justify-between pt-1 font-semibold"><dt>Total</dt><dd>${money(o.total)}</dd></div>
          </dl>
        </section>

        <section class="grid grid-cols-2 gap-6 text-sm">
          <div>
            <h3 class="font-semibold">Customer</h3>
            <p class="mt-2">${esc(o.customer)}</p>
            <p class="text-neutral-500">${esc(o.email)}</p>
          </div>
          <div>
            <h3 class="font-semibold">Ship to</h3>
            <p class="mt-2">${esc(o.customer)}</p>
            <p class="text-neutral-500">${esc(o.city)}</p>
          </div>
          <div class="col-span-2">
            <h3 class="font-semibold">Payment</h3>
            <p class="mt-2 flex items-center gap-2">${dotFor(o.payment)}${esc(o.payment)} <span class="text-neutral-400">·</span> <span class="text-neutral-500">${esc(o.method)}</span></p>
          </div>
        </section>

        <section>
          <h3 class="text-sm font-semibold">Progress</h3>
          <ol class="mt-3">${timeline(o)}</ol>
        </section>
      </div>

      <div class="border-t border-neutral-200 p-6">
        <label for="status-select" class="text-sm font-medium">Order status</label>
        <div class="mt-2 flex gap-2">
          <select id="status-select" ${locked ? 'disabled' : ''} class="flex-1 rounded-lg border border-neutral-200 bg-white px-3 py-2 text-sm focus:border-black focus:outline-none disabled:bg-neutral-50 disabled:text-neutral-400">
            ${['Pending', 'Shipped', 'Delivered', 'Cancelled'].map(s => `<option ${s === o.status ? 'selected' : ''}>${s}</option>`).join('')}
          </select>
          <button id="status-save" ${locked ? 'disabled' : ''} class="rounded-lg bg-black px-4 py-2 text-sm font-medium text-white hover:bg-neutral-800 disabled:cursor-not-allowed disabled:opacity-30">Save changes</button>
        </div>
        ${locked ? '<p class="mt-2 text-xs text-neutral-500">Cancelled orders can\'t be changed.</p>' : ''}
      </div>`;
    }

    function openDrawer(key) {
      const o = orders.find(x => x.key === key); if (!o) return;
      openKey = key;
      drawer.innerHTML = drawerHTML(o);
      drawer.setAttribute('aria-hidden', 'false');
      drawerOverlay.classList.remove('hidden');
      requestAnimationFrame(() => drawer.classList.remove('translate-x-full'));
      document.getElementById('drawer-close').focus();
    }
    function closeDrawer() {
      openKey = null;
      drawer.classList.add('translate-x-full');
      drawer.setAttribute('aria-hidden', 'true');
      drawerOverlay.classList.add('hidden');
    }

    drawer.addEventListener('click', async e => {
      if (e.target.closest('#drawer-close')) return closeDrawer();
      const save = e.target.closest('#status-save');
      if (save) {
        const o = orders.find(x => x.key === openKey); if (!o) return;
        save.disabled = true;
        const r = await saveStatus(o, document.getElementById('status-select').value);
        drawer.innerHTML = drawerHTML(o);
        render();
        toast(r.ok ? `Order #${o.id} updated` : r.message);
      }
    });
    drawerOverlay.addEventListener('click', closeDrawer);
    document.addEventListener('keydown', e => { if (e.key === 'Escape' && openKey) closeDrawer(); });

    render();
  </script>
</body>
</html>