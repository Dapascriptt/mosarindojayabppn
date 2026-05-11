@php
    $missionText = old('mission_points_text', collect($item->mission_points ?? [])->map(fn ($row) => data_get($row, 'text', $row))->implode("\n"));
@endphp

<form action="{{ $action }}" method="POST" enctype="multipart/form-data" data-loading-form>
    @csrf
    @isset($method) @method($method) @endisset

    <div class="row g-4">
        <div class="col-12 col-xl-8">
            <div class="admin-card rounded-4 bg-white p-4">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Penjelasan Singkat</label>
                    <textarea name="about_excerpt" rows="4" class="form-control">{{ old('about_excerpt', $item->about_excerpt) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Teks Visi</label>
                    <textarea name="vision_text" rows="4" class="form-control">{{ old('vision_text', $item->vision_text) }}</textarea>
                </div>
                <div>
                    <label class="form-label fw-semibold">Poin Misi</label>
                    <textarea name="mission_points_text" rows="7" class="form-control" placeholder="Satu poin per baris">{{ $missionText }}</textarea>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4">
            <div class="admin-card rounded-4 bg-white p-4">
                <label class="form-label fw-semibold">Media Hero</label>
                <input type="file" name="hero_media[]" class="form-control" accept="image/*,video/*" multiple>
                <div class="mt-3">@include('admin.partials.media-preview', ['paths' => $item->hero_media ?? []])</div>
                <hr>
                <label class="form-label fw-semibold">Gambar Card</label>
                <input type="file" name="card_image" class="form-control" accept="image/*">
                <div class="mt-3">@include('admin.partials.media-preview', ['paths' => $item->card_image])</div>
                <hr>
                <label class="form-label fw-semibold">Logo Mitra</label>
                <input type="file" name="partner_logos[]" class="form-control" accept="image/*" multiple>
                <div class="mt-3">@include('admin.partials.media-preview', ['paths' => $item->partner_logos ?? []])</div>
            </div>
            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-dark btn-lg"><i class="bi bi-save me-2"></i>Simpan</button>
                <a href="{{ route('admin.home-pages.index') }}" class="btn btn-light border">Batal</a>
            </div>
        </div>
    </div>
</form>
