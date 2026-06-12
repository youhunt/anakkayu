<?php

namespace App\Models;

class PortfolioModel extends AnakKayuModel
{
    protected $table = 'portfolios';
    protected $allowedFields = [
        'title', 'slug', 'category_id', 'summary', 'description', 'client_name', 'location',
        'project_date', 'featured_image', 'gallery', 'is_featured', 'status', 'view_count',
        'meta_title', 'meta_description', 'meta_keywords', 'og_image', 'created_by', 'updated_by', 'deleted_by',
    ];
}
