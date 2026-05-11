@extends('admin.layouts.app')

@section('title', 'Produk')
@section('page_title', 'Produk')
@section('page_subtitle', 'Kelola katalog produk')

@section('content')
<div class="admin-card rounded-4 bg-white p-4">
    <div class="d-flex flex-column flex-lg-row gap-3 justify-content-between mb-3">
        <form class="row g-2 flex-grow-1" method="GET">
            <div class="col-12 col-md-5">
                <input type="search" name="search" value="{{ $search }}" class="form-control" placeholder="Cari nama, kategori, slug">
            </div>
            <div class="col-12 col-md-4">
                <select name="type" class="form-select">
                    <option value="">Semua tipe</option>
                    <option value="mjb-kontraktor" @selected($type === 'mjb-kontraktor')>MJB Kontraktor</option>
                    <option value="mjb-food" @selected($type === 'mjb-food')>MJB Food</option>
                </select>
            </div>
            <div class="col-12 col-md-3">
                <button class="btn btn-outline-dark w-100"><i class="bi bi-search me-2"></i>Filter</button>
            </div>
        </form>
        <a href="{{ route('admin.products.create') }}" class="btn btn-dark"><i class="bi bi-plus-lg me-2"></i>Tambah Produk</a>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th style="width:70px;">#</th>
                    <th>Produk</th>
                    <th>Tipe</th>
                    <th>Kategori</th>
                    <th>Detail</th>
                    <th>Diperbarui</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td>{{ $items->firstItem() + $loop->index }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                @include('admin.partials.media-preview', ['paths' => $item->image])
                                <div>
                                    <div class="fw-bold">{{ $item->name }}</div>
                                    <div class="small text-secondary">{{ $item->slug }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $item->type }}</td>
                        <td>{{ $item->category ?: '-' }}</td>
                        <td>{{ $item->details_count }}</td>
                        <td>{{ $item->updated_at?->format('d M Y') }}</td>
                        <td class="text-end">
                            <div class="btn-group">
                                <a href="{{ route('admin.products.show', $item) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('admin.products.edit', $item) }}" class="btn btn-sm btn-outline-dark"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.products.destroy', $item) }}" method="POST" data-confirm-delete>
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center py-5 text-secondary">Belum ada produk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $items->links() }}
</div>
@endsection
