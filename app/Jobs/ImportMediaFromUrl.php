<?php

namespace App\Jobs;

use App\Models\MediaAsset;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Queueable;
use Illuminate\Foundation\Queue\Queueable as FoundationQueueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImportMediaFromUrl implements ShouldQueue
{
    use FoundationQueueable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $url;
    protected string $name;
    protected string $type;

    /**
     * Create a new job instance.
     */
    public function __construct(string $url, string $name, string $type)
    {
        $this->url = $url;
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $response = Http::get($this->url);

        if ($response->failed()) {
            // Optional: Add notification for the user about the failure
            return;
        }

        $fileContents = $response->body();
        $originalFileName = basename(parse_url($this->url, PHP_URL_PATH));
        $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $mimeType = $response->header('Content-Type');

        // Basic validation based on type
        if (!Str::startsWith($mimeType, $this->type)) {
            // Optional: Add notification for the user about the failure
            return;
        }

        $slug = Str::slug($this->name);
        $fileName = $slug . '-' . time() . '.' . $extension;

        $disk = $this->type === 'image' ? 'media_images' : 'media_videos';

        // Specific processing for images
        if ($this->type === 'image') {
            $img = Image::make($fileContents);
            $fileContents = (string) $img->encode($extension, 75);
            $mimeType = $img->mime();
        }

        Storage::disk($disk)->put($fileName, $fileContents);

        MediaAsset::create([
            'name' => $this->name,
            'type' => $this->type,
            'file_path' => $fileName,
            'mime_type' => $mimeType,
        ]);
    }
}
