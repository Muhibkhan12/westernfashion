{{-- resources/views/Admin/addProducts.blade.php --}}
{{-- One page for BOTH "Add product" and "Edit product" --}}
@php
    $product        = $product ?? null;
    $categories     = $categories ?? \App\Models\Category::all();

    $isEdit         = $product !== null;
    $existingImages = $isEdit ? $product->images : collect();
    $coverUrl       = $existingImages->first() ? asset('storage/' . $existingImages->first()->image_path) : null;

    $blankRow = ['sku' => '', 'size' => '', 'color' => '', 'stock' => ''];

    $variantRows = old('variants', $isEdit
        ? $product->variants->map(fn ($v) => [
              'sku' => $v->sku, 'size' => $v->size, 'color' => $v->color, 'stock' => $v->stock,
          ])->values()->all()
        : [$blankRow, $blankRow]);

    $startStatus = old('status', $isEdit ? $product->status : 'draft');

    // Show the prefix that would actually be used if the user doesn't override it
    $defaultSkuPrefix = $isEdit && $product->variants->isNotEmpty()
        ? preg_replace('/-[^-]+$/', '', $product->variants->first()->sku)
        : '';
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>{{ $isEdit ? 'Edit product' : 'Add product' }} · thewesternfashion admin</title>

  <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = { theme: { extend: { fontFamily: {
      sans: ['Manrope', 'ui-sans-serif', 'system-ui', 'sans-serif'],
      serif: ['"Instrument Serif"', 'Georgia', 'serif'],
    } } } };
  </script>
  <style>
    :focus-visible { outline: 2px solid #000; outline-offset: 2px; }
    .tabular { font-variant-numeric: tabular-nums; }
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
    input[type=number] { -moz-appearance: textfield; }
  </style>
</head>

<body data-page="products" class="bg-neutral-50 font-sans text-black antialiased">

  @include('Admin.sidebar')
  <div id="overlay" class="fixed inset-0 z-30 hidden bg-black/40 lg:hidden"></div>

  <div class="lg:pl-64">

    <header class="sticky top-0 z-20 flex h-16 items-center gap-3 border-b border-neutral-200 bg-white/90 px-4 backdrop-blur sm:px-6 lg:px-8">
      <button id="menu-btn" class="rounded-md p-2 text-neutral-600 hover:bg-neutral-100 lg:hidden" aria-label="Open menu">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h10"/></svg>
      </button>
      <nav class="flex items-center gap-1.5 text-sm text-neutral-500">
        <a href="{{ route('products.index') }}" class="hover:text-black">Products</a>
        <span>/</span>
        <span class="font-medium text-black">{{ $isEdit ? 'Edit product' : 'Add product' }}</span>
      </nav>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">

      <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
          <h1 class="font-serif text-4xl tracking-tight">{{ $isEdit ? 'Edit product' : 'Add product' }}</h1>
          <p class="mt-1 text-sm text-neutral-500">
            {{ $isEdit ? 'Update the details below, then save your changes.' : 'Fill in the details below, then publish or save as a draft.' }}
          </p>
        </div>
        <div class="flex items-center gap-2">
          <a href="{{ route('products.index') }}" class="rounded-lg border border-neutral-200 bg-white px-3.5 py-2 text-sm font-medium hover:border-black">Discard</a>

          @if ($isEdit)
            <button type="submit" form="delete-form"
              onclick="return confirm('Delete this product, its images and its sizes?')"
              class="rounded-lg border border-neutral-200 bg-white px-3.5 py-2 text-sm font-medium hover:border-black">Delete</button>
            <button type="button" data-status="keep" class="rounded-lg bg-black px-3.5 py-2 text-sm font-medium text-white hover:bg-neutral-800">Save changes</button>
          @else
            <button type="button" data-status="draft" class="rounded-lg border border-neutral-200 bg-white px-3.5 py-2 text-sm font-medium hover:border-black">Save as draft</button>
            <button type="button" data-status="active" class="rounded-lg bg-black px-3.5 py-2 text-sm font-medium text-white hover:bg-neutral-800">Publish product</button>
          @endif
        </div>
      </div>

      @if ($errors->any())
        <div class="mt-6 rounded-xl border border-black bg-white p-4 text-sm">
          <p class="font-medium">Please fix the following:</p>
          <ul class="mt-2 list-disc space-y-0.5 pl-5 text-neutral-600">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form id="product-form" method="POST"
            action="{{ $isEdit ? route('products.update', $product) : route('products.store') }}"
            enctype="multipart/form-data"
            class="mt-8 grid gap-6 lg:grid-cols-3" novalidate>
        @csrf
        @if ($isEdit)
          @method('PUT')
        @endif

        <input type="hidden" name="status" id="status-input" value="{{ $startStatus }}" />

        <div class="space-y-6 lg:col-span-2">

          <section class="rounded-xl border border-neutral-200 bg-white p-6">
            <h2 class="text-base font-semibold">Basic information</h2>

            <div class="mt-5">
              <label for="f-name" class="text-sm font-medium">Product name</label>
              <input id="f-name" name="name" type="text" placeholder="e.g. Suede Fringe Jacket"
                value="{{ old('name', $product->name ?? '') }}"
                class="mt-1.5 w-full rounded-lg border border-neutral-200 px-3 py-2.5 text-sm placeholder:text-neutral-400 focus:border-black focus:outline-none" />
              <p id="err-name" class="mt-1.5 hidden text-xs font-medium text-black"></p>
            </div>

            <div class="mt-5">
              <div class="flex items-center justify-between">
                <label for="f-desc" class="text-sm font-medium">Description</label>
                <span id="desc-count" class="text-xs text-neutral-400">0 / 600</span>
              </div>
              <textarea id="f-desc" name="description" rows="5" maxlength="600" placeholder="What is it made of, how does it fit, and what makes it worth buying?"
                class="mt-1.5 w-full resize-none rounded-lg border border-neutral-200 px-3 py-2.5 text-sm placeholder:text-neutral-400 focus:border-black focus:outline-none">{{ old('description', $product->description ?? '') }}</textarea>
            </div>
          </section>

          <section class="rounded-xl border border-neutral-200 bg-white p-6">
            <h2 class="text-base font-semibold">Media</h2>
            <p class="mt-1 text-sm text-neutral-500">The first image is used as the cover photo.</p>

            @if ($existingImages->count())
              <div class="mt-4 grid grid-cols-3 gap-3 sm:grid-cols-4">
                @foreach ($existingImages as $image)
                  <div class="group relative aspect-square overflow-hidden rounded-lg border border-neutral-200">
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="" class="h-full w-full object-cover" />
                    @if ($image->is_primary)
                      <span class="absolute left-1.5 top-1.5 rounded-full bg-black px-1.5 py-0.5 text-[10px] font-medium text-white">Cover</span>
                    @endif
                    <button type="submit" form="img-del-{{ $image->id }}"
                      onclick="return confirm('Delete this image?')"
                      class="absolute right-1.5 top-1.5 grid h-6 w-6 place-items-center rounded-full bg-white/90 text-neutral-600 hover:text-black" aria-label="Delete image">
                      <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"><path d="M6 6l12 12M18 6L6 18"/></svg>
                    </button>
                  </div>
                @endforeach
              </div>
              <p class="mt-2 text-xs text-neutral-400">Deleting a saved image takes effect immediately.</p>
            @endif

            <div id="dropzone" class="mt-4 cursor-pointer rounded-xl border-2 border-dashed border-neutral-200 px-6 py-10 text-center hover:border-black">
              <p class="text-sm font-medium">Click to upload, or drag images here</p>
              <p class="mt-1 text-xs text-neutral-400">PNG or JPG, up to 5 images, 2 MB each</p>
              <input id="file-input" name="images[]" type="file" accept="image/png,image/jpeg" multiple class="hidden" />
            </div>

            <div id="media-grid" class="mt-4 grid grid-cols-3 gap-3 sm:grid-cols-4"></div>
          </section>

          <section class="rounded-xl border border-neutral-200 bg-white p-6">
            <h2 class="text-base font-semibold">Pricing</h2>

            <div class="mt-5 grid grid-cols-2 gap-4">
              <div>
                <label for="f-price" class="text-sm font-medium">Price</label>
                <div class="relative mt-1.5">
                  <span class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-sm text-neutral-400">$</span>
                  <input id="f-price" name="price" type="number" min="0" step="0.01" placeholder="0.00"
                    value="{{ old('price', $product->price ?? '') }}"
                    class="w-full rounded-lg border border-neutral-200 py-2.5 pl-7 pr-3 text-sm placeholder:text-neutral-400 focus:border-black focus:outline-none" />
                </div>
                <p id="err-price" class="mt-1.5 hidden text-xs font-medium text-black"></p>
              </div>
              <div>
                <label for="f-sale" class="text-sm font-medium">Sale price</label>
                <div class="relative mt-1.5">
                  <span class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-sm text-neutral-400">$</span>
                  <input id="f-sale" name="sale_price" type="number" min="0" step="0.01" placeholder="Optional"
                    value="{{ old('sale_price', $product->sale_price ?? '') }}"
                    class="w-full rounded-lg border border-neutral-200 py-2.5 pl-7 pr-3 text-sm placeholder:text-neutral-400 focus:border-black focus:outline-none" />
                </div>
                <p id="err-sale" class="mt-1.5 hidden text-xs font-medium text-black"></p>
              </div>
            </div>
            <p id="margin-hint" class="mt-3 hidden text-sm"></p>

            {{-- Reorder level --}}
            <div class="mt-5 border-t border-neutral-100 pt-5">
              <label for="f-reorder" class="text-sm font-medium">Reorder level</label>
              <p class="mt-1 text-xs text-neutral-500">
                Mark this product as low stock when total units drop to this number.
              </p>
              <input id="f-reorder" name="reorder_level" type="number" min="0" step="1"
                value="{{ old('reorder_level', $product->reorder_level ?? 10) }}"
                class="tabular mt-3 w-28 rounded-lg border border-neutral-200 px-3 py-2.5 text-sm focus:border-black focus:outline-none" />
              <p id="err-reorder" class="mt-1.5 hidden text-xs font-medium text-black"></p>
            </div>
          </section>

          <section class="rounded-xl border border-neutral-200 bg-white p-6">
            <div class="flex items-center justify-between">
              <div>
                <h2 class="text-base font-semibold">Sizes &amp; stock</h2>
                <p class="mt-1 text-sm text-neutral-500">Add a row for every size you stock, with its starting quantity.</p>
              </div>
              <button type="button" id="add-variant" class="rounded-lg border border-neutral-200 px-3 py-1.5 text-sm font-medium hover:border-black">+ Add size</button>
            </div>

            <div class="mt-4 overflow-x-auto">
              <table class="w-full min-w-[520px] text-left text-sm">
                <thead>
                  <tr class="text-xs text-neutral-500">
                    <th class="py-2 font-medium">Size</th>
                    <th class="py-2 font-medium">Color <span class="text-neutral-400">(optional)</span></th>
                    <th class="py-2 font-medium">Stock</th>
                    <th class="w-10 py-2"></th>
                  </tr>
                </thead>
                <tbody id="variant-body" class="divide-y divide-neutral-100"></tbody>
              </table>
            </div>
            <p id="err-variants" class="mt-2 hidden text-xs font-medium text-black"></p>
          </section>
        </div>

        <div class="space-y-6">

          <section class="rounded-xl border border-neutral-200 bg-white p-6">
            <h2 class="text-base font-semibold">Status</h2>
            <div id="f-status" class="mt-3 inline-flex w-full rounded-lg border border-neutral-200 p-0.5 text-sm font-medium" role="radiogroup" aria-label="Status"></div>
            <p id="status-hint" class="mt-3 text-xs text-neutral-500"></p>
          </section>

          <section class="rounded-xl border border-neutral-200 bg-white p-6">
            <h2 class="text-base font-semibold">Organization</h2>

            <div class="mt-4">
              <label for="f-category" class="text-sm font-medium">Category</label>
              <select id="f-category" name="category_id" class="mt-1.5 w-full rounded-lg border border-neutral-200 bg-white px-3 py-2.5 text-sm focus:border-black focus:outline-none">
                <option value="">Select a category</option>
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>
                    {{ $category->name }}
                  </option>
                @endforeach
              </select>
              <p id="err-category" class="mt-1.5 hidden text-xs font-medium text-black"></p>
            </div>

            <div class="mt-4">
              <label for="f-sku" class="text-sm font-medium">SKU prefix</label>
              <input id="f-sku" name="sku_prefix" type="text" placeholder="Leave blank to auto-generate"
                value="{{ old('sku_prefix', $defaultSkuPrefix) }}"
                class="mt-1.5 w-full rounded-lg border border-neutral-200 px-3 py-2.5 text-sm placeholder:text-neutral-400 focus:border-black focus:outline-none" />
              <p class="mt-1.5 text-xs text-neutral-400">Each size gets its own SKU, e.g. JACKET-M.</p>
            </div>

            <label class="mt-4 flex items-center gap-2 text-sm font-medium">
              <input type="checkbox" name="featured" value="1" class="h-4 w-4 rounded border-neutral-300 accent-black"
                @checked($errors->any() ? old('featured') : ($product->featured ?? false)) />
              Featured product
            </label>
          </section>

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

      {{-- Hidden forms --}}
      @if ($isEdit)
        <form id="delete-form" method="POST" action="{{ route('products.destroy', $product) }}" class="hidden">
          @csrf
          @method('DELETE')
        </form>

        @foreach ($existingImages as $image)
          <form id="img-del-{{ $image->id }}" method="POST" action="{{ route('product-images.destroy', $image) }}" class="hidden">
            @csrf
            @method('DELETE')
          </form>
        @endforeach
      @endif
    </main>
  </div>

  <div id="toast" class="pointer-events-none fixed bottom-6 left-1/2 z-[60] -translate-x-1/2 translate-y-2 rounded-lg bg-black px-4 py-2.5 text-sm font-medium text-white opacity-0 shadow-lg transition-all duration-200"></div>

  <script>
    const existingCount = @json($existingImages->count());
    const coverUrl      = @json($coverUrl);

    /* Sidebar */
    const overlay = document.getElementById('overlay');
    (function initSidebar() {
      const sidebar = document.getElementById('sidebar');
      if (!sidebar) return;
      const active = sidebar.querySelector(`[data-nav="${document.body.dataset.page}"]`);
      if (active) { active.classList.add('is-active'); active.setAttribute('aria-current', 'page'); }
      const open  = () => { sidebar.classList.remove('-translate-x-full'); overlay.classList.remove('hidden'); };
      const close = () => { sidebar.classList.add('-translate-x-full'); overlay.classList.add('hidden'); };
      document.getElementById('menu-btn').addEventListener('click', open);
      document.getElementById('sidebar-close')?.addEventListener('click', close);
      overlay.addEventListener('click', close);
    })();

    /* Helpers */
    function toast(msg) {
      const t = document.getElementById('toast');
      t.textContent = msg;
      t.classList.remove('opacity-0', 'translate-y-2');
      clearTimeout(toast.timer);
      toast.timer = setTimeout(() => t.classList.add('opacity-0', 'translate-y-2'), 2400);
    }
    const money = n => new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(n || 0);
    const initials = n => n.trim() ? n.trim().split(/\s+/).slice(0, 2).map(w => w[0].toUpperCase()).join('') : '—';
    const esc = s => String(s ?? '').replace(/[&<>"']/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));
    const form = document.getElementById('product-form');

    /* Status */
    const statusInput = document.getElementById('status-input');
    let status = ['draft', 'active'].includes(statusInput.value) ? statusInput.value : 'draft';
    const statusLabels = { draft: 'Draft', active: 'Active' };
    const statusHints = {
      active: 'Shoppers can find and buy this product right away.',
      draft:  'Only your team can see this. Nothing is published yet.',
    };
    function renderStatus() {
      statusInput.value = status;
      document.getElementById('f-status').innerHTML = ['draft', 'active'].map(s => `
        <button type="button" data-set-status="${s}" role="radio" aria-checked="${s === status}"
          class="flex-1 rounded-md px-3.5 py-1.5 ${s === status ? 'bg-black text-white' : 'text-neutral-600 hover:text-black'}">${statusLabels[s]}</button>`).join('');
      document.getElementById('status-hint').textContent = statusHints[status];
    }
    document.getElementById('f-status').addEventListener('click', e => {
      const b = e.target.closest('[data-set-status]'); if (!b) return;
      status = b.dataset.setStatus; renderStatus();
    });

    /* Description counter */
    const desc = document.getElementById('f-desc');
    const updateDescCount = () => { document.getElementById('desc-count').textContent = `${desc.value.length} / 600`; };
    desc.addEventListener('input', updateDescCount);

    /* Media upload */
    const MAX_IMAGES = 5;
    const MAX_SIZE   = 2 * 1024 * 1024;
    let media = [];
    const dt = new DataTransfer();

    const dropzone  = document.getElementById('dropzone');
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
      let files = [...fileList].filter(f => /^image\/(png|jpeg)$/.test(f.type));
      if (files.some(f => f.size > MAX_SIZE)) {
        toast('Images must be 2 MB or smaller');
        files = files.filter(f => f.size <= MAX_SIZE);
      }
      if (!files.length) { fileInput.files = dt.files; return; }

      const room = MAX_IMAGES - existingCount - media.length;
      if (room <= 0) { fileInput.files = dt.files; return toast(`You can have up to ${MAX_IMAGES} images`); }

      files.slice(0, room).forEach(f => {
        dt.items.add(f);
        media.push({ url: URL.createObjectURL(f), name: f.name });
      });
      if (files.length > room) toast(`Only ${room} more image${room === 1 ? '' : 's'} could be added`);

      fileInput.files = dt.files;
      renderMedia();
    }

    function renderMedia() {
      mediaGrid.innerHTML = media.map((m, i) => `
        <div class="group relative aspect-square overflow-hidden rounded-lg border border-neutral-200">
          <img src="${m.url}" alt="" class="h-full w-full object-cover" />
          ${i === 0 && existingCount === 0 ? '<span class="absolute left-1.5 top-1.5 rounded-full bg-black px-1.5 py-0.5 text-[10px] font-medium text-white">Cover</span>' : ''}
          <button type="button" data-remove="${i}" class="absolute right-1.5 top-1.5 grid h-6 w-6 place-items-center rounded-full bg-white/90 text-neutral-600 hover:text-black" aria-label="Remove image">
            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"><path d="M6 6l12 12M18 6L6 18"/></svg>
          </button>
        </div>`).join('');
      updatePreview();
    }
    mediaGrid.addEventListener('click', e => {
      const b = e.target.closest('[data-remove]'); if (!b) return;
      const i = +b.dataset.remove;
      URL.revokeObjectURL(media[i].url);
      media.splice(i, 1);
      dt.items.remove(i);
      fileInput.files = dt.files;
      renderMedia();
    });

    /* Variants */
    let variants = @json($variantRows).map(v => ({
      sku:   v.sku   ?? '',
      size:  v.size  ?? '',
      color: v.color ?? '',
      stock: v.stock ?? '',
    }));
    const variantBody = document.getElementById('variant-body');
    const inputClass = 'w-full rounded-lg border border-neutral-200 px-3 py-2 text-sm placeholder:text-neutral-400 focus:border-black focus:outline-none';

    function renderVariants() {
      variantBody.innerHTML = variants.map((v, i) => `
        <tr>
          <td class="py-2 pr-3">
            <input type="hidden" name="variants[${i}][sku]" value="${esc(v.sku)}" />
            <input data-size="${i}" name="variants[${i}][size]" type="text" value="${esc(v.size)}" placeholder="e.g. M, 32, One size" class="${inputClass}" />
          </td>
          <td class="py-2 pr-3">
            <input data-color="${i}" name="variants[${i}][color]" type="text" value="${esc(v.color)}" placeholder="e.g. Brown" class="${inputClass}" />
          </td>
          <td class="py-2 pr-3">
            <input data-stock="${i}" name="variants[${i}][stock]" type="number" min="0" value="${esc(v.stock)}" placeholder="0"
              class="tabular w-24 rounded-lg border border-neutral-200 px-3 py-2 text-sm placeholder:text-neutral-400 focus:border-black focus:outline-none" />
          </td>
          <td class="py-2 text-right">
            <button type="button" data-remove-variant="${i}" class="rounded-md p-1.5 text-neutral-400 hover:text-black ${variants.length === 1 ? 'opacity-30' : ''}" aria-label="Remove size" ${variants.length === 1 ? 'disabled' : ''}>✕</button>
          </td>
        </tr>`).join('');
    }

    document.getElementById('add-variant').addEventListener('click', () => {
      variants.push({ sku: '', size: '', color: '', stock: '' }); renderVariants();
    });
    variantBody.addEventListener('click', e => {
      const b = e.target.closest('[data-remove-variant]'); if (!b || b.disabled) return;
      variants.splice(+b.dataset.removeVariant, 1); renderVariants();
    });
    variantBody.addEventListener('input', e => {
      const d = e.target.dataset;
      if (d.size  !== undefined) variants[+d.size].size   = e.target.value;
      if (d.color !== undefined) variants[+d.color].color = e.target.value;
      if (d.stock !== undefined) variants[+d.stock].stock = e.target.value;
    });

    /* Pricing hint + live preview */
    const priceInput = document.getElementById('f-price');
    const saleInput  = document.getElementById('f-sale');
    const nameInput  = document.getElementById('f-name');
    const catSelect  = document.getElementById('f-category');

    function updateMarginHint() {
      const price = parseFloat(priceInput.value);
      const sale  = parseFloat(saleInput.value);
      const hint  = document.getElementById('margin-hint');
      if (price > 0 && sale > 0 && sale < price) {
        const off = Math.round((1 - sale / price) * 100);
        hint.textContent = `Shown as ${off}% off — was ${money(price)}, now ${money(sale)}.`;
        hint.className = 'mt-3 text-sm text-black';
      } else {
        hint.classList.add('hidden');
      }
    }

    function updatePreview() {
      const name     = nameInput.value.trim();
      const category = catSelect.value ? catSelect.options[catSelect.selectedIndex].text.trim() : 'Category';
      const price    = parseFloat(priceInput.value);
      const sale     = parseFloat(saleInput.value);
      const hasSale  = price > 0 && sale > 0 && sale < price;
      const shown    = hasSale ? sale : price;

      const pn = document.getElementById('preview-name');
      pn.textContent = name || 'Product name';
      pn.className = `truncate font-medium ${name ? 'text-black' : 'text-neutral-300'}`;

      document.getElementById('preview-category').textContent = category;

      const pp = document.getElementById('preview-price');
      pp.innerHTML = shown > 0
        ? `${money(shown)}${hasSale ? ` <span class="ml-1.5 text-xs font-normal text-neutral-400 line-through">${money(price)}</span>` : ''}`
        : '$0.00';
      pp.className = `tabular mt-3 font-semibold ${shown > 0 ? 'text-black' : 'text-neutral-300'}`;

      const cover = media.length ? media[0].url : coverUrl;
      document.getElementById('preview-image').innerHTML = cover
        ? `<img src="${cover}" alt="" class="h-full w-full object-cover" />`
        : `<span class="font-serif text-4xl text-neutral-300">${initials(name)}</span>`;
    }

    [priceInput, saleInput].forEach(el => el.addEventListener('input', () => { updateMarginHint(); updatePreview(); }));
    nameInput.addEventListener('input', updatePreview);
    catSelect.addEventListener('change', updatePreview);

    /* Client-side validation */
    function showError(id, msg) {
      const el = document.getElementById(id);
      if (!el) return;
      el.textContent = msg || '';
      el.classList.toggle('hidden', !msg);
    }

    function validate() {
      let ok = true;

      // Name
      const name = nameInput.value.trim();
      showError('err-name', !name ? 'Enter a product name.' : '');
      if (!name) ok = false;

      // Category
      showError('err-category', !catSelect.value ? 'Choose a category.' : '');
      if (!catSelect.value) ok = false;

      // Price
      const price = parseFloat(priceInput.value);
      showError('err-price', !(price > 0) ? 'Enter a price greater than $0.' : '');
      if (!(price > 0)) ok = false;

      // Sale price
      const saleRaw = saleInput.value;
      const sale    = saleRaw === '' ? null : parseFloat(saleRaw);
      const badSale = sale !== null && !(sale > 0 && sale < price);
      showError('err-sale', badSale ? 'Must be lower than the price.' : '');
      if (badSale) ok = false;

      // Reorder level
      const reorderEl = document.getElementById('f-reorder');
      const reorder   = parseInt(reorderEl.value, 10);
      const badReorder = isNaN(reorder) || reorder < 0;
      showError('err-reorder', badReorder ? 'Enter 0 or a positive number.' : '');
      if (badReorder) ok = false;

      // Variants
      const named = variants.filter(v => v.size.trim() !== '');
      const dupes = new Set(named.map(v => v.size.trim().toLowerCase())).size !== named.length;
      showError('err-variants',
        named.length === 0 ? 'Add at least one size.' :
        dupes              ? 'Size names must be unique.' : '');
      if (named.length === 0 || dupes) ok = false;

      return ok;   // ← always last line now
    }

    function submitAs(choice) {
      if (choice !== 'keep') { status = choice; renderStatus(); }
      if (!validate()) return toast('Please fix the highlighted fields');

      variants = variants
        .filter(v => v.size.trim() !== '')
        .map(v => ({ ...v, stock: v.stock === '' ? 0 : v.stock }));

      renderVariants();

      document.querySelectorAll('[data-status]').forEach(b => b.disabled = true);
      form.submit();
    }

    document.querySelectorAll('[data-status]').forEach(b => {
      b.addEventListener('click', () => submitAs(b.dataset.status));
    });

    /* Start-up */
    renderStatus();
    renderVariants();
    updateDescCount();
    updateMarginHint();
    updatePreview();
  </script>
</body>
</html>