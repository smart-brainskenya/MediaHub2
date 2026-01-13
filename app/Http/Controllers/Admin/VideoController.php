<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMediaAssetRequest;
use App\Models\MediaAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = MediaAsset::where('type', 'video')->latest()->get();

        return view('admin.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.videos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMediaAssetRequest $request)
    {
        $file = $request->file('file');
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();

        // Generate a unique, URL-friendly filename
        $slug = Str::slug($request->input('name', $originalName));
        $fileName = $slug . '-' . time() . '.' . $extension;

        // Store the file
        $path = $file->storeAs('', $fileName, 'media_videos');

        // Create the database record
        MediaAsset::create([
            'name' => $request->input('name'),
            'type' => 'video',
            'file_path' => $path,
            'mime_type' => $file->getMimeType(),
        ]);

        return redirect()->route('admin.videos.index')->with('success', 'Video uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MediaAsset $video)
    {
        return view('admin.videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MediaAsset $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MediaAsset $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MediaAsset $video)
    {
        // Ensure it's a video being deleted by this controller
        if ($video->type !== 'video') {
            return back()->with('error', 'Invalid asset type.');
        }

        // Delete the file from storage
        Storage::disk('media_videos')->delete($video->file_path);

        // Delete the database record
        $video->delete();

        return redirect()->route('admin.videos.index')->with('success', 'Video deleted successfully.');
    }
}
