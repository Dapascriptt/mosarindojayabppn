@extends('admin.layouts.app')
@section('title', 'Edit Profil')
@section('page_title', 'Edit Profil')
@section('page_subtitle', $item->hero_title ?: 'Konten profil')
@section('content')
    @include('admin.about-pages._form', ['action' => route('admin.about-pages.update', $item), 'method' => 'PUT'])
@endsection
