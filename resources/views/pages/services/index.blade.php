@extends('layouts.app')
@section('title', 'Layanan Konstruksi Balikpapan | Mosarindo')
@section('meta_description', 'Layanan konstruksi, interior dan supply material Balikpapan. Solusi lengkap untuk proyek B2B dan instansi.')
@section('canonical', url()->current())
@section('meta_image', asset('image/hero1.png'))
@section('meta_robots', 'index, follow')

@section('content')
@php
  $resolveImage = function ($path) {
      if (! $path) return '';
      if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://', '/'])) return $path;
      return \Illuminate\Support\Facades\Storage::url($path);
  };

  // Tone default (keren meski tanpa gambar)
  $tileTone = function ($name) {
      $n = strtolower((string) $name);

      if (str_contains($n, 'showroom')) return 'from-[#0B1220] via-[#0E1B34] to-[#0B1220]';
      if (str_contains($n, 'construction') || str_contains($n, 'konstruksi') || str_contains($n, 'sipil')) return 'from-[#0B1220] via-[#122447] to-[#0B1220]';
      if (str_contains($n, 'interior')) return 'from-[#0B1220] via-[#1E254A] to-[#0B1220]';
      if (str_contains($n, 'electrical') || str_contains($n, 'listrik')) return 'from-[#0B1220] via-[#1A2B4E] to-[#0B1220]';
      if (str_contains($n, 'supply') || str_contains($n, 'material') || str_contains($n, 'logistik')) return 'from-[#0B1220] via-[#132A3F] to-[#0B1220]';
      if (str_contains($n, 'batu') || str_contains($n, 'split')) return 'from-[#0B1220] via-[#1A2230] to-[#0B1220]';
      if (str_contains($n, 'land') || str_contains($n, 'clearing')) return 'from-[#0B1220] via-[#102A2A] to-[#0B1220]';

      return 'from-[#0B1220] via-[#0E1B34] to-[#0B1220]';
  };
@endphp

{{-- HERO --}}
<section class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white w-screen left-1/2 right-1/2 -ml-[50vw] -mr-[50vw]">
  <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1523413459209-3f3e43a2f7f0?auto=format&fit=crop&w=2000&q=80')] bg-cover bg-center opacity-25"></div>
  <div class="absolute inset-0 bg-slate-950/65"></div>
  <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_30%,rgba(219,165,84,0.20),transparent_55%)]"></div>

  <div class="relative mx-auto max-w-5xl px-6 py-12 sm:py-14 space-y-3">
    <p class="text-xs sm:text-sm font-extrabold uppercase tracking-[0.18em] text-[rgba(219,165,84,1)]">Layanan</p>
    <h1 class="text-3xl sm:text-4xl font-extrabold leading-tight">Layanan konstruksi & supply Balikpapan</h1>
    <p class="text-base sm:text-lg text-slate-100">Jasa konstruksi, MEP, interior, supply material alam, dan land clearing untuk proyek B2B serta instansi.</p>
  </div>
</section>

{{-- GRID TILES --}}
<section class="mt-10">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid gap-4 sm:gap-6 sm:grid-cols-2 lg:grid-cols-3">
      @foreach ($services as $service)
        @php
          $slug    = data_get($service, 'slug');
          $name    = data_get($service, 'name');
          $img     = $resolveImage(data_get($service, 'image'));
          $short   = data_get($service, 'short_desc');
          $details = data_get($service, 'details', []);
          $tone    = $tileTone($name);
        @endphp

        <article id="{{ $slug }}">
          <a
            href="{{ route('services.show', $slug) }}"
            class="reveal group relative block h-56 sm:h-64 overflow-hidden rounded-3xl ring-1 ring-slate-200 shadow-sm transition hover:-translate-y-1 hover:shadow-xl focus:outline-none focus-visible:ring-2 focus-visible:ring-[rgba(219,165,84,0.55)] focus-visible:ring-offset-2"
            aria-label="Lihat detail layanan {{ $name }}"
          >
            {{-- Default tile background (corporate) --}}
            <div class="absolute inset-0 bg-gradient-to-br {{ $tone }}"></div>
            <div class="absolute inset-0 opacity-40 bg-[radial-gradient(circle_at_22%_22%,rgba(219,165,84,0.18),transparent_55%)]"></div>
            <div class="absolute -top-20 -right-16 h-40 w-40 rounded-full bg-white/10 blur-2xl"></div>
            <div class="absolute -bottom-24 -left-20 h-48 w-48 rounded-full bg-white/10 blur-3xl"></div>

            {{-- Image reveal (mobile: tampil semi agar tetap hidup, desktop: muncul saat hover) --}}
            @if ($img)
              <div
                class="absolute inset-0 bg-cover bg-center opacity-55 sm:opacity-0 scale-100 sm:scale-105 transition duration-700 ease-out sm:group-hover:opacity-100 sm:group-hover:scale-100 sm:group-focus-visible:opacity-100 sm:group-focus-visible:scale-100"
                style="background-image:url('{{ $img }}')"
                aria-hidden="true"
              ></div>
            @endif

            {{-- Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-slate-950/40 to-slate-950/15"></div>

            {{-- Content --}}
            <div class="relative h-full p-5 sm:p-6 flex flex-col justify-end">
              <h2 class="text-lg sm:text-xl font-extrabold leading-tight text-white">
                {{ $name }}
              </h2>

              @if ($short)
                <p class="mt-2 text-sm text-white/85 line-clamp-2">
                  {{ $short }}
                </p>
              @endif

              {{-- Detail: mobile tampil 2, desktop muncul saat hover --}}
              @if (!empty($details))
                <ul class="mt-3 space-y-2 text-sm text-white/85
                           opacity-100 translate-y-0
                           sm:opacity-0 sm:translate-y-2 sm:transition sm:duration-300
                           sm:group-hover:opacity-100 sm:group-hover:translate-y-0
                           sm:group-focus-visible:opacity-100 sm:group-focus-visible:translate-y-0">
                  @foreach ($details as $detail)
                    @break($loop->index >= 2)
                    <li class="flex items-start gap-2">
                      <span class="mt-1 h-2 w-2 rounded-full bg-[rgba(219,165,84,1)]"></span>
                      <span class="line-clamp-1">{{ data_get($detail, 'detail', $detail) }}</span>
                    </li>
                  @endforeach
                </ul>
              @endif

              <div class="mt-4 flex items-center justify-between">
                <span class="text-[11px] sm:text-xs font-extrabold uppercase tracking-[0.2em] text-white/70">
                  Detail layanan
                </span>

                {{-- CTA: mobile selalu tampil, desktop muncul saat hover --}}
                <span class="inline-flex items-center gap-2 rounded-full bg-[rgba(219,165,84,0.14)] px-3 py-1 text-[11px] sm:text-xs font-extrabold text-[rgba(219,165,84,1)] ring-1 ring-[rgba(219,165,84,0.35)]
                             opacity-100 translate-y-0
                             sm:opacity-0 sm:translate-y-1 sm:transition sm:duration-300
                             sm:group-hover:opacity-100 sm:group-hover:translate-y-0
                             sm:group-focus-visible:opacity-100 sm:group-focus-visible:translate-y-0">
                  Lihat Detail <span aria-hidden="true">›</span>
                </span>
              </div>
            </div>
          </a>
        </article>
      @endforeach
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
(() => {
  const els = Array.from(document.querySelectorAll('.reveal'));
  if (!els.length) return;

  els.forEach(el => {
    el.style.opacity = 0;
    el.style.transform = 'translateY(14px)';
    el.style.transition = 'opacity 650ms ease, transform 650ms ease';
  });

  const io = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      const el = entry.target;
      el.style.opacity = 1;
      el.style.transform = 'translateY(0px)';
      io.unobserve(el);
    });
  }, { threshold: 0.12 });

  els.forEach(el => io.observe(el));
})();
</script>
@endpush
