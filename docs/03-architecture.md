# Architecture

Struktur utama:

- `app/Controllers/PublicSite`: halaman publik.
- `app/Controllers/Admin`: dashboard dan CMS admin.
- `app/Models`: model per tabel domain.
- `app/Services/SocialMedia`: import referensi sosial dan generator draft.
- `app/Views/public`: landing page dan halaman publik.
- `app/Views/admin`: dashboard admin Skote-ready.
- `app/Database/Migrations`: skema database.
- `app/Database/Seeds`: data awal dan admin user.
- `public/assets/anakkayu`: CSS/JS custom.
- `public/assets/skote`: target asset Skote yang sudah disiapkan.
- `docs`: dokumentasi teknis.

Controller menjaga request/response. Model mengakses data. Service berisi business logic sosial media. View menjaga presentasi.
