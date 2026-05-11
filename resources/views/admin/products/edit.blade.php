@extends('admin.layouts.app')

@section('title', 'Edit Produk')
@section('page_title', 'Edit Produk')
@section('page_subtitle', $item->name)

@section('content')
    @include('admin.products._form', ['action' => route('admin.products.update', $item), 'method' => 'PUT'])
@endsection
