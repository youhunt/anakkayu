<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>
<section class="ak-page-hero"><div class="container"><h1><?= esc($item['title']) ?></h1></div></section>
<section class="ak-article container"><div class="ak-body"><?= $item['body'] ?></div></section>
<?= $this->endSection() ?>
