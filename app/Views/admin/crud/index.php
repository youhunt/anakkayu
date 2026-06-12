<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="ak-admin-heading"><h1><?= esc($title) ?></h1><a class="btn btn-dark" href="<?= base_url('admin/' . $config['route'] . '/new') ?>">Tambah</a></div>
<section class="ak-panel">
    <table id="cmsTable" class="table table-striped table-bordered dt-responsive nowrap align-middle w-100">
        <thead><tr><th>Nama</th><th>Status</th><th>Views</th><th>Share</th><th>Dibuat</th><th class="text-end">Aksi</th></tr></thead>
        <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><strong><?= esc($item[$config['name']] ?? $item['name'] ?? '-') ?></strong><br><small><?= esc($item['slug'] ?? '') ?></small></td>
                <td><?= esc($item['status'] ?? $item['type'] ?? '-') ?></td>
                <td><?= number_format((int) ($item['view_count'] ?? 0)) ?></td>
                <td><?= number_format((int) ($item['share_count'] ?? 0)) ?></td>
                <td><?= esc(ak_date($item['created_at'] ?? null)) ?></td>
                <td class="text-end">
                    <a class="btn btn-sm btn-outline-dark" href="<?= base_url('admin/' . $config['route'] . '/' . $item['id'] . '/edit') ?>">Edit</a>
                    <form class="d-inline" method="post" action="<?= base_url('admin/' . $config['route'] . '/' . $item['id'] . '/delete') ?>"><?= csrf_field() ?><button class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus data ini?')">Hapus</button></form>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
    <?= $pager->links() ?>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/skote/libs/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/skote/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/skote/libs/datatables.net-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script>
    if (window.jQuery && jQuery.fn.DataTable) {
        jQuery('#cmsTable').DataTable({
            paging: false,
            info: false,
            order: [],
            language: { search: 'Cari:' }
        });
    }
</script>
<?= $this->endSection() ?>
