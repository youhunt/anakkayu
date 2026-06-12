<?php

namespace App\Services\SocialMedia;

use App\Models\ContentModel;
use App\Models\SocialGeneratedContentModel;
use App\Models\SocialImportModel;

class SocialMediaImportService
{
    public function storeManualReference(array $data): int
    {
        $platform = $this->detectPlatform($data['source_url'] ?? '');
        $metadata = $this->fetchMetadata((string) ($data['source_url'] ?? ''), $platform);
        $model = model(SocialImportModel::class);

        return (int) $model->insert([
            'platform'    => $data['platform'] ?: $platform,
            'source_url'  => $data['source_url'],
            'caption'     => $data['caption'] ?: ($metadata['caption'] ?? null),
            'media_url'   => $data['media_url'] ?: ($metadata['media_url'] ?? null),
            'posted_at'   => $data['posted_at'] ?? null,
            'status'      => 'pending_review',
            'attribution' => $data['attribution'] ?? null,
            'raw_payload' => json_encode([
                'mode' => 'manual_reference',
                'metadata' => $metadata,
            ], JSON_THROW_ON_ERROR),
            'created_by'  => auth()->id(),
        ], true);
    }

    public function refreshMetadata(int $importId): void
    {
        $model = model(SocialImportModel::class);
        $import = $model->find($importId);
        if (! $import) {
            throw new \RuntimeException('Social import tidak ditemukan.');
        }

        $metadata = $this->fetchMetadata((string) $import['source_url'], (string) $import['platform']);
        $payload = [
            'raw_payload' => json_encode([
                'mode' => 'metadata_refresh',
                'metadata' => $metadata,
                'previous' => json_decode((string) ($import['raw_payload'] ?? '{}'), true),
            ], JSON_THROW_ON_ERROR),
        ];

        if (empty($import['caption']) && ! empty($metadata['caption'])) {
            $payload['caption'] = $metadata['caption'];
        }

        if (empty($import['media_url']) && ! empty($metadata['media_url'])) {
            $payload['media_url'] = $metadata['media_url'];
        }

        $model->update($importId, $payload);

        if (! empty($payload['media_url'])) {
            $this->syncConvertedContentsImage($importId, $payload['media_url']);
        }
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

    public function convertGeneratedDraftToContent(int $generatedId): int
    {
        $generatedModel = model(SocialGeneratedContentModel::class);
        $generated = $generatedModel->find($generatedId);
        if (! $generated) {
            throw new \RuntimeException('Draft social content tidak ditemukan.');
        }

        $import = model(SocialImportModel::class)->find((int) $generated['social_import_id']);
        if (! empty($generated['content_id'])) {
            $this->syncContentImage((int) $generated['content_id'], $import['media_url'] ?? null);

            return (int) $generated['content_id'];
        }

        $title = trim((string) $generated['draft_title']);
        $contentId = (int) model(ContentModel::class)->insert([
            'title'            => $title,
            'slug'             => ak_unique_slug($title, 'contents'),
            'summary'          => $generated['draft_summary'],
            'body'             => $generated['draft_body'],
            'featured_image'   => $import['media_url'] ?? null,
            'status'           => 'draft',
            'is_featured'      => 0,
            'meta_title'       => $title,
            'meta_description' => $generated['meta_description'],
            'og_image'         => $import['media_url'] ?? null,
            'created_by'       => auth()->id(),
        ], true);

        $generatedModel->update($generatedId, [
            'content_id' => $contentId,
            'status' => 'converted',
        ]);

        return $contentId;
    }

    private function syncConvertedContentsImage(int $importId, string $mediaUrl): void
    {
        $drafts = model(SocialGeneratedContentModel::class)
            ->where('social_import_id', $importId)
            ->where('content_id IS NOT NULL', null, false)
            ->findAll();

        foreach ($drafts as $draft) {
            $this->syncContentImage((int) $draft['content_id'], $mediaUrl);
        }
    }

    private function syncContentImage(int $contentId, ?string $mediaUrl): void
    {
        if (! $mediaUrl) {
            return;
        }

        $contentModel = model(ContentModel::class);
        $content = $contentModel->find($contentId);
        if (! $content) {
            return;
        }

        $payload = [];
        if (empty($content['featured_image'])) {
            $payload['featured_image'] = $mediaUrl;
        }
        if (empty($content['og_image'])) {
            $payload['og_image'] = $mediaUrl;
        }

        if ($payload !== []) {
            $payload['updated_by'] = auth()->id();
            $contentModel->update($contentId, $payload);
        }
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

    private function fetchMetadata(string $url, string $platform): array
    {
        if (! filter_var($url, FILTER_VALIDATE_URL)) {
            return ['status' => 'skipped', 'message' => 'URL tidak valid.'];
        }

        $official = $this->fetchOEmbedMetadata($url, $platform);
        if (! empty($official['media_url'])) {
            return $official;
        }

        $fallback = $this->fetchPublicOpenGraphMetadata($url);
        if (! empty($fallback['media_url'])) {
            return $fallback + ['official' => $official];
        }

        return $official ?: $fallback ?: [
            'status' => 'unavailable',
            'message' => 'Metadata tidak tersedia. Isi Media URL manual atau konfigurasi token oEmbed resmi.',
        ];
    }

    private function fetchOEmbedMetadata(string $url, string $platform): array
    {
        if (! in_array($platform, ['instagram', 'facebook'], true)) {
            return ['status' => 'skipped', 'provider' => 'oembed', 'message' => 'Platform belum didukung oEmbed.'];
        }

        $accessToken = env('META_OEMBED_ACCESS_TOKEN') ?: env('INSTAGRAM_ACCESS_TOKEN') ?: env('FACEBOOK_ACCESS_TOKEN');
        if (! $accessToken) {
            return ['status' => 'skipped', 'provider' => 'oembed', 'message' => 'META_OEMBED_ACCESS_TOKEN belum dikonfigurasi.'];
        }

        $version = trim((string) env('META_GRAPH_VERSION', 'v23.0'), '/');
        $endpoint = $platform === 'instagram'
            ? 'https://graph.facebook.com/' . $version . '/instagram_oembed'
            : 'https://graph.facebook.com/' . $version . '/oembed_post';

        try {
            $response = service('curlrequest')->get($endpoint, [
                'query' => [
                    'url' => $url,
                    'access_token' => $accessToken,
                    'omitscript' => true,
                ],
                'timeout' => 8,
                'http_errors' => false,
            ]);

            $payload = json_decode($response->getBody(), true) ?: [];
            if ($response->getStatusCode() >= 400) {
                return [
                    'status' => 'failed',
                    'provider' => 'oembed',
                    'http_status' => $response->getStatusCode(),
                    'message' => $payload['error']['message'] ?? 'oEmbed gagal.',
                ];
            }

            return [
                'status' => 'ok',
                'provider' => 'oembed',
                'caption' => $payload['title'] ?? null,
                'media_url' => $payload['thumbnail_url'] ?? null,
                'author_name' => $payload['author_name'] ?? null,
                'html' => $payload['html'] ?? null,
                'raw' => $payload,
            ];
        } catch (\Throwable $e) {
            return [
                'status' => 'failed',
                'provider' => 'oembed',
                'message' => $e->getMessage(),
            ];
        }
    }

    private function fetchPublicOpenGraphMetadata(string $url): array
    {
        try {
            $response = service('curlrequest')->get($url, [
                'headers' => [
                    'User-Agent' => 'AnakKayuBot/1.0 (+https://anakkayu.id)',
                    'Accept' => 'text/html,application/xhtml+xml',
                ],
                'timeout' => 8,
                'http_errors' => false,
            ]);

            if ($response->getStatusCode() >= 400) {
                return [
                    'status' => 'failed',
                    'provider' => 'public_open_graph',
                    'http_status' => $response->getStatusCode(),
                ];
            }

            $html = $response->getBody();

            return [
                'status' => 'ok',
                'provider' => 'public_open_graph',
                'caption' => $this->metaContent($html, 'og:title') ?: $this->metaContent($html, 'twitter:title'),
                'media_url' => $this->metaContent($html, 'og:image') ?: $this->metaContent($html, 'twitter:image'),
            ];
        } catch (\Throwable $e) {
            return [
                'status' => 'failed',
                'provider' => 'public_open_graph',
                'message' => $e->getMessage(),
            ];
        }
    }

    private function metaContent(string $html, string $property): ?string
    {
        $quoted = preg_quote($property, '/');
        foreach ([
            '/<meta\s+(?:property|name)=["\']' . $quoted . '["\']\s+content=["\']([^"\']+)["\']/i',
            '/<meta\s+content=["\']([^"\']+)["\']\s+(?:property|name)=["\']' . $quoted . '["\']/i',
        ] as $pattern) {
            if (preg_match($pattern, $html, $matches)) {
                return html_entity_decode($matches[1], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            }
        }

        return null;
    }
}
