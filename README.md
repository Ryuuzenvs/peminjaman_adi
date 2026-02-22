Panduan Menjalankan Proyek (Running Guide)

Pastikan di komputer sudah terinstall PHP >= 8.2, Composer, dan MySQL/MariaDB.

note : pastiin letakin proyek ini di dalam htdocs(root localserver, proyek localserver) biar bisa di akses kayak biasa
1. Clone Proyek

Buka terminal, lalu jalankan perintah:

git clone https://github.com/Ryuuzenvs/peminjaman_lar.git

cd peminjaman_lar

1.1 opsional(kalau gabisa git clone) : instal zip, esktrak.

2. Install Dependencies

Instal semua library Laravel yang dibutuhkan melalui Composer:


composer install

3. Konfigurasi Environment (.env)

Laravel membutuhkan file .env untuk pengaturan database. Salin dari file contoh:

cp .env.example .env

atau bisa copy aja file .env.example

Setelah itu, buka file .env dan sesuaikan bagian ini:
Plaintext

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_peminjaman_lar  <-- Sesuaikan dengan nama DB yang kamu buat
DB_USERNAME=root               <-- Sesuaikan dengan username DB kamu
DB_PASSWORD=                   <-- Sesuaikan dengan password DB kamu

4. Generate App Key

Ini wajib agar aplikasi bisa berjalan dan enkripsi session aktif:

php artisan key:generate

5. Setup Database & Migrasi

Buat database baru di phpMyAdmin/Terminal dengan nama db_peminjaman_lar. Lalu, jalankan migrasi tabel beserta data awal:

php artisan migrate

opsional : isi data field user otomatis dengan seeder (langsung bisa login)

php artisan db:seed

user login 
- username : owner
- password : 12345678
- admin

- username : petugas
- password : 12345678
- petugas

- username : peminjam
- password : 12345678
- peminjam

Aplikasi Peminjaman Alat Inventaris adalah sistem berbasis web yang dirancang untuk mengelola sirkulasi peminjaman alat secara digital. Sistem ini membagi akses menjadi tiga level: Admin (Kelola master data), Petugas (Operasional/Approval), dan Peminjam (Self-service booking). Fitur unggulannya adalah perhitungan denda otomatis dan manajemen stok yang terintegrasi dengan transaksi.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
