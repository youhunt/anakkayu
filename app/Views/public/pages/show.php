<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>
<?php
$title = $item['title'] ?? 'Tentang AnakKayu';
$body = $item['body'] ?? '<p>AnakKayu adalah studio mebel dan interior kayu yang menggabungkan craftmanship, material natural, dan desain modern classic.</p>';
$summary = trim(strip_tags($item['summary'] ?? $item['meta_description'] ?? 'Studio mebel dan interior kayu untuk kebutuhan custom, dekorasi, renovasi, restorasi, dan project berbasis material natural.'));
if ($summary === '') {
    $summary = 'Studio mebel dan interior kayu untuk kebutuhan custom, dekorasi, renovasi, restorasi, dan project berbasis material natural.';
}
?>

<section class="ak-inner-hero">
    <div class="container">
        <p class="ak-eyebrow">AnakKayu Story</p>
        <h1><?= esc($title) ?></h1>
        <p><?= esc($summary) ?></p>
    </div>
</section>

<section class="ak-page-story">
    <div class="container">
        <div class="ak-page-story-grid">
            <article class="ak-page-body-card">
                <p class="ak-eyebrow dark">Tentang Kami</p>
                <div class="ak-body"><?= $body ?></div>
            </article>

            <aside class="ak-page-side-card">
                <img src="<?= base_url('assets/anakkayu/about.jpg') ?>" alt="AnakKayu material dan karya kayu" loading="lazy">
                <div>
                    <span>Crafted with care</span>
                    <h2>Rapi, hangat, natural, dan berkarakter.</h2>
                    <p>Setiap project dibaca dari kebutuhan ruang, fungsi, material, hingga rasa visual yang ingin dihadirkan.</p>
                </div>
            </aside>
        </div>
    </div>
</section>

<section class="ak-page-values">
    <div class="container">
        <div class="ak-page-values-head">
            <p class="ak-eyebrow dark">Nilai Pengerjaan</p>
            <h2>Desain yang enak dilihat, detail yang nyaman dipakai.</h2>
        </div>
        <div class="ak-page-values-grid">
            <article>
                <span>01</span>
                <h3>Material Natural</h3>
                <p>Kayu dan finishing dipilih agar sesuai fungsi, karakter ruang, dan penggunaan jangka panjang.</p>
            </article>
            <article>
                <span>02</span>
                <h3>Custom Presisi</h3>
                <p>Ukuran, bentuk, dan detail dibuat mengikuti kebutuhan pelanggan, bukan sekadar desain template.</p>
            </article>
            <article>
                <span>03</span>
                <h3>Rasa Modern Classic</h3>
                <p>Tampilan dibuat bersih, elegan, tenang, dan mudah menyatu dengan rumah, bisnis, maupun project industri.</p>
            </article>
        </div>
    </div>
</section>

<section class="ak-page-cta">
    <div class="container">
        <p class="ak-eyebrow">Mulai Konsultasi</p>
        <h2>Punya kebutuhan mebel, interior, dekorasi, atau project kayu custom?</h2>
        <a class="ak-btn ak-btn-gold" href="<?= ak_whatsapp_link('Halo AnakKayu, saya ingin konsultasi project kayu.') ?>" target="_blank" rel="noopener">Konsultasi WhatsApp</a>
    </div>
</section>
<?= $this->endSection() ?>
