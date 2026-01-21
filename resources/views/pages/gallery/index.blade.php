@extends('layouts.app')
@section('title', 'Galeri')

@section('content')
<section class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white w-screen left-1/2 right-1/2 -ml-[50vw] -mr-[50vw]">
  <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=2000&q=80')] bg-cover bg-center opacity-30"></div>
  <div class="absolute inset-0 bg-slate-950/60"></div>
  <div class="relative mx-auto max-w-5xl px-6 py-14 space-y-3">
    <p class="text-sm font-extrabold uppercase tracking-[0.18em] text-[rgba(219,165,84,1)]">Galeri Proyek</p>
    <h1 class="text-3xl sm:text-4xl font-extrabold leading-tight">Showroom, interior, electrical, supply, land clearing</h1>
    <p class="text-base sm:text-lg text-slate-100">Klik kartu untuk melihat lebih banyak foto dan detail singkat.</p>
  </div>
</section>

<section class="mt-10">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
    @foreach ($items as $item)
      @php
        $images = data_get($item, 'images', []);
        $cover = $images[0] ?? 'https://images.unsplash.com/photo-1523413459209-3f3e43a2f7f0?auto=format&fit=crop&w=1600&q=80';
        $payload = htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8');
      @endphp
      <button type="button"
        class="gallery-card group overflow-hidden rounded-3xl bg-white text-left shadow-sm ring-1 ring-slate-200 transition hover:-translate-y-1 hover:shadow-xl"
        data-gallery-item="{{ $payload }}">
        <div class="relative h-48 overflow-hidden">
          <img src="{{ $cover }}" alt="{{ data_get($item, 'title') }}"
               class="h-full w-full object-cover transition duration-700 group-hover:scale-[1.05]">
          <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-slate-950/15 to-transparent"></div>
          <span class="absolute left-4 top-4 inline-flex items-center gap-2 rounded-full bg-white/90 px-3 py-1 text-xs font-extrabold text-slate-900 ring-1 ring-white/50">
            <span class="h-2 w-2 rounded-full bg-[rgba(219,165,84,1)]"></span>
            {{ data_get($item, 'tag') }}
          </span>
        </div>
        <div class="p-5 space-y-2">
          <h3 class="text-lg font-extrabold text-slate-900">{{ data_get($item, 'title') }}</h3>
          <p class="text-sm text-slate-600 line-clamp-2">{{ data_get($item, 'desc') }}</p>
          <span class="inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-[0.2em] text-slate-500">
            Lihat foto <span aria-hidden="true">></span>
          </span>
        </div>
      </button>
    @endforeach
  </div>
</section>

{{-- Modal --}}
<div id="galleryModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/75 px-4">
  <div class="relative w-full max-w-5xl overflow-hidden rounded-3xl bg-white shadow-2xl">
    <button type="button" class="absolute right-4 top-4 rounded-full bg-slate-900 text-white p-2" data-gallery-close>
      <span class="sr-only">Tutup</span>
      X
    </button>
    <div class="grid gap-4 p-5 lg:grid-cols-2">
      <div class="relative">
        <img id="galleryModalImage" src="" alt="" class="h-full w-full rounded-2xl object-cover">
        <button type="button" class="absolute left-3 top-1/2 -translate-y-1/2 rounded-full bg-white/90 p-2 shadow" data-gallery-prev><</button>
        <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 rounded-full bg-white/90 p-2 shadow" data-gallery-next>></button>
      </div>
      <div class="space-y-3">
        <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-[rgba(219,165,84,1)]" id="galleryModalTag"></p>
        <h3 class="text-2xl font-extrabold text-slate-900" id="galleryModalTitle"></h3>
        <p class="text-sm text-slate-700" id="galleryModalDesc"></p>
        <div class="pt-2">
          <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-500">Foto lainnya</p>
          <div id="galleryModalThumbs" class="mt-3 grid grid-cols-3 gap-3 sm:grid-cols-4"></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
(() => {
  const modal = document.getElementById('galleryModal');
  const imgEl = document.getElementById('galleryModalImage');
  const tagEl = document.getElementById('galleryModalTag');
  const titleEl = document.getElementById('galleryModalTitle');
  const descEl = document.getElementById('galleryModalDesc');
  const thumbsEl = document.getElementById('galleryModalThumbs');
  const prevBtn = modal?.querySelector('[data-gallery-prev]');
  const nextBtn = modal?.querySelector('[data-gallery-next]');
  const closeBtn = modal?.querySelector('[data-gallery-close]');
  let current = { images: [], idx: 0 };

  const open = (item) => {
    current = { images: item.images || [], idx: 0, tag: item.tag, title: item.title, desc: item.desc };
    update();
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
  };

  const close = () => {
    modal.classList.add('hidden');
    document.body.style.overflow = '';
  };

  const update = () => {
    if (!current.images.length) return;
    imgEl.src = current.images[current.idx];
    imgEl.alt = current.title || '';
    tagEl.textContent = current.tag || '';
    titleEl.textContent = current.title || '';
    descEl.textContent = current.desc || '';
    if (thumbsEl) {
      thumbsEl.innerHTML = '';
      current.images.forEach((src, i) => {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = `group relative overflow-hidden rounded-xl ring-2 ${i === current.idx ? 'ring-[rgba(219,165,84,1)]' : 'ring-transparent'} transition`;
        btn.innerHTML = `<img src="${src}" alt="" class="h-16 w-full object-cover transition duration-300 group-hover:scale-[1.03]">`;
        btn.addEventListener('click', () => {
          current.idx = i;
          update();
        });
        thumbsEl.appendChild(btn);
      });
    }
  };

  const next = () => {
    if (!current.images.length) return;
    current.idx = (current.idx + 1) % current.images.length;
    update();
  };
  const prev = () => {
    if (!current.images.length) return;
    current.idx = (current.idx - 1 + current.images.length) % current.images.length;
    update();
  };

  document.querySelectorAll('[data-gallery-item]').forEach(btn => {
    btn.addEventListener('click', () => {
      try {
        const data = JSON.parse(btn.getAttribute('data-gallery-item') || '{}');
        open(data);
      } catch (_) {}
    });
  });

  closeBtn?.addEventListener('click', close);
  modal?.addEventListener('click', (e) => {
    if (e.target === modal) close();
  });
  nextBtn?.addEventListener('click', next);
  prevBtn?.addEventListener('click', prev);
})();
</script>
@endpush

