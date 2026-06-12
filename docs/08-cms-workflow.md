# CMS Workflow

Admin mengelola konten melalui `/admin/contents`.

Workflow:

1. Author membuat draft.
2. Editor review isi, SEO, featured image, dan kategori.
3. Editor/Admin mengubah status menjadi `published`.
4. Konten tampil di `/artikel` dan detail `/artikel/{slug}`.
5. Konten yang tidak aktif dapat diubah ke `archived` atau dihapus soft delete.

Field penting: title, slug otomatis, summary, body, category, featured image, status, meta title, meta description.
