<?php
$assetUrl = static function (string $path): string {
    $fullPath = FCPATH . str_replace('/', DIRECTORY_SEPARATOR, $path);
    $version = is_file($fullPath) ? '?v=' . filemtime($fullPath) : '';

    return base_url($path) . $version;
};
?>
<!-- JAVASCRIPT -->
<script src="<?= $assetUrl('assets/libs/jquery/jquery.min.js') ?>"></script>
<script src="<?= $assetUrl('assets/libs/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= $assetUrl('assets/libs/metismenu/metisMenu.min.js') ?>"></script>
<script src="<?= $assetUrl('assets/libs/simplebar/simplebar.min.js') ?>"></script>
<script src="<?= $assetUrl('assets/libs/node-waves/waves.min.js') ?>"></script>
