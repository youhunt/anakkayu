<?php

namespace App\Controllers\PublicSite;

class ShareController extends BasePublicController
{
    public function log()
    {
        db_connect()->table('share_logs')->insert([
            'shareable_type' => $this->request->getPost('type'),
            'shareable_id' => (int) $this->request->getPost('id'),
            'platform' => $this->request->getPost('platform'),
            'ip_hash' => hash('sha256', (string) $this->request->getIPAddress()),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return $this->response->setJSON(['ok' => true]);
    }
}
