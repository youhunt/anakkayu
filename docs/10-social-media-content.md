# Social Media Content

Modul `/admin/social-content` menerima URL posting Instagram, Facebook, TikTok, YouTube, atau platform lain. Sistem menyimpan URL, platform, caption/manual data, media URL, dan atribusi.

Saat API resmi belum dikonfigurasi, sistem tidak melakukan scraping. Admin dapat paste caption dan metadata manual. Tombol Generate Draft membuat draft title, summary, body, dan meta description di `social_generated_contents` dengan status `draft`.

Semua konten hasil import wajib direview manusia sebelum publish.
