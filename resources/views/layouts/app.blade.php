<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', config('app.name'))</title>
  <meta name="description" content="@yield('meta_description', 'Perusahaan jasa konstruksi, MEP, interior, dan supply material di Balikpapan. Siap mendukung proyek B2B dan instansi.')">
  <meta name="robots" content="@yield('meta_robots', 'index, follow')">
  <link rel="canonical" href="@yield('canonical', url()->current())">

  <meta property="og:type" content="website">
  <meta property="og:site_name" content="{{ config('app.name') }}">
  <meta property="og:title" content="@yield('title', config('app.name'))">
  <meta property="og:description" content="@yield('meta_description', 'Perusahaan jasa konstruksi, MEP, interior, dan supply material di Balikpapan. Siap mendukung proyek B2B dan instansi.')">
  <meta property="og:url" content="@yield('canonical', url()->current())">
  <meta property="og:image" content="@yield('meta_image', asset('image/logo-mjb.png'))">

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="@yield('title', config('app.name'))">
  <meta name="twitter:description" content="@yield('meta_description', 'Perusahaan jasa konstruksi, MEP, interior, dan supply material di Balikpapan. Siap mendukung proyek B2B dan instansi.')">
  <meta name="twitter:image" content="@yield('meta_image', asset('image/logo-mjb.png'))">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900 antialiased overflow-x-hidden">
  @include('partials.navbar')

  <main class="min-h-screen">
    @if (session('status'))
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-6">
        <div class="mb-6 rounded-xl border border-emerald-100 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
          {{ session('status') }}
        </div>
      </div>
    @endif

    @yield('content')
  </main>

  @include('partials.footer')
  @php
    $waRaw = env('APP_WA_NUMBER', '6281254899699');
    $waNumber = preg_replace('/\D+/', '', $waRaw) ?: '6281283800498';
    $waLink = 'https://wa.me/' . $waNumber;
  @endphp

  {{-- FAB SOSMED (WA di atas, IG di bawah) --}}
  <div class="fixed bottom-5 right-5 z-50 flex flex-col items-center gap-3">
    {{-- WhatsApp --}}
    <a href="{{ $waLink }}" target="_blank" rel="noopener"
       class="inline-flex h-14 w-14 items-center justify-center rounded-full bg-emerald-500 text-white shadow-lg shadow-emerald-500/40 hover:bg-emerald-600 transition"
       aria-label="WhatsApp">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor">
        <path d="M20.52 3.48A11.87 11.87 0 0 0 12.04.9C5.65 1 .31 5.99.08 12.37c-.08 2.01.41 3.96 1.42 5.69L0 24l6.07-1.57a11.9 11.9 0 0 0 5.62 1.42h.46c6.35-.22 11.38-5.6 11.16-11.95a11.87 11.87 0 0 0-2.79-8.42ZM12 21.42c-1.75 0-3.45-.49-4.93-1.41l-.35-.21-3.6.93.96-3.51-.23-.36a9.38 9.38 0 0 1-1.45-5.11C2.53 6.6 7 2.23 12.39 2.4c5.11.16 9.17 4.45 9.01 9.56a9.39 9.39 0 0 1-9.4 9.46h0ZM17.05 14c-.27-.14-1.61-.8-1.86-.9-.25-.09-.43-.14-.62.14-.19.27-.71.9-.87 1.08-.16.18-.32.2-.59.07-.27-.13-1.12-.41-2.14-1.3-.79-.7-1.32-1.57-1.48-1.84-.16-.27-.02-.42.12-.56.12-.12.27-.32.41-.48.14-.16.19-.27.28-.45.09-.18.05-.34-.02-.48-.07-.14-.62-1.49-.85-2.04-.22-.52-.44-.45-.62-.46-.16-.01-.34-.01-.52-.01-.18 0-.48.07-.73.34-.25.27-.96.94-.96 2.3 0 1.36.99 2.67 1.12 2.85.14.18 1.94 3.11 4.71 4.36.66.29 1.18.46 1.58.59.66.21 1.26.18 1.74.11.53-.08 1.61-.66 1.84-1.29.23-.63.23-1.17.16-1.29-.07-.11-.25-.18-.52-.31Z"/>
      </svg>
    </a>

    {{-- Instagram --}}
    <a href="https://instagram.com/mosarindojaya" target="_blank" rel="noopener"
       style="background: linear-gradient(135deg, #833AB4 0%, #FD1D1D 50%, #FCAF45 100%);"
       class="inline-flex h-14 w-14 items-center justify-center rounded-full text-white shadow-lg hover:scale-105 transition"
       aria-label="Instagram">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24">
        <path d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm0 2h10c1.66 0 3 1.34 3 3v10c0 1.66-1.34 3-3 3H7c-1.66 0-3-1.34-3-3V7c0-1.66 1.34-3 3-3zm11 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zM12 7a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm0 2a3 3 0 1 1 0 6 3 3 0 0 1 0-6z"/>
      </svg>
    </a>
  </div>

  @stack('scripts')
</body>
</html>
