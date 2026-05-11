@extends('admin.layouts.app')

@section('title', 'Beranda')
@section('page_title', 'Konten Beranda')
@section('page_subtitle', 'Kelola hero, visi misi, dan logo mitra')

@section('content')
<div class="admin-card rounded-4 bg-white p-4">
    <div class="d-flex flex-column flex-lg-row gap-3 justify-content-between mb-3">
        <form class="d-flex gap-2 flex-grow-1" method="GET">
            <input type="search" name="search" value="{{ $search }}" class="form-control" placeholder="Cari ringkasan beranda">
            <button class="btn btn-outline-dark"><i class="bi bi-search me-2"></i>Cari</button>
        </form>
        <a href="{{ route('admin.home-pages.create') }}" class="btn btn-dark"><i class="bi bi-plus-lg me-2"></i>Tambah Konten</a>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead><tr><th>#</th><th>Ringkasan</th><th>Hero</th><th>Mitra</th><th>Diperbarui</th><th class="text-end">Aksi</th></tr></thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td>{{ $items->firstItem() + $loop->index }}</td>
                        <td>{{ Str::limit($item->about_excerpt, 80) }}</td>
                        <td>{{ count($item->hero_media ?? []) }}</td>
                        <td>{{ count($item->partner_logos ?? []) }}</td>
                        <td>{{ $item->updated_at?->format('d M Y') }}</td>
                        <td class="text-end">
                            <div class="btn-group">
                                <a href="{{ route('admin.home-pages.show', $item) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('admin.home-pages.edit', $item) }}" class="btn btn-sm btn-outline-dark"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.home-pages.destroy', $item) }}" method="POST" data-confirm-delete>
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-5 text-secondary">Belum ada konten beranda.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $items->links() }}
</div>
@endsection
