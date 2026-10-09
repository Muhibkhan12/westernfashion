<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Customers · thewesternfashion admin</title>

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

<body data-page="customers" class="bg-neutral-50 font-sans text-black antialiased">

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
        <input id="search" type="search" placeholder="Search by name, email or city"
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
          <h1 class="font-serif text-4xl tracking-tight">Customers</h1>
          <p class="mt-1 text-sm text-neutral-500">See who's buying, how often, and who your best customers are.</p>
        </div>
        <div class="flex items-center gap-2">
          <button id="export-btn" class="inline-flex items-center gap-2 rounded-lg border border-neutral-200 bg-white px-3.5 py-2 text-sm font-medium hover:border-black">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m7 10 5 5 5-5"/><path d="M12 15V3"/></svg>
            Export CSV
          </button>
        </div>
      </div>

      <!-- Summary -->
      <section id="summary" class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4" aria-label="Customer summary"></section>

      <!-- Table card -->
      <section class="mt-4 rounded-xl border border-neutral-200 bg-white">

        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-neutral-200 p-4 sm:px-6">
          <div id="segment-tabs" class="flex flex-wrap gap-1 text-sm font-medium" role="tablist"></div>
          <select id="sort" class="rounded-lg border border-neutral-200 bg-white px-3 py-2 text-sm focus:border-black focus:outline-none" aria-label="Sort customers">
            <option value="recent">Recently active</option>
            <option value="spent">Top spenders</option>
            <option value="orders">Most orders</option>
            <option value="joined">Newest members</option>
            <option value="name">Name A–Z</option>
          </select>
        </div>

        <div class="overflow-x-auto">
          <table class="w-full min-w-[820px] text-left text-sm">
            <thead>
              <tr class="border-b border-neutral-200 bg-neutral-50 text-xs text-neutral-500">
                <th class="px-6 py-2.5 font-medium">Customer</th>
                <th class="px-3 py-2.5 font-medium">Location</th>
                <th class="px-3 py-2.5 font-medium">Segment</th>
                <th class="px-3 py-2.5 text-right font-medium">Orders</th>
                <th class="px-3 py-2.5 font-medium">Last order</th>
                <th class="px-6 py-2.5 text-right font-medium">Total spent</th>
              </tr>
            </thead>
            <tbody id="body" class="divide-y divide-neutral-100"></tbody>
          </table>
        </div>

        <div id="empty" class="hidden px-6 py-16 text-center">
          <p class="text-sm font-medium">No customers found</p>
          <p class="mt-1 text-sm text-neutral-500">Try a different name, email or city, or clear the filters.</p>
          <button id="reset-filters" class="mt-4 rounded-lg border border-neutral-200 px-3 py-1.5 text-sm font-medium hover:border-black">Clear filters</button>
        </div>

        <div class="flex flex-wrap items-center justify-between gap-3 border-t border-neutral-200 px-4 py-3 text-sm sm:px-6">
          <p id="page-info" class="text-neutral-500"></p>
          <div id="pager" class="flex items-center gap-1"></div>
        </div>
      </section>
    </main>
  </div>

  <!-- Customer drawer -->
  <div id="drawer-overlay" class="fixed inset-0 z-40 hidden bg-black/40"></div>
  <aside id="drawer" class="fixed inset-y-0 right-0 z-50 flex w-full max-w-md translate-x-full flex-col border-l border-neutral-200 bg-white shadow-xl" aria-label="Customer details" aria-hidden="true"></aside>

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
       2. Data from UserController@customers
    ---------------------------------------------------------------- */
    const money  = n => new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD', maximumFractionDigits: 0 }).format(n);
    const money2 = n => new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(n);
    const esc = s => String(s ?? '').replace(/[&<>"']/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));
    const fmtDate = d => d.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
    const initials = n => (n || '?').split(' ').slice(0, 2).map(w => w[0]).join('').toUpperCase();

    const customers = @json($customers).map(c => ({
      ...c,
      id: String(c.id),
      joined: new Date(c.joined),
      last: new Date(c.last),
      recent: c.recent.map(o => ({ ...o, date: new Date(o.date) })),
      note: '',
    }));

    /* ---------------------------------------------------------------
       3. State + helpers
    ---------------------------------------------------------------- */
    const PER_PAGE = 10;
    const state = { segment: 'All', sort: 'recent', q: '', page: 1 };

    const segmentOf = c => c.spent >= 1000 ? 'VIP' : c.joinedAgo <= 30 ? 'New' : 'Returning';
    const segBadge = {
      VIP:       'bg-black text-white',
      New:       'border border-black text-black',
      Returning: 'border border-neutral-200 text-neutral-600',
    };
    const orderStatusStyle = {
      Delivered: 'bg-black text-white', Shipped: 'border border-black text-black',
      Pending: 'bg-neutral-100 text-neutral-700', Cancelled: 'border border-neutral-200 text-neutral-400',
    };
    const statusClass = s => orderStatusStyle[s] ?? orderStatusStyle.Pending;

    function toast(msg) {
      const t = document.getElementById('toast');
      t.textContent = msg;
      t.classList.remove('opacity-0', 'translate-y-2');
      clearTimeout(toast.timer);
      toast.timer = setTimeout(() => t.classList.add('opacity-0', 'translate-y-2'), 2400);
    }

    function getFiltered() {
      const q = state.q.trim().toLowerCase();
      const list = customers.filter(c =>
        (state.segment === 'All' || segmentOf(c) === state.segment) &&
        (!q || c.name.toLowerCase().includes(q) || c.email.includes(q) || c.city.toLowerCase().includes(q)));
      const sorters = {
        recent: (a, b) => a.lastAgo - b.lastAgo,
        spent:  (a, b) => b.spent - a.spent,
        orders: (a, b) => b.orders - a.orders,
        joined: (a, b) => a.joinedAgo - b.joinedAgo,
        name:   (a, b) => a.name.localeCompare(b.name),
      };
      return list.sort(sorters[state.sort]);
    }

    function lastOrderLabel(c) {
      if (c.lastAgo === 0) return 'Today';
      if (c.lastAgo === 1) return 'Yesterday';
      if (c.lastAgo < 14) return `${c.lastAgo} days ago`;
      return fmtDate(c.last);
    }

    /* ---------------------------------------------------------------
       4. Render
    ---------------------------------------------------------------- */
    function renderSummary() {
      const total = customers.length;
      const fresh = customers.filter(c => c.joinedAgo <= 30).length;
      const returning = customers.filter(c => c.orders >= 2).length;
      const ltv = total ? customers.reduce((s, c) => s + c.spent, 0) / total : 0;
      const cards = [
        ['Total customers',     total,                                           'Everyone who has ordered'],
        ['New this month',      fresh,                                           'Joined in the last 30 days'],
        ['Returning rate',      `${total ? Math.round((returning / total) * 100) : 0}%`, 'Placed 2 or more orders'],
        ['Avg. lifetime value', money(ltv),                                      'Total spend per customer'],
      ];
      document.getElementById('summary').innerHTML = cards.map(([label, val, note]) => `
        <div class="rounded-xl border border-neutral-200 bg-white p-5">
          <p class="text-sm text-neutral-500">${label}</p>
          <p class="tabular mt-2 text-3xl font-semibold tracking-tight">${val}</p>
          <p class="mt-3 text-xs text-neutral-400">${note}</p>
        </div>`).join('');
    }

    function renderTabs() {
      const tabs = ['All', 'New', 'Returning', 'VIP'];
      document.getElementById('segment-tabs').innerHTML = tabs.map(t => {
        const count = t === 'All' ? customers.length : customers.filter(c => segmentOf(c) === t).length;
        const on = state.segment === t;
        return `<button data-segment="${t}" role="tab" aria-selected="${on}" class="rounded-lg px-3 py-1.5 ${on ? 'bg-black text-white' : 'text-neutral-600 hover:bg-neutral-100 hover:text-black'}">
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

      document.getElementById('body').innerHTML = pageRows.map(c => {
        const seg = segmentOf(c);
        return `
        <tr data-id="${esc(c.id)}" class="cursor-pointer hover:bg-neutral-50">
          <td class="px-6 py-3.5">
            <div class="flex items-center gap-3">
              <div class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-neutral-100 text-xs font-semibold text-neutral-700">${esc(initials(c.name))}</div>
              <div class="min-w-0">
                <p class="truncate font-medium">${esc(c.name)}</p>
                <p class="truncate text-xs text-neutral-500">${esc(c.email)}</p>
              </div>
            </div>
          </td>
          <td class="px-3 py-3.5 text-neutral-500">${esc(c.city)}</td>
          <td class="px-3 py-3.5"><span class="inline-block rounded-full px-2.5 py-0.5 text-xs font-medium ${segBadge[seg]}">${seg}</span></td>
          <td class="tabular px-3 py-3.5 text-right">${c.orders}</td>
          <td class="px-3 py-3.5 text-neutral-500">${lastOrderLabel(c)}</td>
          <td class="tabular px-6 py-3.5 text-right font-medium">${money(c.spent)}</td>
        </tr>`;
      }).join('');

      document.getElementById('empty').classList.toggle('hidden', rows.length > 0);

      document.getElementById('page-info').textContent = rows.length
        ? `Showing ${start + 1}–${Math.min(start + PER_PAGE, rows.length)} of ${rows.length} customers`
        : '0 customers';
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
    document.getElementById('segment-tabs').addEventListener('click', e => {
      const b = e.target.closest('[data-segment]'); if (!b) return;
      state.segment = b.dataset.segment; state.page = 1; render();
    });
    document.getElementById('sort').addEventListener('change', e => { state.sort = e.target.value; state.page = 1; render(); });
    document.getElementById('search').addEventListener('input', e => { state.q = e.target.value; state.page = 1; render(); });
    document.getElementById('reset-filters').addEventListener('click', () => {
      Object.assign(state, { segment: 'All', q: '', page: 1 });
      document.getElementById('search').value = '';
      render();
    });
    document.getElementById('pager').addEventListener('click', e => {
      const b = e.target.closest('[data-page]'); if (!b || b.disabled) return;
      state.page = +b.dataset.page; render();
    });
    document.getElementById('body').addEventListener('click', e => {
      const row = e.target.closest('tr[data-id]'); if (row) openDrawer(row.dataset.id);
    });

    document.getElementById('export-btn').addEventListener('click', () => {
      const head = ['Name', 'Email', 'Phone', 'Location', 'Segment', 'Orders', 'Total spent', 'Last order', 'Customer since'];
      const lines = getFiltered().map(c => [c.name, c.email, c.phone, c.city, segmentOf(c), c.orders, c.spent.toFixed(2), fmtDate(c.last), fmtDate(c.joined)]
        .map(v => `"${String(v).replace(/"/g, '""')}"`).join(','));
      const blob = new Blob([[head.join(','), ...lines].join('\n')], { type: 'text/csv' });
      const a = Object.assign(document.createElement('a'), { href: URL.createObjectURL(blob), download: 'customers.csv' });
      a.click(); URL.revokeObjectURL(a.href);
      toast('Customers exported');
    });

    /* ---------------------------------------------------------------
       6. Customer drawer
    ---------------------------------------------------------------- */
    const drawer = document.getElementById('drawer');
    const drawerOverlay = document.getElementById('drawer-overlay');
    let openId = null;

    function drawerHTML(c) {
      const seg = segmentOf(c);
      const avg = c.orders ? c.spent / c.orders : 0;
      return `
      <div class="flex items-start justify-between border-b border-neutral-200 p-6">
        <div class="flex items-center gap-4">
          <div class="grid h-14 w-14 shrink-0 place-items-center rounded-full bg-black text-lg font-semibold text-white">${esc(initials(c.name))}</div>
          <div>
            <h2 class="text-xl font-semibold leading-tight tracking-tight">${esc(c.name)}</h2>
            <p class="text-sm text-neutral-500">${esc(c.email)}</p>
            <span class="mt-2 inline-block rounded-full px-2.5 py-0.5 text-xs font-medium ${segBadge[seg]}">${seg}</span>
          </div>
        </div>
        <button id="drawer-close" class="rounded-md p-1.5 text-neutral-500 hover:bg-neutral-100 hover:text-black" aria-label="Close customer details">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6L6 18"/></svg>
        </button>
      </div>

      <div class="flex-1 space-y-7 overflow-y-auto p-6">
        <div class="grid grid-cols-3 divide-x divide-neutral-200 rounded-lg border border-neutral-200 text-center">
          <div class="p-3"><p class="tabular text-lg font-semibold">${c.orders}</p><p class="text-xs text-neutral-500">Orders</p></div>
          <div class="p-3"><p class="tabular text-lg font-semibold">${money(c.spent)}</p><p class="text-xs text-neutral-500">Total spent</p></div>
          <div class="p-3"><p class="tabular text-lg font-semibold">${money(avg)}</p><p class="text-xs text-neutral-500">Avg. order</p></div>
        </div>

        <section>
          <h3 class="text-sm font-semibold">Contact</h3>
          <dl class="mt-3 space-y-2 text-sm">
            <div class="flex justify-between gap-4"><dt class="text-neutral-500">Phone</dt><dd class="tabular">${esc(c.phone)}</dd></div>
            <div class="flex justify-between gap-4"><dt class="text-neutral-500">Location</dt><dd>${esc(c.city)}</dd></div>
            <div class="flex justify-between gap-4"><dt class="text-neutral-500">Customer since</dt><dd>${fmtDate(c.joined)}</dd></div>
          </dl>
        </section>

        <section>
          <h3 class="text-sm font-semibold">Recent orders</h3>
          <ul class="mt-3 divide-y divide-neutral-100">
            ${c.recent.map(o => `
              <li class="flex items-center justify-between gap-3 py-3 text-sm">
                <div>
                  <p class="font-medium">#${esc(o.id)}</p>
                  <p class="text-xs text-neutral-500">${fmtDate(o.date)}</p>
                </div>
                <div class="flex items-center gap-3">
                  <span class="rounded-full px-2 py-0.5 text-xs font-medium ${statusClass(o.status)}">${esc(o.status)}</span>
                  <span class="tabular w-16 text-right font-medium">${money2(o.total)}</span>
                </div>
              </li>`).join('')}
          </ul>
        </section>

        <section>
          <label for="d-note" class="text-sm font-semibold">Private note</label>
          <p class="mt-1 text-xs text-neutral-500">Only your team can see this.</p>
          <textarea id="d-note" rows="3" placeholder="Sizes, preferences, delivery instructions" class="mt-3 w-full resize-none rounded-lg border border-neutral-200 px-3 py-2 text-sm placeholder:text-neutral-400 focus:border-black focus:outline-none">${esc(c.note)}</textarea>
          <button id="d-save-note" class="mt-2 rounded-lg border border-neutral-200 px-3 py-1.5 text-sm font-medium hover:border-black">Save note</button>
        </section>
      </div>

      <div class="border-t border-neutral-200 p-6">
        <a href="mailto:${esc(c.email)}" class="block rounded-lg bg-black px-4 py-2.5 text-center text-sm font-medium text-white hover:bg-neutral-800">Email ${esc(c.name.split(' ')[0])}</a>
      </div>`;
    }

    function openDrawer(id) {
      const c = customers.find(x => x.id === id); if (!c) return;
      openId = id;
      drawer.innerHTML = drawerHTML(c);
      drawer.setAttribute('aria-hidden', 'false');
      drawerOverlay.classList.remove('hidden');
      requestAnimationFrame(() => drawer.classList.remove('translate-x-full'));
      document.getElementById('drawer-close').focus();
    }
    function closeDrawer() {
      openId = null;
      drawer.classList.add('translate-x-full');
      drawer.setAttribute('aria-hidden', 'true');
      drawerOverlay.classList.add('hidden');
    }

    drawer.addEventListener('click', e => {
      if (e.target.closest('#drawer-close')) return closeDrawer();
      if (e.target.closest('#d-save-note')) {
        const c = customers.find(x => x.id === openId); if (!c) return;
        c.note = document.getElementById('d-note').value.trim();
        toast('Note saved');
      }
    });
    drawerOverlay.addEventListener('click', closeDrawer);
    document.addEventListener('keydown', e => { if (e.key === 'Escape' && openId) closeDrawer(); });

    render();
  </script>
</body>
</html>