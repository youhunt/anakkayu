<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<section class="ak-panel text-center">
    <h1><?= esc($heading ?? 'Terjadi Kesalahan') ?></h1>
    <p class="text-muted"><?= esc($message ?? 'Halaman admin tidak dapat diproses.') ?></p>
    <a class="btn btn-dark" href="<?= base_url('admin') ?>">Kembali ke Dashboard</a>
</section>
<?= $this->endSection() ?>
