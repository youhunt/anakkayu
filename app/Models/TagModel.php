<?php

namespace App\Models;

class TagModel extends AnakKayuModel
{
    protected $table = 'tags';
    protected $allowedFields = ['name', 'slug', 'meta_title', 'meta_description', 'meta_keywords'];
}
