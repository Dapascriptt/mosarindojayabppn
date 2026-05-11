<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesAdminUploads;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    use HandlesAdminUploads;

    public function index(Request $request)
    {
        $search = $request->string('search')->toString();
        $items = Service::withCount('details')
            ->when($search, fn ($query) => $query->where(fn ($q) => $q
                ->where('name', 'like', "%{$search}%")
                ->orWhere('slug', 'like', "%{$search}%")
                ->orWhere('short_desc', 'like', "%{$search}%")))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.services.index', compact('items', 'search'));
    }

    public function create()
    {
        return view('admin.services.create', ['item' => new Service()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $data['image'] = $this->storeSingleUpload($request, 'image', 'services');
        $data['hero_media'] = $this->storeSingleUpload($request, 'hero_media', 'services/hero');

        DB::transaction(function () use ($data, $request) {
            $service = Service::create($data);
            $this->syncDetails($service, $request);
        });

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function show(Service $service)
    {
        $service->load('details');

        return view('admin.services.show', ['item' => $service]);
    }

    public function edit(Service $service)
    {
        $service->load('details');

        return view('admin.services.edit', ['item' => $service]);
    }

    public function update(Request $request, Service $service)
    {
        $data = $this->validated($request, $service);
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $data['image'] = $this->storeSingleUpload($request, 'image', 'services', $service->image);
        $data['hero_media'] = $this->storeSingleUpload($request, 'hero_media', 'services/hero', $service->hero_media);

        DB::transaction(function () use ($service, $data, $request) {
            $service->update($data);
            $this->syncDetails($service, $request);
        });

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil dihapus.');
    }

    private function validated(Request $request, ?Service $service = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('services', 'slug')->ignore($service)],
            'short_desc' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'hero_media' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,gif,mp4,webm,ogg,mov', 'max:51200'],
        ]);
    }

    private function syncDetails(Service $service, Request $request): void
    {
        $details = collect($request->input('details', []))
            ->map(fn ($detail) => trim((string) $detail))
            ->filter()
            ->map(fn ($detail) => ['detail' => $detail])
            ->values()
            ->all();

        $service->details()->delete();
        $service->details()->createMany($details);
    }
}
