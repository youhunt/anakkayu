<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>
<?php
$fallback = 'https://images.unsplash.com/photo-1600566752355-35792bedcfea?auto=format&fit=crop&w=900&q=80';
?>

<section class="ak-collection-hero ak-portfolio-hero">
    <div class="container">
        <div class="ak-collection-hero-grid">
            <div>
                <p class="ak-eyebrow">Portfolio</p>
                <h1><?= esc($title) ?></h1>
                <p>Dokumentasi karya AnakKayu: furniture, interior, dekorasi, restorasi, dan project custom dengan karakter natural.</p>
                <div class="ak-collection-tags">
                    <span>Residential</span>
                    <span>Business</span>
                    <span>Custom Project</span>
                </div>
            </div>
            <aside>
                <span>Project story</span>
                <strong>Setiap karya punya konteks ruang, fungsi, dan rasa visual yang berbeda.</strong>
                <a href="<?= ak_whatsapp_link('Halo AnakKayu, saya ingin membuat project seperti portfolio AnakKayu.') ?>" target="_blank" rel="noopener">Buat project</a>
            </aside>
        </div>
    </div>
</section>

<section class="ak-collection-section ak-portfolio-section">
    <div class="container">
        <div class="ak-collection-head">
            <p class="ak-eyebrow dark">Karya Pilihan</p>
            <h2>Karya terpilih untuk melihat karakter material, ruang, dan detail pengerjaan.</h2>
        </div>

        <div class="row g-4 ak-portfolio-flow">
            <?php foreach ($items as $index => $item): ?>
                <div class="col-md-6 <?= $index === 0 ? 'col-xl-8' : 'col-xl-4' ?>">
                    <a class="ak-list-card ak-portfolio-list-card <?= $index === 0 ? 'is-wide' : '' ?>" href="<?= base_url('portfolio/' . $item['slug']) ?>">
                        <figure>
                            <img src="<?= esc($item['featured_image'] ?: $fallback) ?>" alt="<?= esc($item['title']) ?>" loading="lazy">
                            <figcaption>Project <?= str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) ?></figcaption>
                        </figure>
                        <div class="ak-list-card-body">
                            <span class="ak-card-kicker">Portfolio</span>
                            <h3><?= esc($item['title']) ?></h3>
                            <p><?= esc($item['summary']) ?></p>
                            <div class="ak-card-meta">
                                <?php if (! empty($item['location'])): ?><span><?= esc($item['location']) ?></span><?php endif ?>
                                <?php if (! empty($item['project_date'])): ?><span><?= esc(ak_date($item['project_date'])) ?></span><?php endif ?>
                                <span>View story</span>
                            </div>
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
