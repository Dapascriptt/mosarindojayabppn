@php
    $highlightText = old('highlights_text', collect($item->highlights ?? [])->map(fn ($row) => data_get($row, 'text', $row))->implode("\n"));
    $legalItems = old('legal_label') ? collect(old('legal_label'))->map(fn ($label, $i) => ['label' => $label, 'value' => old('legal_value')[$i] ?? ''])->all() : ($item->legal_items ?? [['label' => '', 'value' => '']]);
    $sbuItems = old('sbu_code') ? collect(old('sbu_code'))->map(fn ($code, $i) => ['code' => $code, 'desc' => old('sbu_desc')[$i] ?? ''])->all() : ($item->sbu_items ?? [['code' => '', 'desc' => '']]);
    $teamGroups = old('team_title') ? collect(old('team_title'))->map(fn ($title, $i) => ['title' => $title, 'members' => preg_split('/\r\n|\r|\n/', old('team_members')[$i] ?? '')])->all() : ($item->team_groups ?? [['title' => '', 'members' => []]]);
@endphp

<form action="{{ $action }}" method="POST" enctype="multipart/form-data" data-loading-form>
    @csrf
    @isset($method) @method($method) @endisset

    <div class="row g-4">
        <div class="col-12 col-xl-8">
            <div class="admin-card rounded-4 bg-white p-4">
                <h2 class="h5 fw-bold mb-3">Hero</h2>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Judul</label>
                        <input type="text" name="hero_title" value="{{ old('hero_title', $item->hero_title) }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Subjudul</label>
                        <input type="text" name="hero_subtitle" value="{{ old('hero_subtitle', $item->hero_subtitle) }}" class="form-control">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Deskripsi Hero</label>
                        <textarea name="hero_desc" rows="4" class="form-control">{{ old('hero_desc', $item->hero_desc) }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Highlight</label>
                        <textarea name="highlights_text" rows="5" class="form-control" placeholder="Satu highlight per baris">{{ $highlightText }}</textarea>
                    </div>
                </div>
            </div>

            <div class="admin-card rounded-4 bg-white p-4 mt-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h5 fw-bold mb-0">Legalitas</h2>
                    <button type="button" class="btn btn-outline-dark btn-sm" data-add-row="#legalRows" data-template="#legalTemplate"><i class="bi bi-plus-lg me-1"></i>Tambah</button>
                </div>
                <div id="legalRows" class="vstack gap-2">
                    @foreach ($legalItems as $legal)
                        <div class="row g-2" data-row>
                            <div class="col-md-5"><input type="text" name="legal_label[]" value="{{ data_get($legal, 'label') }}" class="form-control" placeholder="Label"></div>
                            <div class="col-md-6"><input type="text" name="legal_value[]" value="{{ data_get($legal, 'value') }}" class="form-control" placeholder="Nilai"></div>
                            <div class="col-md-1"><button type="button" class="btn btn-outline-danger w-100" data-remove-row><i class="bi bi-x-lg"></i></button></div>
                        </div>
                    @endforeach
                </div>
                <template id="legalTemplate">
                    <div class="row g-2" data-row>
                        <div class="col-md-5"><input type="text" name="legal_label[]" class="form-control" placeholder="Label"></div>
                        <div class="col-md-6"><input type="text" name="legal_value[]" class="form-control" placeholder="Nilai"></div>
                        <div class="col-md-1"><button type="button" class="btn btn-outline-danger w-100" data-remove-row><i class="bi bi-x-lg"></i></button></div>
                    </div>
                </template>
            </div>

            <div class="admin-card rounded-4 bg-white p-4 mt-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h5 fw-bold mb-0">SBU</h2>
                    <button type="button" class="btn btn-outline-dark btn-sm" data-add-row="#sbuRows" data-template="#sbuTemplate"><i class="bi bi-plus-lg me-1"></i>Tambah</button>
                </div>
                <div id="sbuRows" class="vstack gap-2">
                    @foreach ($sbuItems as $sbu)
                        <div class="row g-2" data-row>
                            <div class="col-md-4"><input type="text" name="sbu_code[]" value="{{ data_get($sbu, 'code') }}" class="form-control" placeholder="Kode"></div>
                            <div class="col-md-7"><input type="text" name="sbu_desc[]" value="{{ data_get($sbu, 'desc') }}" class="form-control" placeholder="Deskripsi"></div>
                            <div class="col-md-1"><button type="button" class="btn btn-outline-danger w-100" data-remove-row><i class="bi bi-x-lg"></i></button></div>
                        </div>
                    @endforeach
                </div>
                <template id="sbuTemplate">
                    <div class="row g-2" data-row>
                        <div class="col-md-4"><input type="text" name="sbu_code[]" class="form-control" placeholder="Kode"></div>
                        <div class="col-md-7"><input type="text" name="sbu_desc[]" class="form-control" placeholder="Deskripsi"></div>
                        <div class="col-md-1"><button type="button" class="btn btn-outline-danger w-100" data-remove-row><i class="bi bi-x-lg"></i></button></div>
                    </div>
                </template>
            </div>

            <div class="admin-card rounded-4 bg-white p-4 mt-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h5 fw-bold mb-0">Tim</h2>
                    <button type="button" class="btn btn-outline-dark btn-sm" data-add-row="#teamRows" data-template="#teamTemplate"><i class="bi bi-plus-lg me-1"></i>Tambah</button>
                </div>
                <div id="teamRows" class="vstack gap-3">
                    @foreach ($teamGroups as $team)
                        <div class="border rounded-3 p-3" data-row>
                            <div class="d-flex justify-content-between gap-2 mb-2">
                                <input type="text" name="team_title[]" value="{{ data_get($team, 'title') }}" class="form-control" placeholder="Judul kelompok">
                                <button type="button" class="btn btn-outline-danger" data-remove-row><i class="bi bi-x-lg"></i></button>
                            </div>
                            <textarea name="team_members[]" rows="4" class="form-control" placeholder="Satu nama anggota per baris">{{ collect(data_get($team, 'members', []))->map(fn ($member) => data_get($member, 'name', $member))->implode("\n") }}</textarea>
                        </div>
                    @endforeach
                </div>
                <template id="teamTemplate">
                    <div class="border rounded-3 p-3" data-row>
                        <div class="d-flex justify-content-between gap-2 mb-2">
                            <input type="text" name="team_title[]" class="form-control" placeholder="Judul kelompok">
                            <button type="button" class="btn btn-outline-danger" data-remove-row><i class="bi bi-x-lg"></i></button>
                        </div>
                        <textarea name="team_members[]" rows="4" class="form-control" placeholder="Satu nama anggota per baris"></textarea>
                    </div>
                </template>
            </div>

            <div class="admin-card rounded-4 bg-white p-4 mt-4">
                <label class="form-label fw-semibold">Keterangan Sertifikasi</label>
                <textarea name="certifications_text" rows="4" class="form-control">{{ old('certifications_text', $item->certifications_text) }}</textarea>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="admin-card rounded-4 bg-white p-4">
                <label class="form-label fw-semibold">Video Hero</label>
                <input type="file" name="video_url" class="form-control" accept="video/*">
                <div class="mt-3">@include('admin.partials.media-preview', ['paths' => $item->video_url])</div>
                <hr>
                <label class="form-label fw-semibold">Foto Lokasi</label>
                <input type="file" name="location_photos[]" class="form-control" accept="image/*" multiple>
                <div class="mt-3">@include('admin.partials.media-preview', ['paths' => $item->location_photos ?? []])</div>
            </div>
            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-dark btn-lg"><i class="bi bi-save me-2"></i>Simpan</button>
                <a href="{{ route('admin.about-pages.index') }}" class="btn btn-light border">Batal</a>
            </div>
        </div>
    </div>
</form>
