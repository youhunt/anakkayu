<?php

namespace App\Controllers\PublicSite;

use App\Models\ServiceModel;

class ServiceController extends BasePublicController
{
    public function index(): string
    {
        $model = model(ServiceModel::class);
        return $this->render('public/services/index', [
            'items' => $model->where('status', 'published')->orderBy('is_featured', 'DESC')->paginate(12),
            'pager' => $model->pager,
            'title' => 'Layanan AnakKayu',
        ]);
    }

    public function show(string $slug): string
    {
        $item = model(ServiceModel::class)->findPublishedBySlug($slug);
        if (! $item) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->render('public/services/show', [
            'item' => $item,
            'share' => ak_share_links(current_url(), $item['service_name']),
            'wa' => ak_whatsapp_link('Halo AnakKayu, saya ingin konsultasi layanan ' . $item['service_name']),
            'meta' => ['title' => $item['meta_title'] ?: $item['service_name'], 'description' => $item['meta_description'] ?: $item['summary'], 'keywords' => $item['meta_keywords'] ?? '', 'image' => $item['og_image'] ?: ($item['featured_image'] ?: null)],
        ]);
    }
}
