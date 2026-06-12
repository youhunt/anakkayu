<?php
$items = [
    ['Dashboard', 'admin/dashboard', 'bx bx-home-circle', 'dashboard.view'],
    ['Konten', 'admin/contents', 'bx bx-news', 'content.view'],
    ['Halaman', 'admin/pages', 'bx bx-file', 'page.view'],
    ['Produk', 'admin/products', 'bx bx-cube', 'product.view'],
    ['Layanan', 'admin/services', 'bx bx-briefcase-alt-2', 'service.view'],
    ['Portfolio', 'admin/portfolio', 'bx bx-images', 'portfolio.view'],
    ['Kategori', 'admin/categories', 'bx bx-category', 'category.view'],
    ['Tag', 'admin/tags', 'bx bx-purchase-tag', 'category.view'],
    ['Inquiry', 'admin/inquiries', 'bx bx-message-square-dots', 'inquiry.view'],
    ['Social Content', 'admin/social-content', 'bx bx-share-alt', 'social.review'],
    ['Settings', 'admin/settings', 'bx bx-cog', 'setting.view'],
];
?>
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu AnakKayu</li>
                <?php foreach ($items as [$label, $url, $icon, $permission]): ?>
                    <?php if (auth()->user()?->can($permission) || auth()->user()?->inGroup('superadmin')): ?>
                        <li>
                            <a href="<?= base_url($url) ?>" class="waves-effect">
                                <i class="<?= esc($icon) ?>"></i>
                                <span><?= esc($label) ?></span>
                            </a>
                        </li>
                    <?php endif ?>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</div>
