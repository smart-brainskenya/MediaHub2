<?php

namespace App\Http\Controllers;

use App\Models\MediaAsset;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = MediaAsset::where('type', 'image')->latest()->get();
        return view('images.index', compact('images'));
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
