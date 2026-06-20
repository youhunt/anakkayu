<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>
<section class="ak-page-hero"><div class="container"><h1><?= esc($title) ?></h1><p>Insight material, inspirasi ruang, dan cerita proses AnakKayu.</p></div></section>
<section class="container ak-grid-list">
    <div class="row g-4">
        <?php foreach ($items as $item): ?>
            <div class="col-md-4"><a class="ak-card" href="<?= base_url('artikel/' . $item['slug']) ?>"><img src="<?= esc(ak_content_image($item)) ?>" alt="<?= esc($item['title']) ?>" loading="lazy" onerror="this.onerror=null;this.src='<?= esc(ak_default_content_image($item), 'attr') ?>'"><h3><?= esc($item['title']) ?></h3><p><?= esc($item['summary']) ?></p></a></div>
        <?php endforeach ?>
    </div>
    <?= $pager->links() ?>
</section>
<?= $this->endSection() ?>
