<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Podcastcategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PodcastCategoriesController extends Controller
{
    public function index()
    {
        $categories = Podcastcategory::with('podcasts')->get();
        $setting = Setting::first();
        return view('admin.podcasts.categories',[
            'categories'=>$categories,
            'setting'=>$setting,
        ]);
    }
    public function store(Request $request)
    {
        $fileName = '';
        if ($request->hasFile('image')) {
            $fileName = $request->file('image')->store('public/images/podcasts');
            $fileName = basename($fileName);
        }
    
        $slug = Str::slug($request->input('title'));
    
        try {
            Podcastcategory::create([
                'title' => $request->input('title'),
                'description' => $request->input('description', ''),
                'slug' => $slug,
                'image' => $fileName,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error saving category: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to create category'])->withInput();
        }
    
        return redirect()->route('getPodcastCategories')->with('success', 'Category created successfully.');
    }
    
    
    
    public function edit(string $id)
    {
        $podcast = Podcastcategory::find($id);
        $setting = Setting::first();
        return view('admin.podcasts.categoryUpdate', [
            'podcast'=>$podcast,
            'setting'=>$setting,
        ]);
    }

    public function update(Request $request, $id)
    {
        $podcast = Podcastcategory::findOrFail($id);
    
        $fileName = $podcast->image;
        if ($request->hasFile('image')) {
            if ($podcast->image && Storage::exists('public/images/podcasts/' . $podcast->image)) {
                Storage::delete('public/images/podcasts/' . $podcast->image);
            }
            $file = $request->file('image');
            $path = $file->store('public/images/podcasts');
            $fileName = basename($path);
        }

    
        $slug = Str::slug($request->input('title'));
    
        $podcast->title = $request->input('title');
        $podcast->description = $request->input('description', '');
        $podcast->slug = $slug;
        $podcast->image = $fileName;
    
        if ($podcast->save()) {
            return redirect()->route('getPodcastCategories')->with('success', 'Category updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update podcast. Please try again.')->withInput();
        }

    }
    
     
    public function destroy($id)
    {
        $post = Podcastcategory::findOrFail($id);
    
        if ($post->image) {
            $imagePath = public_path('storage/images/podcasts/' . $post->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    
        $post->delete();
    
        return redirect('getPodcastCategories')->with('success', 'Data has been deleted');
    }
    
}
