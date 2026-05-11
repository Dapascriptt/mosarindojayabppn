@extends('admin.layouts.app')
@section('title', 'Detail Profil')
@section('page_title', 'Detail Profil')
@section('page_subtitle', $item->hero_title ?: 'Konten profil')
@section('content')
<div class="admin-card rounded-4 bg-white p-4">
    <div class="d-flex justify-content-between mb-4">
        <div>
            <h2 class="h4 fw-bold">{{ $item->hero_title }}</h2>
            <div class="text-secondary">{{ $item->hero_subtitle }}</div>
        </div>
        <a href="{{ route('admin.about-pages.edit', $item) }}" class="btn btn-dark align-self-start">Edit</a>
    </div>
    <p>{{ $item->hero_desc }}</p>
    <div class="row g-4">
        <div class="col-md-4"><h3 class="h6 fw-bold">Highlight</h3><ul>@foreach ($item->highlights ?? [] as $row)<li>{{ data_get($row, 'text', $row) }}</li>@endforeach</ul></div>
        <div class="col-md-4"><h3 class="h6 fw-bold">Legalitas</h3><ul>@foreach ($item->legal_items ?? [] as $row)<li>{{ data_get($row, 'label') }}: {{ data_get($row, 'value') }}</li>@endforeach</ul></div>
        <div class="col-md-4"><h3 class="h6 fw-bold">SBU</h3><ul>@foreach ($item->sbu_items ?? [] as $row)<li>{{ data_get($row, 'code') }} - {{ data_get($row, 'desc') }}</li>@endforeach</ul></div>
    </div>
    <h3 class="h6 fw-bold mt-3">Tim</h3>
    <div class="row g-3">
        @foreach ($item->team_groups ?? [] as $group)
            <div class="col-md-6"><div class="border rounded-3 p-3"><strong>{{ data_get($group, 'title') }}</strong><ul class="mb-0">@foreach (data_get($group, 'members', []) as $member)<li>{{ data_get($member, 'name', $member) }}</li>@endforeach</ul></div></div>
        @endforeach
    </div>
    <h3 class="h6 fw-bold mt-4">Media</h3>
    @include('admin.partials.media-preview', ['paths' => array_merge([$item->video_url], $item->location_photos ?? [])])
</div>
@endsection
