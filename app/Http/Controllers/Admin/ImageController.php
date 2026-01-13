<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMediaAssetRequest;
use App\Models\MediaAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = MediaAsset::where('type', 'image')->latest()->get();

        return view('admin.images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.images.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMediaAssetRequest $request)
    {
        $file = $request->file('file');
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        // Generate a unique, URL-friendly filename
        $slug = Str::slug($request->input('name', $originalName));
        $extension = $file->getClientOriginalExtension();
        $fileName = $slug . '-' . time() . '.' . $extension;

        // Store the file directly using Laravel's filesystem
        $path = $file->storeAs('', $fileName, 'media_images');

        // Create the database record
        MediaAsset::create([
            'name' => $request->input('name'),
            'type' => 'image',
            'file_path' => $path,
            'mime_type' => $file->getMimeType(),
        ]);

        return redirect()->route('admin.images.index')->with('success', 'Image uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MediaAsset $image)
    {
        return view('admin.images.show', compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MediaAsset $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MediaAsset $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MediaAsset $image)
    {
        // Ensure it's an image being deleted by this controller
        if ($image->type !== 'image') {
            return back()->with('error', 'Invalid asset type.');
        }

        // Delete the file from storage
        Storage::disk('media_images')->delete($image->file_path);

        // Delete the database record
        $image->delete();

        return redirect()->route('admin.images.index')->with('success', 'Image deleted successfully.');
    }
}
