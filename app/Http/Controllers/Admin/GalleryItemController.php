<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesAdminUploads;
use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;

class GalleryItemController extends Controller
{
    use HandlesAdminUploads;

    public function index(Request $request)
    {
        $search = $request->string('search')->toString();
        $items = GalleryItem::when($search, fn ($query) => $query->where(fn ($q) => $q
                ->where('title', 'like', "%{$search}%")
                ->orWhere('tag', 'like', "%{$search}%")))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.gallery-items.index', compact('items', 'search'));
    }

    public function create()
    {
        return view('admin.gallery-items.create', ['item' => new GalleryItem()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['images'] = $this->storeMultipleUploads($request, 'images', 'gallery');
        $data['before_images'] = $this->storeMultipleUploads($request, 'before_images', 'gallery/before');
        $data['after_images'] = $this->storeMultipleUploads($request, 'after_images', 'gallery/after');

        GalleryItem::create($data);

        return redirect()->route('admin.gallery-items.index')->with('success', 'Item galeri berhasil ditambahkan.');
    }

    public function show(GalleryItem $galleryItem)
    {
        return view('admin.gallery-items.show', ['item' => $galleryItem]);
    }

    public function edit(GalleryItem $galleryItem)
    {
        return view('admin.gallery-items.edit', ['item' => $galleryItem]);
    }

    public function update(Request $request, GalleryItem $galleryItem)
    {
        $data = $this->validated($request);
        $data['images'] = $this->storeMultipleUploads($request, 'images', 'gallery', $galleryItem->images ?? []);
        $data['before_images'] = $this->storeMultipleUploads($request, 'before_images', 'gallery/before', $galleryItem->before_images ?? []);
        $data['after_images'] = $this->storeMultipleUploads($request, 'after_images', 'gallery/after', $galleryItem->after_images ?? []);

        $galleryItem->update($data);

        return redirect()->route('admin.gallery-items.index')->with('success', 'Item galeri berhasil diperbarui.');
    }

    public function destroy(GalleryItem $galleryItem)
    {
        $galleryItem->delete();

        return redirect()->route('admin.gallery-items.index')->with('success', 'Item galeri berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'tag' => ['nullable', 'string', 'max:255'],
            'desc' => ['nullable', 'string'],
            'images.*' => ['nullable', 'image', 'max:4096'],
            'before_images.*' => ['nullable', 'image', 'max:4096'],
            'after_images.*' => ['nullable', 'image', 'max:4096'],
        ]);
    }
}
