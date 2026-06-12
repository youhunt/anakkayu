<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCmsSeoAndWorkflowFields extends Migration
{
    private array $tables = ['contents', 'pages', 'products', 'services', 'portfolios', 'categories', 'tags'];

    public function up(): void
    {
        foreach ($this->tables as $table) {
            if (! $this->db->fieldExists('meta_keywords', $table)) {
                $this->forge->addColumn($table, [
                    'meta_keywords' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'meta_description'],
                ]);
            }
        }

        foreach (['contents', 'pages', 'products', 'services', 'portfolios'] as $table) {
            if (! $this->db->fieldExists('og_image', $table)) {
                $this->forge->addColumn($table, [
                    'og_image' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'meta_keywords'],
                ]);
            }
        }
    }

    public function down(): void
    {
        foreach (['contents', 'pages', 'products', 'services', 'portfolios'] as $table) {
            if ($this->db->fieldExists('og_image', $table)) {
                $this->forge->dropColumn($table, 'og_image');
            }
        }

        foreach ($this->tables as $table) {
            if ($this->db->fieldExists('meta_keywords', $table)) {
                $this->forge->dropColumn($table, 'meta_keywords');
            }
        }
    }
}
