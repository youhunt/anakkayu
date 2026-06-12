<?php

namespace App\Controllers\Admin;

use App\Models\SettingModel;

class SettingsController extends BaseAdminController
{
    public function index()
    {
        $model = model(SettingModel::class);

        if ($this->request->getMethod() === 'POST') {
            foreach ($this->request->getPost('settings') ?? [] as $key => $value) {
                $existing = $model->where('setting_key', $key)->first();
                $payload = ['setting_key' => $key, 'setting_value' => $value, 'type' => 'text', 'group_name' => 'general'];
                $existing ? $model->update($existing['id'], $payload) : $model->insert($payload);
            }

            return redirect()->to('/admin/settings')->with('message', 'Pengaturan disimpan.');
        }

        return $this->render('admin/settings/index', ['title' => 'Settings', 'settings' => $model->allKeyed()]);
    }
}
