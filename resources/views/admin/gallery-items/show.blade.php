@extends('admin.layouts.app')
@section('title', 'Detail Galeri')
@section('page_title', 'Detail Galeri')
@section('page_subtitle', $item->title)
@section('content')
<div class="admin-card rounded-4 bg-white p-4">
    <div class="d-flex justify-content-between gap-3 mb-4">
        <div>
            <h2 class="h4 fw-bold">{{ $item->title }}</h2>
            <div class="text-secondary">{{ $item->tag }}</div>
        </div>
        <a href="{{ route('admin.gallery-items.edit', $item) }}" class="btn btn-dark align-self-start">Edit</a>
    </div>
    <p>{{ $item->desc }}</p>
    <div class="row g-4 mt-2">
        <div class="col-md-4"><h3 class="h6 fw-bold">Before</h3>@include('admin.partials.media-preview', ['paths' => $item->before_images ?? []])</div>
        <div class="col-md-4"><h3 class="h6 fw-bold">After</h3>@include('admin.partials.media-preview', ['paths' => $item->after_images ?? []])</div>
        <div class="col-md-4"><h3 class="h6 fw-bold">Foto Lama</h3>@include('admin.partials.media-preview', ['paths' => $item->images ?? []])</div>
    </div>
</div>
@endsection
