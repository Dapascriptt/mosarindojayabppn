<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesAdminUploads;
use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    use HandlesAdminUploads;

    public function index(Request $request)
    {
        $search = $request->string('search')->toString();
        $items = AboutPage::when($search, fn ($query) => $query->where(fn ($q) => $q
                ->where('hero_title', 'like', "%{$search}%")
                ->orWhere('hero_desc', 'like', "%{$search}%")))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.about-pages.index', compact('items', 'search'));
    }

    public function create()
    {
        return view('admin.about-pages.create', ['item' => new AboutPage()]);
    }

    public function store(Request $request)
    {
        $data = $this->payload($request);
        $data['video_url'] = $this->storeSingleUpload($request, 'video_url', 'about');
        $data['location_photos'] = $this->storeMultipleUploads($request, 'location_photos', 'about/locations');

        AboutPage::create($data);

        return redirect()->route('admin.about-pages.index')->with('success', 'Konten profil berhasil ditambahkan.');
    }

    public function show(AboutPage $aboutPage)
    {
        return view('admin.about-pages.show', ['item' => $aboutPage]);
    }

    public function edit(AboutPage $aboutPage)
    {
        return view('admin.about-pages.edit', ['item' => $aboutPage]);
    }

    public function update(Request $request, AboutPage $aboutPage)
    {
        $data = $this->payload($request);
        $data['video_url'] = $this->storeSingleUpload($request, 'video_url', 'about', $aboutPage->video_url);
        $data['location_photos'] = $this->storeMultipleUploads($request, 'location_photos', 'about/locations', $aboutPage->location_photos ?? []);

        $aboutPage->update($data);

        return redirect()->route('admin.about-pages.index')->with('success', 'Konten profil berhasil diperbarui.');
    }

    public function destroy(AboutPage $aboutPage)
    {
        $aboutPage->delete();

        return redirect()->route('admin.about-pages.index')->with('success', 'Konten profil berhasil dihapus.');
    }

    private function payload(Request $request): array
    {
        $data = $request->validate([
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_subtitle' => ['nullable', 'string', 'max:255'],
            'hero_desc' => ['nullable', 'string'],
            'video_url' => ['nullable', 'file', 'mimes:mp4,webm,ogg,mov', 'max:51200'],
            'location_photos.*' => ['nullable', 'image', 'max:4096'],
            'certifications_text' => ['nullable', 'string'],
            'highlights_text' => ['nullable', 'string'],
            'legal_label' => ['nullable', 'array'],
            'legal_value' => ['nullable', 'array'],
            'sbu_code' => ['nullable', 'array'],
            'sbu_desc' => ['nullable', 'array'],
            'team_title' => ['nullable', 'array'],
            'team_members' => ['nullable', 'array'],
        ]);

        $data['highlights'] = $this->linesToItems($request->input('highlights_text'));
        $data['legal_items'] = $this->pairs($request->input('legal_label', []), $request->input('legal_value', []), 'label', 'value');
        $data['sbu_items'] = $this->pairs($request->input('sbu_code', []), $request->input('sbu_desc', []), 'code', 'desc');
        $data['team_groups'] = collect($request->input('team_title', []))
            ->map(function ($title, $index) use ($request) {
                $members = collect(preg_split('/\r\n|\r|\n/', (string) data_get($request->input('team_members', []), $index)))
                    ->map(fn ($name) => trim($name))
                    ->filter()
                    ->values()
                    ->all();

                return ['title' => trim((string) $title), 'members' => $members];
            })
            ->filter(fn ($group) => $group['title'] !== '' || ! empty($group['members']))
            ->values()
            ->all();

        unset($data['highlights_text'], $data['legal_label'], $data['legal_value'], $data['sbu_code'], $data['sbu_desc'], $data['team_title'], $data['team_members']);

        return $data;
    }

    private function pairs(array $left, array $right, string $leftKey, string $rightKey): array
    {
        return collect($left)
            ->map(fn ($value, $index) => [
                $leftKey => trim((string) $value),
                $rightKey => trim((string) ($right[$index] ?? '')),
            ])
            ->filter(fn ($item) => $item[$leftKey] !== '' || $item[$rightKey] !== '')
            ->values()
            ->all();
    }
}
