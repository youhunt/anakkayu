# Development Guide

Standar pengembangan:

- Gunakan migration untuk perubahan skema.
- Gunakan model untuk query data.
- Gunakan service untuk business logic lintas controller.
- Validasi input di controller.
- Jangan hardcode credential.
- Aktifkan CSRF.
- Gunakan `base_url()` untuk asset.
- Gunakan slug unik via `ak_unique_slug()`.

Untuk menambah modul baru, buat migration, model, route, controller admin, view publik/admin, dan dokumentasi workflow.
