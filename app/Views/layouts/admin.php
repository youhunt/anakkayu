<!doctype html>
<html lang="id">

<head>
    <?php
    $assetUrl = static function (string $path): string {
        $fullPath = FCPATH . str_replace('/', DIRECTORY_SEPARATOR, $path);
        $version = is_file($fullPath) ? '?v=' . filemtime($fullPath) : '';

        return base_url($path) . $version;
    };
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title) ?> - Admin AnakKayu</title>
    <link rel="icon" href="<?= $assetUrl('favicon.ico') ?>" sizes="any">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $assetUrl('assets/anakkayu/favicon-32x32.png') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $assetUrl('assets/anakkayu/apple-touch-icon.png') ?>">
    <?= $this->include('partials/skote/head-css') ?>
    <link href="<?= base_url('assets/libs/select2/css/select2.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />
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
    <script src="<?= base_url('assets/js/app.js') ?>"></script>
</body>

</html>
