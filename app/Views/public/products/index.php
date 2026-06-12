<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>
<section class="ak-page-hero"><div class="container"><h1><?= esc($title) ?></h1><p>Koleksi furniture dan elemen interior kayu siap inquiry.</p></div></section>
<section class="container ak-grid-list"><div class="row g-4">
<?php foreach ($items as $item): ?>
<div class="col-md-4"><a class="ak-card" href="<?= base_url('produk/' . $item['slug']) ?>"><img src="<?= esc($item['featured_image'] ?: 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=800&q=80') ?>" alt="<?= esc($item['product_name']) ?>"><h3><?= esc($item['product_name']) ?></h3><p><?= esc($item['summary']) ?></p></a></div>
<?php endforeach ?>
</div><?= $pager->links() ?></section>
<?= $this->endSection() ?>
