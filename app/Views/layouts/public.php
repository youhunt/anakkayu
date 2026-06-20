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
    <title><?= esc($meta['title']) ?></title>
    <meta name="description" content="<?= esc($meta['description']) ?>">
    <?php if (! empty($meta['keywords'])): ?><meta name="keywords" content="<?= esc($meta['keywords']) ?>"><?php endif ?>
    <link rel="canonical" href="<?= esc($meta['canonical']) ?>">
    <meta property="og:title" content="<?= esc($meta['title']) ?>">
    <meta property="og:description" content="<?= esc($meta['description']) ?>">
    <meta property="og:image" content="<?= esc($meta['image']) ?>">
    <meta property="og:url" content="<?= esc($meta['canonical']) ?>">
    <meta property="og:type" content="<?= esc($meta['type']) ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= esc($meta['title']) ?>">
    <meta name="twitter:description" content="<?= esc($meta['description']) ?>">
    <meta name="twitter:image" content="<?= esc($meta['image']) ?>">
    <link rel="icon" href="<?= $assetUrl('favicon.ico') ?>" sizes="any">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $assetUrl('assets/anakkayu/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $assetUrl('assets/anakkayu/favicon-16x16.png') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $assetUrl('assets/anakkayu/apple-touch-icon.png') ?>">
    <link rel="manifest" href="<?= $assetUrl('site.webmanifest') ?>">
    <meta name="theme-color" content="#222126">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $assetUrl('assets/anakkayu/css/site.css') ?>">
    <link rel="stylesheet" href="<?= $assetUrl('assets/anakkayu/css/polish.css') ?>">
    <link rel="stylesheet" href="<?= $assetUrl('assets/anakkayu/css/hero-menu-fix.css') ?>">
    <link rel="stylesheet" href="<?= $assetUrl('assets/anakkayu/css/page-polish.css') ?>">
    <link rel="stylesheet" href="<?= $assetUrl('assets/anakkayu/css/collection-polish.css') ?>">
    <link rel="stylesheet" href="<?= $assetUrl('assets/anakkayu/css/collection-production-fix.css') ?>">
    <?= $this->renderSection('head') ?>
</head>
<body>
<?= $this->include('public/partials/header') ?>
<main>
    <?= $this->renderSection('content') ?>
</main>
<?= $this->include('public/partials/footer') ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= $assetUrl('assets/anakkayu/js/site.js') ?>"></script>
</body>
</html>
