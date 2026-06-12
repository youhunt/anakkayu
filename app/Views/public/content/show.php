<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>
<article class="ak-article container">
    <p class="ak-eyebrow dark"><?= esc(ak_date($item['published_at'] ?? $item['created_at'])) ?></p>
    <h1><?= esc($item['title']) ?></h1>
    <p class="ak-lead"><?= esc($item['summary']) ?></p>
    <?php if (! empty($item['featured_image'])): ?><img class="ak-detail-img" src="<?= esc($item['featured_image']) ?>" alt="<?= esc($item['title']) ?>"><?php endif ?>
    <?= $this->include('public/partials/share') ?>
    <div class="ak-body"><?= $item['body'] ?></div>
</article>
<?= $this->endSection() ?>
