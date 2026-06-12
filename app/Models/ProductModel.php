<?php

namespace App\Models;

class ProductModel extends AnakKayuModel
{
    protected $table = 'products';
    protected $allowedFields = [
        'product_name', 'slug', 'summary', 'description', 'category_id', 'price',
        'price_display_type', 'discount_price', 'sku', 'stock_status', 'featured_image',
        'gallery', 'material', 'size', 'finishing', 'is_custom_available', 'is_featured',
        'status', 'view_count', 'meta_title', 'meta_description', 'meta_keywords', 'og_image', 'created_by',
        'updated_by', 'deleted_by',
    ];
}
