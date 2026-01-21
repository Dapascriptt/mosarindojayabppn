@extends('layouts.app')
@section('title', 'Tentang Kami')

@section('content')
@php
  $resolveMedia = function ($path) {
      if (! $path) {
          return '';
      }
      if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://', '/'])) {
          return $path;
      }
      return \Illuminate\Support\Facades\Storage::url($path);
  };
  $highlights = data_get($about, 'highlights', []);
  $legalItems = data_get($about, 'legal_items', []);
  $sbuItems = data_get($about, 'sbu_items', []);
  $teamGroups = data_get($about, 'team_groups', []);
  $certText = data_get($about, 'certifications_text');
  $videoSrc = $resolveMedia(data_get($about, 'video_url', '/videos/about-us.mp4'));
@endphp
<section class="relative overflow-hidden bg-slate-950 text-white w-screen left-1/2 right-1/2 -ml-[50vw] -mr-[50vw]">
  @if ($videoSrc)
    <video class="absolute inset-0 h-full w-full object-cover" autoplay muted loop playsinline>
      <source src="{{ $videoSrc }}" type="video/mp4">
    </video>
  @endif
  <div class="absolute inset-0 bg-slate-950/60"></div>
  <div class="relative mx-auto max-w-6xl px-6 py-14 space-y-4">
    <p class="text-xs font-extrabold uppercase tracking-[0.2em] text-[rgba(219,165,84,1)]">Tentang Kami</p>
    <h1 class="text-3xl sm:text-4xl font-extrabold leading-tight">{{ data_get($about, 'hero_title') }}</h1>
    @if (data_get($about, 'hero_subtitle'))
      <p class="text-base sm:text-lg text-[rgba(219,165,84,1)] font-semibold">{{ data_get($about, 'hero_subtitle') }}</p>
    @endif
    <p class="text-base sm:text-lg text-slate-100">
      {{ data_get($about, 'hero_desc') }}
    </p>
    @if (!empty($highlights))
      <div class="flex flex-wrap gap-4 text-sm text-slate-100">
        @foreach ($highlights as $item)
          <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 ring-1 ring-white/15">{{ data_get($item, 'text', $item) }}</span>
        @endforeach
      </div>
    @endif
  </div>
</section>

<section class="mx-auto max-w-6xl px-6">
  <div class="mt-10 space-y-3">

    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Tentang Kami</h2>
    <p class="text-sm sm:text-base text-slate-600">
      Ringkasan profil perusahaan, fokus layanan, dan komitmen mutu untuk klien.
    </p>
  </div>

  <section class="mt-10 grid gap-6 md:grid-cols-3">
    <div class="reveal rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
      <h2 class="text-lg font-extrabold text-slate-900">Filosofi kerja</h2>
      <p class="mt-2 text-sm text-slate-700">Keselamatan dan mutu adalah prioritas. Setiap proyek dimulai dengan perencanaan detail, risk assessment, dan jadwal terukur.</p>
    </div>
    <div class="reveal rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
      <h2 class="text-lg font-extrabold text-slate-900">Spesialisasi</h2>
      <p class="mt-2 text-sm text-slate-700">Showroom otomotif, interior komersial, electrical panel & wiring, supply material termasuk batu split Palu, serta land clearing.</p>
    </div>
    <div class="reveal rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
      <h2 class="text-lg font-extrabold text-slate-900">Komitmen</h2>
      <p class="mt-2 text-sm text-slate-700">On-time delivery dengan laporan berkala, tim onsite bersertifikasi, dan komunikasi terbuka dengan klien.</p>
    </div>
  </section>

  <section class="mt-12 space-y-3">
 <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Legalitas</h2>
    <p class="text-sm sm:text-base text-slate-600">
      Dokumen perusahaan dan sertifikasi untuk memastikan proyek berjalan aman dan sesuai regulasi.
    </p>
  </section>

  <section class="mt-8 grid gap-6 lg:grid-cols-12">
    <div class="reveal lg:col-span-7 rounded-2xl bg-white p-6 sm:p-7 shadow-sm ring-1 ring-slate-200">
      <div class="flex items-start justify-between gap-4">
        <div>
          <h2 class="text-xl font-extrabold text-slate-900">Legalitas</h2>
          <p class="mt-1 text-sm text-slate-600">Ringkasan legalitas perusahaan sesuai dokumen.</p>
        </div>
        <span class="inline-flex items-center rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-800 ring-1 ring-emerald-100">
          Legalitas Perusahaan
        </span>
      </div>

      <div class="mt-6 space-y-4">
        <div class="rounded-xl bg-slate-50 p-4 ring-1 ring-slate-200">
          <div class="grid gap-3 text-sm">
            @foreach ($legalItems as $item)
              <div class="grid grid-cols-1 sm:grid-cols-12 gap-2">
                <div class="sm:col-span-4 font-semibold text-slate-700">{{ data_get($item, 'label') }}</div>
                <div class="sm:col-span-8 text-slate-700">: {{ data_get($item, 'value') }}</div>
              </div>
            @endforeach
          </div>
        </div>

        <div class="flex flex-wrap gap-2">
          <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
            <span class="h-2 w-2 rounded-full bg-emerald-500"></span> Dokumen lengkap tersedia
          </span>
          <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
            <span class="h-2 w-2 rounded-full bg-[rgba(219,165,84,1)]"></span> Siap verifikasi kebutuhan tender
          </span>
        </div>
      </div>
    </div>

    <div class="reveal lg:col-span-5 rounded-2xl bg-white p-6 sm:p-7 shadow-sm ring-1 ring-slate-200">
      <div class="flex items-start justify-between gap-4">
        <div>
          <h3 class="text-lg font-extrabold text-slate-900">SBU Kode</h3>
          <p class="mt-1 text-sm text-slate-600">Bidang usaha yang tercantum.</p>
        </div>
        <span class="inline-flex items-center rounded-full bg-[rgba(219,165,84,0.12)] px-3 py-1 text-xs font-bold text-[rgba(219,165,84,1)] ring-1 ring-[rgba(219,165,84,0.25)]">
          Sertifikasi
        </span>
      </div>

      <div class="mt-6 overflow-hidden rounded-xl ring-1 ring-slate-200">
        <div class="bg-slate-50 px-4 py-3 text-xs font-bold uppercase tracking-wider text-slate-600">
          Daftar SBU
        </div>
        <div class="divide-y divide-slate-200">
          @foreach ($sbuItems as $item)
            <div class="px-4 py-3">
              <div class="flex items-start justify-between gap-3">
                <span class="inline-flex shrink-0 items-center rounded-lg bg-slate-100 px-2 py-1 text-xs font-extrabold text-slate-800">{{ data_get($item, 'code') }}</span>
                <p class="text-sm text-slate-700">{{ data_get($item, 'desc') }}</p>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      <p class="mt-4 text-xs text-slate-500">
        *Keterangan mengikuti dokumen legalitas yang terlampir pada profil perusahaan.
      </p>
    </div>
  </section>

  <section class="mt-12 space-y-3">
    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Tenaga Ahli</h2>
    <p class="text-sm sm:text-base text-slate-600">
      Tim berpengalaman dengan kualifikasi sesuai bidang, siap mendukung kebutuhan proyek.
    </p>
  </section>

  <section class="mt-8 space-y-6">
    <div class="grid gap-4 md:grid-cols-2">
      @foreach ($teamGroups as $group)
        <div class="reveal rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
          <h2 class="text-lg font-extrabold text-slate-900">{{ data_get($group, 'title') }}</h2>
          <ul class="mt-3 space-y-2 text-sm text-slate-700">
            @foreach (data_get($group, 'members', []) as $member)
              <li class="flex items-center gap-2">
                <span class="inline-flex h-2 w-2 rounded-full bg-[rgba(219,165,84,1)]"></span>
                <span class="font-semibold">{{ data_get($member, 'name', $member) }}</span>
              </li>
            @endforeach
          </ul>
        </div>
      @endforeach
    </div>

    <div class="reveal rounded-2xl bg-slate-50 p-6 ring-1 ring-slate-200">
      <h3 class="text-base font-extrabold text-slate-900 uppercase tracking-[0.18em]">Kualifikasi & Sertifikasi</h3>
      <p class="mt-2 text-sm text-slate-700">
        {{ $certText }}
      </p>
    </div>
  </section>
</section>
@endsection

@push('scripts')
<script>
// Reveal effect for cards
(() => {
  const els = Array.from(document.querySelectorAll('.reveal'));
  els.forEach(el => {
    el.style.opacity = 0;
    el.style.transform = 'translateY(16px)';
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

