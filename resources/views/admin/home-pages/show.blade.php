@extends('admin.layouts.app')
@section('title', 'Detail Konten Beranda')
@section('page_title', 'Detail Konten Beranda')
@section('page_subtitle', 'Preview data CMS')
@section('content')
<div class="admin-card rounded-4 bg-white p-4">
    <div class="d-flex justify-content-between mb-4">
        <h2 class="h4 fw-bold">Konten Beranda</h2>
        <a href="{{ route('admin.home-pages.edit', $item) }}" class="btn btn-dark">Edit</a>
    </div>
    <h3 class="h6 fw-bold">Penjelasan Singkat</h3>
    <p>{{ $item->about_excerpt }}</p>
    <h3 class="h6 fw-bold">Visi</h3>
    <p>{{ $item->vision_text }}</p>
    <h3 class="h6 fw-bold">Misi</h3>
    <ul>@foreach ($item->mission_points ?? [] as $point)<li>{{ data_get($point, 'text', $point) }}</li>@endforeach</ul>
    <div class="row g-4 mt-2">
        <div class="col-md-4"><h3 class="h6 fw-bold">Hero</h3>@include('admin.partials.media-preview', ['paths' => $item->hero_media ?? []])</div>
        <div class="col-md-4"><h3 class="h6 fw-bold">Card</h3>@include('admin.partials.media-preview', ['paths' => $item->card_image])</div>
        <div class="col-md-4"><h3 class="h6 fw-bold">Mitra</h3>@include('admin.partials.media-preview', ['paths' => $item->partner_logos ?? []])</div>
    </div>
</div>
@endsection
