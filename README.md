# Sistem Pengelolaan Event Sekolah

Aplikasi berbasis web untuk mengelola event sekolah (seminar, workshop, lomba, pelatihan) secara terpusat — mulai dari pembuatan event, pengelolaan kategori dan jadwal, hingga pendaftaran dan verifikasi peserta.

## Deskripsi

Sebelumnya, pengelolaan event sekolah dilakukan secara manual dan tersebar di berbagai media, membuat pengelola kesulitan memantau event yang berlangsung, mencari data peserta, dan mengelola pendaftaran. Aplikasi ini dibangun menggunakan Laravel untuk menyatukan seluruh proses tersebut dalam satu sistem dengan pembagian hak akses yang jelas antar peran.

## Fitur Utama

- Autentikasi (login, register, logout) dengan Laravel Breeze
- Manajemen kategori event (CRUD)
- Manajemen event (CRUD) — nama, deskripsi, lokasi, kapasitas, status
- Manajemen jadwal per event (tambah/hapus jadwal detail)
- Pendaftaran event oleh peserta, lengkap dengan form nama & no HP
- Verifikasi & pengubahan status pendaftaran (menunggu, diterima, ditolak) oleh admin dan panitia
- Manajemen akun panitia oleh admin
- Search, filter, dan pagination pada daftar event
- Dashboard berbeda untuk tiap role, dengan ringkasan statistik dan data terbaru

## Role & Hak Akses

| Role | Dibuat Oleh | Hak Akses |
|---|---|---|
| **Admin** | Developer (seeder) | Kelola kategori, event, jadwal, dan akun panitia. Melihat & mengubah status semua pendaftaran. |
| **Panitia** | Admin | Melihat semua pendaftaran peserta dan mengubah statusnya. Tidak bisa mengelola event/kategori. |
| **Peserta** | Register mandiri | Melihat daftar event, mendaftar ke event, melihat status pendaftaran miliknya sendiri. |

## Teknologi

- **Backend**: Laravel 13, PHP 8.5
- **Frontend**: Blade Templating, Tailwind CSS, Alpine.js
- **Database**: MySQL
- **Autentikasi**: Laravel Breeze

## Struktur Database

- `users` — data pengguna + kolom `role` (admin/panitia/peserta)
- `kategoris` — kategori event
- `acaras` — data event (relasi ke kategori & pembuat)
- `jadwal_acaras` — jadwal detail per event (relasi ke acara)
- `pendaftarans` — data pendaftaran peserta ke event (relasi ke acara & user)

## Cara Menjalankan Project

1. Clone repository
```bash
   git clone <url-repo-ini>
   cd kelola_event
```

2. Install dependency
```bash
   composer install
   npm install
```

3. Salin file environment dan generate application key
```bash
   cp .env.example .env
   php artisan key:generate
```

4. Sesuaikan konfigurasi database di `.env`