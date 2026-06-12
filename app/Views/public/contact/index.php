<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>
<section class="ak-page-hero"><div class="container"><h1>Kontak & Inquiry</h1><p>Ceritakan kebutuhan furniture, interior, atau project custom Anda.</p></div></section>
<section class="container ak-contact">
    <?php if (session('message')): ?><div class="alert alert-success"><?= esc(session('message')) ?></div><?php endif ?>
    <?php if (session('errors')): ?><div class="alert alert-danger"><?= implode('<br>', array_map('esc', session('errors'))) ?></div><?php endif ?>
    <form method="post" action="<?= base_url('kontak') ?>">
        <?= csrf_field() ?>
        <input name="name" placeholder="Nama" value="<?= old('name') ?>" required>
        <input name="email" type="email" placeholder="Email" value="<?= old('email') ?>">
        <input name="phone" placeholder="WhatsApp" value="<?= old('phone') ?>">
        <input name="subject" placeholder="Subjek" value="<?= old('subject') ?>" required>
        <textarea name="message" rows="6" placeholder="Pesan / kebutuhan project" required><?= old('message') ?></textarea>
        <button class="ak-btn ak-btn-gold" type="submit">Kirim Inquiry</button>
    </form>
</section>
<?= $this->endSection() ?>
