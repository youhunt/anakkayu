<?php

namespace App\Controllers\PublicSite;

use App\Models\CategoryModel;
use App\Models\TagModel;

class TaxonomyController extends BasePublicController
{
    public function category(string $slug): string
    {
        $category = model(CategoryModel::class)->where('slug', $slug)->first();
        return $this->render('public/search/index', ['q' => 'Kategori: ' . ($category['name'] ?? $slug), 'contents' => [], 'products' => [], 'services' => []]);
    }

    public function tag(string $slug): string
    {
        $tag = model(TagModel::class)->where('slug', $slug)->first();
        return $this->render('public/search/index', ['q' => 'Tag: ' . ($tag['name'] ?? $slug), 'contents' => [], 'products' => [], 'services' => []]);
    }
}
