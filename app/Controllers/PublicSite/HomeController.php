<?php

namespace App\Controllers\PublicSite;

use App\Models\ContentModel;
use App\Models\PageModel;
use App\Models\PortfolioModel;
use App\Models\ProductModel;
use App\Models\ServiceModel;

class HomeController extends BasePublicController
{
    public function index(): string
    {
        $aboutPage = model(PageModel::class)->findPublishedBySlug('tentang-kami');
        $portfolio = model(PortfolioModel::class)->published(8);
        $services  = model(ServiceModel::class)->published(6);
        $products  = model(ProductModel::class)->published(4);
        $contents  = model(ContentModel::class)->published(3);

        return $this->render('public/home', [
            'meta' => [
                'title'       => ak_setting('default_meta_title', 'AnakKayu.id - Spesialis Mebel & Interior Kayu Berkelas'),
                'description' => ak_setting('default_meta_description', ak_setting('site_description', 'AnakKayu menghadirkan mebel, interior kayu, dekorasi, kemasan kayu, dan project custom dengan rasa modern classic yang hangat, elegan, dan berkelas.')),
                'image'       => ak_setting('og_image', base_url('assets/anakkayu/img/og-default.jpg')),
                'type'        => 'website',
            ],
            'aboutPage' => $aboutPage,
            'products'  => $products,
            'services'  => $services,
            'portfolio' => $portfolio,
            'contents'  => $contents,
        ]);
    }
}
