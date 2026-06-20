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

$fallbackHero = base_url('assets/anakkayu/img/hero-workshop.png');
$fallbackWood = base_url('assets/anakkayu/img/hero-workshop.png');
$fallbackDetail = base_url('assets/anakkayu/img/craft-detail.png');
$heroImage = $imageUrl($settings['hero_image'] ?? '', $fallbackHero);
$aboutImage = $imageUrl($aboutPage['featured_image'] ?? ($portfolio[0]['featured_image'] ?? ''), $fallbackDetail);
$whyImage = $imageUrl($portfolio[1]['featured_image'] ?? ($portfolio[0]['featured_image'] ?? ''), $fallbackDetail);
$heroTitle = $settings['hero_title'] ?? 'Spesialis Mebel & Interior Kayu Berkualitas';
$heroSubtitle = $settings['hero_subtitle'] ?? 'Selamat Datang di Anakkayu.id';
$heroDescription = $settings['site_description'] ?? 'AnakKayu merancang dan memproduksi furniture, interior kayu, dekorasi, kemasan kayu, dan project custom dengan sentuhan natural yang hangat, presisi, dan berkelas.';
$cinematicVideo = trim((string) ($settings['cinematic_video_url'] ?? ''));
$aboutTitle = $aboutPage['title'] ?? 'Membentuk ruang yang hangat, natural, dan dibuat untuk bertahan lama.';
$aboutBody = $excerpt($aboutPage['body'] ?? 'Kami membantu pemilik rumah, cafe, kantor, brand retail, hingga kebutuhan industri menghadirkan elemen kayu yang fungsional sekaligus berkarakter. Dari konsultasi, desain, produksi, finishing, sampai instalasi, setiap tahap dibuat transparan, rapi, dan terukur.', 440);
$floatingFallback = [
    ['title' => 'Custom Furniture', 'featured_image' => $fallbackHero, 'slug' => '#'],
    ['title' => 'Detail Kerajinan', 'featured_image' => $fallbackDetail, 'slug' => '#'],
    ['title' => 'Interior Kayu', 'featured_image' => $fallbackHero, 'slug' => '#'],
];
$galleryItems = array_slice(array_values(array_filter($portfolio, static fn ($item): bool => ! empty($item['featured_image']))), 0, 5);
$galleryFallback = [$fallbackHero, $fallbackDetail, $fallbackHero, $fallbackDetail, $fallbackHero];
$productFallback = [
    ['product_name' => 'Meja Kayu Solid', 'summary' => 'Meja makan natural dengan proporsi yang tenang dan detail sambungan presisi.', 'slug' => '#', 'featured_image' => $fallbackHero],
    ['product_name' => 'Kabinet Custom', 'summary' => 'Penyimpanan fungsional yang dirancang mengikuti ukuran dan ritme ruang.', 'slug' => '#', 'featured_image' => $fallbackDetail],
    ['product_name' => 'Kursi Kerajinan', 'summary' => 'Bentuk ergonomis, sentuhan halus, dan karakter kayu yang tetap terasa.', 'slug' => '#', 'featured_image' => $fallbackHero],
    ['product_name' => 'Panel Interior', 'summary' => 'Aksen kayu hangat untuk rumah, cafe, kantor, dan ruang retail.', 'slug' => '#', 'featured_image' => $fallbackDetail],
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
        <a class="ak-scroll-cue" href="#tentang" aria-label="Lanjut ke bagian tentang AnakKayu"><span></span>Jelajahi</a>
    </div>
</section>

<section class="ak-floating container ak-reveal" aria-label="Portfolio pilihan AnakKayu">
    <?php foreach (array_slice($portfolio ?: $floatingFallback, 0, 3) as $item): ?>
        <?php $isFallback = (($item['slug'] ?? '#') === '#'); ?>
        <?php if ($isFallback): ?>
            <div class="ak-float-card">
        <?php else: ?>
            <a class="ak-float-card" href="<?= base_url('portfolio/' . $item['slug']) ?>">
        <?php endif ?>
            <img src="<?= esc($imageUrl($item['featured_image'] ?? '', $fallbackWood)) ?>" alt="<?= esc($item['title'] ?? 'Portfolio AnakKayu') ?>" loading="lazy">
            <span><?= esc($item['title'] ?? 'Portfolio AnakKayu') ?></span>
        <?php if ($isFallback): ?>
            </div>
        <?php else: ?>
            </a>
        <?php endif ?>
    <?php endforeach ?>
</section>

<section class="ak-modern-stats ak-reveal" aria-label="Keunggulan AnakKayu">
    <div class="container">
        <div class="ak-stat-card"><strong>01</strong><span>Konsultasi kebutuhan ruang dan ukuran secara rapi.</span></div>
        <div class="ak-stat-card"><strong>02</strong><span>Material, finishing, dan detail dibuat sesuai fungsi.</span></div>
        <div class="ak-stat-card"><strong>03</strong><span>Hasil akhir hangat, natural, berkelas, dan tahan lama.</span></div>
    </div>
</section>

<section class="ak-about container ak-reveal" id="tentang">
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

<section class="ak-process ak-reveal" aria-label="Alur kerja AnakKayu">
    <div class="container">
        <div class="ak-process-head">
            <p class="ak-eyebrow dark">Alur Pengerjaan</p>
            <h2>Tenang dari awal, jelas di setiap tahap.</h2>
            <p>Kami ingin calon pelanggan merasa nyaman sejak konsultasi pertama. Karena itu alur kerja dibuat sederhana, transparan, dan mudah diikuti.</p>
        </div>
        <div class="ak-process-grid">
            <article>
                <span>01</span>
                <h3>Konsultasi & Ukur Kebutuhan</h3>
                <p>Ceritakan fungsi ruang, ukuran, gaya, budget, dan kebutuhan khusus. Kami bantu baca prioritasnya.</p>
            </article>
            <article>
                <span>02</span>
                <h3>Desain, Material & Penawaran</h3>
                <p>Detail material, finishing, bentuk, dan estimasi biaya dirapikan agar keputusan lebih yakin.</p>
            </article>
            <article>
                <span>03</span>
                <h3>Produksi & Finishing</h3>
                <p>Proses pengerjaan dijaga presisi, lalu hasil akhir dipastikan nyaman dilihat dan nyaman digunakan.</p>
            </article>
        </div>
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
            <img src="<?= esc($whyImage) ?>" alt="Karya interior kayu AnakKayu" loading="lazy">
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
                ['service_name' => 'Furniture Custom', 'summary' => 'Meja, kabinet, rak, dan furniture built-in.', 'slug' => '#'],
                ['service_name' => 'Interior Kayu', 'summary' => 'Panel, backdrop, partisi, dan aksen ruang.', 'slug' => '#'],
                ['service_name' => 'Restorasi', 'summary' => 'Perbaikan dan refinishing furniture lama.', 'slug' => '#'],
            ] as $index => $service): ?>
                <div class="col-md-6 col-xl-4">
                    <a class="ak-service-card" href="<?= ($service['slug'] ?? '#') === '#' ? base_url('layanan') : base_url('layanan/' . $service['slug']) ?>">
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
    <?php if ($cinematicVideo !== ''): ?>
    <video class="ak-cinematic-video" autoplay muted loop playsinline preload="metadata">
        <source src="<?= esc($cinematicVideo) ?>" type="video/mp4">
    </video>
    <?php else: ?>
        <div class="ak-cinematic-image" style="background-image:url('<?= esc($fallbackDetail) ?>')"></div>
    <?php endif ?>
    <div class="ak-cinematic-overlay"></div>
    <div class="container ak-cinematic-content">
        <p>anakkayu.id</p>
        <h2>Seni Kayu yang Tenang</h2>
        <span>Dikerjakan perlahan, dibuat untuk menemani lebih lama.</span>
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

<section class="ak-products ak-grid-list ak-reveal">
    <div class="container">
        <div class="ak-section-head">
            <p class="ak-eyebrow dark">Produk</p>
            <h2>Katalog pilihan untuk kebutuhan rumah, bisnis, dan project custom.</h2>
            <a class="ak-link" href="<?= base_url('produk') ?>">Lihat katalog produk</a>
        </div>
        <div class="row g-4">
            <?php foreach ($products ?: $productFallback as $item): ?>
                <div class="col-md-6 col-xl-3">
                    <a class="ak-product-card" href="<?= ($item['slug'] ?? '#') === '#' ? base_url('produk') : base_url('produk/' . $item['slug']) ?>">
                        <img src="<?= esc($imageUrl($item['featured_image'] ?? '', $fallbackWood)) ?>" alt="<?= esc($item['product_name']) ?>" loading="lazy">
                        <h3><?= esc($item['product_name']) ?></h3>
                        <p><?= esc($excerpt($item['summary'] ?? $item['description'] ?? '', 96)) ?></p>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>

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
                    <img src="<?= esc($imageUrl($item['featured_image'] ?? '', $fallbackDetail)) ?>" alt="<?= esc($item['title']) ?>" loading="lazy">
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
