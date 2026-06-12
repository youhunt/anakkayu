<?php

namespace App\Models;

class ContentModel extends AnakKayuModel
{
    protected $table = 'contents';
    protected $allowedFields = [
        'title', 'slug', 'summary', 'body', 'category_id', 'featured_image', 'status',
        'is_featured', 'view_count', 'share_count', 'published_at', 'meta_title',
        'meta_description', 'meta_keywords', 'og_image', 'created_by', 'updated_by', 'deleted_by',
    ];
}
