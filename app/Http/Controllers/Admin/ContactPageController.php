<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesAdminUploads;
use App\Http\Controllers\Controller;
use App\Models\ContactPage;
use Illuminate\Http\Request;

class ContactPageController extends Controller
{
    use HandlesAdminUploads;

    public function index(Request $request)
    {
        $search = $request->string('search')->toString();
        $items = ContactPage::when($search, fn ($query) => $query->where(fn ($q) => $q
                ->where('hero_title', 'like', "%{$search}%")
                ->orWhere('company_name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.contact-pages.index', compact('items', 'search'));
    }

    public function create()
    {
        return view('admin.contact-pages.create', ['item' => new ContactPage()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['hero_bg'] = $this->storeSingleUpload($request, 'hero_bg', 'contact');

        ContactPage::create($data);

        return redirect()->route('admin.contact-pages.index')->with('success', 'Konten kontak berhasil ditambahkan.');
    }

    public function show(ContactPage $contactPage)
    {
        return view('admin.contact-pages.show', ['item' => $contactPage]);
    }

    public function edit(ContactPage $contactPage)
    {
        return view('admin.contact-pages.edit', ['item' => $contactPage]);
    }

    public function update(Request $request, ContactPage $contactPage)
    {
        $data = $this->validated($request);
        $data['hero_bg'] = $this->storeSingleUpload($request, 'hero_bg', 'contact', $contactPage->hero_bg);

        $contactPage->update($data);

        return redirect()->route('admin.contact-pages.index')->with('success', 'Konten kontak berhasil diperbarui.');
    }

    public function destroy(ContactPage $contactPage)
    {
        $contactPage->delete();

        return redirect()->route('admin.contact-pages.index')->with('success', 'Konten kontak berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_desc' => ['nullable', 'string'],
            'hero_bg' => ['nullable', 'image', 'max:4096'],
            'form_title' => ['nullable', 'string', 'max:255'],
            'form_desc' => ['nullable', 'string'],
            'info_title' => ['nullable', 'string', 'max:255'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'whatsapp' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'maps_embed_url' => ['nullable', 'string'],
            'cta_whatsapp_label' => ['nullable', 'string', 'max:255'],
            'cta_email_label' => ['nullable', 'string', 'max:255'],
        ]);
    }
}
