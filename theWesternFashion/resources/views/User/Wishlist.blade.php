<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Wishlist · thewesternfashion</title>

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

<body data-page="wishlist" class="bg-neutral-50 font-sans text-black antialiased">

  @include('User.Sidebar')

  <div id="overlay" class="fixed inset-0 z-30 hidden bg-black/40 lg:hidden"></div>

  <!-- Real logout (POST + CSRF) -->
  <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">@csrf</form>

  <div class="lg:pl-64">

    <!-- Top bar -->
    <header class="sticky top-0 z-20 flex h-16 items-center gap-3 border-b border-neutral-200 bg-white/90 px-4 backdrop-blur sm:px-6 lg:px-8">
      <button id="menu-btn" class="rounded-md p-2 text-neutral-600 hover:bg-neutral-100 lg:hidden" aria-label="Open menu">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h10"/></svg>
      </button>
      <p class="text-sm font-medium">Wishlist</p>
      <div class="ml-auto flex items-center gap-2">
        <a href="{{ route('shop.products') }}" class="hidden items-center gap-2 rounded-lg bg-black px-3.5 py-2 text-sm font-medium text-white hover:bg-neutral-800 sm:inline-flex">
          Continue shopping
        </a>
      </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">

      <!-- Heading -->
      <div>
        <h1 class="font-serif text-4xl tracking-tight">Your wishlist</h1>
        <p id="subhead" class="mt-1 text-sm text-neutral-500"></p>
      </div>

      <!-- Filter + sort -->
      <div class="mt-6 flex flex-wrap items-center justify-between gap-3">
        <div id="view-toggle" class="inline-flex rounded-lg border border-neutral-200 p-0.5 text-sm font-medium">
          <button data-filter="All" class="rounded-md px-3.5 py-1.5">All</button>
          <button data-filter="In stock" class="rounded-md px-3.5 py-1.5">In stock</button>
          <button data-filter="On sale" class="rounded-md px-3.5 py-1.5">On sale</button>
        </div>
        <select id="sort" class="rounded-lg border border-neutral-200 bg-white px-3 py-2 text-sm focus:border-black focus:outline-none" aria-label="Sort wishlist">
          <option value="recent">Recently added</option>
          <option value="low">Price: low to high</option>
          <option value="high">Price: high to low</option>
          <option value="name">Name A–Z</option>
        </select>
      </div>

      <!-- Grid -->
      <div id="grid" class="mt-5 grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"></div>

      <!-- Empty state -->
      <div id="empty" class="mt-5 hidden flex-col items-center rounded-xl border border-neutral-200 bg-white px-6 py-20 text-center">
        <span class="grid h-14 w-14 place-items-center rounded-full bg-neutral-100 text-neutral-300">
          <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8Z"/></svg>
        </span>
        <p class="mt-4 text-sm font-medium">Your wishlist is empty</p>
        <p id="empty-note" class="mt-1 text-sm text-neutral-500">Save items you love by tapping the heart icon while you shop.</p>
        <a href="{{ route('shop.products') }}" class="mt-5 rounded-lg bg-black px-4 py-2 text-sm font-medium text-white hover:bg-neutral-800">Start shopping</a>
      </div>
    </main>
  </div>

  <!-- Toast -->
  <div id="toast" class="pointer-events-none fixed bottom-6 left-1/2 z-[60] -translate-x-1/2 translate-y-2 rounded-lg bg-black px-4 py-2.5 text-sm font-medium text-white opacity-0 shadow-lg transition-all duration-200"></div>

  <script>
    /* ---------------------------------------------------------------
       1. Sidebar + logout
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

    // The sidebar's logout button calls this
    function handleLogout() {
      document.getElementById('logout-form').submit();
    }

    function toast(msg) {
      const t = document.getElementById('toast');
      t.textContent = msg;
      t.classList.remove('opacity-0', 'translate-y-2');
      clearTimeout(toast.timer);
      toast.timer = setTimeout(() => t.classList.add('opacity-0', 'translate-y-2'), 2600);
    }

    /* ---------------------------------------------------------------
       2. Data from WishlistController@index
    ---------------------------------------------------------------- */
    const money = n => new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(n);
    const esc = s => String(s ?? '').replace(/[&<>"']/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));
    const initials = n => String(n || '?').split(' ').slice(0, 2).map(w => w[0]).join('').toUpperCase();

    let wishlist = @json($wishlist);

    /* ---------------------------------------------------------------
       3. State + render
    ---------------------------------------------------------------- */
    const state = { filter: 'All', sort: 'recent' };

    function getFiltered() {
      const list = wishlist.filter(p =>
        state.filter === 'All' ||
        (state.filter === 'In stock' && p.inStock) ||
        (state.filter === 'On sale' && p.compare && p.compare > p.price));
      const sorters = {
        recent: (a, b) => b.added - a.added,
        low:    (a, b) => a.price - b.price,
        high:   (a, b) => b.price - a.price,
        name:   (a, b) => a.name.localeCompare(b.name),
      };
      return list.sort(sorters[state.sort]);
    }

    function card(p) {
      const onSale = p.compare && p.compare > p.price;
      return `
      <article class="group overflow-hidden rounded-xl border border-neutral-200 bg-white">
        <a href="${esc(p.url)}" class="relative grid aspect-[4/3] place-items-center overflow-hidden bg-neutral-100">
          <span class="font-serif text-4xl text-neutral-300">${esc(initials(p.name))}</span>
          ${p.image ? `<img src="${esc(p.image)}" alt="${esc(p.name)}" loading="lazy" onerror="this.remove()" class="absolute inset-0 h-full w-full object-cover" />` : ''}
          <div class="absolute left-3 top-3 flex gap-1.5">
            ${!p.inStock ? '<span class="rounded-full bg-white px-2 py-0.5 text-xs font-medium text-neutral-500">Out of stock</span>' : ''}
            ${onSale ? '<span class="rounded-full bg-black px-2 py-0.5 text-xs font-medium text-white">Sale</span>' : ''}
          </div>
        </a>
        <button data-remove="${esc(p.id)}" class="absolute right-3 top-3 hidden"></button>
        <div class="p-4">
          ${p.category ? `<p class="text-xs text-neutral-400">${esc(p.category)}</p>` : ''}
          <a href="${esc(p.url)}" class="mt-0.5 block truncate font-medium hover:underline">${esc(p.name)}</a>
          <p class="tabular mt-1">
            <span class="font-semibold">${money(p.price)}</span>
            ${onSale ? `<span class="ml-1.5 text-xs text-neutral-400 line-through">${money(p.compare)}</span>` : ''}
          </p>
          <div class="mt-3 flex gap-2">
            ${p.inStock
              ? `<a href="${esc(p.url)}" class="flex-1 rounded-lg bg-black px-3 py-2 text-center text-sm font-medium text-white hover:bg-neutral-800">Choose size</a>`
              : `<span class="flex-1 cursor-not-allowed rounded-lg bg-neutral-100 px-3 py-2 text-center text-sm font-medium text-neutral-400">Sold out</span>`}
            <button data-remove="${esc(p.id)}" class="grid h-9 w-9 shrink-0 place-items-center rounded-lg border border-neutral-200 text-black hover:border-black" aria-label="Remove ${esc(p.name)} from wishlist">
              <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21s-6.7-4.2-9.5-8.2C.6 9.7 1.4 5.9 4.6 4.3c2.3-1.1 5-.4 6.4 1.6l1 1.4 1-1.4c1.4-2 4.1-2.7 6.4-1.6 3.2 1.6 4 5.4 2.1 8.5C18.7 16.8 12 21 12 21Z"/></svg>
            </button>
          </div>
        </div>
      </article>`;
    }

    function render() {
      const rows = getFiltered();

      document.getElementById('subhead').textContent =
        `${wishlist.length} ${wishlist.length === 1 ? 'item' : 'items'} saved`;

      document.querySelectorAll('#view-toggle button').forEach(b => {
        const on = b.dataset.filter === state.filter;
        b.className = `rounded-md px-3.5 py-1.5 ${on ? 'bg-black text-white' : 'text-neutral-600 hover:text-black'}`;
      });

      const grid = document.getElementById('grid');
      const empty = document.getElementById('empty');
      const hasAny = wishlist.length > 0;
      const hasRows = rows.length > 0;

      grid.classList.toggle('hidden', !hasRows);
      empty.classList.toggle('hidden', hasRows);
      empty.classList.toggle('flex', !hasRows);
      document.getElementById('empty-note').textContent = hasAny
        ? 'No items match this filter. Try a different one.'
        : 'Save items you love by tapping the heart icon while you shop.';

      grid.innerHTML = rows.map(card).join('');
    }

    /* ---------------------------------------------------------------
       4. Events
    ---------------------------------------------------------------- */
    document.getElementById('view-toggle').addEventListener('click', e => {
      const b = e.target.closest('[data-filter]'); if (!b) return;
      state.filter = b.dataset.filter; render();
    });
    document.getElementById('sort').addEventListener('change', e => { state.sort = e.target.value; render(); });

    // Remove: instant on screen, then saved in the DB. Brought back if the server says no.
    document.getElementById('grid').addEventListener('click', async e => {
      const btn = e.target.closest('button[data-remove]'); if (!btn || !btn.getAttribute('aria-label')) return;
      const id = btn.dataset.remove;
      const p = wishlist.find(x => x.id === id); if (!p) return;

      wishlist = wishlist.filter(x => x.id !== id);
      render();

      try {
        const res = await fetch(@json(route('wishlist.toggle')), {
          method: 'POST',
          credentials: 'same-origin',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          },
          body: JSON.stringify({ product_id: id }),
        });
        if (res.status === 419) throw new Error('Session expired. Refresh the page.');
        if (!res.ok) throw new Error('Could not remove it.');
        const data = await res.json();

        // toggle() adds the product back if it was already gone. Undo that.
        if (data.wished) {
          await fetch(@json(url('/wishlist')) + '/' + encodeURIComponent(id), {
            method: 'DELETE',
            credentials: 'same-origin',
            headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
          });
        }
        toast(`${p.name} removed from wishlist`);
      } catch (err) {
        wishlist.push(p);
        render();
        toast(err.message || 'Could not remove it. Try again.');
      }
    });

    render();
  </script>
</body>
</html>