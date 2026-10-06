{{-- resources/views/Admin/products.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Products · thewesternfashion admin</title>
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

  <div class="lg:pl-64">
    <header class="sticky top-0 z-20 flex h-16 items-center gap-3 border-b border-neutral-200 bg-white/90 px-4 backdrop-blur sm:px-6 lg:px-8">
      <button id="menu-btn" class="rounded-md p-2 text-neutral-600 hover:bg-neutral-100 lg:hidden" aria-label="Open menu">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h10"/></svg>
      </button>
      <span class="text-sm font-medium">Products</span>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
      <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
          <h1 class="font-serif text-4xl tracking-tight">Products</h1>
          <p class="mt-1 text-sm text-neutral-500">{{ $products->total() }} total</p>
        </div>
        <a href="{{ route('products.create') }}" class="rounded-lg bg-black px-3.5 py-2 text-sm font-medium text-white hover:bg-neutral-800">Add product</a>
      </div>

      @if (session('success'))
        <div class="mt-6 rounded-xl border border-black bg-white p-4 text-sm font-medium">{{ session('success') }}</div>
      @endif

      <div class="mt-6 overflow-x-auto rounded-xl border border-neutral-200 bg-white">
        <table class="w-full min-w-[720px] text-left text-sm">
          <thead class="border-b border-neutral-200 text-xs text-neutral-500">
            <tr>
              <th class="px-4 py-3 font-medium">Product</th>
              <th class="px-4 py-3 font-medium">Category</th>
              <th class="px-4 py-3 font-medium">Price</th>
              <th class="px-4 py-3 font-medium">Stock</th>
              <th class="px-4 py-3 font-medium">Status</th>
              <th class="px-4 py-3"></th>
            </tr>
          </thead>
          <tbody class="divide-y divide-neutral-100">
            @forelse ($products as $product)
              @php
                $cover = $product->images->firstWhere('is_primary', true) ?? $product->images->first();
                $hasSale = $product->sale_price && $product->sale_price < $product->price;
              @endphp
              <tr>
                <td class="px-4 py-3">
                  <div class="flex items-center gap-3">
                    <div class="h-12 w-12 shrink-0 overflow-hidden rounded-lg bg-neutral-100">
                      @if ($cover)
                        <img src="{{ asset('storage/' . $cover->image_path) }}" alt="" class="h-full w-full object-cover" />
                      @endif
                    </div>
                    <div class="min-w-0">
                      <a href="{{ route('products.show', $product) }}" class="block truncate font-medium hover:underline">{{ $product->name }}</a>
                      @if ($product->featured)<span class="text-xs text-neutral-500">Featured</span>@endif
                    </div>
                  </div>
                </td>
                <td class="px-4 py-3 text-neutral-600">{{ $product->category->name ?? '—' }}</td>
                <td class="px-4 py-3 tabular-nums">
                  ${{ number_format($hasSale ? $product->sale_price : $product->price, 2) }}
                  @if ($hasSale)<span class="ml-1 text-xs text-neutral-400 line-through">${{ number_format($product->price, 2) }}</span>@endif
                </td>
                <td class="px-4 py-3 tabular-nums">{{ $product->variants->sum('stock') }}</td>
                <td class="px-4 py-3">
                  <span class="rounded-full px-2 py-0.5 text-xs font-medium {{ $product->status === 'active' ? 'bg-black text-white' : 'border border-neutral-200 text-neutral-600' }}">
                    {{ ucfirst($product->status) }}
                  </span>
                </td>
                <td class="px-4 py-3 text-right whitespace-nowrap">
                  <a href="{{ route('products.edit', $product) }}" class="text-neutral-600 hover:text-black">Edit</a>
                  <form method="POST" action="{{ route('products.destroy', $product) }}" class="ml-3 inline"
                        onsubmit="return confirm('Delete this product, its images and its sizes?')">
                    @csrf @method('DELETE')
                    <button class="text-neutral-600 hover:text-black">Delete</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr><td colspan="6" class="px-4 py-12 text-center text-neutral-500">No products yet. <a href="{{ route('products.create') }}" class="font-medium text-black underline">Add your first one</a>.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="mt-6">{{ $products->links() }}</div>
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