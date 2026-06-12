<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Auth') ?> - AnakKayu Admin</title>
    <?= $this->include('partials/skote/head-css') ?>
    <link rel="stylesheet" href="<?= base_url('assets/anakkayu/css/admin.css') ?>">
</head>
<body class="auth-body-bg">
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="card shadow border-0" style="max-width: 460px; width: 100%;">
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <h1 class="h3 mb-1">AnakKayu</h1>
                    <p class="text-muted mb-0">Admin CMS</p>
                </div>
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>
    <?= $this->include('partials/skote/vendor-scripts') ?>
</body>
</html>
