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
        if (!$data) {
            $data = new Setting();
            $data->user_id = Auth()->user()->id;
        }
        
        $data->company = $request->input('company');
        $data->address = $request->input('address');
        $data->phone = $request->input('phone');
        $data->phone_2 = $request->input('phone_2');
        $data->phone_3 = $request->input('phone_3');
        $data->phone_4 = $request->input('phone_4');
        $data->website = $request->input('website');
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
            // Removed 'values' field as it doesn't exist in the homes table
            $data->save();
            $data = Home::first();
        }

        return view('admin.pages.home', ['data'=>$data]);
    }

    public function saveHome(Request $request){
        $data = Home::first();
        if (!$data) {
            $data = new Home();
            $data->user_id = Auth()->user()->id;
        }
        
        $userId = Auth()->user()->id;
    
        // Update text fields
        $fields = [
            'heading', 'subHeading', 'hero_title', 'hero_subtitle', 'hero_description',
            'hero_button_text_1', 'hero_button_link_1', 'hero_button_text_2', 'hero_button_link_2',
            'about_stream_title', 'about_stream_content',
            'vision_title', 'vision_content', 'mission_title', 'mission_content',
            'why_french_title', 'why_french_subtitle',
            'linguistic_title', 'methodology_title', 'methodology_content',
            'impact_section_title', 'sustainability_title', 'sustainability_content',
            'partnership_title', 'partnership_content',
            'welcomeVideo', 'problem', 'solution', 'workQuote', 'videoUrl',
            'impactTitle', 'impactQuote'
        ];
        
        foreach ($fields as $field) {
            if ($request->has($field)) {
                $data->$field = $request->input($field);
            }
        }
        
        // Update JSON fields
        $jsonFields = [
            'why_french_points', 'why_french_benefits',
            'linguistic_programs', 'linguistic_publications', 'linguistic_training',
            'linguistic_exchange', 'linguistic_events',
            'methodology_points', 'impact_stats',
            'sustainability_points', 'partnership_benefits'
        ];
        
        foreach ($jsonFields as $field) {
            if ($request->has($field)) {
                $value = $request->input($field);
                $data->$field = is_array($value) ? $value : json_decode($value, true);
            }
        }
    
        // Handle file uploads
        $dir = 'public/images/home/';
    
        if ($request->hasFile('welcomeImage') && request('welcomeImage') != '') {
            if ($data->welcomeImage && File::exists($dir . $data->welcomeImage)) {
                File::delete($dir . $data->welcomeImage);
            }
            $fileName = $request->file('welcomeImage')->store($dir);
            $data->welcomeImage = str_replace($dir, '', $fileName);
        }
    
        if ($request->hasFile('workBackImage') && request('workBackImage') != '') {
            if ($data->workBackImage && File::exists($dir . $data->workBackImage)) {
                File::delete($dir . $data->workBackImage);
            }
            $fileName = $request->file('workBackImage')->store($dir);
            $data->workBackImage = str_replace($dir, '', $fileName);
        }
    
        if ($request->hasFile('impactImmage') && request('impactImmage') != '') {
            if ($data->impactImmage && File::exists($dir . $data->impactImmage)) {
                File::delete($dir . $data->impactImmage);
            }
            $fileName = $request->file('impactImmage')->store($dir);
            $data->impactImmage = str_replace($dir, '', $fileName);
        }
    
        $data->user_id = $userId;
        $saved = $data->save();
    
        if($saved){
            return redirect()->back()->with('success', 'Home Page fields have been updated successfully');
        }

        return redirect()->back()->with('error', 'Failed to update home page fields');
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
        if (!$data) {
            $data = new Aboutus();
        }
    
        // Update text fields
        $fields = [
            'title', 'subTitle', 'aboutus', 'vision', 'mission', 'values',
            'streams_title', 'experience_title', 'experience_content',
            'phone_1', 'phone_2', 'phone_3', 'phone_4', 'website'
        ];
        
        foreach ($fields as $field) {
            if ($request->has($field)) {
                $data->$field = $request->input($field);
            }
        }
        
        // Update JSON fields
        $jsonFields = ['company_identity', 'education_streams', 'achievements'];
        
        foreach ($jsonFields as $field) {
            if ($request->has($field)) {
                $value = $request->input($field);
                $data->$field = is_array($value) ? $value : json_decode($value, true);
            }
        }
        
        // Handle file uploads
        $dir = 'public/images/about/';
    
        if ($request->hasFile('headerImage') && request('headerImage') != '') {
            if ($data->headerImage && File::exists($dir . $data->headerImage)) {
                File::delete($dir . $data->headerImage);
            }
            $fileName = $request->file('headerImage')->store($dir);
            $data->headerImage = str_replace($dir, '', $fileName);
        }

        if ($request->hasFile('backImage') && request('backImage') != '') {
            if ($data->backImage && File::exists($dir . $data->backImage)) {
                File::delete($dir . $data->backImage);
            }
            $fileName = $request->file('backImage')->store($dir);
            $data->backImage = str_replace($dir, '', $fileName);
        }

        if ($request->hasFile('backImageText') && request('backImageText') != '') {
            if ($data->backImageText && File::exists($dir . $data->backImageText)) {
                File::delete($dir . $data->backImageText);
            }
            $fileName = $request->file('backImageText')->store($dir);
            $data->backImageText = str_replace($dir, '', $fileName);
        }
    
        $saved = $data->save();
    
        if($saved){
            return redirect()->back()->with('success', 'About us Page fields have been updated successfully');
        }

        return redirect()->back()->with('error', 'Failed to update about page fields');
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
