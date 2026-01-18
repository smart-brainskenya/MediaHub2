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

class VideoController extends Controller
{
    public function __construct(
        protected PublitioService $publitioService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = MediaAsset::where('type', 'video')->with('category')->latest()->get();

        return view('admin.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.videos.create', compact('categories'));
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
                'type' => 'video',
                'file_path' => $canonicalUrl,
                'thumbnail_url' => $publitioResponse['thumbnail_url'] ?? null,
                'mime_type' => $file->getMimeType(),
                'category_id' => $request->input('category_id'),
            ]);

            return redirect()->route('admin.videos.index')->with('success', 'Video uploaded successfully to Publitio.');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Upload failed: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MediaAsset $video)
    {
        return view('admin.videos.show', compact('video'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MediaAsset $video)
    {
        if ($video->type !== 'video') {
            return back()->with('error', 'Invalid asset type.');
        }

        try {
            if ($video->publitio_id) {
                $this->publitioService->deleteFile($video->publitio_id);
            } else {
                // Fallback for older local files
                Storage::disk('media_videos')->delete($video->file_path);
            }

            $video->delete();

            return redirect()->route('admin.videos.index')->with('success', 'Video deleted successfully.');
        } catch (Exception $e) {
            $video->delete();
            return redirect()->route('admin.videos.index')->with('success', 'Video record removed.');
        }
    }
}