<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

abstract class BaseAdminController extends BaseController
{
    protected function render(string $view, array $data = []): string
    {
        $data['title'] ??= 'Dashboard';
        $data['user'] = auth()->user();

        return view($view, $data);
    }
}
