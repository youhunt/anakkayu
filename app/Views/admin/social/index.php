<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="ak-admin-heading"><h1>Social Content</h1><a class="btn btn-dark" href="<?= base_url('admin/social-content/import') ?>">Import URL</a></div>
<section class="ak-panel"><table class="table align-middle"><thead><tr><th>Platform</th><th>Preview</th><th>URL</th><th>Status</th><th></th></tr></thead><tbody>
<?php foreach ($items as $item): ?><tr>
    <td><?= esc($item['platform']) ?></td>
    <td>
        <?php if (! empty($item['media_url'])): ?>
            <img src="<?= esc($item['media_url']) ?>" alt="Social media preview" style="width:90px;height:64px;object-fit:cover;border-radius:6px">
        <?php else: ?>
            <span class="text-muted">Belum ada gambar</span>
        <?php endif ?>
    </td>
    <td><a href="<?= esc($item['source_url']) ?>" target="_blank" rel="noopener"><?= esc($item['source_url']) ?></a></td>
    <td><?= esc($item['status']) ?></td>
    <td class="text-nowrap">
        <form class="d-inline" method="post" action="<?= base_url('admin/social-content/' . $item['id'] . '/refresh') ?>">
            <?= csrf_field() ?>
            <button class="btn btn-sm btn-outline-secondary">Ambil Gambar</button>
        </form>
        <form class="d-inline" method="post" action="<?= base_url('admin/social-content/' . $item['id'] . '/draft') ?>">
            <?= csrf_field() ?>
            <button class="btn btn-sm btn-outline-dark">Generate Draft</button>
        </form>
    </td>
</tr><?php endforeach ?>
</tbody></table><?= $pager->links() ?></section>
<section class="ak-panel mt-4">
    <h2>Draft Generated</h2>
    <?php foreach ($drafts as $draft): ?>
        <div class="d-flex justify-content-between gap-3 border-bottom py-3">
            <div>
                <strong><?= esc($draft['draft_title']) ?></strong>
                <br><?= esc($draft['draft_summary']) ?>
                <br><span class="badge bg-light text-dark mt-2"><?= esc($draft['status']) ?></span>
            </div>
            <div class="text-nowrap">
                <?php if (! empty($draft['content_id'])): ?>
                    <a class="btn btn-sm btn-outline-dark" href="<?= base_url('admin/contents/' . $draft['content_id'] . '/edit') ?>">Edit Artikel</a>
                <?php else: ?>
                    <form method="post" action="<?= base_url('admin/social-content/generated/' . $draft['id'] . '/content') ?>">
                        <?= csrf_field() ?>
                        <button class="btn btn-sm btn-dark">Jadikan Draft Artikel</button>
                    </form>
                <?php endif ?>
            </div>
        </div>
    <?php endforeach ?>
</section>
<?= $this->endSection() ?>
