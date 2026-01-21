<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Website Kontraktor - Masarindo Jaya Balikpapan
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Beranda
|--------------------------------------------------------------------------
*/
Route::get('/', HomeController::class)->name('home');

/*
|--------------------------------------------------------------------------
| Produk
|--------------------------------------------------------------------------
*/
Route::prefix('produk')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/{slug}', [ProductController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| Layanan
|--------------------------------------------------------------------------
*/
Route::prefix('layanan')->name('services.')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('index');
    Route::get('/{service}', [ServiceController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| Profil (Dropdown)
|--------------------------------------------------------------------------
*/
Route::prefix('profil')->name('profile.')->group(function () {
    Route::get('/tentang-kami', [ProfileController::class, 'about'])->name('about');
});

/*
|--------------------------------------------------------------------------
| Galeri
|--------------------------------------------------------------------------
*/
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery');

/*
|--------------------------------------------------------------------------
| Kontak
|--------------------------------------------------------------------------
*/
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'submit'])->name('contact.submit');
