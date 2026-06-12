<?php

namespace App\Services\SocialMedia;

use App\Models\SocialGeneratedContentModel;
use App\Models\SocialImportModel;

class SocialMediaImportService
{
    public function storeManualReference(array $data): int
    {
        $platform = $this->detectPlatform($data['source_url'] ?? '');
        $model = model(SocialImportModel::class);

        return (int) $model->insert([
            'platform'    => $data['platform'] ?: $platform,
            'source_url'  => $data['source_url'],
            'caption'     => $data['caption'] ?? null,
            'media_url'   => $data['media_url'] ?? null,
            'posted_at'   => $data['posted_at'] ?? null,
            'status'      => 'pending_review',
            'attribution' => $data['attribution'] ?? null,
            'raw_payload' => json_encode(['mode' => 'manual_reference'], JSON_THROW_ON_ERROR),
            'created_by'  => auth()->id(),
        ], true);
    }

    public function generateDraft(int $importId): int
    {
        $import = model(SocialImportModel::class)->find($importId);
        if (! $import) {
            throw new \RuntimeException('Social import tidak ditemukan.');
        }

        $draft = (new SocialContentGeneratorService())->generateDraft($import);
        $draft['social_import_id'] = $importId;

        return (int) model(SocialGeneratedContentModel::class)->insert($draft, true);
    }

    private function detectPlatform(string $url): string
    {
        return match (true) {
            str_contains($url, 'instagram.com') => 'instagram',
            str_contains($url, 'facebook.com') => 'facebook',
            str_contains($url, 'tiktok.com') => 'tiktok',
            str_contains($url, 'youtube.com'), str_contains($url, 'youtu.be') => 'youtube',
            default => 'other',
        };
    }
}
