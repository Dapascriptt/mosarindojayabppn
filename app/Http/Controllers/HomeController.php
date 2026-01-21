<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;
use App\Models\HomePage;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $about = AboutPage::first();
        $home = HomePage::first();

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
        ]);
    }
}
