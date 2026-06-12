<?php

namespace App\Controllers\PublicSite;

use App\Controllers\BaseController;
use App\Models\SettingModel;

abstract class BasePublicController extends BaseController
{
    protected function render(string $view, array $data = []): string
    {
        $data['settings'] = model(SettingModel::class)->allKeyed();
        $data['meta'] = ak_meta($data['meta'] ?? []);

        return view($view, $data);
    }
}
