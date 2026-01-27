<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function index()
    {
        $items = GalleryItem::orderBy('created_at', 'desc')->get()->map(function (GalleryItem $item) {
            $images = collect($item->images ?? [])
                ->map(fn ($img) => is_array($img) ? ($img['src'] ?? null) : $img)
                ->filter()
                ->map(function ($path) {
                    if (Str::startsWith($path, ['http://', 'https://', '/'])) {
                        return $path;
                    }

                    return Storage::url($path);
                })
                ->values()
                ->all();

            $beforeImages = collect($item->before_images ?? [])
                ->map(fn ($img) => is_array($img) ? ($img['src'] ?? null) : $img)
                ->filter()
                ->map(function ($path) {
                    if (Str::startsWith($path, ['http://', 'https://', '/'])) {
                        return $path;
                    }

                    return Storage::url($path);
                })
                ->values()
                ->all();

            $afterImages = collect($item->after_images ?? [])
                ->map(fn ($img) => is_array($img) ? ($img['src'] ?? null) : $img)
                ->filter()
                ->map(function ($path) {
                    if (Str::startsWith($path, ['http://', 'https://', '/'])) {
                        return $path;
                    }

                    return Storage::url($path);
                })
                ->values()
                ->all();

            return [
                'title' => $item->title,
                'tag' => $item->tag,
                'desc' => $item->desc,
                'images' => $images,
                'before_images' => $beforeImages,
                'after_images' => $afterImages,
            ];
        });

        return view('pages.gallery.index', compact('items'));
    }
}
