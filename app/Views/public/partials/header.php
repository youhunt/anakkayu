<header class="ak-header">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="ak-brand" href="<?= base_url() ?>" aria-label="AnakKayu Home">
                <span class="ak-brand-mark">AK</span>
                <span class="ak-brand-text">
                    <span class="ak-brand-title"><?= esc(ak_setting('site_name', 'AnakKayu')) ?></span>
                    <span class="ak-brand-subtitle">Interior Woodcraft</span>
                </span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#akNav" aria-controls="akNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="akNav" class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav align-items-lg-center gap-lg-4">
                    <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('produk') ?>">Produk</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('layanan') ?>">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('portfolio') ?>">Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('artikel') ?>">Artikel</a></li>
                    <li class="nav-item"><a class="nav-link ak-nav-cta" href="<?= base_url('kontak') ?>">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
