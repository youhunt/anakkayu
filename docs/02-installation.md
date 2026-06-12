# Installation

1. Buat database MySQL/MariaDB bernama `anakkayu`.
2. Jalankan `composer install`.
3. Salin `.env.example` menjadi `.env`.
4. Sesuaikan `app.baseURL`, database, email, dan admin awal.
5. Jalankan `php spark key:generate`.
6. Jalankan `php spark migrate --all` untuk migrasi Shield dan tabel AnakKayu.
7. Jalankan `php spark db:seed AnakKayuSeeder`.
8. Jalankan lokal dengan `php spark serve`.

Folder upload berada di `public/uploads`. Pastikan writable di hosting.
