<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>
<section class="ak-detail container">
    <img src="<?= esc($item['featured_image'] ?: 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1000&q=80') ?>" alt="<?= esc($item['service_name']) ?>">
    <div><p class="ak-eyebrow dark">Layanan</p><h1><?= esc($item['service_name']) ?></h1><p class="ak-lead"><?= esc($item['summary']) ?></p><p><?= esc($item['estimated_price'] ?: 'Estimasi menyesuaikan scope project.') ?></p><a class="ak-btn ak-btn-gold" href="<?= esc($wa) ?>">Konsultasi WhatsApp</a><?= $this->include('public/partials/share') ?></div>
</section>
<section class="ak-article container"><div class="ak-body"><?= $item['description'] ?></div></section>
<?= $this->endSection() ?>
