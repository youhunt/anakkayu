<?php

namespace App\Controllers\PublicSite;

use App\Models\ProductModel;

class ProductController extends BasePublicController
{
    public function index(): string
    {
        $model = model(ProductModel::class);
        return $this->render('public/products/index', [
            'items' => $model->where('status', 'published')->orderBy('is_featured', 'DESC')->paginate(12),
            'pager' => $model->pager,
            'title' => 'Katalog Produk',
        ]);
    }

    public function show(string $slug): string
    {
        $item = model(ProductModel::class)->findPublishedBySlug($slug);
        if (! $item) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->render('public/products/show', [
            'item' => $item,
            'share' => ak_share_links(current_url(), $item['product_name']),
            'wa' => ak_whatsapp_link('Halo AnakKayu, saya ingin inquiry produk ' . $item['product_name']),
            'meta' => ['title' => $item['meta_title'] ?: $item['product_name'], 'description' => $item['meta_description'] ?: $item['summary'], 'keywords' => $item['meta_keywords'] ?? '', 'image' => $item['og_image'] ?: ($item['featured_image'] ?: null), 'type' => 'product'],
        ]);
    }
}
