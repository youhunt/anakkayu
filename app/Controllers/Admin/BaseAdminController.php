<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Shield\Authorization\AuthorizationException;

abstract class BaseAdminController extends BaseController
{
    protected function authorize(string $permission): void
    {
        $user = auth()->user();

        if ($user?->inGroup('superadmin') || $user?->can($permission)) {
            return;
        }

        throw AuthorizationException::forUnauthorized();
    }

    protected function render(string $view, array $data = []): string
    {
        $data['title'] ??= 'Dashboard';
        $data['user'] = auth()->user();

        return view($view, $data);
    }
}
