@extends('admin.layouts.app')

@section('title', 'Detail Produk')
@section('page_title', 'Detail Produk')
@section('page_subtitle', $item->name)

@section('content')
<div class="row g-4">
    <div class="col-12 col-xl-8">
        <div class="admin-card rounded-4 bg-white p-4">
            <h2 class="h4 fw-bold">{{ $item->name }}</h2>
            <div class="text-secondary mb-3">{{ $item->slug }} · {{ $item->type }} · {{ $item->category }}</div>
            <p>{{ $item->excerpt }}</p>
            <div class="border-top pt-3">{!! nl2br(e($item->description)) !!}</div>
            <h3 class="h6 fw-bold mt-4">Detail</h3>
            <ul>
                @foreach ($item->details as $detail)
                    <li>{{ $detail->detail }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-12 col-xl-4">
        <div class="admin-card rounded-4 bg-white p-4">
            <h3 class="h6 fw-bold">Media</h3>
            @include('admin.partials.media-preview', ['paths' => [$item->image, $item->hero_media]])
            <div class="d-grid gap-2 mt-4">
                <a href="{{ route('admin.products.edit', $item) }}" class="btn btn-dark">Edit</a>
                <a href="{{ route('admin.products.index') }}" class="btn btn-light border">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
