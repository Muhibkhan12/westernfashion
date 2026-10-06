{{-- resources/views/Admin/productShow.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $product->name }} · thewesternfashion admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = { theme: { extend: { fontFamily: {
      sans: ['Manrope', 'ui-sans-serif', 'system-ui', 'sans-serif'],
      serif: ['"Instrument Serif"', 'Georgia', 'serif'],
    } } } };
  </script>
</head>
<body data-page="products" class="bg-neutral-50 font-sans text-black antialiased">

  @include('Admin.sidebar')
  <div id="overlay" class="fixed inset-0 z-30 hidden bg-black/40 lg:hidden"></div>

  @php $hasSale = $product->sale_price && $product->sale_price < $product->price; @endphp

  <div class="lg:pl-64">
    <header class="sticky top-0 z-20 flex h-16 items-center gap-3 border-b border-neutral-200 bg-white/90 px-4 backdrop-blur sm:px-6 lg:px-8">
      <button id="menu-btn" class="rounded-md p-2 text-neutral-600 hover:bg-neutral-100 lg:hidden" aria-label="Open menu">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h10"/></svg>
      </button>
      <nav class="flex items-center gap-1.5 text-sm text-neutral-500">
        <a href="{{ route('products.index') }}" class="hover:text-black">Products</a>
        <span>/</span>
        <span class="font-medium text-black">{{ $product->name }}</span>
      </nav>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
      <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
          <h1 class="font-serif text-4xl tracking-tight">{{ $product->name }}</h1>
          <p class="mt-1 text-sm text-neutral-500">{{ $product->category->name ?? 'No category' }} · {{ ucfirst($product->status) }}@if($product->featured) · Featured @endif</p>
        </div>
        <div class="flex items-center gap-2">
          <a href="{{ route('products.index') }}" class="rounded-lg border border-neutral-200 bg-white px-3.5 py-2 text-sm font-medium hover:border-black">Back</a>
          <form method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Delete this product, its images and its sizes?')">
            @csrf @method('DELETE')
            <button class="rounded-lg border border-neutral-200 bg-white px-3.5 py-2 text-sm font-medium hover:border-black">Delete</button>
          </form>
          <a href="{{ route('products.edit', $product) }}" class="rounded-lg bg-black px-3.5 py-2 text-sm font-medium text-white hover:bg-neutral-800">Edit</a>
        </div>
      </div>

      <div class="mt-8 grid gap-6 lg:grid-cols-3">
        <div class="space-y-6 lg:col-span-2">
          <section class="rounded-xl border border-neutral-200 bg-white p-6">
            <h2 class="text-base font-semibold">Description</h2>
            <p class="mt-3 whitespace-pre-line text-sm text-neutral-600">{{ $product->description ?: 'No description.' }}</p>
          </section>

          <section class="rounded-xl border border-neutral-200 bg-white p-6">
            <h2 class="text-base font-semibold">Sizes &amp; stock</h2>
            <div class="mt-4 overflow-x-auto">
              <table class="w-full min-w-[480px] text-left text-sm">
                <thead class="text-xs text-neutral-500">
                  <tr><th class="py-2 font-medium">SKU</th><th class="py-2 font-medium">Size</th><th class="py-2 font-medium">Color</th><th class="py-2 font-medium">Price</th><th class="py-2 font-medium">Stock</th></tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                  @foreach ($product->variants as $v)
                    <tr>
                      <td class="py-2 font-mono text-xs">{{ $v->sku }}</td>
                      <td class="py-2">{{ $v->size }}</td>
                      <td class="py-2 text-neutral-600">{{ $v->color ?: '—' }}</td>
                      <td class="py-2 tabular-nums">${{ number_format($v->price, 2) }}</td>
                      <td class="py-2 tabular-nums">{{ $v->stock }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </section>
        </div>

        <div class="space-y-6">
          <section class="rounded-xl border border-neutral-200 bg-white p-6">
            <h2 class="text-base font-semibold">Pricing</h2>
            <p class="mt-3 text-2xl font-semibold tabular-nums">
              ${{ number_format($hasSale ? $product->sale_price : $product->price, 2) }}
              @if ($hasSale)<span class="ml-1.5 text-sm font-normal text-neutral-400 line-through">${{ number_format($product->price, 2) }}</span>@endif
            </p>
          </section>

          <section class="rounded-xl border border-neutral-200 bg-white p-6">
            <h2 class="text-base font-semibold">Images</h2>
            @if ($product->images->count())
              <div class="mt-4 grid grid-cols-2 gap-3">
                @foreach ($product->images as $image)
                  <div class="relative aspect-square overflow-hidden rounded-lg border border-neutral-200">
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="" class="h-full w-full object-cover" />
                    @if ($image->is_primary)<span class="absolute left-1.5 top-1.5 rounded-full bg-black px-1.5 py-0.5 text-[10px] font-medium text-white">Cover</span>@endif
                  </div>
                @endforeach
              </div>
            @else
              <p class="mt-3 text-sm text-neutral-500">No images uploaded.</p>
            @endif
          </section>
        </div>
      </div>
    </main>
  </div>

  <script>
    (function () {
      const sidebar = document.getElementById('sidebar'); if (!sidebar) return;
      const overlay = document.getElementById('overlay');
      const active = sidebar.querySelector(`[data-nav="${document.body.dataset.page}"]`);
      if (active) { active.classList.add('is-active'); active.setAttribute('aria-current', 'page'); }
      const open  = () => { sidebar.classList.remove('-translate-x-full'); overlay.classList.remove('hidden'); };
      const close = () => { sidebar.classList.add('-translate-x-full'); overlay.classList.add('hidden'); };
      document.getElementById('menu-btn').addEventListener('click', open);
      document.getElementById('sidebar-close')?.addEventListener('click', close);
      overlay.addEventListener('click', close);
    })();
  </script>
</body>
</html>