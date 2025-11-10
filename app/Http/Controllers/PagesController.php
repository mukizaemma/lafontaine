<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        $setting = Setting::first();
        return view('admin.pages.index',[
            'pages' => $pages,
            'setting' => $setting,
        ]);
    }

    public function store(Request $request)
    {
            
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $validate = Validator::make($request->all(), $rules);
        if (!$validate) {
            return redirect()->back()->with('error', 'Missing Data');        } 
        

         else{
        $fileName = '';
        if($request->hasFile('image')){
            $file = $request->file('image');

            $path = $file->store('public/images/pages');
            $fileName = basename($path);
        }

        $slug = Str::of($request->input('title'))->slug();

        $Page = new Page();
        $Page->title = $request->title;
        $Page->added_by = Auth::user()->id;
        $Page->description = $request->description;
        $Page->image = $fileName;
        $Page->slug = $slug;
        $Page->save();

        return redirect()->route('showPages')->with('success', 'Page Added Successfully');

    }
    }

    public function edit($id)
    {
        $page = Page::find($id);
        return view('admin.pages.pageUpdate',[
            'page' => $page,
        ]);
    }

    public function update(Request $request, $id)
    {
    
        $page = Page::find($id);
    
        if (!$page) {
            return redirect()->route('showPages')->with('error', 'Page not found');
        }
    
        else{
                    // Handle image updates
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('public/images/pages');
            $page->image = basename($path);
        }
    
        $page->description = $request->description;
        $page->save();
    
        return redirect()->route('showPages')->with('success', 'Page Updated Successfully');
        }
    }
    

    public function destroy(string $id)
    {
        $page = Page::findOrFail($id);

        // Delete the image file
        Storage::delete('public/images/pages/' . $page->image);

        // Delete the post
        $page->delete();

        return redirect()->route('showPages')->with('success', 'Page Deleted Successfully');
    }
}
