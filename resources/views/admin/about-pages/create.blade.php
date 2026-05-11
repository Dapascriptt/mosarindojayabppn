@extends('admin.layouts.app')
@section('title', 'Tambah Profil')
@section('page_title', 'Tambah Profil')
@section('page_subtitle', 'Buat konten profil perusahaan')
@section('content')
    @include('admin.about-pages._form', ['action' => route('admin.about-pages.store')])
@endsection
