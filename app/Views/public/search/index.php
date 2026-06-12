<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>
<section class="ak-page-hero"><div class="container"><h1>Pencarian</h1><form action="<?= base_url('search') ?>"><input name="q" value="<?= esc($q) ?>" placeholder="Cari produk, layanan, artikel"></form></div></section>
<section class="container ak-grid-list">
    <h2>Hasil untuk "<?= esc($q) ?>"</h2>
    <?php foreach (['Artikel' => $contents, 'Produk' => $products, 'Layanan' => $services] as $label => $rows): ?>
        <h3><?= esc($label) ?></h3>
        <?php foreach ($rows as $row): ?><p><?= esc($row['title'] ?? $row['product_name'] ?? $row['service_name']) ?></p><?php endforeach ?>
    <?php endforeach ?>
</section>
<?= $this->endSection() ?>
