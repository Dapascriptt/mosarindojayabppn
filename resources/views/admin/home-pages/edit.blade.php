@extends('admin.layouts.app')
@section('title', 'Edit Konten Beranda')
@section('page_title', 'Edit Konten Beranda')
@section('page_subtitle', 'Perbarui konten home page')
@section('content')
    @include('admin.home-pages._form', ['action' => route('admin.home-pages.update', $item), 'method' => 'PUT'])
@endsection
