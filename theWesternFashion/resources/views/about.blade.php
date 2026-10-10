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
    colors: { paper:'#FFFFFF', paperdeep:'#F4F4F4', ink:'#1C1A16', brick:'#9A3D28', sage:'#57624A', sand:'#E9E6E0', card:'#FFFFFF' },
    fontFamily: { display:['"Fraunces"','serif'], body:['"Inter Tight"','sans-serif'], mono:['"Space Mono"','monospace'] }
  }}}
  /* A broken image becomes a neutral tile, never a wrong picture */
  window.imgFail = function (i) {
    i.onerror = null;
    i.src = 'data:image/svg+xml,' + encodeURIComponent('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 3 4"><rect width="3" height="4" fill="#E9E6E0"/></svg>');
  };
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

  /* progress bar */
  #prog { position:fixed; top:0; left:0; height:2px; width:100%; background:#9A3D28; transform-origin:left; transform:scaleX(0); z-index:90; pointer-events:none; }

  /* marquee */
  .mq-i { font-family:'Fraunces',serif; font-variation-settings:'opsz' 72; font-size:clamp(2.5rem,8vw,6rem); line-height:1; margin:0 2rem; flex:none; }
  .mq-i.out { color:transparent; -webkit-text-stroke:1px #1C1A16; font-style:italic; }
  .mq-d { width:.9rem; height:.9rem; border-radius:99px; background:#9A3D28; flex:none; }

  /* timeline: pinned chapters with a rolling year */
  #tl2 { height:calc(100vh + 80vh * 4); height:calc(100svh + 80svh * 4); }
  .odo { display:flex; font-family:'Fraunces',serif; font-variation-settings:'opsz' 144; font-weight:300; font-size:clamp(5.5rem,17vw,12.5rem); line-height:1; height:1em; overflow:hidden; letter-spacing:-.03em; }
  .odo-col { width:.6em; height:1em; overflow:hidden; flex:none; }
  .odo-col:nth-child(-n+2) { color:rgba(28,26,22,.18); }
  .odo-col > div { transform:translateY(calc(var(--n,0) * -1em)); transition:transform 1.1s cubic-bezier(.77,0,.18,1); }
  .odo-col span { display:block; height:1em; line-height:1; text-align:center; }
  .tl2-card { grid-area:1 / 1; opacity:0; transform:translateY(48px); pointer-events:none; transition:opacity .7s cubic-bezier(.2,.7,.2,1), transform .9s cubic-bezier(.2,.7,.2,1); }
  .tl2-card.on { opacity:1; transform:none; pointer-events:auto; transition-delay:.25s; }
  .tl2-card.past { transform:translateY(-48px); }
  .tl2-rail-fill { transform-origin:left; transform:scaleX(var(--f,0)); transition:transform .9s cubic-bezier(.77,0,.18,1); }
  .tl2-tick { color:rgba(28,26,22,.4); transition:color .4s; } .tl2-tick.on { color:#1C1A16; }
  .tl2-tick i { display:block; width:9px; height:9px; border-radius:50%; background:#fff; box-shadow:inset 0 0 0 1px rgba(28,26,22,.35); transition:background .4s, box-shadow .4s, transform .4s cubic-bezier(.2,.9,.3,1.4); }
  .tl2-tick.on i { background:#9A3D28; box-shadow:none; transform:scale(1.35); }

  /* values: expanding panels */
  .val { position:relative; overflow:hidden; background:#fff; color:#1C1A16; border-top:1px solid rgba(28,26,22,.14); cursor:pointer; text-align:left; transition:background .7s cubic-bezier(.77,0,.18,1), color .7s cubic-bezier(.77,0,.18,1), flex-grow .9s cubic-bezier(.77,0,.18,1); }
  .val:first-child { border-top:0; }
  .val.on { background:#1C1A16; color:#fff; cursor:default; }
  .val-label { display:flex; align-items:center; gap:16px; padding:22px 24px; }
  .val-label .num { font:400 13px 'Space Mono',monospace; opacity:.5; }
  .val-label .ico { margin-left:auto; width:14px; height:14px; position:relative; flex:none; }
  .val-label .ico::before, .val-label .ico::after { content:''; position:absolute; left:0; right:0; top:50%; height:1px; background:currentColor; transition:transform .5s cubic-bezier(.77,0,.18,1); }
  .val-label .ico::after { transform:rotate(90deg); } .val.on .ico::after { transform:rotate(0); }
  .val-full { display:grid; grid-template-rows:0fr; transition:grid-template-rows .8s cubic-bezier(.77,0,.18,1); }
  .val.on .val-full { grid-template-rows:1fr; }
  .val-full > div { min-height:0; overflow:hidden; padding:0 24px; }
  .val.on .val-full > div { padding-bottom:30px; }
  .val-full .rv { opacity:0; transform:translateY(14px); transition:opacity .5s ease, transform .7s cubic-bezier(.2,.7,.2,1); }
  .val.on .val-full .rv { opacity:1; transform:none; transition-delay:calc(.3s + var(--k) * .09s); }
  .chip { display:inline-block; border:1px solid rgba(255,255,255,.28); padding:7px 12px; font:400 11px 'Space Mono',monospace; letter-spacing:.08em; text-transform:uppercase; }
  .val .pbar { position:absolute; left:0; right:0; bottom:0; height:2px; background:rgba(255,255,255,.14); opacity:0; }
  .pbar i { display:block; height:100%; background:#9A3D28; transform-origin:left; transform:scaleX(0); }
  #vals.auto .val.on .pbar { opacity:1; }
  #vals.auto .val.on .pbar i { animation:pb 6s linear forwards; }
  @keyframes pb { to { transform:scaleX(1); } }
  @media (min-width:1024px) {
    #valsRow { display:flex; height:560px; border:1px solid rgba(28,26,22,.14); }
    .val { flex:1 1 0; border-top:0; border-left:1px solid rgba(28,26,22,.14); }
    .val:first-child { border-left:0; }
    .val.on { flex-grow:3.4; }
    .val-label { position:absolute; inset:0; flex-direction:column; align-items:flex-start; justify-content:space-between; padding:32px; transition:opacity .4s ease .1s; }
    .val.on .val-label { opacity:0; pointer-events:none; transition-delay:0s; }
    .val-label .ico { margin:0; }
    .val-vert { writing-mode:vertical-rl; transform:rotate(180deg); font-family:'Fraunces',serif; font-variation-settings:'opsz' 40; font-size:28px; line-height:1; }
    .val-full { position:absolute; inset:0; display:block; }
    .val-full > div { width:min(460px, 100%); height:100%; padding:32px; display:flex; flex-direction:column; justify-content:flex-end; overflow:visible; }
    .val.on .val-full > div { padding-bottom:40px; }
  }
  @media (max-width:1023px) { .val-vert { font-family:'Fraunces',serif; font-variation-settings:'opsz' 24; font-size:22px; } }

  /* gallery lightbox */
  #lb { position:fixed; inset:0; z-index:100; background:rgba(28,26,22,.94); display:flex; align-items:center; justify-content:center; padding:24px; opacity:0; pointer-events:none; transition:opacity .35s ease; }
  #lb.open { opacity:1; pointer-events:auto; }
  #lb img { max-width:min(92vw,1100px); max-height:84vh; object-fit:contain; transform:scale(.96); transition:transform .5s cubic-bezier(.2,.7,.2,1); }
  #lb.open img { transform:none; }
  .gal-btn { display:block; width:100%; text-align:left; cursor:zoom-in; }

  /* footer wordmark: letters rise in */
  .ch { display:inline-block; transform:translateY(70%); opacity:0; transition:transform 1s cubic-bezier(.2,.7,.2,1) calc(var(--k) * .045s), opacity .8s ease calc(var(--k) * .045s); }
  #bigMark.in .ch { transform:none; opacity:1; }

  input[type="email"] { font-size:16px; } @media (min-width:640px) { input[type="email"] { font-size:13px; } }

  @media (prefers-reduced-motion:reduce) {
    [data-r], .line > span, .fade-in { opacity:1; transform:none; animation:none; transition:none; } .mask { clip-path:none; } .rule { transform:none; }
    .cue, .hero-zoom { animation:none; } .par { transform:none; } .w { opacity:1; }
    .ch { opacity:1; transform:none; transition:none; } #lb, #lb img { transition:none; }
    .tl2-card, .odo-col > div, .tl2-rail-fill, .val, .val-full, .val-full .rv { transition:none; }
  }
</style>
</head>
<body class="antialiased bg-white">

<div id="prog"></div>

@include('partials.header')

<!-- Hero -->
<section id="hero" class="hero-h relative overflow-hidden bg-ink">
  <div class="absolute inset-0 hero-zoom">
    <img data-p="0.18" class="par" src="https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?q=80&w=1800&auto=format&fit=crop" alt="Fabric being prepared in the Portland workshop" onerror="imgFail(this)">
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
    <p class="text-[14px] leading-relaxed text-ink/70 max-w-md">The first run was eleven field jackets, sold out of that same room to friends and regulars of the tailor shop. Ten years later, the workshop has grown to a team of twelve, but the question hasn't changed.</p>
  </div>
  <div class="lg:col-span-6 lg:col-start-7 pb-8">
    <div class="relative">
      <div class="relative aspect-[4/5] w-full max-h-[720px] overflow-hidden bg-sand mask">
        <img data-p="0.1" class="par" src="https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?q=80&w=900&auto=format&fit=crop" alt="Bolts of raw wool fabric on a workshop shelf" loading="lazy" onerror="imgFail(this)">
      </div>
      <div class="absolute -bottom-6 left-5 right-5 sm:left-8 sm:right-auto sm:max-w-sm bg-white shadow-sm px-5 py-4" data-r style="--d:.3s">
        <p class="text-[10px] font-mono uppercase tracking-tag text-ink/50 mb-1">Founded</p>
        <p class="text-[15px] font-display-sm">2016, above a hardware store on SE Division</p>
      </div>
    </div>
  </div>
</section>

<!-- Numbers -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10">
  <div class="rule" data-rule></div>
  <dl class="grid grid-cols-2 md:grid-cols-4 gap-y-10 gap-x-6 py-12 md:py-16">
    <div data-r>
      <dd class="font-display text-5xl md:text-6xl tabular-nums"><span data-count="10">0</span></dd>
      <dt class="text-[11px] font-mono uppercase tracking-tag text-ink/50 mt-3">Years in the workshop</dt>
    </div>
    <div data-r style="--d:.1s">
      <dd class="font-display text-5xl md:text-6xl tabular-nums"><span data-count="11">0</span></dd>
      <dt class="text-[11px] font-mono uppercase tracking-tag text-ink/50 mt-3">Jackets in the first run</dt>
    </div>
    <div data-r style="--d:.2s">
      <dd class="font-display text-5xl md:text-6xl tabular-nums"><span data-count="2">0</span></dd>
      <dt class="text-[11px] font-mono uppercase tracking-tag text-ink/50 mt-3">Family-run mills</dt>
    </div>
    <div data-r style="--d:.3s">
      <dd class="font-display text-5xl md:text-6xl tabular-nums"><span data-count="12">0</span></dd>
      <dt class="text-[11px] font-mono uppercase tracking-tag text-ink/50 mt-3">People on the team</dt>
    </div>
  </dl>
  <div class="rule" data-rule></div>
</section>

<!-- The question: words fill on scroll -->
<section class="bg-paperdeep mt-20 md:mt-32">
  <div class="max-w-[1100px] mx-auto px-6 md:px-10 py-24 md:py-40">
    <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-8" data-r>The question we still ask</p>
    <p id="words" class="t-words font-display leading-[1.15]">Would this jacket still be worth wearing in ten years?</p>
  </div>
</section>

<!-- Timeline: pinned chapters, the year rolls as you scroll -->
<section id="tl2" class="relative">
  <div class="sticky top-0 h-[100svh] overflow-hidden">
    <div class="max-w-[1440px] mx-auto px-6 md:px-10 h-full flex flex-col justify-center gap-6 lg:grid lg:grid-cols-12 lg:items-center lg:gap-8 pt-16 pb-28">
      <div class="lg:col-span-7" data-r>
        <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-4">Ten Years, Slowly</p>
        <h2 class="t-h2 font-display leading-[1.1] max-w-lg mb-4 md:mb-10">A workshop, grown one season at a time.</h2>
        <div id="odo" class="odo" aria-hidden="true"></div>
      </div>
      <div class="lg:col-span-4 lg:col-start-9 grid">
        <article class="tl2-card on" data-year="2016" aria-label="2016: First stitches">
          <p class="font-mono text-[11px] tracking-tag uppercase text-ink/40 mb-4">Chapter 1 of 4</p>
          <h3 class="font-display text-3xl md:text-4xl leading-[1.1] mb-4">First stitches</h3>
          <p class="text-[14px] md:text-[15px] text-ink/65 leading-relaxed max-w-sm">Eleven field jackets, cut and sewn by hand in a single room, sold directly to neighbors.</p>
          <div class="mt-7 pt-6 border-t border-ink/10 flex items-baseline gap-4">
            <span class="font-display text-5xl md:text-6xl tabular-nums" data-n="11">11</span>
            <span class="text-[11px] font-mono uppercase tracking-tag text-ink/50">Jackets in the first run</span>
          </div>
        </article>
        <article class="tl2-card" data-year="2019" aria-label="2019: First mill partners">
          <p class="font-mono text-[11px] tracking-tag uppercase text-ink/40 mb-4">Chapter 2 of 4</p>
          <h3 class="font-display text-3xl md:text-4xl leading-[1.1] mb-4">First mill partners</h3>
          <p class="text-[14px] md:text-[15px] text-ink/65 leading-relaxed max-w-sm">Began sourcing wool and waxed cotton directly from two family-run mills we still use today.</p>
          <div class="mt-7 pt-6 border-t border-ink/10 flex items-baseline gap-4">
            <span class="font-display text-5xl md:text-6xl tabular-nums" data-n="2">0</span>
            <span class="text-[11px] font-mono uppercase tracking-tag text-ink/50">Family-run mills, still ours</span>
          </div>
        </article>
        <article class="tl2-card" data-year="2022" aria-label="2022: A proper workshop">
          <p class="font-mono text-[11px] tracking-tag uppercase text-ink/40 mb-4">Chapter 3 of 4</p>
          <h3 class="font-display text-3xl md:text-4xl leading-[1.1] mb-4">A proper workshop</h3>
          <p class="text-[14px] md:text-[15px] text-ink/65 leading-relaxed max-w-sm">Moved into a larger space with room for pattern cutting, sewing, and a small finishing line.</p>
          <div class="mt-7 pt-6 border-t border-ink/10 flex items-baseline gap-4">
            <span class="font-display text-5xl md:text-6xl tabular-nums" data-n="3">0</span>
            <span class="text-[11px] font-mono uppercase tracking-tag text-ink/50">Stages under one roof</span>
          </div>
        </article>
        <article class="tl2-card" data-year="2025" aria-label="2025: Twelve hands, one line">
          <p class="font-mono text-[11px] tracking-tag uppercase text-ink/40 mb-4">Chapter 4 of 4</p>
          <h3 class="font-display text-3xl md:text-4xl leading-[1.1] mb-4">Twelve hands, one line</h3>
          <p class="text-[14px] md:text-[15px] text-ink/65 leading-relaxed max-w-sm">A team of twelve now cuts, sews, and finishes every jacket in-house, in small numbered batches.</p>
          <div class="mt-7 pt-6 border-t border-ink/10 flex items-baseline gap-4">
            <span class="font-display text-5xl md:text-6xl tabular-nums" data-n="12">0</span>
            <span class="text-[11px] font-mono uppercase tracking-tag text-ink/50">People on the team</span>
          </div>
        </article>
      </div>
    </div>
    <!-- chapter rail -->
    <div class="absolute inset-x-0 bottom-6 md:bottom-10">
      <div class="max-w-[1440px] mx-auto px-6 md:px-10">
        <div class="relative">
          <div class="absolute left-0 right-0 top-[4px] h-px bg-ink/15"><div id="tl2Fill" class="tl2-rail-fill h-px bg-brick"></div></div>
          <div class="relative flex justify-between">
        <button type="button" class="tl2-tick on flex flex-col items-center gap-3 text-[11px] font-mono tracking-tag" data-go="0" aria-label="Go to 2016"><i></i>2016</button>
        <button type="button" class="tl2-tick flex flex-col items-center gap-3 text-[11px] font-mono tracking-tag" data-go="1" aria-label="Go to 2019"><i></i>2019</button>
        <button type="button" class="tl2-tick flex flex-col items-center gap-3 text-[11px] font-mono tracking-tag" data-go="2" aria-label="Go to 2022"><i></i>2022</button>
        <button type="button" class="tl2-tick flex flex-col items-center gap-3 text-[11px] font-mono tracking-tag" data-go="3" aria-label="Go to 2025"><i></i>2025</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Values: expanding panels -->
<section class="bg-paperdeep">
  <div class="max-w-[1440px] mx-auto px-6 md:px-10 py-20 md:py-32">
    <div class="mb-12 md:mb-16" data-r>
      <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-4">What We Hold To</p>
      <h2 class="t-h2 font-display leading-[1.1] max-w-lg">Three things we won't compromise on.</h2>
    </div>
    <div id="vals" class="auto" data-r>
      <div id="valsRow" class="border border-ink/10 lg:border-0">
        <div class="val on" role="button" tabindex="0" aria-expanded="true" data-v="0">
          <div class="val-label">
            <span class="num">01</span>
            <span class="val-vert">Natural fiber, always</span>
            <span class="ico" aria-hidden="true"></span>
          </div>
          <div class="val-full"><div>
            <p class="rv font-mono text-[13px] opacity-50 mb-4 hidden lg:block" style="--k:0">01</p>
            <h3 class="rv hidden lg:block font-display text-4xl leading-[1.05] mb-5" style="--k:1">Natural fiber, always</h3>
            <p class="rv text-[14px] md:text-[15px] leading-relaxed opacity-75 max-w-sm mb-6" style="--k:2">Wool, waxed cotton, shearling, and full-grain leather. No synthetic blends, no shortcuts on what touches your skin.</p>
            <div class="rv flex flex-wrap gap-2" style="--k:3"><span class="chip">Wool</span><span class="chip">Waxed cotton</span><span class="chip">Shearling</span><span class="chip">Full-grain leather</span></div>
          </div></div>
          <span class="pbar" aria-hidden="true"><i></i></span>
        </div>
        <div class="val" role="button" tabindex="0" aria-expanded="false" data-v="1">
          <div class="val-label">
            <span class="num">02</span>
            <span class="val-vert">Small batches only</span>
            <span class="ico" aria-hidden="true"></span>
          </div>
          <div class="val-full"><div>
            <p class="rv font-mono text-[13px] opacity-50 mb-4 hidden lg:block" style="--k:0">02</p>
            <h3 class="rv hidden lg:block font-display text-4xl leading-[1.05] mb-5" style="--k:1">Small batches only</h3>
            <p class="rv text-[14px] md:text-[15px] leading-relaxed opacity-75 max-w-sm mb-6" style="--k:2">We cut what our team can sew well, not what a forecast says we could sell. Runs are capped, and some styles sell out for good.</p>
            <div class="rv flex flex-wrap gap-2" style="--k:3"><span class="chip">Capped runs</span><span class="chip">Numbered batches</span><span class="chip">Sold out means gone</span></div>
          </div></div>
          <span class="pbar" aria-hidden="true"><i></i></span>
        </div>
        <div class="val" role="button" tabindex="0" aria-expanded="false" data-v="2">
          <div class="val-label">
            <span class="num">03</span>
            <span class="val-vert">Repair over replace</span>
            <span class="ico" aria-hidden="true"></span>
          </div>
          <div class="val-full"><div>
            <p class="rv font-mono text-[13px] opacity-50 mb-4 hidden lg:block" style="--k:0">03</p>
            <h3 class="rv hidden lg:block font-display text-4xl leading-[1.05] mb-5" style="--k:1">Repair over replace</h3>
            <p class="rv text-[14px] md:text-[15px] leading-relaxed opacity-75 max-w-sm mb-6" style="--k:2">Every jacket we sell can come back to the workshop for a re-lining, a patch, or new hardware, for as long as we're around.</p>
            <div class="rv flex flex-wrap gap-2" style="--k:3"><span class="chip">Re-lining</span><span class="chip">Patches</span><span class="chip">New hardware</span></div>
          </div></div>
          <span class="pbar" aria-hidden="true"><i></i></span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Marquee: speed and direction follow your scroll -->
<section class="py-10 md:py-16 overflow-hidden" aria-hidden="true">
  <div id="mq" class="flex items-center w-max whitespace-nowrap will-change-transform"></div>
</section>

<!-- Workshop gallery (click any photo to enlarge) -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 pb-20 md:pb-32">
  <div class="mb-12 md:mb-16" data-r>
    <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-4">Inside the Workshop</p>
    <h2 class="t-h2 font-display leading-[1.1] max-w-lg">Where the jackets get made.</h2>
  </div>
  <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-5 pb-6 md:pb-10">
    <button type="button" class="gal-btn relative aspect-[3/4] overflow-hidden bg-sand mask" data-lb aria-label="Enlarge photo: sewing machine in the workshop">
      <img data-p="0.1" class="par" loading="lazy" src="https://images.unsplash.com/photo-1445205170230-053b83016050?q=80&w=600&auto=format&fit=crop" alt="Sewing machine in the workshop" onerror="imgFail(this)">
    </button>
    <button type="button" class="gal-btn relative aspect-[3/4] overflow-hidden bg-sand mask mt-8 md:mt-14" style="--d:.12s" data-lb aria-label="Enlarge photo: pattern pieces laid out for cutting">
      <img data-p="0.1" class="par" loading="lazy" src="https://images.unsplash.com/photo-1558769132-cb1aea458c5e?q=80&w=600&auto=format&fit=crop" alt="Pattern pieces laid out for cutting" onerror="imgFail(this)">
    </button>
    <button type="button" class="gal-btn relative aspect-[3/4] overflow-hidden bg-sand mask" style="--d:.24s" data-lb aria-label="Enlarge photo: spools of thread in the finishing room">
      <img data-p="0.1" class="par" loading="lazy" src="https://images.unsplash.com/photo-1602293589930-45821b19a97e?q=80&w=600&auto=format&fit=crop" alt="Spools of thread in the finishing room" onerror="imgFail(this)">
    </button>
    <button type="button" class="gal-btn relative aspect-[3/4] overflow-hidden bg-sand mask mt-8 md:mt-14" style="--d:.36s" data-lb aria-label="Enlarge photo: finished jackets on a rail">
      <img data-p="0.1" class="par" loading="lazy" src="https://images.unsplash.com/photo-1610901157620-340856d0a50f?q=80&w=600&auto=format&fit=crop" alt="Finished jackets on a rail" onerror="imgFail(this)">
    </button>
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
    <div class="flex flex-wrap items-center justify-center gap-x-8 gap-y-5" data-r>
      <a href="{{ url('/contact') }}" class="mag group inline-flex items-center gap-3 bg-paper text-ink text-[11px] font-mono uppercase tracking-tag px-8 py-4 border border-paper hover:bg-transparent hover:text-paper">
        Get In Touch
        <svg class="transition-transform duration-300 group-hover:translate-x-0.5 group-hover:-translate-y-0.5" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
      </a>
      <a href="{{ route('shop.products') }}" class="text-[11px] font-mono uppercase tracking-tag ul text-paper pb-0.5">Shop the jackets</a>
    </div>
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

<!-- Lightbox -->
<div id="lb" role="dialog" aria-modal="true" aria-label="Photo viewer" aria-hidden="true">
  <img alt="" src="">
</div>

<script src="https://cdn.jsdelivr.net/npm/lenis@1.1.18/dist/lenis.min.js"></script>
<script>
  const $ = (s) => document.querySelector(s);
  const clamp = (v, a = 0, b = 1) => Math.min(b, Math.max(a, v));
  const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* statement words */
  const wEl = $('#words');
  wEl.innerHTML = wEl.textContent.split(' ').map(w => `<span class="w">${w}</span>`).join(' ');
  const wSpans = [...wEl.querySelectorAll('.w')];

  /* footer wordmark: split into letters */
  const mark = $('#bigMark'), markTxt = mark.firstElementChild;
  markTxt.innerHTML = [...markTxt.textContent].map((c, i) => `<span class="ch" style="--k:${i}">${c === ' ' ? '&nbsp;' : c}</span>`).join('');

  /* marquee */
  const mqEl = $('#mq');
  mqEl.innerHTML = `<span class="mq-i">Natural fiber</span><i class="mq-d"></i><span class="mq-i out">Small batches</span><i class="mq-d"></i><span class="mq-i">Repair over replace</span><i class="mq-d"></i><span class="mq-i out">Cut once</span><i class="mq-d"></i>`.repeat(4);
  let mqW = 0, mqX = 0;

  /* reveals + counters */
  function count(el, key) {
    const end = parseFloat(el.dataset[key]), t0 = performance.now();
    if (isNaN(end)) return;
    if (reduce) { el.textContent = end; return; }
    (function tick(t) {
      const k = Math.min(1, (t - t0) / 1500), e = 1 - Math.pow(1 - k, 3);
      el.textContent = Math.round(end * e);
      if (k < 1) requestAnimationFrame(tick);
    })(t0);
  }
  const io = new IntersectionObserver((es) => es.forEach(e => {
    if (!e.isIntersecting) return;
    e.target.classList.add('in'); io.unobserve(e.target);
    e.target.querySelectorAll('[data-count]').forEach(el => count(el, 'count'));
  }), { threshold: .15, rootMargin: '0px 0px -6% 0px' });
  document.querySelectorAll('[data-r], .mask, [data-rule], .split, #bigMark').forEach(el => io.observe(el));

  /* smooth scroll (exposed so the header menu can pause it) */
  let lenis = null;
  if (window.Lenis && !reduce) {
    lenis = new Lenis({ duration: 1.25, easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)) });
    window.lenis = lenis;
  }

  /* footer wordmark fits any screen; marquee width */
  const fitMark = () => { mark.style.fontSize = '100px'; const w = markTxt.getBoundingClientRect().width; mark.style.fontSize = (100 * mark.parentElement.clientWidth * .94 / w) + 'px'; };
  const measure = () => { mqW = mqEl.scrollWidth / 4; fitMark(); };
  let lastW = innerWidth;
  addEventListener('resize', () => { if (innerWidth !== lastW) { lastW = innerWidth; measure(); } });
  addEventListener('load', measure);
  if (document.fonts && document.fonts.ready) document.fonts.ready.then(measure);
  measure();

  /* scroll-driven engine (one loop) */
  const heroC = $('#heroC'), prog = $('#prog'),
        tl2 = $('#tl2'), cards = [...document.querySelectorAll('.tl2-card')], ticks = [...document.querySelectorAll('.tl2-tick')], fill = $('#tl2Fill'), odo = $('#odo'),
        years = cards.map(c => c.dataset.year),
        pars = [...document.querySelectorAll('[data-p]')];
  /* timeline chapters: rolling year, stacked cards, rail */
  odo.innerHTML = years[0].split('').map(() => `<div class="odo-col"><div>${[0,1,2,3,4,5,6,7,8,9].map(d => `<span>${d}</span>`).join('')}</div></div>`).join('');
  const odoCols = [...odo.querySelectorAll('.odo-col > div')];
  let chapter = -1;
  function setChapter(i) {
    if (i === chapter) return;
    chapter = i;
    years[i].split('').forEach((d, k) => odoCols[k].style.setProperty('--n', d));
    cards.forEach((c, k) => { c.classList.toggle('on', k === i); c.classList.toggle('past', k < i); });
    ticks.forEach((t, k) => t.classList.toggle('on', k === i));
    fill.style.setProperty('--f', i / (cards.length - 1));
    const n = cards[i].querySelector('[data-n]'); if (n) count(n, 'n');
  }
  ticks.forEach((t, k) => t.addEventListener('click', () => {
    const top = tl2.getBoundingClientRect().top + scrollY, total = tl2.offsetHeight - innerHeight;
    const y = top + ((k + .5) / cards.length) * total;
    lenis ? lenis.scrollTo(y, { duration: 1.4 }) : scrollTo({ top: y, behavior: 'smooth' });
  }));

  let lastY = scrollY, sv = 0;
  function update() {
    const y = scrollY, vh = innerHeight, max = Math.max(1, document.documentElement.scrollHeight - vh);
    sv += ((y - lastY) - sv) * .12; lastY = y;

    prog.style.transform = `scaleX(${clamp(y / max)})`;

    if (y < vh * 1.2) { const k = clamp(y / (vh * .6)); heroC.style.opacity = 1 - k; heroC.style.transform = `translate3d(0,${y * .25}px,0)`; }

    const wr = wEl.getBoundingClientRect(), wp = clamp((vh * .85 - wr.top) / (vh * .55)), lit = Math.round(wp * wSpans.length);
    wSpans.forEach((s, i) => s.classList.toggle('lit', i < lit));

    const r = tl2.getBoundingClientRect(), total = Math.max(1, r.height - vh), p = clamp(-r.top / total);
    setChapter(Math.min(cards.length - 1, Math.floor(p * cards.length)));

    if (!reduce) {
      pars.forEach(img => {
        const b = img.parentElement.getBoundingClientRect();
        if (b.bottom < -100 || b.top > vh + 100) return;
        const lim = b.height * .09, off = clamp((b.top + b.height / 2 - vh / 2) * -parseFloat(img.dataset.p), -lim, lim);
        img.style.transform = `translate3d(0,${off}px,0) scale(1.2)`;
      });
      if (mqW) {
        mqX -= .6 + sv * .45;
        if (mqX <= -mqW) mqX += mqW; if (mqX > 0) mqX -= mqW;
        mqEl.style.transform = `translate3d(${mqX}px,0,0)`;
      }
    }
  }
  (function raf(t) { lenis && lenis.raf(t); update(); requestAnimationFrame(raf); })(0);

  /* magnetic buttons */
  if (matchMedia('(hover:hover)').matches && !reduce) document.querySelectorAll('.mag').forEach(el => {
    el.addEventListener('mousemove', (e) => { const b = el.getBoundingClientRect(); el.style.transform = `translate(${(e.clientX - b.left - b.width / 2) * .18}px,${(e.clientY - b.top - b.height / 2) * .3}px)`; });
    el.addEventListener('mouseleave', () => el.style.transform = '');
  });

  /* values: expanding panels (auto-cycle until the visitor interacts) */
  const valsEl = $('#vals'), panels = [...document.querySelectorAll('.val')];
  let vCur = 0, vAuto = !reduce, vSeen = false, vTimer;
  function showVal(i) {
    vCur = i;
    panels.forEach((p, k) => { p.classList.toggle('on', k === i); p.setAttribute('aria-expanded', k === i); });
  }
  function vCycle() {
    clearTimeout(vTimer);
    if (!vAuto || !vSeen) return;
    vTimer = setTimeout(() => { showVal((vCur + 1) % panels.length); vCycle(); }, 6000);
  }
  function vStop() { vAuto = false; valsEl.classList.remove('auto'); clearTimeout(vTimer); }
  if (!vAuto) valsEl.classList.remove('auto');
  panels.forEach((p, k) => {
    p.addEventListener('click', () => { vStop(); showVal(k); });
    p.addEventListener('keydown', (e) => { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); vStop(); showVal(k); } });
    p.addEventListener('mouseenter', () => { if (matchMedia('(hover:hover) and (min-width:1024px)').matches) { vStop(); showVal(k); } });
  });
  new IntersectionObserver(([e]) => {
    vSeen = e.isIntersecting;
    if (vSeen) { if (vAuto) { valsEl.classList.remove('auto'); void valsEl.offsetWidth; valsEl.classList.add('auto'); } vCycle(); } else clearTimeout(vTimer);
  }, { threshold: .4 }).observe(valsEl);

  /* lightbox: click a gallery photo to enlarge, click anywhere or press Esc to close */
  const lb = $('#lb'), lbImg = lb.querySelector('img');
  let lastBtn = null;
  function openLb(btn) {
    const im = btn.querySelector('img');
    lastBtn = btn;
    lbImg.src = im.src.replace(/w=\d+/, 'w=1400');
    lbImg.alt = im.alt;
    lbImg.onerror = () => { lbImg.onerror = null; lbImg.src = im.src; };
    lb.classList.add('open'); lb.setAttribute('aria-hidden', 'false');
    lenis && lenis.stop();
  }
  function closeLb() {
    if (!lb.classList.contains('open')) return;
    lb.classList.remove('open'); lb.setAttribute('aria-hidden', 'true');
    lenis && lenis.start();
    lastBtn && lastBtn.focus();
  }
  document.querySelectorAll('[data-lb]').forEach(b => b.addEventListener('click', () => openLb(b)));
  lb.addEventListener('click', closeLb);
  addEventListener('keydown', (e) => { if (e.key === 'Escape') closeLb(); });
</script>
</body>
</html>