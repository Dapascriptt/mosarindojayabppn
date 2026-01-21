<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;

class ProfileController extends Controller
{
    public function about()
    {
        $about = AboutPage::first();

        if (! $about) {
            $about = [
                'hero_title' => 'Kontraktor & Supply Konstruksi di Balikpapan',
                'hero_subtitle' => null,
                'hero_desc' => 'Mosarindo Jaya Balikpapan membantu showroom, interior, electrical, supply material, dan land clearing dengan tim bersertifikasi dan rantai pasok kuat. Fokus kami: ketepatan waktu, keamanan, dan kualitas eksekusi.',
                'video_url' => '/videos/about-us.mp4',
                'highlights' => [
                    'Sertifikasi K3 & electrical',
                    'Rantai pasok terencana',
                    'Dokumentasi progres transparan',
                ],
                'legal_items' => [
                    ['label' => 'Akta Pendirian', 'value' => 'Notaris Yuni Astuti, S.H.; No. 32/ 20 November 2019'],
                    ['label' => 'AHU', 'value' => 'AHU - 0061853 - AH.01.01 Tahun 2019'],
                    ['label' => 'NPWP', 'value' => '95.550.813.5 - 721.000'],
                    ['label' => 'NIB', 'value' => '9120216132825'],
                    ['label' => 'IUJK', 'value' => '1.6471.2.00927.471058'],
                ],
                'sbu_items' => [
                    ['code' => 'BG 001', 'desc' => 'JASA PELAKSANA UNTUK KONSTRUKSI GEDUNG HUNIAN'],
                    ['code' => 'BG 002', 'desc' => 'JASA PELAKSANA UNTUK KONSTRUKSI GEDUNG PERKANTORAN'],
                    ['code' => 'BG 003', 'desc' => 'JASA PELAKSANA UNTUK KONSTRUKSI GEDUNG INDUSTRI'],
                    ['code' => 'BG 009', 'desc' => 'JASA PELAKSANA UNTUK KONSTRUKSI GEDUNG LAINNYA'],
                ],
                'team_groups' => [
                    ['title' => 'Manager Teknik', 'members' => ['Muhammad Fatahillah']],
                    ['title' => 'Divisi Sipil & Pengawasan', 'members' => ['Aisyah Rizky Amalia']],
                    ['title' => 'Divisi Arsitektur, Interior & Landscape', 'members' => ['Jerman, IAI']],
                ],
                'certifications_text' => 'Tenaga ahli konstruksi Indonesia dengan sertifikat keahlian sesuai klasifikasi dan kualifikasi jasa konstruksi. Kompetensi tersertifikasi dan terakreditasi LPJK untuk memastikan eksekusi aman dan tepat standar.',
            ];
        }

        return view('pages.profile.about', compact('about'));
    }
}
