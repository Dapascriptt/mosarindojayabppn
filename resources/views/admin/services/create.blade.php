@extends('admin.layouts.app')
@section('title', 'Tambah Layanan')
@section('page_title', 'Tambah Layanan')
@section('page_subtitle', 'Buat data layanan baru')
@section('content')
    @include('admin.services._form', ['action' => route('admin.services.store')])
@endsection
