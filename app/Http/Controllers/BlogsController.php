<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use App\Models\Story;
use App\Models\Program;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Subscriber;
use App\Models\BlogComment;
use Illuminate\Support\Str;
use App\Models\Storycomment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PublicationNotification;
use Illuminate\Http\RedirectResponse;
use App\Mail\BlogCommentsNotofications;
use Illuminate\Support\Facades\Storage;

class BlogsController extends Controller
{
    public function index()
    {
        function limitText($text, $limit = 100) {
            if (strlen($text) <= $limit) {
                return $text;
            }
            return substr($text, 0, $limit) . '...';
        }
    
        $latestBlogs = Blog::with('category')
            ->latest()
            ->get()
            ->map(function ($post) {
                $post->short_body = limitText(strip_tags($post->body), 100);
                return $post;
            });
    
        $mostViewedBlogs = Blog::with('category')
            ->orderBy('views', 'desc')
            ->get()
            ->map(function ($post) {
                $post->short_body = limitText(strip_tags($post->body), 100);
                return $post;
            });
    
        $blogCategories = Category::all();
        $setting = Setting::first();
    
        return view('admin.posts.blogs', [
            'blogCategories' => $blogCategories,
            'latestBlogs' => $latestBlogs,
            'mostViewedBlogs' => $mostViewedBlogs,
            'setting' => $setting,
        ]);
    }
    


    public function store(Request $request): RedirectResponse
    {
        $fileName = '';
        if($request->hasFile('image')){
            $file = $request->file('image');
            $path = $file->store('public/images/blogs');
            $fileName = basename($path);
        }
    
        $slug = Str::of($request->input('title'))->slug();
    
        $blog = new Blog();
        $blog->title = $request->input('title');
        $blog->body = $request->input('body');
        $blog->image = $fileName;
        $blog->slug = $slug;
        $blog->category_id = $request->input('category_id') ;
        $blog->added_by = $request->user()->id;
        $blog->save();
    
        return redirect()->route('getBlogs')->with('success', 'New Publication has been saved successfully');
    }

    
    public function edit($id)
    {
        $post = Blog::find($id);
        $program= Program::all();
        $categories= Category::all();
        $setting = Setting::first();
        return view('admin.posts.blogUpdate', [
            'post'=>$post,
            'program'=>$program,
            'setting'=>$setting,
            'categories'=>$categories
        ]);
    }
    public function view($id)
    {
        $post = Blog::find($id);
        $comments = BlogComment::where('blog_id',$post->id)->latest()->get();
        $totalComments = $comments->count();
        $program= Program::all();
        $setting = Setting::first();
        return view('admin.posts.blogView', [
            'post'=>$post,
            'program'=>$program,
            'comments'=>$comments,
            'totalComments'=>$totalComments,
            'setting'=>$setting
        ]);
    }

    public function update(Request $request, $id)
{
    try {
        $post = Blog::findOrFail($id);

        $updatedFields = [];

        if ($request->hasFile('image')) {
            Storage::delete('public/images/blogs/' . $post->image);
            $path = $request->file('image')->store('public/images/blogs');
            $updatedFields['image'] = basename($path);
        }

        foreach (['title', 'body', 'status','category_id'] as $field) {
            if ($request->filled($field) && $request->input($field) !== $post->$field) {
                $updatedFields[$field] = $request->input($field);
            }
        }

        if (array_key_exists('title', $updatedFields)) {
            $slug = Str::slug($updatedFields['title']);
            if (Blog::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
                $slug .= '-' . uniqid();
            }
            $updatedFields['slug'] = $slug;
        }

        if (!empty($updatedFields)) {
            $post->update($updatedFields);
        }

        return redirect()->route('getBlogs')->with('success', 'Publication has been updated successfully');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Something went wrong');
    }
}

    

    public function publish(Request $request, $id){
        $post = Blog::findOrFail($id);
        if($post->status !=='Published'){
            $post->status='Published';
            $post->save();

            $users = Subscriber::all();

            foreach($users as $user){
                $details = [
                    'greeting' => 'Hello ' . $user->name . '!',
                    'body' => 'La Claire Fontaine has shared a new update: ' . $post->title,
                    'text' => '' . $post->body,
                    'actiontext' => 'View Publication',
                    'actionurl' => url('/Updates/' . $post->slug),
                    'lastline' => 'Thank you!',
                ];
                Mail::to($user->email)->queue(new PublicationNotification($details));
            }
        }
        return redirect()->route('getBlogs')->with('success', 'Publication has been updated successfully');
    }

    public function destroy($id)
    {
        $blogs = Blog::find($id); 
        if (!$blogs) {
            return back()->with('error', 'Content not found');
        }
        if ($blogs->image) {
            Storage::delete('public/images/blogs/' . $blogs->image);
        }
        $blogs->delete($id);
        return back()
            ->with('success', 'Publication deleted successfully');
    }


    public function comments(){
        $comments = BlogComment::latest()->get();
        return view('admin.posts.comments',[
            'comments'=>$comments,
        ]);
    }
}
