{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sign in · thewesternfashion admin</title>

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
  </style>
</head>

<body class="flex min-h-screen flex-col bg-neutral-50 font-sans text-black antialiased">

  <main class="flex flex-1 items-center justify-center px-4 py-12">
    <div class="w-full max-w-sm">

      <!-- Brand -->
      <div class="mb-8 flex flex-col items-center text-center">
        <span class="grid h-11 w-11 place-items-center rounded-md bg-black text-white">
          <span class="font-serif text-2xl leading-none">w</span>
        </span>
        <h1 class="mt-4 font-serif text-3xl tracking-tight">thewesternfashion</h1>
        <p class="mt-1 text-sm text-neutral-500">Sign in to your admin account</p>
      </div>

      <div class="rounded-xl border border-neutral-200 bg-white p-6 sm:p-8">

        {{-- Messages from the controller (e.g. "please verify your email") --}}
        @if (session('status'))
          <p class="mb-5 rounded-lg border border-neutral-200 bg-neutral-50 px-3 py-2 text-sm text-neutral-700">
            {{ session('status') }}
          </p>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
          @csrf

          <div>
            <label for="email" class="text-sm font-medium">Email address</label>
            <input
              id="email"
              name="email"
              type="email"
              value="{{ old('email') }}"
              placeholder="you@thewesternfashion.com"
              required
              class="mt-1.5 w-full rounded-lg border border-neutral-200 px-3 py-2.5 text-sm placeholder:text-neutral-400 focus:border-black focus:outline-none"
            />
            @error('email')
              <p class="mt-1.5 text-xs font-medium text-black">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <div class="flex items-center justify-between">
              <label for="password" class="text-sm font-medium">Password</label>
              <a href="#" class="text-xs font-medium text-neutral-500 hover:text-black">Forgot password?</a>
            </div>

            <div class="relative mt-1.5">
              <input
                id="password"
                name="password"
                type="password"
                placeholder="••••••••"
                required
                class="w-full rounded-lg border border-neutral-200 px-3 py-2.5 pr-10 text-sm placeholder:text-neutral-400 focus:border-black focus:outline-none"
              />
              <button
                type="button"
                id="toggle-password"
                class="absolute right-2.5 top-1/2 -translate-y-1/2 rounded-md p-1 text-neutral-400 hover:text-black"
                aria-label="Show password"
                aria-pressed="false"
              >
                <svg id="icon-show" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"/><circle cx="12" cy="12" r="3"/>
                </svg>
                <svg id="icon-hide" class="hidden h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M17.9 17.9A10.4 10.4 0 0 1 12 20c-7 0-11-7-11-7a19 19 0 0 1 4.2-5.2M9.9 4.2A9.8 9.8 0 0 1 12 4c7 0 11 7 11 7a19 19 0 0 1-2.2 3.1M14.1 14.1a3 3 0 1 1-4.2-4.2"/><path d="m1 1 22 22"/>
                </svg>
              </button>
            </div>
          </div>

          <label class="flex select-none items-center gap-2 text-sm text-neutral-600">
            <input type="checkbox" name="remember" value="1" class="h-4 w-4 rounded border-neutral-300 accent-black" />
            Remember me
          </label>

          <button type="submit" class="w-full rounded-lg bg-black px-4 py-2.5 text-sm font-medium text-white hover:bg-neutral-800">
            Sign in
          </button>
        </form>

        <!-- Google -->
        <div class="my-5 flex items-center gap-3 text-xs text-neutral-400">
          <span class="h-px flex-1 bg-neutral-200"></span>
          or
          <span class="h-px flex-1 bg-neutral-200"></span>
        </div>

        <a href="{{ route('google.redirect') }}"
           class="flex w-full items-center justify-center gap-2 rounded-lg border border-neutral-200 bg-white px-4 py-2.5 text-sm font-medium hover:border-black">
          <span class="font-semibold">G</span>
          Continue with Google
        </a>
      </div>

      <p class="mt-6 text-center text-sm text-neutral-500">
        Don't have an account?
        <a href="{{ route('register') }}" class="font-medium text-black hover:underline">Create one</a>
      </p>
    </div>
  </main>

  <footer class="pb-6 text-center text-xs text-neutral-400">
    &copy; 2026 thewesternfashion. Admin panel.
  </footer>

  <script>
    // Toggle password visibility
    document.getElementById('toggle-password').addEventListener('click', function () {
      const input = document.getElementById('password');
      const show = input.type === 'password';
      input.type = show ? 'text' : 'password';
      this.setAttribute('aria-pressed', show);
      this.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
      document.getElementById('icon-show').classList.toggle('hidden', show);
      document.getElementById('icon-hide').classList.toggle('hidden', !show);
    });
  </script>
</body>
</html>