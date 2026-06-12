<?php

namespace App\Controllers\PublicSite;

use App\Models\ContentModel;
use App\Models\ProductModel;
use App\Models\ServiceModel;

class SearchController extends BasePublicController
{
    public function index(): string
    {
        $q = trim((string) $this->request->getGet('q'));

        return $this->render('public/search/index', [
            'q' => $q,
            'contents' => $q ? model(ContentModel::class)->like('title', $q)->where('status', 'published')->findAll(10) : [],
            'products' => $q ? model(ProductModel::class)->like('product_name', $q)->where('status', 'published')->findAll(10) : [],
            'services' => $q ? model(ServiceModel::class)->like('service_name', $q)->where('status', 'published')->findAll(10) : [],
        ]);
    }
}
