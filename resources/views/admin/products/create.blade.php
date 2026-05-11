@extends('admin.layouts.app')

@section('title', 'Tambah Produk')
@section('page_title', 'Tambah Produk')
@section('page_subtitle', 'Buat data produk baru')

@section('content')
    @include('admin.products._form', ['action' => route('admin.products.store')])
@endsection
