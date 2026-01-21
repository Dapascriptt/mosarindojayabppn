@extends('layouts.app')
@section('title', 'Layanan')

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
@endphp
<section class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white w-screen left-1/2 right-1/2 -ml-[50vw] -mr-[50vw]">
  <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1523413459209-3f3e43a2f7f0?auto=format&fit=crop&w=2000&q=80')] bg-cover bg-center opacity-25"></div>
  <div class="absolute inset-0 bg-slate-950/65"></div>
  <div class="relative mx-auto max-w-5xl px-6 py-14 space-y-3">
    <p class="text-sm font-extrabold uppercase tracking-[0.18em] text-[rgba(219,165,84,1)]">Layanan</p>
    <h1 class="text-3xl sm:text-4xl font-extrabold leading-tight">Solusi lengkap konstruksi & supply</h1>
    <p class="text-base sm:text-lg text-slate-100">Showroom, sipil, interior, electrical, supply material, hingga land clearing.</p>
  </div>
</section>

<section class="mt-10">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
    @foreach ($services as $service)
      <article id="{{ data_get($service, 'slug') }}">
        <a href="{{ route('services.show', data_get($service, 'slug')) }}"
           class="group block overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-200 transition hover:-translate-y-1 hover:shadow-xl">
          <div class="relative h-44 overflow-hidden">
            <img src="{{ $resolveImage(data_get($service, 'image')) }}" alt="{{ data_get($service, 'name') }}" class="h-full w-full object-cover transition duration-700 group-hover:scale-[1.05]">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-slate-950/10 to-transparent"></div>
            <span class="absolute left-4 top-4 inline-flex items-center gap-2 rounded-full bg-white/90 px-3 py-1 text-xs font-extrabold text-slate-900 ring-1 ring-white/40">
              <span class="h-2 w-2 rounded-full bg-[rgba(219,165,84,1)]"></span>
              Layanan
            </span>
          </div>
          <div class="p-6 space-y-3">
            <h2 class="text-lg font-extrabold text-slate-900">{{ data_get($service, 'name') }}</h2>
            <p class="text-sm text-slate-600">{{ data_get($service, 'short_desc') }}</p>
            <ul class="space-y-2 text-sm text-slate-700">
              @foreach (data_get($service, 'details', []) as $detail)
                <li class="flex items-start gap-2">
                  <span class="mt-1 h-2 w-2 rounded-full bg-[rgba(219,165,84,1)]"></span>
                  <span>{{ data_get($detail, 'detail', $detail) }}</span>
                </li>
              @endforeach
            </ul>
            <span class="inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-[0.2em] text-slate-500">
              Detail layanan <span aria-hidden="true">></span>
            </span>
          </div>
        </a>
      </article>
    @endforeach
  </div>
</section>
@endsection

