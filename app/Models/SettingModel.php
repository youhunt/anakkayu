<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table = 'site_settings';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['setting_key', 'setting_value', 'type', 'group_name'];

    public function allKeyed(): array
    {
        $settings = [];
        foreach ($this->findAll() as $row) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }

        return $settings;
    }
}
