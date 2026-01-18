<?php

namespace App\Http\Controllers;

use App\Models\MediaAsset;
use App\Models\Category;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MediaAsset::where('type', 'video')->latest();

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

        $videos = $query->paginate(12)->withQueryString();
        $categories = Category::all();

        return view('videos.index', compact('videos', 'categories'));
    }

    /**
     * Display the specified resource.
     */
    public function show(MediaAsset $video)
    {
        // Ensure we're only showing videos on this route
        if ($video->type !== 'video') {
            abort(404);
        }
        return view('videos.show', compact('video'));
    }

    /**
     * Display the embeddable video player for the specified resource.
     */
    public function embed(MediaAsset $video)
    {
        // Ensure we're only embedding videos
        if ($video->type !== 'video') {
            abort(404);
        }
        return view('videos.embed', compact('video'));
    }
}