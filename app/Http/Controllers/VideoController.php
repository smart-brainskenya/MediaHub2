<?php

namespace App\Http\Controllers;

use App\Models\MediaAsset;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = MediaAsset::where('type', 'video')->latest()->get();
        return view('videos.index', compact('videos'));
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
