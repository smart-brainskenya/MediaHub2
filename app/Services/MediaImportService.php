<?php

namespace App\Services;

use App\Models\MediaAsset;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\File;
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
        $tempPath = tempnam(sys_get_temp_dir(), 'media_hub_import_');

        try {
            // 1. Download the file
            $response = Http::timeout(120)->sink($tempPath)->get($url);

            if ($response->failed()) {
                throw new Exception("Failed to download media from URL: {$url}");
            }

            $file = new File($tempPath);
            $mimeType = $file->getMimeType();

            // Validation
            if (!Str::startsWith($mimeType, $type)) {
                throw new Exception("Invalid file type: {$mimeType}. Expected {$type}.");
            }

            // 2. Upload to Publitio
            $publitioResponse = $this->publitioService->uploadFile($tempPath, [
                'title' => $name,
                'public_id' => Str::slug($name) . '-' . time(),
            ]);

            if (!isset($publitioResponse['success']) || !$publitioResponse['success']) {
                throw new Exception("Publitio upload failed: " . ($publitioResponse['message'] ?? 'Unknown error'));
            }

            $filename = $publitioResponse['file']['filename'] . '.' . $publitioResponse['file']['extension'];
            $canonicalUrl = $this->publitioService->getBrandedUrl($filename);

            // 3. Create MediaAsset record
            return MediaAsset::create([
                'publitio_id' => $publitioResponse['file']['id'],
                'name' => $name,
                'type' => $type,
                'file_path' => $canonicalUrl, // Database stores only the canonical public URL
                'mime_type' => $mimeType,
                'category_id' => $categoryId,
            ]);

        } catch (Exception $e) {
            Log::error('Media import failed', [
                'url' => $url,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        } finally {
            if (file_exists($tempPath)) {
                @unlink($tempPath);
            }
        }
    }
}
