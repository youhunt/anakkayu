<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<section class="ak-panel"><form method="post"><?= csrf_field() ?><div class="row g-3">
<div class="col-md-8"><label class="form-label">URL Posting</label><input class="form-control" name="source_url" value="<?= old('source_url') ?>" required></div>
<div class="col-md-4"><label class="form-label">Platform</label><input class="form-control" name="platform" value="<?= old('platform') ?>" placeholder="auto detect jika kosong"></div>
<div class="col-12"><label class="form-label">Caption / data manual</label><textarea class="form-control" rows="7" name="caption"><?= old('caption') ?></textarea></div>
<div class="col-md-6"><label class="form-label">Media URL</label><input class="form-control" name="media_url" value="<?= old('media_url') ?>"></div>
<div class="col-md-6"><label class="form-label">Atribusi</label><input class="form-control" name="attribution" value="<?= old('attribution') ?>"></div>
</div><button class="btn btn-dark mt-4">Simpan Referensi</button></form></section>
<?= $this->endSection() ?>
