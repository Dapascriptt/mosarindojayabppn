<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact.index');
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
