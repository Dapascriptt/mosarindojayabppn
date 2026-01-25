@extends('layouts.app')
@section('title', 'Kontak | Mosarindo Balikpapan')
@section('meta_description', 'Hubungi Mosarindo Jaya Balikpapan untuk kebutuhan konstruksi, MEP, interior, supply material, dan pengadaan proyek B2B.')
@section('canonical', url()->current())
@section('meta_image', asset('image/hero1.png'))
@section('meta_robots', 'index, follow')

@section('content')

{{-- HERO FULL-BLEED (rapi & center) --}}
@php
  $contactData = $contact ?? [];
  $resolveImage = function ($path) {
      if (! $path) {
          return '';
      }
      if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://', '/'])) {
          return $path;
      }
      return \Illuminate\Support\Facades\Storage::url($path);
  };
  $heroBg = $resolveImage(data_get($contactData, 'hero_bg', asset('image/hero1.png')));
  $mapsEmbed = data_get($contactData, 'maps_embed_url', '');
  if ($mapsEmbed && str_contains($mapsEmbed, '<iframe')) {
      if (preg_match('/src=[\"\\\']([^\"\\\']+)[\"\\\']/', $mapsEmbed, $m)) {
          $mapsEmbed = $m[1];
      }
  }
  $whatsAppRaw = data_get($contactData, 'whatsapp', '');
  $whatsAppDigits = preg_replace('/\\D+/', '', $whatsAppRaw);
@endphp
<div class="relative left-1/2 -translate-x-1/2 w-screen">
  <section class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white">
    <div class="absolute inset-0 bg-cover bg-center opacity-25" style="background-image:url('{{ $heroBg }}')"></div>
    <div class="absolute inset-0 bg-slate-950/65"></div>

    <div class="relative mx-auto max-w-6xl px-4 sm:px-6 lg:px-10 py-14 sm:py-16 space-y-3">
      <p class="text-sm font-extrabold uppercase tracking-[0.18em] text-[rgba(219,165,84,1)]">Hubungi Kami</p>
      <h1 class="text-3xl sm:text-4xl font-extrabold leading-tight">
        {{ data_get($contactData, 'hero_title', 'Kami siap membantu proyek Anda') }}
      </h1>
      <p class="text-base sm:text-lg text-slate-100/90 max-w-3xl">
        {{ data_get($contactData, 'hero_desc', 'Sampaikan kebutuhan konstruksi, interior, electrical, supply material, atau land clearing. Tim kami akan merespons secepatnya.') }}
      </p>
    </div>
  </section>
</div>

{{-- FORM + INFO (FULL-BLEED BG tapi konten center) --}}
<div class="relative left-1/2 -translate-x-1/2 w-screen bg-slate-50 py-10 sm:py-12">
  <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-10 grid gap-8 lg:grid-cols-[1.15fr_0.85fr] items-start">

    {{-- Form --}}
    <div class="rounded-2xl bg-white p-6 sm:p-7 shadow-sm ring-1 ring-slate-200">
      <h2 class="text-xl font-extrabold text-slate-900">{{ data_get($contactData, 'form_title', 'Form Kontak') }}</h2>
      <p class="mt-2 text-sm text-slate-600">{{ data_get($contactData, 'form_desc', 'Isi data di bawah, kami akan menghubungi Anda.') }}</p>

      <form action="{{ route('contact.submit') }}" method="POST" class="mt-6 space-y-4">
        @csrf

        <div class="grid gap-3 sm:grid-cols-2">
          <div>
            <label class="block text-sm font-semibold text-slate-800">Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" required
              class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2.5
                     focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">
            @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
          </div>

          <div>
            <label class="block text-sm font-semibold text-slate-800">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
              class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2.5
                     focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">
            @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
          </div>
        </div>

        <div>
          <label class="block text-sm font-semibold text-slate-800">Subjek</label>
          <input type="text" name="subject" value="{{ old('subject') }}" required
            class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2.5
                   focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">
          @error('subject') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
          <label class="block text-sm font-semibold text-slate-800">Pesan</label>
          <textarea name="message" rows="6" required
            class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2.5
                   focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">{{ old('message') }}</textarea>
          @error('message') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <button type="submit"
          class="inline-flex items-center justify-center rounded-xl bg-[rgba(219,165,84,1)] px-5 py-3
                 text-sm font-extrabold text-white shadow-sm shadow-[rgba(219,165,84,0.2)]
                 hover:brightness-95 transition">
          Kirim Pesan
        </button>
      </form>
    </div>

    {{-- Info --}}
    <div class="rounded-2xl bg-white p-6 sm:p-7 shadow-sm ring-1 ring-slate-200">
      <h2 class="text-xl font-extrabold text-slate-900">{{ data_get($contactData, 'info_title', 'Kontak Kami') }}</h2>

      <div class="mt-4 rounded-xl bg-slate-50 p-4 ring-1 ring-slate-200">
        <p class="text-sm font-extrabold text-slate-900">{{ data_get($contactData, 'company_name', 'PT. Mosarindo Jaya Balikpapan') }}</p>
        <p class="mt-2 text-sm text-slate-700 leading-relaxed">
          {!! nl2br(e(data_get($contactData, 'address', "Jalan MT Haryono No 43, Kelurahan Damai, Bahagia,\nKec. Balikpapan Kota, Kota Balikpapan,\nKalimantan Timur 76114"))) !!}
        </p>
      </div>

      <div class="mt-5 space-y-3 text-sm">
        <div class="flex items-center justify-between gap-3 rounded-xl bg-white p-3 ring-1 ring-slate-200">
          <span class="font-semibold text-slate-800">WhatsApp</span>
          <a href="https://wa.me/{{ $whatsAppDigits }}" class="font-bold text-[rgba(219,165,84,1)] hover:text-[rgba(219,165,84,1)]">
            {{ data_get($contactData, 'whatsapp', '+62 812 5489 9699') }}
          </a>
        </div>

        <div class="flex items-center justify-between gap-3 rounded-xl bg-white p-3 ring-1 ring-slate-200">
          <span class="font-semibold text-slate-800">Email</span>
          <a href="mailto:{{ data_get($contactData, 'email', 'pt.mosarindojayabpp@gmail.com') }}" class="font-bold text-[rgba(219,165,84,1)] hover:text-[rgba(219,165,84,1)]">
           {{ data_get($contactData, 'email', 'pt.mosarindojayabpp@gmail.com') }}
          </a>
        </div>
      </div>

      <div class="mt-5 flex flex-wrap gap-2">
        <a href="https://wa.me/{{ $whatsAppDigits }}"
           class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-bold text-white hover:bg-emerald-700 transition">
          {{ data_get($contactData, 'cta_whatsapp_label', 'Chat WhatsApp') }}
        </a>
        <a href="mailto:{{ data_get($contactData, 'email', 'pt.mosarindojayabpp@gmail.com') }}"
           class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-bold text-white hover:bg-slate-800 transition">
          {{ data_get($contactData, 'cta_email_label', 'Kirim Email') }}
        </a>
      </div>
    </div>

  </div>
</div>

{{-- MAP FULL-BLEED (ga geser kiri) --}}
<div class="relative left-1/2 -translate-x-1/2 w-screen">
  <section class="bg-white">
    <iframe
      class="block w-full h-[380px] sm:h-[420px]"
      src="{{ $mapsEmbed }}"
      style="border:0;"
      allowfullscreen=""
      loading="lazy"
      referrerpolicy="no-referrer-when-downgrade"></iframe>
  </section>
</div>

@endsection
