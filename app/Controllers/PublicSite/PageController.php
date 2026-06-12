<?php

namespace App\Controllers\PublicSite;

use App\Models\PageModel;

class PageController extends BasePublicController
{
    public function about(): string
    {
        $page = model(PageModel::class)->findPublishedBySlug('tentang-kami');

        return $this->render('public/pages/show', [
            'item' => $page ?: ['title' => 'Tentang AnakKayu', 'body' => '<p>AnakKayu adalah studio mebel dan interior kayu yang menggabungkan craftmanship, material natural, dan desain modern classic.</p>'],
            'meta' => ['title' => 'Tentang AnakKayu.id'],
        ]);
    }
}
