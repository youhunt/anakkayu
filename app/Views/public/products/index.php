<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>
<?php
$fallback = 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=900&q=80';
?>

<section class="ak-collection-hero ak-products-hero">
    <div class="container">
        <div class="ak-collection-hero-grid">
            <div>
                <p class="ak-eyebrow">Katalog Produk</p>
                <h1><?= esc($title) ?></h1>
                <p>Furniture dan elemen interior kayu untuk rumah, bisnis, dan kebutuhan ruang yang ingin tampil hangat, rapi, dan berkarakter.</p>
                <div class="ak-collection-tags">
                    <span>Furniture custom</span>
                    <span>Interior kayu</span>
                    <span>By inquiry</span>
                </div>
            </div>
            <aside>
                <span>Produk AnakKayu</span>
                <strong>Material natural, bentuk bersih, dan detail yang nyaman digunakan.</strong>
                <a href="<?= ak_whatsapp_link('Halo AnakKayu, saya ingin tanya katalog produk.') ?>" target="_blank" rel="noopener">Tanya katalog</a>
            </aside>
        </div>
    </div>
</section>

<section class="ak-collection-section ak-products-section">
    <div class="container">
        <div class="ak-collection-head">
            <p class="ak-eyebrow dark">Pilihan Produk</p>
            <h2>Produk pilihan untuk ruang yang lebih hangat dan fungsional.</h2>
        </div>

        <div class="row g-4 ak-masonry-soft">
            <?php foreach ($items as $index => $item): ?>
                <div class="col-md-6 col-xl-4">
                    <a class="ak-list-card ak-product-list-card" href="<?= base_url('produk/' . $item['slug']) ?>">
                        <figure>
                            <img src="<?= esc($item['featured_image'] ?: $fallback) ?>" alt="<?= esc($item['product_name']) ?>" loading="lazy">
                            <figcaption>Produk <?= str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) ?></figcaption>
                        </figure>
                        <div class="ak-list-card-body">
                            <span class="ak-card-kicker">AnakKayu Product</span>
                            <h3><?= esc($item['product_name']) ?></h3>
                            <p><?= esc($item['summary']) ?></p>
                            <div class="ak-card-meta">
                                <?php if (! empty($item['material'])): ?><span><?= esc($item['material']) ?></span><?php endif ?>
                                <?php if (! empty($item['finishing'])): ?><span><?= esc($item['finishing']) ?></span><?php endif ?>
                                <span>Inquiry</span>
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
