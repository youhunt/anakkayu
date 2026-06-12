<?php

namespace App\Controllers\Admin;

class DashboardController extends BaseAdminController
{
    public function index(): string
    {
        $this->authorize('dashboard.view');

        $db = db_connect();
        $tables = ['contents', 'products', 'services', 'portfolios', 'inquiries', 'categories', 'social_imports'];
        $stats = [];

        foreach ($tables as $table) {
            $stats[$table] = $db->table($table)->countAllResults();
        }

        return $this->render('admin/dashboard/index', [
            'title' => 'Dashboard AnakKayu',
            'stats' => $stats,
            'latestInquiries' => $db->table('inquiries')->orderBy('created_at', 'DESC')->limit(5)->get()->getResultArray(),
            'latestSocial' => $db->table('social_imports')->orderBy('created_at', 'DESC')->limit(5)->get()->getResultArray(),
        ]);
    }
}
