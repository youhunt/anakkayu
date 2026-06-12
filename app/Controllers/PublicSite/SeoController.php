<?php

namespace App\Controllers\PublicSite;

class SeoController extends BasePublicController
{
    public function robots()
    {
        return $this->response->setContentType('text/plain')->setBody("User-agent: *\nAllow: /\nSitemap: " . base_url('sitemap.xml') . "\n");
    }

    public function sitemap()
    {
        $urls = [base_url(), base_url('artikel'), base_url('produk'), base_url('layanan'), base_url('portfolio'), base_url('kontak')];
        $body = view('public/sitemap', ['urls' => $urls]);

        return $this->response->setContentType('application/xml')->setBody($body);
    }
}
