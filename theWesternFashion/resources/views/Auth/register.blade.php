<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Create account · thewesternfashion admin</title>

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
        <p class="mt-1 text-sm text-neutral-500">Create your admin account</p>
      </div>

      <div class="rounded-xl border border-neutral-200 bg-white p-6 sm:p-8">
        <form class="space-y-5">

          <div class="grid grid-cols-2 gap-4">
            <div>
              <label for="first-name" class="text-sm font-medium">First name</label>
              <input
                id="first-name"
                type="text"
                placeholder="Ayesha"
                class="mt-1.5 w-full rounded-lg border border-neutral-200 px-3 py-2.5 text-sm placeholder:text-neutral-400 focus:border-black focus:outline-none"
              />
            </div>
            <div>
              <label for="last-name" class="text-sm font-medium">Last name</label>
              <input
                id="last-name"
                type="text"
                placeholder="Raza"
                class="mt-1.5 w-full rounded-lg border border-neutral-200 px-3 py-2.5 text-sm placeholder:text-neutral-400 focus:border-black focus:outline-none"
              />
            </div>
          </div>

          <div>
            <label for="email" class="text-sm font-medium">Email address</label>
            <input
              id="email"
              type="email"
              placeholder="you@thewesternfashion.com"
              class="mt-1.5 w-full rounded-lg border border-neutral-200 px-3 py-2.5 text-sm placeholder:text-neutral-400 focus:border-black focus:outline-none"
            />
          </div>

          <div>
            <label for="password" class="text-sm font-medium">Password</label>
            <div class="relative mt-1.5">
              <input
                id="password"
                type="password"
                placeholder="At least 8 characters"
                class="w-full rounded-lg border border-neutral-200 px-3 py-2.5 pr-10 text-sm placeholder:text-neutral-400 focus:border-black focus:outline-none"
              />
              <button
                type="button"
                data-toggle-password
                class="absolute right-2.5 top-1/2 -translate-y-1/2 rounded-md p-1 text-neutral-400 hover:text-black"
                aria-label="Show password"
                aria-pressed="false"
              >
                <svg data-icon-show class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"/><circle cx="12" cy="12" r="3"/>
                </svg>
                <svg data-icon-hide class="hidden h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M17.9 17.9A10.4 10.4 0 0 1 12 20c-7 0-11-7-11-7a19 19 0 0 1 4.2-5.2M9.9 4.2A9.8 9.8 0 0 1 12 4c7 0 11 7 11 7a19 19 0 0 1-2.2 3.1M14.1 14.1a3 3 0 1 1-4.2-4.2"/><path d="m1 1 22 22"/>
                </svg>
              </button>
            </div>

            <!-- Strength meter -->
            <div class="mt-2 flex gap-1.5" id="strength-bars" aria-hidden="true">
              <span class="h-1 flex-1 rounded-full bg-neutral-100"></span>
              <span class="h-1 flex-1 rounded-full bg-neutral-100"></span>
              <span class="h-1 flex-1 rounded-full bg-neutral-100"></span>
              <span class="h-1 flex-1 rounded-full bg-neutral-100"></span>
            </div>
            <p id="strength-label" class="mt-1.5 text-xs text-neutral-400">Use 8+ characters with a number and a symbol.</p>
          </div>

          <div>
            <label for="confirm-password" class="text-sm font-medium">Confirm password</label>
            <input
              id="confirm-password"
              type="password"
              placeholder="Re-enter your password"
              class="mt-1.5 w-full rounded-lg border border-neutral-200 px-3 py-2.5 text-sm placeholder:text-neutral-400 focus:border-black focus:outline-none"
            />
            <p id="match-hint" class="mt-1.5 hidden text-xs font-medium text-black">Passwords don't match.</p>
          </div>

          <label class="flex select-none items-start gap-2 text-sm text-neutral-600">
            <input type="checkbox" class="mt-0.5 h-4 w-4 rounded border-neutral-300 accent-black" />
            <span>I agree to the <a href="#" class="font-medium text-black hover:underline">Terms of Service</a> and <a href="#" class="font-medium text-black hover:underline">Privacy Policy</a>.</span>
          </label>

          <button type="submit" class="w-full rounded-lg bg-black px-4 py-2.5 text-sm font-medium text-white hover:bg-neutral-800">
            Create account
          </button>
        </form>
      </div>

      <p class="mt-6 text-center text-sm text-neutral-500">
        Already have an account?
        <a href="login.html" class="font-medium text-black hover:underline">Sign in</a>
      </p>
    </div>
  </main>

  <footer class="pb-6 text-center text-xs text-neutral-400">
    &copy; 2026 thewesternfashion. Admin panel.
  </footer>

  <script>
    // Toggle password visibility
    document.querySelectorAll('[data-toggle-password]').forEach(btn => {
      btn.addEventListener('click', () => {
        const input = btn.closest('.relative').querySelector('input');
        const show = input.type === 'password';
        input.type = show ? 'text' : 'password';
        btn.setAttribute('aria-pressed', show);
        btn.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
        btn.querySelector('[data-icon-show]').classList.toggle('hidden', show);
        btn.querySelector('[data-icon-hide]').classList.toggle('hidden', !show);
      });
    });

    // Simple password strength meter (visual only, no validation enforced)
    const passwordInput = document.getElementById('password');
    const bars = document.querySelectorAll('#strength-bars span');
    const label = document.getElementById('strength-label');
    const levels = [
      { text: 'Use 8+ characters with a number and a symbol.', color: 'bg-neutral-100', count: 0 },
      { text: 'Weak', color: 'bg-neutral-300', count: 1 },
      { text: 'Fair', color: 'bg-neutral-400', count: 2 },
      { text: 'Good', color: 'bg-neutral-700', count: 3 },
      { text: 'Strong', color: 'bg-black', count: 4 },
    ];

    function scorePassword(value) {
      let score = 0;
      if (value.length >= 8) score++;
      if (/[A-Z]/.test(value) && /[a-z]/.test(value)) score++;
      if (/\d/.test(value)) score++;
      if (/[^A-Za-z0-9]/.test(value)) score++;
      return value.length ? Math.max(1, score) : 0;
    }

    passwordInput.addEventListener('input', () => {
      const score = scorePassword(passwordInput.value);
      const level = levels[score];
      bars.forEach((bar, i) => {
        bar.className = `h-1 flex-1 rounded-full ${i < level.count ? level.color : 'bg-neutral-100'}`;
      });
      label.textContent = level.text;
      label.className = `mt-1.5 text-xs ${score >= 3 ? 'text-neutral-700' : 'text-neutral-400'}`;
      checkMatch();
    });

    // Confirm-password match hint
    const confirmInput = document.getElementById('confirm-password');
    const matchHint = document.getElementById('match-hint');
    function checkMatch() {
      const mismatch = confirmInput.value.length > 0 && confirmInput.value !== passwordInput.value;
      matchHint.classList.toggle('hidden', !mismatch);
    }
    confirmInput.addEventListener('input', checkMatch);
  </script>
</body>
</html>