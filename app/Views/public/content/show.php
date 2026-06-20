<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>
<article class="ak-article container">
    <p class="ak-eyebrow dark"><?= esc(ak_date($item['published_at'] ?? $item['created_at'])) ?></p>
    <h1><?= esc($item['title']) ?></h1>
    <p class="ak-lead"><?= esc($item['summary']) ?></p>
    <img class="ak-detail-img" src="<?= esc(ak_content_image($item)) ?>" alt="<?= esc($item['title']) ?>" loading="lazy" onerror="this.onerror=null;this.src='<?= esc(ak_default_content_image($item), 'attr') ?>'">
    <?= $this->include('public/partials/share') ?>
    <div class="ak-body"><?= $item['body'] ?></div>
</article>
<?= $this->endSection() ?>
