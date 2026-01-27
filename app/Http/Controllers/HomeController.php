<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;
use App\Models\HomePage;
use App\Models\GalleryItem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $about = AboutPage::first();
        $home = HomePage::first();
        $galleryItems = GalleryItem::orderBy('created_at', 'desc')->take(4)->get()->map(function (GalleryItem $item) {
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

            return [
                'title' => $item->title,
                'tag' => $item->tag,
                'desc' => $item->desc,
                'cover' => $images[0] ?? null,
                'images' => $images,
                'before_images' => collect($item->before_images ?? [])
                    ->map(fn ($img) => is_array($img) ? ($img['src'] ?? null) : $img)
                    ->filter()
                    ->map(function ($path) {
                        if (Str::startsWith($path, ['http://', 'https://', '/'])) {
                            return $path;
                        }

                        return Storage::url($path);
                    })
                    ->values()
                    ->all(),
                'after_images' => collect($item->after_images ?? [])
                    ->map(fn ($img) => is_array($img) ? ($img['src'] ?? null) : $img)
                    ->filter()
                    ->map(function ($path) {
                        if (Str::startsWith($path, ['http://', 'https://', '/'])) {
                            return $path;
                        }

                        return Storage::url($path);
                    })
                    ->values()
                    ->all(),
            ];
        });

        if (! $about) {
            $about = [
                'hero_desc' => 'Mosarindo Jaya Balikpapan membantu showroom, interior, electrical, supply material, dan land clearing dengan tim bersertifikasi dan rantai pasok kuat. Fokus kami: ketepatan waktu, keamanan, dan kualitas eksekusi.',
                'certifications_text' => 'Tim kami tersertifikasi dan terakreditasi LPJK untuk memastikan standar mutu, keselamatan, dan ketepatan pelaksanaan proyek.',
                'highlights' => [
                    'Sertifikasi K3 & electrical',
                    'Rantai pasok terencana',
                    'Dokumentasi progres transparan',
                ],
            ];
        }

        return view('pages.home', [
            'about' => $about,
            'home' => $home,
            'galleryPreview' => $galleryItems,
        ]);
    }
}
