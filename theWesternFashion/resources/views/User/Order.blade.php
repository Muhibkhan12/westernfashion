{{--
  resources/views/user/orders.blade.php
  thewesternfashion customer account — My Orders

  Expects:
    - resources/views/user/sidebar.blade.php  (included below)
  The order data here is a placeholder array for layout purposes —
  swap the @php block for $orders passed in from your controller.
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My orders · thewesternfashion</title>

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
    </style>
</head>

<body class="bg-neutral-50 font-sans text-black antialiased">

    {{-- Sidebar partial: resources/views/user/sidebar.blade.php --}}
    @include('user.sidebar', ['activeNav' => 'orders', 'activeOrdersCount' => 2])

    <div id="overlay" class="fixed inset-0 z-30 hidden bg-black/40 lg:hidden"></div>

    <div class="lg:pl-64">

        <!-- Top bar -->
        <header class="sticky top-0 z-20 flex h-16 items-center gap-3 border-b border-neutral-200 bg-white/90 px-4 backdrop-blur sm:px-6 lg:px-8">
            <button id="menu-btn" class="rounded-md p-2 text-neutral-600 hover:bg-neutral-100 lg:hidden" aria-label="Open menu">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h10"/></svg>
            </button>

            <div class="relative max-w-sm flex-1">
                <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-neutral-400" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
                <input id="search" type="search" placeholder="Search by order number or item"
                    class="w-full rounded-lg border border-neutral-200 bg-neutral-50 py-2 pl-9 pr-3 text-sm placeholder:text-neutral-400 focus:border-black focus:bg-white focus:outline-none" />
            </div>

            <a href="{{ url('/') }}" class="ml-auto hidden items-center gap-2 rounded-lg bg-black px-3.5 py-2 text-sm font-medium text-white hover:bg-neutral-800 sm:inline-flex">
                Continue shopping
            </a>
        </header>

        <main class="mx-auto max-w-5xl px-4 py-8 sm:px-6 lg:px-8">

            <div>
                <h1 class="font-serif text-4xl tracking-tight">My orders</h1>
                <p class="mt-1 text-sm text-neutral-500">Track packages, view invoices and reorder your favorites.</p>
            </div>

            <!-- Filter tabs -->
            <div id="status-tabs" class="mt-6 flex flex-wrap gap-1 text-sm font-medium" role="tablist"></div>

            <!-- Orders -->
            <div id="orders-list" class="mt-4 space-y-4"></div>

            <div id="empty" class="hidden rounded-xl border border-neutral-200 bg-white px-6 py-16 text-center">
                <p class="text-sm font-medium">No orders found</p>
                <p class="mt-1 text-sm text-neutral-500">Try a different search, or clear the filter.</p>
                <button id="reset-filters" class="mt-4 rounded-lg border border-neutral-200 px-3 py-1.5 text-sm font-medium hover:border-black">Clear filters</button>
            </div>
        </main>
    </div>

    <!-- Toast -->
    <div id="toast" class="pointer-events-none fixed bottom-6 left-1/2 z-[60] -translate-x-1/2 translate-y-2 rounded-lg bg-black px-4 py-2.5 text-sm font-medium text-white opacity-0 shadow-lg transition-all duration-200"></div>

    <script>
        /* ---------------------------------------------------------------
        ---------------------------------------------------------------- */
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const open  = () => { sidebar.classList.remove('-translate-x-full'); overlay.classList.remove('hidden'); };
        const close = () => { sidebar.classList.add('-translate-x-full');    overlay.classList.add('hidden'); };
        document.getElementById('menu-btn').addEventListener('click', open);
        document.getElementById('sidebar-close')?.addEventListener('click', close);
        overlay.addEventListener('click', close);
        document.addEventListener('keydown', e => { if (e.key === 'Escape') close(); });

        function toast(msg) {
            const t = document.getElementById('toast');
            t.textContent = msg;
            t.classList.remove('opacity-0', 'translate-y-2');
            clearTimeout(toast.timer);
            toast.timer = setTimeout(() => t.classList.add('opacity-0', 'translate-y-2'), 2400);
        }

        /* ---------------------------------------------------------------
           Placeholder order data — replace with data passed from your
           controller (e.g. render each order server-side with a loop
           instead of this script, once you're pulling from the database)
        ---------------------------------------------------------------- */
        const money = n => new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(n);
        const initials = n => n.split(' ').slice(0, 2).map(w => w[0]).join('');

        const orders = [
            { id: 'TWF-2840', date: 'Sep 21, 2026', status: 'Shipped', total: 129,
              items: [{ name: 'Suede Fringe Jacket', qty: 1, price: 129 }] },
            { id: 'TWF-2779', date: 'Aug 30, 2026', status: 'Delivered', total: 94,
              items: [{ name: 'Concho Leather Belt', qty: 1, price: 38 }, { name: 'Bandana Print Scarf', qty: 2, price: 18 }] },
            { id: 'TWF-2701', date: 'Aug 2, 2026', status: 'Delivered', total: 168,
              items: [{ name: 'Leather Western Boots', qty: 1, price: 168 }] },
            { id: 'TWF-2634', date: 'Jul 11, 2026', status: 'Delivered', total: 58,
              items: [{ name: 'Rancher Denim Shirt', qty: 1, price: 58 }] },
            { id: 'TWF-2588', date: 'Jun 24, 2026', status: 'Cancelled', total: 46,
              items: [{ name: 'Straw Cowboy Hat', qty: 1, price: 46 }] },
            { id: 'TWF-2510', date: 'May 30, 2026', status: 'Processing', total: 210,
              items: [{ name: 'Tooled Leather Boots', qty: 1, price: 210 }] },
        ];

        const statusBadge = {
            Delivered:  'bg-black text-white',
            Shipped:    'border border-black text-black',
            Processing: 'bg-neutral-100 text-neutral-700',
            Cancelled:  'border border-neutral-200 text-neutral-400',
        };

        const state = { status: 'All', q: '' };

        function actionsFor(o) {
            const buttons = [];
            if (o.status === 'Shipped')
                buttons.push(`<button data-action="track" data-id="${o.id}" class="rounded-lg border border-neutral-200 px-3.5 py-2 text-sm font-medium hover:border-black">Track package</button>`);
            if (o.status === 'Delivered')
                buttons.push(`<button data-action="review" data-id="${o.id}" class="rounded-lg border border-neutral-200 px-3.5 py-2 text-sm font-medium hover:border-black">Leave a review</button>`);
            if (o.status !== 'Cancelled')
                buttons.push(`<button data-action="reorder" data-id="${o.id}" class="rounded-lg border border-neutral-200 px-3.5 py-2 text-sm font-medium hover:border-black">Buy again</button>`);
            buttons.push(`<button data-action="invoice" data-id="${o.id}" class="rounded-lg bg-black px-3.5 py-2 text-sm font-medium text-white hover:bg-neutral-800">View invoice</button>`);
            return buttons.join('');
        }

        function orderCard(o) {
            const itemCount = o.items.reduce((s, it) => s + it.qty, 0);
            return `
            <article class="rounded-xl border border-neutral-200 bg-white">
                <div class="flex flex-wrap items-center justify-between gap-3 border-b border-neutral-100 px-5 py-4 sm:px-6">
                    <div class="flex flex-wrap items-center gap-x-6 gap-y-1 text-sm">
                        <div><p class="text-xs text-neutral-500">Order</p><p class="font-medium">#${o.id}</p></div>
                        <div><p class="text-xs text-neutral-500">Placed</p><p class="font-medium">${o.date}</p></div>
                        <div><p class="text-xs text-neutral-500">Total</p><p class="tabular font-medium">${money(o.total)}</p></div>
                    </div>
                    <span class="rounded-full px-2.5 py-0.5 text-xs font-medium ${statusBadge[o.status]}">${o.status}</span>
                </div>

                <div class="divide-y divide-neutral-100 px-5 sm:px-6">
                    ${o.items.map(it => `
                        <div class="flex items-center gap-3 py-3">
                            <div class="grid h-12 w-12 shrink-0 place-items-center rounded-lg bg-neutral-100 font-serif text-base text-neutral-400">${initials(it.name)}</div>
                            <div class="min-w-0 flex-1">
                                <p class="truncate text-sm font-medium">${it.name}</p>
                                <p class="text-xs text-neutral-500">Qty ${it.qty}</p>
                            </div>
                            <p class="tabular text-sm font-medium">${money(it.price * it.qty)}</p>
                        </div>`).join('')}
                </div>

                <div class="flex flex-wrap items-center justify-between gap-2 px-5 py-4 sm:px-6">
                    <p class="text-xs text-neutral-500">${itemCount} ${itemCount === 1 ? 'item' : 'items'}</p>
                    <div class="flex flex-wrap gap-2">${actionsFor(o)}</div>
                </div>
            </article>`;
        }

        function getFiltered() {
            const q = state.q.trim().toLowerCase();
            return orders.filter(o =>
                (state.status === 'All' || o.status === state.status) &&
                (!q || o.id.toLowerCase().includes(q) || o.items.some(it => it.name.toLowerCase().includes(q))));
        }

        function renderTabs() {
            const tabs = ['All', 'Processing', 'Shipped', 'Delivered', 'Cancelled'];
            document.getElementById('status-tabs').innerHTML = tabs.map(t => {
                const count = t === 'All' ? orders.length : orders.filter(o => o.status === t).length;
                const on = state.status === t;
                return `<button data-status="${t}" role="tab" aria-selected="${on}" class="rounded-lg px-3 py-1.5 ${on ? 'bg-black text-white' : 'text-neutral-600 hover:bg-neutral-100 hover:text-black'}">
                    ${t} <span class="tabular ml-1 text-xs text-neutral-400">${count}</span></button>`;
            }).join('');
        }

        function render() {
            renderTabs();
            const rows = getFiltered();
            document.getElementById('orders-list').innerHTML = rows.map(orderCard).join('');
            document.getElementById('orders-list').classList.toggle('hidden', rows.length === 0);
            document.getElementById('empty').classList.toggle('hidden', rows.length > 0);
        }

        document.getElementById('status-tabs').addEventListener('click', e => {
            const b = e.target.closest('[data-status]'); if (!b) return;
            state.status = b.dataset.status; render();
        });
        document.getElementById('search').addEventListener('input', e => { state.q = e.target.value; render(); });
        document.getElementById('reset-filters').addEventListener('click', () => {
            state.status = 'All'; state.q = ''; document.getElementById('search').value = ''; render();
        });
        document.getElementById('orders-list').addEventListener('click', e => {
            const b = e.target.closest('[data-action]'); if (!b) return;
            const labels = { track: 'Opening tracking for', review: 'Opening review form for', reorder: 'Added items from', invoice: 'Opening invoice for' };
            toast(`${labels[b.dataset.action]} #${b.dataset.id}`);
        });

        render();
    </script>
</body>
</html>