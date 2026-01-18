<?php

namespace App\Services;

use Publitio\API as PublitioAPI;
use Exception;
use Illuminate\Support\Facades\Log;

class PublitioService
{
    protected PublitioAPI $client;
    protected string $brandedDomain = 'https://media.media.smartbrainskenya.com';

    public function __construct()
    {
        $key = config('services.publitio.key');
        $secret = config('services.publitio.secret');

        if (empty($key) || empty($secret)) {
            throw new Exception("Publitio credentials are missing in configuration.");
        }

        $this->client = new PublitioAPI($key, $secret);
    }

    /**
     * Upload a local file to Publitio using the SDK.
     *
     * @param string $filePath Absolute path to the local file.
     * @param array $options Additional options (title, description, tags, etc.)
     * @return array
     * @throws Exception
     */
    public function uploadFile(string $filePath, array $options = []): array
    {
        if (!file_exists($filePath)) {
            throw new Exception("File not found: {$filePath}");
        }

        // Open a stream to the file
        $fileHandle = fopen($filePath, 'r');
        if (!$fileHandle) {
            throw new Exception("Could not open file: {$filePath}");
        }

        try {
            // SDK handles multipart upload
            $response = $this->client->uploadFile($fileHandle, 'file', $options);
        } catch (Exception $e) {
            Log::error('Publitio SDK upload exception', ['error' => $e->getMessage()]);
            throw new Exception("Publitio upload failed: " . $e->getMessage());
        } finally {
            if (is_resource($fileHandle)) {
                fclose($fileHandle);
            }
        }

        return $this->handleResponse($response, 'Upload');
    }

    /**
     * Import a file from a remote URL (Import by Link).
     *
     * @param string $url The remote URL to fetch.
     * @param array $options Additional options (title, description, etc.)
     * @return array
     * @throws Exception
     */
    public function importByLink(string $url, array $options = []): array
    {
        try {
            // SDK handles remote upload (fetch and store)
            $response = $this->client->uploadRemoteFile($url, 'file', $options);
        } catch (Exception $e) {
            Log::error('Publitio SDK remote upload exception', ['error' => $e->getMessage(), 'url' => $url]);
            throw new Exception("Publitio remote upload failed: " . $e->getMessage());
        }

        return $this->handleResponse($response, 'Remote Upload');
    }

    /**
     * Delete a file from Publitio.
     *
     * @param string $publitioFileId The Publitio file ID (or public_id).
     * @return void
     * @throws Exception
     */
    public function deleteFile(string $publitioFileId): void
    {
        try {
            $response = $this->client->call("/files/delete/{$publitioFileId}", 'DELETE');
        } catch (Exception $e) {
            Log::error('Publitio SDK delete exception', ['error' => $e->getMessage(), 'id' => $publitioFileId]);
            throw new Exception("Publitio delete failed: " . $e->getMessage());
        }

        $this->handleResponse($response, 'Delete');
    }

    /**
     * Create a folder in Publitio.
     *
     * @param string $name Name of the folder
     * @param string|null $parentId Parent folder ID (optional)
     * @return array
     * @throws Exception
     */
    public function createFolder(string $name, ?string $parentId = null): array
    {
        $args = ['name' => $name];
        if ($parentId) {
            $args['parent_id'] = $parentId;
        }

        try {
            $response = $this->client->call('/folders/create', 'POST', $args);
        } catch (Exception $e) {
            Log::error('Publitio SDK create folder exception', ['error' => $e->getMessage(), 'name' => $name]);
            throw new Exception("Publitio create folder failed: " . $e->getMessage());
        }

        return $this->handleResponse($response, 'Create Folder');
    }

    /**
     * Create a player in Publitio.
     *
     * @param string $name Name of the player
     * @param array $options Additional player options (skin, ad_tag, etc.)
     * @return array
     * @throws Exception
     */
    public function createPlayer(string $name, array $options = []): array
    {
        $options['name'] = $name;

        try {
            $response = $this->client->call('/players/create', 'POST', $options);
        } catch (Exception $e) {
            Log::error('Publitio SDK create player exception', ['error' => $e->getMessage(), 'name' => $name]);
            throw new Exception("Publitio create player failed: " . $e->getMessage());
        }

        return $this->handleResponse($response, 'Create Player');
    }

    /**
     * Construct the canonical branded URL for a Publitio file.
     *
     * @param string $filename The filename returned by Publitio.
     * @return string
     */
    public function getBrandedUrl(string $filename): string
    {
        return "{$this->brandedDomain}/file/{$filename}";
    }

    /**
     * Normalize SDK response to array and check for API-level errors.
     *
     * @param object $response The raw response object from SDK.
     * @param string $actionName Context name for error messages.
     * @return array
     * @throws Exception
     */
    protected function handleResponse(object $response, string $actionName): array
    {
        // Convert stdClass to array deep
        $data = json_decode(json_encode($response), true);

        // Publitio typically returns 'success' => true/false and 'code' => 200/201 etc.
        // If 'success' is explicitly false, or if 'error' key exists.
        $success = $data['success'] ?? false;
        
        if (!$success) {
            $errorMessage = $data['error']['message'] ?? $data['message'] ?? 'Unknown API error';
            $code = $data['code'] ?? 0;
            
            Log::error("Publitio API error during {$actionName}", [
                'response' => $data
            ]);
            
            throw new Exception("Publitio {$actionName} failed ({$code}): {$errorMessage}");
        }

        // Standardize thumbnail URL
        $thumbnailSource = null;
        if (!empty($data['url_thumbnail'])) {
            $thumbnailSource = $data['url_thumbnail'];
        } elseif (!empty($data['url_poster'])) {
            $thumbnailSource = $data['url_poster'];
        } elseif (!empty($data['url_preview'])) {
            $thumbnailSource = $data['url_preview'];
        }

        if ($thumbnailSource) {
            // Ensure it uses the branded domain
            $path = parse_url($thumbnailSource, PHP_URL_PATH);
            $data['thumbnail_url'] = rtrim($this->brandedDomain, '/') . $path;
        } else {
            $data['thumbnail_url'] = null;
        }

        return $data;
    }
}
