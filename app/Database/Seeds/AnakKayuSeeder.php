<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel;

class AnakKayuSeeder extends Seeder
{
    public function run(): void
    {
        $this->settings();
        $this->categories();
        $this->content();
        $this->products();
        $this->services();
        $this->portfolio();
        $this->adminUser();
    }

    private function settings(): void
    {
        $rows = [
            ['site_name', 'AnakKayu.id'],
            ['site_description', 'Spesialis mebel dan interior kayu modern classic untuk rumah, bisnis, dan project custom.'],
            ['contact_email', 'hello@anakkayu.id'],
            ['whatsapp_number', '6281234567890'],
            ['address', 'Indonesia'],
            ['instagram_url', 'https://instagram.com/anakkayu.id'],
            ['facebook_url', 'https://facebook.com/anakkayu.id'],
            ['default_meta_title', 'AnakKayu.id - Spesialis Mebel & Interior Kayu Berkualitas'],
            ['default_meta_description', 'Company profile, katalog produk, layanan custom furniture, portfolio, dan inquiry AnakKayu.id.'],
            ['hero_title', 'Spesialis Mebel & Interior Kayu Berkualitas'],
            ['hero_subtitle', 'Crafted wood, calm interior, lasting detail'],
        ];

        foreach ($rows as [$key, $value]) {
            $this->db->table('site_settings')->ignore(true)->insert([
                'setting_key' => $key,
                'setting_value' => $value,
                'type' => 'text',
                'group_name' => 'general',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }

    private function categories(): void
    {
        foreach ([
            ['content', 'Inspirasi Interior'], ['product', 'Furniture Custom'], ['service', 'Interior Kayu'], ['portfolio', 'Residential Project'],
        ] as [$type, $name]) {
            $this->db->table('categories')->ignore(true)->insert([
                'type' => $type,
                'name' => $name,
                'slug' => url_title($name, '-', true),
                'description' => 'Kategori awal ' . $name,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }

    private function content(): void
    {
        $this->db->table('pages')->ignore(true)->insert([
            'title' => 'Tentang Kami',
            'slug' => 'tentang-kami',
            'body' => '<p>AnakKayu adalah studio mebel dan interior kayu yang fokus pada desain modern classic, material natural, dan pengerjaan detail.</p><p>Kami menangani furniture custom, interior kayu, dekorasi, renovasi, dan restorasi.</p>',
            'status' => 'published',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $this->db->table('contents')->ignore(true)->insert([
            'title' => 'Cara Memilih Furniture Kayu untuk Ruang Modern Classic',
            'slug' => 'cara-memilih-furniture-kayu-modern-classic',
            'summary' => 'Panduan singkat memilih material, warna finishing, dan proporsi furniture kayu.',
            'body' => '<p>Pilih kayu dan finishing berdasarkan fungsi ruang, intensitas penggunaan, kelembapan, serta gaya visual yang ingin dibangun.</p>',
            'status' => 'published',
            'is_featured' => 1,
            'published_at' => date('Y-m-d H:i:s'),
            'featured_image' => 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?auto=format&fit=crop&w=1000&q=80',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    private function products(): void
    {
        foreach ([
            ['Meja Makan Solid Wood', 'meja-makan-solid-wood', 'Meja makan kayu solid dengan finishing natural.', 'Jati / Mahoni', '180 x 90 cm'],
            ['Kabinet TV Custom', 'kabinet-tv-custom', 'Kabinet TV built-in dengan storage rapi.', 'Multipleks HPL kayu', 'Custom'],
            ['Rak Display Artisan', 'rak-display-artisan', 'Rak display untuk rumah, cafe, dan retail.', 'Kayu solid kombinasi besi', 'Custom'],
        ] as [$name, $slug, $summary, $material, $size]) {
            $this->db->table('products')->ignore(true)->insert([
                'product_name' => $name,
                'slug' => $slug,
                'summary' => $summary,
                'description' => '<p>' . $summary . ' Produk dapat disesuaikan dengan ukuran ruang, material, dan gaya finishing.</p>',
                'price_display_type' => 'by_request',
                'stock_status' => 'made_to_order',
                'featured_image' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=1000&q=80',
                'material' => $material,
                'size' => $size,
                'finishing' => 'Natural matte',
                'is_custom_available' => 1,
                'is_featured' => 1,
                'status' => 'published',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }

    private function services(): void
    {
        foreach ([
            ['Furniture Custom', 'furniture-custom', 'Desain dan produksi furniture sesuai ukuran dan kebutuhan ruang.'],
            ['Interior Kayu', 'interior-kayu', 'Panel, backdrop, partisi, ceiling, dan aksen interior kayu.'],
            ['Renovasi & Restorasi', 'renovasi-restorasi', 'Perbaikan, refinishing, dan pembaruan furniture atau elemen kayu.'],
        ] as [$name, $slug, $summary]) {
            $this->db->table('services')->ignore(true)->insert([
                'service_name' => $name,
                'slug' => $slug,
                'summary' => $summary,
                'description' => '<p>' . $summary . ' Tim AnakKayu membantu dari konsultasi awal sampai instalasi akhir.</p>',
                'estimated_price' => 'By request',
                'featured_image' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1000&q=80',
                'is_featured' => 1,
                'status' => 'published',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }

    private function portfolio(): void
    {
        foreach ([
            ['Kitchen Set Kayu Natural', 'kitchen-set-kayu-natural'],
            ['Living Room Modern Classic', 'living-room-modern-classic'],
            ['Cafe Counter Artisan', 'cafe-counter-artisan'],
        ] as [$title, $slug]) {
            $this->db->table('portfolios')->ignore(true)->insert([
                'title' => $title,
                'slug' => $slug,
                'summary' => 'Project interior kayu dengan detail finishing hangat dan layout bersih.',
                'description' => '<p>Project ini menonjolkan karakter kayu natural, fungsi storage, dan visual premium yang tetap tenang.</p>',
                'client_name' => 'Private Client',
                'location' => 'Indonesia',
                'project_date' => date('Y-m-d'),
                'featured_image' => 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?auto=format&fit=crop&w=1000&q=80',
                'is_featured' => 1,
                'status' => 'published',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }

    private function adminUser(): void
    {
        $email = env('ANAKKAYU_ADMIN_EMAIL', 'admin@anakkayu.id');
        $password = env('ANAKKAYU_ADMIN_PASSWORD', 'ChangeMe123!');
        $users = model(UserModel::class);

        if ($users->findByCredentials(['email' => $email]) !== null) {
            return;
        }

        $user = new User([
            'username' => 'superadmin',
            'email'    => $email,
            'password' => $password,
            'active'   => 1,
        ]);

        $users->save($user);
        $user = $users->findById($users->getInsertID());
        $user->addGroup('superadmin');
    }
}
