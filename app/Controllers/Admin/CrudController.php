<?php

namespace App\Controllers\Admin;

use App\Models\CategoryModel;
use App\Models\ContentModel;
use App\Models\PageModel;
use App\Models\PortfolioModel;
use App\Models\ProductModel;
use App\Models\ServiceModel;
use App\Models\TagModel;

class CrudController extends BaseAdminController
{
    private array $modules = [
        'content' => ['title' => 'Konten', 'route' => 'contents', 'model' => ContentModel::class, 'table' => 'contents', 'name' => 'title', 'category_type' => 'content', 'tag_pivot' => 'content_tags', 'tag_key' => 'content_id', 'fields' => ['title', 'summary', 'body', 'category_id', 'featured_image', 'status', 'is_featured', 'published_at', 'meta_title', 'meta_description', 'meta_keywords', 'og_image']],
        'page' => ['title' => 'Halaman', 'route' => 'pages', 'model' => PageModel::class, 'table' => 'pages', 'name' => 'title', 'fields' => ['title', 'body', 'featured_image', 'template_type', 'status', 'meta_title', 'meta_description', 'meta_keywords', 'og_image']],
        'product' => ['title' => 'Produk', 'route' => 'products', 'model' => ProductModel::class, 'table' => 'products', 'name' => 'product_name', 'category_type' => 'product', 'tag_pivot' => 'product_tags', 'tag_key' => 'product_id', 'fields' => ['product_name', 'summary', 'description', 'category_id', 'price', 'price_display_type', 'discount_price', 'sku', 'stock_status', 'featured_image', 'gallery', 'material', 'size', 'finishing', 'is_custom_available', 'is_featured', 'status', 'meta_title', 'meta_description', 'meta_keywords', 'og_image']],
        'service' => ['title' => 'Layanan', 'route' => 'services', 'model' => ServiceModel::class, 'table' => 'services', 'name' => 'service_name', 'category_type' => 'service', 'tag_pivot' => 'service_tags', 'tag_key' => 'service_id', 'fields' => ['service_name', 'summary', 'description', 'category_id', 'estimated_price', 'featured_image', 'benefits', 'process_steps', 'is_featured', 'status', 'meta_title', 'meta_description', 'meta_keywords', 'og_image']],
        'portfolio' => ['title' => 'Portfolio', 'route' => 'portfolio', 'model' => PortfolioModel::class, 'table' => 'portfolios', 'name' => 'title', 'category_type' => 'portfolio', 'tag_pivot' => 'portfolio_tags', 'tag_key' => 'portfolio_id', 'fields' => ['title', 'summary', 'description', 'category_id', 'client_name', 'location', 'project_date', 'featured_image', 'gallery', 'is_featured', 'status', 'meta_title', 'meta_description', 'meta_keywords', 'og_image']],
        'category' => ['title' => 'Kategori', 'route' => 'categories', 'model' => CategoryModel::class, 'table' => 'categories', 'name' => 'name', 'fields' => ['type', 'name', 'description', 'meta_title', 'meta_description', 'meta_keywords']],
        'tag' => ['title' => 'Tag', 'route' => 'tags', 'model' => TagModel::class, 'table' => 'tags', 'name' => 'name', 'fields' => ['name', 'meta_title', 'meta_description', 'meta_keywords']],
    ];

    public function index(string $module): string
    {
        $config = $this->module($module);
        $model = model($config['model']);

        return $this->render('admin/crud/index', [
            'title' => $config['title'],
            'module' => $module,
            'config' => $config,
            'items' => $model->orderBy('created_at', 'DESC')->paginate(15),
            'pager' => $model->pager,
        ]);
    }

    public function new(string $module)
    {
        return $this->save($module);
    }

    public function edit(string $module, int $id)
    {
        return $this->save($module, $id);
    }

    public function delete(string $module, int $id)
    {
        $config = $this->module($module);
        model($config['model'])->delete($id);

        return redirect()->to('/admin/' . $config['route'])->with('message', $config['title'] . ' dihapus.');
    }

    private function save(string $module, ?int $id = null)
    {
        $config = $this->module($module);
        $model = model($config['model']);
        $item = $id ? $model->find($id) : [];

        if ($this->request->getMethod() === 'POST') {
            $payload = $this->request->getPost($config['fields']);
            $payload = $this->normalizePayload($payload, $config);
            $payload['slug'] = ak_unique_slug($payload[$config['name']] ?? 'item', $config['table'], $id);
            if ($module === 'content' && ($payload['status'] ?? null) === 'published') {
                $payload['published_at'] = $payload['published_at'] ?: date('Y-m-d H:i:s');
            }
            $payload[$id ? 'updated_by' : 'created_by'] = auth()->id();

            if ($id) {
                $model->update($id, $payload);
                $savedId = $id;
            } else {
                $savedId = (int) $model->insert($payload, true);
            }

            $this->syncTags($config, $savedId, $this->request->getPost('tag_ids') ?? []);

            return redirect()->to('/admin/' . $config['route'])->with('message', $config['title'] . ' berhasil disimpan.');
        }

        $item = $this->expandJsonFields($item);

        return $this->render('admin/crud/form', [
            'title' => ($id ? 'Edit ' : 'Tambah ') . $config['title'],
            'module' => $module,
            'config' => $config,
            'item' => $item,
            'categories' => $this->categories($config),
            'tags' => model(TagModel::class)->orderBy('name', 'ASC')->findAll(),
            'selectedTags' => $id ? $this->selectedTags($config, $id) : [],
        ]);
    }

    private function module(string $module): array
    {
        if (! isset($this->modules[$module])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Modul admin tidak ditemukan.');
        }

        return $this->modules[$module];
    }

    private function categories(array $config): array
    {
        if (! isset($config['category_type'])) {
            return [];
        }

        return model(CategoryModel::class)
            ->where('type', $config['category_type'])
            ->orderBy('name', 'ASC')
            ->findAll();
    }

    private function normalizePayload(array $payload, array $config): array
    {
        foreach (['gallery', 'benefits', 'process_steps'] as $field) {
            if (array_key_exists($field, $payload)) {
                $payload[$field] = json_encode($this->listFromText((string) $payload[$field]), JSON_THROW_ON_ERROR);
            }
        }

        foreach (['is_featured', 'is_custom_available'] as $field) {
            if (array_key_exists($field, $payload)) {
                $payload[$field] = (int) $payload[$field];
            }
        }

        foreach (['price', 'discount_price'] as $field) {
            if (array_key_exists($field, $payload) && $payload[$field] === '') {
                $payload[$field] = null;
            }
        }

        if (! empty($payload['published_at'])) {
            $payload['published_at'] = str_replace('T', ' ', (string) $payload['published_at']);
        }

        if (! empty($payload['featured_image']) && empty($payload['og_image'])) {
            $payload['og_image'] = $payload['featured_image'];
        }

        return $payload;
    }

    private function expandJsonFields(array $item): array
    {
        foreach (['gallery', 'benefits', 'process_steps'] as $field) {
            if (! empty($item[$field])) {
                $decoded = json_decode($item[$field], true);
                if (is_array($decoded)) {
                    $item[$field] = implode(PHP_EOL, $decoded);
                }
            }
        }

        return $item;
    }

    private function listFromText(string $value): array
    {
        return array_values(array_filter(array_map(
            static fn (string $line): string => trim($line),
            preg_split('/\r\n|\r|\n|,/', $value) ?: []
        )));
    }

    private function syncTags(array $config, int $id, array $tagIds): void
    {
        if (! isset($config['tag_pivot'], $config['tag_key'])) {
            return;
        }

        $db = db_connect();
        $db->table($config['tag_pivot'])->where($config['tag_key'], $id)->delete();

        foreach (array_filter(array_map('intval', $tagIds)) as $tagId) {
            $db->table($config['tag_pivot'])->insert([
                $config['tag_key'] => $id,
                'tag_id' => $tagId,
            ]);
        }
    }

    private function selectedTags(array $config, int $id): array
    {
        if (! isset($config['tag_pivot'], $config['tag_key'])) {
            return [];
        }

        return array_map('intval', array_column(
            db_connect()->table($config['tag_pivot'])->select('tag_id')->where($config['tag_key'], $id)->get()->getResultArray(),
            'tag_id'
        ));
    }
}
