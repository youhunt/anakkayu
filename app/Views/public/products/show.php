<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>
<section class="ak-detail container">
    <img src="<?= esc($item['featured_image'] ?: 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=1000&q=80') ?>" alt="<?= esc($item['product_name']) ?>">
    <div><p class="ak-eyebrow dark">Produk</p><h1><?= esc($item['product_name']) ?></h1><p class="ak-lead"><?= esc($item['summary']) ?></p><div class="ak-spec"><span>Material: <?= esc($item['material'] ?: '-') ?></span><span>Ukuran: <?= esc($item['size'] ?: '-') ?></span><span>Finishing: <?= esc($item['finishing'] ?: '-') ?></span></div><a class="ak-btn ak-btn-gold" href="<?= esc($wa) ?>">Inquiry WhatsApp</a><?= $this->include('public/partials/share') ?></div>
</section>
<section class="ak-article container"><div class="ak-body"><?= $item['description'] ?></div></section>
<?= $this->endSection() ?>
