<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>
<section class="ak-detail container">
    <img src="<?= esc($item['featured_image'] ?: 'https://images.unsplash.com/photo-1600566752355-35792bedcfea?auto=format&fit=crop&w=1000&q=80') ?>" alt="<?= esc($item['title']) ?>">
    <div><p class="ak-eyebrow dark">Portfolio</p><h1><?= esc($item['title']) ?></h1><p class="ak-lead"><?= esc($item['summary']) ?></p><div class="ak-spec"><span>Client: <?= esc($item['client_name'] ?: '-') ?></span><span>Lokasi: <?= esc($item['location'] ?: '-') ?></span><span>Tanggal: <?= esc(ak_date($item['project_date'] ?? null)) ?></span></div><a class="ak-btn ak-btn-gold" href="<?= esc($wa) ?>">Buat Project Serupa</a><?= $this->include('public/partials/share') ?></div>
</section>
<section class="ak-article container"><div class="ak-body"><?= $item['description'] ?></div></section>
<?= $this->endSection() ?>
