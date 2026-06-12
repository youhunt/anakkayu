<?php

namespace App\Models;

class CategoryModel extends AnakKayuModel
{
    protected $table = 'categories';
    protected $allowedFields = ['type', 'name', 'slug', 'description', 'meta_title', 'meta_description', 'meta_keywords'];
}
