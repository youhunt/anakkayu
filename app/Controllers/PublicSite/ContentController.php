<?php

namespace App\Controllers\PublicSite;

use App\Models\ContentModel;

class ContentController extends BasePublicController
{
    public function index(): string
    {
        return $this->render('public/content/index', [
            'items' => model(ContentModel::class)->where('status', 'published')->orderBy('published_at', 'DESC')->paginate(9),
            'pager' => model(ContentModel::class)->pager,
            'title' => 'Artikel AnakKayu',
        ]);
    }

    public function show(string $slug): string
    {
        $item = model(ContentModel::class)->findPublishedBySlug($slug);
        if (! $item) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->render('public/content/show', [
            'item' => $item,
            'share' => ak_share_links(current_url(), $item['title']),
            'meta' => ['title' => $item['meta_title'] ?: $item['title'], 'description' => $item['meta_description'] ?: $item['summary'], 'keywords' => $item['meta_keywords'] ?? '', 'image' => $item['og_image'] ?: ak_content_image($item), 'type' => 'article'],
        ]);
    }
}
