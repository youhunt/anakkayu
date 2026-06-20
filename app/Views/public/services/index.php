<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>
<?php
$fallback = 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=900&q=80';
?>

<section class="ak-collection-hero ak-services-hero">
    <div class="container">
        <div class="ak-collection-hero-grid">
            <div>
                <p class="ak-eyebrow">Layanan AnakKayu</p>
                <h1><?= esc($title) ?></h1>
                <p>Layanan kayu untuk rumah, bisnis, cafe, retail, kantor, dan kebutuhan industri dengan hasil rapi, natural, dan tahan lama.</p>
                <div class="ak-collection-tags">
                    <span>Konsultasi</span>
                    <span>Desain</span>
                    <span>Produksi</span>
                    <span>Instalasi</span>
                </div>
            </div>
            <aside>
                <span>Alur rapi</span>
                <strong>Dari kebutuhan ruang, material, ukuran, finishing, sampai hasil akhir.</strong>
                <a href="<?= ak_whatsapp_link('Halo AnakKayu, saya ingin konsultasi layanan kayu.') ?>" target="_blank" rel="noopener">Konsultasi</a>
            </aside>
        </div>
    </div>
</section>

<section class="ak-collection-section ak-services-section">
    <div class="container">
        <div class="ak-collection-head ak-collection-head-split">
            <div>
                <p class="ak-eyebrow dark">Pilih Layanan</p>
                <h2>Layanan fleksibel sesuai kebutuhan ruang dan project.</h2>
            </div>
            <p>Kami bantu membaca fungsi, ukuran, material, dan finishing agar hasil akhirnya tetap nyaman digunakan.</p>
        </div>

        <div class="row g-4 ak-service-flow">
            <?php foreach ($items as $index => $item): ?>
                <div class="col-md-6 col-xl-4">
                    <a class="ak-list-card ak-service-list-card" href="<?= base_url('layanan/' . $item['slug']) ?>">
                        <figure>
                            <img src="<?= esc($item['featured_image'] ?: $fallback) ?>" alt="<?= esc($item['service_name']) ?>" loading="lazy">
                            <figcaption><?= str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) ?></figcaption>
                        </figure>
                        <div class="ak-list-card-body">
                            <span class="ak-card-kicker">Service</span>
                            <h3><?= esc($item['service_name']) ?></h3>
                            <p><?= esc($item['summary']) ?></p>
                            <div class="ak-card-meta"><span>Custom scope</span><span>By consultation</span></div>
                        </div>
                    </a>
                </div>
            <?php endforeach ?>
        </div>

        <div class="ak-pagination-wrap">
            <?= $pager->links() ?>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
