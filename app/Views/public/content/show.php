<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>

<article class="ak-article-modern">
    <header class="ak-article-modern-hero">
        <div class="container">
            <p class="ak-eyebrow"><?= esc(ak_date($item['published_at'] ?? $item['created_at'])) ?></p>
            <h1><?= esc($item['title']) ?></h1>
            <p><?= esc($item['summary']) ?></p>
        </div>
    </header>

    <div class="container">
        <figure class="ak-article-cover">
            <img src="<?= esc(ak_content_image($item)) ?>" alt="<?= esc($item['title']) ?>" loading="lazy" onerror="this.onerror=null;this.src='<?= esc(ak_default_content_image($item), 'attr') ?>'">
        </figure>

        <div class="ak-article-layout">
            <aside class="ak-article-side">
                <span>Bagikan</span>
                <?= $this->include('public/partials/share') ?>
            </aside>
            <div class="ak-article-body ak-body">
                <?= $item['body'] ?>
            </div>
        </div>
    </div>
</article>
<?= $this->endSection() ?>
