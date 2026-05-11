@extends('admin.layouts.app')
@section('title', 'Edit Galeri')
@section('page_title', 'Edit Galeri')
@section('page_subtitle', $item->title)
@section('content')
    @include('admin.gallery-items._form', ['action' => route('admin.gallery-items.update', $item), 'method' => 'PUT'])
@endsection
