<?php

namespace App\Jobs;

use App\Services\MediaImportService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

class ImportMediaFromUrl implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected string $url,
        protected string $name,
        protected string $type,
        protected ?int $categoryId = null
    ) {}

    /**
     * Execute the job.
     */
    public function handle(MediaImportService $importService): void
    {
        $importService->importFromUrl(
            $this->url,
            $this->name,
            $this->type,
            $this->categoryId
        );
    }
}