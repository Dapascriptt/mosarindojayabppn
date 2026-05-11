@extends('admin.layouts.app')
@section('title', 'Tambah Konten Beranda')
@section('page_title', 'Tambah Konten Beranda')
@section('page_subtitle', 'Buat konten home page')
@section('content')
    @include('admin.home-pages._form', ['action' => route('admin.home-pages.store')])
@endsection
