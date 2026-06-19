<footer class="ak-footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-5">
                <h3><?= esc(ak_setting('site_name', 'AnakKayu')) ?></h3>
                <p><?= esc(ak_setting('footer_text', ak_setting('site_description', 'Studio mebel dan interior kayu untuk ruang yang hangat, elegan, dan tahan lama.'))) ?></p>
            </div>
            <div class="col-md-4 col-lg-3">
                <h4>Contact</h4>
                <p>
                    <?= esc(ak_setting('contact_email', 'hello@anakkayu.id')) ?><br>
                    <?= esc(ak_setting('whatsapp_number', '+62 812 3456 7890')) ?><br>
                    <?= esc(ak_setting('business_hours', 'Senin - Sabtu, 08.00 - 17.00')) ?>
                </p>
            </div>
            <div class="col-md-4 col-lg-2">
                <h4>Location</h4>
                <p><?= nl2br(esc(ak_setting('address', 'Indonesia'))) ?></p>
            </div>
            <div class="col-md-4 col-lg-2">
                <h4>Social</h4>
                <div class="ak-social-list">
                    <a href="<?= esc(ak_setting('instagram_url', '#')) ?>" target="_blank" rel="noopener">Instagram</a>
                    <a href="<?= esc(ak_setting('facebook_url', '#')) ?>" target="_blank" rel="noopener">Facebook</a>
                    <?php if (ak_setting('youtube_url')): ?>
                        <a href="<?= esc(ak_setting('youtube_url')) ?>" target="_blank" rel="noopener">YouTube</a>
                    <?php endif ?>
                    <?php if (ak_setting('tiktok_url')): ?>
                        <a href="<?= esc(ak_setting('tiktok_url')) ?>" target="_blank" rel="noopener">TikTok</a>
                    <?php endif ?>
                </div>
            </div>
        </div>
        <div class="ak-footer-line">&copy; <?= date('Y') ?> AnakKayu.id. Crafted with care for warm, calm, and meaningful spaces.</div>
    </div>
</footer>
