<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\GalleryItemController as AdminGalleryItemController;
use App\Http\Controllers\Admin\HomePageController as AdminHomePageController;
use App\Http\Controllers\Admin\AboutPageController as AdminAboutPageController;
use App\Http\Controllers\Admin\ContactPageController as AdminContactPageController;

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

/*
|--------------------------------------------------------------------------
| CMS Admin Manual
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('products', AdminProductController::class);
    Route::resource('services', AdminServiceController::class);
    Route::resource('gallery-items', AdminGalleryItemController::class);
    Route::resource('home-pages', AdminHomePageController::class);
    Route::resource('about-pages', AdminAboutPageController::class);
    Route::resource('contact-pages', AdminContactPageController::class);
});
