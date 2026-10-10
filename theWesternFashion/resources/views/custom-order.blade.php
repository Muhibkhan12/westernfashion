<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Custom Order — The Western Fashion</title>
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
  a:focus-visible, button:focus-visible, input:focus-visible, select:focus-visible, textarea:focus-visible { outline:1.5px solid #9A3D28; outline-offset:4px; }

  .ul { background-image:linear-gradient(currentColor,currentColor); background-position:0 100%; background-repeat:no-repeat; background-size:0% 1px; transition:background-size .4s cubic-bezier(.2,.7,.2,1); }
  .ul:hover, .ul.on { background-size:100% 1px; }
  .t-hero { font-size:clamp(2.4rem,7.5vw,5.5rem); }
  .t-h2 { font-size:clamp(1.9rem,4.6vw,3rem); }

  /* reveals */
  [data-r] { opacity:0; transform:translateY(24px); transition:opacity .9s cubic-bezier(.2,.7,.2,1) var(--d,0s), transform .9s cubic-bezier(.2,.7,.2,1) var(--d,0s); }
  [data-r].in { opacity:1; transform:none; }
  .line { display:block; overflow:hidden; padding-bottom:.1em; }
  .line > span { display:block; transform:translateY(110%) rotate(3deg); transform-origin:left; animation:up 1.1s cubic-bezier(.2,.7,.2,1) forwards; animation-delay:calc(.2s + var(--i) * .14s); }
  @keyframes up { to { transform:none; } }
  .fade-in { opacity:0; animation:fi 1s ease forwards; animation-delay:var(--d,0s); } @keyframes fi { to { opacity:1; } }
  .mag { transition:transform .35s cubic-bezier(.2,.7,.2,1), background .3s, color .3s, opacity .3s; }

  /* wizard */
  .step { display:none; } .step.on { display:block; animation:stepIn .6s cubic-bezier(.2,.7,.2,1) both; }
  @keyframes stepIn { from { opacity:0; transform:translateY(14px); } }
  #bar { transform-origin:left; transition:transform .7s cubic-bezier(.77,0,.18,1); }
  .stlab { color:rgba(28,26,22,.35); transition:color .4s; } .stlab.on { color:#1C1A16; } .stlab.done { color:#9A3D28; }

  /* fields */
  .fld { position:relative; }
  .fld::after { content:''; position:absolute; left:0; right:0; bottom:0; height:1px; background:#1C1A16; transform:scaleX(0); transform-origin:left; transition:transform .6s cubic-bezier(.77,0,.18,1); }
  .fld:focus-within::after { transform:scaleX(1); }
  .field-input { background:transparent; border:none; border-bottom:1px solid rgba(28,26,22,.18); padding:12px 2px; font-size:16px; outline:none; width:100%; border-radius:0; -webkit-appearance:none; appearance:none; }
  .field-input::placeholder { color:rgba(28,26,22,.35); }
  .field-input:disabled { opacity:.4; }
  @media (min-width:640px) { .field-input { font-size:15px; } }
  .flabel { font:11px 'Space Mono',monospace; text-transform:uppercase; letter-spacing:.1em; color:rgba(28,26,22,.5); display:block; margin-bottom:4px; transition:color .3s; }
  .fw:focus-within .flabel { color:#9A3D28; }
  .err { font:11px 'Space Mono',monospace; color:#9A3D28; margin-top:8px; }
  .has-err .field-input { border-bottom-color:#9A3D28; }

  /* option chips + swatches (real radio inputs, visually restyled) */
  .opt { position:relative; display:inline-flex; }
  .opt input { position:absolute; inset:0; opacity:0; cursor:pointer; width:100%; height:100%; margin:0; }
  .opt span { border:1px solid rgba(28,26,22,.2); padding:11px 16px; font:11px 'Space Mono',monospace; text-transform:uppercase; letter-spacing:.1em; transition:background .25s, color .25s, border-color .25s; }
  .opt:hover span { border-color:#1C1A16; }
  .opt input:checked + span { background:#1C1A16; color:#fff; border-color:#1C1A16; }
  .opt input:focus-visible + span { outline:1.5px solid #9A3D28; outline-offset:3px; }
  .sw { position:relative; display:inline-block; }
  .sw input { position:absolute; inset:-6px; opacity:0; cursor:pointer; width:calc(100% + 12px); height:calc(100% + 12px); margin:0; }
  .sw i { display:block; width:30px; height:30px; border-radius:50%; border:1.5px solid rgba(28,26,22,.15); position:relative; transition:transform .3s cubic-bezier(.2,.7,.2,1); }
  .sw:hover i { transform:scale(1.1); }
  .sw i::after { content:''; position:absolute; inset:-5px; border:1.5px solid #1C1A16; border-radius:50%; transform:scale(.7); opacity:0; transition:transform .35s cubic-bezier(.2,.7,.2,1), opacity .25s; }
  .sw input:checked + i::after { transform:none; opacity:1; }
  .sw input:focus-visible + i { outline:1.5px solid #9A3D28; outline-offset:6px; }

  /* uploads */
  #drop.drag { background:rgba(154,61,40,.05); border-color:#9A3D28; }
  .hp { position:absolute; left:-9999px; width:1px; height:1px; overflow:hidden; }

  .cta { transition:background .3s, color .3s, opacity .3s, transform .3s cubic-bezier(.2,.7,.2,1); }
  .cta:not(:disabled):active { transform:scale(.985); }
  input[type="email"], input[type="tel"] { font-size:16px; } @media (min-width:640px) { input[type="email"], input[type="tel"] { font-size:15px; } }
  .rule { height:1px; background:rgba(28,26,22,.12); transform-origin:left; transform:scaleX(0); transition:transform 1.2s cubic-bezier(.77,0,.18,1); } .rule.in { transform:scaleX(1); }

  @media (prefers-reduced-motion:reduce) {
    [data-r], .line > span, .fade-in { opacity:1; transform:none; animation:none; transition:none; } .step.on { animation:none; } #bar, .rule { transition:none; } .rule { transform:none; }
  }
</style>
</head>
<body class="antialiased bg-white">

@include('partials.header')

@php
  $done = session('custom_order_number');
  $old  = fn ($k, $d = null) => old($k, $d);
  $u    = $user;
@endphp

<!-- Intro -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 pt-14 md:pt-24 pb-10 md:pb-16">
  <p class="fade-in text-[11px] font-mono tracking-tag uppercase text-brick mb-8" style="--d:.1s">Custom orders</p>
  <h1 class="t-hero font-display leading-[1.02] max-w-4xl">
    <span class="line" style="--i:0"><span>A jacket made</span></span>
    <span class="line" style="--i:1"><span>only for <em class="italic">you</em></span></span>
  </h1>
  <p class="fade-in text-[14px] md:text-[15px] text-ink/65 leading-relaxed max-w-lg mt-8" style="--d:.8s">
    Tell us what you have in mind: the style, the cloth, the fit. We'll review your request and reply with a quote and timing before anything is cut.
  </p>
</section>

@if ($done)
  <!-- Success -->
  <section class="max-w-[1440px] mx-auto px-6 md:px-10 pb-24 md:pb-36">
    <div class="rule mb-12" data-rule></div>
    <div class="max-w-2xl" data-r>
      <p class="text-[11px] font-mono tracking-tag uppercase text-sage mb-4">Request received</p>
      <h2 class="t-h2 font-display leading-[1.1] mb-6">Thank you — we'll be in touch.</h2>
      <p class="text-[14px] text-ink/65 leading-relaxed mb-8">
        Your request <span class="font-mono text-ink">{{ $done }}</span> is with us. We typically reply within one business day
        @if (session('custom_order_email')) at <span class="text-ink">{{ session('custom_order_email') }}</span>@endif
        with questions, a quote and timing.
      </p>
      <div class="flex flex-wrap items-center gap-x-8 gap-y-4">
        <a href="{{ route('shop.products') }}" class="mag bg-ink text-paper text-[11px] font-mono uppercase tracking-tag px-8 py-4 border border-ink hover:bg-transparent hover:text-ink">Browse jackets</a>
        <a href="{{ route('custom-order.create') }}" class="text-[11px] font-mono uppercase tracking-tag ul pb-0.5">Start another request</a>
      </div>
    </div>
  </section>
@else

<!-- Form -->
<section class="max-w-[1440px] mx-auto px-6 md:px-10 pb-24 md:pb-36 grid grid-cols-1 lg:grid-cols-12 gap-14 lg:gap-8">

  <div class="lg:col-span-7 min-w-0">

    <!-- progress -->
    <div class="mb-10" data-r>
      <div class="h-px bg-ink/10 mb-4"><div id="bar" class="h-px bg-brick" style="transform:scaleX(.25)"></div></div>
      <div class="flex justify-between text-[11px] font-mono uppercase tracking-tag">
        <span class="stlab on">Design</span><span class="stlab">Fit</span><span class="stlab">Details</span><span class="stlab">Contact</span>
      </div>
    </div>

    <form id="co" method="POST" action="{{ route('custom-order.store') }}" enctype="multipart/form-data" novalidate>
      @csrf
      <div class="hp" aria-hidden="true"><label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>

      <!-- STEP 1 — Design -->
      <div class="step on space-y-10" data-step="0">
        <div>
          <h2 class="font-display text-2xl md:text-3xl mb-1">What are we making?</h2>
          <p class="text-[13px] text-ink/55">Pick the closest style. You can describe anything special later.</p>
        </div>

        <div class="@error('style') has-err @enderror">
          <p class="flabel mb-3">Style</p>
          <div class="flex flex-wrap gap-2">
            @foreach ($styles as $s)
              <label class="opt"><input type="radio" name="style" value="{{ $s }}" required @checked($old('style') === $s)><span>{{ $s }}</span></label>
            @endforeach
          </div>
          @error('style') <p class="err" data-error>{{ $message }}</p> @enderror
        </div>

        <div class="@error('material') has-err @enderror">
          <p class="flabel mb-3">Material</p>
          <div class="flex flex-wrap gap-2">
            @foreach ($materials as $m)
              <label class="opt"><input type="radio" name="material" value="{{ $m }}" required @checked($old('material') === $m)><span>{{ $m }}</span></label>
            @endforeach
          </div>
          @error('material') <p class="err" data-error>{{ $message }}</p> @enderror
        </div>

        <div class="@error('color') has-err @enderror @error('color_other') has-err @enderror">
          <p class="flabel mb-4">Color</p>
          <div class="flex flex-wrap items-center gap-x-6 gap-y-4 p-1">
            @foreach ($colors as $name => $hex)
              <label class="sw" title="{{ $name }}"><input type="radio" name="color" value="{{ $name }}" required aria-label="{{ $name }}" @checked($old('color') === $name)><i style="background:{{ $hex }}"></i></label>
            @endforeach
            <label class="opt"><input type="radio" name="color" value="Other" required @checked($old('color') === 'Other')><span>Other</span></label>
          </div>
          @error('color') <p class="err" data-error>{{ $message }}</p> @enderror
          <div id="colorOther" class="fw mt-5 max-w-sm" hidden>
            <label class="flabel" for="color_other">Describe the color</label>
            <div class="fld"><input class="field-input" id="color_other" name="color_other" type="text" maxlength="100" value="{{ $old('color_other') }}" placeholder="e.g. deep forest green"></div>
            @error('color_other') <p class="err" data-error>{{ $message }}</p> @enderror
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-10">
          <div>
            <p class="flabel mb-3">Lining <span class="text-ink/30">(optional)</span></p>
            <div class="flex flex-wrap gap-2">
              @foreach ($linings as $l)
                <label class="opt"><input type="radio" name="lining" value="{{ $l }}" @checked($old('lining') === $l)><span>{{ $l }}</span></label>
              @endforeach
            </div>
          </div>
          <div>
            <p class="flabel mb-3">Hardware <span class="text-ink/30">(optional)</span></p>
            <div class="flex flex-wrap gap-2">
              @foreach ($hardware as $h)
                <label class="opt"><input type="radio" name="hardware" value="{{ $h }}" @checked($old('hardware') === $h)><span>{{ $h }}</span></label>
              @endforeach
            </div>
          </div>
        </div>
      </div>

      <!-- STEP 2 — Fit -->
      <div class="step space-y-10" data-step="1">
        <div>
          <h2 class="font-display text-2xl md:text-3xl mb-1">How should it fit?</h2>
          <p class="text-[13px] text-ink/55">Choose a standard size, or give us your measurements for a true made-to-measure fit.</p>
        </div>

        <div class="@error('fit') has-err @enderror">
          <p class="flabel mb-3">Fit</p>
          <div class="flex flex-wrap gap-2">
            @foreach ($fits as $f)
              <label class="opt"><input type="radio" name="fit" value="{{ $f }}" required @checked($old('fit', 'Regular') === $f)><span>{{ $f }}</span></label>
            @endforeach
          </div>
          @error('fit') <p class="err" data-error>{{ $message }}</p> @enderror
        </div>

        <div class="@error('sizing_mode') has-err @enderror">
          <p class="flabel mb-3">Sizing</p>
          <div class="flex flex-wrap gap-2">
            <label class="opt"><input type="radio" name="sizing_mode" value="standard" required @checked($old('sizing_mode', 'standard') === 'standard')><span>Standard size</span></label>
            <label class="opt"><input type="radio" name="sizing_mode" value="custom" required @checked($old('sizing_mode') === 'custom')><span>My measurements</span></label>
          </div>
        </div>

        <!-- standard size -->
        <div id="sizeStd" class="@error('standard_size') has-err @enderror" hidden>
          <p class="flabel mb-3">Size</p>
          <div class="flex flex-wrap gap-2">
            @foreach ($sizes as $s)
              <label class="opt"><input type="radio" name="standard_size" value="{{ $s }}" @checked($old('standard_size') === $s)><span>{{ $s }}</span></label>
            @endforeach
          </div>
          @error('standard_size') <p class="err" data-error>{{ $message }}</p> @enderror
        </div>

        <!-- measurements -->
        <div id="sizeCustom" hidden>
          <div class="flex items-center justify-between gap-4 mb-6">
            <p class="flabel !mb-0">Measurements</p>
            <div class="flex gap-2">
              <label class="opt"><input type="radio" name="unit" value="cm" @checked($old('unit', 'cm') === 'cm')><span>cm</span></label>
              <label class="opt"><input type="radio" name="unit" value="in" @checked($old('unit') === 'in')><span>in</span></label>
            </div>
          </div>
          <div class="grid grid-cols-2 gap-x-6 gap-y-8">
            @foreach ([['chest','Chest'],['waist','Waist'],['shoulder_width','Shoulder width'],['sleeve_length','Sleeve length'],['jacket_length','Jacket length'],['height','Height (optional)']] as [$k, $label])
              <div class="fw @error($k) has-err @enderror">
                <label class="flabel" for="{{ $k }}">{{ $label }}</label>
                <div class="fld"><input class="field-input" id="{{ $k }}" name="{{ $k }}" type="number" inputmode="decimal" step="0.1" min="10" max="250" value="{{ $old($k) }}" placeholder="0.0"></div>
                @error($k) <p class="err" data-error>{{ $message }}</p> @enderror
              </div>
            @endforeach
          </div>
          <p class="text-[12px] text-ink/50 mt-6 max-w-md leading-relaxed">Measure over a thin layer of clothing, with the tape snug but not tight. Not sure? Send what you have — we'll check the rest with you before we cut.</p>
        </div>

        <div class="fw max-w-[10rem] @error('quantity') has-err @enderror">
          <label class="flabel" for="quantity">Quantity</label>
          <div class="fld"><input class="field-input" id="quantity" name="quantity" type="number" inputmode="numeric" min="1" max="10" required value="{{ $old('quantity', 1) }}"></div>
          @error('quantity') <p class="err" data-error>{{ $message }}</p> @enderror
        </div>
      </div>

      <!-- STEP 3 — Details -->
      <div class="step space-y-10" data-step="2">
        <div>
          <h2 class="font-display text-2xl md:text-3xl mb-1">Anything else we should know?</h2>
          <p class="text-[13px] text-ink/55">Details, inspiration, deadlines. Everything on this page is optional.</p>
        </div>

        <div class="fw max-w-sm @error('monogram') has-err @enderror">
          <label class="flabel" for="monogram">Monogram or label text</label>
          <div class="fld"><input class="field-input" id="monogram" name="monogram" type="text" maxlength="40" value="{{ $old('monogram') }}" placeholder="e.g. initials inside the collar"></div>
          @error('monogram') <p class="err" data-error>{{ $message }}</p> @enderror
        </div>

        <div class="fw @error('details') has-err @enderror">
          <label class="flabel" for="details">Describe your jacket</label>
          <div class="fld"><textarea class="field-input resize-none" id="details" name="details" rows="5" maxlength="2000" placeholder="Pockets, collar, closures, length, anything you picture…">{{ $old('details') }}</textarea></div>
          @error('details') <p class="err" data-error>{{ $message }}</p> @enderror
        </div>

        <div class="@error('reference_images') has-err @enderror @error('reference_images.*') has-err @enderror">
          <p class="flabel mb-3">Reference photos <span class="text-ink/30">(up to 4)</span></p>
          <label id="drop" for="files" class="block cursor-pointer border border-dashed border-ink/25 px-6 py-10 text-center transition-colors">
            <span class="block text-[14px]">Drop photos here, or <span class="ul">browse</span></span>
            <span class="block text-[11px] font-mono text-ink/45 mt-1">JPG, PNG or WebP · up to 5 MB each</span>
          </label>
          <input id="files" name="reference_images[]" type="file" accept="image/jpeg,image/png,image/webp" multiple class="sr-only">
          <div id="previews" class="grid grid-cols-4 gap-3 mt-4"></div>
          <p id="fileErr" class="err" hidden></p>
          @error('reference_images') <p class="err" data-error>{{ $message }}</p> @enderror
          @error('reference_images.*') <p class="err" data-error>{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-10">
          <div>
            <p class="flabel mb-3">Budget <span class="text-ink/30">(optional)</span></p>
            <div class="flex flex-wrap gap-2">
              @foreach ($budgets as $b)
                <label class="opt"><input type="radio" name="budget" value="{{ $b }}" @checked($old('budget') === $b)><span>{{ $b }}</span></label>
              @endforeach
            </div>
          </div>
          <div class="fw @error('needed_by') has-err @enderror">
            <label class="flabel" for="needed_by">Needed by <span class="text-ink/30">(optional)</span></label>
            <div class="fld"><input class="field-input" id="needed_by" name="needed_by" type="date" min="{{ now()->addDay()->toDateString() }}" value="{{ $old('needed_by') }}"></div>
            @error('needed_by') <p class="err" data-error>{{ $message }}</p> @enderror
          </div>
        </div>
      </div>

      <!-- STEP 4 — Contact -->
      <div class="step space-y-10" data-step="3">
        <div>
          <h2 class="font-display text-2xl md:text-3xl mb-1">Where should we reach you?</h2>
          <p class="text-[13px] text-ink/55">We'll reply with questions, a quote and timing. Nothing is charged at this stage.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-8">
          <div class="fw @error('name') has-err @enderror">
            <label class="flabel" for="name">Name</label>
            <div class="fld"><input class="field-input" id="name" name="name" type="text" required autocomplete="name" value="{{ $old('name', $u->name ?? '') }}" placeholder="Your full name"></div>
            @error('name') <p class="err" data-error>{{ $message }}</p> @enderror
          </div>
          <div class="fw @error('email') has-err @enderror">
            <label class="flabel" for="email">Email</label>
            <div class="fld"><input class="field-input" id="email" name="email" type="email" required autocomplete="email" value="{{ $old('email', $u->email ?? '') }}" placeholder="you@example.com"></div>
            @error('email') <p class="err" data-error>{{ $message }}</p> @enderror
          </div>
          <div class="fw sm:col-span-1 @error('phone') has-err @enderror">
            <label class="flabel" for="phone">Phone <span class="text-ink/30">(optional)</span></label>
            <div class="fld"><input class="field-input" id="phone" name="phone" type="tel" autocomplete="tel" value="{{ $old('phone') }}" placeholder="+1 555 0172"></div>
            @error('phone') <p class="err" data-error>{{ $message }}</p> @enderror
          </div>
        </div>

        <div class="@error('consent') has-err @enderror">
          <label class="flex items-start gap-3 text-[13px] text-ink/70 leading-relaxed cursor-pointer">
            <input type="checkbox" name="consent" value="1" required class="mt-1 w-4 h-4 accent-ink shrink-0" @checked($old('consent'))>
            I'm happy for The Western Fashion to contact me about this request.
          </label>
          @error('consent') <p class="err" data-error>{{ $message }}</p> @enderror
        </div>
      </div>

      <!-- nav -->
      <div class="flex items-center justify-between gap-4 mt-12 pt-6 border-t border-ink/10">
        <button type="button" id="back" class="cta text-[11px] font-mono uppercase tracking-tag ul pb-0.5 disabled:opacity-0 disabled:pointer-events-none" disabled>← Back</button>
        <button type="button" id="next" class="mag cta bg-ink text-paper text-[11px] font-mono uppercase tracking-tag px-8 py-4 border border-ink hover:bg-transparent hover:text-ink">Continue →</button>
        <button type="submit" id="send" class="mag cta bg-ink text-paper text-[11px] font-mono uppercase tracking-tag px-8 py-4 border border-ink hover:bg-transparent hover:text-ink disabled:opacity-50" hidden>Send request</button>
      </div>
    </form>
  </div>

  <!-- live summary -->
  <aside class="hidden lg:block lg:col-span-4 lg:col-start-9">
    <div class="sticky top-28 border border-ink/10 p-7" data-r>
      <p class="text-[11px] font-mono uppercase tracking-tag text-brick mb-6">Your request</p>
      <dl id="sum" class="text-[13px] space-y-4"></dl>
      <div class="rule my-6" data-rule></div>
      <p class="text-[12px] text-ink/50 leading-relaxed">Price is quoted after we review your request. No payment is taken now.</p>
    </div>
  </aside>
</section>
@endif

<!-- Footer -->
<footer class="bg-white overflow-hidden border-t border-ink/10">
  <div class="max-w-[1440px] mx-auto px-6 md:px-10 pt-16 pb-10 grid grid-cols-2 md:grid-cols-4 gap-10">
    <div class="col-span-2"><p class="text-[13px] text-ink/60 max-w-xs leading-relaxed">Under-the-radar jackets, consciously made for comfort, style, and elegance.</p></div>
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
  const $ = (s, r = document) => r.querySelector(s);
  const $$ = (s, r = document) => [...r.querySelectorAll(s)];
  const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* reveals + smooth scroll */
  const io = new IntersectionObserver(es => es.forEach(e => { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } }), { threshold: .12, rootMargin: '0px 0px -6% 0px' });
  $$('[data-r], [data-rule]').forEach(el => io.observe(el));
  let lenis = null;
  if (window.Lenis && !reduce) {
    lenis = new Lenis({ duration: 1.25, easing: t => Math.min(1, 1.001 - Math.pow(2, -10 * t)) });
    window.lenis = lenis;
    (function raf(t) { lenis.raf(t); requestAnimationFrame(raf); })(0);
  }

  /* footer wordmark fits any screen */
  const mark = $('#bigMark');
  const fitMark = () => { mark.style.fontSize = '100px'; const w = mark.firstElementChild.getBoundingClientRect().width; mark.style.fontSize = (100 * mark.parentElement.clientWidth * .94 / w) + 'px'; };
  let lastW = innerWidth;
  addEventListener('resize', () => { if (innerWidth !== lastW) { lastW = innerWidth; fitMark(); } });
  addEventListener('load', fitMark);
  if (document.fonts && document.fonts.ready) document.fonts.ready.then(fitMark);
  fitMark();

  /* magnetic buttons */
  if (matchMedia('(hover:hover)').matches && !reduce) $$('.mag').forEach(el => {
    el.addEventListener('mousemove', e => { const b = el.getBoundingClientRect(); el.style.transform = `translate(${(e.clientX - b.left - b.width / 2) * .18}px,${(e.clientY - b.top - b.height / 2) * .3}px)`; });
    el.addEventListener('mouseleave', () => el.style.transform = '');
  });

  /* ============ the wizard (only when the form is on the page) ============ */
  const form = $('#co');
  if (form) {
    const steps = $$('.step', form), labels = $$('.stlab'), bar = $('#bar');
    const back = $('#back'), next = $('#next'), send = $('#send');
    let cur = 0;

    const val = n => (form.elements[n] && form.elements[n].value) || '';
    const checked = n => { const r = form.querySelector(`input[name="${n}"]:checked`); return r ? r.value : ''; };

    /* conditional panels: hidden panels are disabled so they never block or get submitted */
    function panel(el, on) { el.hidden = !on; $$('input,select,textarea', el).forEach(i => i.disabled = !on); }
    function syncConditionals() {
      const other = checked('color') === 'Other';
      panel($('#colorOther'), other); $('#color_other').required = other;

      const custom = checked('sizing_mode') === 'custom';
      panel($('#sizeStd'), !custom); panel($('#sizeCustom'), custom);
      $$('input[name="standard_size"]').forEach(i => i.required = !custom);
      ['chest', 'waist', 'shoulder_width', 'sleeve_length', 'jacket_length'].forEach(n => { form.elements[n].required = custom; });
    }

    /* live summary */
    const swatches = @json($colors);
    function summary() {
      const color = checked('color'), size = checked('sizing_mode') === 'custom' ? 'Made to measure' : checked('standard_size');
      const rows = [
        ['Style', checked('style')],
        ['Material', checked('material')],
        ['Color', color === 'Other' ? (val('color_other') || 'Other') : color, swatches[color]],
        ['Fit', checked('fit')],
        ['Size', size],
        ['Quantity', val('quantity')],
      ];
      $('#sum').innerHTML = rows.map(([k, v, hex]) => `
        <div class="flex items-baseline justify-between gap-4 border-b border-ink/10 pb-3">
          <dt class="text-[11px] font-mono uppercase tracking-tag text-ink/45">${k}</dt>
          <dd class="text-right ${v ? '' : 'text-ink/25'} flex items-center gap-2">${hex ? `<span class="inline-block w-3 h-3 rounded-full border border-ink/15" style="background:${hex}"></span>` : ''}${v ? v.replace(/[<>&"]/g, '') : '—'}</dd>
        </div>`).join('');
    }

    /* step navigation + validation */
    function stepValid(i, report) {
      const fields = $$('input,select,textarea', steps[i]).filter(f => !f.disabled && f.type !== 'file');
      for (const f of fields) if (!f.checkValidity()) { if (report) { f.reportValidity(); } return false; }
      return true;
    }
    function go(i) {
      cur = Math.max(0, Math.min(steps.length - 1, i));
      steps.forEach((s, k) => s.classList.toggle('on', k === cur));
      labels.forEach((l, k) => { l.classList.toggle('on', k === cur); l.classList.toggle('done', k < cur); });
      bar.style.transform = `scaleX(${(cur + 1) / steps.length})`;
      back.disabled = cur === 0;
      next.hidden = cur === steps.length - 1; send.hidden = !next.hidden;
      if (cur) steps[cur].scrollIntoView({ behavior: reduce ? 'auto' : 'smooth', block: 'start' });
    }
    next.addEventListener('click', () => { if (stepValid(cur, true)) go(cur + 1); });
    back.addEventListener('click', () => go(cur - 1));

    form.addEventListener('submit', e => {
      for (let i = 0; i < steps.length; i++) {
        if (!stepValid(i, false)) { e.preventDefault(); go(i); setTimeout(() => stepValid(i, true), 80); return; }
      }
      send.disabled = true; send.textContent = 'Sending…';
    });
    form.addEventListener('keydown', e => { if (e.key === 'Enter' && e.target.tagName !== 'TEXTAREA' && cur < steps.length - 1) { e.preventDefault(); next.click(); } });
    form.addEventListener('input', () => { syncConditionals(); summary(); });
    form.addEventListener('change', () => { syncConditionals(); summary(); });

    /* reference photo uploads: previews, remove, limits */
    const input = $('#files'), drop = $('#drop'), prev = $('#previews'), ferr = $('#fileErr');
    let files = [];
    function showErr(m) { ferr.textContent = m; ferr.hidden = !m; }
    function sync() {
      const dt = new DataTransfer(); files.forEach(f => dt.items.add(f)); input.files = dt.files;
      prev.innerHTML = '';
      files.forEach((f, i) => {
        const d = document.createElement('div'); d.className = 'relative aspect-square bg-paperdeep overflow-hidden';
        const im = document.createElement('img'); im.src = URL.createObjectURL(f); im.alt = f.name; im.className = 'w-full h-full object-cover';
        const x = document.createElement('button'); x.type = 'button'; x.setAttribute('aria-label', 'Remove ' + f.name);
        x.className = 'absolute top-1.5 right-1.5 w-7 h-7 rounded-full bg-white/95 text-[13px] leading-none'; x.textContent = '×';
        x.addEventListener('click', () => { files.splice(i, 1); sync(); });
        d.append(im, x); prev.appendChild(d);
      });
    }
    function add(list) {
      showErr('');
      for (const f of list) {
        if (!/^image\/(jpeg|png|webp)$/.test(f.type)) { showErr('Only JPG, PNG or WebP images, please.'); continue; }
        if (f.size > 5 * 1024 * 1024) { showErr(f.name + ' is over 5 MB.'); continue; }
        if (files.length >= 4) { showErr('You can add up to 4 photos.'); break; }
        files.push(f);
      }
      sync();
    }
    input.addEventListener('change', () => add([...input.files].filter(f => !files.includes(f))));
    ['dragenter', 'dragover'].forEach(ev => drop.addEventListener(ev, e => { e.preventDefault(); drop.classList.add('drag'); }));
    ['dragleave', 'drop'].forEach(ev => drop.addEventListener(ev, e => { e.preventDefault(); drop.classList.remove('drag'); }));
    drop.addEventListener('drop', e => add([...e.dataTransfer.files]));

    /* init — and if the server sent errors back, jump to the first step that has one */
    syncConditionals(); summary();
    const firstErr = $('[data-error]', form);
    go(firstErr ? Math.max(0, steps.indexOf(firstErr.closest('.step'))) : 0);
    if (firstErr) setTimeout(() => firstErr.scrollIntoView({ behavior: 'auto', block: 'center' }), 50);
  }
</script>
</body>
</html>