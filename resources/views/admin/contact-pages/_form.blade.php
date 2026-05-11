<form action="{{ $action }}" method="POST" enctype="multipart/form-data" data-loading-form>
    @csrf
    @isset($method) @method($method) @endisset

    <div class="row g-4">
        <div class="col-12 col-xl-8">
            <div class="admin-card rounded-4 bg-white p-4">
                <h2 class="h5 fw-bold mb-3">Hero</h2>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label fw-semibold">Judul Hero</label>
                        <input type="text" name="hero_title" value="{{ old('hero_title', $item->hero_title) }}" class="form-control">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Deskripsi Hero</label>
                        <textarea name="hero_desc" rows="4" class="form-control">{{ old('hero_desc', $item->hero_desc) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="admin-card rounded-4 bg-white p-4 mt-4">
                <h2 class="h5 fw-bold mb-3">Form Kontak</h2>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Judul Form</label>
                        <input type="text" name="form_title" value="{{ old('form_title', $item->form_title) }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Judul Info</label>
                        <input type="text" name="info_title" value="{{ old('info_title', $item->info_title) }}" class="form-control">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Deskripsi Form</label>
                        <textarea name="form_desc" rows="3" class="form-control">{{ old('form_desc', $item->form_desc) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="admin-card rounded-4 bg-white p-4 mt-4">
                <h2 class="h5 fw-bold mb-3">Info Kontak</h2>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label fw-semibold">Nama Perusahaan</label>
                        <input type="text" name="company_name" value="{{ old('company_name', $item->company_name) }}" class="form-control">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Alamat</label>
                        <textarea name="address" rows="4" class="form-control">{{ old('address', $item->address) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">WhatsApp</label>
                        <input type="text" name="whatsapp" value="{{ old('whatsapp', $item->whatsapp) }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" value="{{ old('email', $item->email) }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Label CTA WhatsApp</label>
                        <input type="text" name="cta_whatsapp_label" value="{{ old('cta_whatsapp_label', $item->cta_whatsapp_label) }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Label CTA Email</label>
                        <input type="text" name="cta_email_label" value="{{ old('cta_email_label', $item->cta_email_label) }}" class="form-control">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Maps Embed URL / iframe</label>
                        <textarea name="maps_embed_url" rows="4" class="form-control">{{ old('maps_embed_url', $item->maps_embed_url) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="admin-card rounded-4 bg-white p-4">
                <label class="form-label fw-semibold">Background Hero</label>
                <input type="file" name="hero_bg" class="form-control" accept="image/*">
                <div class="mt-3">@include('admin.partials.media-preview', ['paths' => $item->hero_bg])</div>
            </div>
            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-dark btn-lg"><i class="bi bi-save me-2"></i>Simpan</button>
                <a href="{{ route('admin.contact-pages.index') }}" class="btn btn-light border">Batal</a>
            </div>
        </div>
    </div>
</form>
