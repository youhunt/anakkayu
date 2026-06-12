<?php

namespace App\Models;

use CodeIgniter\Model;

class SocialImportModel extends Model
{
    protected $table = 'social_imports';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'social_source_id', 'platform', 'source_url', 'caption', 'media_url', 'posted_at',
        'status', 'attribution', 'raw_payload', 'created_by',
    ];
}
