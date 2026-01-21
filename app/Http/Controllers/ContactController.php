<?php

namespace App\Http\Controllers;

use App\Models\ContactPage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contact = ContactPage::first();

        if (! $contact) {
            $contact = [
                'hero_title' => 'Kami siap membantu proyek Anda',
                'hero_desc' => 'Hubungi kontraktor dan supplier Balikpapan untuk kebutuhan konstruksi, MEP, interior, pemeliharaan, serta supply material dan daging ayam.',
                'form_title' => 'Form Kontak',
                'form_desc' => 'Isi data di bawah, kami akan menghubungi Anda.',
                'info_title' => 'Kontak Kami',
                'company_name' => 'PT. Mosarindo Jaya Balikpapan',
                'address' => "Jalan MT Haryono No 43, Kelurahan Damai, Bahagia,\nKec. Balikpapan Kota, Kota Balikpapan,\nKalimantan Timur 76114",
                'whatsapp' => '+62 812 5489 9699',
                'email' => 'pt.mosarindojayabpp@gmail.com',
                'maps_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.1827836090397!2d110.406005!3d-7.761694!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5a3b76e85c9d%3A0x65c02e4b97b34f05!2sYogyakarta!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid',
                'cta_whatsapp_label' => 'Chat WhatsApp',
                'cta_email_label' => 'Kirim Email',
            ];
        }

        return view('pages.contact.index', [
            'contact' => $contact,
        ]);
    }

    public function submit(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        // Untuk demo, cukup flash berhasil. Integrasi email/DB bisa ditambahkan.
        return back()->with('status', 'Pesan berhasil dikirim. Terima kasih, kami akan segera menghubungi Anda.');
    }
}
