<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Media::with('uploader')->latest();

        // Filter by file type
        if ($request->has('file_type') && $request->file_type !== '') {
            $query->where('file_type', $request->file_type);
        }

        $media = $query->paginate(20);
        $setting = Setting::first();
        
        return view('admin.media.index', compact('media', 'setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $setting = Setting::first();
        return view('admin.media.create', compact('setting'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file',
            'file_type' => 'required|in:image,pdf,video',
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('media', $fileName, 'public');

        Media::create([
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $filePath,
            'file_type' => $validated['file_type'],
            'uploaded_by' => auth()->id(),
        ]);

        return redirect()->route('admin.media.index')
            ->with('success', 'Media uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Media $media)
    {
        $setting = Setting::first();
        return view('admin.media.show', compact('media', 'setting'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $media)
    {
        // Delete the file from storage
        if (Storage::disk('public')->exists($media->file_path)) {
            Storage::disk('public')->delete($media->file_path);
        }

        $media->delete();

        return redirect()->route('admin.media.index')
            ->with('success', 'Media deleted successfully.');
    }
}
