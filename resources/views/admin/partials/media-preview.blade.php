@php
    $mediaItems = collect(is_array($paths ?? null) ? $paths : array_filter([$paths ?? null]));
    $resolveAdminMedia = function ($path) {
        if (! $path) {
            return '';
        }
        if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://', '/'])) {
            return $path;
        }
        return \Illuminate\Support\Facades\Storage::url($path);
    };
    $isVideo = function ($path) {
        return \Illuminate\Support\Str::endsWith(strtolower((string) $path), ['.mp4', '.webm', '.ogg', '.mov']);
    };
@endphp

@if ($mediaItems->isNotEmpty())
    <div class="d-flex flex-wrap gap-2">
        @foreach ($mediaItems as $path)
            @php $src = $resolveAdminMedia($path); @endphp
            @if ($isVideo($path))
                <video class="media-thumb" controls preload="metadata">
                    <source src="{{ $src }}">
                </video>
            @else
                <img src="{{ $src }}" alt="Media" class="media-thumb" loading="lazy">
            @endif
        @endforeach
    </div>
@else
    <span class="text-secondary">Tidak ada media</span>
@endif
