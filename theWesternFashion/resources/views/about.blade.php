<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>About — The Western Fashion</title>
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
  html { -webkit-text-size-adjust:100%; }
  body { font-family:'Inter Tight',sans-serif; background:#fff; color:#1C1A16; overflow-x:hidden; }
  .font-display { font-family:'Fraunces',serif; font-variation-settings:'opsz' 40; }
  .font-display-sm { font-family:'Fraunces',serif; font-variation-settings:'opsz' 18; }
  .font-mono { font-family:'Space Mono',monospace; }
  .tracking-tag { letter-spacing:.14em; } .tracking-wordmark { letter-spacing:.16em; }
  ::selection { background:#1C1A16; color:#fff; }
  html.lenis, html.lenis body { height:auto; } .lenis.lenis-smooth { scroll-behavior:auto!important; }
  html:not(.lenis) { scroll-behavior:smooth; }
  a:focus-visible, button:focus-visible, input:focus-visible { outline:1.5px solid #9A3D28; outline-offset:4px; }

  .ul { background-image:linear-gradient(currentColor,currentColor); background-position:0 100%; background-repeat:no-repeat; background-size:0% 1px; transition:background-size .4s cubic-bezier(.2,.7,.2,1); }
  .ul:hover, .ul.on { background-size:100% 1px; }
  .rule { height:1px; background:rgba(28,26,22,.12); transform-origin:left; transform:scaleX(0); transition:transform 1.2s cubic-bezier(.77,0,.18,1); }
  .rule.in { transform:scaleX(1); }

  /* fluid type */
  .t-hero  { font-size:clamp(2.2rem,7.2vw,5.5rem); }
  .t-h2    { font-size:clamp(1.9rem,5vw,3.25rem); }
  .t-words { font-size:clamp(1.65rem,5vw,3.75rem); }
  .hero-h  { height:80vh; height:80svh; min-height:440px; }

  /* reveals */
  [data-r] { opacity:0; transform:translateY(24px); transition:opacity .9s cubic-bezier(.2,.7,.2,1) var(--d,0s), transform .9s cubic-bezier(.2,.7,.2,1) var(--d,0s); }
  [data-r].in { opacity:1; transform:none; }
  .mask { clip-path:inset(0 0 100% 0); transition:clip-path 1.3s cubic-bezier(.77,0,.18,1) var(--d,0s); } .mask.in { clip-path:inset(0); }
  .line { display:block; overflow:hidden; padding-bottom:.1em; }
  .line > span { display:block; transform:translateY(110%) rotate(3deg); transform-origin:left; animation:up 1.1s cubic-bezier(.2,.7,.2,1) forwards; animation-delay:calc(.3s + var(--i) * .14s); }
  .split .line > span { animation:none; transition:transform 1s cubic-bezier(.2,.7,.2,1) calc(var(--i) * .1s); } .split.in .line > span { transform:none; }
  @keyframes up { to { transform:none; } }
  .fade-in { opacity:0; animation:fi 1s ease forwards; animation-delay:var(--d,0s); } @keyframes fi { to { opacity:1; } }
  .hero-zoom { animation:zo 2s cubic-bezier(.2,.7,.2,1) both; } @keyframes zo { from { transform:scale(1.14); } }
  .par { position:absolute; left:0; width:100%; height:100%; object-fit:cover; transform:scale(1.2); will-change:transform; }
  .cue { width:1px; height:44px; background:linear-gradient(#fff,transparent); transform-origin:top; animation:cue 1.9s ease-in-out infinite; } @keyframes cue { 0% { transform:scaleY(0); } 50% { transform:scaleY(1); } 100% { transform:scaleY(1); opacity:0; } }
  .w { opacity:.14; transition:opacity .35s ease; } .w.lit { opacity:1; }
  .mag { transition:transform .35s cubic-bezier(.2,.7,.2,1), background .3s, color .3s; }

  /* timeline: line fills as you scroll, dots light up */
  .tl { position:relative; --tl:0; }
  .tl-base, .tl-fill { position:absolute; left:5px; top:6px; bottom:6px; width:1px; }
  .tl-base { background:rgba(28,26,22,.15); }
  .tl-fill { background:#9A3D28; transform-origin:top; transform:scaleY(var(--tl)); }
  .tl-item { position:relative; padding-left:40px; }
  .tl-dot { position:absolute; left:0; top:4px; width:11px; height:11px; border-radius:50%; background:#F4F4F4; box-shadow:inset 0 0 0 1px rgba(28,26,22,.3); transition:background .5s, box-shadow .5s, transform .5s cubic-bezier(.2,.9,.3,1.4); }
  .tl-item.on .tl-dot { background:#9A3D28; box-shadow:none; transform:scale(1.25); }
  .tl-item .tl-body { opacity:.45; transition:opacity .6s; } .tl-item.on .tl-body { opacity:1; }
  @media (min-width:768px) {
    .tl-base, .tl-fill { left:6px; right:6px; top:5px; bottom:auto; width:auto; height:1px; }
    .tl-fill { transform-origin:left; transform:scaleX(var(--tl)); }
    .tl-item { padding-left:0; padding-top:40px; }
    .tl-dot { top:0; }
  }

  input[type="email"] { font-size:16px; } @media (min-width:640px) { input[type="email"] { font-size:13px; } }

  @media (prefers-reduced-motion:reduce) {
    [data-r], .line > span, .fade-in { opacity:1; transform:none; animation:none; transition:none; } .mask { clip-path:none; } .rule { transform:none; }
    .cue, .hero-zoom { animation:none; } .par { transform:none; } .w { opacity:1; } .tl-item .tl-body { opacity:1; }
  }
</style>
</head>
<body class="antialiased bg-white">

@include('partials.header')

<!-- Hero -->
<section id="hero" class="hero-h relative overflow-hidden bg-ink">
  <div class="absolute inset-0 hero-zoom">
    <img data-p="0.18" class="par" src="https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?q=80&w=1800&auto=format&fit=crop" alt="Michael Brooks cutting fabric in the Portland workshop">
  </div>
  <div class="absolute inset-0 bg-gradient-to-b from-black/45 via-black/20 to-black/60"></div>
  <div id="heroC" class="relative z-10 h-full flex flex-col items-center justify-center text-center px-6 text-paper">
    <p class="fade-in text-[11px] font-mono tracking-tag uppercase text-paper/70 mb-6" style="--d:.2s">Since 2016 · Portland, Oregon</p>
    <h1 class="t-hero font-display leading-[1.02] max-w-4xl">
      <span class="line" style="--i:0"><span>We make jackets slowly,</span></span>
      <span class="line" style="--i:1"><span>so you can wear them</span></span>
      <span class="line" style="--i:2"><span>for a <em class="italic">long time</em></span></span>
    </h1>
  </div>
  <div class="hidden md:flex flex-col items-center gap-3 absolute left-1/2 -translate-x-1/2 bottom-8 z-10 text-[10px] font-mono uppercase tracking-tag text-paper/70">
    <span>Scroll</span><span class="cue"></span>
  </div>
</section>

<!-- Founding story -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 py-20 md:py-32 grid grid-cols-1 lg:grid-cols-12 gap-14 lg:gap-8 items-center">
  <div class="lg:col-span-5" data-r>
    <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-4">How We Started</p>
    <h2 class="t-h2 font-display leading-[1.1] mb-8 max-w-md">A single sewing machine, a stack of surplus wool, and one question.</h2>
    <p class="text-[14px] leading-relaxed text-ink/70 mb-4 max-w-md">Michael Brooks spent six years altering coats for a Portland tailor before he asked himself why so few jackets were built to actually last. In 2016 he rented a single room above a hardware store, bought a used industrial machine, and started cutting his own patterns.</p>
    <p class="text-[14px] leading-relaxed text-ink/70 max-w-md">The first run was eleven field jackets, sold out of that same room to friends and regulars of the tailor shop. Nine years later, the workshop has grown to a team of twelve, but the question hasn't changed.</p>
  </div>
  <div class="lg:col-span-6 lg:col-start-7 pb-8">
    <div class="relative">
      <div class="relative aspect-[4/5] w-full max-h-[720px] overflow-hidden bg-paperdeep mask">
        <img data-p="0.1" class="par" src="https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?q=80&w=900&auto=format&fit=crop" alt="Bolts of raw wool fabric on a workshop shelf">
      </div>
      <div class="absolute -bottom-6 left-5 right-5 sm:left-8 sm:right-auto sm:max-w-sm bg-white shadow-sm px-5 py-4" data-r style="--d:.3s">
        <p class="text-[10px] font-mono uppercase tracking-tag text-ink/50 mb-1">Founded</p>
        <p class="text-[15px] font-display-sm">2016, above a hardware store on SE Division</p>
      </div>
    </div>
  </div>
</section>

<!-- The question: words fill on scroll -->
<section class="bg-paperdeep">
  <div class="max-w-[1100px] mx-auto px-6 md:px-10 py-24 md:py-40">
    <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-8" data-r>The question we still ask</p>
    <p id="words" class="t-words font-display leading-[1.15]">Would this jacket still be worth wearing in ten years?</p>
  </div>
</section>

<!-- Timeline -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 py-20 md:py-32">
  <div class="mb-14 md:mb-20" data-r>
    <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-4">Nine Years, Slowly</p>
    <h2 class="t-h2 font-display leading-[1.1] max-w-lg">A workshop, grown one season at a time.</h2>
  </div>

  <div id="tl" class="tl grid grid-cols-1 md:grid-cols-4 gap-12 md:gap-8">
    <span class="tl-base" aria-hidden="true"></span><span class="tl-fill" aria-hidden="true"></span>
    <div class="tl-item"><span class="tl-dot"></span><div class="tl-body">
      <p class="font-mono text-[13px] text-brick mb-2">2016</p>
      <p class="text-[17px] font-display-sm mb-2">First stitches</p>
      <p class="text-[13px] text-ink/60 leading-relaxed max-w-xs">Eleven field jackets, cut and sewn by hand in a single room, sold directly to neighbors.</p>
    </div></div>
    <div class="tl-item"><span class="tl-dot"></span><div class="tl-body">
      <p class="font-mono text-[13px] text-brick mb-2">2019</p>
      <p class="text-[17px] font-display-sm mb-2">First mill partners</p>
      <p class="text-[13px] text-ink/60 leading-relaxed max-w-xs">Began sourcing wool and waxed cotton directly from two family-run mills we still use today.</p>
    </div></div>
    <div class="tl-item"><span class="tl-dot"></span><div class="tl-body">
      <p class="font-mono text-[13px] text-brick mb-2">2022</p>
      <p class="text-[17px] font-display-sm mb-2">A proper workshop</p>
      <p class="text-[13px] text-ink/60 leading-relaxed max-w-xs">Moved into a larger space with room for pattern cutting, sewing, and a small finishing line.</p>
    </div></div>
    <div class="tl-item"><span class="tl-dot"></span><div class="tl-body">
      <p class="font-mono text-[13px] text-brick mb-2">2025</p>
      <p class="text-[17px] font-display-sm mb-2">Twelve hands, one line</p>
      <p class="text-[13px] text-ink/60 leading-relaxed max-w-xs">A team of twelve now cuts, sews, and finishes every jacket in-house, in small numbered batches.</p>
    </div></div>
  </div>
</section>

<!-- Values -->
<section class="bg-paperdeep">
  <div class="max-w-[1440px] mx-auto px-6 md:px-10 py-20 md:py-32">
    <div class="mb-14 md:mb-20" data-r>
      <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-4">What We Hold To</p>
      <h2 class="t-h2 font-display leading-[1.1] max-w-lg">Three things we won't compromise on.</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-12 md:gap-10">
      <div>
        <div class="rule mb-8" data-rule></div>
        <div data-r>
          <p class="font-mono text-[13px] text-ink/40 mb-4">01</p>
          <h3 class="font-display-sm text-xl mb-3">Natural fiber, always</h3>
          <p class="text-[14px] text-ink/65 leading-relaxed">Wool, waxed cotton, shearling, and full-grain leather. No synthetic blends, no shortcuts on what touches your skin.</p>
        </div>
      </div>
      <div>
        <div class="rule mb-8" data-rule style="transition-delay:.1s"></div>
        <div data-r style="--d:.1s">
          <p class="font-mono text-[13px] text-ink/40 mb-4">02</p>
          <h3 class="font-display-sm text-xl mb-3">Small batches only</h3>
          <p class="text-[14px] text-ink/65 leading-relaxed">We cut what our team can sew well, not what a forecast says we could sell. Runs are capped, and some styles sell out for good.</p>
        </div>
      </div>
      <div>
        <div class="rule mb-8" data-rule style="transition-delay:.2s"></div>
        <div data-r style="--d:.2s">
          <p class="font-mono text-[13px] text-ink/40 mb-4">03</p>
          <h3 class="font-display-sm text-xl mb-3">Repair over replace</h3>
          <p class="text-[14px] text-ink/65 leading-relaxed">Every jacket we sell can come back to the workshop for a re-lining, a patch, or new hardware, for as long as we're around.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Workshop gallery -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 py-20 md:py-32">
  <div class="mb-12 md:mb-16" data-r>
    <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-4">Inside the Workshop</p>
    <h2 class="t-h2 font-display leading-[1.1] max-w-lg">Where the jackets get made.</h2>
  </div>
  <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-5 pb-6 md:pb-10">
    <div class="relative aspect-[3/4] overflow-hidden bg-paperdeep mask">
      <img data-p="0.1" class="par" loading="lazy" src="https://images.unsplash.com/photo-1445205170230-053b83016050?q=80&w=600&auto=format&fit=crop" alt="Sewing machine in the workshop">
    </div>
    <div class="relative aspect-[3/4] overflow-hidden bg-paperdeep mask mt-8 md:mt-14" style="--d:.12s">
      <img data-p="0.1" class="par" loading="lazy" src="https://images.unsplash.com/photo-1558769132-cb1aea458c5e?q=80&w=600&auto=format&fit=crop" alt="Pattern pieces laid out for cutting">
    </div>
    <div class="relative aspect-[3/4] overflow-hidden bg-paperdeep mask" style="--d:.24s">
      <img data-p="0.1" class="par" loading="lazy" src="https://images.unsplash.com/photo-1602293589930-45821b19a97e?q=80&w=600&auto=format&fit=crop" alt="Spools of thread in the finishing room">
    </div>
    <div class="relative aspect-[3/4] overflow-hidden bg-paperdeep mask mt-8 md:mt-14" style="--d:.36s">
      <img data-p="0.1" class="par" loading="lazy" src="https://images.unsplash.com/photo-1610901157620-340856d0a50f?q=80&w=600&auto=format&fit=crop" alt="Finished jackets on a rail">
    </div>
  </div>
</section>

<!-- CTA -->
<section class="bg-ink text-paper">
  <div class="max-w-[1440px] mx-auto px-6 md:px-10 py-20 md:py-32 text-center">
    <p class="text-[11px] font-mono tracking-tag uppercase text-paper/50 mb-6" data-r>Come see us</p>
    <h2 class="split t-h2 font-display leading-[1.05] mb-10 max-w-2xl mx-auto">
      <span class="line" style="--i:0"><span>Visit the workshop,</span></span>
      <span class="line" style="--i:1"><span>or <em class="italic">send us a note</em> first</span></span>
    </h2>
    <div data-r><a href="{{ url('/contact') }}" class="mag group inline-flex items-center gap-3 bg-paper text-ink text-[11px] font-mono uppercase tracking-tag px-8 py-4 border border-paper hover:bg-transparent hover:text-paper">
      Get In Touch
      <svg class="transition-transform duration-300 group-hover:translate-x-0.5 group-hover:-translate-y-0.5" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
    </a></div>
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
  <p id="bigMark" class="font-display uppercase text-center leading-none whitespace-nowrap select-none text-ink/90" style="letter-spacing:.04em"><span class="inline-block">The Western Fashion</span></p>
  <div class="py-6 text-center text-[11px] font-mono text-ink/40 tracking-tag uppercase">© {{ date('Y') }} The Western Fashion. All rights reserved.</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/lenis@1.1.18/dist/lenis.min.js"></script>
<script>
  const $ = (s) => document.querySelector(s);
  const clamp = (v, a = 0, b = 1) => Math.min(b, Math.max(a, v));
  const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* statement words */
  const wEl = $('#words');
  wEl.innerHTML = wEl.textContent.split(' ').map(w => `<span class="w">${w}</span>`).join(' ');
  const wSpans = [...wEl.querySelectorAll('.w')];

  /* reveals */
  const io = new IntersectionObserver((es) => es.forEach(e => {
    if (!e.isIntersecting) return;
    e.target.classList.add('in'); io.unobserve(e.target);
  }), { threshold: .15, rootMargin: '0px 0px -6% 0px' });
  document.querySelectorAll('[data-r], .mask, [data-rule], .split').forEach(el => io.observe(el));

  /* smooth scroll (exposed so the header menu can pause it) */
  let lenis = null;
  if (window.Lenis && !reduce) {
    lenis = new Lenis({ duration: 1.25, easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)) });
    window.lenis = lenis;
  }

  /* scroll-driven engine (one loop) */
  const heroC = $('#heroC'), tl = $('#tl'), tlItems = [...document.querySelectorAll('.tl-item')],
        pars = [...document.querySelectorAll('[data-p]')];
  function update() {
    const y = scrollY, vh = innerHeight;

    if (y < vh * 1.2) { const k = clamp(y / (vh * .6)); heroC.style.opacity = 1 - k; heroC.style.transform = `translate3d(0,${y * .25}px,0)`; }

    const wr = wEl.getBoundingClientRect(), wp = clamp((vh * .85 - wr.top) / (vh * .55)), lit = Math.round(wp * wSpans.length);
    wSpans.forEach((s, i) => s.classList.toggle('lit', i < lit));

    const t = tl.getBoundingClientRect(), p = clamp((vh * .75 - t.top) / (t.height + vh * .3));
    tl.style.setProperty('--tl', p.toFixed(3));
    tlItems.forEach((el, i) => el.classList.toggle('on', p >= (i / tlItems.length) + .02 || reduce));

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

  /* footer wordmark fits any screen */
  const mark = $('#bigMark');
  const fitMark = () => { mark.style.fontSize = '100px'; const w = mark.firstElementChild.getBoundingClientRect().width; mark.style.fontSize = (100 * mark.parentElement.clientWidth * .94 / w) + 'px'; };
  let lastW = innerWidth;
  addEventListener('resize', () => { if (innerWidth !== lastW) { lastW = innerWidth; fitMark(); } });
  addEventListener('load', fitMark);
  if (document.fonts && document.fonts.ready) document.fonts.ready.then(fitMark);
  fitMark();
</script>
</body>
</html>