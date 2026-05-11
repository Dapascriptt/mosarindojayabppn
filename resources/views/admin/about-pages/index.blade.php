@extends('admin.layouts.app')

@section('title', 'Profil')
@section('page_title', 'Konten Profil')
@section('page_subtitle', 'Kelola tentang kami, legalitas, dan tim')

@section('content')
<div class="admin-card rounded-4 bg-white p-4">
    <div class="d-flex flex-column flex-lg-row gap-3 justify-content-between mb-3">
        <form class="d-flex gap-2 flex-grow-1" method="GET">
            <input type="search" name="search" value="{{ $search }}" class="form-control" placeholder="Cari judul atau deskripsi">
            <button class="btn btn-outline-dark"><i class="bi bi-search me-2"></i>Cari</button>
        </form>
        <a href="{{ route('admin.about-pages.create') }}" class="btn btn-dark"><i class="bi bi-plus-lg me-2"></i>Tambah Profil</a>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead><tr><th>#</th><th>Judul</th><th>Highlight</th><th>Legalitas</th><th>Diperbarui</th><th class="text-end">Aksi</th></tr></thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td>{{ $items->firstItem() + $loop->index }}</td>
                        <td><div class="fw-semibold">{{ $item->hero_title ?: '-' }}</div><div class="small text-secondary">{{ Str::limit($item->hero_desc, 70) }}</div></td>
                        <td>{{ count($item->highlights ?? []) }}</td>
                        <td>{{ count($item->legal_items ?? []) }}</td>
                        <td>{{ $item->updated_at?->format('d M Y') }}</td>
                        <td class="text-end">
                            <div class="btn-group">
                                <a href="{{ route('admin.about-pages.show', $item) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('admin.about-pages.edit', $item) }}" class="btn btn-sm btn-outline-dark"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.about-pages.destroy', $item) }}" method="POST" data-confirm-delete>
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-5 text-secondary">Belum ada konten profil.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $items->links() }}
</div>
@endsection
