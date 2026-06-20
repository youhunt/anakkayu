<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>
<?php
$image = $item['featured_image'] ?: 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1200&q=80';
?>

<section class="ak-detail-modern ak-service-detail">
    <div class="container">
        <div class="ak-detail-grid">
            <figure class="ak-detail-media">
                <img src="<?= esc($image) ?>" alt="<?= esc($item['service_name']) ?>" loading="lazy">
                <figcaption>Layanan AnakKayu</figcaption>
            </figure>
            <article class="ak-detail-panel">
                <p class="ak-eyebrow dark">Layanan</p>
                <h1><?= esc($item['service_name']) ?></h1>
                <p class="ak-lead"><?= esc($item['summary']) ?></p>
                <div class="ak-spec ak-detail-specs">
                    <span>Estimasi: <?= esc($item['estimated_price'] ?: 'Menyesuaikan scope project') ?></span>
                    <span>Scope: Custom</span>
                    <span>Diskusi: WhatsApp / Form Inquiry</span>
                </div>
                <div class="ak-detail-actions">
                    <a class="ak-btn ak-btn-gold" href="<?= esc($wa) ?>" target="_blank" rel="noopener">Konsultasi WhatsApp</a>
                    <a class="ak-btn ak-btn-soft" href="<?= base_url('layanan') ?>">Lihat Layanan Lain</a>
                </div>
                <?= $this->include('public/partials/share') ?>
            </article>
        </div>
    </div>
</section>

<section class="ak-detail-body-section">
    <div class="container">
        <div class="ak-detail-body-card">
            <p class="ak-eyebrow dark">Ruang Lingkup</p>
            <div class="ak-body"><?= $item['description'] ?></div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
