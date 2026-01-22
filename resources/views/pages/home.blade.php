@extends('layouts.app')
@section('title', 'Kontraktor & Supplier Balikpapan | Mosarindo')
@section('meta_description', 'Mosarindo Jaya Balikpapan menyediakan jasa konstruksi, MEP, interior, renovasi, serta supply material alam dan daging ayam untuk proyek dan instansi.')
@section('canonical', url()->current())
@section('meta_image', asset('image/hero1.png'))
@section('meta_robots', 'index, follow')

@section('content')
{{-- HERO SLIDER FULL BLEED --}}
@php
  $homeData = $home ?? [];
  $resolveMedia = function ($path) {
      if (! $path) {
          return '';
      }
      if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://', '/'])) {
          return $path;
      }
      return \Illuminate\Support\Facades\Storage::url($path);
  };
  $isVideo = function ($path) {
      if (! $path) {
          return false;
      }
      $path = strtolower($path);
      return \Illuminate\Support\Str::endsWith($path, ['.mp4', '.webm', '.ogg', '.mov']);
  };

  $defaultSlides = [
    [
      'media' => asset('image/hero1.png'),
      'title' => 'Kontraktor & Supply Konstruksi',
      'subtitle' => 'Tepat Waktu. Terukur. Profesional.',
      'desc' => 'Kontraktor Balikpapan untuk konstruksi bangunan, MEP, interior, dan supply material alam. Siap mendukung tender proyek dan instansi.',
    ],
    [
      'media' => asset('image/hero2.png'),
      'title' => 'Eksekusi Lapangan yang Rapi',
      'subtitle' => 'Workflow jelas & dokumentasi progres.',
      'desc' => 'Jasa konstruksi Balikpapan dengan alur kerja terukur: survey, RAB, eksekusi, QC hingga serah terima.',
    ],
    [
      'media' => asset('image/hero3.png'),
      'title' => 'Supply Material Terencana',
      'subtitle' => 'Rantai pasok kuat untuk kebutuhan proyek.',
      'desc' => 'Supplier material alam Balikpapan termasuk pasir dan batu split Palu dengan spesifikasi tepat dan pengiriman on-time.',
    ],
  ];

  $heroMedia = array_values(array_filter((array) data_get($homeData, 'hero_media', [])));
  if (!empty($heroMedia)) {
    $heroSlides = [];
    foreach ($heroMedia as $i => $media) {
      $fallback = $defaultSlides[$i] ?? $defaultSlides[0];
      $heroSlides[] = array_merge($fallback, [
        'media' => $media,
      ]);
    }
  } else {
    $heroSlides = $defaultSlides;
  }
@endphp

<section id="hero" class="relative isolate overflow-hidden bg-slate-950 text-white">
  <div class="relative h-[520px] sm:h-[600px]">
    @foreach ($heroSlides as $i => $s)
      @php
        $slideMedia = $resolveMedia(data_get($s, 'media'));
        $slideIsVideo = $isVideo($slideMedia);
      @endphp
      <div
        class="hero-slide absolute inset-0 transition-opacity duration-700"
        style="opacity: {{ $i === 0 ? '1' : '0' }}; pointer-events: {{ $i === 0 ? 'auto' : 'none' }};"
        data-hero-slide="{{ $i }}">
        @if ($slideIsVideo)
          <video class="absolute inset-0 h-full w-full object-cover" autoplay muted loop playsinline>
            <source src="{{ $slideMedia }}" type="video/mp4">
          </video>
        @else
          <div class="absolute inset-0 bg-cover bg-center" style="background-image:url('{{ $slideMedia }}')"></div>
        @endif
        <div class="absolute inset-0 bg-slate-950/45"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/55 via-transparent to-slate-950/40"></div>
        <div class="absolute -top-24 -right-24 h-80 w-80 rounded-full bg-[rgba(219,165,84,0.2)] blur-3xl"></div>
        <div class="absolute -bottom-28 -left-28 h-80 w-80 rounded-full bg-sky-500/20 blur-3xl"></div>

        <div class="relative flex h-full items-center justify-center px-4 sm:px-6 lg:px-8">
          <div class="max-w-4xl text-center">
            @if ($i === 0)
              <h1 class="mt-6 text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-[1.1] tracking-tight">
                {{ $s['title'] }}
                <span class="block text-[rgba(219,165,84,1)]">{{ $s['subtitle'] }}</span>
              </h1>
            @else
              <h2 class="mt-6 text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-[1.1] tracking-tight">
                {{ $s['title'] }}
                <span class="block text-[rgba(219,165,84,1)]">{{ $s['subtitle'] }}</span>
              </h2>
            @endif

            <p class="mt-5 text-base sm:text-lg leading-relaxed text-slate-200">
              {{ $s['desc'] }}
            </p>

            <div class="mt-8 flex flex-wrap justify-center gap-3">
              <a href="{{ route('services.index') }}"
                class="group inline-flex items-center justify-center gap-2 rounded-xl bg-[rgba(219,165,84,1)] px-6 py-3 text-sm font-extrabold text-white shadow-lg shadow-[rgba(219,165,84,0.2)] ring-1 ring-white/10 transition hover:-translate-y-0.5 hover:brightness-95">
                Lihat Layanan <span aria-hidden="true" class="transition group-hover:translate-x-0.5">→</span>
              </a>
              <a href="{{ route('contact') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-white/10 px-6 py-3 text-sm font-extrabold text-white ring-1 ring-white/15 backdrop-blur transition hover:-translate-y-0.5 hover:bg-white/15">
                Konsultasi / Kontak
              </a>
              <a href="#vision-mission"
                class="js-scroll inline-flex items-center justify-center gap-2 rounded-xl bg-transparent px-6 py-3 text-sm font-extrabold text-slate-200 ring-1 ring-white/15 transition hover:-translate-y-0.5 hover:bg-white/10">
                Jelajahi <span aria-hidden="true">↓</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    @endforeach

    {{-- Controls --}}
    <div class="pointer-events-none absolute inset-x-0 bottom-8">
      <div class="mx-auto flex max-w-6xl items-center justify-between px-4 sm:px-6 lg:px-8 gap-4">
        <div class="pointer-events-auto flex items-center gap-2">
          <button type="button" data-hero-prev
            class="grid h-11 w-11 place-items-center rounded-xl bg-white/10 text-white ring-1 ring-white/15 backdrop-blur transition hover:bg-white/15">
            <span class="sr-only">Prev</span>
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 18l-6-6 6-6" />
            </svg>
          </button>

          <button type="button" data-hero-next
            class="grid h-11 w-11 place-items-center rounded-xl bg-white/10 text-white ring-1 ring-white/15 backdrop-blur transition hover:bg-white/15">
            <span class="sr-only">Next</span>
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 6l6 6-6 6" />
            </svg>
          </button>
        </div>

        <div class="pointer-events-auto flex items-center gap-2" data-hero-dots>
          @foreach ($heroSlides as $i => $s)
            <button type="button"
              class="hero-dot h-2.5 w-2.5 rounded-full ring-1 ring-white/25 transition"
              style="background: {{ $i === 0 ? 'rgba(255,255,255,0.95)' : 'rgba(255,255,255,0.35)' }};"
              data-hero-dot="{{ $i }}"
              aria-label="Slide {{ $i+1 }}">
            </button>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- VISI MISI --}}
@php
  $aboutData = $about ?? [];
  $homeData = $home ?? [];
  $aboutHighlights = data_get($aboutData, 'highlights', []);
  $aboutHero = data_get($aboutData, 'hero_desc', 'Kami berfokus pada ketepatan waktu, keselamatan kerja, dan kualitas eksekusi untuk setiap proyek.');
  $aboutCert = data_get($aboutData, 'certifications_text', 'Tim kami tersertifikasi dan terakreditasi untuk memastikan standar mutu dan keselamatan terjaga.');
  $visionText = data_get($homeData, 'vision_text', 'Menjadi mitra konstruksi dan supply paling dipercaya di Balikpapan dengan standar kerja profesional, hasil presisi, dan hubungan jangka panjang.');
  $aboutExcerpt = data_get($homeData, 'about_excerpt', $aboutHero);
  $missionPoints = data_get($homeData, 'mission_points', [
    'Menjaga keselamatan kerja dan standar mutu di setiap proyek.',
    'Mengutamakan ketepatan waktu dengan perencanaan terukur.',
    'Membangun komunikasi terbuka dengan klien dan stakeholder.',
  ]);
  $cardImage = data_get($homeData, 'card_image', asset('image/logo-mjb.png'));
  $resolveImage = function ($path) {
      if (! $path) {
          return '';
      }
      if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://', '/'])) {
          return $path;
      }
      return \Illuminate\Support\Facades\Storage::url($path);
  };
@endphp

<section id="vision-mission" class="relative overflow-hidden bg-white py-20 lg:py-24">
  <div class="absolute -top-24 -left-24 h-72 w-72 rounded-full bg-sky-100/60 blur-3xl"></div>
  <div class="absolute -bottom-24 -right-24 h-72 w-72 rounded-full bg-[rgba(219,165,84,0.6)] blur-3xl"></div>

  <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-10 lg:grid-cols-[1fr_1.25fr] items-center">
    <div class="rounded-3xl bg-slate-100 p-3 shadow-xl shadow-slate-100/60 vm-fade-right">
      <div class="relative overflow-hidden rounded-2xl">
        <img src="{{ $resolveImage($cardImage) }}" alt="Masarindo Jaya Balikpapan" class="h-full w-full object-cover">
      </div>
    </div>

    <div class="space-y-6 vm-fade-left">
      <div class="space-y-3">
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Tentang Kami</p>
        <h2 class="text-4xl font-black tracking-tight text-slate-900 sm:text-5xl">
          Visi & <span class="text-[rgba(219,165,84,1)]">Misi</span>
        </h2>
        <p class="text-lg text-slate-500 leading-relaxed">
          {{ $aboutExcerpt }}
        </p>
      </div>

      <div class="grid gap-6 md:grid-cols-2">
        <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm vm-fade-left">
          <h3 class="text-lg font-extrabold text-slate-900">Visi</h3>
          <p class="mt-3 text-sm text-slate-600 leading-relaxed">
            {{ $visionText }}
          </p>
        </div>
        <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm vm-fade-left">
          <h3 class="text-lg font-extrabold text-slate-900">Misi</h3>
          <ul class="mt-3 space-y-2 text-sm text-slate-600 leading-relaxed">
            @foreach ($missionPoints as $point)
              <li class="flex items-start gap-2">
                <span class="mt-1 h-2 w-2 rounded-full bg-[rgba(219,165,84,1)]"></span>
                <span>{{ data_get($point, 'text', $point) }}</span>
              </li>
            @endforeach
          </ul>
        </div>
      </div>

      @if (!empty($aboutHighlights))
        <div class="flex flex-wrap gap-3 vm-fade-left">
          @foreach ($aboutHighlights as $item)
            <span class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-xs font-semibold text-slate-600">
              {{ data_get($item, 'text', $item) }}
            </span>
          @endforeach
        </div>
      @endif
    </div>
  </div>
</section>

{{-- SPLIT LINK --}}
<section class="relative overflow-hidden bg-slate-900 text-white">
  <img src="{{ asset('image/hero2.png') }}" alt="Produk dan Layanan" class="absolute inset-0 h-full w-full object-cover opacity-35">
  <div class="absolute inset-0 bg-slate-900/55"></div>
  <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-20 sm:py-24">
    <div class="relative grid gap-6 md:grid-cols-2 items-center min-h-[320px] sm:min-h-[380px]">
      <div class="hidden md:block absolute inset-y-6 left-1/2 w-px -translate-x-1/2 bg-white/50"></div>

      <a href="{{ route('products.index') }}"
        class="group relative rounded-2xl px-6 py-10 text-center md:text-left transition hover:bg-white/10 vm-fade-right">
        <h3 class="mt-3 text-3xl sm:text-4xl font-black tracking-tight text-white">
          Produk
        </h3>

      </a>

      <a href="{{ route('services.index') }}"
        class="group relative rounded-2xl px-6 py-10 text-center md:text-right transition hover:bg-white/10 vm-fade-left">
        <h3 class="mt-3 text-3xl sm:text-4xl font-black tracking-tight text-white">
          Layanan
        </h3>

      </a>
    </div>
  </div>
</section>

@php
  $clientLogos = data_get($homeData, 'partner_logos', [
    ['name' => 'Klien 1', 'src' => '/image/logo-mjb.png'],
    ['name' => 'Klien 2', 'src' => '/image/logo-mjb.png'],
    ['name' => 'Klien 3', 'src' => '/image/logo-mjb.png'],
    ['name' => 'Klien 4', 'src' => '/image/logo-mjb.png'],
    ['name' => 'Klien 5', 'src' => '/image/logo-mjb.png'],
    ['name' => 'Klien 6', 'src' => '/image/logo-mjb.png'],
  ]);
@endphp

<section class="bg-white py-16">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <h2 class="text-sm font-bold uppercase tracking-[0.2em] text-slate-400">Mitra Kerja Terpercaya</h2>
    </div>

    <div class="grid grid-cols-2 items-center gap-8 md:grid-cols-3 lg:grid-cols-6">
      @foreach ($clientLogos as $logo)
        <div class="group flex items-center justify-center p-4">
          <img src="{{ $resolveImage(data_get($logo, 'src', $logo)) }}"
               alt="{{ data_get($logo, 'name', 'Logo') }}"
               class="h-12 w-auto object-contain opacity-40 grayscale transition-all duration-500 group-hover:opacity-100 group-hover:grayscale-0 group-hover:scale-110">
        </div>
      @endforeach
    </div>
  </div>
</section>


@endsection

@push('scripts')
<script>
(() => {
  const slides = Array.from(document.querySelectorAll('[data-hero-slide]'));
  const dots   = Array.from(document.querySelectorAll('[data-hero-dot]'));
  const prev   = document.querySelector('[data-hero-prev]');
  const next   = document.querySelector('[data-hero-next]');

  let idx = 0;
  let timer;
  const interval = 5200;

  const show = (i) => {
    if (!slides.length) return;
    idx = (i + slides.length) % slides.length;
    slides.forEach((s, si) => {
      const active = si === idx;
      s.style.opacity = active ? '1' : '0';
      s.style.pointerEvents = active ? 'auto' : 'none';
    });
    dots.forEach((d, di) => {
      d.style.background = (di === idx) ? 'rgba(255,255,255,0.95)' : 'rgba(255,255,255,0.35)';
    });
  };

  const start = () => {
    stop();
    if (slides.length > 1) {
      timer = setInterval(() => show(idx + 1), interval);
    }
  };
  const stop = () => {
    if (timer) clearInterval(timer);
    timer = null;
  };

  // init
  show(0);
  start();

  if (next) next.addEventListener('click', () => { show(idx + 1); start(); });
  if (prev) prev.addEventListener('click', () => { show(idx - 1); start(); });

  dots.forEach((d) => {
    d.addEventListener('click', () => {
      const to = Number(d.getAttribute('data-hero-dot') || '0');
      show(to);
      start();
    });
  });

  // pause on hover
  const hero = document.getElementById('hero');
  if (hero) {
    hero.addEventListener('mouseenter', stop);
    hero.addEventListener('mouseleave', start);
  }

  // swipe mobile
  let x0 = null;
  const onTouchStart = (e) => { x0 = e.touches[0].clientX; };
  const onTouchEnd = (e) => {
    if (x0 === null) return;
    const dx = e.changedTouches[0].clientX - x0;
    x0 = null;
    if (Math.abs(dx) < 40) return;
    if (dx < 0) show(idx + 1); else show(idx - 1);
    start();
  };
  if (hero) {
    hero.addEventListener('touchstart', onTouchStart, { passive: true });
    hero.addEventListener('touchend', onTouchEnd, { passive: true });
  }
})();

// smooth scroll untuk anchor dengan kelas js-scroll
document.querySelectorAll('a.js-scroll[href^=\"#\"]').forEach(a => {
  a.addEventListener('click', (e) => {
    const id = a.getAttribute('href');
    const target = document.querySelector(id);
    if (!target) return;
    e.preventDefault();
    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
  });
});

(() => {
  const fadeLeft = Array.from(document.querySelectorAll('.vm-fade-left'));
  const fadeRight = Array.from(document.querySelectorAll('.vm-fade-right'));
  const all = [...fadeLeft, ...fadeRight];

  all.forEach(el => {
    el.style.opacity = 0;
    el.style.transition = 'opacity 700ms ease, transform 700ms ease';
  });
  fadeLeft.forEach(el => {
    el.style.transform = 'translateX(24px)';
  });
  fadeRight.forEach(el => {
    el.style.transform = 'translateX(-24px)';
  });

  const io = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      const el = entry.target;
      el.style.opacity = 1;
      el.style.transform = 'translateX(0px)';
      io.unobserve(el);
    });
  }, { threshold: 0.15 });

  all.forEach(el => io.observe(el));
})();
</script>
@endpush
