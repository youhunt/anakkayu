<div class="ak-share">
    <span>Share</span>
    <?php foreach (($share ?? []) as $platform => $url): ?>
        <a href="<?= esc($url) ?>" target="_blank" rel="noopener"><?= esc(ucfirst($platform)) ?></a>
    <?php endforeach ?>
    <button type="button" class="ak-copy" data-copy="<?= esc(current_url()) ?>">Copy link</button>
</div>
