<?php

namespace App\Models;

class PageModel extends AnakKayuModel
{
    protected $table = 'pages';
    protected $allowedFields = [
        'title', 'slug', 'body', 'featured_image', 'template_type', 'status',
        'meta_title', 'meta_description', 'meta_keywords', 'og_image', 'created_by', 'updated_by', 'deleted_by',
    ];
}
