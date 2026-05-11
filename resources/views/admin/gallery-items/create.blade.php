@extends('admin.layouts.app')
@section('title', 'Tambah Galeri')
@section('page_title', 'Tambah Galeri')
@section('page_subtitle', 'Buat dokumentasi proyek baru')
@section('content')
    @include('admin.gallery-items._form', ['action' => route('admin.gallery-items.store')])
@endsection
