<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>
<?php
$image = $item['featured_image'] ?: 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=1200&q=80';
?>

<section class="ak-detail-modern ak-product-detail">
    <div class="container">
        <div class="ak-detail-grid">
            <figure class="ak-detail-media">
                <img src="<?= esc($image) ?>" alt="<?= esc($item['product_name']) ?>" loading="lazy">
                <figcaption>Produk AnakKayu</figcaption>
            </figure>
            <article class="ak-detail-panel">
                <p class="ak-eyebrow dark">Produk</p>
                <h1><?= esc($item['product_name']) ?></h1>
                <p class="ak-lead"><?= esc($item['summary']) ?></p>
                <div class="ak-spec ak-detail-specs">
                    <span>Material: <?= esc($item['material'] ?: '-') ?></span>
                    <span>Ukuran: <?= esc($item['size'] ?: '-') ?></span>
                    <span>Finishing: <?= esc($item['finishing'] ?: '-') ?></span>
                </div>
                <div class="ak-detail-actions">
                    <a class="ak-btn ak-btn-gold" href="<?= esc($wa) ?>" target="_blank" rel="noopener">Inquiry WhatsApp</a>
                    <a class="ak-btn ak-btn-soft" href="<?= base_url('produk') ?>">Lihat Produk Lain</a>
                </div>
                <?= $this->include('public/partials/share') ?>
            </article>
        </div>
    </div>
</section>

<section class="ak-detail-body-section">
    <div class="container">
        <div class="ak-detail-body-card">
            <p class="ak-eyebrow dark">Detail Produk</p>
            <div class="ak-body"><?= $item['description'] ?></div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
