<footer class="ak-footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-5">
                <a class="ak-footer-brand" href="<?= base_url() ?>">
                    <img src="<?= base_url('assets/anakkayu/logo.png') ?>" alt="AnakKayu">
                </a>
                <p><?= esc(ak_setting('site_description', 'Studio mebel dan interior kayu untuk ruang yang hangat, elegan, dan tahan lama.')) ?></p>
            </div>
            <div class="col-md-4 col-lg-3">
                <h4>Contact</h4>
                <p><?= esc(ak_setting('contact_email', 'admin@anakkayu.id')) ?><br><?= esc(ak_setting('whatsapp_number', '+62 8121 7352 115')) ?></p>
            </div>
            <div class="col-md-4 col-lg-2">
                <h4>Location</h4>
                <p><?= esc(ak_setting('address', 'Indonesia')) ?></p>
            </div>
            <div class="col-md-4 col-lg-2">
                <h4>Social</h4>
                <a href="<?= esc(ak_setting('instagram_url', '#')) ?>">Instagram</a><br>
                <a href="<?= esc(ak_setting('facebook_url', '#')) ?>">Facebook</a>
            </div>
        </div>
        <div class="ak-footer-line">&copy; <?= date('Y') ?> AnakKayu.id. All rights reserved.</div>
    </div>
</footer>
