<?php

namespace App\Http\Controllers;

use App\Models\Evening;
use App\Models\Setting;
use App\Models\Girlchess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GirlChesseController extends Controller
{
    public function getGirlChesse(){
        $data = Girlchess::first();
        $setting = Setting::first();
        if($data===null)
        {
            $data = new Girlchess();
            $data->title = 'GirlChess';
            $data->description = 'About GirlChess';
            $data->details = 'Details';
            $data->save();
            $data = Girlchess::first();
        }

        return view('admin.pages.girlchess', ['data'=>$data,'setting'=>$setting]);
    }

    public function saveGirlchess(Request $request){
        $data = Girlchess::first();
        $title = [];
        $description = [];
        $details = [];
        $image = [];
 
        if ($data->title != $request->input('title')) {
            $data->title = $request->input('title');
            $title[] = 'title';
        }
 
        if ($data->description != $request->input('description')) {
            $data->description = $request->input('description');
            $description[] = 'description';
        }

        // Handle file uploads
        $dir = 'public/images/girlchess/';
    
        if ($request->hasFile('image') && request('image') != '') {
            // Delete old file
            File::delete($dir . $data->image);
            // Store new file
            $fileName = $request->file('image')->store($dir);
            $data->image = str_replace($dir, '', $fileName);
            $image[] = 'image';
        }

    
        $saved = $data->update();
    
        if($saved){
            return redirect()->back()->with('success', 'Page fields have been updated successfully');

        }

        return redirect()->back()->with('error', 'No fields were updated');
    }
    public function getEvenings(){
        $data = Evening::first();
        $setting = Setting::first();
        if($data===null)
        {
            $data = new Evening();
            $data->title = 'La Claire Fontaine Evenings';
            $data->description = 'Description';
            $data->user_id = Auth()->user()->id;
            $data->save();
            $data = Evening::first();
        }

        return view('admin.pages.evenings', ['data'=>$data,'setting'=>$setting]);
    }

    public function saveEvenings(Request $request){
        $data = Evening::first();
        $title = [];
        $description = [];
        $image = [];
 
        if ($data->title != $request->input('title')) {
            $data->title = $request->input('title');
            $title[] = 'title';
        }
 
        if ($data->description != $request->input('description')) {
            $data->description = $request->input('description');
            $description[] = 'description';
        }

        // Handle file uploads
        $dir = 'public/images/';
    
        if ($request->hasFile('image') && request('image') != '') {
            // Delete old file
            File::delete($dir . $data->image);
            // Store new file
            $fileName = $request->file('image')->store($dir);
            $data->image = str_replace($dir, '', $fileName);
            $image[] = 'image';
        }

    
        $saved = $data->update();
    
        if($saved){
            return redirect()->back()->with('success', 'Page have been updated successfully');

        }

        return redirect()->back()->with('error', 'Something Went Wrong');
    }

    
}
