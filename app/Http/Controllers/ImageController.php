<?php

namespace App\Http\Controllers;

use App\Models\MediaAsset;
use App\Models\Category;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MediaAsset::where('type', 'image')->latest();

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('category', function ($cq) use ($search) {
                      $cq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $images = $query->paginate(12)->withQueryString();
        $categories = Category::all();

        return view('images.index', compact('images', 'categories'));
    }

    /**
     * Display the specified resource.
     */
    public function show(MediaAsset $image)
    {
        // Ensure we're only showing images on this route
        if ($image->type !== 'image') {
            abort(404);
        }
        return view('images.show', compact('image'));
    }
}