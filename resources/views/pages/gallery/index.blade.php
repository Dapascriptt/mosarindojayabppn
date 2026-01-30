@extends('layouts.app')
@section('title', 'Galeri Proyek Balikpapan | Mosarindo')
@section('meta_description', 'Galeri dokumentasi proyek konstruksi, interior,  dan supply Mosarindo Jaya Balikpapan.')
@section('canonical', url()->current())
@section('meta_image', asset('image/hero1.png'))
@section('meta_robots', 'index, follow')

@section('content')
<section class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white w-screen left-1/2 right-1/2 -ml-[50vw] -mr-[50vw]">
  <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=2000&q=80')] bg-cover bg-center opacity-30"></div>
  <div class="absolute inset-0 bg-slate-950/60"></div>
  <div class="relative mx-auto max-w-5xl px-6 py-14 space-y-3">
    <p class="text-sm font-extrabold uppercase tracking-[0.18em] text-[rgba(219,165,84,1)]">Galeri Proyek</p>
    <h1 class="text-3xl sm:text-4xl font-extrabold leading-tight">Interior, electrical, supply, land clearing</h1>
    <p class="text-base sm:text-lg text-slate-100">Klik kartu untuk melihat lebih banyak foto dan detail singkat.</p>
  </div>
</section>

<section class="mt-10">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
    @foreach ($items as $item)
      @php
        $beforeImages = data_get($item, 'before_images', []);
        $afterImages = data_get($item, 'after_images', []);
        $fallbackImages = data_get($item, 'images', []);
        $cover = $beforeImages[0] ?? $afterImages[0] ?? $fallbackImages[0] ?? 'https://images.unsplash.com/photo-1523413459209-3f3e43a2f7f0?auto=format&fit=crop&w=1600&q=80';
      @endphp
      <button type="button"
        class="gallery-card group overflow-hidden rounded-3xl bg-white text-left shadow-sm ring-1 ring-slate-200 transition hover:-translate-y-1 hover:shadow-xl cursor-pointer"
        data-gallery-before='@json($beforeImages)'
        data-gallery-after='@json($afterImages)'
        data-gallery-images='@json($fallbackImages)'
        data-gallery-title="{{ e(data_get($item, 'title')) }}"
        data-gallery-tag="{{ e(data_get($item, 'tag')) }}"
        data-gallery-desc="{{ e(data_get($item, 'desc')) }}">
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
          <span class="inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-[0.2em] text-[rgba(219,165,84,1)] group-hover:gap-3 transition-all">
            Lihat lebih banyak foto
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </span>
        </div>
      </button>
    @endforeach
  </div>
</section>

{{-- Modal --}}
<div id="galleryModal" class="fixed inset-0 z-50 hidden items-start justify-center bg-slate-900/75 px-4 py-6" style="display: none;">
  <div class="relative w-full max-w-6xl overflow-y-auto rounded-3xl bg-white shadow-2xl" onclick="event.stopPropagation()" style="max-height: 90vh;">
    <button type="button" class="absolute right-4 top-4 z-10 rounded-full bg-slate-900 text-white p-2 hover:bg-slate-700 transition" onclick="closeGallery()">
      <span class="sr-only">Tutup</span>
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
      </svg>
    </button>
    <div class="grid gap-4 p-5">
      <div id="galleryModalSplit" class="grid gap-4 md:grid-cols-2">
        <div class="rounded-2xl border border-slate-200 p-3">
          <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-500">Sebelum</p>
          <div class="relative mt-2">
            <img id="galleryModalBeforeImage" src="" alt="" class="h-60 w-full rounded-xl object-cover">
            <button type="button" class="absolute left-2 top-1/2 -translate-y-1/2 rounded-full bg-white/90 p-2 shadow" onclick="prevBefore()">&#8249;</button>
            <button type="button" class="absolute right-2 top-1/2 -translate-y-1/2 rounded-full bg-white/90 p-2 shadow" onclick="nextBefore()">&#8250;</button>
          </div>
          <div id="galleryModalBeforeThumbs" class="mt-3 grid grid-cols-4 gap-2"></div>
        </div>
        <div class="rounded-2xl border border-slate-200 p-3">
          <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-500">Sesudah</p>
          <div class="relative mt-2">
            <img id="galleryModalAfterImage" src="" alt="" class="h-60 w-full rounded-xl object-cover">
            <button type="button" class="absolute left-2 top-1/2 -translate-y-1/2 rounded-full bg-white/90 p-2 shadow" onclick="prevAfter()">&#8249;</button>
            <button type="button" class="absolute right-2 top-1/2 -translate-y-1/2 rounded-full bg-white/90 p-2 shadow" onclick="nextAfter()">&#8250;</button>
          </div>
          <div id="galleryModalAfterThumbs" class="mt-3 grid grid-cols-4 gap-2"></div>
        </div>
      </div>
      <div id="galleryModalSingle" class="hidden rounded-2xl border border-slate-200 p-3">
        <div class="relative mt-2">
          <img id="galleryModalSingleImage" src="" alt="" class="h-72 w-full rounded-xl object-cover">
          <button type="button" class="absolute left-2 top-1/2 -translate-y-1/2 rounded-full bg-white/90 p-2 shadow" onclick="prevSingle()">&#8249;</button>
          <button type="button" class="absolute right-2 top-1/2 -translate-y-1/2 rounded-full bg-white/90 p-2 shadow" onclick="nextSingle()">&#8250;</button>
        </div>
        <div id="galleryModalSingleThumbs" class="mt-3 grid grid-cols-4 gap-2"></div>
      </div>
      <div class="space-y-3">
        <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-[rgba(219,165,84,1)]" id="galleryModalTag"></p>
        <h3 class="text-2xl font-extrabold text-slate-900" id="galleryModalTitle"></h3>
        <p class="text-sm text-slate-700" id="galleryModalDesc"></p>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
let currentGallery = { before: [], after: [], single: [], idxBefore: 0, idxAfter: 0, idxSingle: 0, tag: '', title: '', desc: '' };

function openGalleryFromData({ before, after, fallback, title, tag, desc }) {
  const beforeList = before?.length ? before : [];
  const afterList = after?.length ? after : [];
  const fallbackList = fallback?.length ? fallback : [];
  currentGallery = {
    before: beforeList,
    after: afterList,
    single: fallbackList,
    idxBefore: 0,
    idxAfter: 0,
    idxSingle: 0,
    tag: tag || '',
    title: title || '',
    desc: desc || ''
  };
  updateGalleryModal();
  const modal = document.getElementById('galleryModal');
  modal.style.display = 'flex';
  modal.classList.remove('hidden');
  document.body.style.overflow = 'hidden';
}

function closeGallery() {
  const modal = document.getElementById('galleryModal');
  modal.style.display = 'none';
  modal.classList.add('hidden');
  document.body.style.overflow = '';
}

function updateGalleryModal() {
  const beforeImg = document.getElementById('galleryModalBeforeImage');
  const afterImg = document.getElementById('galleryModalAfterImage');
  const singleImg = document.getElementById('galleryModalSingleImage');
  const tagEl = document.getElementById('galleryModalTag');
  const titleEl = document.getElementById('galleryModalTitle');
  const descEl = document.getElementById('galleryModalDesc');
  const beforeThumbs = document.getElementById('galleryModalBeforeThumbs');
  const afterThumbs = document.getElementById('galleryModalAfterThumbs');
  const singleThumbs = document.getElementById('galleryModalSingleThumbs');
  const splitWrap = document.getElementById('galleryModalSplit');
  const singleWrap = document.getElementById('galleryModalSingle');

  const useSingle = (!currentGallery.before.length && !currentGallery.after.length) && currentGallery.single.length;
  if (useSingle) {
    splitWrap?.classList.add('hidden');
    singleWrap?.classList.remove('hidden');
  } else {
    splitWrap?.classList.remove('hidden');
    singleWrap?.classList.add('hidden');
  }

  if (beforeImg && currentGallery.before.length) {
    beforeImg.src = currentGallery.before[currentGallery.idxBefore];
    beforeImg.alt = currentGallery.title;
  }
  if (afterImg && currentGallery.after.length) {
    afterImg.src = currentGallery.after[currentGallery.idxAfter];
    afterImg.alt = currentGallery.title;
  }
  if (singleImg && currentGallery.single.length) {
    singleImg.src = currentGallery.single[currentGallery.idxSingle];
    singleImg.alt = currentGallery.title;
  }
  tagEl.textContent = currentGallery.tag;
  titleEl.textContent = currentGallery.title;
  descEl.textContent = currentGallery.desc;

  if (beforeThumbs) {
    beforeThumbs.innerHTML = '';
    currentGallery.before.forEach((src, i) => {
      const btn = document.createElement('button');
      btn.type = 'button';
      btn.className = `group relative overflow-hidden rounded-lg ring-2 ${i === currentGallery.idxBefore ? 'ring-[rgba(219,165,84,1)]' : 'ring-transparent'} transition`;
      btn.innerHTML = `<img src="${src}" alt="" class="h-12 w-full object-cover transition duration-300 group-hover:scale-[1.03]">`;
      btn.onclick = function(e) {
        e.stopPropagation();
        currentGallery.idxBefore = i;
        updateGalleryModal();
      };
      beforeThumbs.appendChild(btn);
    });
  }

  if (afterThumbs) {
    afterThumbs.innerHTML = '';
    currentGallery.after.forEach((src, i) => {
      const btn = document.createElement('button');
      btn.type = 'button';
      btn.className = `group relative overflow-hidden rounded-lg ring-2 ${i === currentGallery.idxAfter ? 'ring-[rgba(219,165,84,1)]' : 'ring-transparent'} transition`;
      btn.innerHTML = `<img src="${src}" alt="" class="h-12 w-full object-cover transition duration-300 group-hover:scale-[1.03]">`;
      btn.onclick = function(e) {
        e.stopPropagation();
        currentGallery.idxAfter = i;
        updateGalleryModal();
      };
      afterThumbs.appendChild(btn);
    });
  }

  if (singleThumbs) {
    singleThumbs.innerHTML = '';
    currentGallery.single.forEach((src, i) => {
      const btn = document.createElement('button');
      btn.type = 'button';
      btn.className = `group relative overflow-hidden rounded-lg ring-2 ${i === currentGallery.idxSingle ? 'ring-[rgba(219,165,84,1)]' : 'ring-transparent'} transition`;
      btn.innerHTML = `<img src="${src}" alt="" class="h-12 w-full object-cover transition duration-300 group-hover:scale-[1.03]">`;
      btn.onclick = function(e) {
        e.stopPropagation();
        currentGallery.idxSingle = i;
        updateGalleryModal();
      };
      singleThumbs.appendChild(btn);
    });
  }
}

function nextBefore() {
  if (!currentGallery.before.length) return;
  currentGallery.idxBefore = (currentGallery.idxBefore + 1) % currentGallery.before.length;
  updateGalleryModal();
}

function prevBefore() {
  if (!currentGallery.before.length) return;
  currentGallery.idxBefore = (currentGallery.idxBefore - 1 + currentGallery.before.length) % currentGallery.before.length;
  updateGalleryModal();
}

function nextAfter() {
  if (!currentGallery.after.length) return;
  currentGallery.idxAfter = (currentGallery.idxAfter + 1) % currentGallery.after.length;
  updateGalleryModal();
}

function prevAfter() {
  if (!currentGallery.after.length) return;
  currentGallery.idxAfter = (currentGallery.idxAfter - 1 + currentGallery.after.length) % currentGallery.after.length;
  updateGalleryModal();
}

function nextSingle() {
  if (!currentGallery.single.length) return;
  currentGallery.idxSingle = (currentGallery.idxSingle + 1) % currentGallery.single.length;
  updateGalleryModal();
}

function prevSingle() {
  if (!currentGallery.single.length) return;
  currentGallery.idxSingle = (currentGallery.idxSingle - 1 + currentGallery.single.length) % currentGallery.single.length;
  updateGalleryModal();
}

// Delegated click for cards
document.addEventListener('click', (e) => {
  const card = e.target.closest('[data-gallery-images]');
  if (!card) return;
  e.preventDefault();
  const before = JSON.parse(card.getAttribute('data-gallery-before') || '[]');
  const after = JSON.parse(card.getAttribute('data-gallery-after') || '[]');
  const fallback = JSON.parse(card.getAttribute('data-gallery-images') || '[]');
  const title = card.getAttribute('data-gallery-title') || '';
  const tag = card.getAttribute('data-gallery-tag') || '';
  const desc = card.getAttribute('data-gallery-desc') || '';
  openGalleryFromData({ before, after, fallback, title, tag, desc });
});

// Close modal when clicking outside
document.getElementById('galleryModal')?.addEventListener('click', function(e) {
  if (e.target === this) {
    closeGallery();
  }
});
</script>
@endpush
