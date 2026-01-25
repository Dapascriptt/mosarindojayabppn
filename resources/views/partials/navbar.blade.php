<header id="siteHeader"
  class="sticky top-0 z-[100] isolate pointer-events-auto border-b border-slate-200/70 bg-white/70 backdrop-blur supports-[backdrop-filter]:bg-white/60 transition-all duration-300">
  <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div id="navBarRow" class="flex h-16 items-center justify-between transition-all duration-300">
      {{-- Brand --}}
      <a href="{{ route('home') }}" class="group inline-flex items-center gap-3">
        <span class="relative grid h-9 w-9 place-items-center rounded-xl  ring-slate-200">
          <img src="/image/logo-mjb.png" alt="Masarindo Jaya Balikpapan" class="h-10 w-10 object-contain">
        </span>
        <div class="leading-tight">
          <div class="text-sm font-extrabold tracking-tight text-slate-900 group-hover:text-slate-900">
            {{ config('app.name') }}
          </div>
          <div class="text-[11px] font-semibold tracking-wide text-slate-500">
            Kontraktor & Supply
          </div>
        </div>
      </a>

      {{-- Desktop Menu --}}
      <div class="hidden lg:flex items-center gap-1 text-sm font-semibold text-slate-800">
        <a href="{{ route('home') }}"
           class="px-3 py-2 rounded-xl hover:bg-[rgba(219,165,84,0.35)] hover:text-slate-900 transition">
          Beranda
        </a>
         <a href="{{ route('products.index') }}"
           class="px-3 py-2 rounded-xl hover:bg-[rgba(219,165,84,0.35)] hover:text-slate-900 transition">
          Produk
        </a>

        <a href="{{ route('services.index') }}"
           class="px-3 py-2 rounded-xl hover:bg-[rgba(219,165,84,0.35)] hover:text-slate-900 transition">
          Layanan
        </a>
        <a href="{{ route('profile.about') }}"
           class="px-3 py-2 rounded-xl hover:bg-[rgba(219,165,84,0.35)] hover:text-slate-900 transition">
          Tentang Kami
        </a>





        <a href="{{ route('gallery') }}"
           class="px-3 py-2 rounded-xl hover:bg-[rgba(219,165,84,0.35)] hover:text-slate-900 transition">
          Galeri
        </a>

        <a href="{{ route('contact') }}"
           class="ml-1 inline-flex items-center justify-center rounded-xl bg-[rgba(219,165,84,1)] px-4 py-2 text-sm font-extrabold text-white shadow-sm transition hover:brightness-95">
          Kontak
        </a>
      </div>

      {{-- Mobile Button --}}
      <button type="button"
        class="lg:hidden inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-3 py-2 text-slate-900 shadow-sm hover:bg-slate-50 transition"
        data-mobile-toggle>
        <span class="sr-only">Open menu</span>
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>

    {{-- Mobile Panel --}}
    <div class="lg:hidden hidden" data-mobile-panel>
      <div class="pb-4 pt-2">
        <div class="grid gap-1 rounded-2xl bg-white p-2 ring-1 ring-slate-200 shadow-sm">
          <a href="{{ route('home') }}" class="rounded-xl px-3 py-3 font-semibold text-slate-900 hover:bg-[rgba(219,165,84,0.35)] transition">Beranda</a>
          <a href="{{ route('products.index') }}" class="rounded-xl px-3 py-3 font-semibold text-slate-900 hover:bg-[rgba(219,165,84,0.35)] transition">Produk</a>
          <a href="{{ route('services.index') }}" class="rounded-xl px-3 py-3 font-semibold text-slate-900 hover:bg-[rgba(219,165,84,0.35)] transition">Layanan</a>

          <a href="{{ route('profile.about') }}" class="rounded-xl px-3 py-3 font-semibold text-slate-900 hover:bg-[rgba(219,165,84,0.35)] transition">Tentang Kami</a>
          <a href="{{ route('gallery') }}" class="rounded-xl px-3 py-3 font-semibold text-slate-900 hover:bg-[rgba(219,165,84,0.35)] transition">Galeri</a>
        <a href="{{ route('contact') }}" class="rounded-xl bg-[rgba(219,165,84,1)] px-3 py-3 font-extrabold text-white transition hover:brightness-95">Kontak</a>
        </div>
      </div>
    </div>
  </nav>
</header>

@push('scripts')
<script>
(function () {
  // ========= 1) Scroll effect (shadow + blur + shrink) =========
  const header = document.getElementById('siteHeader');
  const row = document.getElementById('navBarRow');

  const applyHeader = () => {
    const y = window.scrollY || 0;

    // shadow & stronger bg on scroll
    header.classList.toggle('shadow-lg', y > 6);
    header.classList.toggle('shadow-slate-200/60', y > 6);
    header.classList.toggle('bg-white/90', y > 6);
    header.classList.toggle('supports-[backdrop-filter]:bg-white/80', y > 6);

    // shrink height feel (via padding)
    if (row) {
      row.classList.toggle('h-16', y <= 6);
      row.classList.toggle('h-14', y > 6);
    }
  };

  applyHeader();
  window.addEventListener('scroll', applyHeader, { passive: true });

  // ========= 2) Dropdown Click (Services/Profile) =========
  const buttons = document.querySelectorAll('[data-dd-btn]');
  const menus = {};
  document.querySelectorAll('[data-dd-menu]').forEach(el => {
    menus[el.getAttribute('data-dd-menu')] = el;
  });

  const closeAll = () => {
    Object.keys(menus).forEach(key => {
      menus[key].classList.add('hidden');
      const btn = document.querySelector(`[data-dd-btn="${key}"]`);
      const icon = document.querySelector(`[data-dd-icon="${key}"]`);
      if (btn) btn.setAttribute('aria-expanded', 'false');
      if (icon) icon.style.transform = '';
    });
  };

  const toggleMenu = (key) => {
    const menu = menus[key];
    const btn = document.querySelector(`[data-dd-btn="${key}"]`);
    const icon = document.querySelector(`[data-dd-icon="${key}"]`);
    if (!menu) return;

    const isOpen = !menu.classList.contains('hidden');
    closeAll(); // hanya 1 terbuka

    if (!isOpen) {
      menu.classList.remove('hidden');

      // animasi muncul (simple)
      menu.style.opacity = 0;
      menu.style.transform = 'translateY(8px)';
      menu.style.transition = 'opacity 160ms ease, transform 160ms ease';
      requestAnimationFrame(() => {
        menu.style.opacity = 1;
        menu.style.transform = 'translateY(0px)';
      });

      if (btn) btn.setAttribute('aria-expanded', 'true');
      if (icon) icon.style.transform = 'rotate(180deg)';
    }
  };

  buttons.forEach(btn => {
    const key = btn.getAttribute('data-dd-btn');
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation();
      toggleMenu(key);
    });
  });

  // klik di luar => close
  document.addEventListener('click', () => closeAll());

  // ESC => close
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeAll();
  });

  // agar klik di dalam menu tidak menutup
  document.querySelectorAll('[data-dd-menu]').forEach(menu => {
    menu.addEventListener('click', (e) => e.stopPropagation());
  });

  // ========= 3) Mobile toggle =========
  const mobileBtn = document.querySelector('[data-mobile-toggle]');
  const mobilePanel = document.querySelector('[data-mobile-panel]');
  if (mobileBtn && mobilePanel) {
    mobileBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      mobilePanel.classList.toggle('hidden');
      // kalau buka mobile menu, pastikan dropdown desktop nutup
      closeAll();
    });

    // klik di luar mobile panel => close
    document.addEventListener('click', (e) => {
      if (mobilePanel.classList.contains('hidden')) return;
      const inside = e.target.closest('[data-mobile-panel], [data-mobile-toggle]');
      if (!inside) mobilePanel.classList.add('hidden');
    });
  }
})();
</script>
@endpush



