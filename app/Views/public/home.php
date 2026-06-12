<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>
<section class="ak-hero">
    <div class="ak-hero-overlay"></div>
    <div class="container ak-hero-content">
        <p class="ak-eyebrow">Anakkayu.id / modern classic wood specialist</p>
        <h1>Spesialis Mebel & Interior Kayu Berkualitas</h1>
        <p class="ak-hero-text">AnakKayu merancang dan memproduksi furniture, interior kayu, dekorasi, dan project custom dengan sentuhan modern classic yang rapi, hangat, dan premium.</p>
        <div class="ak-hero-actions">
            <a class="ak-btn ak-btn-gold" href="<?= base_url('produk') ?>">Lihat Katalog</a>
            <a class="ak-btn ak-btn-ghost" href="<?= ak_whatsapp_link('Halo AnakKayu, saya ingin konsultasi project kayu.') ?>">Konsultasi WhatsApp</a>
        </div>
    </div>
</section>

<section class="ak-floating container">
    <?php foreach (array_slice($portfolio, 0, 3) as $item): ?>
        <a class="ak-float-card" href="<?= base_url('portfolio/' . $item['slug']) ?>">
            <img src="<?= esc($item['featured_image'] ?: 'https://images.unsplash.com/photo-1618220179428-22790b461013?auto=format&fit=crop&w=900&q=80') ?>" alt="<?= esc($item['title']) ?>">
            <span><?= esc($item['title']) ?></span>
        </a>
    <?php endforeach ?>
    <?php if ($portfolio === []): ?>
        <?php foreach (['Custom Cabinet', 'Kitchen Set Kayu', 'Interior Hangat'] as $label): ?>
            <div class="ak-float-card"><img src="https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=900&q=80" alt="<?= esc($label) ?>"><span><?= esc($label) ?></span></div>
        <?php endforeach ?>
    <?php endif ?>
</section>

<section class="ak-about container">
    <div>
        <p class="ak-eyebrow dark">Tentang AnakKayu</p>
        <h2>Ruang yang terasa natural, tertata, dan dibuat untuk bertahan lama.</h2>
        <p>Kami membantu pemilik rumah, cafe, kantor, dan brand retail menghadirkan elemen kayu yang fungsional sekaligus berkarakter. Dari konsultasi, desain, produksi, finishing, sampai instalasi, setiap tahap dibuat transparan dan terukur.</p>
        <a class="ak-link" href="<?= base_url('tentang-kami') ?>">Kenali proses kami</a>
    </div>
    <img src="https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1200&q=80" alt="Interior kayu premium" loading="lazy">
</section>

<section class="ak-why">
    <div class="container">
        <p class="ak-eyebrow dark text-center">Kenapa Harus Memilih Anakkayu.id?</p>
        <div class="ak-why-grid">
            <div class="ak-benefits">
                <article><h3>Material Terpilih</h3><p>Kayu, finishing, dan hardware dipilih sesuai fungsi ruang dan durabilitas.</p></article>
                <article><h3>Custom Presisi</h3><p>Ukuran, gaya, dan detail mengikuti kebutuhan project, bukan template massal.</p></article>
            </div>
            <img src="https://images.unsplash.com/photo-1600210491892-03d54c0aaf87?auto=format&fit=crop&w=900&q=80" alt="Workshop dan interior kayu" loading="lazy">
            <div class="ak-benefits">
                <article><h3>Visual Premium</h3><p>Komposisi modern classic dengan aksen natural yang mudah dipadukan.</p></article>
                <article><h3>Inquiry Mudah</h3><p>Setiap produk dan layanan punya CTA WhatsApp serta form penawaran.</p></article>
            </div>
        </div>
    </div>
</section>

<section class="ak-services">
    <div class="container">
        <div class="ak-section-head">
            <p class="ak-eyebrow dark">Layanan</p>
            <h2>Dari ide ruang sampai instalasi akhir.</h2>
        </div>
        <div class="row g-4">
            <?php foreach ($services ?: [
                ['service_name' => 'Furniture Custom', 'summary' => 'Meja, kabinet, rak, dan furniture built-in.'],
                ['service_name' => 'Interior Kayu', 'summary' => 'Panel, backdrop, partisi, dan aksen ruang.'],
                ['service_name' => 'Restorasi', 'summary' => 'Perbaikan dan refinishing furniture lama.'],
            ] as $service): ?>
                <div class="col-md-4"><article class="ak-service-card"><span>+</span><h3><?= esc($service['service_name']) ?></h3><p><?= esc($service['summary']) ?></p></article></div>
            <?php endforeach ?>
        </div>
    </div>
</section>

<section class="ak-strip" aria-label="Gallery AnakKayu">
    <?php foreach (range(1, 5) as $i): ?>
        <img src="https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=700&q=80&sig=<?= $i ?>" alt="Gallery interior kayu <?= $i ?>" loading="lazy">
    <?php endforeach ?>
</section>

<section class="ak-cinematic">
    <div class="container">
        <p>Material natural. Garis desain tenang. Detail yang terasa dekat.</p>
        <a class="ak-btn ak-btn-gold" href="<?= base_url('inquiry') ?>">Mulai Project</a>
    </div>
</section>

<section class="ak-portfolio container">
    <div class="ak-section-head">
        <p class="ak-eyebrow dark">Portfolio</p>
        <h2>Karya terbaru AnakKayu</h2>
        <a class="ak-link" href="<?= base_url('portfolio') ?>">Lihat semua portfolio</a>
    </div>
    <div class="row g-4">
        <?php foreach ($portfolio ?: [] as $item): ?>
            <div class="col-md-4">
                <a class="ak-card" href="<?= base_url('portfolio/' . $item['slug']) ?>">
                    <img src="<?= esc($item['featured_image']) ?>" alt="<?= esc($item['title']) ?>" loading="lazy">
                    <h3><?= esc($item['title']) ?></h3>
                    <p><?= esc($item['summary']) ?></p>
                </a>
            </div>
        <?php endforeach ?>
    </div>
</section>

<?php if (! empty($contents)): ?>
<section class="ak-portfolio container">
    <div class="ak-section-head">
        <p class="ak-eyebrow dark">Inspirasi</p>
        <h2>Konten terbaru AnakKayu</h2>
        <a class="ak-link" href="<?= base_url('artikel') ?>">Lihat semua artikel</a>
    </div>
    <div class="row g-4">
        <?php foreach ($contents as $item): ?>
            <div class="col-md-4">
                <a class="ak-card" href="<?= base_url('artikel/' . $item['slug']) ?>">
                    <img src="<?= esc($item['featured_image'] ?: 'https://images.unsplash.com/photo-1600566752355-35792bedcfea?auto=format&fit=crop&w=800&q=80') ?>" alt="<?= esc($item['title']) ?>" loading="lazy">
                    <h3><?= esc($item['title']) ?></h3>
                    <p><?= esc($item['summary']) ?></p>
                </a>
            </div>
        <?php endforeach ?>
    </div>
</section>
<?php endif ?>
<?= $this->endSection() ?>
