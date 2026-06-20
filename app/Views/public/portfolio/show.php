<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>
<?php
$image = $item['featured_image'] ?: 'https://images.unsplash.com/photo-1600566752355-35792bedcfea?auto=format&fit=crop&w=1200&q=80';
?>

<section class="ak-detail-modern ak-portfolio-detail">
    <div class="container">
        <div class="ak-detail-grid">
            <figure class="ak-detail-media">
                <img src="<?= esc($image) ?>" alt="<?= esc($item['title']) ?>" loading="lazy">
                <figcaption>Portfolio AnakKayu</figcaption>
            </figure>
            <article class="ak-detail-panel">
                <p class="ak-eyebrow dark">Portfolio</p>
                <h1><?= esc($item['title']) ?></h1>
                <p class="ak-lead"><?= esc($item['summary']) ?></p>
                <div class="ak-spec ak-detail-specs">
                    <span>Client: <?= esc($item['client_name'] ?: '-') ?></span>
                    <span>Lokasi: <?= esc($item['location'] ?: '-') ?></span>
                    <span>Tanggal: <?= esc(ak_date($item['project_date'] ?? null)) ?></span>
                </div>
                <div class="ak-detail-actions">
                    <a class="ak-btn ak-btn-gold" href="<?= esc($wa) ?>" target="_blank" rel="noopener">Buat Project Serupa</a>
                    <a class="ak-btn ak-btn-soft" href="<?= base_url('portfolio') ?>">Lihat Portfolio Lain</a>
                </div>
                <?= $this->include('public/partials/share') ?>
            </article>
        </div>
    </div>
</section>

<section class="ak-detail-body-section">
    <div class="container">
        <div class="ak-detail-body-card">
            <p class="ak-eyebrow dark">Cerita Project</p>
            <div class="ak-body"><?= $item['description'] ?></div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
