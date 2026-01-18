<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaAsset;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAssets = MediaAsset::count();
        $totalImages = MediaAsset::where('type', 'image')->count();
        $totalVideos = MediaAsset::where('type', 'video')->count();
        $totalCategories = Category::count();

        // Placeholder for cloud-managed storage per latest specifications
        $totalStorageUsed = 'Cloud-managed (Publitio)';

        $recentUploads = MediaAsset::with('category')->latest()->take(10)->get();

        return view('dashboard', compact(
            'totalAssets', 
            'totalImages', 
            'totalVideos', 
            'totalCategories', 
            'totalStorageUsed', 
            'recentUploads'
        ));
    }
}
