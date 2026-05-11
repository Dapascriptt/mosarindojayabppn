@extends('admin.layouts.app')
@section('title', 'Edit Layanan')
@section('page_title', 'Edit Layanan')
@section('page_subtitle', $item->name)
@section('content')
    @include('admin.services._form', ['action' => route('admin.services.update', $item), 'method' => 'PUT'])
@endsection
