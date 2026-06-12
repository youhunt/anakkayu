<?php

namespace App\Models;

use CodeIgniter\Model;

class SocialGeneratedContentModel extends Model
{
    protected $table = 'social_generated_contents';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['social_import_id', 'content_id', 'draft_title', 'draft_summary', 'draft_body', 'meta_description', 'status'];
}
