<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', config('app.name'))</title>
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
  @stack('scripts')
</body>
</html>
