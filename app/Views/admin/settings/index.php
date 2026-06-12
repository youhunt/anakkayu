<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<section class="ak-panel"><form method="post"><?= csrf_field() ?><div class="row g-3">
<?php foreach (['site_name','site_description','contact_email','whatsapp_number','address','instagram_url','facebook_url','default_meta_title','default_meta_description','hero_title','hero_subtitle'] as $key): ?>
<div class="col-md-6"><label class="form-label"><?= esc($key) ?></label><input class="form-control" name="settings[<?= esc($key) ?>]" value="<?= esc($settings[$key] ?? '') ?>"></div>
<?php endforeach ?>
</div><button class="btn btn-dark mt-4">Simpan Settings</button></form></section>
<?= $this->endSection() ?>
