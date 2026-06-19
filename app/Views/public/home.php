<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>
<?php
$settings = $settings ?? [];
$portfolio = $portfolio ?? [];
$services = $services ?? [];
$products = $products ?? [];
$contents = $contents ?? [];
$aboutPage = $aboutPage ?? null;

$imageUrl = static function (?string $value, string $fallback): string {
    $value = trim((string) $value);
    if ($value === '') {
        return $fallback;
    }

    if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
        return $value;
    }

    return base_url(ltrim($value, '/'));
};

$excerpt = static function (?string $text, int $limit = 170): string {
    $text = trim(preg_replace('/\s+/', ' ', strip_tags((string) $text)) ?? '');
    if (strlen($text) <= $limit) {
        return $text;
    }

    return rtrim(substr($text, 0, $limit), " \t\n\r\0\x0B.,") . '...';
};

$fallbackHero = 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?auto=format&fit=crop&w=2200&q=85';
$fallbackWood = 'https://images.unsplash.com/photo-1618220179428-22790b461013?auto=format&fit=crop&w=1400&q=82';
$fallbackDetail = 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1400&q=82';
$heroImage = $imageUrl($settings['hero_image'] ?? '', $fallbackHero);
$aboutImage = $imageUrl($aboutPage['featured_image'] ?? ($portfolio[0]['featured_image'] ?? ''), $fallbackDetail);
$heroTitle = $settings['hero_title'] ?? 'Spesialis Mebel & Interior Kayu Berkualitas';
$heroSubtitle = $settings['hero_subtitle'] ?? 'Selamat Datang di Anakkayu.id';
$heroDescription = $settings['site_description'] ?? 'AnakKayu merancang dan memproduksi furniture, interior kayu, dekorasi, kemasan kayu, dan project custom dengan sentuhan natural yang hangat, presisi, dan berkelas.';
$cinematicVideo = $settings['cinematic_video_url'] ?? 'https://anakkayu.id/wp-content/uploads/2025/02/video2.mp4';
$aboutTitle = $aboutPage['title'] ?? 'Membentuk ruang yang hangat, natural, dan dibuat untuk bertahan lama.';
$aboutBody = $excerpt($aboutPage['body'] ?? 'Kami membantu pemilik rumah, cafe, kantor, brand retail, hingga kebutuhan industri menghadirkan elemen kayu yang fungsional sekaligus berkarakter. Dari konsultasi, desain, produksi, finishing, sampai instalasi, setiap tahap dibuat transparan, rapi, dan terukur.', 440);
$floatingFallback = [
    ['title' => 'Custom Cabinet', 'featured_image' => 'https://images.unsplash.com/photo-1600566752355-35792bedcfea?auto=format&fit=crop&w=900&q=80', 'slug' => '#'],
    ['title' => 'Interior Kayu', 'featured_image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=900&q=80', 'slug' => '#'],
    ['title' => 'Dekorasi Natural', 'featured_image' => 'https://images.unsplash.com/photo-1600489000022-c2086d79f9d4?auto=format&fit=crop&w=900&q=80', 'slug' => '#'],
];
$galleryItems = array_slice(array_values(array_filter($portfolio, static fn ($item): bool => ! empty($item['featured_image']))), 0, 5);
$galleryFallback = [
    'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=800&q=80',
    'https://images.unsplash.com/photo-1600210491892-03d54c0aaf87?auto=format&fit=crop&w=800&q=80',
    'https://images.unsplash.com/photo-1600607688969-a5bfcd646154?auto=format&fit=crop&w=800&q=80',
    'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=800&q=80',
    'https://images.unsplash.com/photo-1618220179428-22790b461013?auto=format&fit=crop&w=800&q=80',
];
?>

<section class="ak-hero ak-reveal" style="--ak-hero-image: url('<?= esc($heroImage) ?>')">
    <div class="ak-hero-overlay"></div>
    <div class="container ak-hero-content">
        <p class="ak-eyebrow"><?= esc($heroSubtitle) ?></p>
        <h1><?= esc($heroTitle) ?></h1>
        <p class="ak-hero-text"><?= esc($heroDescription) ?></p>
        <div class="ak-hero-actions">
            <a class="ak-btn ak-btn-gold" href="<?= base_url('produk') ?>">Lihat Katalog</a>
            <a class="ak-btn ak-btn-ghost" href="<?= ak_whatsapp_link('Halo AnakKayu, saya ingin konsultasi project kayu.') ?>" target="_blank" rel="noopener">Konsultasi WhatsApp</a>
        </div>
        <div class="ak-hero-note">
            <span>Custom furniture</span>
            <span>Interior kayu</span>
            <span>Project by request</span>
        </div>
    </div>
</section>

<section class="ak-floating container ak-reveal" aria-label="Portfolio pilihan AnakKayu">
    <?php foreach (array_slice($portfolio ?: $floatingFallback, 0, 3) as $item): ?>
        <?php $isFallback = (($item['slug'] ?? '#') === '#'); ?>
        <<?= $isFallback ? 'div' : 'a' ?> class="ak-float-card" <?= $isFallback ? '' : 'href="' . base_url('portfolio/' . $item['slug']) . '"' ?>>
            <img src="<?= esc($imageUrl($item['featured_image'] ?? '', $fallbackWood)) ?>" alt="<?= esc($item['title'] ?? 'Portfolio AnakKayu') ?>" loading="lazy">
            <span><?= esc($item['title'] ?? 'Portfolio AnakKayu') ?></span>
        </<?= $isFallback ? 'div' : 'a' ?>>
    <?php endforeach ?>
</section>

<section class="ak-about container ak-reveal">
    <div class="ak-about-copy">
        <p class="ak-eyebrow dark">Tentang AnakKayu</p>
        <h2><?= esc($aboutTitle) ?></h2>
        <p><?= esc($aboutBody) ?></p>
        <div class="ak-about-points">
            <span>Presisi</span>
            <span>Hangat</span>
            <span>Berkarakter</span>
        </div>
        <a class="ak-link" href="<?= base_url('tentang-kami') ?>">Kenali proses kami</a>
    </div>
    <div class="ak-about-media">
        <img src="<?= esc($aboutImage) ?>" alt="Tentang AnakKayu" loading="lazy">
    </div>
</section>

<section class="ak-why ak-reveal">
    <div class="container">
        <div class="ak-section-center">
            <p class="ak-eyebrow dark">Kenapa Harus Memilih Anakkayu.id?</p>
            <h2>Karya kayu yang tenang dipandang, nyaman digunakan, dan pantas dibanggakan.</h2>
        </div>
        <div class="ak-why-grid">
            <div class="ak-benefits">
                <article><span>01</span><h3>Material Terpilih</h3><p>Kayu, finishing, dan hardware dipilih mengikuti fungsi ruang, karakter desain, dan durabilitas.</p></article>
                <article><span>02</span><h3>Custom Presisi</h3><p>Ukuran, gaya, dan detail dibuat berdasarkan kebutuhan project, bukan sekadar template massal.</p></article>
            </div>
            <img src="<?= esc($imageUrl($portfolio[1]['featured_image'] ?? '', 'https://images.unsplash.com/photo-1600210491892-03d54c0aaf87?auto=format&fit=crop&w=900&q=80')) ?>" alt="Karya interior kayu AnakKayu" loading="lazy">
            <div class="ak-benefits">
                <article><span>03</span><h3>Visual Premium</h3><p>Komposisi modern classic dengan aksen natural yang mudah dipadukan di rumah, cafe, kantor, atau toko.</p></article>
                <article><span>04</span><h3>Inquiry Mudah</h3><p>Setiap produk, layanan, dan portfolio diarahkan ke WhatsApp dan form penawaran agar calon pelanggan cepat terlayani.</p></article>
            </div>
        </div>
    </div>
</section>

<section class="ak-services ak-reveal">
    <div class="container">
        <div class="ak-section-head ak-section-head-light">
            <p class="ak-eyebrow dark">Layanan Kami</p>
            <h2>Dari ide ruang sampai instalasi akhir.</h2>
            <a class="ak-link" href="<?= base_url('layanan') ?>">Lihat semua layanan</a>
        </div>
        <div class="row g-4">
            <?php foreach ($services ?: [
                ['service_name' => 'Furniture Custom', 'summary' => 'Meja, kabinet, rak, dan furniture built-in.', 'slug' => 'furniture-custom'],
                ['service_name' => 'Interior Kayu', 'summary' => 'Panel, backdrop, partisi, dan aksen ruang.', 'slug' => 'interior-kayu'],
                ['service_name' => 'Restorasi', 'summary' => 'Perbaikan dan refinishing furniture lama.', 'slug' => 'restorasi'],
            ] as $index => $service): ?>
                <div class="col-md-6 col-xl-4">
                    <a class="ak-service-card" href="<?= base_url('layanan/' . ($service['slug'] ?? '#')) ?>">
                        <span><?= str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) ?></span>
                        <h3><?= esc($service['service_name']) ?></h3>
                        <p><?= esc($service['summary'] ?? '') ?></p>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>

<section class="ak-strip ak-reveal" aria-label="Gallery AnakKayu">
    <?php if ($galleryItems !== []): ?>
        <?php foreach ($galleryItems as $item): ?>
            <a href="<?= base_url('portfolio/' . $item['slug']) ?>">
                <img src="<?= esc($imageUrl($item['featured_image'], $fallbackWood)) ?>" alt="<?= esc($item['title']) ?>" loading="lazy">
            </a>
        <?php endforeach ?>
    <?php else: ?>
        <?php foreach ($galleryFallback as $i => $image): ?>
            <img src="<?= esc($image) ?>" alt="Gallery interior kayu <?= $i + 1 ?>" loading="lazy">
        <?php endforeach ?>
    <?php endif ?>
</section>

<section class="ak-cinematic ak-reveal" aria-label="AnakKayu cinematic story">
    <video class="ak-cinematic-video" autoplay muted loop playsinline preload="metadata">
        <source src="<?= esc($cinematicVideo) ?>" type="video/mp4">
    </video>
    <div class="ak-cinematic-overlay"></div>
    <div class="container ak-cinematic-content">
        <p>anakkayu.id</p>
        <h2>Beautiful Art of Kemiri</h2>
        <span>Crafted by AnakKayu</span>
        <a class="ak-btn ak-btn-gold" href="<?= base_url('inquiry') ?>">Mulai Project</a>
    </div>
</section>

<?php if (! empty($portfolio)): ?>
<section class="ak-portfolio container ak-reveal">
    <div class="ak-section-head">
        <p class="ak-eyebrow dark">Portfolio</p>
        <h2>Karya terbaru AnakKayu</h2>
        <a class="ak-link" href="<?= base_url('portfolio') ?>">Lihat semua portfolio</a>
    </div>
    <div class="row g-4">
        <?php foreach (array_slice($portfolio, 0, 6) as $item): ?>
            <div class="col-md-6 col-xl-4">
                <a class="ak-card" href="<?= base_url('portfolio/' . $item['slug']) ?>">
                    <img src="<?= esc($imageUrl($item['featured_image'] ?? '', $fallbackWood)) ?>" alt="<?= esc($item['title']) ?>" loading="lazy">
                    <div>
                        <h3><?= esc($item['title']) ?></h3>
                        <p><?= esc($excerpt($item['summary'] ?? $item['description'] ?? '', 130)) ?></p>
                    </div>
                </a>
            </div>
        <?php endforeach ?>
    </div>
</section>
<?php endif ?>

<?php if (! empty($products)): ?>
<section class="ak-products ak-grid-list ak-reveal">
    <div class="container">
        <div class="ak-section-head">
            <p class="ak-eyebrow dark">Produk</p>
            <h2>Katalog pilihan untuk kebutuhan rumah, bisnis, dan project custom.</h2>
            <a class="ak-link" href="<?= base_url('produk') ?>">Lihat katalog produk</a>
        </div>
        <div class="row g-4">
            <?php foreach ($products as $item): ?>
                <div class="col-md-6 col-xl-3">
                    <a class="ak-product-card" href="<?= base_url('produk/' . $item['slug']) ?>">
                        <img src="<?= esc($imageUrl($item['featured_image'] ?? '', $fallbackWood)) ?>" alt="<?= esc($item['product_name']) ?>" loading="lazy">
                        <h3><?= esc($item['product_name']) ?></h3>
                        <p><?= esc($excerpt($item['summary'] ?? $item['description'] ?? '', 96)) ?></p>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>
<?php endif ?>

<?php if (! empty($contents)): ?>
<section class="ak-journal container ak-reveal">
    <div class="ak-section-head">
        <p class="ak-eyebrow dark">Inspirasi</p>
        <h2>Konten terbaru AnakKayu</h2>
        <a class="ak-link" href="<?= base_url('artikel') ?>">Lihat semua artikel</a>
    </div>
    <div class="row g-4">
        <?php foreach ($contents as $item): ?>
            <div class="col-md-4">
                <a class="ak-journal-card" href="<?= base_url('artikel/' . $item['slug']) ?>">
                    <img src="<?= esc($imageUrl($item['featured_image'] ?? '', 'https://images.unsplash.com/photo-1600566752355-35792bedcfea?auto=format&fit=crop&w=800&q=80')) ?>" alt="<?= esc($item['title']) ?>" loading="lazy">
                    <div>
                        <span><?= esc(ak_date($item['published_at'] ?? $item['created_at'] ?? null)) ?></span>
                        <h3><?= esc($item['title']) ?></h3>
                        <p><?= esc($excerpt($item['summary'] ?? $item['body'] ?? '', 115)) ?></p>
                    </div>
                </a>
            </div>
        <?php endforeach ?>
    </div>
</section>
<?php endif ?>

<section class="ak-final-cta ak-reveal">
    <div class="container">
        <p class="ak-eyebrow">Konsultasi Project</p>
        <h2>Punya ide ruang, produk, atau kebutuhan kayu khusus?</h2>
        <p>Kirimkan kebutuhan Anda. AnakKayu akan membantu membaca kebutuhan, memberi arahan material, dan menyiapkan jalur inquiry yang nyaman.</p>
        <div class="ak-hero-actions justify-content-center">
            <a class="ak-btn ak-btn-gold" href="<?= ak_whatsapp_link('Halo AnakKayu, saya ingin konsultasi dan minta penawaran.') ?>" target="_blank" rel="noopener">Chat WhatsApp</a>
            <a class="ak-btn ak-btn-ghost" href="<?= base_url('kontak') ?>">Form Kontak</a>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
