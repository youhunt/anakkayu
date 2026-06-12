<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="ak-admin-heading"><h1>Social Content</h1><a class="btn btn-dark" href="<?= base_url('admin/social-content/import') ?>">Import URL</a></div>
<section class="ak-panel"><table class="table"><thead><tr><th>Platform</th><th>URL</th><th>Status</th><th></th></tr></thead><tbody>
<?php foreach ($items as $item): ?><tr><td><?= esc($item['platform']) ?></td><td><a href="<?= esc($item['source_url']) ?>" target="_blank"><?= esc($item['source_url']) ?></a></td><td><?= esc($item['status']) ?></td><td><form method="post" action="<?= base_url('admin/social-content/' . $item['id'] . '/draft') ?>"><?= csrf_field() ?><button class="btn btn-sm btn-outline-dark">Generate Draft</button></form></td></tr><?php endforeach ?>
</tbody></table><?= $pager->links() ?></section>
<section class="ak-panel mt-4"><h2>Draft Generated</h2><?php foreach ($drafts as $draft): ?><p><strong><?= esc($draft['draft_title']) ?></strong><br><?= esc($draft['draft_summary']) ?></p><?php endforeach ?></section>
<?= $this->endSection() ?>
