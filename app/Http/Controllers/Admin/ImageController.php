<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMediaAssetRequest;
use App\Models\MediaAsset;
use App\Models\Category;
use App\Services\PublitioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;

class ImageController extends Controller
{
    public function __construct(
        protected PublitioService $publitioService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = MediaAsset::where('type', 'image')->with('category')->latest()->get();

        return view('admin.images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.images.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMediaAssetRequest $request)
    {
        $file = $request->file('file');

        try {
            $publitioResponse = $this->publitioService->uploadFile($file->getRealPath(), [
                'title' => $request->input('name'),
                'public_id' => Str::slug($request->input('name')) . '-' . time(),
            ]);

            if (!isset($publitioResponse['success']) || !$publitioResponse['success']) {
                throw new Exception("Publitio upload failed: " . ($publitioResponse['message'] ?? 'Unknown error'));
            }

            $filename = $publitioResponse['public_id'] . '.' . $publitioResponse['extension'];
            $canonicalUrl = $this->publitioService->getBrandedUrl($filename);

            // Create the database record
            MediaAsset::create([
                'publitio_id' => $publitioResponse['id'],
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'type' => 'image',
                'file_path' => $canonicalUrl,
                'thumbnail_url' => $publitioResponse['thumbnail_url'] ?? null,
                'mime_type' => $file->getMimeType(),
                'category_id' => $request->input('category_id'),
            ]);

            return redirect()->route('admin.images.index')->with('success', 'Image uploaded successfully to Publitio.');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Upload failed: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MediaAsset $image)
    {
        return view('admin.images.show', compact('image'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MediaAsset $image)
    {
        if ($image->type !== 'image') {
            return back()->with('error', 'Invalid asset type.');
        }

        try {
            if ($image->publitio_id) {
                $this->publitioService->deleteFile($image->publitio_id);
            } else {
                // Fallback for older local files if they still exist
                Storage::disk('media_images')->delete($image->file_path);
            }

            $image->delete();

            return redirect()->route('admin.images.index')->with('success', 'Image deleted successfully.');
        } catch (Exception $e) {
            // Delete record anyway if it's already gone from Publitio or if we want to force it
            $image->delete();
            return redirect()->route('admin.images.index')->with('success', 'Image record removed (Publitio deletion may have failed or was already done).');
        }
    }
}