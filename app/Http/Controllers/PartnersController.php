<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;

class PartnersController extends Controller
{
    public function index()
    {

        $partners = Partner::all();
        $setting = Setting::first();
        return view('admin.partners', [
            'partners' => $partners,
            'setting' => $setting
        ]);
    }


        public function store(Request $request): RedirectResponse
        {
    
            $fileName = '';
            if($request->hasFile('image')){
                $file = $request->file('image');
    
                $path = $file->store('public/images/partners');
                $fileName = basename($path);
            }
    
            // Generate the slug
            $slug = Str::of($request->input('name'))->slug();
    
            // Check if a blog post with the same slug already exists
            $blog = Partner::firstOrCreate(
                ['slug' => $slug],
                [
                    'name' => $request->input('name'),
                    'website' => $request->input('website'),
                    'description' => $request->input('description'),
                    'image' => $fileName,
                    'slug' => $slug,
                ]
            );
            return redirect('getPartners')->with('success', 'New Partner has been Saved successfuly');
    }

    
    public function edit($id)
    {
        $partner = Partner::find($id);
        return view('admin.partnerUpdate', [
            'partner'=>$partner
        ]);
    }


    public function update(Request $request, $id)
    {

        $partner = Partner::findOrFail($id);

        // Update image if a new one is uploaded
        if($request->hasFile('image')){
            $file = $request->file('image');

            $path = $file->store('public/images/partners');
            $fileName = basename($path);

            // Delete the old image file 
            Storage::delete('public/images/blogs/' . $partner->image);

            $partner->image = $fileName;
        }

        // Update other fields
        $partner->name = $request->input('name');
        $partner->website = $request->input('website');
        $partner->description = $request->input('description');
        $partner->status = $request->input('status');

        // Update the slug if the title has changed
        if($partner->name !== $request->input('name')){
            $slug = Str::of($request->input('name'))->slug();
            // Check if a blog post with the same slug already exists
            $existingpost = Partner::where('slug', $slug)->first();
            if($existingpost && $existingpost->id !== $partner->id){
                $suffix = 1;
                do{
                    $newSlug = $slug . '-' . $suffix++;
                    $existingpost = Partner::where('slug', $newSlug)->first();
                }while($existingpost);
                $slug = $newSlug;
            }
            $partner->slug = $slug;
        }

        $partner->save();

        return redirect('getPartners')->with('success', 'Partner has been updated successfully');
    }




    public function destroy($id)
    {
        $partner = Partner::find($id); 
        $partner->delete($id);
        return back()
            ->with('success', 'Partner deleted successfully');
    }
}
