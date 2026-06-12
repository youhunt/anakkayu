<?php
$items = [
    ['Dashboard', 'admin/dashboard', 'dashboard.view'],
    ['Konten', 'admin/contents', 'content.view'],
    ['Halaman', 'admin/pages', 'page.view'],
    ['Produk', 'admin/products', 'product.view'],
    ['Layanan', 'admin/services', 'service.view'],
    ['Portfolio', 'admin/portfolio', 'portfolio.view'],
    ['Kategori', 'admin/categories', 'category.view'],
    ['Tag', 'admin/tags', 'category.view'],
    ['Inquiry', 'admin/inquiries', 'inquiry.view'],
    ['Social Content', 'admin/social-content', 'social.review'],
    ['Settings', 'admin/settings', 'setting.view'],
];
?>
<nav class="ak-admin-nav">
    <?php foreach ($items as [$label, $url, $permission]): ?>
        <?php if (! function_exists('auth') || auth()->user()?->can($permission) || auth()->user()?->inGroup('superadmin')): ?>
            <a href="<?= base_url($url) ?>"><?= esc($label) ?></a>
        <?php endif ?>
    <?php endforeach ?>
</nav>
