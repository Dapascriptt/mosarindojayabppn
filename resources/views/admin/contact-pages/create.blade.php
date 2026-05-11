@extends('admin.layouts.app')
@section('title', 'Tambah Kontak')
@section('page_title', 'Tambah Kontak')
@section('page_subtitle', 'Buat konten kontak')
@section('content')
    @include('admin.contact-pages._form', ['action' => route('admin.contact-pages.store')])
@endsection
