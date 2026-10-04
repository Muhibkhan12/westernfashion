{{-- resources/views/auth/verify.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Verify email · thewesternfashion admin</title>

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
        <h1 class="mt-4 font-serif text-3xl tracking-tight">Verify your email</h1>
        <p class="mt-1 text-sm text-neutral-500">
          We sent a 6-digit code to <span class="font-medium text-black">{{ $email }}</span>
        </p>
      </div>

      <div class="rounded-xl border border-neutral-200 bg-white p-6 sm:p-8">

        @if (session('status'))
          <p class="mb-5 rounded-lg border border-neutral-200 bg-neutral-50 px-3 py-2.5 text-sm text-neutral-700">
            {{ session('status') }}
          </p>
        @endif

        {{-- route name matches routes/web.php: verify.check --}}
        <form method="POST" action="{{ route('verify.check') }}" class="space-y-5">
          @csrf

          <div>
            <label for="code" class="text-sm font-medium">Verification code</label>
            <input
              id="code"
              name="code"
              type="text"
              inputmode="numeric"
              autocomplete="one-time-code"
              pattern="[0-9]{6}"
              maxlength="6"
              placeholder="000000"
              required
              autofocus
              class="mt-1.5 w-full rounded-lg border border-neutral-200 px-3 py-3 text-center text-2xl font-semibold tracking-[0.5em] placeholder:text-neutral-300 focus:border-black focus:outline-none"
            />
            @error('code')
              <p class="mt-1.5 text-xs font-medium text-black">{{ $message }}</p>
            @enderror
          </div>

          <button type="submit" class="w-full rounded-lg bg-black px-4 py-2.5 text-sm font-medium text-white hover:bg-neutral-800">
            Verify email
          </button>
        </form>

        <form method="POST" action="{{ route('verify.resend') }}" class="mt-5 text-center text-sm text-neutral-500">
          @csrf
          Didn't get the code?
          <button type="submit" class="font-medium text-black hover:underline">Resend</button>
        </form>
      </div>

      <p class="mt-6 text-center text-sm text-neutral-500">
        <a href="{{ route('login') }}" class="font-medium text-black hover:underline">Back to sign in</a>
      </p>
    </div>
  </main>

  <footer class="pb-6 text-center text-xs text-neutral-400">
    &copy; 2026 thewesternfashion. Admin panel.
  </footer>

  <script>
    // Only allow digits in the code box
    document.getElementById('code').addEventListener('input', (e) => {
      e.target.value = e.target.value.replace(/\D/g, '').slice(0, 6);
    });
  </script>
</body>
</html>