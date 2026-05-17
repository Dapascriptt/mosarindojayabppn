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
            $resolveImages = function ($items) {
                return collect($items ?? [])
                    ->map(fn ($img) => is_array($img) ? ($img['src'] ?? null) : $img)
                    ->filter()
                    ->map(function ($path) {
                        $path = str_replace('\\', '/', (string) $path);

                        if (Str::startsWith($path, 'public/')) {
                            $path = Str::after($path, 'public/');
                        }

                        if (Str::startsWith($path, ['http://', 'https://', '/'])) {
                            return $path;
                        }

                        if (Str::startsWith($path, 'storage/')) {
                            return '/' . $path;
                        }

                        return Storage::url($path);
                    })
                    ->values()
                    ->all();
            };

            $images = $resolveImages($item->images);
            $beforeImages = $resolveImages($item->before_images);
            $afterImages = $resolveImages($item->after_images);

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
