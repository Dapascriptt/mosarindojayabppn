<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected array $articles = [
        [
            'slug' => 'proyek-terbaru',
            'title' => 'Proyek terbaru: Upgrade fasilitas showroom',
            'date' => '2025-12-20',
            'excerpt' => 'Penyelesaian interior showroom dengan standar premium untuk klien otomotif.',
            'body' => 'Kami menyelesaikan upgrade fasilitas showroom dengan fokus pada pencahayaan, electrical, dan interior premium.',
        ],
        [
            'slug' => 'kerjasama-supply-material',
            'title' => 'Kerja sama supply material konstruksi',
            'date' => '2025-11-05',
            'excerpt' => 'Kemitraan baru untuk mempercepat rantai pasok material konstruksi di Kalimantan.',
            'body' => 'Dengan mitra baru, pengadaan material menjadi lebih efisien dan stabil untuk proyek jangka panjang.',
        ],
        [
            'slug' => 'sertifikasi-keamanan',
            'title' => 'Peningkatan sertifikasi keamanan kerja',
            'date' => '2025-10-10',
            'excerpt' => 'Tim lapangan memperbarui sertifikasi K3 dan electrical safety.',
            'body' => 'Kami terus memastikan tim memenuhi sertifikasi K3, electrical safety, dan best practice konstruksi.',
        ],
    ];

    public function index()
    {
        $articles = collect($this->articles)->sortByDesc('date')->values();
        return view('pages.news.index', compact('articles'));
    }

    public function show(string $slug)
    {
        $article = collect($this->articles)->firstWhere('slug', $slug);

        if (! $article) {
            abort(404);
        }

        return view('pages.news.show', compact('article'));
    }
}
