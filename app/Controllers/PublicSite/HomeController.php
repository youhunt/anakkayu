<?php

namespace App\Controllers\PublicSite;

use App\Models\ContentModel;
use App\Models\PortfolioModel;
use App\Models\ProductModel;
use App\Models\ServiceModel;

class HomeController extends BasePublicController
{
    public function index(): string
    {
        return $this->render('public/home', [
            'meta' => ['type' => 'website'],
            'products' => model(ProductModel::class)->published(6),
            'services' => model(ServiceModel::class)->published(6),
            'portfolio' => model(PortfolioModel::class)->published(6),
            'contents' => model(ContentModel::class)->published(3),
        ]);
    }
}
