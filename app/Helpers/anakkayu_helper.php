<?php

use App\Models\SettingModel;
use CodeIgniter\I18n\Time;

function ak_settings(): array
{
    static $settings;
    if ($settings === null) {
        $settings = model(SettingModel::class)->allKeyed();
    }

    return $settings;
}

function ak_setting(string $key, ?string $default = null): ?string
{
    $settings = ak_settings();

    return $settings[$key] ?? $default;
}

function ak_unique_slug(string $text, string $table, ?int $ignoreId = null): string
{
    $db = db_connect();
    $base = url_title(convert_accented_characters($text), '-', true) ?: strtolower(random_string('alnum', 8));
    $slug = $base;
    $i = 2;

    while (true) {
        $builder = $db->table($table)->where('slug', $slug);
        if ($ignoreId) {
            $builder->where('id !=', $ignoreId);
        }
        if ($builder->countAllResults() === 0) {
            return $slug;
        }
        $slug = $base . '-' . $i++;
    }
}

function ak_meta(array $data = []): array
{
    $title = $data['title'] ?? ak_setting('default_meta_title', 'AnakKayu.id - Spesialis Mebel & Interior Kayu');
    $description = $data['description'] ?? ak_setting('default_meta_description', 'AnakKayu menghadirkan mebel, interior kayu, dekorasi, dan layanan custom dengan karakter premium artisan.');
    $image = ! empty($data['image']) ? $data['image'] : ak_default_content_image(['slug' => $title]);

    return [
        'title'       => $title,
        'description' => $description,
        'image'       => $image,
        'canonical'   => $data['canonical'] ?? current_url(),
        'type'        => $data['type'] ?? 'website',
        'keywords'    => $data['keywords'] ?? '',
    ];
}

function ak_default_content_image(array $item = []): string
{
    $images = [
        'assets/anakkayu/card-1.jpg',
        'assets/anakkayu/card-2.jpg',
        'assets/anakkayu/card-3.jpg',
        'assets/anakkayu/gallery-1.jpg',
        'assets/anakkayu/gallery-2.jpg',
        'assets/anakkayu/gallery-3.jpg',
        'assets/anakkayu/portfolio-1.jpg',
        'assets/anakkayu/portfolio-3.jpg',
        'assets/anakkayu/banner.jpg',
    ];

    $seed = (string) ($item['slug'] ?? $item['title'] ?? $item['id'] ?? 'anakkayu');
    $index = abs((int) crc32($seed)) % count($images);

    return base_url($images[$index]);
}

function ak_content_image(array $item): string
{
    return ! empty($item['featured_image'])
        ? $item['featured_image']
        : ak_default_content_image($item);
}

function ak_share_links(string $url, string $title): array
{
    $encodedUrl = rawurlencode($url);
    $encodedTitle = rawurlencode($title);

    return [
        'whatsapp' => 'https://wa.me/?text=' . $encodedTitle . '%20' . $encodedUrl,
        'facebook' => 'https://www.facebook.com/sharer/sharer.php?u=' . $encodedUrl,
        'twitter' => 'https://twitter.com/intent/tweet?url=' . $encodedUrl . '&text=' . $encodedTitle,
        'telegram' => 'https://t.me/share/url?url=' . $encodedUrl . '&text=' . $encodedTitle,
    ];
}

function ak_whatsapp_link(string $message): string
{
    $phone = preg_replace('/\D+/', '', ak_setting('whatsapp_number', '6281234567890') ?? '');

    return 'https://wa.me/' . $phone . '?text=' . rawurlencode($message);
}

function ak_date(?string $date): string
{
    return $date ? Time::parse($date)->toLocalizedString('dd MMM yyyy') : '-';
}
