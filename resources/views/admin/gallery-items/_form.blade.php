<form action="{{ $action }}" method="POST" enctype="multipart/form-data" data-loading-form>
    @csrf
    @isset($method) @method($method) @endisset

    <div class="row g-4">
        <div class="col-12 col-xl-7">
            <div class="admin-card rounded-4 bg-white p-4">
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Judul</label>
                        <input type="text" name="title" value="{{ old('title', $item->title) }}" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Tag</label>
                        <input type="text" name="tag" value="{{ old('tag', $item->tag) }}" class="form-control">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="desc" rows="6" class="form-control">{{ old('desc', $item->desc) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-5">
            <div class="admin-card rounded-4 bg-white p-4">
                <label class="form-label fw-semibold">Foto Before</label>
                <input type="file" name="before_images[]" class="form-control" accept="image/*" multiple>
                <div class="mt-3">@include('admin.partials.media-preview', ['paths' => $item->before_images ?? []])</div>
                <hr>
                <label class="form-label fw-semibold">Foto After</label>
                <input type="file" name="after_images[]" class="form-control" accept="image/*" multiple>
                <div class="mt-3">@include('admin.partials.media-preview', ['paths' => $item->after_images ?? []])</div>
                <hr>
                <label class="form-label fw-semibold">Foto Lama/Opsional</label>
                <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
                <div class="mt-3">@include('admin.partials.media-preview', ['paths' => $item->images ?? []])</div>
            </div>
            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-dark btn-lg"><i class="bi bi-save me-2"></i>Simpan</button>
                <a href="{{ route('admin.gallery-items.index') }}" class="btn btn-light border">Batal</a>
            </div>
        </div>
    </div>
</form>
