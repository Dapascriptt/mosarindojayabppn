<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesAdminUploads;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    use HandlesAdminUploads;

    public function index(Request $request)
    {
        $search = $request->string('search')->toString();
        $type = $request->string('type')->toString();

        $items = Product::withCount('details')
            ->when($search, fn ($query) => $query->where(fn ($q) => $q
                ->where('name', 'like', "%{$search}%")
                ->orWhere('category', 'like', "%{$search}%")
                ->orWhere('slug', 'like', "%{$search}%")))
            ->when($type, fn ($query) => $query->where('type', $type))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.products.index', compact('items', 'search', 'type'));
    }

    public function create()
    {
        return view('admin.products.create', ['item' => new Product()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $data['image'] = $this->storeSingleUpload($request, 'image', 'products');
        $data['hero_media'] = $this->storeSingleUpload($request, 'hero_media', 'products/hero');

        DB::transaction(function () use ($data, $request) {
            $product = Product::create($data);
            $this->syncDetails($product, $request);
        });

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Product $product)
    {
        $product->load('details');

        return view('admin.products.show', ['item' => $product]);
    }

    public function edit(Product $product)
    {
        $product->load('details');

        return view('admin.products.edit', ['item' => $product]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validated($request, $product);
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $data['image'] = $this->storeSingleUpload($request, 'image', 'products', $product->image);
        $data['hero_media'] = $this->storeSingleUpload($request, 'hero_media', 'products/hero', $product->hero_media);

        DB::transaction(function () use ($product, $data, $request) {
            $product->update($data);
            $this->syncDetails($product, $request);
        });

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    private function validated(Request $request, ?Product $product = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($product)],
            'type' => ['required', Rule::in(['mjb-kontraktor', 'mjb-food'])],
            'category' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'hero_media' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,gif,mp4,webm,ogg,mov', 'max:51200'],
        ]);
    }

    private function syncDetails(Product $product, Request $request): void
    {
        $details = collect($request->input('details', []))
            ->map(fn ($detail) => trim((string) $detail))
            ->filter()
            ->map(fn ($detail) => ['detail' => $detail])
            ->values()
            ->all();

        $product->details()->delete();
        $product->details()->createMany($details);
    }
}
