<?php

namespace App\Models;

class ServiceModel extends AnakKayuModel
{
    protected $table = 'services';
    protected $allowedFields = [
        'service_name', 'slug', 'summary', 'description', 'category_id', 'estimated_price',
        'featured_image', 'benefits', 'process_steps', 'is_featured', 'status', 'view_count',
        'meta_title', 'meta_description', 'meta_keywords', 'og_image', 'created_by', 'updated_by', 'deleted_by',
    ];
}
