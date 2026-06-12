<?php

namespace App\Controllers\PublicSite;

use App\Models\InquiryModel;

class ContactController extends BasePublicController
{
    public function index(): string
    {
        return $this->render('public/contact/index', ['title' => 'Kontak AnakKayu']);
    }

    public function inquiry(): string
    {
        return $this->index();
    }

    public function submit()
    {
        $rules = [
            'name' => 'required|max_length[140]',
            'email' => 'permit_empty|valid_email|max_length[180]',
            'phone' => 'permit_empty|max_length[40]',
            'subject' => 'required|max_length[180]',
            'message' => 'required|min_length[10]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        model(InquiryModel::class)->insert($this->request->getPost(array_keys($rules)) + [
            'source_type' => $this->request->getPost('source_type'),
            'source_id' => $this->request->getPost('source_id'),
            'status' => 'new',
        ]);

        return redirect()->to('/kontak')->with('message', 'Inquiry Anda sudah kami terima. Tim AnakKayu akan menghubungi Anda.');
    }
}
