<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAssets = MediaAsset::count();

        $imageSize = collect(Storage::disk('media_images')->allFiles())->sum(function ($file) {
            return Storage::disk('media_images')->size($file);
        });

        $videoSize = collect(Storage::disk('media_videos')->allFiles())->sum(function ($file) {
            return Storage::disk('media_videos')->size($file);
        });

        $totalStorageUsed = $this->formatBytes($imageSize + $videoSize);

        $recentUploads = MediaAsset::latest()->take(5)->get();

        return view('dashboard', compact('totalAssets', 'totalStorageUsed', 'recentUploads'));
    }

    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
