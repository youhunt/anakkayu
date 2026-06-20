<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>

<section class="ak-collection-hero ak-article-hero">
    <div class="container">
        <div class="ak-collection-hero-grid">
            <div>
                <p class="ak-eyebrow">Jurnal AnakKayu</p>
                <h1><?= esc($title) ?></h1>
                <p>Insight material, inspirasi ruang, cerita proses, dan panduan memilih karya kayu yang sesuai kebutuhan.</p>
                <div class="ak-collection-tags">
                    <span>Material</span>
                    <span>Inspirasi ruang</span>
                    <span>Proses kerja</span>
                </div>
            </div>
            <aside>
                <span>Editorial</span>
                <strong>Catatan singkat untuk membantu memahami material, fungsi ruang, dan keputusan desain.</strong>
                <a href="<?= base_url('kontak') ?>">Kirim pertanyaan</a>
            </aside>
        </div>
    </div>
</section>

<section class="ak-collection-section ak-article-section">
    <div class="container">
        <div class="ak-collection-head ak-collection-head-split">
            <div>
                <p class="ak-eyebrow dark">Bacaan Terbaru</p>
                <h2>Catatan material dan inspirasi ruang dari AnakKayu.</h2>
            </div>
            <p>Pilih inspirasi yang paling dekat dengan kebutuhan rumah, bisnis, atau project custom Anda.</p>
        </div>

        <div class="row g-4 ak-article-flow">
            <?php foreach ($items as $index => $item): ?>
                <div class="col-md-6 <?= $index === 0 ? 'col-xl-6' : 'col-xl-3' ?>">
                    <a class="ak-list-card ak-article-list-card <?= $index === 0 ? 'is-featured' : '' ?>" href="<?= base_url('artikel/' . $item['slug']) ?>">
                        <figure>
                            <img src="<?= esc(ak_content_image($item)) ?>" alt="<?= esc($item['title']) ?>" loading="lazy" onerror="this.onerror=null;this.src='<?= esc(ak_default_content_image($item), 'attr') ?>'">
                            <figcaption><?= esc(ak_date($item['published_at'] ?? $item['created_at'] ?? null)) ?></figcaption>
                        </figure>
                        <div class="ak-list-card-body">
                            <span class="ak-card-kicker">Journal</span>
                            <h3><?= esc($item['title']) ?></h3>
                            <p><?= esc($item['summary']) ?></p>
                            <div class="ak-card-meta"><span>Baca artikel</span></div>
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
