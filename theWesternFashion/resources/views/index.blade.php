<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>The Western Fashion — A Capsule Collection</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,400;0,9..144,500;1,9..144,400;1,9..144,500&family=Inter+Tight:wght@400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: { paper:'#FFFFFF', cream:'#F6F3EE', paperdeep:'#F4F4F4', ink:'#1C1A16', brick:'#9A3D28', sage:'#57624A', sand:'#E9E6E0' },
          fontFamily: { display:['"Fraunces"','serif'], body:['"Inter Tight"','sans-serif'], mono:['"Space Mono"','monospace'] }
        }
      }
    }
    /* A broken image becomes a neutral tile, never a wrong picture */
    window.imgFail = function (i) {
      i.onerror = null;
      i.src = 'data:image/svg+xml,' + encodeURIComponent('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 3 4"><rect width="3" height="4" fill="#E9E6E0"/></svg>');
    };
  </script>
  <style>
    body { font-family:'Inter Tight',sans-serif; background:#fff; color:#1C1A16; overflow-x:hidden; }
    .font-display { font-family:'Fraunces',serif; font-variation-settings:'opsz' 40; }
    .font-display-sm { font-family:'Fraunces',serif; font-variation-settings:'opsz' 18; }
    .font-mono { font-family:'Space Mono',monospace; }
    .tracking-tag { letter-spacing:.14em; }
    ::selection { background:#1C1A16; color:#fff; }
    html.lenis, html.lenis body { height:auto; } .lenis.lenis-smooth { scroll-behavior:auto!important; }
    html:not(.lenis) { scroll-behavior:smooth; }
    html:not(.ready) { overflow:hidden; }
    a:focus-visible, button:focus-visible { outline:1.5px solid #9A3D28; outline-offset:4px; }
    html { -webkit-text-size-adjust:100%; }

    .ul { background-image:linear-gradient(currentColor,currentColor); background-position:0 100%; background-repeat:no-repeat; background-size:0% 1px; transition:background-size .4s cubic-bezier(.2,.7,.2,1); }
    .ul:hover, .ul.on { background-size:100% 1px; }
    .rule { height:1px; background:rgba(28,26,22,.12); transform-origin:left; transform:scaleX(0); transition:transform 1.2s cubic-bezier(.77,0,.18,1); }
    .rule.in { transform:scaleX(1); }

    /* ---------- loader ---------- */
    #loader { position:fixed; inset:0; z-index:100; background:#1C1A16; color:#fff; display:flex; flex-direction:column; align-items:center; justify-content:center; gap:26px; transition:transform 1.1s cubic-bezier(.77,0,.18,1); }
    #loader.go { transform:translateY(-100%); }
    #loader .lw { overflow:hidden; display:block; }
    #loader .lw > span { display:block; transform:translateY(110%); animation:up .9s cubic-bezier(.2,.7,.2,1) .15s forwards; }
    #loader .lb { width:min(240px,55vw); height:1px; background:rgba(255,255,255,.18); overflow:hidden; }
    #loader .lb i { display:block; height:100%; background:#fff; transform-origin:left; transform:scaleX(0); }
    #lcount { font-family:'Space Mono',monospace; font-size:11px; letter-spacing:.14em; color:rgba(255,255,255,.6); }

    /* ---------- reveal basics ---------- */
    [data-r] { opacity:0; transform:translateY(28px) scale(.985); transition:opacity .9s cubic-bezier(.2,.7,.2,1) var(--d,0s), transform .9s cubic-bezier(.2,.7,.2,1) var(--d,0s); }
    [data-r].in { opacity:1; transform:none; }
    .mask { clip-path:inset(0 0 100% 0); transition:clip-path 1.3s cubic-bezier(.77,0,.18,1); } .mask.in { clip-path:inset(0); }
    .line { display:block; overflow:hidden; padding-bottom:.1em; }
    .line > span { display:block; transform:translateY(110%) rotate(3deg); transform-origin:left; animation:up 1.1s cubic-bezier(.2,.7,.2,1) forwards; animation-delay:calc(.3s + var(--i) * .14s); }
    .split .line > span { animation:none; transition:transform 1s cubic-bezier(.2,.7,.2,1) calc(var(--i) * .1s); } .split.in .line > span { transform:none; }
    @keyframes up { to { transform:none; } }
    .fade-in { opacity:0; animation:fi 1s ease forwards; animation-delay:var(--d,0s); } @keyframes fi { to { opacity:1; } }
    html:not(.ready) .line > span, html:not(.ready) .fade-in { animation-play-state:paused; }
    .cue { width:1px; height:44px; background:linear-gradient(#fff,transparent); transform-origin:top; animation:cue 1.9s ease-in-out infinite; } @keyframes cue { 0% { transform:scaleY(0); } 50% { transform:scaleY(1); } 100% { transform:scaleY(1); opacity:0; } }

    /* ---------- glass / buttons ---------- */
    .glass { background:rgba(255,255,255,.14); -webkit-backdrop-filter:blur(16px) saturate(140%); backdrop-filter:blur(16px) saturate(140%); border:1px solid rgba(255,255,255,.28); }
    .glass-d { background:rgba(28,26,22,.55); -webkit-backdrop-filter:blur(14px); backdrop-filter:blur(14px); border:1px solid rgba(255,255,255,.12); }
    .btn { display:inline-flex; align-items:center; gap:14px; border-radius:999px; padding:8px 8px 8px 26px; font-family:'Space Mono',monospace; font-size:11px; letter-spacing:.14em; text-transform:uppercase; transition:transform .35s cubic-bezier(.2,.7,.2,1), background .3s, color .3s; }
    .btn .dot { width:38px; height:38px; border-radius:99px; display:grid; place-items:center; transition:transform .45s cubic-bezier(.2,.7,.2,1), background .3s; }
    .btn:hover .dot { transform:rotate(-45deg) scale(1.08); }
    .btn-light { background:#fff; color:#1C1A16; } .btn-light .dot { background:#1C1A16; color:#fff; } .btn-light:hover { background:#F6F3EE; }
    .btn-dark { background:#1C1A16; color:#fff; } .btn-dark .dot { background:#fff; color:#1C1A16; } .btn-dark:hover { background:#9A3D28; }
    .mag { transition:transform .35s cubic-bezier(.2,.7,.2,1), background .3s, color .3s; }

    /* ---------- hover tilt + spotlight ---------- */
    .tilt { position:relative; transform:perspective(900px) rotateX(var(--rx,0deg)) rotateY(var(--ry,0deg)); transition:transform .5s cubic-bezier(.2,.7,.2,1); will-change:transform; }
    .tilt.moving { transition:transform .08s linear; }
    .tilt::after { content:''; position:absolute; inset:0; pointer-events:none; opacity:0; transition:opacity .4s; background:radial-gradient(380px circle at var(--mx,50%) var(--my,50%), rgba(255,255,255,.28), transparent 45%); mix-blend-mode:soft-light; }
    .tilt:hover::after { opacity:1; }
    .card-img { transition:transform 1.2s cubic-bezier(.2,.7,.2,1), filter .5s; } .group:hover .card-img { transform:scale(1.07); }
    .is-out .card-img { filter:grayscale(.6); opacity:.85; }

    /* ---------- statement words ---------- */
    #words { perspective:700px; }
    .w { display:inline-block; opacity:.14; transform-origin:50% 100%; will-change:transform, opacity; }

    /* ---------- tabs ---------- */
    .tab { position:relative; z-index:1; flex:none; padding:10px 20px; border-radius:99px; color:rgba(28,26,22,.55); transition:color .3s; } .tab.active { color:#fff; } .tab:hover { color:#1C1A16; } .tab.active:hover { color:#fff; }
    #tabBar { position:absolute; top:4px; bottom:4px; border-radius:99px; background:#1C1A16; transition:left .5s cubic-bezier(.77,0,.18,1), width .5s cubic-bezier(.77,0,.18,1); z-index:0; }
    #grid { perspective:1100px; }

    /* ---------- marquees ---------- */
    .mq-i { font-family:'Fraunces',serif; font-variation-settings:'opsz' 72; font-size:clamp(2.5rem,8vw,6rem); line-height:1; margin:0 2rem; flex:none; }
    .mq-i.out { color:transparent; -webkit-text-stroke:1px #1C1A16; font-style:italic; }
    .mq-d { width:.9rem; height:.9rem; border-radius:99px; background:#9A3D28; flex:none; }
    @keyframes slide { to { transform:translateX(-50%); } }
    .tag-row { display:flex; gap:40px; width:max-content; animation:slide 30s linear infinite; }

    /* ---------- video ---------- */
    .vid-fb { position:absolute; inset:0; width:100%; height:100%; object-fit:cover; }
    .vid { position:absolute; inset:0; width:100%; height:100%; object-fit:cover; display:block; opacity:0; transition:opacity .9s ease; }
    .vid.on { opacity:1; }

    /* ---------- footer letters (3D flip) ---------- */
    #bigWrap { perspective:900px; }
    .ch { display:inline-block; transform-origin:50% 100%; transform:rotateX(-95deg) translateY(30%); opacity:0; transition:transform 1.1s cubic-bezier(.2,.7,.2,1) calc(var(--k) * .045s), opacity .8s ease calc(var(--k) * .045s); }
    #bigMark.in .ch { transform:none; opacity:1; }
    #bigMark.done .ch { transition:transform .4s cubic-bezier(.2,.7,.2,1) 0s, opacity .4s, color .3s; }
    #bigMark.done .ch:hover { transform:translateY(-7%) rotateX(-20deg); color:#9A3D28; }

    /* ---------- cursor, progress, peek ---------- */
    #prog { position:fixed; top:0; left:0; height:2px; width:100%; background:#9A3D28; transform-origin:left; transform:scaleX(0); z-index:90; pointer-events:none; }
    #cur { position:fixed; top:0; left:0; width:14px; height:14px; margin:-7px 0 0 -7px; border-radius:99px; background:#fff; mix-blend-mode:difference; pointer-events:none; z-index:95; transition:width .3s, height .3s, margin .3s; opacity:0; }
    #cur.big { width:60px; height:60px; margin:-30px 0 0 -30px; }
    #peek { position:fixed; top:0; left:0; width:240px; aspect-ratio:3/4; z-index:60; pointer-events:none; overflow:hidden; opacity:0; transition:opacity .35s; background:#E9E6E0; border-radius:16px; }
    #peek.on { opacity:1; }
    #peek img { width:100%; height:100%; object-fit:cover; }

    @keyframes blob { 0%,100% { transform:translate(0,0) scale(1); } 33% { transform:translate(60px,-40px) scale(1.15); } 66% { transform:translate(-50px,30px) scale(.92); } }
    .blob { position:absolute; border-radius:50%; filter:blur(80px); opacity:.5; animation:blob 18s ease-in-out infinite; pointer-events:none; }

    /* ---------- 3D stages ---------- */
    .stage3d { perspective:1400px; perspective-origin:50% 45%; }
    .p3d { transform-style:preserve-3d; }
    .rcard { backface-visibility:hidden; -webkit-backface-visibility:hidden; }
    #gl canvas { display:block; width:100%; height:100%; }

    /* ---------- responsive type + sizes ---------- */
    .t-hero  { font-size:clamp(2.6rem,9.5vw,7.5rem); }
    .t-h2    { font-size:clamp(2rem,6vw,3.75rem); }
    .t-h3    { font-size:clamp(1.75rem,4.4vw,3rem); }
    .t-words { font-size:clamp(1.65rem,5vw,3.75rem); }
    .t-news  { font-size:clamp(2.1rem,7vw,4.5rem); }
    .t-promo { font-size:clamp(2.1rem,6.5vw,4.5rem); }
    .hero-h  { height:100vh; height:100svh; min-height:560px; }
    .grow-h  { height:80vh; height:80svh; min-height:420px; }
    .pin-h   { height:100vh; height:100svh; }
    .hs-card { flex:none; width:min(68vw,420px); }
    @media (min-width:640px) { .hs-card { width:min(40vw,420px); } }
    @media (min-width:768px) { .hs-card { width:min(26vw,420px); } }
    @supports (height:100svh) {
      .hs-card { width:max(150px,min(68vw,calc((100svh - 300px) * .75),420px)); }
      @media (min-width:640px) { .hs-card { width:max(150px,min(40vw,calc((100svh - 300px) * .75),420px)); } }
      @media (min-width:768px) { .hs-card { width:max(150px,min(26vw,calc((100svh - 300px) * .75),420px)); } }
    }
    #filters { overflow-x:auto; flex-wrap:nowrap; scrollbar-width:none; } #filters::-webkit-scrollbar { display:none; }
    input, textarea, select { font-size:16px; } @media (min-width:640px) { input { font-size:13px; } }
    .footer-link { position:relative; } .footer-link::after { content:''; position:absolute; bottom:-2px; left:0; width:0; height:1px; background:#9A3D28; transition:width .3s ease; } .footer-link:hover::after { width:100%; }
    @media (hover:none) { #cur, #peek { display:none; } }

    @media (prefers-reduced-motion:reduce) {
      [data-r], .line > span, .fade-in { opacity:1; transform:none; animation:none; transition:none; } .mask { clip-path:none; } .rule { transform:scaleX(1); }
      .cue, .blob, .tag-row { animation:none; } .w { opacity:1; }
      .tilt, .card-img { transition:none; } #loader { display:none; } .ch { opacity:1; transform:none; transition:none; }
    }
  </style>
</head>
<body class="antialiased bg-white">

<div id="loader" aria-hidden="true">
  <span class="lw font-display text-3xl md:text-5xl"><span>The Western Fashion</span></span>
  <span class="lb"><i id="lbar"></i></span>
  <span id="lcount">000</span>
</div>
<div id="prog"></div>
<div id="cur"></div>
<div id="peek"><img src="" alt="" onerror="imgFail(this)"></div>

@include('partials.header')

<!-- ================= HERO: real 3D ring of jackets (Three.js), pinned + scroll-rotated ================= -->
<section id="hero" class="hero-h relative overflow-hidden bg-ink">
  <img class="absolute inset-0 w-full h-full object-cover opacity-30 scale-110 blur-[2px]" src="https://images.unsplash.com/photo-1551028719-00167b16eac5?q=80&w=1600&auto=format&fit=crop" alt="" onerror="imgFail(this)">
  <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_50%_40%,rgba(28,26,22,.1),rgba(28,26,22,.9)_75%)]"></div>
  <div id="gl" class="absolute inset-0 z-[1] pointer-events-none"></div>
  <div class="absolute inset-0 z-[2] bg-gradient-to-t from-black/85 via-transparent to-black/30 pointer-events-none"></div>

  <div id="heroC" class="relative z-10 h-full max-w-[1440px] mx-auto px-6 md:px-10 flex flex-col justify-end pb-28 sm:pb-32 md:pb-36 text-paper">
    <div class="fade-in inline-flex items-center gap-3 glass self-start rounded-full px-4 py-2 mb-6 md:mb-8" style="--d:.2s">
      <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
      <span class="text-[10px] font-mono tracking-tag uppercase">Capsule № 04 — AW '26</span>
    </div>
    <h1 class="t-hero font-display leading-[.98] mb-8 md:mb-10 max-w-5xl">
      <span class="line" style="--i:0"><span>A Jacket Capsule</span></span>
      <span class="line" style="--i:1"><span>by <em class="italic">Michael Brooks</em></span></span>
    </h1>
    <div class="fade-in flex flex-wrap items-center gap-x-8 gap-y-5" style="--d:1.1s">
      <a href="{{ route('shop.products') }}" class="btn btn-light mag">Explore Collection <span class="dot">→</span></a>
      <a href="#new" class="text-[11px] font-mono uppercase tracking-tag ul text-paper pb-0.5">New in</a>
    </div>
  </div>

  <a id="chip" href="{{ route('shop.products') }}" class="fade-in hidden md:flex absolute right-10 bottom-36 z-10 glass rounded-2xl p-3 pr-6 items-center gap-4 text-paper will-change-transform" style="--d:1.5s">
    <span class="block w-16 h-20 rounded-lg overflow-hidden bg-sand"><img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1544923246-77307dd654cb?q=80&w=300&auto=format&fit=crop" alt="Camel Wool Jacket" onerror="imgFail(this)"></span>
    <span>
      <span class="block text-[10px] font-mono uppercase tracking-tag text-paper/70">Just in</span>
      <span class="block font-display-sm text-lg leading-tight">Camel Wool Jacket</span>
      <span class="block text-[12px] font-mono mt-1">$400.00 →</span>
    </span>
  </a>

  <div class="absolute bottom-0 inset-x-0 z-10 glass-d border-x-0 border-b-0 overflow-hidden py-3 text-paper/80">
    <div class="tag-row text-[10px] font-mono uppercase tracking-tag whitespace-nowrap" id="tick"></div>
  </div>
  <div class="hidden lg:flex flex-col items-center gap-3 absolute left-10 bottom-36 z-10 text-[10px] font-mono uppercase tracking-tag text-paper/70">
    <span class="[writing-mode:vertical-rl] rotate-180">Scroll to spin</span><span class="cue"></span>
  </div>
</section>

<!-- ================= TRUST STRIP ================= -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 pt-10">
  <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
    <div data-r class="rounded-2xl bg-cream px-5 py-4 flex items-center gap-3"><span class="text-brick">◆</span><span class="text-[11px] font-mono uppercase tracking-tag text-ink/70">Free shipping over $150</span></div>
    <div data-r style="--d:.08s" class="rounded-2xl bg-cream px-5 py-4 flex items-center gap-3"><span class="text-brick">◆</span><span class="text-[11px] font-mono uppercase tracking-tag text-ink/70">30-day returns</span></div>
    <div data-r style="--d:.16s" class="rounded-2xl bg-cream px-5 py-4 flex items-center gap-3"><span class="text-brick">◆</span><span class="text-[11px] font-mono uppercase tracking-tag text-ink/70">Encrypted checkout</span></div>
    <div data-r style="--d:.24s" class="rounded-2xl bg-cream px-5 py-4 flex items-center gap-3"><span class="text-brick">◆</span><span class="text-[11px] font-mono uppercase tracking-tag text-ink/70">Small-batch made</span></div>
  </div>
</section>

<!-- ================= STATEMENT: words flip up in 3D on scroll ================= -->
<section class="max-w-[1100px] mx-auto px-6 md:px-10 py-24 md:py-48">
  <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-8" data-r>The idea</p>
  <p id="words" class="t-words font-display leading-[1.15]">Under-the-radar jackets, consciously made for comfort, style, and elegance. Cut once, worn for years.</p>
</section>

<!-- ================= NEW JACKETS: pinned horizontal scroll, cards rotate in 3D by position ================= -->
<section id="new">
  <div id="hs" class="pin-h flex flex-col justify-center overflow-hidden">
    <div class="max-w-[1440px] w-full mx-auto px-6 md:px-10 flex flex-wrap items-end justify-between gap-x-6 gap-y-3 mb-6 md:mb-10">
      <div data-r>
        <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-3">Just Landed</p>
        <h2 class="t-h2 font-display">New Jackets</h2>
      </div>
      <a href="{{ route('shop.products') }}" class="text-[11px] font-mono uppercase tracking-tag ul pb-0.5">Shop New In</a>
    </div>
    <div id="hsTrack" class="flex gap-5 md:gap-8 px-6 md:px-10 will-change-transform w-max"></div>
    <div class="max-w-[1440px] w-full mx-auto px-6 md:px-10 mt-6 md:mt-10">
      <div class="h-px bg-ink/10"><div id="hsLine" class="h-px bg-ink origin-left" style="transform:scaleX(0)"></div></div>
    </div>
  </div>
</section>

<!-- ================= LOOKBOOK: 3D deck unfolds on scroll ================= -->
<section id="deck" class="pin-h relative overflow-hidden bg-ink text-paper">
  <div class="blob w-[28rem] h-[28rem] bg-brick -left-32 top-0 opacity-30"></div>
  <div class="blob w-[28rem] h-[28rem] bg-sage right-0 bottom-0 opacity-30" style="animation-delay:-7s"></div>
  <div class="relative z-10 text-center pt-24 md:pt-28 px-6">
    <p class="text-[11px] font-mono tracking-tag uppercase text-paper/60 mb-4">The Lookbook</p>
    <h2 class="t-h2 font-display leading-[1.05]">Pull the deck. <em class="italic">Spread the season.</em></h2>
  </div>
  <div class="stage3d absolute inset-0 grid place-items-center pt-24">
    <div id="deckWrap" class="p3d relative w-[170px] h-[230px] sm:w-[210px] sm:h-[285px] md:w-[250px] md:h-[340px]"></div>
  </div>
</section>

<!-- ================= CRAFT BENTO =================
  VIDEO FILES: drop clips in  storage/app/public/assets/videos/  (run `php artisan storage:link` once).
    workshop.mp4  ·  field-jacket.mp4
  Until a file loads, the poster image stays on screen. -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 py-20 md:py-28" style="perspective:1200px">
  <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10" data-r>
    <div>
      <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-4">In Motion</p>
      <h2 class="t-h2 font-display">The craft, up close.</h2>
    </div>
    <a href="{{ route('shop.products') }}" class="text-[11px] font-mono uppercase tracking-tag ul pb-0.5 self-start md:self-auto">See the collection</a>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-6 gap-4 md:auto-rows-[minmax(230px,auto)]">
    <div data-vbox class="b3 group relative overflow-hidden rounded-3xl bg-sand min-h-[340px] md:col-span-4 md:row-span-2">
      <img class="vid-fb card-img" src="https://images.unsplash.com/photo-1544966503-7ba532cb2513?q=80&w=1400&auto=format&fit=crop" alt="Denim jacket on a workshop table" loading="lazy" onerror="imgFail(this)">
      <video class="vid" muted loop playsinline preload="none" aria-hidden="true"><source src="{{ asset('storage/assets/videos/workshop.mp4') }}" type="video/mp4"></video>
      <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent pointer-events-none"></div>
      <div class="absolute bottom-5 left-5 right-5 flex items-end justify-between text-paper">
        <div><span class="glass rounded-full px-3 py-1.5 text-[10px] font-mono uppercase tracking-tag">Workshop / Cutting</span>
          <p class="font-display text-2xl md:text-3xl mt-3 leading-tight">Small-batch construction,<br>Portland studio</p></div>
        <span class="hidden sm:grid w-12 h-12 rounded-full glass place-items-center transition group-hover:rotate-45">↗</span>
      </div>
    </div>

    <div class="b3 rounded-3xl bg-sage text-paper p-7 flex flex-col justify-between md:col-span-2 min-h-[230px]">
      <p class="text-[10px] font-mono uppercase tracking-tag text-paper/70">Since 2016</p>
      <div>
        <p class="font-display text-7xl md:text-8xl leading-none tabular-nums"><span data-count="10">0</span>+</p>
        <p class="text-[13px] text-paper/80 mt-3">Years of cutting, sewing and finishing every piece in the same small room.</p>
      </div>
    </div>

    <div class="b3 rounded-3xl bg-ink text-paper p-7 flex items-center justify-center md:col-span-2 min-h-[230px] relative overflow-hidden">
      <div class="blob w-48 h-48 bg-brick -top-10 -right-10"></div>
      <svg id="seal" viewBox="0 0 120 120" class="relative w-44 h-44 will-change-transform" aria-hidden="true">
        <defs><path id="sealPath" d="M60,60 m-44,0 a44,44 0 1,1 88,0 a44,44 0 1,1 -88,0"/></defs>
        <text font-family="Space Mono, monospace" font-size="9.5" letter-spacing="2.4" fill="#fff"><textPath href="#sealPath">SMALL BATCH • PORTLAND • EST. 2016 • HAND FINISHED •</textPath></text>
        <circle cx="60" cy="60" r="5" fill="#9A3D28"/>
      </svg>
    </div>

    <div data-vbox class="b3 group relative overflow-hidden rounded-3xl bg-sand min-h-[300px] md:col-span-3">
      <img class="vid-fb card-img" src="https://images.unsplash.com/photo-1551028719-00167b16eac5?q=80&w=1200&auto=format&fit=crop" alt="Quilted field jacket" loading="lazy" onerror="imgFail(this)">
      <video class="vid" muted loop playsinline preload="none" aria-hidden="true"><source src="{{ asset('storage/assets/videos/field-jacket.mp4') }}" type="video/mp4"></video>
      <div class="absolute inset-0 bg-gradient-to-t from-black/55 via-transparent to-transparent pointer-events-none"></div>
      <div class="absolute bottom-5 left-5 text-paper"><span class="glass rounded-full px-3 py-1.5 text-[10px] font-mono uppercase tracking-tag">Field Jacket / On body</span>
        <p class="font-display text-xl mt-3">Quilted field jacket in motion</p></div>
    </div>

    <div class="b3 rounded-3xl bg-cream p-7 md:col-span-3 flex flex-col justify-between min-h-[300px]">
      <p class="text-[10px] font-mono uppercase tracking-tag text-brick">Materials</p>
      <ul class="divide-y divide-ink/10 my-4">
        <li class="flex justify-between py-3 font-display-sm text-lg"><span>Italian wool</span><span class="font-mono text-[11px] text-ink/50 self-center">Coats</span></li>
        <li class="flex justify-between py-3 font-display-sm text-lg"><span>Vegetable-tanned leather</span><span class="font-mono text-[11px] text-ink/50 self-center">Jackets</span></li>
        <li class="flex justify-between py-3 font-display-sm text-lg"><span>Waxed cotton</span><span class="font-mono text-[11px] text-ink/50 self-center">Field</span></li>
        <li class="flex justify-between py-3 font-display-sm text-lg"><span>Selvedge denim</span><span class="font-mono text-[11px] text-ink/50 self-center">Truckers</span></li>
      </ul>
      <p class="text-[13px] text-ink/60">We favor natural fibers over synthetics, and would rather make less and make it well.</p>
    </div>
  </div>
</section>

<!-- ================= MARQUEE ================= -->
<section class="py-10 md:py-16 overflow-hidden border-y border-ink/10" aria-hidden="true">
  <div id="mq" class="flex items-center w-max whitespace-nowrap will-change-transform"></div>
</section>

<!-- ================= PROMO: tilts flat + expands full-bleed ================= -->
<section class="my-16 md:my-40" style="perspective:1400px">
  <div id="grow" class="grow-h relative overflow-hidden bg-ink" style="clip-path:inset(10% 10% 10% 10% round 32px)">
    <img id="growImg" class="absolute inset-0 w-full h-full object-cover will-change-transform" src="https://images.unsplash.com/photo-1591047139829-d91aecb6caea?q=80&w=1800&auto=format&fit=crop" alt="Model wearing an oversized wool jacket" loading="lazy" onerror="imgFail(this)">
    <div class="absolute inset-0 bg-black/45"></div>
    <div class="relative z-10 h-full flex flex-col items-center justify-center text-center px-6 text-paper">
      <p class="text-[11px] font-mono tracking-tag uppercase text-paper/70 mb-5" data-r>Outerwear Edit</p>
      <h3 class="t-promo font-display mb-8 max-w-2xl leading-[1.05]" data-r style="--d:.1s">Extra 20% off all jackets</h3>
      <div class="flex gap-3 mb-9" data-r style="--d:.2s" id="cd" aria-label="Sale ends in">
        <div class="glass rounded-2xl w-16 md:w-20 py-3"><p class="font-display text-2xl md:text-3xl tabular-nums" data-u="d">00</p><p class="text-[9px] font-mono uppercase tracking-tag text-paper/70">Days</p></div>
        <div class="glass rounded-2xl w-16 md:w-20 py-3"><p class="font-display text-2xl md:text-3xl tabular-nums" data-u="h">00</p><p class="text-[9px] font-mono uppercase tracking-tag text-paper/70">Hrs</p></div>
        <div class="glass rounded-2xl w-16 md:w-20 py-3"><p class="font-display text-2xl md:text-3xl tabular-nums" data-u="m">00</p><p class="text-[9px] font-mono uppercase tracking-tag text-paper/70">Min</p></div>
        <div class="glass rounded-2xl w-16 md:w-20 py-3"><p class="font-display text-2xl md:text-3xl tabular-nums" data-u="s">00</p><p class="text-[9px] font-mono uppercase tracking-tag text-paper/70">Sec</p></div>
      </div>
      <a href="{{ route('shop.products') }}" class="btn btn-light mag" data-r style="--d:.3s">Shop the Sale <span class="dot">→</span></a>
    </div>
  </div>
</section>

<!-- ================= FEATURED ================= -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 py-10 md:py-20 grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
  <div class="lg:col-span-5" data-r>
    <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-4">Featured</p>
    <h2 class="t-h3 font-display leading-[1.1] mb-8 md:mb-10 max-w-md">The cropped leather jacket.</h2>
    <ul class="max-w-md" id="peekList">
      <li class="rule" data-rule></li>
      <li><a href="{{ route('shop.products') }}" data-img="https://images.unsplash.com/photo-1544441893-675973e31985?q=80&w=500&auto=format&fit=crop" class="group flex items-center justify-between py-5 text-xl font-display-sm transition-all duration-300 hover:pl-3">Women's Jackets <span class="font-mono text-sm transition-transform duration-300 group-hover:translate-x-1 group-hover:-translate-y-1">↗</span></a></li>
      <li class="rule" data-rule></li>
      <li><a href="{{ route('shop.products') }}" data-img="https://images.unsplash.com/photo-1611312449408-fcece27cdbb7?q=80&w=500&auto=format&fit=crop" class="group flex items-center justify-between py-5 text-xl font-display-sm transition-all duration-300 hover:pl-3">Men's Jackets <span class="font-mono text-sm transition-transform duration-300 group-hover:translate-x-1 group-hover:-translate-y-1">↗</span></a></li>
      <li class="rule" data-rule></li>
      <li><a href="{{ route('shop.products') }}" data-img="https://images.unsplash.com/photo-1548624149-f9061a9a2151?q=80&w=500&auto=format&fit=crop" class="group flex items-center justify-between py-5 text-xl font-display-sm transition-all duration-300 hover:pl-3">All Jackets <span class="font-mono text-sm transition-transform duration-300 group-hover:translate-x-1 group-hover:-translate-y-1">↗</span></a></li>
      <li class="rule" data-rule></li>
    </ul>
  </div>

  <div class="lg:col-span-6 lg:col-start-7 relative" style="perspective:1200px">
    <div id="featWrap" class="will-change-transform" style="transform-origin:0% 50%">
      <div data-vbox class="tilt relative aspect-[4/5] w-full max-h-[760px] overflow-hidden rounded-3xl bg-sand mask">
        <img class="vid-fb" src="https://images.unsplash.com/photo-1521223890158-f9f7c3d5d504?q=80&w=1000&auto=format&fit=crop" alt="Cropped leather jacket" loading="lazy" onerror="imgFail(this)">
        <video class="vid" muted loop playsinline preload="none" aria-hidden="true">
          <source src="https://videos.pexels.com/video-files/31223574/13324462_1080_1920_30fps.mp4" type="video/mp4">
          <source src="{{ asset('storage/assets/videos/cropped-leather.mp4') }}" type="video/mp4">
        </video>
      </div>
    </div>
    <div class="flex items-center justify-between pt-4" data-r>
      <p class="text-[15px] font-display-sm">Cropped Leather Jacket</p>
      <span class="text-[15px] font-mono">$400.00</span>
    </div>
  </div>
</section>

<!-- ================= BEST SELLERS ================= -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 pt-16 md:pt-24 pb-20 md:pb-28">
  <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10" data-r>
    <div>
      <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-4">Customer Favorites</p>
      <h2 class="t-h2 font-display">Best Selling Jackets</h2>
    </div>
    <a href="{{ route('shop.products') }}" class="text-[11px] font-mono uppercase tracking-tag ul pb-0.5 self-start md:self-auto">View All</a>
  </div>
  <div class="mb-12" data-r>
    <div id="filters" class="relative inline-flex gap-1 p-1 rounded-full bg-cream max-w-full"><span id="tabBar"></span></div>
  </div>
  <div id="grid" class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-x-4 sm:gap-x-5 gap-y-10 md:gap-y-12"></div>
</section>

<!-- ================= STORY ================= -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 py-16 md:py-28 grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24 items-center">
  <div class="relative w-full h-[380px] sm:h-[460px] lg:h-[620px]" style="perspective:1200px">
    <div id="storyWrap" class="group relative w-full h-full will-change-transform" style="transform-origin:100% 50%">
      <div class="relative w-full h-full overflow-hidden rounded-3xl bg-sand">
        <img id="storyImg" src="{{ asset('storage/assets/jackets.jpg') }}" alt="Handcrafted jacket from The Western Fashion" loading="lazy" decoding="async" onerror="imgFail(this)" class="w-full h-[120%] object-cover will-change-transform">
      </div>
      <div class="absolute -bottom-4 -right-2 md:-right-6 flex items-center gap-2 glass-d rounded-full px-5 py-3 text-paper">
        <span class="w-1.5 h-1.5 rounded-full bg-brick"></span>
        <span class="text-[10px] font-mono uppercase tracking-tag">Est. 2016 · Portland</span>
      </div>
    </div>
  </div>

  <div class="lg:py-16" data-r>
    <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-4">Our Story</p>
    <h2 class="t-h3 font-display leading-[1.1] mb-8 max-w-md">Built on quiet craftsmanship, one small run at a time.</h2>
    <div class="space-y-4 mb-10 max-w-md">
      <p class="text-[14px] leading-relaxed text-ink/70">The Western Fashion began in a single-room Portland workshop in 2016, where founder Michael Brooks set out to make jackets that lasted longer than a season. Every piece is still cut, sewn, and finished in small batches by the same close-knit team.</p>
      <p class="text-[14px] leading-relaxed text-ink/70">We work with mills we've known for years, favor natural fibers over synthetics, and would rather make less and make it well.</p>
    </div>
    <dl class="grid grid-cols-3 gap-3 max-w-md mb-10">
      <div class="rounded-2xl bg-cream p-4"><dd class="font-display text-3xl md:text-4xl tabular-nums"><span data-count="10">0</span>+</dd><dt class="text-[10px] font-mono uppercase tracking-tag text-ink/50 mt-2">Years</dt></div>
      <div class="rounded-2xl bg-cream p-4"><dd class="font-display text-3xl md:text-4xl tabular-nums"><span data-count="4.8" data-dec="1">0</span></dd><dt class="text-[10px] font-mono uppercase tracking-tag text-ink/50 mt-2">Avg rating</dt></div>
      <div class="rounded-2xl bg-cream p-4"><dd class="font-display text-3xl md:text-4xl tabular-nums"><span data-count="312">0</span></dd><dt class="text-[10px] font-mono uppercase tracking-tag text-ink/50 mt-2">Reviews</dt></div>
    </dl>
    <a href="{{ url('/about') }}" class="btn btn-dark mag">Read our full story <span class="dot">→</span></a>
  </div>
</section>

<!-- ================= REVIEWS: pinned 3D cylinder, spins with scroll ================= -->
<section id="rvs" class="pin-h relative overflow-hidden bg-paperdeep">
  <div class="relative z-10 text-center pt-24 md:pt-28 px-6">
    <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-4">4.8 / 5 · 312 reviews</p>
    <h2 class="t-h3 font-display leading-[1.1]">Worn daily, loved for years.</h2>
  </div>
  <div class="stage3d absolute inset-0 grid place-items-center pt-28" style="perspective:1600px">
    <div id="ring" class="p3d relative w-[250px] h-[290px] md:w-[320px] md:h-[300px]"></div>
  </div>
</section>

<!-- ================= NEWSLETTER ================= -->
<section class="bg-ink text-paper relative overflow-hidden">
  <div class="blob w-96 h-96 bg-brick -left-20 -top-20"></div>
  <div class="blob w-96 h-96 bg-sage right-0 bottom-0" style="animation-delay:-6s"></div>
  <div class="relative max-w-[1440px] mx-auto px-6 md:px-10 py-24 md:py-36 text-center">
    <p class="text-[11px] font-mono tracking-tag uppercase text-paper/50 mb-6" data-r>Join the list</p>
    <h2 class="split t-news font-display mb-6">
      <span class="line" style="--i:0"><span>10% off your</span></span>
      <span class="line" style="--i:1"><span><em class="italic">first jacket</em></span></span>
    </h2>
    <p class="text-[14px] text-paper/60 mb-10 max-w-md mx-auto" data-r>Early access to new arrivals, restocks, and the occasional workshop note from Michael.</p>
    <form class="flex items-center gap-2 max-w-md mx-auto glass rounded-full p-2 pl-6" onsubmit="return false;" data-r>
      <input type="email" required placeholder="Email address" class="flex-1 min-w-0 bg-transparent outline-none placeholder:text-paper/50 text-paper">
      <button class="btn btn-light mag" style="padding-left:22px">Sign Up <span class="dot">→</span></button>
    </form>
  </div>
</section>

<!-- ================= FOOTER ================= -->
<footer class="bg-white overflow-hidden border-t border-ink/5">
  <div class="max-w-[1440px] mx-auto px-6 md:px-10 pt-16 pb-10">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-10 lg:gap-16">
      <div class="col-span-2">
        <p class="text-[13px] text-ink/60 max-w-xs leading-relaxed mb-6">Under-the-radar jackets, consciously made for comfort, style, and elegance. Cut once, worn for years.</p>
        <div class="flex gap-3">
          <a href="#" aria-label="Instagram" class="w-10 h-10 rounded-full border border-ink/15 flex items-center justify-center text-[12px] font-mono text-ink/60 hover:bg-ink hover:text-paper hover:border-ink hover:-translate-y-1 transition">IG</a>
          <a href="#" aria-label="Pinterest" class="w-10 h-10 rounded-full border border-ink/15 flex items-center justify-center text-[12px] font-mono text-ink/60 hover:bg-ink hover:text-paper hover:border-ink hover:-translate-y-1 transition">PI</a>
          <a href="#" aria-label="YouTube" class="w-10 h-10 rounded-full border border-ink/15 flex items-center justify-center text-[12px] font-mono text-ink/60 hover:bg-ink hover:text-paper hover:border-ink hover:-translate-y-1 transition">YT</a>
        </div>
      </div>
      <div>
        <p class="text-[11px] font-mono uppercase tracking-tag text-brick mb-4">Shop</p>
        <ul class="space-y-2.5 text-[13px]">
          <li><a href="{{ route('shop.products') }}" class="footer-link text-ink/70 hover:text-ink transition">All Jackets</a></li>
          <li><a href="{{ route('cart.index') }}" class="footer-link text-ink/70 hover:text-ink transition">Cart</a></li>
          <li><a href="{{ route('orders.index') }}" class="footer-link text-ink/70 hover:text-ink transition">My Orders</a></li>
          <li><a href="#" class="footer-link text-ink/70 hover:text-ink transition">Gift Cards</a></li>
        </ul>
      </div>
      <div>
        <p class="text-[11px] font-mono uppercase tracking-tag text-brick mb-4">Company</p>
        <ul class="space-y-2.5 text-[13px]">
          <li><a href="{{ url('/about') }}" class="footer-link text-ink/70 hover:text-ink transition">About</a></li>
          <li><a href="{{ url('/contact') }}" class="footer-link text-ink/70 hover:text-ink transition">Contact</a></li>
          <li><a href="#" class="footer-link text-ink/70 hover:text-ink transition">Sustainability</a></li>
          <li><a href="#" class="footer-link text-ink/70 hover:text-ink transition">Stockists</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div id="bigWrap">
    <p id="bigMark" class="font-display uppercase text-center leading-none whitespace-nowrap select-none text-ink/90 px-4" style="letter-spacing:.04em"><span class="inline-block">The Western Fashion</span></p>
  </div>
  <div class="max-w-[1440px] mx-auto px-6 md:px-10 py-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-[11px] font-mono text-ink/40 tracking-tag uppercase">
    <span>© {{ date('Y') }} The Western Fashion. All rights reserved.</span>
    <div class="flex gap-6">
      <a href="#" class="hover:text-ink transition">Privacy</a>
      <a href="#" class="hover:text-ink transition">Terms</a>
      <a href="#" class="hover:text-ink transition">Cookies</a>
    </div>
  </div>
</footer>

<!-- Libraries -->
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lenis@1.1.18/dist/lenis.min.js"></script>

<!-- ============ 3D HERO (Three.js): ring of jackets, driven by scroll ============ -->
<script type="module">
  import * as THREE from 'https://cdn.jsdelivr.net/npm/three@0.160.0/build/three.module.js';

  const wrap = document.getElementById('gl');
  const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
  try {
    const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    renderer.setPixelRatio(Math.min(devicePixelRatio, 2));
    wrap.appendChild(renderer.domElement);

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(42, 1, .1, 100);
    const group = new THREE.Group();
    scene.add(group);

    const urls = [
      "1544923246-77307dd654cb","1551028719-00167b16eac5","1521223890158-f9f7c3d5d504","1611312449408-fcece27cdbb7",
      "1544441893-675973e31985","1591047139829-d91aecb6caea","1548624149-f9061a9a2151","1544966503-7ba532cb2513"
    ].map(id => `https://images.unsplash.com/photo-${id}?q=75&w=700&auto=format&fit=crop`);

    const N = urls.length, R = 5.4;
    const loader = new THREE.TextureLoader();
    loader.setCrossOrigin('anonymous');

    /* a gently curved plane (convex toward the viewer) */
    const geo = new THREE.PlaneGeometry(2.5, 3.3, 12, 1);
    const pos = geo.attributes.position;
    for (let i = 0; i < pos.count; i++) pos.setZ(i, -Math.pow(pos.getX(i), 2) * .07);
    geo.computeVertexNormals();

    const meshes = urls.map((u, i) => {
      const mat = new THREE.MeshBasicMaterial({ color: 0xE9E6E0, transparent: true, side: THREE.FrontSide });
      const m = new THREE.Mesh(geo, mat);
      const a = (i / N) * Math.PI * 2;
      m.userData = { a, baseY: Math.sin(i * 1.7) * .55 };
      m.position.set(Math.sin(a) * R, m.userData.baseY, Math.cos(a) * R);
      m.rotation.y = a;
      group.add(m);
      loader.load(u, (tex) => {
        tex.colorSpace = THREE.SRGBColorSpace;
        tex.anisotropy = 4;
        mat.map = tex; mat.color.set(0xffffff); mat.needsUpdate = true;
      }, undefined, () => {});
      return m;
    });

    let w = 1, h = 1;
    function resize() {
      w = wrap.clientWidth || innerWidth; h = wrap.clientHeight || innerHeight;
      renderer.setSize(w, h, false);
      camera.aspect = w / h;
      const narrow = camera.aspect < 1;
      camera.userData.baseZ = narrow ? 21 : 15;
      group.scale.setScalar(narrow ? .78 : 1);
      camera.updateProjectionMatrix();
    }
    new ResizeObserver(resize).observe(wrap); resize();

    let visible = true;
    new IntersectionObserver(([e]) => { visible = e.isIntersecting; }).observe(wrap);

    let rotY = 0, rotX = 0.08, mx = 0, my = 0, camZ = 15, sk = 0;
    const clock = new THREE.Clock();

    function frame() {
      requestAnimationFrame(frame);
      if (!visible) return;
      const t = clock.getElapsedTime();
      const p = window.__heroP || 0;               // 0..1 while hero is pinned
      const sv = window.__sv || 0;                  // scroll velocity
      mx += ((window.__mx || 0) - mx) * .05;
      my += ((window.__my || 0) - my) * .05;
      sk += (sv * .004 - sk) * .1;

      const target = -p * Math.PI * 1.7 + (reduce ? 0 : t * .07) + mx * .35 + sk;
      rotY += (target - rotY) * .08;
      rotX += ((.1 + my * .12 - p * .12) - rotX) * .06;
      group.rotation.y = rotY;
      group.rotation.x = rotX;
      group.position.y = .5 - p * .6;

      camZ += ((camera.userData.baseZ - p * 6.5) - camZ) * .08;   // dolly in while scrolling
      camera.position.set(0, .4, camZ);
      camera.lookAt(0, 0, 0);

      meshes.forEach((m, i) => {
        const a = m.userData.a + rotY;
        const facing = Math.cos(a);
        m.material.opacity = Math.max(0, Math.min(1, .12 + facing * 1.15));
        m.position.y = m.userData.baseY + Math.sin(t * .8 + i) * .1;
      });
      renderer.render(scene, camera);
    }
    frame();
  } catch (err) { console.warn('3D hero unavailable, using fallback background.', err); }
</script>

<script>
  const SHOP = "{{ route('shop.products') }}";
  const U = (id, w = 700) => `https://images.unsplash.com/photo-${id}?q=80&w=${w}&auto=format&fit=crop`;
  const SW = { a:["#1C1A16","#3B5BA5","#9A3D28"], b:["#1C1A16","#3B5BA5"], c:["#1C1A16","#9A3D28"], d:["#1C1A16","#EDE9E3"] };
  const $ = (s) => document.querySelector(s);
  const clamp = (v, a = 0, b = 1) => Math.min(b, Math.max(a, v));
  const lerp = (a, b, t) => a + (b - a) * t;
  const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
  const canHover = matchMedia('(hover:hover)').matches;

  gsap.registerPlugin(ScrollTrigger);

  /* One product = one photo */
  const products = [
    { name:"Camel Wool Jacket",         price:400, cat:"wool",    sw:SW.a, img:U("1544923246-77307dd654cb") },
    { name:"Quilted Field Jacket",      price:400, old:450, badge:"Sale",     cat:"field",   sw:SW.b, img:U("1551028719-00167b16eac5") },
    { name:"Cropped Leather Jacket",    price:400, badge:"Sold out", cat:"leather", sw:SW.c, img:U("1521223890158-f9f7c3d5d504") },
    { name:"Denim Trucker Jacket",      price:400, old:450, badge:"Sale",     cat:"denim",   sw:SW.c, img:U("1611312449408-fcece27cdbb7") },
    { name:"Shearling Aviator Jacket",  price:480, cat:"leather", sw:SW.a, img:U("1544441893-675973e31985") },
    { name:"Oversized Wool Jacket",     price:420, cat:"wool",    sw:SW.a, img:U("1591047139829-d91aecb6caea") },
    { name:"Waxed Cotton Field Jacket", price:400, badge:"Sold out", cat:"field",   sw:SW.d, img:U("1548624149-f9061a9a2151") },
    { name:"Classic Denim Jacket",      price:380, cat:"denim",   sw:SW.c, img:U("1544966503-7ba532cb2513") },
  ];
  const fresh = ["Oversized Wool Jacket","Shearling Aviator Jacket","Camel Wool Jacket","Classic Denim Jacket"]
    .map(n => ({ ...products.find(p => p.name === n), badge:"New" }));

  const reviews = [
    ["Amelia R.","Camel Wool Jacket",5,"Even better in person. The wool feels heavy and warm without being bulky, and the tailoring around the shoulders is excellent."],
    ["James T.","Cropped Leather Jacket",5,"Worn almost daily since it arrived. The leather has started to soften nicely and the stitching feels genuinely well made."],
    ["Priya N.","Waxed Cotton Field Jacket",4,"Beautiful jacket and fast shipping. Sizing runs slightly large, so go down a size if you're between two."],
    ["Daniel K.","Oversized Wool Jacket",5,"On another level compared to mass-market stuff. Thick, warm, holds its shape after washing. Worth every dollar."],
    ["Sofia M.","Quilted Field Jacket",5,"Ordered for fall hikes and it's held up through wind and light rain. The quilting pattern is a nice touch too."],
    ["Marcus L.","Classic Denim Jacket",5,"Perfect weight for layering. Fades beautifully and the fit is exactly what I wanted."],
  ];

  /* ---------- loader ---------- */
  const loader = $('#loader'), lbar = $('#lbar'), lcount = $('#lcount');
  let readyDone = false;
  function ready() {
    if (readyDone) return; readyDone = true;
    lbar.style.transform = 'scaleX(1)'; lcount.textContent = '100';
    setTimeout(() => loader.classList.add('go'), 150);
    setTimeout(() => { document.documentElement.classList.add('ready'); ScrollTrigger.refresh(); }, 450);
    setTimeout(() => { loader.remove(); ScrollTrigger.refresh(); }, 1600);
  }
  if (reduce) { loader.remove(); document.documentElement.classList.add('ready'); readyDone = true; }
  else {
    const t0 = performance.now();
    (function prog(t) {
      if (readyDone) return;
      const k = clamp((t - t0) / 1500) * .92;
      lbar.style.transform = `scaleX(${k})`; lcount.textContent = String(Math.round(k * 100)).padStart(3, '0');
      requestAnimationFrame(prog);
    })(t0);
    const go = () => setTimeout(ready, Math.max(0, 1500 - (performance.now() - t0)));
    document.readyState === 'complete' ? go() : addEventListener('load', go);
    setTimeout(ready, 4500);
  }

  /* ---------- builders ---------- */
  const price = (p) => p.old ? `<span class="text-brick mr-2">$${p.price.toFixed(2)}</span><span class="line-through text-ink/40">$${p.old.toFixed(2)}</span>` : `$${p.price.toFixed(2)}`;
  const card = (p, cls = '') => {
    const out = p.badge === 'Sold out';
    return `
    <a href="${SHOP}" class="pc group block ${cls} ${out ? 'is-out' : ''}">
      <div class="c3d" style="transform-style:preserve-3d;will-change:transform">
        <div class="tilt relative overflow-hidden rounded-2xl bg-sand aspect-[3/4]">
          <img loading="lazy" src="${p.img}" alt="${p.name}" class="card-img absolute inset-0 w-full h-full object-cover" onerror="imgFail(this)">
          ${p.badge ? `<span class="absolute top-3 left-3 z-10 rounded-full text-[10px] font-mono uppercase tracking-tag px-3 py-1 ${p.badge === 'Sale' ? 'bg-brick text-paper' : p.badge === 'New' ? 'bg-ink text-paper' : 'bg-white text-ink/70'}">${p.badge}</span>` : ''}
          <span class="absolute inset-x-3 bottom-3 z-10 translate-y-[140%] group-hover:translate-y-0 transition duration-500 glass-d rounded-full text-paper text-[10px] font-mono uppercase tracking-tag text-center py-3">${out ? 'Sold out' : 'View jacket →'}</span>
        </div>
        <div class="pt-3 flex flex-col gap-1.5 sm:flex-row sm:items-start sm:justify-between sm:gap-3">
          <div>
            <p class="text-[14px] font-display-sm mb-1.5">${p.name}</p>
            <div class="flex items-center gap-1.5">${p.sw.map(c => `<span class="w-2.5 h-2.5 rounded-full border border-ink/10" style="background:${c}"></span>`).join('')}</div>
          </div>
          <p class="text-[13px] font-mono whitespace-nowrap">${price(p)}</p>
        </div>
      </div>
    </a>`;
  };
  const stars = (n) => [0,1,2,3,4].map(k => `<span style="color:${k < n ? '#9A3D28' : 'rgba(28,26,22,.2)'}">★</span>`).join('');

  $('#hsTrack').innerHTML = fresh.map(p => card(p, 'hs-card')).join('');
  $('#tick').innerHTML = Array(2).fill(['Free shipping over $150','Small-batch made','Portland · Est. 2016','New: Capsule № 04','30-day returns','Cut once, worn for years'].map(t => `<span>✦ ${t}</span>`).join('')).join('');

  /* ---------- filters + grid ---------- */
  const filters = ["all","leather","denim","field","wool"], fEl = $('#filters'), bar = $('#tabBar');
  fEl.insertAdjacentHTML('beforeend', filters.map((f, i) => `<button data-f="${f}" class="tab ${i ? '' : 'active'} text-[11px] font-mono uppercase tracking-tag">${f}</button>`).join(''));
  const moveBar = (b) => { bar.style.left = b.offsetLeft + 'px'; bar.style.width = b.offsetWidth + 'px'; };

  const grid = $('#grid');
  let gridTriggers = [];
  function renderGrid(f = 'all') {
    gridTriggers.forEach(t => t.kill()); gridTriggers = [];
    grid.innerHTML = products.filter(p => f === 'all' || p.cat === f).map(p => card(p)).join('');
    const cards = [...grid.querySelectorAll('.pc')];
    bindTilt(grid);
    if (reduce) return;
    gsap.set(cards, { opacity: 0, y: 70, rotateX: -35, transformOrigin: '50% 0%' });
    gridTriggers = ScrollTrigger.batch(cards, {
      start: 'top 92%', once: true,
      onEnter: (b) => gsap.to(b, { opacity: 1, y: 0, rotateX: 0, duration: 1.1, ease: 'power3.out', stagger: .09 })
    });
    ScrollTrigger.refresh();
  }
  fEl.addEventListener('click', (e) => {
    const b = e.target.closest('.tab'); if (!b) return;
    fEl.querySelectorAll('.tab').forEach(x => x.classList.remove('active'));
    b.classList.add('active'); moveBar(b);
    gsap.to(grid, { opacity: 0, y: 10, duration: .25, onComplete: () => { renderGrid(b.dataset.f); gsap.to(grid, { opacity: 1, y: 0, duration: .3 }); } });
  });

  /* ---------- hover tilt ---------- */
  function bindTilt(root) {
    if (!canHover || reduce) return;
    root.querySelectorAll('.tilt:not([data-t])').forEach(el => {
      el.dataset.t = 1;
      el.addEventListener('pointermove', (e) => {
        const r = el.getBoundingClientRect(), px = (e.clientX - r.left) / r.width, py = (e.clientY - r.top) / r.height;
        el.classList.add('moving');
        el.style.setProperty('--rx', ((.5 - py) * 9).toFixed(2) + 'deg');
        el.style.setProperty('--ry', ((px - .5) * 11).toFixed(2) + 'deg');
        el.style.setProperty('--mx', (px * 100).toFixed(1) + '%');
        el.style.setProperty('--my', (py * 100).toFixed(1) + '%');
      });
      el.addEventListener('pointerleave', () => { el.classList.remove('moving'); el.style.setProperty('--rx', '0deg'); el.style.setProperty('--ry', '0deg'); });
    });
  }

  /* ---------- statement words ---------- */
  const wEl = $('#words');
  wEl.innerHTML = wEl.textContent.split(' ').map(w => `<span class="w">${w}</span>`).join(' ');
  const wSpans = [...wEl.querySelectorAll('.w')];

  /* ---------- footer mark ---------- */
  const mark = $('#bigMark'), markTxt = mark.firstElementChild;
  markTxt.innerHTML = [...markTxt.textContent].map((c, i) => `<span class="ch" style="--k:${i}">${c === ' ' ? '&nbsp;' : c}</span>`).join('');

  /* ---------- big marquee ---------- */
  const mqEl = $('#mq');
  mqEl.innerHTML = `<span class="mq-i">Cut once</span><i class="mq-d"></i><span class="mq-i out">Worn for years</span><i class="mq-d"></i><span class="mq-i">Small batches</span><i class="mq-d"></i><span class="mq-i out">Portland, since 2016</span><i class="mq-d"></i>`.repeat(4);
  let mqW = 0, mqX = 0;

  /* ---------- 3D DECK (built from products) ---------- */
  const deckList = [products[5], products[1], products[0], products[4], products[3]];
  const deckWrap = $('#deckWrap');
  deckWrap.innerHTML = deckList.map(p => `
    <div class="dk absolute inset-0 rounded-2xl overflow-hidden bg-sand" style="box-shadow:0 30px 60px -20px rgba(0,0,0,.6)">
      <img src="${p.img}" alt="${p.name}" class="w-full h-full object-cover" onerror="imgFail(this)">
      <div class="absolute inset-x-0 bottom-0 p-4 bg-gradient-to-t from-black/75 to-transparent text-paper">
        <p class="font-display-sm text-lg leading-tight">${p.name}</p>
        <p class="text-[11px] font-mono mt-1 opacity-80">$${p.price}.00</p>
      </div>
    </div>`).join('');

  /* ---------- 3D REVIEW CYLINDER ---------- */
  const ring = $('#ring'), n = reviews.length;
  ring.innerHTML = reviews.map(([nm, item, rate, text]) => `
    <figure class="rcard absolute inset-0 rounded-3xl bg-white p-6 text-left border border-ink/5 flex flex-col justify-between" style="box-shadow:0 30px 60px -30px rgba(0,0,0,.25)">
      <div><div class="tracking-widest text-sm mb-4">${stars(rate)}</div>
      <blockquote class="font-display-sm text-[16px] md:text-[17px] leading-snug">“${text}”</blockquote></div>
      <figcaption class="text-[10px] font-mono uppercase tracking-tag text-ink/50 mt-4">${nm} — ${item}</figcaption>
    </figure>`).join('');
  function placeRing() {
    const cw = ring.clientWidth, r = Math.round((cw / 2) / Math.tan(Math.PI / n) + 50);
    ring.querySelectorAll('.rcard').forEach((c, i) => { c.style.transform = `rotateY(${i * 360 / n}deg) translateZ(${r}px)`; });
  }
  placeRing();

  /* ---------- reveal / counters ---------- */
  const io = new IntersectionObserver((es) => es.forEach(e => {
    if (!e.isIntersecting) return;
    e.target.classList.add('in'); io.unobserve(e.target);
    if (e.target === mark) setTimeout(() => mark.classList.add('done'), 2000);
  }), { threshold: .15, rootMargin: '0px 0px -6% 0px' });
  document.querySelectorAll('[data-r], .mask, [data-rule], .split, #bigMark').forEach(el => io.observe(el));

  function count(el) {
    if (el.dataset.done) return; el.dataset.done = 1;
    const end = parseFloat(el.dataset.count), dec = +(el.dataset.dec || 0), t0 = performance.now();
    (function tick(t) {
      const k = Math.min(1, (t - t0) / 1600), e = 1 - Math.pow(1 - k, 3);
      el.textContent = (end * e).toFixed(dec);
      if (k < 1) requestAnimationFrame(tick);
    })(t0);
  }
  const cio = new IntersectionObserver((es) => es.forEach(e => { if (e.isIntersecting) { count(e.target); cio.unobserve(e.target); } }), { threshold: .4 });
  document.querySelectorAll('[data-count]').forEach(el => cio.observe(el));

  renderGrid(); bindTilt(document);
  requestAnimationFrame(() => moveBar(fEl.querySelector('.tab.active')));

  /* ---------- sale countdown ---------- */
  const cdEls = { d:$('[data-u=d]'), h:$('[data-u=h]'), m:$('[data-u=m]'), s:$('[data-u=s]') };
  function cd() {
    const now = new Date(), end = new Date(now.getFullYear(), now.getMonth() + 1, 1), diff = Math.max(0, end - now);
    const v = { d:Math.floor(diff / 864e5), h:Math.floor(diff / 36e5) % 24, m:Math.floor(diff / 6e4) % 60, s:Math.floor(diff / 1e3) % 60 };
    for (const k in v) cdEls[k].textContent = String(v[k]).padStart(2, '0');
  }
  cd(); setInterval(cd, 1000);

  /* ---------- videos ---------- */
  const saveData = navigator.connection && navigator.connection.saveData;
  document.querySelectorAll('[data-vbox]').forEach(box => {
    const v = box.querySelector('video'); if (!v) return;
    if (reduce || saveData) { v.remove(); return; }
    const drop = () => v.remove();
    const srcs = [...v.querySelectorAll('source')];
    let failed = 0;
    srcs.forEach(s => s.addEventListener('error', () => { if (++failed === srcs.length) drop(); }));
    v.addEventListener('error', drop);
    v.addEventListener('playing', () => v.classList.add('on'), { once: true });
    setTimeout(() => { if (v.isConnected && !v.classList.contains('on') && v.paused) drop(); }, 12000);
    new IntersectionObserver(([en]) => {
      if (!v.isConnected) return;
      if (en.isIntersecting) { v.preload = 'auto'; v.play().catch(() => {}); } else v.pause();
    }, { threshold: .25 }).observe(box);
  });

  /* ---------- smooth scroll wired into ScrollTrigger ---------- */
  let lenis = null;
  if (window.Lenis && !reduce) {
    lenis = new Lenis({ duration: 1.2, easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)) });
    window.lenis = lenis;
    lenis.on('scroll', ScrollTrigger.update);
    gsap.ticker.add((t) => lenis.raf(t * 1000));
    gsap.ticker.lagSmoothing(0);
    document.querySelectorAll('a[href^="#"]:not([href="#"])').forEach(a => a.addEventListener('click', (e) => {
      const t = document.querySelector(a.getAttribute('href')); if (t) { e.preventDefault(); lenis.scrollTo(t, { offset: -70 }); }
    }));
  }

  /* ======================================================
     SCROLL SCENES
     ====================================================== */
  if (!reduce) {
    /* 1. HERO — pinned; scroll spins the 3D ring (Three.js reads window.__heroP) */
    ScrollTrigger.create({
      trigger: '#hero', start: 'top top', end: '+=150%', pin: true, scrub: true,
      onUpdate: (s) => { window.__heroP = s.progress; }
    });
    gsap.to('#heroC', { opacity: 0, y: -90, ease: 'none', scrollTrigger: { trigger: '#hero', start: 'top top', end: '+=55%', scrub: true } });
    gsap.to('#chip',  { opacity: 0, ease: 'none', scrollTrigger: { trigger: '#hero', start: 'top top', end: '+=40%', scrub: true } });

    /* 2. STATEMENT — each word flips up from 3D */
    gsap.fromTo(wSpans, { opacity: .14, y: 18, rotateX: -80 }, {
      opacity: 1, y: 0, rotateX: 0, stagger: .1, ease: 'none',
      scrollTrigger: { trigger: '#words', start: 'top 82%', end: 'bottom 45%', scrub: true }
    });

    /* 3. HORIZONTAL PRODUCTS — pinned; cards rotate in 3D depending on their position */
    const track = $('#hsTrack'), hsLine = $('#hsLine');
    const hsDist = () => Math.max(0, track.scrollWidth - document.documentElement.clientWidth);
    const c3d = [...track.querySelectorAll('.c3d')];
    function cards3d() {
      const mid = innerWidth / 2;
      c3d.forEach(el => {
        const r = el.getBoundingClientRect(), d = clamp(((r.left + r.width / 2) - mid) / innerWidth, -1, 1), a = Math.abs(d);
        el.style.transform = `perspective(1000px) rotateY(${(-d * 42).toFixed(2)}deg) translateZ(${(-a * 140).toFixed(1)}px) scale(${(1 - a * .12).toFixed(3)})`;
        el.style.opacity = (1 - a * .35).toFixed(2);
      });
    }
    gsap.to(track, {
      x: () => -hsDist(), ease: 'none',
      scrollTrigger: {
        trigger: '#hs', start: 'top top', end: () => '+=' + hsDist(), pin: true, scrub: true, invalidateOnRefresh: true,
        onUpdate: (s) => { hsLine.style.transform = `scaleX(${s.progress})`; cards3d(); },
        onRefresh: cards3d
      }
    });
    cards3d();

    /* 4. LOOKBOOK DECK — pinned; stacked 3D deck lays flat and fans out */
    const dk = [...deckWrap.querySelectorAll('.dk')], mid = (dk.length - 1) / 2;
    const spread = () => Math.min(innerWidth * .2, 300);
    const deckTl = gsap.timeline({ scrollTrigger: { trigger: '#deck', start: 'top top', end: '+=170%', pin: true, scrub: .8, invalidateOnRefresh: true } });
    deckTl.fromTo(deckWrap, { rotateX: 62, rotateZ: -22, scale: .85 }, { rotateX: 0, rotateZ: 0, scale: 1, ease: 'none', duration: 1 }, 0);
    deckTl.fromTo(dk,
      { x: 0, y: (i) => i * 16, z: (i) => -i * 55, rotateZ: (i) => (i - mid) * 4, rotateY: 0 },
      { x: (i) => (i - mid) * spread(), y: 0, z: 0, rotateZ: 0, rotateY: (i) => (i - mid) * -9, ease: 'power2.inOut', duration: 1 }, 0.1);

    /* 5. BENTO — tiles flip in from the top edge */
    gsap.set('.b3', { opacity: 0 });
    ScrollTrigger.batch('.b3', {
      start: 'top 90%', once: true,
      onEnter: (b) => gsap.fromTo(b,
        { opacity: 0, y: 90, rotateX: -32, transformPerspective: 900, transformOrigin: '50% 0%' },
        { opacity: 1, y: 0, rotateX: 0, duration: 1.15, ease: 'power3.out', stagger: .12 })
    });

    /* 6. PROMO — image un-tilts while the frame expands to full-bleed */
    gsap.fromTo('#grow', { clipPath: 'inset(10% 10% 10% 10% round 32px)' }, {
      clipPath: 'inset(0% 0% 0% 0% round 0px)', ease: 'none',
      scrollTrigger: { trigger: '#grow', start: 'top 88%', end: 'top 10%', scrub: true }
    });
    gsap.fromTo('#growImg', { rotateX: 22, scale: 1.3 }, {
      rotateX: 0, scale: 1.05, ease: 'none', transformPerspective: 1200,
      scrollTrigger: { trigger: '#grow', start: 'top 88%', end: 'bottom 30%', scrub: true }
    });

    /* 7. FEATURED + STORY — images swing in on a hinge */
    gsap.fromTo('#featWrap', { rotateY: -40, x: -80, opacity: .1 }, {
      rotateY: 0, x: 0, opacity: 1, ease: 'none',
      scrollTrigger: { trigger: '#featWrap', start: 'top 95%', end: 'top 35%', scrub: true }
    });
    gsap.fromTo('#storyWrap', { rotateY: 38, x: 80, opacity: .1 }, {
      rotateY: 0, x: 0, opacity: 1, ease: 'none',
      scrollTrigger: { trigger: '#storyWrap', start: 'top 95%', end: 'top 35%', scrub: true }
    });
    gsap.fromTo('#storyImg', { yPercent: -8 }, { yPercent: 8, ease: 'none', scrollTrigger: { trigger: '#storyWrap', start: 'top bottom', end: 'bottom top', scrub: true } });

    /* 8. REVIEWS — pinned; the cylinder spins as you scroll */
    gsap.fromTo(ring, { rotationY: 0 }, {
      rotationY: -300, ease: 'none',
      scrollTrigger: { trigger: '#rvs', start: 'top top', end: '+=220%', pin: true, scrub: true }
    });
    gsap.fromTo(ring, { rotationX: -10 }, { rotationX: 6, ease: 'none', scrollTrigger: { trigger: '#rvs', start: 'top top', end: '+=220%', scrub: true } });
  }

  /* ---------- pointer: cursor, peek, hero drift ---------- */
  const cur = $('#cur'), peek = $('#peek'), peekImg = peek.querySelector('img'), chip = $('#chip');
  let cx = innerWidth / 2, cy = innerHeight / 2, tx = cx, ty = cy, px = cx, py = cy, chipX = 0, chipY = 0, chipTX = 0, chipTY = 0;
  addEventListener('pointermove', (e) => {
    window.__mx = (e.clientX / innerWidth - .5) * 2;
    window.__my = (e.clientY / innerHeight - .5) * 2;
    tx = e.clientX; ty = e.clientY; cur.style.opacity = 1;
    chipTX = window.__mx * -22; chipTY = window.__my * -14;
  });
  if (canHover) {
    document.addEventListener('pointerover', (e) => { cur.classList.toggle('big', !!e.target.closest('a, button, .tilt')); });
    document.querySelectorAll('#peekList a').forEach(a => {
      a.addEventListener('pointerenter', () => { peekImg.src = a.dataset.img; peek.classList.add('on'); });
      a.addEventListener('pointerleave', () => peek.classList.remove('on'));
    });
  }

  /* ---------- magnetic buttons ---------- */
  if (canHover && !reduce) document.querySelectorAll('.mag').forEach(el => {
    el.addEventListener('mousemove', (e) => { const b = el.getBoundingClientRect(); el.style.transform = `translate(${(e.clientX - b.left - b.width / 2) * .18}px,${(e.clientY - b.top - b.height / 2) * .3}px)`; });
    el.addEventListener('mouseleave', () => el.style.transform = '');
  });

  /* ---------- sizes ---------- */
  const prog = $('#prog'), seal = $('#seal');
  const fitMark = () => { mark.style.fontSize = '100px'; const w = markTxt.getBoundingClientRect().width; mark.style.fontSize = (100 * mark.parentElement.clientWidth * .94 / w) + 'px'; };
  const measure = () => { mqW = mqEl.scrollWidth / 4; moveBar(fEl.querySelector('.tab.active')); fitMark(); placeRing(); };
  let lastW = innerWidth;
  addEventListener('resize', () => { if (innerWidth !== lastW) { lastW = innerWidth; measure(); ScrollTrigger.refresh(); } });
  addEventListener('load', () => { measure(); ScrollTrigger.refresh(); });
  if (document.fonts && document.fonts.ready) document.fonts.ready.then(() => { measure(); ScrollTrigger.refresh(); });
  measure();

  /* ---------- per-frame loop ---------- */
  let lastY = scrollY, sv = 0;
  gsap.ticker.add(() => {
    const y = scrollY, max = Math.max(1, document.documentElement.scrollHeight - innerHeight);
    sv += ((y - lastY) - sv) * .12; lastY = y;
    window.__sv = sv;
    prog.style.transform = `scaleX(${clamp(y / max)})`;
    if (reduce) return;

    if (mqW) {
      mqX -= .6 + Math.abs(sv) * .45 * Math.sign(sv || 1);
      if (mqX <= -mqW) mqX += mqW; if (mqX > 0) mqX -= mqW;
      mqEl.style.transform = `translate3d(${mqX}px,0,0)`;
    }
    seal.style.transform = `rotate(${y * .12}deg)`;

    cx = lerp(cx, tx, .22); cy = lerp(cy, ty, .22);
    cur.style.transform = `translate3d(${cx}px,${cy}px,0)`;
    px = lerp(px, tx, .12); py = lerp(py, ty, .12);
    peek.style.transform = `translate3d(${px + 28}px,${py - 150}px,0)`;
    chipX = lerp(chipX, chipTX, .06); chipY = lerp(chipY, chipTY, .06);
    if (chip) chip.style.transform = `translate3d(${chipX}px,${chipY}px,0)`;
  });
</script>
</body>
</html>