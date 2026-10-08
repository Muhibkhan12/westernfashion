<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact — The Western Fashion</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,400;0,9..144,500;1,9..144,400;1,9..144,500&family=Inter+Tight:wght@400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<script>
  tailwind.config = { theme: { extend: {
    colors: { paper:'#FFFFFF', paperdeep:'#F4F4F4', ink:'#1C1A16', brick:'#9A3D28', sage:'#57624A', card:'#FFFFFF' },
    fontFamily: { display:['"Fraunces"','serif'], body:['"Inter Tight"','sans-serif'], mono:['"Space Mono"','monospace'] }
  }}}
</script>
<style>
  body { font-family:'Inter Tight',sans-serif; background:#fff; color:#1C1A16; overflow-x:hidden; }
  .font-display { font-family:'Fraunces',serif; font-variation-settings:'opsz' 40; }
  .font-display-sm { font-family:'Fraunces',serif; font-variation-settings:'opsz' 18; }
  .font-mono { font-family:'Space Mono',monospace; }
  .tracking-tag { letter-spacing:.14em; } .tracking-wordmark { letter-spacing:.16em; }
  ::selection { background:#1C1A16; color:#fff; }
  html.lenis, html.lenis body { height:auto; } .lenis.lenis-smooth { scroll-behavior:auto!important; }
  html:not(.lenis) { scroll-behavior:smooth; }
  a:focus-visible, button:focus-visible, input:focus-visible, select:focus-visible, textarea:focus-visible { outline:1.5px solid #9A3D28; outline-offset:4px; }

  .ul { background-image:linear-gradient(currentColor,currentColor); background-position:0 100%; background-repeat:no-repeat; background-size:0% 1px; transition:background-size .4s cubic-bezier(.2,.7,.2,1); }
  .ul:hover, .ul.on { background-size:100% 1px; }
  .rule { height:1px; background:rgba(28,26,22,.12); transform-origin:left; transform:scaleX(0); transition:transform 1.2s cubic-bezier(.77,0,.18,1); }
  .rule.in { transform:scaleX(1); }

  /* reveals */
  [data-r] { opacity:0; transform:translateY(24px); transition:opacity .9s cubic-bezier(.2,.7,.2,1) var(--d,0s), transform .9s cubic-bezier(.2,.7,.2,1) var(--d,0s); }
  [data-r].in { opacity:1; transform:none; }
  .line { display:block; overflow:hidden; padding-bottom:.1em; }
  .line > span { display:block; transform:translateY(110%) rotate(3deg); transform-origin:left; animation:up 1.1s cubic-bezier(.2,.7,.2,1) forwards; animation-delay:calc(.3s + var(--i) * .14s); }
  @keyframes up { to { transform:none; } }
  .fade-in { opacity:0; animation:fi 1s ease forwards; animation-delay:var(--d,0s); } @keyframes fi { to { opacity:1; } }
  .par { position:absolute; left:0; width:100%; height:100%; object-fit:cover; transform:scale(1.2); will-change:transform; }
  .mag { transition:transform .35s cubic-bezier(.2,.7,.2,1), background .3s, color .3s; }

  /* form */
  .fld { position:relative; }
  .fld::after { content:''; position:absolute; left:0; right:0; bottom:0; height:1px; background:#1C1A16; transform:scaleX(0); transform-origin:left; transition:transform .6s cubic-bezier(.77,0,.18,1); }
  .fld:focus-within::after { transform:scaleX(1); }
  .field-input { background:transparent; border:none; border-bottom:1px solid rgba(28,26,22,.18); padding:12px 2px; font-size:15px; outline:none; width:100%; border-radius:0; appearance:none; -webkit-appearance:none; }
  .field-input::placeholder { color:rgba(28,26,22,.35); }
  .field-label { font-size:11px; font-family:'Space Mono',monospace; text-transform:uppercase; letter-spacing:.1em; color:rgba(28,26,22,.5); margin-bottom:4px; display:block; transition:color .3s; }
  .fld-wrap:focus-within .field-label { color:#9A3D28; }
  #formConfirm { opacity:0; transform:translateY(8px); transition:opacity .6s ease, transform .6s ease; } #formConfirm.show { opacity:1; transform:none; }

  /* info rows */
  .info { transition:padding .4s cubic-bezier(.2,.7,.2,1); } .info:hover { padding-left:12px; }

  /* accordion */
  .accordion-item .accordion-icon { transition:transform .4s cubic-bezier(.2,.7,.2,1); }
  .accordion-item.open .accordion-icon { transform:rotate(135deg); }
  .accordion-body { display:grid; grid-template-rows:0fr; opacity:0; transition:grid-template-rows .5s cubic-bezier(.2,.7,.2,1), opacity .4s ease; }
  .accordion-item.open .accordion-body { grid-template-rows:1fr; opacity:1; }
  .accordion-body-inner { overflow:hidden; }

  @media (prefers-reduced-motion:reduce) {
    [data-r], .line > span, .fade-in { opacity:1; transform:none; animation:none; transition:none; } .rule { transform:none; } .par { transform:none; }
  }
</style>
</head>
<body class="antialiased bg-white">

@include('partials.header')

<!-- Intro -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 pt-20 md:pt-32 pb-16 md:pb-24">
  <p class="fade-in text-[11px] font-mono tracking-tag uppercase text-brick mb-8" style="--d:.2s">Get in touch</p>
  <h1 class="font-display text-4xl sm:text-6xl md:text-[5.5rem] leading-[1.02] max-w-5xl">
    <span class="line" style="--i:0"><span>Questions about an order,</span></span>
    <span class="line" style="--i:1"><span>a repair, or a <em class="italic">jacket</em></span></span>
    <span class="line" style="--i:2"><span>you're eyeing?</span></span>
  </h1>
</section>

<!-- Form + Info -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 pb-24 md:pb-36 grid grid-cols-1 md:grid-cols-12 gap-16 md:gap-8">

  <!-- Form -->
  <div class="md:col-span-6" data-r>
    <form class="space-y-9" onsubmit="return handleSubmit(event)">
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-9 sm:gap-6">
        <div class="fld-wrap">
          <label class="field-label" for="name">Name</label>
          <div class="fld"><input class="field-input" id="name" type="text" required placeholder="Your full name"></div>
        </div>
        <div class="fld-wrap">
          <label class="field-label" for="email">Email</label>
          <div class="fld"><input class="field-input" id="email" type="email" required placeholder="you@example.com"></div>
        </div>
      </div>

      <div class="fld-wrap">
        <label class="field-label" for="topic">What's this about</label>
        <div class="fld">
          <select id="topic" class="field-input pr-8" required>
            <option value="" disabled selected>Choose a topic</option>
            <option>Order status</option>
            <option>Sizing help</option>
            <option>Repairs &amp; care</option>
            <option>Wholesale &amp; press</option>
            <option>Something else</option>
          </select>
          <svg class="absolute right-1 top-1/2 -translate-y-1/2 pointer-events-none" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="6 9 12 15 18 9"/></svg>
        </div>
      </div>

      <div class="fld-wrap">
        <label class="field-label" for="message">Message</label>
        <div class="fld"><textarea class="field-input resize-none" id="message" rows="5" required placeholder="Tell us what's going on"></textarea></div>
      </div>

      <div class="flex flex-wrap items-center gap-6">
        <button type="submit" class="mag group inline-flex items-center gap-3 bg-ink text-paper text-[11px] font-mono uppercase tracking-tag px-8 py-4 border border-ink hover:bg-transparent hover:text-ink">
          Send Message
          <svg class="transition-transform duration-300 group-hover:translate-x-0.5 group-hover:-translate-y-0.5" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
        </button>
        <p id="formConfirm" class="text-[13px] text-sage" aria-live="polite">Thanks — we typically reply within one business day.</p>
      </div>
    </form>
  </div>

  <!-- Info -->
  <div class="md:col-span-5 md:col-start-8">
    <div class="rule" data-rule></div>
    <div class="info py-8" data-r>
      <p class="text-[10px] font-mono uppercase tracking-tag text-ink/50 mb-2">Email</p>
      <a href="mailto:hello@thewesternfashion.com" class="text-[18px] font-display-sm ul pb-0.5">hello@thewesternfashion.com</a>
      <p class="text-[13px] text-ink/60 mt-3">General questions, order help, and sizing.</p>
    </div>
    <div class="rule" data-rule></div>
    <div class="info py-8" data-r>
      <p class="text-[10px] font-mono uppercase tracking-tag text-ink/50 mb-2">Phone</p>
      <a href="tel:+15035550142" class="text-[18px] font-display-sm ul pb-0.5">+1 (503) 555-0142</a>
      <p class="text-[13px] text-ink/60 mt-3">Monday–Friday, 9am–5pm Pacific.</p>
    </div>
    <div class="rule" data-rule></div>
    <div class="info py-8" data-r>
      <p class="text-[10px] font-mono uppercase tracking-tag text-ink/50 mb-2">Workshop &amp; Showroom</p>
      <p class="text-[18px] font-display-sm">2114 SE Division St, Portland, OR 97202</p>
      <p class="text-[13px] text-ink/60 mt-3">Open Thursday–Saturday, 11am–6pm. Fittings by appointment.</p>
    </div>
    <div class="rule" data-rule></div>
    <div class="py-8" data-r>
      <p class="text-[10px] font-mono uppercase tracking-tag text-ink/50 mb-3">Follow</p>
      <div class="flex items-center gap-6 text-[13px]">
        <a href="#" class="ul pb-0.5">Instagram</a>
        <a href="#" class="ul pb-0.5">Pinterest</a>
      </div>
    </div>
    <div class="rule" data-rule></div>
  </div>
</section>

<!-- Map: image grows full-bleed on scroll -->
<section class="mb-24 md:mb-40">
  <div id="grow" class="relative h-[60vh] min-h-[380px] overflow-hidden" style="clip-path:inset(10% 10% 10% 10%)">
    <img data-p="0.14" class="par" src="https://images.unsplash.com/photo-1601987077677-5346c0c57d3f?q=80&w=1600&auto=format&fit=crop" alt="Street view near the workshop on SE Division">
    <div class="absolute inset-0 bg-black/35"></div>
    <div class="relative z-10 h-full flex items-center justify-center px-6">
      <div class="bg-white px-8 py-7 text-center" data-r>
        <p class="text-[10px] font-mono uppercase tracking-tag text-ink/50 mb-2">Find us</p>
        <p class="text-[16px] font-display-sm mb-4">2114 SE Division St, Portland, OR</p>
        <a href="#" class="text-[11px] font-mono uppercase tracking-tag ul pb-0.5">Get Directions ↗</a>
      </div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 pb-24 md:pb-36 grid grid-cols-1 md:grid-cols-12 gap-12 md:gap-8">
  <div class="md:col-span-4" data-r>
    <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-4">Before you write in</p>
    <h2 class="font-display text-3xl md:text-5xl leading-[1.1] max-w-sm">A few things we get asked often.</h2>
  </div>

  <div id="accordion" class="md:col-span-7 md:col-start-6">
    <div class="rule" data-rule></div>
    <div class="accordion-item">
      <button class="w-full flex items-center justify-between text-left py-7" data-toggle aria-expanded="false">
        <span class="text-[18px] font-display-sm pr-4">How long does a repair take?</span>
        <svg class="accordion-icon shrink-0" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
      </button>
      <div class="accordion-body"><div class="accordion-body-inner">
        <p class="text-[14px] text-ink/65 leading-relaxed pb-7 max-w-lg">Most repairs — re-linings, hardware swaps, patch work — take two to three weeks once your jacket reaches the workshop. We'll email you a quote before starting any work.</p>
      </div></div>
    </div>
    <div class="rule" data-rule></div>
    <div class="accordion-item">
      <button class="w-full flex items-center justify-between text-left py-7" data-toggle aria-expanded="false">
        <span class="text-[18px] font-display-sm pr-4">Do you offer exchanges for sizing?</span>
        <svg class="accordion-icon shrink-0" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
      </button>
      <div class="accordion-body"><div class="accordion-body-inner">
        <p class="text-[14px] text-ink/65 leading-relaxed pb-7 max-w-lg">Yes, within 30 days of delivery, as long as the jacket is unworn with tags attached. Email us the order number and we'll set up the exchange.</p>
      </div></div>
    </div>
    <div class="rule" data-rule></div>
    <div class="accordion-item">
      <button class="w-full flex items-center justify-between text-left py-7" data-toggle aria-expanded="false">
        <span class="text-[18px] font-display-sm pr-4">Can I visit the workshop without an appointment?</span>
        <svg class="accordion-icon shrink-0" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
      </button>
      <div class="accordion-body"><div class="accordion-body-inner">
        <p class="text-[14px] text-ink/65 leading-relaxed pb-7 max-w-lg">The showroom is open Thursday to Saturday, 11am–6pm, no appointment needed. For a fitting with a member of the team, book ahead by email so we can set time aside.</p>
      </div></div>
    </div>
    <div class="rule" data-rule></div>
    <div class="accordion-item">
      <button class="w-full flex items-center justify-between text-left py-7" data-toggle aria-expanded="false">
        <span class="text-[18px] font-display-sm pr-4">Do you ship outside the US?</span>
        <svg class="accordion-icon shrink-0" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
      </button>
      <div class="accordion-body"><div class="accordion-body-inner">
        <p class="text-[14px] text-ink/65 leading-relaxed pb-7 max-w-lg">We currently ship to the US, Canada, and the UK. Duties are calculated at checkout so there are no surprises on delivery.</p>
      </div></div>
    </div>
    <div class="rule" data-rule></div>
  </div>
</section>

<!-- Footer -->
<footer class="bg-white overflow-hidden">
  <div class="max-w-[1440px] mx-auto px-6 md:px-10 pt-16 pb-10 grid grid-cols-2 md:grid-cols-4 gap-10">
    <div class="col-span-2">
      <p class="text-[13px] text-ink/60 max-w-xs leading-relaxed">Under-the-radar jackets, consciously made for comfort, style, and elegance.</p>
    </div>
    <div>
      <p class="text-[11px] font-mono uppercase tracking-tag text-brick mb-4">Shop</p>
      <ul class="space-y-2.5 text-[13px]">
        <li><a href="{{ route('shop.products') }}" class="ul">All Jackets</a></li>
        <li><a href="{{ route('cart.index') }}" class="ul">Cart</a></li>
        <li><a href="{{ route('orders.index') }}" class="ul">My Orders</a></li>
      </ul>
    </div>
    <div>
      <p class="text-[11px] font-mono uppercase tracking-tag text-brick mb-4">Company</p>
      <ul class="space-y-2.5 text-[13px]">
        <li><a href="{{ url('/about') }}" class="ul">About</a></li>
        <li><a href="{{ url('/contact') }}" class="ul">Contact</a></li>
      </ul>
    </div>
  </div>
  <p class="font-display uppercase text-center leading-none whitespace-nowrap select-none text-ink/90" style="font-size:7.4vw; letter-spacing:.04em">The Western Fashion</p>
  <div class="py-6 text-center text-[11px] font-mono text-ink/40 tracking-tag uppercase">© {{ date('Y') }} The Western Fashion. All rights reserved.</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/lenis@1.1.18/dist/lenis.min.js"></script>
<script>
  const $ = (s) => document.querySelector(s);
  const clamp = (v, a = 0, b = 1) => Math.min(b, Math.max(a, v));
  const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* form */
  function handleSubmit(e) {
    e.preventDefault();
    $('#formConfirm').classList.add('show');
    e.target.reset();
    return false;
  }

  /* accordion (one open at a time) */
  document.querySelectorAll('[data-toggle]').forEach(btn => btn.addEventListener('click', () => {
    const item = btn.closest('.accordion-item'), wasOpen = item.classList.contains('open');
    document.querySelectorAll('.accordion-item').forEach(i => { i.classList.remove('open'); i.querySelector('[data-toggle]').setAttribute('aria-expanded', 'false'); });
    if (!wasOpen) { item.classList.add('open'); btn.setAttribute('aria-expanded', 'true'); }
  }));

  /* reveals */
  const io = new IntersectionObserver((es) => es.forEach(e => {
    if (!e.isIntersecting) return;
    e.target.classList.add('in'); io.unobserve(e.target);
  }), { threshold: .15, rootMargin: '0px 0px -6% 0px' });
  document.querySelectorAll('[data-r], [data-rule]').forEach(el => io.observe(el));

  /* smooth scroll — exposed as window.lenis so the header menu can pause it */
  let lenis = null;
  if (window.Lenis && !reduce) {
    lenis = new Lenis({ duration: 1.25, easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)) });
    window.lenis = lenis;
    document.querySelectorAll('a[href^="#"]:not([href="#"])').forEach(a => a.addEventListener('click', (e) => {
      const t = document.querySelector(a.getAttribute('href')); if (t) { e.preventDefault(); lenis.scrollTo(t, { offset: -70 }); }
    }));
  }

  /* scroll-driven: image grow + parallax */
  const grow = $('#grow'), pars = [...document.querySelectorAll('[data-p]')];
  function update() {
    const vh = innerHeight;
    const g = grow.getBoundingClientRect(), gp = clamp((vh - g.top) / (vh * .8)), ins = (1 - gp) * 10;
    grow.style.clipPath = `inset(${ins}% ${ins}% ${ins}% ${ins}%)`;
    if (!reduce) pars.forEach(img => {
      const b = img.parentElement.getBoundingClientRect();
      if (b.bottom < -100 || b.top > vh + 100) return;
      const lim = b.height * .09, off = clamp((b.top + b.height / 2 - vh / 2) * -parseFloat(img.dataset.p), -lim, lim);
      img.style.transform = `translate3d(0,${off}px,0) scale(1.2)`;
    });
  }
  (function raf(t) { lenis && lenis.raf(t); update(); requestAnimationFrame(raf); })(0);

  /* magnetic buttons */
  if (matchMedia('(hover:hover)').matches && !reduce) document.querySelectorAll('.mag').forEach(el => {
    el.addEventListener('mousemove', (e) => { const b = el.getBoundingClientRect(); el.style.transform = `translate(${(e.clientX - b.left - b.width / 2) * .18}px,${(e.clientY - b.top - b.height / 2) * .3}px)`; });
    el.addEventListener('mouseleave', () => el.style.transform = '');
  });
</script>
</body>
</html>