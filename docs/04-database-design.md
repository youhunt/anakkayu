# Database Design

Tabel utama:

- `contents`: artikel CMS, status draft/review/published/archived, SEO, featured image, counter.
- `pages`: halaman statis seperti Tentang Kami, Kontak, Kebijakan Privasi.
- `products`: katalog produk dengan harga optional, SKU, material, ukuran, finishing, gallery JSON, CTA inquiry.
- `services`: katalog layanan dengan benefit dan process JSON.
- `portfolios`: project gallery dengan client, lokasi, tanggal, gallery, SEO.
- `categories`: kategori polymorphic memakai `type` untuk content/product/service/portfolio.
- `tags`: tag global.
- `content_tags`, `product_tags`, `service_tags`, `portfolio_tags`: relasi many-to-many tag.
- `media`: metadata upload aman.
- `inquiries`: lead dari form kontak, produk, layanan, portfolio.
- `site_settings`: key-value pengaturan website.
- `content_views`, `product_views`, `service_views`, `portfolio_views`: log view.
- `share_logs`: log share per platform.
- `activity_logs`: audit aktivitas admin.
- `menu_items`: calon menu dinamis.
- `testimonials`: testimoni.
- `banners`: banner/hero.
- `social_sources`, `social_imports`, `social_generated_contents`, `social_import_logs`: social import/generator.

Setiap tabel penting memakai timestamps. Tabel konten utama memakai soft delete dan field audit `created_by`, `updated_by`, `deleted_by`.
