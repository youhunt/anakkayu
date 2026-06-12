<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<section class="ak-panel">
    <form method="post">
        <?= csrf_field() ?>
        <div class="row g-3">
            <?php foreach ($config['fields'] as $field): ?>
                <div class="<?= in_array($field, ['body', 'description', 'gallery', 'benefits', 'process_steps'], true) ? 'col-12' : 'col-md-6' ?>">
                    <label class="form-label"><?= esc(ucwords(str_replace('_', ' ', $field))) ?></label>
                    <?php if (in_array($field, ['body', 'description'], true)): ?>
                        <textarea class="form-control ak-richtext" rows="10" name="<?= esc($field) ?>"><?= old($field, $item[$field] ?? '') ?></textarea>
                    <?php elseif (in_array($field, ['gallery', 'benefits', 'process_steps'], true)): ?>
                        <textarea class="form-control" rows="5" name="<?= esc($field) ?>" placeholder="Satu item per baris"><?= old($field, $item[$field] ?? '') ?></textarea>
                    <?php elseif ($field === 'category_id'): ?>
                        <select class="form-select" name="category_id">
                            <option value="">Tanpa kategori</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= esc($category['id']) ?>" <?= (string) old('category_id', $item['category_id'] ?? '') === (string) $category['id'] ? 'selected' : '' ?>><?= esc($category['name']) ?></option>
                            <?php endforeach ?>
                        </select>
                    <?php elseif ($field === 'status'): ?>
                        <select class="form-select" name="status">
                            <?php foreach (['draft', 'review', 'published', 'archived'] as $status): ?><option value="<?= $status ?>" <?= old('status', $item['status'] ?? 'draft') === $status ? 'selected' : '' ?>><?= ucfirst($status) ?></option><?php endforeach ?>
                        </select>
                    <?php elseif ($field === 'price_display_type'): ?>
                        <select class="form-select" name="price_display_type">
                            <?php foreach (['by_request' => 'Hubungi Kami', 'visible' => 'Tampilkan Harga', 'hidden' => 'Sembunyikan Harga'] as $value => $label): ?>
                                <option value="<?= esc($value) ?>" <?= old('price_display_type', $item['price_display_type'] ?? 'by_request') === $value ? 'selected' : '' ?>><?= esc($label) ?></option>
                            <?php endforeach ?>
                        </select>
                    <?php elseif ($field === 'stock_status'): ?>
                        <select class="form-select" name="stock_status">
                            <?php foreach (['available' => 'Available', 'made_to_order' => 'Made to Order', 'sold_out' => 'Sold Out'] as $value => $label): ?>
                                <option value="<?= esc($value) ?>" <?= old('stock_status', $item['stock_status'] ?? 'available') === $value ? 'selected' : '' ?>><?= esc($label) ?></option>
                            <?php endforeach ?>
                        </select>
                    <?php elseif ($field === 'template_type'): ?>
                        <select class="form-select" name="template_type">
                            <?php foreach (['default', 'about', 'contact', 'legal'] as $value): ?>
                                <option value="<?= esc($value) ?>" <?= old('template_type', $item['template_type'] ?? 'default') === $value ? 'selected' : '' ?>><?= esc(ucfirst($value)) ?></option>
                            <?php endforeach ?>
                        </select>
                    <?php elseif ($field === 'published_at' || $field === 'project_date'): ?>
                        <input class="form-control" type="<?= $field === 'project_date' ? 'date' : 'datetime-local' ?>" name="<?= esc($field) ?>" value="<?= old($field, isset($item[$field]) && $item[$field] ? str_replace(' ', 'T', substr($item[$field], 0, 16)) : '') ?>">
                    <?php elseif (str_starts_with($field, 'is_')): ?>
                        <select class="form-select" name="<?= esc($field) ?>"><option value="0">Tidak</option><option value="1" <?= old($field, $item[$field] ?? '0') ? 'selected' : '' ?>>Ya</option></select>
                    <?php else: ?>
                        <input class="form-control" name="<?= esc($field) ?>" value="<?= old($field, $item[$field] ?? '') ?>">
                    <?php endif ?>
                </div>
            <?php endforeach ?>
            <?php if (isset($config['tag_pivot'])): ?>
                <div class="col-12">
                    <label class="form-label">Tag</label>
                    <select class="form-select ak-select2" name="tag_ids[]" multiple>
                        <?php foreach ($tags as $tag): ?>
                            <option value="<?= esc($tag['id']) ?>" <?= in_array($tag['id'], $selectedTags, true) ? 'selected' : '' ?>><?= esc($tag['name']) ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            <?php endif ?>
        </div>
        <div class="mt-4"><button class="btn btn-dark">Simpan</button><a class="btn btn-link" href="<?= base_url('admin/' . $config['route']) ?>">Batal</a></div>
    </form>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/skote/libs/tinymce/tinymce.min.js') ?>"></script>
<script src="<?= base_url('assets/skote/libs/select2/js/select2.min.js') ?>"></script>
<script>
    if (window.tinymce) {
        tinymce.init({
            selector: '.ak-richtext',
            height: 360,
            menubar: false,
            plugins: 'link lists image table code',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | bullist numlist | link image table | code',
            convert_urls: false
        });
    }

    if (window.jQuery && jQuery.fn.select2) {
        jQuery('.ak-select2').select2({
            width: '100%',
            placeholder: 'Pilih tag'
        });
    }
</script>
<?= $this->endSection() ?>
