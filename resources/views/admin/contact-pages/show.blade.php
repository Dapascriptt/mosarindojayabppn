@extends('admin.layouts.app')
@section('title', 'Detail Kontak')
@section('page_title', 'Detail Kontak')
@section('page_subtitle', $item->hero_title ?: 'Konten kontak')
@section('content')
<div class="admin-card rounded-4 bg-white p-4">
    <div class="d-flex justify-content-between mb-4">
        <h2 class="h4 fw-bold">{{ $item->hero_title }}</h2>
        <a href="{{ route('admin.contact-pages.edit', $item) }}" class="btn btn-dark">Edit</a>
    </div>
    <p>{{ $item->hero_desc }}</p>
    <div class="row g-4">
        <div class="col-md-6">
            <h3 class="h6 fw-bold">Form</h3>
            <p><strong>{{ $item->form_title }}</strong></p>
            <p>{{ $item->form_desc }}</p>
        </div>
        <div class="col-md-6">
            <h3 class="h6 fw-bold">Info</h3>
            <p class="mb-1"><strong>{{ $item->company_name }}</strong></p>
            <p>{!! nl2br(e($item->address)) !!}</p>
            <p class="mb-1">WhatsApp: {{ $item->whatsapp }}</p>
            <p>Email: {{ $item->email }}</p>
        </div>
    </div>
    <h3 class="h6 fw-bold mt-3">Media</h3>
    @include('admin.partials.media-preview', ['paths' => $item->hero_bg])
</div>
@endsection
