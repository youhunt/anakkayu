<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title) ?> - Admin AnakKayu</title>
    <?= $this->include('partials/skote/head-css') ?>
    <link href="<?= base_url('assets/skote/libs/select2/css/select2.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/skote/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/skote/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?= base_url('assets/anakkayu/css/admin.css') ?>">
</head>
<body data-sidebar="dark">
<div id="layout-wrapper">
    <?= $this->include('partials/skote/topbar') ?>
    <?= $this->include('partials/skote/sidebar') ?>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <?= $this->include('partials/skote/page-title') ?>
                <?php if (session('message')): ?><div class="alert alert-success"><?= esc(session('message')) ?></div><?php endif ?>
                <?php if (session('errors')): ?><div class="alert alert-danger"><?= implode('<br>', array_map('esc', session('errors'))) ?></div><?php endif ?>
                <?= $this->renderSection('content') ?>
            </div>
        </div>
        <?= $this->include('partials/skote/footer') ?>
    </div>
</div>
<?= $this->include('partials/skote/right-sidebar') ?>
<?= $this->include('partials/skote/vendor-scripts') ?>
<?= $this->renderSection('scripts') ?>
<script src="<?= base_url('assets/skote/js/app.js') ?>"></script>
</body>
</html>
