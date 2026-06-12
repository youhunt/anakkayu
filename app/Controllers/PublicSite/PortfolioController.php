<?php

namespace App\Controllers\PublicSite;

use App\Models\PortfolioModel;

class PortfolioController extends BasePublicController
{
    public function index(): string
    {
        $model = model(PortfolioModel::class);
        return $this->render('public/portfolio/index', [
            'items' => $model->where('status', 'published')->orderBy('project_date', 'DESC')->paginate(12),
            'pager' => $model->pager,
            'title' => 'Portfolio AnakKayu',
        ]);
    }

    public function show(string $slug): string
    {
        $item = model(PortfolioModel::class)->findPublishedBySlug($slug);
        if (! $item) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->render('public/portfolio/show', [
            'item' => $item,
            'share' => ak_share_links(current_url(), $item['title']),
            'wa' => ak_whatsapp_link('Halo AnakKayu, saya tertarik membuat project seperti ' . $item['title']),
            'meta' => ['title' => $item['meta_title'] ?: $item['title'], 'description' => $item['meta_description'] ?: $item['summary'], 'keywords' => $item['meta_keywords'] ?? '', 'image' => $item['og_image'] ?: ($item['featured_image'] ?: null)],
        ]);
    }
}
