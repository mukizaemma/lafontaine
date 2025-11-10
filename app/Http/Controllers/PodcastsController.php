<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Podcast;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Podcastcategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PodcastsController extends Controller
{
    public function index()
    {
        function limitText($text, $limit = 100) {
            if (strlen($text) <= $limit) {
                return $text;
            }
            return substr($text, 0, $limit) . '...';
        }

        $podcasts = Podcast::with('podcastCategory')->latest()->get()->map(function ($podcast) {
            $podcast->short_body = limitText(strip_tags($podcast->description), 100);
            return $podcast;
        });

        $categories = Podcastcategory::all();
        $setting = Setting::first();
        return view('admin.podcasts.podcasts',[
            'podcasts'=>$podcasts,
            'categories'=>$categories,
            'setting'=>$setting,
        ]);
    }
    public function store(Request $request)
    {
        $fileName = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('public/images/podcasts');
            $fileName = basename($path);
        }
        $audioUrl = '';
        if ($request->hasFile('audio_url')) {
            $audioFile = $request->file('audio_url');
            $audioPath = $audioFile->store('public/audio/podcasts');
            $audioUrl = basename($audioPath);
        }
        
        $slug = Str::slug($request->input('title'));
    
        $podcast = new Podcast();
        $podcast->title = $request->input('title');
        $podcast->description = $request->input('description', ''); 
        $podcast->podcastcategory_id = $request->input('podcastcategory_id');
        $podcast->slug = $slug;
        $podcast->image = $fileName;
        $podcast->audio_url = $audioUrl;
        $podcast->added_by = Auth()->user()->id;
    
        if ($podcast->save()) {
            return redirect()->route('getPodcasts')->with('success', 'Podcast created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create podcast. Please try again.')->withInput();
        }
    }
  
    // public function view($id){
    //     $post = Podcast::find($id);
    //     return view('admin.podcasts.categories')
    // }
    
    public function edit(string $id)
    {
        $podcast = Podcast::find($id);
        $categories = Podcastcategory::all();
        $setting = Setting::first();
        return view('admin.podcasts.podcastUpdate', [
            'podcast'=>$podcast,
            'categories'=>$categories,
            'setting'=>$setting,
        ]);
    }
    public function update(Request $request, $id)
    {
        $podcast = Podcast::findOrFail($id);
    
        if ($request->hasFile('image')) {
            if ($podcast->image && Storage::exists('public/images/podcasts/' . $podcast->image)) {
                Storage::delete('public/images/podcasts/' . $podcast->image);
            }
            $file = $request->file('image');
            $path = $file->store('public/images/podcasts');
            $podcast->image = basename($path);
        }
    
        if ($request->hasFile('audio_url')) {
            if ($podcast->audio_url && Storage::exists('public/audio/podcasts/' . $podcast->audio_url)) {
                Storage::delete('public/audio/podcasts/' . $podcast->audio_url);
            }
            $audioFile = $request->file('audio_url');
            $audioPath = $audioFile->store('public/audio/podcasts');
            $podcast->audio_url = basename($audioPath);
        }
    
        if ($request->filled('title') && $request->input('title') !== $podcast->title) {
            $podcast->title = $request->input('title');
            $podcast->slug = Str::slug($request->input('title'));
        }
    
        if ($request->filled('description') && $request->input('description') !== $podcast->description) {
            $podcast->description = $request->input('description');
        }
    
        if ($request->filled('podcastcategory_id') && $request->input('podcastcategory_id') !== $podcast->podcastcategory_id) {
            $podcast->podcastcategory_id = $request->input('podcastcategory_id');
        }
    
        if ($podcast->isDirty()) {
            $podcast->added_by = Auth()->user()->id;
            $podcast->save();
    
            return redirect()->route('getPodcasts')->with('success', 'Podcast updated successfully.');
        }
    
        return redirect()->back()->with('info', 'No changes detected.')->withInput();
    }
    
    
    public function destroy($id)
    {
        $post = Podcast::findOrFail($id);
    
        if ($post->image) {
            $imagePath = public_path('storage/images/podcasts/' . $post->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    
        $post->delete();
    
        return redirect('getPodcasts')->with('success', 'Data has been deleted');
    }
}
