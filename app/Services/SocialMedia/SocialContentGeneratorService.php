<?php

namespace App\Services\SocialMedia;

class SocialContentGeneratorService
{
    public function generateDraft(array $import): array
    {
        $caption = trim((string) ($import['caption'] ?? ''));
        $platform = ucfirst((string) ($import['platform'] ?? 'social media'));
        $firstSentence = preg_split('/(?<=[.!?])\s+/', $caption)[0] ?? $caption;
        $titleSeed = $firstSentence !== '' ? $firstSentence : 'Inspirasi Karya AnakKayu dari ' . $platform;
        $title = mb_strimwidth(strip_tags($titleSeed), 0, 78, '');
        $summary = mb_strimwidth(strip_tags($caption), 0, 150, '...');

        return [
            'draft_title'      => $title,
            'draft_summary'    => $summary ?: 'Draft konten dari referensi ' . $platform . ' yang perlu direview editor.',
            'meta_description' => mb_strimwidth($summary ?: $title, 0, 155, ''),
            'draft_body'       => $this->body($import, $title, $caption),
            'status'           => 'draft',
        ];
    }

    private function body(array $import, string $title, string $caption): string
    {
        $sourceUrl = esc($import['source_url'] ?? '#');
        $platform = esc(ucfirst((string) ($import['platform'] ?? 'social media')));
        $captionHtml = nl2br(esc($caption ?: 'Tambahkan narasi lengkap, konteks proyek, material, proses pengerjaan, dan CTA sebelum publish.'));

        return <<<HTML
<h2>{$title}</h2>
<p>{$captionHtml}</p>
<p><strong>Sumber referensi:</strong> <a href="{$sourceUrl}" rel="nofollow noopener" target="_blank">{$platform}</a></p>
<p><em>Catatan editor: konten ini dihasilkan sebagai draft. Pastikan hak penggunaan, atribusi, dan akurasi informasi sebelum dipublikasikan.</em></p>
HTML;
    }
}
