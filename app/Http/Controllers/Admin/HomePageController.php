<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesAdminUploads;
use App\Http\Controllers\Controller;
use App\Models\HomePage;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    use HandlesAdminUploads;

    public function index(Request $request)
    {
        $search = $request->string('search')->toString();
        $items = HomePage::when($search, fn ($query) => $query->where('about_excerpt', 'like', "%{$search}%"))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.home-pages.index', compact('items', 'search'));
    }

    public function create()
    {
        return view('admin.home-pages.create', ['item' => new HomePage()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['card_image'] = $this->storeSingleUpload($request, 'card_image', 'home');
        $data['hero_media'] = $this->storeMultipleUploads($request, 'hero_media', 'home/hero');
        $data['partner_logos'] = $this->storeMultipleUploads($request, 'partner_logos', 'partners');
        $data['mission_points'] = $this->linesToItems($request->input('mission_points_text'));

        HomePage::create($data);

        return redirect()->route('admin.home-pages.index')->with('success', 'Konten beranda berhasil ditambahkan.');
    }

    public function show(HomePage $homePage)
    {
        return view('admin.home-pages.show', ['item' => $homePage]);
    }

    public function edit(HomePage $homePage)
    {
        return view('admin.home-pages.edit', ['item' => $homePage]);
    }

    public function update(Request $request, HomePage $homePage)
    {
        $data = $this->validated($request);
        $data['card_image'] = $this->storeSingleUpload($request, 'card_image', 'home', $homePage->card_image);
        $data['hero_media'] = $this->storeMultipleUploads($request, 'hero_media', 'home/hero', $homePage->hero_media ?? []);
        $data['partner_logos'] = $this->storeMultipleUploads($request, 'partner_logos', 'partners', $homePage->partner_logos ?? []);
        $data['mission_points'] = $this->linesToItems($request->input('mission_points_text'));

        $homePage->update($data);

        return redirect()->route('admin.home-pages.index')->with('success', 'Konten beranda berhasil diperbarui.');
    }

    public function destroy(HomePage $homePage)
    {
        $homePage->delete();

        return redirect()->route('admin.home-pages.index')->with('success', 'Konten beranda berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'card_image' => ['nullable', 'image', 'max:4096'],
            'hero_media.*' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,gif,mp4,webm,ogg,mov', 'max:51200'],
            'vision_text' => ['nullable', 'string'],
            'about_excerpt' => ['nullable', 'string'],
            'mission_points_text' => ['nullable', 'string'],
            'partner_logos.*' => ['nullable', 'image', 'max:4096'],
        ]);
    }
}
