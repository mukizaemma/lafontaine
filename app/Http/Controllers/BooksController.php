<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Book;
use App\Models\Reader;
use App\Models\Setting;
use App\Models\ReaderBook;
use App\Models\Bookcomment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ReaderBookRead;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class BooksController extends Controller
{

    public function index()
{
    function limitText($text, $limit = 100) {
        if (strlen($text) <= $limit) {
            return $text;
        }
        return substr($text, 0, $limit) . '...';
    }

    // Get the latest books along with their total reads
    $latestBooks = Book::latest()
        ->get()
        ->map(function ($book) {
            $book->short_body = limitText(strip_tags($book->description), 100);
            return $book;
        });

    // Get the most read books, ordered by total reads (sum of times_read)
    $mostReadBooks = Book::all()->map(function ($book) {
        $book->short_body = limitText(strip_tags($book->description), 100);
        return $book;
    });

    $setting = Setting::first();
    $readers = Reader::latest()->paginate(10);
    $totalReaders = $readers->count();

    return view('admin.books.bookAdd', [
        'latestBooks' => $latestBooks,
        'setting' => $setting,
        'readers' => $readers,
        'totalReaders' => $totalReaders,
    ]);
}





    public function store(Request $request): RedirectResponse
    {
        if (Book::where('title', $request->input('title'))->exists()) {
        return redirect()->back()->with('error','A book with this title already exists.');
    }

        $fileName = '';
        if($request->hasFile('cover_image')){
            $file = $request->file('cover_image');
            $path = $file->store('public/images/books');
            $fileName = basename($path);
        }
        
        $pdfFileName = '';
        if ($request->hasFile('pdf_file')) {
            $pdfFile = $request->file('pdf_file');
            $pdfPath = $pdfFile->store('public/pdfs/books');
            $pdfFileName = basename($pdfPath);
        }
    
        $slug = Str::of($request->input('title'))->slug();
    
        $blog = new Book();
        $blog->title = $request->input('title');
        $blog->description = $request->input('description');
        $blog->author = $request->input('author');
        $blog->category = $request->input('category');
        $blog->publication = $request->input('publication');
        $blog->language = $request->input('language');
        $blog->ebook_number = $request->input('ebook_number');
        $blog->release_date = $request->input('release_date');
        $blog->cover_image = $request->input('cover_image');
        $blog->buy_url = $request->input('buy_url');
        $blog->cover_image = $fileName;
        $blog->pdf_file = $pdfFileName;
        $blog->slug = $slug;
        $blog->user_id = $request->user()->id;
        $blog->save();
    
        return redirect()->route('getBooks')->with('success', 'New Book has been saved successfully');
    }

    
    public function edit($id)
    {
        $book = Book::find($id);
        $setting = Setting::first();
        return view('admin.books.bookUpdate', [
            'book'=>$book,
            'setting'=>$setting,
        ]);
    }
    public function view($id)
    {
        $book = Book::findOrFail($id);
        $comments = Bookcomment::where('book_id',$book->id)->latest()->get();
        $totalComments = $comments->count();
        $setting = Setting::first();

        $totalReaders = ReaderBookRead::where('book_id', $book->id)->distinct('reader_id')->count();

        // Count unique downloads (people who downloaded the book)
        //$totalDownloads = ReaderBook::where('book_id', $book->id)->where('downloaded', true)->count();

        return view('admin.books.bookView', [
            'book'=>$book,
            'setting'=>$setting,
            'comments'=>$comments,
            'totalComments'=>$totalComments,
            'totalReaders'=>$totalReaders,
            //'totalDownloads'=>$totalDownloads,

        ]);
    }

    public function update(Request $request, $id)
{
    try {
        $book = Book::findOrFail($id);

        $updatedFields = [];

        if ($request->hasFile('cover_image')) {
            Storage::delete('public/images/books/' . $book->cover_image);
            $path = $request->file('cover_image')->store('public/images/books');
            $updatedFields['cover_image'] = basename($path);
        }

        if ($request->hasFile('pdf_file')) {
            Storage::delete('public/images/books/' . $book->pdf_file);
            $path = $request->file('pdf_file')->store('public/images/books');
            $updatedFields['pdf_file'] = basename($path);
        }

        foreach (['title', 'description', 'status','cover_image','release_date','author','buy_url','pdf_file'] as $field) {
            if ($request->filled($field) && $request->input($field) !== $book->$field) {
                $updatedFields[$field] = $request->input($field);
            }
        }

        if (array_key_exists('title', $updatedFields)) {
            $slug = Str::slug($updatedFields['title']);
            if (Blog::where('slug', $slug)->where('id', '!=', $book->id)->exists()) {
                $slug .= '-' . uniqid();
            }
            $updatedFields['slug'] = $slug;
        }

        if (!empty($updatedFields)) {
            $book->update($updatedFields);
        }

        return redirect()->route('getBooks')->with('success', 'Book has been updated successfully');
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
        $book = Book::find($id); 
        if (!$book) {
            return back()->with('error', 'Content not found');
        }
        if ($book->cover_image) {
            Storage::delete('public/images/blogs/' . $book->cover_image);
        }
        $book->delete($id);
        return back()
            ->with('success', 'Book deleted successfully');
    }
}
