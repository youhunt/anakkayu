<!doctype html>
<html lang="id">
<head>
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&family=Newsreader:opsz,wght@6..72,400;6..72,500;6..72,600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/anakkayu/css/site.css') ?>?v=20260620">
    <link rel="stylesheet" href="<?= base_url('assets/anakkayu/css/polish.css') ?>?v=20260620b">
    <?= $this->renderSection('head') ?>
</head>
<body>
<?= $this->include('public/partials/header') ?>
<main>
    <?= $this->renderSection('content') ?>
</main>
<?= $this->include('public/partials/footer') ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/anakkayu/js/site.js') ?>?v=20260620"></script>
</body>
</html>
