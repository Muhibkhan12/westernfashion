{{-- resources/views/partials/wishlist.blade.php
     Heart-button behaviour for the whole storefront. It is included by partials/header.blade.php,
     so every page gets it. Any element with  data-wish="<product id>"  becomes a working heart. --}}
<style>
  .wish-btn { width:40px; height:40px; border-radius:9999px; background:rgba(255,255,255,.92); display:inline-flex; align-items:center; justify-content:center; color:#1C1A16; transition:transform .3s cubic-bezier(.2,.7,.2,1), background .25s; }
  .wish-btn:hover { transform:scale(1.08); background:#fff; }
  .wish-btn svg { width:18px; height:18px; fill:none; stroke:currentColor; stroke-width:1.5; transition:fill .25s, stroke .25s; }
  .wish-btn.on svg { fill:#9A3D28; stroke:#9A3D28; }
  .wish-btn.pop { animation:wishPop .5s cubic-bezier(.2,.9,.3,1.4); }
  @keyframes wishPop { 50% { transform:scale(1.3); } }
  #wishToast { position:fixed; left:50%; bottom:6rem; transform:translate(-50%,24px); opacity:0; z-index:95; pointer-events:none; background:#1C1A16; color:#fff; font:11px 'Space Mono',monospace; text-transform:uppercase; letter-spacing:.14em; padding:12px 20px; max-width:90vw; text-align:center; transition:transform .45s cubic-bezier(.2,.7,.2,1), opacity .35s; }
  #wishToast.show { transform:translate(-50%,0); opacity:1; pointer-events:auto; }
  #wishToast a { margin-left:12px; text-decoration:underline; text-underline-offset:3px; }
  @media (min-width:1024px) { #wishToast { bottom:1.5rem; } }
  @media (prefers-reduced-motion:reduce) { .wish-btn, #wishToast { transition:none; } .wish-btn.pop { animation:none; } }
</style>

<script>
  (function () {
    const URL_IDS = @json(route('wishlist.ids')), URL_TOGGLE = @json(route('wishlist.toggle')),
          URL_LOGIN = @json(route('login')), URL_LIST = @json(route('user.wishlist')), CSRF = @json(csrf_token());

    let ids = null, loading = null, toastEl = null, timer;

    // the ids this visitor has saved (empty for guests); fetched once per page
    function load() {
      if (ids) return Promise.resolve(ids);
      if (!loading) loading = fetch(URL_IDS, { headers: { Accept: 'application/json' }, credentials: 'same-origin' })
        .then(r => r.ok ? r.json() : { ids: [] })
        .then(d => (ids = new Set(d.ids || [])))
        .catch(() => (ids = new Set()));
      return loading;
    }

    function paint(el, on) {
      el.classList.toggle('on', on);
      el.setAttribute('aria-pressed', String(on));
      el.setAttribute('aria-label', on ? 'Remove from wishlist' : 'Save to wishlist');
    }
    function paintAll(id, on, pop) {
      document.querySelectorAll('[data-wish="' + id + '"]').forEach(el => {
        paint(el, on);
        if (pop) { el.classList.remove('pop'); void el.offsetWidth; el.classList.add('pop'); }
      });
    }

    // call after you render cards: paints every heart on the page with the saved state
    function mark() {
      if (!document.querySelector('[data-wish]')) return;
      load().then(set => document.querySelectorAll('[data-wish]').forEach(el => paint(el, set.has(el.dataset.wish))));
    }

    function toast(msg, link) {
      if (!toastEl) { toastEl = document.createElement('div'); toastEl.id = 'wishToast'; toastEl.setAttribute('role', 'status'); document.body.appendChild(toastEl); }
      toastEl.textContent = msg;
      if (link) { const a = document.createElement('a'); a.href = URL_LIST; a.textContent = 'View'; toastEl.appendChild(a); }
      toastEl.classList.add('show');
      clearTimeout(timer); timer = setTimeout(() => toastEl.classList.remove('show'), 2800);
    }

    async function toggle(btn) {
  const id = btn.dataset.wish, set = await load(), was = set.has(id);

  // optimistic: flip the heart right away
  was ? set.delete(id) : set.add(id);
  paintAll(id, !was, !was);

  const revert = () => { was ? set.add(id) : set.delete(id); paintAll(id, was, false); };

  try {
    const res = await fetch(URL_TOGGLE, {
      method: 'POST', credentials: 'same-origin',
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },
      body: JSON.stringify({ product_id: id })
    });
    if (res.status === 401) { revert(); location.href = URL_LOGIN; return; }
    if (res.status === 419) { revert(); toast('Session expired — please refresh the page'); return; }
    if (!res.ok) {
      const err = await res.json().catch(() => ({}));
      console.error('Wishlist failed', res.status, id, err);
      throw new Error(`${res.status}: ${err.message || 'error'}`);
    }
    const data = await res.json();
    data.wished ? set.add(id) : set.delete(id);
    paintAll(id, data.wished, false);
    toast(data.wished ? 'Saved to your wishlist' : 'Removed from your wishlist', data.wished);
  } catch (e) {
    revert(); toast('Could not update your wishlist (' + (e.message || 'network') + ')');
  }
}

    // works for hearts that are added later too (cards rendered by JavaScript)
    document.addEventListener('click', (e) => {
      const b = e.target.closest('[data-wish]');
      if (!b) return;
      e.preventDefault(); e.stopPropagation();   // hearts sit inside product links
      toggle(b);
    });

    window.TWFWish = { mark };
    document.addEventListener('DOMContentLoaded', mark);
  })();
</script>