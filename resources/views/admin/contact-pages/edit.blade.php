@extends('admin.layouts.app')
@section('title', 'Edit Kontak')
@section('page_title', 'Edit Kontak')
@section('page_subtitle', $item->hero_title ?: 'Konten kontak')
@section('content')
    @include('admin.contact-pages._form', ['action' => route('admin.contact-pages.update', $item), 'method' => 'PUT'])
@endsection
