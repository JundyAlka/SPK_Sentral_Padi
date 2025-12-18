# SPK Sentral Padi - Tutorial Menjalankan Workspace

## 📋 Persyaratan Sistem

Pastikan Anda sudah menginstall:
- **PHP** >= 8.1
- **Composer** (Package Manager PHP)
- **Node.js** >= 18.x dan **npm**
- **MySQL** atau **MariaDB**
- **XAMPP/Laragon** (opsional, untuk kemudahan)

---

## 🚀 Langkah-langkah Menjalankan

### 1. Clone/Download Project
```bash
cd D:/Website
# Jika menggunakan Git:
git clone <repository-url> spk_sentral_padi
cd spk_sentral_padi
```

### 2. Install Dependencies PHP
```bash
composer install
```

### 3. Install Dependencies JavaScript
```bash
npm install
```

### 4. Konfigurasi Environment
```bash
# Copy file .env.example ke .env
copy .env.example .env

# Generate Application Key
php artisan key:generate
```

### 5. Konfigurasi Database
Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=spk_padi
DB_USERNAME=root
DB_PASSWORD=
```

**Catatan:** Buat database `spk_padi` terlebih dahulu di phpMyAdmin atau MySQL CLI:
```sql
CREATE DATABASE spk_padi;
```

### 6. Jalankan Migrasi Database
```bash
php artisan migrate
```

### 7. (Opsional) Jalankan Seeder untuk Data Awal
```bash
php artisan db:seed
```

### 8. Build Assets CSS/JS
```bash
# Untuk development (dengan hot reload):
npm run dev

# Untuk production:
npm run build
```

### 9. Jalankan Server Laravel
```bash
php artisan serve
```

Server akan berjalan di: **http://127.0.0.1:8000**

---

## 🔐 Akses Aplikasi

### Login Admin
- **URL:** http://127.0.0.1:8000/login
- **Email:** admin@example.com (sesuaikan dengan data seeder)
- **Password:** password

### Mode Demo/Guest
- **URL:** http://127.0.0.1:8000/user/dashboard
- Tidak perlu login, langsung akses dashboard user

### Halaman Guest Publik
- **URL:** http://127.0.0.1:8000/guest/daerah
- **URL:** http://127.0.0.1:8000/guest/dashboard

---

## 📁 Struktur Folder Penting

```
spk_sentral_padi/
├── app/
│   ├── Http/Controllers/    # Controller aplikasi
│   ├── Models/              # Model Eloquent
│   └── ...
├── database/
│   ├── migrations/          # File migrasi database
│   └── seeders/             # Data awal (seeder)
├── public/
│   ├── logo.png             # Logo aplikasi
│   ├── hero_padi.png        # Gambar hero section
│   └── logo_stats.png       # Icon 3D stats
├── resources/
│   ├── views/               # Blade templates
│   │   ├── admin/           # View untuk admin
│   │   ├── user/            # View untuk user
│   │   ├── guest/           # View untuk guest/tamu
│   │   └── layouts/         # Layout templates
│   └── css/app.css          # Tailwind CSS source
├── routes/
│   └── web.php              # Route definitions
└── .env                     # Environment config
```

---

## 🛠️ Perintah Artisan Berguna

```bash
# Clear semua cache
php artisan cache:clear
php artisan view:clear
php artisan config:clear
php artisan route:clear

# Lihat daftar route
php artisan route:list

# Buat controller baru
php artisan make:controller NamaController

# Buat model baru dengan migrasi
php artisan make:model NamaModel -m

# Rollback migrasi terakhir
php artisan migrate:rollback

# Reset dan jalankan ulang semua migrasi
php artisan migrate:fresh --seed
```

---

## ❓ Troubleshooting

### Sidebar Tidak Muncul
```bash
# Rebuild CSS
npm run build
# Clear cache
php artisan view:clear
```

### Error "SQLSTATE[42S02]: Table not found"
```bash
php artisan migrate
```

### Error "Class not found"
```bash
composer dump-autoload
```

### Port 8000 Sudah Digunakan
```bash
php artisan serve --port=8080
```

---

## 📞 Kontak

Jika ada pertanyaan atau masalah, silakan hubungi developer.

---

**Selamat menggunakan SPK Sentral Padi!** 🌾
