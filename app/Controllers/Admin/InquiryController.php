<?php

namespace App\Controllers\Admin;

use App\Models\InquiryModel;

class InquiryController extends BaseAdminController
{
    public function index(): string
    {
        $model = model(InquiryModel::class);

        return $this->render('admin/inquiries/index', [
            'title' => 'Inquiry',
            'items' => $model->orderBy('created_at', 'DESC')->paginate(15),
            'pager' => $model->pager,
        ]);
    }

    public function update(int $id)
    {
        model(InquiryModel::class)->update($id, [
            'status' => $this->request->getPost('status'),
            'admin_notes' => $this->request->getPost('admin_notes'),
        ]);

        return redirect()->to('/admin/inquiries')->with('message', 'Inquiry diperbarui.');
    }
}
