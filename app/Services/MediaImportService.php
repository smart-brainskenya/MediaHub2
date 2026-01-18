<?php

namespace App\Services;

use App\Models\MediaAsset;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Log;

class MediaImportService
{
    public function __construct(
        protected PublitioService $publitioService
    ) {}

    /**
     * Import media from a URL.
     *
     * @param string $url The public URL of the media.
     * @param string $name The display name for the asset.
     * @param string $type The media type ('image' or 'video').
     * @param int|null $categoryId The category ID.
     * @return MediaAsset
     * @throws Exception
     */
    public function importFromUrl(string $url, string $name, string $type, ?int $categoryId = null): MediaAsset
    {
        try {
            // 1. Upload to Publitio using Remote Upload (Import by Link)
            $publitioResponse = $this->publitioService->importByLink($url, [
                'title' => $name,
                'public_id' => Str::slug($name) . '-' . time(),
            ]);

            if (!isset($publitioResponse['success']) || !$publitioResponse['success']) {
                throw new Exception("Publitio upload failed: " . ($publitioResponse['message'] ?? 'Unknown error'));
            }

            $filename = $publitioResponse['public_id'] . '.' . $publitioResponse['extension'];
            $canonicalUrl = $this->publitioService->getBrandedUrl($filename);

            // 2. Create MediaAsset record
            return MediaAsset::create([
                'publitio_id' => $publitioResponse['id'],
                'name' => $name,
                'type' => $type,
                'file_path' => $canonicalUrl,
                'thumbnail_url' => $publitioResponse['thumbnail_url'] ?? null,
                'mime_type' => $type === 'image' ? 'image/' . $publitioResponse['extension'] : 'video/' . $publitioResponse['extension'], // Best guess from extension
                'category_id' => $categoryId,
            ]);

        } catch (Exception $e) {
            Log::error('Media import failed', [
                'url' => $url,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }
}
