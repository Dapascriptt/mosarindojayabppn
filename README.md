# PT. Masarindo Jaya Balikpapan

Website company profile dan katalog untuk PT. Masarindo Jaya Balikpapan (kontraktor dan supply konstruksi).

## Ringkasan
- Landing page dengan hero slider, visi-misi, dan logo mitra/klien.
- Halaman Produk dan Layanan dengan detail lengkap.
- Halaman Tentang Kami berisi profil, legalitas, dan tenaga ahli.
- Galeri proyek dengan modal yang menampilkan banyak foto.
- Halaman Kontak + peta lokasi.
- Admin panel memakai Filament untuk kelola konten.

## Tech Stack
- Laravel 10
- PHP 8.x
- Vite
- Tailwind CSS
- Filament (Admin)
- MySQL/MariaDB (atau database lain yang didukung Laravel)

## Fitur Utama
- Produk: judul, kategori, ringkasan, deskripsi, gambar, dan detail poin.
- Layanan: judul, ringkasan, deskripsi, gambar, dan detail poin.
- Hero media: bisa gambar/video untuk homepage, produk, dan layanan.
- Tentang Kami: video hero, highlights, legalitas, SBU, tenaga ahli, dan sertifikasi.
- Galeri: banyak foto per item dengan modal detail.
- Logo mitra/klien di beranda.

## Admin (Filament)
Kelola konten melalui `/admin`:
- Products
- Services
- Home
- About
- Gallery

> Catatan: semua media menggunakan upload lokal (Storage). Pastikan storage link sudah dibuat.

## Instalasi Lokal
1. Install dependency:
   - `composer install`
   - `npm install`
2. Setup env:
   - Copy `.env.example` ke `.env`
   - Atur koneksi database
3. Generate key:
   - `php artisan key:generate`
4. Migrasi database:
   - `php artisan migrate`
5. Storage link:
   - `php artisan storage:link`
6. Jalankan dev server:
   - `php artisan serve`
   - `npm run dev`

## Struktur Konten
- Public media: `public/image`, `public/videos`
- Upload media: `storage/app/public`
- View utama: `resources/views/pages`
- Partial: `resources/views/partials`

## Lisensi
Internal project untuk PT. Masarindo Jaya Balikpapan.
