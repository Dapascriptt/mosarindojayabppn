@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')
@section('page_subtitle', 'Ringkasan konten dan aktivitas terbaru')

@section('content')
<div class="row g-3 mb-4">
    @foreach ($stats as $stat)
        <div class="col-12 col-sm-6 col-xl-3">
            <a href="{{ route($stat['route']) }}" class="text-decoration-none text-dark">
                <div class="stat-card rounded-4 bg-white p-4 h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-secondary small fw-semibold">{{ $stat['label'] }}</div>
                            <div class="display-6 fw-bold">{{ $stat['value'] }}</div>
                        </div>
                        <div class="rounded-3 d-grid place-items-center text-white" style="width:52px;height:52px;background:#dba554;">
                            <i class="bi {{ $stat['icon'] }} fs-4"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>

<div class="row g-4">
    <div class="col-12 col-xl-8">
        <div class="admin-card rounded-4 bg-white p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h2 class="h5 fw-bold mb-1">Konten Terbaru</h2>
                    <p class="text-secondary mb-0 small">Produk, layanan, dan galeri terakhir diperbarui.</p>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Modul</th>
                            <th>Judul</th>
                            <th>Diperbarui</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($latestProducts as $item)
                            <tr><td><span class="badge text-bg-dark">Produk</span></td><td>{{ $item->name }}</td><td>{{ $item->updated_at?->format('d M Y H:i') }}</td></tr>
                        @endforeach
                        @foreach ($latestServices as $item)
                            <tr><td><span class="badge text-bg-primary">Layanan</span></td><td>{{ $item->name }}</td><td>{{ $item->updated_at?->format('d M Y H:i') }}</td></tr>
                        @endforeach
                        @foreach ($latestGallery as $item)
                            <tr><td><span class="badge text-bg-warning">Galeri</span></td><td>{{ $item->title }}</td><td>{{ $item->updated_at?->format('d M Y H:i') }}</td></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-4">
        <div class="admin-card rounded-4 bg-white p-4">
            <h2 class="h5 fw-bold mb-3">Shortcut</h2>
            <div class="d-grid gap-2">
                <a href="{{ route('admin.products.create') }}" class="btn btn-dark"><i class="bi bi-plus-lg me-2"></i>Tambah Produk</a>
                <a href="{{ route('admin.services.create') }}" class="btn btn-outline-dark"><i class="bi bi-plus-lg me-2"></i>Tambah Layanan</a>
                <a href="{{ route('admin.gallery-items.create') }}" class="btn btn-outline-dark"><i class="bi bi-plus-lg me-2"></i>Tambah Galeri</a>
            </div>
            <hr>
            <div class="small text-secondary">Login sebagai</div>
            <div class="fw-bold">{{ auth()->user()->name }}</div>
            <div class="text-secondary small">{{ auth()->user()->email }}</div>
        </div>
    </div>
</div>
@endsection
