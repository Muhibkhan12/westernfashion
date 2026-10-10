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
    colors: { paper:'#FFFFFF', paperdeep:'#F4F4F4', ink:'#1C1A16', brick:'#9A3D28', sage:'#57624A', sand:'#E9E6E0', card:'#FFFFFF' },
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
  a:focus-visible, button:focus-visible, input:focus-visible, textarea:focus-visible { outline:1.5px solid #9A3D28; outline-offset:4px; }

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
  .mag { transition:transform .35s cubic-bezier(.2,.7,.2,1), background .3s, color .3s; }

  #prog { position:fixed; top:0; left:0; height:2px; width:100%; background:#9A3D28; transform-origin:left; transform:scaleX(0); z-index:90; pointer-events:none; }

  /* live status dot */
  .dot { display:inline-block; width:8px; height:8px; border-radius:50%; background:rgba(28,26,22,.25); position:relative; flex:none; }
  .dot.live { background:#57624A; }
  .dot.live::after { content:''; position:absolute; inset:0; border-radius:50%; background:#57624A; animation:ping 2s cubic-bezier(0,0,.2,1) infinite; }
  @keyframes ping { 0% { transform:scale(1); opacity:.6; } 80%,100% { transform:scale(3); opacity:0; } }

  /* form */
  .fld { position:relative; }
  .fld::after { content:''; position:absolute; left:0; right:0; bottom:0; height:1px; background:#1C1A16; transform:scaleX(0); transform-origin:left; transition:transform .6s cubic-bezier(.77,0,.18,1); }
  .fld:focus-within::after { transform:scaleX(1); }
  .fld-wrap.bad .fld::after { background:#9A3D28; transform:scaleX(1); }
  .field-input { background:transparent; border:none; border-bottom:1px solid rgba(28,26,22,.18); padding:12px 2px; font-size:16px; outline:none; width:100%; border-radius:0; appearance:none; -webkit-appearance:none; }
  @media (min-width:640px) { .field-input { font-size:15px; } }
  .field-input::placeholder { color:rgba(28,26,22,.35); }
  .field-label { font-size:11px; font-family:'Space Mono',monospace; text-transform:uppercase; letter-spacing:.1em; color:rgba(28,26,22,.5); margin-bottom:4px; display:flex; justify-content:space-between; transition:color .3s; }
  .fld-wrap:focus-within .field-label { color:#9A3D28; }
  .err { font-size:12px; color:#9A3D28; min-height:18px; margin-top:6px; }
  .shake { animation:shake .45s cubic-bezier(.36,.07,.19,.97); }
  @keyframes shake { 10%,90% { transform:translateX(-1px); } 20%,80% { transform:translateX(3px); } 30%,50%,70% { transform:translateX(-5px); } 40%,60% { transform:translateX(5px); } }

  /* topic chips */
  .topic input { position:absolute; opacity:0; pointer-events:none; }
  .topic label { display:inline-block; border:1px solid rgba(28,26,22,.2); padding:10px 15px; font:400 11px 'Space Mono',monospace; letter-spacing:.08em; text-transform:uppercase; cursor:pointer; transition:background .3s, color .3s, border-color .3s; }
  .topic label:hover { border-color:#1C1A16; }
  .topic input:checked + label { background:#1C1A16; color:#fff; border-color:#1C1A16; }
  .topic input:focus-visible + label { outline:1.5px solid #9A3D28; outline-offset:3px; }

  /* send button + success */
  .spin { width:12px; height:12px; border:1.5px solid currentColor; border-right-color:transparent; border-radius:50%; animation:spin .7s linear infinite; }
  @keyframes spin { to { transform:rotate(360deg); } }
  #formDone { display:none; }
  #formDone.show { display:block; }
  #formDone .ck circle { stroke-dasharray:151; stroke-dashoffset:151; animation:draw .9s cubic-bezier(.77,0,.18,1) .1s forwards; }
  #formDone .ck path { stroke-dasharray:40; stroke-dashoffset:40; animation:draw .6s cubic-bezier(.77,0,.18,1) .8s forwards; }
  @keyframes draw { to { stroke-dashoffset:0; } }
  #formDone .up { opacity:0; transform:translateY(14px); animation:fi .8s ease forwards, rise .8s cubic-bezier(.2,.7,.2,1) forwards; animation-delay:calc(.5s + var(--k) * .12s); }
  @keyframes rise { to { transform:none; } }

  /* info rows */
  .info { transition:padding .4s cubic-bezier(.2,.7,.2,1); } .info:hover { padding-left:12px; }

  /* accordion */
  .accordion-item .accordion-icon { transition:transform .4s cubic-bezier(.2,.7,.2,1); }
  .accordion-item.open .accordion-icon { transform:rotate(135deg); }
  .accordion-body { display:grid; grid-template-rows:0fr; opacity:0; transition:grid-template-rows .5s cubic-bezier(.2,.7,.2,1), opacity .4s ease; }
  .accordion-item.open .accordion-body { grid-template-rows:1fr; opacity:1; }
  .accordion-body-inner { overflow:hidden; }

  /* footer wordmark */
  .ch { display:inline-block; transform:translateY(70%); opacity:0; transition:transform 1s cubic-bezier(.2,.7,.2,1) calc(var(--k) * .045s), opacity .8s ease calc(var(--k) * .045s); }
  #bigMark.in .ch { transform:none; opacity:1; }

  @media (prefers-reduced-motion:reduce) {
    [data-r], .line > span, .fade-in { opacity:1; transform:none; animation:none; transition:none; } .rule { transform:none; }
    .ch { opacity:1; transform:none; transition:none; } .dot.live::after, .shake { animation:none; }
    #formDone .ck circle, #formDone .ck path { animation:none; stroke-dashoffset:0; } #formDone .up { animation:none; opacity:1; transform:none; }
  }
</style>
</head>
<body class="antialiased bg-white">

<div id="prog"></div>

@include('partials.header')

<!-- Intro -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 pt-20 md:pt-32 pb-16 md:pb-24">
  <p class="fade-in flex items-center gap-3 text-[11px] font-mono tracking-tag uppercase text-brick mb-8" style="--d:.2s"><span class="dot live"></span>Typically replies within one business day</p>
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
    <!-- To save messages: change the form to method="POST" action="{{ url('/contact') }}", add @csrf, and handle it in a controller. -->
    <form id="cform" class="space-y-8" novalidate>
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 sm:gap-6">
        <div class="fld-wrap" data-f="name">
          <label class="field-label" for="name">Name</label>
          <div class="fld"><input class="field-input" id="name" name="name" type="text" autocomplete="name" placeholder="Your full name"></div>
          <p class="err" aria-live="polite"></p>
        </div>
        <div class="fld-wrap" data-f="email">
          <label class="field-label" for="email">Email</label>
          <div class="fld"><input class="field-input" id="email" name="email" type="email" autocomplete="email" placeholder="you@example.com"></div>
          <p class="err" aria-live="polite"></p>
        </div>
      </div>

      <div class="fld-wrap" data-f="topic">
        <span class="field-label" id="topicLabel">What's this about</span>
        <div class="topic flex flex-wrap gap-2 pt-2" role="radiogroup" aria-labelledby="topicLabel">
          <span class="relative"><input type="radio" name="topic" id="t1" value="Order status"><label for="t1">Order status</label></span>
          <span class="relative"><input type="radio" name="topic" id="t2" value="Sizing help"><label for="t2">Sizing help</label></span>
          <span class="relative"><input type="radio" name="topic" id="t3" value="Repairs & care"><label for="t3">Repairs &amp; care</label></span>
          <span class="relative"><input type="radio" name="topic" id="t4" value="Wholesale & press"><label for="t4">Wholesale &amp; press</label></span>
          <span class="relative"><input type="radio" name="topic" id="t5" value="Something else"><label for="t5">Something else</label></span>
        </div>
        <p class="err" aria-live="polite"></p>
      </div>

      <div class="fld-wrap" data-f="message">
        <label class="field-label" for="message"><span>Message</span><span id="mcount" class="normal-case tracking-normal">0 / 600</span></label>
        <div class="fld"><textarea class="field-input resize-none" id="message" name="message" rows="5" maxlength="600" placeholder="Tell us what's going on"></textarea></div>
        <p class="err" aria-live="polite"></p>
      </div>

      <div>
        <button id="sendBtn" type="submit" class="mag group inline-flex items-center gap-3 bg-ink text-paper text-[11px] font-mono uppercase tracking-tag px-8 py-4 border border-ink hover:bg-transparent hover:text-ink min-w-[190px] justify-center">
          <span id="sendTxt">Send Message</span>
          <svg id="sendIco" class="transition-transform duration-300 group-hover:translate-x-0.5 group-hover:-translate-y-0.5" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
          <span id="sendSpin" class="spin hidden"></span>
        </button>
      </div>
    </form>

    <!-- Success state -->
    <div id="formDone" role="status" aria-live="polite">
      <svg class="ck mb-8" width="64" height="64" viewBox="0 0 64 64" fill="none" stroke="#57624A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <circle cx="32" cy="32" r="24" transform="rotate(-90 32 32)"/><path d="M22 33l7 7 13-14"/>
      </svg>
      <h2 class="up font-display text-3xl md:text-4xl leading-[1.1] mb-4" style="--k:0">Thanks, <span id="doneName"></span>. Message sent.</h2>
      <p class="up text-[14px] text-ink/65 leading-relaxed max-w-sm mb-2" style="--k:1">We'll reply to <span id="doneEmail" class="text-ink"></span> within one business day.</p>
      <p class="up text-[13px] text-ink/50 mb-8" style="--k:2">Topic: <span id="doneTopic"></span></p>
      <button id="again" type="button" class="up text-[11px] font-mono uppercase tracking-tag ul pb-0.5" style="--k:3">Send another message</button>
    </div>
  </div>

  <!-- Info -->
  <div class="md:col-span-5 md:col-start-8">
    <div class="rule" data-rule></div>
    <div class="info py-8" data-r>
      <p class="text-[10px] font-mono uppercase tracking-tag text-ink/50 mb-2">Email</p>
      <div class="flex flex-wrap items-center gap-x-4 gap-y-2">
        <a href="mailto:hello@thewesternfashion.com" class="text-[18px] font-display-sm ul pb-0.5">hello@thewesternfashion.com</a>
        <button id="copyMail" type="button" class="text-[10px] font-mono uppercase tracking-tag border border-ink/20 px-2.5 py-1 hover:border-ink transition-colors" aria-label="Copy email address">Copy</button>
      </div>
      <p class="text-[13px] text-ink/60 mt-3">General questions, order help, and sizing.</p>
    </div>
    <div class="rule" data-rule></div>
    <div class="info py-8" data-r>
      <p class="text-[10px] font-mono uppercase tracking-tag text-ink/50 mb-2">Phone</p>
      <a href="tel:+15035550142" class="text-[18px] font-display-sm ul pb-0.5">+1 (503) 555-0142</a>
      <p class="text-[13px] text-ink/60 mt-3">Monday–Friday, 9am–5pm Pacific.</p>
      <p class="flex items-center gap-2 text-[11px] font-mono uppercase tracking-tag mt-3"><span id="phoneDot" class="dot"></span><span id="phoneStatus" class="text-ink/60"></span></p>
    </div>
    <div class="rule" data-rule></div>
    <div class="info py-8" data-r>
      <p class="text-[10px] font-mono uppercase tracking-tag text-ink/50 mb-2">Workshop &amp; Showroom</p>
      <p class="text-[18px] font-display-sm">2114 SE Division St, Portland, OR 97202</p>
      <p class="text-[13px] text-ink/60 mt-3">Open Thursday–Saturday, 11am–6pm. Fittings by appointment.</p>
      <p class="flex items-center gap-2 text-[11px] font-mono uppercase tracking-tag mt-3"><span id="shopDot" class="dot"></span><span id="shopStatus" class="text-ink/60"></span></p>
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

<!-- Map: grows full-bleed on scroll -->
<section class="mb-24 md:mb-40">
  <div id="grow" class="relative h-[60vh] min-h-[380px] overflow-hidden bg-sand" style="clip-path:inset(10% 10% 10% 10%)">
    <iframe title="Map showing the workshop at 2114 SE Division St, Portland" class="absolute inset-0 w-full h-full border-0 pointer-events-none" style="filter:grayscale(1) contrast(1.05)" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
      src="https://www.google.com/maps?q=2114+SE+Division+St,+Portland,+OR+97202&output=embed"></iframe>
    <div class="absolute inset-0 bg-black/10 pointer-events-none"></div>
    <div class="relative z-10 h-full flex items-center justify-center px-6 pointer-events-none">
      <div class="bg-white px-8 py-7 text-center pointer-events-auto shadow-sm" data-r>
        <p class="text-[10px] font-mono uppercase tracking-tag text-ink/50 mb-2">Find us</p>
        <p class="text-[16px] font-display-sm mb-4">2114 SE Division St, Portland, OR</p>
        <a href="https://www.google.com/maps/dir/?api=1&destination=2114+SE+Division+St,+Portland,+OR+97202" target="_blank" rel="noopener" class="text-[11px] font-mono uppercase tracking-tag ul pb-0.5">Get Directions ↗</a>
      </div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 pb-24 md:pb-36 grid grid-cols-1 md:grid-cols-12 gap-12 md:gap-8">
  <div class="md:col-span-4" data-r>
    <p class="text-[11px] font-mono tracking-tag uppercase text-brick mb-4">Before you write in</p>
    <h2 class="font-display text-3xl md:text-5xl leading-[1.1] max-w-sm mb-6">A few things we get asked often.</h2>
    <p class="text-[14px] text-ink/60 leading-relaxed max-w-xs">Not here? <a href="mailto:hello@thewesternfashion.com" class="ul text-ink pb-0.5">Email us</a> and a person will answer.</p>
  </div>

  <div id="accordion" class="md:col-span-7 md:col-start-6">
    <div class="rule" data-rule></div>
    <div class="accordion-item">
      <button class="w-full flex items-center justify-between text-left py-7" data-toggle aria-expanded="false">
        <span class="text-[18px] font-display-sm pr-4">How long does a repair take?</span>
        <svg class="accordion-icon shrink-0" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
      </button>
      <div class="accordion-body"><div class="accordion-body-inner">
        <p class="text-[14px] text-ink/65 leading-relaxed pb-7 max-w-lg">Most repairs (re-linings, hardware swaps, patch work) take two to three weeks once your jacket reaches the workshop. We'll email you a quote before starting any work.</p>
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
  <p id="bigMark" class="font-display uppercase text-center leading-none whitespace-nowrap select-none text-ink/90" style="letter-spacing:.04em"><span class="inline-block">The Western Fashion</span></p>
  <div class="py-6 text-center text-[11px] font-mono text-ink/40 tracking-tag uppercase">© {{ date('Y') }} The Western Fashion. All rights reserved.</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/lenis@1.1.18/dist/lenis.min.js"></script>
<script>
  const $ = (s) => document.querySelector(s);
  const clamp = (v, a = 0, b = 1) => Math.min(b, Math.max(a, v));
  const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------- form: validate, send, success ---------- */
  const form = $('#cform'), done = $('#formDone'), msg = $('#message');
  const rules = {
    name:    (v) => v.trim().length >= 2 ? '' : 'Please enter your name.',
    email:   (v) => /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v.trim()) ? '' : 'Enter a valid email, like you@example.com.',
    topic:   (v) => v ? '' : 'Choose what this is about.',
    message: (v) => v.trim().length >= 10 ? '' : 'Tell us a little more (at least 10 characters).',
  };
  const val = (k) => k === 'topic' ? (form.querySelector('input[name="topic"]:checked') || {}).value || '' : form.elements[k].value;
  function check(k, shake) {
    const wrap = form.querySelector(`[data-f="${k}"]`), err = rules[k](val(k));
    wrap.classList.toggle('bad', !!err);
    wrap.querySelector('.err').textContent = err;
    if (err && shake && !reduce) { wrap.classList.remove('shake'); void wrap.offsetWidth; wrap.classList.add('shake'); }
    return !err;
  }
  Object.keys(rules).forEach(k => {
    const el = k === 'topic' ? form.querySelectorAll('input[name="topic"]') : [form.elements[k]];
    el.forEach(i => { i.addEventListener('blur', () => { if (val(k) || form.querySelector(`[data-f="${k}"]`).classList.contains('bad')) check(k); }); i.addEventListener('input', () => { if (form.querySelector(`[data-f="${k}"]`).classList.contains('bad')) check(k); }); i.addEventListener('change', () => { if (form.querySelector(`[data-f="${k}"]`).classList.contains('bad')) check(k); }); });
  });
  msg.addEventListener('input', () => { $('#mcount').textContent = `${msg.value.length} / 600`; });

  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const results = Object.keys(rules).map(k => check(k, true));
    const firstBad = Object.keys(rules).find((k, i) => !results[i]);
    if (firstBad) { (k => k === 'topic' ? form.querySelector('input[name="topic"]') : form.elements[k])(firstBad).focus({ preventScroll: false }); return; }

    const btn = $('#sendBtn');
    btn.disabled = true; $('#sendTxt').textContent = 'Sending'; $('#sendIco').classList.add('hidden'); $('#sendSpin').classList.remove('hidden');

    /* Replace this timeout with a real request (fetch POST to your controller) when you're ready to save messages. */
    setTimeout(() => {
      $('#doneName').textContent = form.elements.name.value.trim().split(' ')[0];
      $('#doneEmail').textContent = form.elements.email.value.trim();
      $('#doneTopic').textContent = val('topic');
      form.hidden = true; done.classList.add('show');
      btn.disabled = false; $('#sendTxt').textContent = 'Send Message'; $('#sendIco').classList.remove('hidden'); $('#sendSpin').classList.add('hidden');
    }, 1100);
  });
  $('#again').addEventListener('click', () => {
    form.reset(); $('#mcount').textContent = '0 / 600';
    form.querySelectorAll('.fld-wrap').forEach(w => { w.classList.remove('bad'); const er = w.querySelector('.err'); if (er) er.textContent = ''; });
    done.classList.remove('show'); form.hidden = false; form.elements.name.focus();
  });

  /* ---------- copy email ---------- */
  $('#copyMail').addEventListener('click', async (e) => {
    const b = e.currentTarget;
    try { await navigator.clipboard.writeText('hello@thewesternfashion.com'); b.textContent = 'Copied'; }
    catch { b.textContent = 'Press Ctrl+C'; }
    setTimeout(() => b.textContent = 'Copy', 1800);
  });

  /* ---------- live open / closed (Portland time) ---------- */
  function pdx() {
    const parts = Object.fromEntries(new Intl.DateTimeFormat('en-US', { timeZone: 'America/Los_Angeles', weekday: 'short', hour: 'numeric', minute: 'numeric', hour12: false }).formatToParts(new Date()).map(x => [x.type, x.value]));
    return { day: parts.weekday, t: (+parts.hour % 24) + (+parts.minute) / 60 };
  }
  function status() {
    const { day, t } = pdx();
    const phone = ['Mon','Tue','Wed','Thu','Fri'].includes(day) && t >= 9 && t < 17;
    const shop = ['Thu','Fri','Sat'].includes(day) && t >= 11 && t < 18;
    [['phone', phone, 'Open now, closes 5pm PT', 'Closed right now'], ['shop', shop, 'Open now, closes 6pm PT', 'Closed right now']].forEach(([id, open, yes, no]) => {
      $('#' + id + 'Dot').classList.toggle('live', open);
      $('#' + id + 'Status').textContent = open ? yes : no;
    });
  }
  status(); setInterval(status, 60000);

  /* ---------- accordion (one open at a time) ---------- */
  document.querySelectorAll('[data-toggle]').forEach((btn, i) => {
    const body = btn.nextElementSibling; btn.id = 'q' + i; body.id = 'a' + i;
    btn.setAttribute('aria-controls', body.id); body.setAttribute('role', 'region'); body.setAttribute('aria-labelledby', btn.id);
    btn.addEventListener('click', () => {
      const item = btn.closest('.accordion-item'), wasOpen = item.classList.contains('open');
      document.querySelectorAll('.accordion-item').forEach(x => { x.classList.remove('open'); x.querySelector('[data-toggle]').setAttribute('aria-expanded', 'false'); });
      if (!wasOpen) { item.classList.add('open'); btn.setAttribute('aria-expanded', 'true'); }
    });
  });

  /* ---------- footer wordmark ---------- */
  const mark = $('#bigMark'), markTxt = mark.firstElementChild;
  markTxt.innerHTML = [...markTxt.textContent].map((c, i) => `<span class="ch" style="--k:${i}">${c === ' ' ? '&nbsp;' : c}</span>`).join('');
  const fitMark = () => { mark.style.fontSize = '100px'; const w = markTxt.getBoundingClientRect().width; mark.style.fontSize = (100 * mark.parentElement.clientWidth * .94 / w) + 'px'; };
  let lastW = innerWidth;
  addEventListener('resize', () => { if (innerWidth !== lastW) { lastW = innerWidth; fitMark(); } });
  addEventListener('load', fitMark);
  if (document.fonts && document.fonts.ready) document.fonts.ready.then(fitMark);
  fitMark();

  /* ---------- reveals ---------- */
  const io = new IntersectionObserver((es) => es.forEach(e => {
    if (!e.isIntersecting) return;
    e.target.classList.add('in'); io.unobserve(e.target);
  }), { threshold: .15, rootMargin: '0px 0px -6% 0px' });
  document.querySelectorAll('[data-r], [data-rule], #bigMark').forEach(el => io.observe(el));

  /* ---------- smooth scroll (exposed so the header menu can pause it) ---------- */
  let lenis = null;
  if (window.Lenis && !reduce) {
    lenis = new Lenis({ duration: 1.25, easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)) });
    window.lenis = lenis;
    document.querySelectorAll('a[href^="#"]:not([href="#"])').forEach(a => a.addEventListener('click', (e) => {
      const t = document.querySelector(a.getAttribute('href')); if (t) { e.preventDefault(); lenis.scrollTo(t, { offset: -70 }); }
    }));
  }

  /* ---------- scroll-driven: progress + map grows ---------- */
  const grow = $('#grow'), prog = $('#prog');
  function update() {
    const y = scrollY, vh = innerHeight, max = Math.max(1, document.documentElement.scrollHeight - vh);
    prog.style.transform = `scaleX(${clamp(y / max)})`;
    const g = grow.getBoundingClientRect(), gp = clamp((vh - g.top) / (vh * .8)), ins = (1 - gp) * 10;
    grow.style.clipPath = `inset(${ins}% ${ins}% ${ins}% ${ins}%)`;
  }
  (function raf(t) { lenis && lenis.raf(t); update(); requestAnimationFrame(raf); })(0);

  /* ---------- magnetic buttons ---------- */
  if (matchMedia('(hover:hover)').matches && !reduce) document.querySelectorAll('.mag').forEach(el => {
    el.addEventListener('mousemove', (e) => { if (el.disabled) return; const b = el.getBoundingClientRect(); el.style.transform = `translate(${(e.clientX - b.left - b.width / 2) * .18}px,${(e.clientY - b.top - b.height / 2) * .3}px)`; });
    el.addEventListener('mouseleave', () => el.style.transform = '');
  });
</script>
</body>
</html>