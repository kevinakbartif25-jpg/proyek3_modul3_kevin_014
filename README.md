Aplikasi web sederhana berbasis Laravel untuk mengelola daftar kegiatan.

Cara Menjalankan Proyek:

Buka terminal pada folder proyek activity-manager.

Jalankan perintah untuk menginstal dependencies:
composer install

Salin file konfigurasi:
cp .env.example .env

Buat application key:
php artisan key:generate

Sesuaikan koneksi database di file .env.

Jalankan migrasi dan seeder untuk data awal:
php artisan migrate:fresh --seed --seeder=ActivitySeeder

Jalankan server lokal:
php artisan serve

Buka browser dan akses: http://127.0.0.1:8000/activities
