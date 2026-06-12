<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<section class="ak-panel">
<?php foreach ($items as $item): ?>
    <form method="post" action="<?= base_url('admin/inquiries/' . $item['id']) ?>" class="ak-inquiry-row">
        <?= csrf_field() ?>
        <div><strong><?= esc($item['name']) ?></strong><p><?= esc($item['subject']) ?><br><?= esc($item['message']) ?></p><small><?= esc($item['email']) ?> <?= esc($item['phone']) ?></small></div>
        <select name="status"><?php foreach (['new','contacted','in_progress','quoted','closed','rejected'] as $s): ?><option value="<?= $s ?>" <?= $item['status'] === $s ? 'selected' : '' ?>><?= $s ?></option><?php endforeach ?></select>
        <textarea name="admin_notes" placeholder="Catatan follow-up"><?= esc($item['admin_notes']) ?></textarea>
        <button class="btn btn-dark">Update</button>
    </form>
<?php endforeach ?>
<?= $pager->links() ?>
</section>
<?= $this->endSection() ?>
