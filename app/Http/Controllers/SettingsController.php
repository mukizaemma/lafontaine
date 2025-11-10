<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Term;
use App\Models\Aboutus;
use App\Models\Getinvolved;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class SettingsController extends Controller
{
    public function setting(){
        $data = Setting::first();
        $setting = Setting::first();
        if($data===null)
        {
            $data = new Setting();
            $data->title = 'Company Name';
            $data->user_id = Auth()->user()->id;
            $data->company = 'Company Name';
            $data->keywords = 'Community development in Rwanda';
            $data->save();
            $data = Setting::first();
        }

        return view('admin.setting', ['data'=>$data,'setting'=>$setting]);
    }



    public function saveSetting(Request $request){
        $data = Setting::first();
        $data->company = $request->input('company');
        $data->address = $request->input('address');
        $data->phone = $request->input('phone');
        $data->email = $request->input('email');
        $data->facebook = $request->input('facebook');
        $data->instagram = $request->input('instagram');
        $data->youtube = $request->input('youtube');
        $data->linkedin = $request->input('linkedin');
        $data->keywords = $request->input('keywords');
        $data->quote = $request->input('quote');
        $data->user_id = Auth()->user()->id;


        if ($request->hasFile('logo') && request('logo') != '') {
            $dir = 'public/images';

            if (File::exists($dir)) {
                unlink($dir);
            }
            $path = $request->file('logo')->store($dir);
            $fileName = str_replace($dir, '', $path);

            $data->logo = $fileName;
        }

        $saved = $data->update();

        if($saved){
            return redirect()->back()->with('success', 'Setting has been updated successfully');
        }
        else{
            abort(404);
        }
    }

    public function homePage(){
        $data = Home::first();
        if($data===null)
        {
            $data = new Home();
            $data->user_id = Auth()->user()->id;
            $data->heading = 'Welcome to our Website';
            $data->subHeading = 'Impacting Future Leaders';
            $data->values = 'Why we tell stories';
            $data->save();
            $data = Home::first();
        }

        return view('admin.pages.home', ['data'=>$data]);
    }

    public function saveHome(Request $request){
        $data = Home::first();
        $userId = Auth()->user()->id;
        $heading = [];
        $subHeading = [];
        $welcomeVideo = [];
        $values = [];
        $impactTitle = [];
        $videoUrl = [];
        $impactQuote = [];
        $welcomeImage = [];
        $workBackImage = [];
        $impactImmage = [];
    
        if ($data->heading != $request->input('heading')) {
            $data->heading = $request->input('heading');
            $heading[] = 'heading';
        }
    
        if ($data->subHeading != $request->input('subHeading')) {
            $data->subHeading = $request->input('subHeading');
            $subHeading[] = 'subHeading';
        }
    
        if ($data->welcomeVideo != $request->input('welcomeVideo')) {
            $data->welcomeVideo = $request->input('welcomeVideo');
            $welcomeVideo[] = 'welcomeVideo';
        }
    
        if ($data->values != $request->input('values')) {
            $data->values = $request->input('values');
            $values[] = 'values';
        }
    
        if ($data->solution != $request->input('solution')) {
            $data->solution = $request->input('solution');
            $solution[] = 'solution';
        }

    
        if ($data->impactQuote != $request->input('impactQuote')) {
            $data->impactQuote = $request->input('impactQuote');
            $impactQuote[] = 'impactQuote';
        }

    
        // Handle file uploads
        $dir = 'public/images/home/';
    
        if ($request->hasFile('welcomeImage') && request('welcomeImage') != '') {
            // Delete old file
            File::delete($dir . $data->welcomeImage);
            // Store new file
            $fileName = $request->file('welcomeImage')->store($dir);
            $data->welcomeImage = str_replace($dir, '', $fileName);
            $welcomeImage[] = 'welcomeImage';
        }
    
        if ($request->hasFile('workBackImage') && request('workBackImage') != '') {
            // Delete old file
            File::delete($dir . $data->workBackImage);
            // Store new file
            $fileName = $request->file('workBackImage')->store($dir);
            $data->workBackImage = str_replace($dir, '', $fileName);
            $workBackImage[] = 'workBackImage';
        }
    
        if ($request->hasFile('impactImmage') && request('impactImmage') != '') {
            // Delete old file
            File::delete($dir . $data->impactImmage);
            // Store new file
            $fileName = $request->file('impactImmage')->store($dir);
            $data->impactImmage = str_replace($dir, '', $fileName);
            $impactImmage[] = 'impactImmage';
        }
    
        $data->user_id = $userId;
        $saved = $data->update();
    
        if($saved){
            return redirect()->back()->with('success', 'Home Page fields have been updated successfully');

        }

        return redirect()->back()->with('error', 'No fields were updated');
    }
    public function aboutPage(){
        $data = Aboutus::first();
        $setting = Setting::first();
        if($data===null)
        {
            $data = new Aboutus();
            $data->title = 'About Us';
            $data->subTitle = 'About Us';
            $data->subTitle = 'About us details';
            $data->values = 'Why we tell these stories';
            $data->save();
            $data = Aboutus::first();
        }

        return view('admin.pages.about', ['data'=>$data,'setting'=>$setting]);
    }

    public function saveAbout(Request $request){
        $data = Aboutus::first();
        $aboutus = [];
        $mission = [];
        $headerImage = [];
        $backImage = [];
        $backImageText = [];
    
        if ($data->aboutus != $request->input('aboutus')) {
            $data->aboutus = $request->input('aboutus');
            $aboutus[] = 'aboutus';
        }
    
        if ($data->mission != $request->input('mission')) {
            $data->mission = $request->input('mission');
            $mission[] = 'mission';
        }
        // Handle file uploads
        $dir = 'public/images/about/';
    
        if ($request->hasFile('headerImage') && request('headerImage') != '') {
            // Delete old file
            File::delete($dir . $data->headerImage);
            // Store new file
            $fileName = $request->file('headerImage')->store($dir);
            $data->headerImage = str_replace($dir, '', $fileName);
            $headerImage[] = 'headerImage';
        }

        if ($request->hasFile('backImage') && request('backImage') != '') {
            // Delete old file
            File::delete($dir . $data->backImage);
            // Store new file
            $fileName = $request->file('backImage')->store($dir);
            $data->backImage = str_replace($dir, '', $fileName);
            $backImage[] = 'backImage';
        }

        if ($request->hasFile('backImageText') && request('backImageText') != '') {
            // Delete old file
            File::delete($dir . $data->backImageText);
            // Store new file
            $fileName = $request->file('backImageText')->store($dir);
            $data->backImageText = str_replace($dir, '', $fileName);
            $backImageText[] = 'backImageText';
        }
    
        $saved = $data->update();
    
        if($saved){
            return redirect()->back()->with('success', 'About us Page fields have been updated successfully');

        }

        return redirect()->back()->with('error', 'No fields were updated');
    }


    public function getInvol(){
        $data = Getinvolved::first();
        if($data===null)
        {
            $data = new Getinvolved();
            $data->user_id = Auth()->user()->id;
            $data->title = 'get involved';
            $data->subTitle = 'Get involved';
            $data->save();
            $data = Getinvolved::first();
        }

        return view('admin.pages.getInvolved', ['data'=>$data]);
    }

    public function saveInvol(Request $request){
        $data = Getinvolved::first();
        $userId = Auth()->user()->id;
        $title = [];
        $subTitle = [];
        $quote = [];
        $voluteer = [];
        $partner = [];
        $give = [];
        $videoBack = [];
        $videoUrl = [];
    
        if ($data->title != $request->input('title')) {
            $data->title = $request->input('title');
            $title[] = 'title';
        }
    
        if ($data->subTitle != $request->input('subTitle')) {
            $data->subTitle = $request->input('subTitle');
            $subTitle[] = 'subTitle';
        }
    
        if ($data->quote != $request->input('quote')) {
            $data->quote = $request->input('quote');
            $quote[] = 'quote';
        }
    
        if ($data->voluteer != $request->input('voluteer')) {
            $data->voluteer = $request->input('voluteer');
            $voluteer[] = 'voluteer';
        }
    
        if ($data->partner != $request->input('partner')) {
            $data->partner = $request->input('partner');
            $partner[] = 'partner';
        }
    
        if ($data->give != $request->input('give')) {
            $data->give = $request->input('give');
            $give[] = 'give';
        }
        if ($data->videoUrl != $request->input('videoUrl')) {
            $data->videoUrl = $request->input('videoUrl');
            $videoUrl[] = 'videoUrl';
        }
    
        // Handle file uploads
        $dir = 'public/images/impact/';
    
        if ($request->hasFile('headerImage') && request('headerImage') != '') {
            // Delete old file
            File::delete($dir . $data->headerImage);
            // Store new file
            $fileName = $request->file('headerImage')->store($dir);
            $data->headerImage = str_replace($dir, '', $fileName);
            $headerImage[] = 'headerImage';
        }
    
        if ($request->hasFile('videoBack') && request('videoBack') != '') {
            // Delete old file
            File::delete($dir . $data->videoBack);
            // Store new file
            $fileName = $request->file('videoBack')->store($dir);
            $data->videoBack = str_replace($dir, '', $fileName);
            $videoBack[] = 'videoBack';
        }

    
        $data->user_id = $userId;
        $saved = $data->update();
    
        if($saved){
            return redirect()->back()->with('success', 'Work Page fields have been updated successfully');

        }

        return redirect()->back()->with('error', 'No fields were updated');
    }


    // Terms and policies

    public function getTerms(){
        $data = Term::first();
        if($data===null)
        {
            $data = new Term();
            $data->terms = 'Our Terms and conditions';
            $data->privacy = 'Our Privacy policies';
            $data->return = 'Our Return policies';
            $data->support = 'Our Support policies';
            $data->added_by = Auth()->user()->id;
            $data->save();
            $data = Term::first();
        }

        return view('admin.terms', ['data'=>$data]);
    }

    
    public function saveTerms(Request $request){
        $data = Term::first();
        $data->privacy = $request->input('privacy');
        $data->return = $request->input('return');
        $data->terms = $request->input('terms');
        $data->support = $request->input('support');


        $data->update();

        return redirect()->back()->with('success', 'Terms and policies has been updated successfully');
    }
}
