<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Add product · thewesternfashion admin</title>

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
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
    input[type=number] { -moz-appearance: textfield; }
    @media (prefers-reduced-motion: reduce) { * { transition: none !important; } }
  </style>
</head>

<body data-page="products" class="bg-neutral-50 font-sans text-black antialiased">

  <!-- Sidebar is injected here from sidebar.html -->
  <div id="sidebar-slot"></div>
  <div id="overlay" class="fixed inset-0 z-30 hidden bg-black/40 lg:hidden"></div>

  <div class="lg:pl-64">

    <!-- Top bar -->
    <header class="sticky top-0 z-20 flex h-16 items-center gap-3 border-b border-neutral-200 bg-white/90 px-4 backdrop-blur sm:px-6 lg:px-8">
      <button id="menu-btn" class="rounded-md p-2 text-neutral-600 hover:bg-neutral-100 lg:hidden" aria-label="Open menu">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h10"/></svg>
      </button>
      <nav class="flex items-center gap-1.5 text-sm text-neutral-500">
        <a href="products.html" class="hover:text-black">Products</a>
        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
        <span class="font-medium text-black">Add product</span>
      </nav>
      <div class="ml-auto flex items-center gap-2">
        <button class="relative rounded-md p-2 text-neutral-600 hover:bg-neutral-100" aria-label="Notifications">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 1 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
          <span class="absolute right-2 top-2 h-1.5 w-1.5 rounded-full bg-black"></span>
        </button>
      </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
        @include('admin.sidebar')

      <!-- Heading -->
      <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
          <h1 class="font-serif text-4xl tracking-tight">Add product</h1>
          <p class="mt-1 text-sm text-neutral-500">Fill in the details below, then publish or save as a draft.</p>
        </div>
        <div class="flex items-center gap-2">
          <a href="products.html" class="rounded-lg border border-neutral-200 bg-white px-3.5 py-2 text-sm font-medium hover:border-black">Discard</a>
          <button id="save-draft" class="rounded-lg border border-neutral-200 bg-white px-3.5 py-2 text-sm font-medium hover:border-black">Save as draft</button>
          <button id="publish" class="rounded-lg bg-black px-3.5 py-2 text-sm font-medium text-white hover:bg-neutral-800">Publish product</button>
        </div>
      </div>

      <form id="product-form" class="mt-8 grid gap-6 lg:grid-cols-3" novalidate>

        <!-- Main column -->
        <div class="space-y-6 lg:col-span-2">

          <!-- Basic info -->
          <section class="rounded-xl border border-neutral-200 bg-white p-6">
            <h2 class="text-base font-semibold">Basic information</h2>

            <div class="mt-5">
              <label for="f-name" class="text-sm font-medium">Product name</label>
              <input id="f-name" type="text" placeholder="e.g. Suede Fringe Jacket"
                class="mt-1.5 w-full rounded-lg border border-neutral-200 px-3 py-2.5 text-sm placeholder:text-neutral-400 focus:border-black focus:outline-none" />
              <p id="err-name" class="mt-1.5 hidden text-xs font-medium text-black"></p>
            </div>

            <div class="mt-5">
              <div class="flex items-center justify-between">
                <label for="f-desc" class="text-sm font-medium">Description</label>
                <span id="desc-count" class="text-xs text-neutral-400">0 / 600</span>
              </div>
              <textarea id="f-desc" rows="5" maxlength="600" placeholder="What is it made of, how does it fit, and what makes it worth buying?"
                class="mt-1.5 w-full resize-none rounded-lg border border-neutral-200 px-3 py-2.5 text-sm placeholder:text-neutral-400 focus:border-black focus:outline-none"></textarea>
            </div>
          </section>

          <!-- Media -->
          <section class="rounded-xl border border-neutral-200 bg-white p-6">
            <h2 class="text-base font-semibold">Media</h2>
            <p class="mt-1 text-sm text-neutral-500">The first image is used as the cover photo.</p>

            <div id="dropzone" class="mt-4 cursor-pointer rounded-xl border-2 border-dashed border-neutral-200 px-6 py-10 text-center hover:border-black">
              <svg class="mx-auto h-8 w-8 text-neutral-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m17 8-5-5-5 5"/><path d="M12 3v12"/></svg>
              <p class="mt-3 text-sm font-medium">Click to upload, or drag images here</p>
              <p class="mt-1 text-xs text-neutral-400">PNG or JPG, up to 5 images</p>
              <input id="file-input" type="file" accept="image/png,image/jpeg" multiple class="hidden" />
            </div>

            <div id="media-grid" class="mt-4 grid grid-cols-3 gap-3 sm:grid-cols-4"></div>
          </section>

          <!-- Pricing -->
          <section class="rounded-xl border border-neutral-200 bg-white p-6">
            <h2 class="text-base font-semibold">Pricing</h2>

            <div class="mt-5 grid grid-cols-2 gap-4">
              <div>
                <label for="f-price" class="text-sm font-medium">Price</label>
                <div class="relative mt-1.5">
                  <span class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-sm text-neutral-400">$</span>
                  <input id="f-price" type="number" min="0" step="0.01" placeholder="0.00"
                    class="w-full rounded-lg border border-neutral-200 py-2.5 pl-7 pr-3 text-sm placeholder:text-neutral-400 focus:border-black focus:outline-none" />
                </div>
                <p id="err-price" class="mt-1.5 hidden text-xs font-medium text-black"></p>
              </div>
              <div>
                <label for="f-compare" class="text-sm font-medium">Compare-at price</label>
                <div class="relative mt-1.5">
                  <span class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-sm text-neutral-400">$</span>
                  <input id="f-compare" type="number" min="0" step="0.01" placeholder="Optional"
                    class="w-full rounded-lg border border-neutral-200 py-2.5 pl-7 pr-3 text-sm placeholder:text-neutral-400 focus:border-black focus:outline-none" />
                </div>
                <p id="err-compare" class="mt-1.5 hidden text-xs font-medium text-black"></p>
              </div>
            </div>
            <p id="margin-hint" class="mt-3 hidden text-sm"></p>
          </section>

          <!-- Variants -->
          <section class="rounded-xl border border-neutral-200 bg-white p-6">
            <div class="flex items-center justify-between">
              <div>
                <h2 class="text-base font-semibold">Sizes &amp; stock</h2>
                <p class="mt-1 text-sm text-neutral-500">Add a row for every size you stock, with its starting quantity.</p>
              </div>
              <button type="button" id="add-variant" class="inline-flex items-center gap-1.5 rounded-lg border border-neutral-200 px-3 py-1.5 text-sm font-medium hover:border-black">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
                Add size
              </button>
            </div>

            <div class="mt-4 overflow-x-auto">
              <table class="w-full min-w-[420px] text-left text-sm">
                <thead>
                  <tr class="text-xs text-neutral-500">
                    <th class="py-2 font-medium">Size</th>
                    <th class="py-2 font-medium">Starting stock</th>
                    <th class="w-10 py-2"></th>
                  </tr>
                </thead>
                <tbody id="variant-body" class="divide-y divide-neutral-100"></tbody>
              </table>
            </div>
            <p id="err-variants" class="mt-2 hidden text-xs font-medium text-black"></p>
          </section>
        </div>

        <!-- Side column -->
        <div class="space-y-6">

          <!-- Status -->
          <section class="rounded-xl border border-neutral-200 bg-white p-6">
            <h2 class="text-base font-semibold">Status</h2>
            <div id="f-status" class="mt-3 inline-flex w-full rounded-lg border border-neutral-200 p-0.5 text-sm font-medium" role="radiogroup" aria-label="Status"></div>
            <p id="status-hint" class="mt-3 text-xs text-neutral-500"></p>
          </section>

          <!-- Organization -->
          <section class="rounded-xl border border-neutral-200 bg-white p-6">
            <h2 class="text-base font-semibold">Organization</h2>

            <div class="mt-4">
              <label for="f-category" class="text-sm font-medium">Category</label>
              <select id="f-category" class="mt-1.5 w-full rounded-lg border border-neutral-200 bg-white px-3 py-2.5 text-sm focus:border-black focus:outline-none">
                <option>Outerwear</option>
                <option>Denim</option>
                <option>Shirts</option>
                <option>Footwear</option>
                <option>Accessories</option>
              </select>
            </div>

            <div class="mt-4">
              <label for="f-sku" class="text-sm font-medium">SKU</label>
              <input id="f-sku" type="text" placeholder="Leave blank to auto-generate"
                class="mt-1.5 w-full rounded-lg border border-neutral-200 px-3 py-2.5 text-sm placeholder:text-neutral-400 focus:border-black focus:outline-none" />
            </div>

            <div class="mt-4">
              <label for="f-tags" class="text-sm font-medium">Tags</label>
              <input id="f-tags" type="text" placeholder="e.g. new-arrival, leather, sale"
                class="mt-1.5 w-full rounded-lg border border-neutral-200 px-3 py-2.5 text-sm placeholder:text-neutral-400 focus:border-black focus:outline-none" />
              <p class="mt-1.5 text-xs text-neutral-400">Separate tags with a comma.</p>
            </div>
          </section>

          <!-- Live preview -->
          <section class="rounded-xl border border-neutral-200 bg-white p-6">
            <h2 class="text-base font-semibold">Preview</h2>
            <div class="mt-4 overflow-hidden rounded-xl border border-neutral-200">
              <div id="preview-image" class="grid aspect-[4/3] place-items-center bg-neutral-100">
                <span class="font-serif text-4xl text-neutral-300">—</span>
              </div>
              <div class="p-4">
                <p id="preview-name" class="truncate font-medium text-neutral-300">Product name</p>
                <p id="preview-category" class="mt-0.5 text-xs text-neutral-400">Category</p>
                <p id="preview-price" class="tabular mt-3 font-semibold text-neutral-300">$0.00</p>
              </div>
            </div>
          </section>
        </div>
      </form>
    </main>
  </div>

  <!-- Toast -->
  <div id="toast" class="pointer-events-none fixed bottom-6 left-1/2 z-[60] -translate-x-1/2 translate-y-2 rounded-lg bg-black px-4 py-2.5 text-sm font-medium text-white opacity-0 shadow-lg transition-all duration-200"></div>

  <script>
    /* ---------------------------------------------------------------
       1. Sidebar (needs a local server: fetch() fails on file://)
    ---------------------------------------------------------------- */
    const sidebarSlot = document.getElementById('sidebar-slot');
    const overlay = document.getElementById('overlay');

    fetch('sidebar.html')
      .then(r => { if (!r.ok) throw new Error(r.status); return r.text(); })
      .then(html => { sidebarSlot.innerHTML = html; initSidebar(); })
      .catch(() => {
        sidebarSlot.innerHTML =
          '<aside class="fixed inset-y-0 left-0 z-40 hidden w-64 border-r border-neutral-200 bg-white p-6 text-sm text-neutral-600 lg:block">' +
          '<p class="font-medium text-black">Sidebar not loaded</p>' +
          '<p class="mt-2">Open this page through a local server so sidebar.html can be fetched. Try VS Code Live Server or <code>npx serve</code>.</p></aside>';
      });

    function initSidebar() {
      const sidebar = document.getElementById('sidebar');
      const active = sidebar.querySelector(`[data-nav="${document.body.dataset.page}"]`);
      if (active) { active.classList.add('is-active'); active.setAttribute('aria-current', 'page'); }
      const open  = () => { sidebar.classList.remove('-translate-x-full'); overlay.classList.remove('hidden'); };
      const close = () => { sidebar.classList.add('-translate-x-full');    overlay.classList.add('hidden'); };
      document.getElementById('menu-btn').addEventListener('click', open);
      document.getElementById('sidebar-close')?.addEventListener('click', close);
      overlay.addEventListener('click', close);
      document.addEventListener('keydown', e => { if (e.key === 'Escape') close(); });
    }

    function toast(msg) {
      const t = document.getElementById('toast');
      t.textContent = msg;
      t.classList.remove('opacity-0', 'translate-y-2');
      clearTimeout(toast.timer);
      toast.timer = setTimeout(() => t.classList.add('opacity-0', 'translate-y-2'), 2400);
    }
    const money = n => new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(n || 0);
    const initials = n => n.trim() ? n.trim().split(/\s+/).slice(0, 2).map(w => w[0].toUpperCase()).join('') : '—';

    /* ---------------------------------------------------------------
       2. Status control
    ---------------------------------------------------------------- */
    let status = 'Draft';
    const statusHints = {
      Active: 'Shoppers can find and buy this product right away.',
      Draft:  'Only your team can see this. Nothing is published yet.',
    };
    function renderStatus() {
      document.getElementById('f-status').innerHTML = ['Draft', 'Active'].map(s => `
        <button type="button" data-set-status="${s}" role="radio" aria-checked="${s === status}"
          class="flex-1 rounded-md px-3.5 py-1.5 ${s === status ? 'bg-black text-white' : 'text-neutral-600 hover:text-black'}">${s}</button>`).join('');
      document.getElementById('status-hint').textContent = statusHints[status];
    }
    document.getElementById('f-status').addEventListener('click', e => {
      const b = e.target.closest('[data-set-status]'); if (!b) return;
      status = b.dataset.setStatus; renderStatus();
    });
    renderStatus();

    /* ---------------------------------------------------------------
       3. Description counter
    ---------------------------------------------------------------- */
    const desc = document.getElementById('f-desc');
    desc.addEventListener('input', () => {
      document.getElementById('desc-count').textContent = `${desc.value.length} / 600`;
    });

    /* ---------------------------------------------------------------
       4. Media upload (drag & drop + click), preview thumbnails
    ---------------------------------------------------------------- */
    const MAX_IMAGES = 5;
    let media = []; // { url, name }

    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('file-input');
    const mediaGrid = document.getElementById('media-grid');

    dropzone.addEventListener('click', () => fileInput.click());
    dropzone.addEventListener('dragover', e => { e.preventDefault(); dropzone.classList.add('border-black'); });
    dropzone.addEventListener('dragleave', () => dropzone.classList.remove('border-black'));
    dropzone.addEventListener('drop', e => {
      e.preventDefault(); dropzone.classList.remove('border-black');
      handleFiles(e.dataTransfer.files);
    });
    fileInput.addEventListener('change', () => handleFiles(fileInput.files));

    function handleFiles(fileList) {
      const files = [...fileList].filter(f => /^image\/(png|jpeg)$/.test(f.type));
      if (!files.length) return;
      const room = MAX_IMAGES - media.length;
      if (room <= 0) return toast(`You can upload up to ${MAX_IMAGES} images`);
      files.slice(0, room).forEach(f => media.push({ url: URL.createObjectURL(f), name: f.name }));
      if (files.length > room) toast(`Only ${room} more image${room === 1 ? '' : 's'} could be added`);
      fileInput.value = '';
      renderMedia();
    }

    function renderMedia() {
      mediaGrid.innerHTML = media.map((m, i) => `
        <div class="group relative aspect-square overflow-hidden rounded-lg border border-neutral-200">
          <img src="${m.url}" alt="" class="h-full w-full object-cover" />
          ${i === 0 ? '<span class="absolute left-1.5 top-1.5 rounded-full bg-black px-1.5 py-0.5 text-[10px] font-medium text-white">Cover</span>' : ''}
          <button type="button" data-remove="${i}" class="absolute right-1.5 top-1.5 grid h-6 w-6 place-items-center rounded-full bg-white/90 text-neutral-600 opacity-0 hover:text-black group-hover:opacity-100" aria-label="Remove image">
            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"><path d="M6 6l12 12M18 6L6 18"/></svg>
          </button>
        </div>`).join('');
      updatePreview();
    }
    mediaGrid.addEventListener('click', e => {
      const b = e.target.closest('[data-remove]'); if (!b) return;
      media.splice(+b.dataset.remove, 1);
      renderMedia();
    });

    /* ---------------------------------------------------------------
       5. Variants (size + starting stock rows)
    ---------------------------------------------------------------- */
    let variants = [{ size: '', stock: '' }, { size: '', stock: '' }];
    const variantBody = document.getElementById('variant-body');

    function renderVariants() {
      variantBody.innerHTML = variants.map((v, i) => `
        <tr>
          <td class="py-2 pr-3">
            <input data-size="${i}" type="text" value="${v.size}" placeholder="e.g. M, 32, One size"
              class="w-full rounded-lg border border-neutral-200 px-3 py-2 text-sm placeholder:text-neutral-400 focus:border-black focus:outline-none" />
          </td>
          <td class="py-2 pr-3">
            <input data-stock="${i}" type="number" min="0" value="${v.stock}" placeholder="0"
              class="tabular w-28 rounded-lg border border-neutral-200 px-3 py-2 text-sm placeholder:text-neutral-400 focus:border-black focus:outline-none" />
          </td>
          <td class="py-2 text-right">
            <button type="button" data-remove-variant="${i}" class="rounded-md p-1.5 text-neutral-400 hover:text-black" aria-label="Remove size" ${variants.length === 1 ? 'disabled' : ''}>
              <svg class="h-4 w-4 ${variants.length === 1 ? 'opacity-30' : ''}" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m3 0-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
            </button>
          </td>
        </tr>`).join('');
    }
    renderVariants();

    document.getElementById('add-variant').addEventListener('click', () => {
      variants.push({ size: '', stock: '' }); renderVariants();
    });
    variantBody.addEventListener('click', e => {
      const b = e.target.closest('[data-remove-variant]'); if (!b || b.disabled) return;
      variants.splice(+b.dataset.removeVariant, 1); renderVariants();
    });
    variantBody.addEventListener('input', e => {
      if (e.target.dataset.size !== undefined) variants[+e.target.dataset.size].size = e.target.value;
      if (e.target.dataset.stock !== undefined) variants[+e.target.dataset.stock].stock = e.target.value;
    });

    /* ---------------------------------------------------------------
       6. Pricing: margin hint + live preview
    ---------------------------------------------------------------- */
    const priceInput = document.getElementById('f-price');
    const compareInput = document.getElementById('f-compare');

    function updateMarginHint() {
      const price = parseFloat(priceInput.value);
      const compare = parseFloat(compareInput.value);
      const hint = document.getElementById('margin-hint');
      if (price > 0 && compare > price) {
        const off = Math.round((1 - price / compare) * 100);
        hint.textContent = `Shown as ${off}% off — was ${money(compare)}, now ${money(price)}.`;
        hint.className = 'mt-3 text-sm text-black';
        hint.classList.remove('hidden');
      } else {
        hint.classList.add('hidden');
      }
    }

    function updatePreview() {
      const name = document.getElementById('f-name').value.trim();
      const category = document.getElementById('f-category').value;
      const price = parseFloat(priceInput.value);
      const compare = parseFloat(compareInput.value);

      document.getElementById('preview-name').textContent = name || 'Product name';
      document.getElementById('preview-name').className = `truncate font-medium ${name ? 'text-black' : 'text-neutral-300'}`;
      document.getElementById('preview-category').textContent = category;
      document.getElementById('preview-price').innerHTML = price > 0
        ? `${money(price)}${compare > price ? ` <span class="ml-1.5 text-xs font-normal text-neutral-400 line-through">${money(compare)}</span>` : ''}`
        : '$0.00';
      document.getElementById('preview-price').className = `tabular mt-3 font-semibold ${price > 0 ? 'text-black' : 'text-neutral-300'}`;

      const img = document.getElementById('preview-image');
      img.innerHTML = media.length
        ? `<img src="${media[0].url}" alt="" class="h-full w-full object-cover" />`
        : `<span class="font-serif text-4xl text-neutral-300">${initials(name)}</span>`;
    }

    [priceInput, compareInput].forEach(el => el.addEventListener('input', () => { updateMarginHint(); updatePreview(); }));
    document.getElementById('f-name').addEventListener('input', updatePreview);
    document.getElementById('f-category').addEventListener('change', updatePreview);

    /* ---------------------------------------------------------------
       7. Validation + fake submit
    ---------------------------------------------------------------- */
    function showError(id, msg) {
      const el = document.getElementById(id);
      el.textContent = msg || '';
      el.classList.toggle('hidden', !msg);
    }

    function validate() {
      let ok = true;
      const name = document.getElementById('f-name').value.trim();
      showError('err-name', !name ? 'Enter a product name.' : ''); if (!name) ok = false;

      const price = parseFloat(priceInput.value);
      showError('err-price', !(price > 0) ? 'Enter a price greater than $0.' : ''); if (!(price > 0)) ok = false;

      const compareRaw = compareInput.value;
      const compare = compareRaw === '' ? null : parseFloat(compareRaw);
      const badCompare = compare !== null && !(compare > price);
      showError('err-compare', badCompare ? 'Must be higher than the price.' : ''); if (badCompare) ok = false;

      const named = variants.filter(v => v.size.trim() !== '');
      const dupes = new Set(named.map(v => v.size.trim().toLowerCase())).size !== named.length;
      showError('err-variants', named.length === 0 ? 'Add at least one size.' : dupes ? 'Size names must be unique.' : '');
      if (named.length === 0 || dupes) ok = false;

      return ok;
    }

    function submitAs(finalStatus) {
      status = finalStatus; renderStatus();
      if (!validate()) return toast('Please fix the highlighted fields');
      // Placeholder for your API call, e.g. fetch('/api/products', { method: 'POST', body: formData })
      toast(finalStatus === 'Active' ? 'Product published' : 'Draft saved');
      setTimeout(() => { window.location.href = 'products.html'; }, 900);
    }

    document.getElementById('publish').addEventListener('click', () => submitAs('Active'));
    document.getElementById('save-draft').addEventListener('click', () => submitAs('Draft'));
    document.getElementById('product-form').addEventListener('submit', e => e.preventDefault());

    updatePreview();
  </script>
</body>
</html>