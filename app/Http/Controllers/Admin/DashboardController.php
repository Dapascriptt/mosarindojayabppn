<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use App\Models\ContactPage;
use App\Models\GalleryItem;
use App\Models\HomePage;
use App\Models\Product;
use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index', [
            'stats' => [
                ['label' => 'Produk', 'value' => Product::count(), 'route' => 'admin.products.index', 'icon' => 'bi-box-seam'],
                ['label' => 'Layanan', 'value' => Service::count(), 'route' => 'admin.services.index', 'icon' => 'bi-briefcase'],
                ['label' => 'Galeri', 'value' => GalleryItem::count(), 'route' => 'admin.gallery-items.index', 'icon' => 'bi-images'],
                ['label' => 'Halaman Konten', 'value' => HomePage::count() + AboutPage::count() + ContactPage::count(), 'route' => 'admin.home-pages.index', 'icon' => 'bi-file-earmark-richtext'],
            ],
            'latestProducts' => Product::latest()->take(5)->get(),
            'latestServices' => Service::latest()->take(5)->get(),
            'latestGallery' => GalleryItem::latest()->take(5)->get(),
        ]);
    }
}
