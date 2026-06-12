<?php

namespace App\Controllers\Admin;

use App\Models\SocialGeneratedContentModel;
use App\Models\SocialImportModel;
use App\Services\SocialMedia\SocialMediaImportService;

class SocialContentController extends BaseAdminController
{
    public function index(): string
    {
        $model = model(SocialImportModel::class);

        return $this->render('admin/social/index', [
            'title' => 'Social Content',
            'items' => $model->orderBy('created_at', 'DESC')->paginate(15),
            'drafts' => model(SocialGeneratedContentModel::class)->orderBy('created_at', 'DESC')->findAll(10),
            'pager' => $model->pager,
        ]);
    }

    public function import()
    {
        if ($this->request->getMethod() === 'POST') {
            $rules = ['source_url' => 'required|valid_url_strict', 'platform' => 'permit_empty|max_length[60]', 'caption' => 'permit_empty'];
            if (! $this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            (new SocialMediaImportService())->storeManualReference($this->request->getPost());

            return redirect()->to('/admin/social-content')->with('message', 'Referensi sosial media disimpan untuk review.');
        }

        return $this->render('admin/social/form', ['title' => 'Import Social Content']);
    }

    public function draft(int $id)
    {
        (new SocialMediaImportService())->generateDraft($id);

        return redirect()->to('/admin/social-content')->with('message', 'Draft konten berhasil dibuat. Review sebelum publish.');
    }
}
