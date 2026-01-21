@extends('layouts.app')
@section('title', data_get($service, 'name'))

@section('content')
@php
  $resolveImage = function ($path) {
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
  $serviceImage = $resolveImage(data_get($service, 'image'));
  $heroMedia = data_get($service, 'hero_media') ?: data_get($service, 'image');
  $heroSrc = $resolveImage($heroMedia);
  $heroIsVideo = $isVideo($heroSrc);
@endphp
<section class="relative overflow-hidden bg-slate-950 text-white w-screen left-1/2 right-1/2 -ml-[50vw] -mr-[50vw]">
  @if ($heroIsVideo)
    <video class="absolute inset-0 h-full w-full object-cover" autoplay muted loop playsinline>
      <source src="{{ $heroSrc }}" type="video/mp4">
    </video>
  @else
    <div class="absolute inset-0 bg-cover bg-center" style="background-image:url('{{ $heroSrc }}')"></div>
  @endif
  <div class="absolute inset-0 bg-slate-950/70"></div>
  <div class="relative mx-auto max-w-5xl px-6 py-16 space-y-3">
    <p class="text-sm font-extrabold uppercase tracking-[0.18em] text-[rgba(219,165,84,1)]">Layanan</p>
    <h1 class="text-3xl sm:text-4xl font-extrabold leading-tight">{{ data_get($service, 'name') }}</h1>
    <p class="text-base sm:text-lg text-slate-100">{{ data_get($service, 'short_desc') }}</p>
  </div>
</section>

<section class="bg-slate-50 py-10">
  <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
    <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
      <div class="relative h-60 overflow-hidden rounded-2xl">
        <img src="{{ $serviceImage }}" alt="{{ data_get($service, 'name') }}" class="h-full w-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-slate-950/10 to-transparent"></div>
      </div>
      <div class="mt-6 space-y-3 text-sm text-slate-700">
        @foreach (preg_split("/\r\n|\r|\n/", data_get($service, 'description', data_get($service, 'short_desc', ''))) as $p)
          @if (trim($p) !== '')
            <p>{{ $p }}</p>
          @endif
        @endforeach
      </div>
    </div>

    <aside class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
      <h2 class="text-lg font-extrabold text-slate-900">Detail Layanan</h2>
      <p class="mt-2 text-sm text-slate-600">
        Ringkasan ruang lingkup yang biasa kami kerjakan.
      </p>
      <ul class="mt-4 space-y-3 text-sm text-slate-700">
        @foreach (data_get($service, 'details', []) as $detail)
          <li class="flex items-start gap-2">
            <span class="mt-1 h-2 w-2 rounded-full bg-[rgba(219,165,84,1)]"></span>
            <span>{{ data_get($detail, 'detail', $detail) }}</span>
          </li>
        @endforeach
      </ul>
      <a href="{{ route('contact') }}"
         class="mt-6 inline-flex items-center justify-center gap-2 rounded-xl bg-[rgba(219,165,84,1)] px-4 py-2 text-sm font-extrabold text-white shadow-sm hover:brightness-95 transition">
        Konsultasi Proyek
      </a>
    </aside>
  </div>
</section>
@endsection

