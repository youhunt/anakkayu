<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAnakKayuCoreTables extends Migration
{
    public function up(): void
    {
        $this->categories();
        $this->tags();
        $this->contents();
        $this->pages();
        $this->products();
        $this->services();
        $this->portfolios();
        $this->tagPivots();
        $this->media();
        $this->inquiries();
        $this->settings();
        $this->views();
        $this->shareLogs();
        $this->activityLogs();
        $this->menuItems();
        $this->testimonials();
        $this->banners();
        $this->social();
    }

    public function down(): void
    {
        foreach ([
            'social_import_logs', 'social_generated_contents', 'social_imports', 'social_sources',
            'banners', 'testimonials', 'menu_items', 'activity_logs', 'share_logs',
            'portfolio_views', 'service_views', 'product_views', 'content_views',
            'site_settings', 'inquiries', 'media', 'portfolio_tags', 'service_tags',
            'product_tags', 'content_tags', 'portfolios', 'services', 'products',
            'pages', 'contents', 'tags', 'categories',
        ] as $table) {
            $this->forge->dropTable($table, true);
        }
    }

    private function commonSeo(): array
    {
        return [
            'meta_title'       => ['type' => 'VARCHAR', 'constraint' => 180, 'null' => true],
            'meta_description' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_by'       => ['type' => 'INT', 'unsigned' => true, 'null' => true],
            'updated_by'       => ['type' => 'INT', 'unsigned' => true, 'null' => true],
            'deleted_by'       => ['type' => 'INT', 'unsigned' => true, 'null' => true],
            'created_at'       => ['type' => 'DATETIME', 'null' => true],
            'updated_at'       => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'       => ['type' => 'DATETIME', 'null' => true],
        ];
    }

    private function categories(): void
    {
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'type'             => ['type' => 'VARCHAR', 'constraint' => 40],
            'name'             => ['type' => 'VARCHAR', 'constraint' => 140],
            'slug'             => ['type' => 'VARCHAR', 'constraint' => 160],
            'description'      => ['type' => 'TEXT', 'null' => true],
            'meta_title'       => ['type' => 'VARCHAR', 'constraint' => 180, 'null' => true],
            'meta_description' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at'       => ['type' => 'DATETIME', 'null' => true],
            'updated_at'       => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'       => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['type', 'slug']);
        $this->forge->createTable('categories');
    }

    private function tags(): void
    {
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'name'             => ['type' => 'VARCHAR', 'constraint' => 140],
            'slug'             => ['type' => 'VARCHAR', 'constraint' => 160],
            'meta_title'       => ['type' => 'VARCHAR', 'constraint' => 180, 'null' => true],
            'meta_description' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at'       => ['type' => 'DATETIME', 'null' => true],
            'updated_at'       => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'       => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->createTable('tags');
    }

    private function contents(): void
    {
        $this->forge->addField(array_merge([
            'id'             => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'title'          => ['type' => 'VARCHAR', 'constraint' => 180],
            'slug'           => ['type' => 'VARCHAR', 'constraint' => 190],
            'summary'        => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'body'           => ['type' => 'LONGTEXT', 'null' => true],
            'category_id'    => ['type' => 'INT', 'unsigned' => true, 'null' => true],
            'featured_image' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status'         => ['type' => 'VARCHAR', 'constraint' => 30, 'default' => 'draft'],
            'is_featured'    => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'view_count'     => ['type' => 'INT', 'unsigned' => true, 'default' => 0],
            'share_count'    => ['type' => 'INT', 'unsigned' => true, 'default' => 0],
            'published_at'   => ['type' => 'DATETIME', 'null' => true],
        ], $this->commonSeo()));
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->addKey(['status', 'published_at']);
        $this->forge->createTable('contents');
    }

    private function pages(): void
    {
        $this->forge->addField(array_merge([
            'id'             => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'title'          => ['type' => 'VARCHAR', 'constraint' => 180],
            'slug'           => ['type' => 'VARCHAR', 'constraint' => 190],
            'body'           => ['type' => 'LONGTEXT', 'null' => true],
            'featured_image' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'template_type'  => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'default'],
            'status'         => ['type' => 'VARCHAR', 'constraint' => 30, 'default' => 'draft'],
        ], $this->commonSeo()));
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->createTable('pages');
    }

    private function products(): void
    {
        $this->forge->addField(array_merge([
            'id'                  => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'product_name'        => ['type' => 'VARCHAR', 'constraint' => 180],
            'slug'                => ['type' => 'VARCHAR', 'constraint' => 190],
            'summary'             => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'description'         => ['type' => 'LONGTEXT', 'null' => true],
            'category_id'         => ['type' => 'INT', 'unsigned' => true, 'null' => true],
            'price'               => ['type' => 'DECIMAL', 'constraint' => '14,2', 'null' => true],
            'price_display_type'  => ['type' => 'VARCHAR', 'constraint' => 40, 'default' => 'by_request'],
            'discount_price'      => ['type' => 'DECIMAL', 'constraint' => '14,2', 'null' => true],
            'sku'                 => ['type' => 'VARCHAR', 'constraint' => 80, 'null' => true],
            'stock_status'        => ['type' => 'VARCHAR', 'constraint' => 40, 'default' => 'available'],
            'featured_image'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'gallery'             => ['type' => 'JSON', 'null' => true],
            'material'            => ['type' => 'VARCHAR', 'constraint' => 140, 'null' => true],
            'size'                => ['type' => 'VARCHAR', 'constraint' => 140, 'null' => true],
            'finishing'           => ['type' => 'VARCHAR', 'constraint' => 140, 'null' => true],
            'is_custom_available' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'is_featured'         => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'status'              => ['type' => 'VARCHAR', 'constraint' => 30, 'default' => 'draft'],
            'view_count'          => ['type' => 'INT', 'unsigned' => true, 'default' => 0],
        ], $this->commonSeo()));
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->createTable('products');
    }

    private function services(): void
    {
        $this->forge->addField(array_merge([
            'id'              => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'service_name'    => ['type' => 'VARCHAR', 'constraint' => 180],
            'slug'            => ['type' => 'VARCHAR', 'constraint' => 190],
            'summary'         => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'description'     => ['type' => 'LONGTEXT', 'null' => true],
            'category_id'     => ['type' => 'INT', 'unsigned' => true, 'null' => true],
            'estimated_price' => ['type' => 'VARCHAR', 'constraint' => 120, 'null' => true],
            'featured_image'  => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'benefits'        => ['type' => 'JSON', 'null' => true],
            'process_steps'   => ['type' => 'JSON', 'null' => true],
            'is_featured'     => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'status'          => ['type' => 'VARCHAR', 'constraint' => 30, 'default' => 'draft'],
            'view_count'      => ['type' => 'INT', 'unsigned' => true, 'default' => 0],
        ], $this->commonSeo()));
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->createTable('services');
    }

    private function portfolios(): void
    {
        $this->forge->addField(array_merge([
            'id'             => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'title'          => ['type' => 'VARCHAR', 'constraint' => 180],
            'slug'           => ['type' => 'VARCHAR', 'constraint' => 190],
            'category_id'    => ['type' => 'INT', 'unsigned' => true, 'null' => true],
            'summary'        => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'description'    => ['type' => 'LONGTEXT', 'null' => true],
            'client_name'    => ['type' => 'VARCHAR', 'constraint' => 140, 'null' => true],
            'location'       => ['type' => 'VARCHAR', 'constraint' => 160, 'null' => true],
            'project_date'   => ['type' => 'DATE', 'null' => true],
            'featured_image' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'gallery'        => ['type' => 'JSON', 'null' => true],
            'is_featured'    => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'status'         => ['type' => 'VARCHAR', 'constraint' => 30, 'default' => 'draft'],
            'view_count'     => ['type' => 'INT', 'unsigned' => true, 'default' => 0],
        ], $this->commonSeo()));
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->createTable('portfolios');
    }

    private function tagPivots(): void
    {
        foreach (['content', 'product', 'service', 'portfolio'] as $type) {
            $this->forge->addField([
                $type . '_id' => ['type' => 'INT', 'unsigned' => true],
                'tag_id'      => ['type' => 'INT', 'unsigned' => true],
            ]);
            $this->forge->addKey([$type . '_id', 'tag_id'], true);
            $this->forge->createTable($type . '_tags');
        }
    }

    private function media(): void
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'file_name'   => ['type' => 'VARCHAR', 'constraint' => 190],
            'file_path'   => ['type' => 'VARCHAR', 'constraint' => 255],
            'mime_type'   => ['type' => 'VARCHAR', 'constraint' => 100],
            'file_size'   => ['type' => 'INT', 'unsigned' => true],
            'alt_text'    => ['type' => 'VARCHAR', 'constraint' => 180, 'null' => true],
            'caption'     => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'uploaded_by' => ['type' => 'INT', 'unsigned' => true, 'null' => true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('media');
    }

    private function inquiries(): void
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'name'        => ['type' => 'VARCHAR', 'constraint' => 140],
            'email'       => ['type' => 'VARCHAR', 'constraint' => 180, 'null' => true],
            'phone'       => ['type' => 'VARCHAR', 'constraint' => 40, 'null' => true],
            'subject'     => ['type' => 'VARCHAR', 'constraint' => 180],
            'message'     => ['type' => 'TEXT'],
            'source_type' => ['type' => 'VARCHAR', 'constraint' => 40, 'null' => true],
            'source_id'   => ['type' => 'INT', 'unsigned' => true, 'null' => true],
            'status'      => ['type' => 'VARCHAR', 'constraint' => 40, 'default' => 'new'],
            'admin_notes' => ['type' => 'TEXT', 'null' => true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey(['source_type', 'source_id']);
        $this->forge->createTable('inquiries');
    }

    private function settings(): void
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'setting_key'   => ['type' => 'VARCHAR', 'constraint' => 120],
            'setting_value' => ['type' => 'TEXT', 'null' => true],
            'type'          => ['type' => 'VARCHAR', 'constraint' => 40, 'default' => 'text'],
            'group_name'    => ['type' => 'VARCHAR', 'constraint' => 60, 'default' => 'general'],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('setting_key');
        $this->forge->createTable('site_settings');
    }

    private function views(): void
    {
        foreach (['content', 'product', 'service', 'portfolio'] as $type) {
            $this->forge->addField([
                'id'          => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
                $type . '_id' => ['type' => 'INT', 'unsigned' => true],
                'ip_hash'     => ['type' => 'VARCHAR', 'constraint' => 80, 'null' => true],
                'user_agent'  => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'created_at'  => ['type' => 'DATETIME', 'null' => true],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->addKey($type . '_id');
            $this->forge->createTable($type . '_views');
        }
    }

    private function shareLogs(): void
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'shareable_type' => ['type' => 'VARCHAR', 'constraint' => 40],
            'shareable_id'   => ['type' => 'INT', 'unsigned' => true],
            'platform'       => ['type' => 'VARCHAR', 'constraint' => 40],
            'ip_hash'        => ['type' => 'VARCHAR', 'constraint' => 80, 'null' => true],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey(['shareable_type', 'shareable_id']);
        $this->forge->createTable('share_logs');
    }

    private function activityLogs(): void
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'actor_id'    => ['type' => 'INT', 'unsigned' => true, 'null' => true],
            'action'      => ['type' => 'VARCHAR', 'constraint' => 120],
            'subject_type'=> ['type' => 'VARCHAR', 'constraint' => 80, 'null' => true],
            'subject_id'  => ['type' => 'INT', 'unsigned' => true, 'null' => true],
            'payload'     => ['type' => 'JSON', 'null' => true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('activity_logs');
    }

    private function menuItems(): void
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'parent_id'  => ['type' => 'INT', 'unsigned' => true, 'null' => true],
            'label'      => ['type' => 'VARCHAR', 'constraint' => 120],
            'url'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'location'   => ['type' => 'VARCHAR', 'constraint' => 60, 'default' => 'header'],
            'sort_order' => ['type' => 'INT', 'default' => 0],
            'is_active'  => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('menu_items');
    }

    private function testimonials(): void
    {
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'client_name'  => ['type' => 'VARCHAR', 'constraint' => 140],
            'client_title' => ['type' => 'VARCHAR', 'constraint' => 140, 'null' => true],
            'message'      => ['type' => 'TEXT'],
            'photo'        => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'rating'       => ['type' => 'TINYINT', 'unsigned' => true, 'default' => 5],
            'is_featured'  => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'status'       => ['type' => 'VARCHAR', 'constraint' => 30, 'default' => 'published'],
            'created_at'   => ['type' => 'DATETIME', 'null' => true],
            'updated_at'   => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'   => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('testimonials');
    }

    private function banners(): void
    {
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'title'          => ['type' => 'VARCHAR', 'constraint' => 180],
            'subtitle'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'image'          => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'cta_label'      => ['type' => 'VARCHAR', 'constraint' => 120, 'null' => true],
            'cta_url'        => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'placement'      => ['type' => 'VARCHAR', 'constraint' => 60, 'default' => 'home_hero'],
            'sort_order'     => ['type' => 'INT', 'default' => 0],
            'status'         => ['type' => 'VARCHAR', 'constraint' => 30, 'default' => 'published'],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('banners');
    }

    private function social(): void
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'platform'    => ['type' => 'VARCHAR', 'constraint' => 60],
            'account_name'=> ['type' => 'VARCHAR', 'constraint' => 140, 'null' => true],
            'profile_url' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'is_active'   => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('social_sources');

        $this->forge->addField([
            'id'            => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'social_source_id' => ['type' => 'INT', 'unsigned' => true, 'null' => true],
            'platform'      => ['type' => 'VARCHAR', 'constraint' => 60],
            'source_url'    => ['type' => 'VARCHAR', 'constraint' => 500],
            'caption'       => ['type' => 'TEXT', 'null' => true],
            'media_url'     => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'posted_at'     => ['type' => 'DATETIME', 'null' => true],
            'status'        => ['type' => 'VARCHAR', 'constraint' => 40, 'default' => 'pending_review'],
            'attribution'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'raw_payload'   => ['type' => 'JSON', 'null' => true],
            'created_by'    => ['type' => 'INT', 'unsigned' => true, 'null' => true],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('social_imports');

        $this->forge->addField([
            'id'              => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'social_import_id'=> ['type' => 'INT', 'unsigned' => true],
            'content_id'      => ['type' => 'INT', 'unsigned' => true, 'null' => true],
            'draft_title'     => ['type' => 'VARCHAR', 'constraint' => 180],
            'draft_summary'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'draft_body'      => ['type' => 'LONGTEXT', 'null' => true],
            'meta_description'=> ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status'          => ['type' => 'VARCHAR', 'constraint' => 40, 'default' => 'draft'],
            'created_at'      => ['type' => 'DATETIME', 'null' => true],
            'updated_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('social_generated_contents');

        $this->forge->addField([
            'id'              => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'social_import_id'=> ['type' => 'INT', 'unsigned' => true, 'null' => true],
            'level'           => ['type' => 'VARCHAR', 'constraint' => 30, 'default' => 'info'],
            'message'         => ['type' => 'TEXT'],
            'context'         => ['type' => 'JSON', 'null' => true],
            'created_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('social_import_logs');
    }
}
