<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="ak-admin-grid">
    <?php foreach ($stats as $label => $value): ?>
        <article class="ak-stat"><span><?= esc(str_replace('_', ' ', $label)) ?></span><strong><?= number_format($value) ?></strong></article>
    <?php endforeach ?>
</div>
<div class="row g-4 mt-1">
    <div class="col-lg-6"><section class="ak-panel"><h2>Inquiry Terbaru</h2><?php foreach ($latestInquiries as $row): ?><p><strong><?= esc($row['name']) ?></strong><br><?= esc($row['subject']) ?></p><?php endforeach ?></section></div>
    <div class="col-lg-6"><section class="ak-panel"><h2>Social Import Terbaru</h2><?php foreach ($latestSocial as $row): ?><p><strong><?= esc($row['platform']) ?></strong><br><?= esc($row['source_url']) ?></p><?php endforeach ?></section></div>
</div>
<?= $this->endSection() ?>
