<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\ImportMediaFromUrl;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ImportController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('admin.import.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'url' => ['required', 'url'],
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', Rule::in(['image', 'video'])],
            'category_id' => ['nullable', 'exists:categories,id'],
        ]);

        ImportMediaFromUrl::dispatch(
            $request->input('url'),
            $request->input('name'),
            $request->input('type'),
            $request->input('category_id')
        );

        return redirect()->route('admin.dashboard')->with('success', 'Import started. The media will appear in the library shortly.');
    }
}
