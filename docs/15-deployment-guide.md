# Deployment Guide

1. Set document root hosting ke folder `public`.
2. Upload source tanpa `.env` lokal dan tanpa credential.
3. Buat `.env` production.
4. Set `CI_ENVIRONMENT = production`.
5. Set `app.baseURL = 'https://anakkayu.id/'`.
6. Konfigurasi database production.
7. Jalankan migration dan seeder sesuai kebutuhan.
8. Pastikan `writable` dan `public/uploads` bisa ditulis.
9. Pasang SSL.
10. Ganti password admin default.

Untuk VPS, jalankan di Nginx/Apache dengan PHP-FPM dan arahkan root ke `public`.
