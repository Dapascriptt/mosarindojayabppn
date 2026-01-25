@extends('layouts.app')
@section('title', 'Katalog Produk Balikpapan | Mosarindo')
@section('meta_description', 'Katalog produk supply material, kebutuhan proyek, dan pengadaan B2B di Balikpapan. Spesifikasi jelas dan dukungan pengiriman.')
@section('canonical', url()->current())
@section('meta_image', asset('image/hero1.png'))
@section('meta_robots', 'index, follow')

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
    <p class="text-sm font-extrabold uppercase tracking-[0.18em] text-[rgba(219,165,84,1)]">Produk</p>
    <h1 class="text-3xl sm:text-4xl font-extrabold leading-tight">Katalog produk supply Balikpapan</h1>
    <p class="text-base sm:text-lg text-slate-100">Pengadaan material, kebutuhan proyek, dan dukungan supply B2B dengan spesifikasi jelas.</p>
  </div>
</section>

<section class="bg-slate-50 py-10">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-6">
    @php
      $labels = [
        'mjb-kontraktor' => 'MJB Kontraktor',
        'mjb-food' => 'MJB Food',
      ];
    @endphp

    @foreach ($labels as $key => $label)
      @php $list = data_get($groups, $key, collect()); @endphp
      <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-200">
        <button type="button"
          class="product-acc-toggle flex w-full items-center justify-between gap-3 px-6 py-5 text-left">
          <div>

            <h2 class="text-xl font-extrabold text-slate-900">{{ $label }}</h2>
          </div>
          <span class="product-acc-icon grid h-10 w-10 place-items-center rounded-xl border border-slate-200 bg-white text-slate-700 shadow-sm transition">
            <svg class="h-5 w-5 transition" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
            </svg>
          </span>
        </button>

        <div class="product-acc-panel border-t border-slate-200">
          <div class="p-6 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($list as $product)
              <a href="{{ route('products.show', data_get($product, 'slug')) }}"
                 class="group overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-200 transition hover:-translate-y-1 hover:shadow-xl">
                <div class="relative h-44 overflow-hidden">
                  <img src="{{ $resolveImage(data_get($product, 'image')) }}" alt="{{ data_get($product, 'name') }}" class="h-full w-full object-cover transition duration-700 group-hover:scale-[1.05]">
                  <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-slate-950/10 to-transparent"></div>
                  <span class="absolute left-4 top-4 inline-flex items-center gap-2 rounded-full bg-white/90 px-3 py-1 text-xs font-extrabold text-slate-900 ring-1 ring-white/50">
                    <span class="h-2 w-2 rounded-full bg-[rgba(219,165,84,1)]"></span>
                    {{ data_get($product, 'category') }}
                  </span>
                </div>
                <div class="p-5 space-y-2">
                  <h2 class="text-lg font-extrabold text-slate-900">{{ data_get($product, 'name') }}</h2>
                  <p class="text-sm text-slate-600">{{ data_get($product, 'excerpt') }}</p>
                  <span class="inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-[0.2em] text-slate-500">
                    Detail produk <span aria-hidden="true">></span>
                  </span>
                </div>
              </a>
            @empty
              <div class="rounded-2xl bg-slate-50 p-6 text-sm text-slate-600 ring-1 ring-slate-200">
                Belum ada produk untuk tipe ini.
              </div>
            @endforelse
          </div>
        </div>
      </div>
    @endforeach
  </div>
</section>
@endsection
