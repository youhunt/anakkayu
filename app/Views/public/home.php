<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>
<?php
$featureCards = [
    ['title' => 'Dekorasi Dinding Kayu', 'image' => 'card-1.jpg', 'url' => base_url('portfolio')],
    ['title' => 'Produk Kayu Eksklusif', 'image' => 'card-2.jpg', 'url' => base_url('produk')],
    ['title' => 'Furniture Custom', 'image' => 'card-3.jpg', 'url' => base_url('layanan')],
];

$landingServices = [
    ['title' => 'Furniture Custom', 'summary' => 'Pembuatan meja, kursi, lemari, kitchen set, dan furniture sesuai permintaan.'],
    ['title' => 'Interior & Eksterior Kayu', 'summary' => 'Desain dan pemasangan elemen kayu untuk rumah, kantor, cafe, dan ruang usaha.'],
    ['title' => 'Kemasan Kayu & Palet', 'summary' => 'Solusi kebutuhan industri dengan material kuat, rapi, dan mudah disesuaikan.'],
    ['title' => 'Dekorasi Kayu', 'summary' => 'Ornamen dan dekorasi berbahan kayu yang unik, eksklusif, dan berkarakter.'],
    ['title' => 'Renovasi & Restorasi', 'summary' => 'Perbaikan dan refinishing furniture lama agar kembali layak pakai dan menarik.'],
];

$portfolioCards = [
    ['title' => 'Custom Wardrobe Project', 'image' => 'portfolio-1.jpg', 'summary' => 'Lemari custom dengan kombinasi warna kayu dan panel terang.'],
    ['title' => 'Wooden Watch Detail', 'image' => 'portfolio-2.jpg', 'summary' => 'Produk kayu kecil dengan detail finishing dan identitas brand.'],
    ['title' => 'Dekorasi Hexagonal', 'image' => 'portfolio-3.jpg', 'summary' => 'Rak dekorasi kayu untuk ruang rumah, cafe, dan display produk.'],
    ['title' => 'Furniture Kayu Fungsional', 'image' => 'portfolio-4.jpg', 'summary' => 'Karya custom yang mengutamakan fungsi, presisi, dan tampilan natural.'],
];
?>
<section class="ak-hero">
    <div class="ak-hero-overlay"></div>
    <div class="container ak-hero-content">
        <p class="ak-eyebrow">Selamat Datang di Anakkayu.id</p>
        <h1>Spesialis Mebel & Interior Kayu Berkualitas</h1>
        <p class="ak-hero-text">Kami menghadirkan desain kayu berkualitas tinggi untuk rumah, bisnis, dan kebutuhan industri. Material pilihan, pengerjaan presisi, dan tampilan yang hangat menjadi dasar setiap karya AnakKayu.</p>
        <div class="ak-hero-actions">
            <a class="ak-btn ak-btn-gold" href="<?= base_url('produk') ?>">Lihat Katalog</a>
            <a class="ak-btn ak-btn-ghost" href="<?= ak_whatsapp_link('Halo AnakKayu, saya ingin konsultasi project kayu.') ?>">Konsultasi WhatsApp</a>
        </div>
    </div>
</section>

<section class="ak-floating container">
    <?php foreach ($featureCards as $item): ?>
        <a class="ak-float-card" href="<?= esc($item['url']) ?>">
            <img src="<?= base_url('assets/anakkayu/' . $item['image']) ?>" alt="<?= esc($item['title']) ?>">
            <span><?= esc($item['title']) ?></span>
        </a>
    <?php endforeach ?>
</section>

<section class="ak-video-showcase container" aria-label="Video proses dan karya AnakKayu">
    <video autoplay muted loop playsinline preload="metadata" poster="<?= base_url('assets/anakkayu/banner.jpg') ?>">
        <source src="<?= base_url('assets/anakkayu/video2.mp4') ?>" type="video/mp4">
    </video>
    <div class="ak-video-caption">
        <p class="ak-eyebrow">Workshop / Process</p>
        <h2>Proses kayu yang hidup dalam detail.</h2>
        <a class="ak-btn ak-btn-gold" href="<?= base_url('portfolio') ?>">Lihat Karya</a>
    </div>
</section>

<section class="ak-about container">
    <div>
        <p class="ak-eyebrow dark">Tentang AnakKayu</p>
        <h2>Pengrajin kayu profesional untuk kebutuhan custom dan industri.</h2>
        <p>AnakKayu melayani pembuatan mebel custom, desain interior berbasis kayu, dekorasi kayu, hingga penyediaan kemasan kayu dan palet. Kami mengutamakan keindahan, ketahanan, dan pengerjaan yang teliti agar setiap produk memiliki nilai pakai yang panjang.</p>
        <a class="ak-link" href="<?= base_url('tentang-kami') ?>">Kenali proses kami</a>
    </div>
    <img src="<?= base_url('assets/anakkayu/about.jpg') ?>" alt="Detail brand dan material AnakKayu" loading="lazy">
</section>

<section class="ak-why">
    <div class="container">
        <p class="ak-eyebrow dark text-center">Kenapa Harus Memilih Anakkayu.id?</p>
        <div class="ak-why-grid">
            <div class="ak-benefits">
                <article><h3>Material Berkualitas</h3><p>Menggunakan kayu pilihan dengan proses pengerjaan yang teliti.</p></article>
                <article><h3>Desain Custom</h3><p>Ukuran, bentuk, dan fungsi disesuaikan dengan kebutuhan pelanggan.</p></article>
            </div>
            <img src="<?= base_url('assets/anakkayu/why-center.jpg') ?>" alt="Project furniture custom AnakKayu" loading="lazy">
            <div class="ak-benefits">
                <article><h3>Harga Kompetitif</h3><p>Kualitas tinggi dengan pilihan pengerjaan yang tetap realistis untuk budget project.</p></article>
                <article><h3>Kepercayaan Pelanggan</h3><p>Banyak pelanggan mempercayakan kebutuhan furniture dan kayu custom kepada AnakKayu.</p></article>
            </div>
        </div>
    </div>
</section>

<section class="ak-services">
    <div class="container">
        <div class="ak-services-layout">
            <div class="ak-services-intro">
                <p class="ak-eyebrow dark">Layanan</p>
                <h2>Layanan kayu untuk rumah, bisnis, dan industri.</h2>
                <p>Dari satu produk custom sampai kebutuhan project berulang, AnakKayu membantu merapikan ide, material, ukuran, dan finishing agar hasilnya fungsional sekaligus berkarakter.</p>
                <a class="ak-link" href="<?= base_url('layanan') ?>">Lihat semua layanan</a>
            </div>
            <div class="ak-services-list">
            <?php foreach ($landingServices as $index => $service): ?>
                <article class="ak-service-card">
                    <span><?= str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) ?></span>
                    <div>
                        <h3><?= esc($service['title']) ?></h3>
                        <p><?= esc($service['summary']) ?></p>
                    </div>
                </article>
            <?php endforeach ?>
            </div>
        </div>
    </div>
</section>

<section class="ak-strip" aria-label="Gallery AnakKayu">
    <?php foreach (['gallery-1.jpg', 'gallery-2.jpg', 'gallery-3.jpg', 'gallery-4.jpg'] as $i => $image): ?>
        <img src="<?= base_url('assets/anakkayu/' . $image) ?>" alt="Gallery karya AnakKayu <?= $i + 1 ?>" loading="lazy">
    <?php endforeach ?>
</section>

<section class="ak-cinematic">
    <div class="container">
        <p>Kayu custom, dekorasi, interior, dan palet industri yang dibuat dengan karakter AnakKayu.</p>
        <a class="ak-btn ak-btn-gold" href="<?= base_url('inquiry') ?>">Mulai Project</a>
    </div>
</section>

<section class="ak-portfolio container">
    <div class="ak-section-head">
        <p class="ak-eyebrow dark">Portfolio</p>
        <h2>Karya terbaru AnakKayu</h2>
        <a class="ak-link" href="<?= base_url('portfolio') ?>">Lihat semua portfolio</a>
    </div>
    <div class="row g-4">
        <?php foreach ($portfolioCards as $item): ?>
            <div class="col-md-6 col-xl-3">
                <a class="ak-card" href="<?= base_url('portfolio') ?>">
                    <img src="<?= base_url('assets/anakkayu/' . $item['image']) ?>" alt="<?= esc($item['title']) ?>" loading="lazy">
                    <h3><?= esc($item['title']) ?></h3>
                    <p><?= esc($item['summary']) ?></p>
                </a>
            </div>
        <?php endforeach ?>
    </div>
</section>

<?php if (! empty($contents)): ?>
<section class="ak-portfolio container">
    <div class="ak-section-head">
        <p class="ak-eyebrow dark">Inspirasi</p>
        <h2>Konten terbaru AnakKayu</h2>
        <a class="ak-link" href="<?= base_url('artikel') ?>">Lihat semua artikel</a>
    </div>
    <div class="row g-4">
        <?php foreach ($contents as $item): ?>
            <div class="col-md-4">
                <a class="ak-card" href="<?= base_url('artikel/' . $item['slug']) ?>">
                    <img src="<?= esc(ak_content_image($item)) ?>" alt="<?= esc($item['title']) ?>" loading="lazy" onerror="this.onerror=null;this.src='<?= esc(ak_default_content_image($item), 'attr') ?>'">
                    <h3><?= esc($item['title']) ?></h3>
                    <p><?= esc($item['summary']) ?></p>
                </a>
            </div>
        <?php endforeach ?>
    </div>
</section>
<?php endif ?>
<?= $this->endSection() ?>
