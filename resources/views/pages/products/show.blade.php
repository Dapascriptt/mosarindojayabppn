@extends('layouts.app')
@section('title', data_get($product, 'name'))

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
  $productImage = $resolveImage(data_get($product, 'image'));
  $heroMedia = data_get($product, 'hero_media') ?: data_get($product, 'image');
  $heroSrc = $resolveImage($heroMedia);
  $heroIsVideo = $isVideo($heroSrc);
@endphp
<section class="relative overflow-hidden bg-slate-950 text-white w-screen left-1/2 right-1/2 -ml-[50vw] -mr-[50vw]">
  @if ($heroIsVideo)
    <video class="absolute inset-0 h-full w-full object-cover" autoplay muted loop playsinline>
      <source src="{{ $heroSrc }}" type="video/mp4">
    </video>
  @else
    <div class="absolute inset-0 bg-cover bg-center opacity-30" style="background-image:url('{{ $heroSrc }}')"></div>
  @endif
  <div class="absolute inset-0 bg-slate-950/70"></div>
  <div class="relative mx-auto max-w-5xl px-6 py-14 space-y-3">
    <p class="text-sm font-extrabold uppercase tracking-[0.18em] text-[rgba(219,165,84,1)]">{{ data_get($product, 'category') }}</p>
    <h1 class="text-3xl sm:text-4xl font-extrabold leading-tight">{{ data_get($product, 'name') }}</h1>
    <p class="text-base sm:text-lg text-slate-100">{{ data_get($product, 'excerpt') }}</p>
  </div>
</section>

<section class="w-screen left-1/2 right-1/2 -ml-[50vw] -mr-[50vw] bg-slate-50 py-10">
  <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
    <div class="space-y-3 text-sm text-slate-700">
      @foreach (preg_split("/\r\n|\r|\n/", data_get($product, 'description', '')) as $p)
        @if (trim($p) !== '')
          <p>{{ $p }}</p>
        @endif
      @endforeach
    </div>
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
      <h2 class="text-base font-extrabold text-slate-900 uppercase tracking-[0.18em]">Detail Produk</h2>
      <ul class="mt-3 space-y-2 text-sm text-slate-700">
      @foreach (data_get($product, 'details', []) as $detail)
        <li class="flex items-start gap-2">
          <span class="mt-1 h-2 w-2 rounded-full bg-[rgba(219,165,84,1)]"></span>
          <span>{{ data_get($detail, 'detail', $detail) }}</span>
        </li>
      @endforeach
      </ul>
    </div>
  </div>
</section>
@endsection

