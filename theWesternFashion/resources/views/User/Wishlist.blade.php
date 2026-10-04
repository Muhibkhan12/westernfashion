<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
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

  <!-- Sidebar is injected here from user-sidebar.html -->
  @include("user.sidebar")
  <div id="sidebar-slot"></div>
  <div id="overlay" class="fixed inset-0 z-30 hidden bg-black/40 lg:hidden"></div>

  <div class="lg:pl-64">

    <!-- Top bar -->
    <header class="sticky top-0 z-20 flex h-16 items-center gap-3 border-b border-neutral-200 bg-white/90 px-4 backdrop-blur sm:px-6 lg:px-8">
      <button id="menu-btn" class="rounded-md p-2 text-neutral-600 hover:bg-neutral-100 lg:hidden" aria-label="Open menu">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h10"/></svg>
      </button>
      <p class="text-sm font-medium">Wishlist</p>
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

      <!-- Heading -->
      <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
          <h1 class="font-serif text-4xl tracking-tight">Your wishlist</h1>
          <p id="subhead" class="mt-1 text-sm text-neutral-500"></p>
        </div>
        <div class="flex items-center gap-2">
          <button id="share-btn" class="inline-flex items-center gap-2 rounded-lg border border-neutral-200 bg-white px-3.5 py-2 text-sm font-medium hover:border-black">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><path d="m8.6 10.5 6.8-3.9M8.6 13.5l6.8 3.9"/></svg>
            Share
          </button>
          <button id="add-all-btn" class="inline-flex items-center gap-2 rounded-lg bg-black px-3.5 py-2 text-sm font-medium text-white hover:bg-neutral-800">
            Add all to cart
          </button>
        </div>
      </div>

      <!-- Sort -->
      <div class="mt-6 flex items-center justify-between">
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
      <div id="empty" class="hidden flex-col items-center rounded-xl border border-neutral-200 bg-white px-6 py-20 text-center">
        <span class="grid h-14 w-14 place-items-center rounded-full bg-neutral-100 text-neutral-300">
          <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8Z"/></svg>
        </span>
        <p class="mt-4 text-sm font-medium">Your wishlist is empty</p>
        <p id="empty-note" class="mt-1 text-sm text-neutral-500">Save items you love by tapping the heart icon while you shop.</p>
        <a href="#" class="mt-5 rounded-lg bg-black px-4 py-2 text-sm font-medium text-white hover:bg-neutral-800">Start shopping</a>
      </div>
    </main>
  </div>

  <!-- Toast -->
  <div id="toast" class="pointer-events-none fixed bottom-6 left-1/2 z-[60] -translate-x-1/2 translate-y-2 rounded-lg bg-black px-4 py-2.5 text-sm font-medium text-white opacity-0 shadow-lg transition-all duration-200"></div>

  <script>
    /* ---------------------------------------------------------------
       1. Load the sidebar partial (needs a local server: fetch() fails
       on file://. Try VS Code Live Server, `npx serve`, or
       `python -m http.server`.)
    ---------------------------------------------------------------- */
    /* ---------------------------------------------------------------
       Logout — clears whatever this front end stored locally and
       sends the browser to the login page.
       IMPORTANT: this does NOT destroy a server-side session. If you
       have a backend, call its logout endpoint here first, e.g.:
         await fetch('/api/logout', { method: 'POST', credentials: 'include' });
       then clear local storage and redirect, same as below.
    ---------------------------------------------------------------- */
    function handleLogout() {
      try { localStorage.clear(); } catch (e) {}
      try { sessionStorage.clear(); } catch (e) {}
      document.cookie.split(';').forEach(c => {
        document.cookie = c.replace(/^ +/, '').replace(/=.*/, '=;expires=' + new Date(0).toUTCString() + ';path=/');
      });
      window.location.href = 'login.blade.php';
    }

    function toast(msg) {
      const t = document.getElementById('toast');
      t.textContent = msg;
      t.classList.remove('opacity-0', 'translate-y-2');
      clearTimeout(toast.timer);
      toast.timer = setTimeout(() => t.classList.add('opacity-0', 'translate-y-2'), 2400);
    }

    /* ---------------------------------------------------------------
       2. Placeholder data — replace with your API
    ---------------------------------------------------------------- */
    const money = n => new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(n);
    const initials = n => n.split(' ').slice(0, 2).map(w => w[0]).join('');

    let wishlist = [
      { id: 1, name: 'Felt Rancher Hat',        price: 72,  compare: null, inStock: true,  addedAgo: 2  },
      { id: 2, name: 'Tooled Leather Boots',     price: 210, compare: null, inStock: false, addedAgo: 5  },
      { id: 3, name: 'Bandana Print Scarf',      price: 18,  compare: null, inStock: true,  addedAgo: 9  },
      { id: 4, name: 'Denim Vest',               price: 64,  compare: 79,  inStock: true,  addedAgo: 14 },
      { id: 5, name: 'Shearling Trucker Jacket', price: 189, compare: null, inStock: true,  addedAgo: 20 },
      { id: 6, name: 'Turquoise Bolo Tie',       price: 32,  compare: 40,  inStock: true,  addedAgo: 27 },
      { id: 7, name: 'Snap Button Western Shirt',price: 52,  compare: null, inStock: false, addedAgo: 33 },
    ];

    /* ---------------------------------------------------------------
       3. State + render
    ---------------------------------------------------------------- */
    const state = { filter: 'All', sort: 'recent' };

    function getFiltered() {
      let list = wishlist.filter(p =>
        state.filter === 'All' ||
        (state.filter === 'In stock' && p.inStock) ||
        (state.filter === 'On sale' && p.compare));
      const sorters = {
        recent: (a, b) => a.addedAgo - b.addedAgo,
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
        <div class="relative grid aspect-[4/3] place-items-center bg-neutral-100">
          <span class="font-serif text-4xl text-neutral-300">${initials(p.name)}</span>
          <div class="absolute left-3 top-3 flex gap-1.5">
            ${!p.inStock ? '<span class="rounded-full bg-white px-2 py-0.5 text-xs font-medium text-neutral-500">Out of stock</span>' : ''}
            ${onSale ? '<span class="rounded-full bg-black px-2 py-0.5 text-xs font-medium text-white">Sale</span>' : ''}
          </div>
          <button data-remove="${p.id}" class="absolute right-3 top-3 grid h-8 w-8 place-items-center rounded-full bg-white/90 text-neutral-500 hover:text-black" aria-label="Remove from wishlist">
            <svg class="h-4 w-4" fill="currentColor" stroke="none" viewBox="0 0 24 24"><path d="M12 21s-6.7-4.2-9.5-8.2C.6 9.7 1.4 5.9 4.6 4.3c2.3-1.1 5-.4 6.4 1.6l1 1.4 1-1.4c1.4-2 4.1-2.7 6.4-1.6 3.2 1.6 4 5.4 2.1 8.5C18.7 16.8 12 21 12 21Z"/></svg>
          </button>
        </div>
        <div class="p-4">
          <p class="truncate font-medium">${p.name}</p>
          <p class="tabular mt-1">
            <span class="font-semibold">${money(p.price)}</span>
            ${onSale ? `<span class="ml-1.5 text-xs text-neutral-400 line-through">${money(p.compare)}</span>` : ''}
          </p>
          <div class="mt-3 flex gap-2">
            <button data-add="${p.id}" ${!p.inStock ? 'disabled' : ''}
              class="flex-1 rounded-lg px-3 py-2 text-sm font-medium ${p.inStock ? 'bg-black text-white hover:bg-neutral-800' : 'cursor-not-allowed bg-neutral-100 text-neutral-400'}">
              ${p.inStock ? 'Add to cart' : 'Notify me'}
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

      const addable = rows.filter(p => p.inStock).length;
      document.getElementById('add-all-btn').textContent =
        addable ? `Add all to cart (${addable})` : 'Add all to cart';
      document.getElementById('add-all-btn').disabled = addable === 0;
      document.getElementById('add-all-btn').classList.toggle('opacity-40', addable === 0);
      document.getElementById('add-all-btn').classList.toggle('cursor-not-allowed', addable === 0);
    }

    /* ---------------------------------------------------------------
       4. Events
    ---------------------------------------------------------------- */
    document.getElementById('view-toggle').addEventListener('click', e => {
      const b = e.target.closest('[data-filter]'); if (!b) return;
      state.filter = b.dataset.filter; render();
    });
    document.getElementById('sort').addEventListener('change', e => { state.sort = e.target.value; render(); });

    document.getElementById('grid').addEventListener('click', e => {
      const add = e.target.closest('[data-add]');
      if (add && !add.disabled) {
        const p = wishlist.find(x => x.id === +add.dataset.add);
        toast(p.inStock ? `${p.name} added to cart` : `We'll email you when ${p.name} is back`);
        return;
      }
      const remove = e.target.closest('[data-remove]');
      if (remove) {
        const p = wishlist.find(x => x.id === +remove.dataset.remove);
        wishlist = wishlist.filter(x => x.id !== p.id);
        render();
        toast(`${p.name} removed from wishlist`);
      }
    });

    document.getElementById('add-all-btn').addEventListener('click', () => {
      const addable = getFiltered().filter(p => p.inStock).length;
      if (addable) toast(`${addable} ${addable === 1 ? 'item' : 'items'} added to cart`);
    });
    document.getElementById('share-btn').addEventListener('click', () => toast('Wishlist link copied'));

    render();
  </script>
</body>
</html>