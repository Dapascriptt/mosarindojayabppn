@php
    $details = old('details', $item->exists ? $item->details->pluck('detail')->all() : ['']);
@endphp

<form action="{{ $action }}" method="POST" enctype="multipart/form-data" data-loading-form>
    @csrf
    @isset($method) @method($method) @endisset

    <div class="row g-4">
        <div class="col-12 col-xl-8">
            <div class="admin-card rounded-4 bg-white p-4">
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Nama Produk</label>
                        <input type="text" name="name" value="{{ old('name', $item->name) }}" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Slug</label>
                        <input type="text" name="slug" value="{{ old('slug', $item->slug) }}" class="form-control" placeholder="otomatis jika kosong">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tipe</label>
                        <select name="type" class="form-select" required>
                            <option value="mjb-kontraktor" @selected(old('type', $item->type) === 'mjb-kontraktor')>MJB Kontraktor</option>
                            <option value="mjb-food" @selected(old('type', $item->type) === 'mjb-food')>MJB Food</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Kategori</label>
                        <input type="text" name="category" value="{{ old('category', $item->category) }}" class="form-control">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Ringkasan</label>
                        <textarea name="excerpt" rows="3" class="form-control">{{ old('excerpt', $item->excerpt) }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="description" rows="7" class="form-control">{{ old('description', $item->description) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="admin-card rounded-4 bg-white p-4 mt-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h2 class="h5 fw-bold mb-1">Detail Produk</h2>
                        <p class="small text-secondary mb-0">Satu baris detail per textarea.</p>
                    </div>
                    <button type="button" class="btn btn-outline-dark btn-sm" data-add-row="#detailsRows" data-template="#detailTemplate">
                        <i class="bi bi-plus-lg me-1"></i>Tambah
                    </button>
                </div>
                <div id="detailsRows" class="vstack gap-2">
                    @foreach ($details as $detail)
                        <div class="input-group" data-row>
                            <textarea name="details[]" rows="2" class="form-control" placeholder="Detail">{{ $detail }}</textarea>
                            <button type="button" class="btn btn-outline-danger" data-remove-row><i class="bi bi-x-lg"></i></button>
                        </div>
                    @endforeach
                </div>
                <template id="detailTemplate">
                    <div class="input-group" data-row>
                        <textarea name="details[]" rows="2" class="form-control" placeholder="Detail"></textarea>
                        <button type="button" class="btn btn-outline-danger" data-remove-row><i class="bi bi-x-lg"></i></button>
                    </div>
                </template>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="admin-card rounded-4 bg-white p-4">
                <label class="form-label fw-semibold">Gambar Produk</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                <div class="mt-3">@include('admin.partials.media-preview', ['paths' => $item->image])</div>
                <hr>
                <label class="form-label fw-semibold">Media Hero</label>
                <input type="file" name="hero_media" class="form-control" accept="image/*,video/*">
                <div class="mt-3">@include('admin.partials.media-preview', ['paths' => $item->hero_media])</div>
            </div>

            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-dark btn-lg"><i class="bi bi-save me-2"></i>Simpan</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-light border">Batal</a>
            </div>
        </div>
    </div>
</form>
