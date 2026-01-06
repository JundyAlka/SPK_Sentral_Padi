# SPK Sentral Padi

Sistem Penunjang Keputusan (SPK) untuk menentukan sentral produksi padi menggunakan metode **Simple Additive Weighting (SAW)**.

## Fitur
- **Dashboard Admin**: Statistik data alternatif, kriteria, dan pengguna.
- **Manajemen Data**: CRUD untuk Daerah (Alternatif) dan Kriteria.
- **Perhitungan SAW**: Otomatis menghitung ranking berdasarkan bobot dinamis.
- **Grafik**: Visualisasi hasil perankingan.

## Teknologi
- **Framework**: Laravel 11
- **Database**: MySQL / PostgreSQL (Production)
- **Styling**: Tailwind CSS
- **Deployment**: Vercel

## Cara Install (Lokal)
1. Clone repository
2. `composer install`
3. `cp .env.example .env` (Atur database)
4. `php artisan key:generate`
5. `php artisan migrate:fresh --seed`
6. `php artisan serve`

## Deployment (Vercel)
Project ini dikonfigurasi untuk berjalan di Vercel menggunakan `vercel-php`.
Pastikan Environment Variables diset: `APP_KEY`, `DB_CONNECTION=pgsql`, dll.
