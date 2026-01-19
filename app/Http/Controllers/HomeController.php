<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Book;
use App\Models\Team;
use App\Models\User;
use App\Models\About;
use App\Models\Event;
use App\Models\Guest;
use App\Models\Slide;
use App\Models\Reader;
use App\Models\Review;
use App\Models\Aboutus;
use App\Models\Evening;
use App\Models\Message;
use App\Models\Podcast;
use App\Models\Program;
use App\Models\Setting;
use App\Models\Category;
use App\Models\ReaderBook;
use App\Models\Subscriber;
use App\Models\BlogComment;
use App\Models\Bookcomment;
use Illuminate\Http\Request;
use App\Models\ReaderBookRead;
use App\Models\Podcastcategory;
use App\Models\Home;
use App\Models\HeroSection;
use App\Models\Page;
use App\Models\Course;
use App\Models\ImpactStat;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class HomeController extends Controller
{
    public function index(Request $request)
    {

        $visitorIp = $request->ip();
        if (!$request->session()->has('visited_home_' . $visitorIp)) {
            $request->session()->put('visited_home_' . $visitorIp, true);

        }

        $setting = Setting::first();
        $home = Home::first();
        $aboutus = Aboutus::first();
        $slides = Slide::oldest()->get();
        $books = Book::where('status', 'available')->latest()->limit(6)->get();
        $heroSection = HeroSection::where('is_active', true)->first();
        $courses = Course::where('status', 'active')->latest()->limit(6)->get();
        $impactStats = ImpactStat::latest()->limit(4)->get();
        $categories = Category::with('blogs')->oldest()->get();
        $blogs = Blog::with('category')->where('status', 'Published')->latest()->limit(6)->get();

        return view('front.index',[
            'setting'=>$setting,
            'slides'=>$slides,
            'home'=>$home,
            'aboutus'=>$aboutus,
            'books'=>$books,
            'heroSection'=>$heroSection,
            'courses'=>$courses,
            'impactStats'=>$impactStats,
            'categories'=>$categories,
            'blogs'=>$blogs,
        ]);

    }


    public function blogsByCategory($slug) 
    {
        $category = Category::where('slug', $slug)->firstOrFail(); 
        $blogs = $category->blogs()->where('status', 'Published')->latest()->paginate(10);

        $setting = Setting::first();
        $categories = Category::with('blogs')->oldest()->get();
        $podcatsCategories = Podcastcategory::with('podcasts')->oldest()->get();

        return view('front.blogsByCategory', compact('category', 'blogs', 'setting', 'categories', 'podcatsCategories'));
        }


        public function singleBlog($slug) {
        $blog = Blog::with('category')->where('slug', $slug)->firstOrFail();
        $blogs = Blog::where('status', 'Published')->latest()->limit(6)->get();
        $latestBlogs = Blog::where('status', 'Published')->where('category_id',$blog->category_id)
            ->with(['comments' => function ($query) {
                $query->where('status', 'Published')->latest();
            }])
            ->latest()
            ->paginate(10);

        $setting = Setting::first();
        $slides = Slide::oldest()->get();
        $categories = Category::with('blogs')->oldest()->get();

        $blog->increment('views');

        $comments = $blog->comments()->where('status', 'Published')->latest()->get();
        $commentsCount = $comments->count();

        $relatedBlogs = Blog::where('id', '!=', $blog->id)
            ->where('status', 'Published')
            ->with(['comments' => function ($query) {
                $query->where('status', 'Published')->latest();
            }])
            ->inRandomOrder()
            ->take(5)
            ->get();

        return view('front.blog', [
            'blog' => $blog, 
            'blogs' => $blogs, 
            'latestBlogs' => $latestBlogs, 
            'comments' => $comments, 
            'commentsCount' => $commentsCount, 
            'setting' => $setting, 
            'categories' => $categories,
            'relatedBlogs' => $relatedBlogs,
            'slides' => $slides,
        ]);
    }

    public function books() {
        $books = Book::where('status', 'Active')->latest()->get();
        $blogsAll = Blog::where('status', 'Published')->latest()->get();
        $latestBlogs = Blog::withCount('likes')->where('status', 'Published')->latest()->paginate(10);
        $setting = Setting::first();
        $slides = Slide::oldest()->get();
        $categories = Category::with('blogs')->oldest()->get();
        return view('front.books', [
            'books' => $books, 
            'blogsAll' => $blogsAll, 
            'latestBlogs' => $latestBlogs, 
            'setting' => $setting, 
            'categories'=>$categories,
            'slides'=>$slides,
        ]);
    }

    
    public function book($slug){
        $setting = Setting::first();
        $book = Book::with('comments')->where('slug',$slug)->firstOrFail();
        $relatedBooks = Book::where('id','!=',$book->id)->latest()->get();
        $comments = $book->comments()->latest()->get();
        $totalComments = $comments->count();
        return view('front.book',[
            'book'=>$book,
            'setting'=>$setting,
            'relatedBooks'=>$relatedBooks,
            'comments'=>$comments,
            'totalComments'=>$totalComments,
            ]);

    }

    public function confirmReading(Request $request)
{
    // Validate the form inputs
    $validatedData = $request->validate([
        'email' => 'required|email',
        'book_id' => 'required|exists:books,id', // Ensure book_id exists in books table
    ]);

    $email = $validatedData['email'];
    $bookId = $validatedData['book_id'];

    // Find or create the reader
    $reader = Reader::firstOrCreate(['email' => $email]);

    // If the reader does not exist, something went wrong
    if (!$reader) {
        return redirect()->back()->with('error', 'Something went wrong. Please try again.');
    }

    // Find or create the association of the reader with the book
    $readerBook = ReaderBook::firstOrCreate(
        ['reader_id' => $reader->id, 'book_id' => $bookId],
        ['times_read' => 0, 'downloaded' => false]
    );

    // Increment the times_read
    $readerBook->increment('times_read');

    // Log the read action
    ReaderBookRead::create([
        'reader_id' => $reader->id,
        'book_id' => $bookId,
        'read_at' => now(),
    ]);

    // Redirect with view permission
    return redirect()->back()->with('view_pdf', true);
}




    public function blogs() {
        $blogs = Blog::where('status', 'Published')->latest()->limit(6)->get();
        $blogsAll = Blog::where('status', 'Published')->latest()->get();
        $latestBlogs = Blog::withCount('likes')->where('status', 'Published')->latest()->paginate(10);
        $setting = Setting::first();
        $slides = Slide::oldest()->get();
        $categories = Category::with('blogs')->oldest()->get();
        return view('front.blogsAll', [
            'blogs' => $blogs, 
            'blogsAll' => $blogsAll, 
            'latestBlogs' => $latestBlogs, 
            'setting' => $setting, 
            'categories'=>$categories,
            'slides'=>$slides,
        ]);
    }

    public function blogsAll() {
        $blogs = Blog::where('status', 'Published')->latest()->limit(6)->get();
        $blogsAll = Blog::where('status', 'Published')->latest()->get();
        $latestBlogs = Blog::withCount('likes')->where('status', 'Published')->latest()->paginate(10);
        $setting = Setting::first();
        $slides = Slide::oldest()->get();
        $categories = Category::with('blogs')->oldest()->get();
        return view('front.blogsAll', [
            'blogs' => $blogs, 
            'blogsAll' => $blogsAll, 
            'latestBlogs' => $latestBlogs, 
            'setting' => $setting, 
            'categories'=>$categories,
            'slides'=>$slides,
        ]);
    }

    public function likeBlog($id)
    {
        $blog = Blog::findOrFail($id);
        
        // Increment the likes count
        $blog->increment('likes_count'); 
        
        return response()->json(['likes_count' => $blog->likes_count]); 
    }

    public function programs() {

        $programs = Program::oldest()->get();
        $setting = Setting::first();
        return view('front.programs', [
            'programs' => $programs, 
            'setting' => $setting, 
        ]);
    }

    public function program($slug){
        $setting = Setting::first();
        $program = Program::where('slug',$slug)->firstOrFail();

        return view('front.program',[
            'program'=>$program,
            'setting'=>$setting,
            ]);

    }
    

    public function categoryPodcasts($id) {
        \Log::info('Category ID: ' . $id);
 
        $podcatsCategories = Podcastcategory::with('podcasts')->oldest()->get();

        $categ = Podcastcategory::findOrFail($id); 
        $podcasts = $categ->podcasts()->where('podcastCategory_id', $categ->id)->latest()->paginate(10);
   
        $setting = Setting::first();
        $girlchess = Girlchess::first();
        $categories = Category::with('blogs')->oldest()->get();
        return view('front.podcasts', [
            'categories' => $categories,
            'podcasts' => $podcasts,
            'podcatsCategories' => $podcatsCategories, 
            'categ' => $categ, 
            'setting' => $setting,
            'girlchess' => $girlchess,
        ]);
    }
    
    public function podcasts(){
        $home = Aboutus::first();
        $setting = Setting::first();
        $blogs = Blog::where('status', 'Published')->latest()->limit(6)->get();
        $slides = Slide::oldest()->get();
        $categories = Category::with('blogs')->oldest()->get();
        $podcasts = Podcast::latest()->paginate(20);
        $events = Event::latest()->get();
        return view('front.podcastsAll',[
            'home'=>$home,
            'setting'=>$setting,
            'blogs'=>$blogs,
            'categories'=>$categories,
            'podcasts'=>$podcasts,
            'events'=>$events,
            'slides'=>$slides,
        ]);
    }



    public function registerNow(Request $request){
        $review = Guest::create([
            'names' => $request->input('names'),
            'email' => $request->input('email'),
            'phone' => $request->input(key: 'phone'),
            'address' => $request->input(key: 'address'),
            'description' => $request->input('description'),
            'occupation' => $request->input('occupation'),
            'dob' => $request->input('dob'),
        ]);
    
        if (!$review) {
            return redirect()->back()->with('error', 'Failed to submit your registration. Please try again.');
        }
    
        return redirect()->back()->with('success', 'Your registration has submitted successfully!');
    }

public function aboutus(){
    $setting = Setting::first();
    $categories = Category::with('blogs')->oldest()->get();
    $about = About::first();
    $staff = Team::oldest()->get();
    $images = Slide::oldest()->get();
    $events= Event::where('status','Published')->latest()->paginate(2);
    return view('front.about',[
        'setting'=>$setting,
        'categories'=>$categories,
        'staff'=>$staff,
        'events'=>$events,
        'about'=>$about,
        'images'=>$images,
    ]);
}



public function connect(){
    $setting = Setting::first();
    $blogs = Blog::where('status', 'Published')->latest()->limit(6)->get();
    $categories = Category::with('blogs')->oldest()->get();
    $data = About::first();
    $slides = Slide::oldest()->get();
    $events= Event::where('status','Published')->latest()->paginate(2);
    return view('front.contact',[
        'setting'=>$setting,
        'blogs'=>$blogs,
        'events'=>$events,
        'data'=>$data,
        'categories'=>$categories,
        'slides'=>$slides,
    ]);
}

    public function getSignup(){
        $setting = About::first();
        return view('frontend.pages.signup',[
            'setting'=>$setting,
        ]);
    }
    public function signin(){
        $cart = session('cart', []);
        return view('web.login',[
            'cart'=>$cart,
        ]);
    }

    public function logouts()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'guest',
            'status' => 'active',
        ]);
        return redirect()->back()->with('success','User Created');
    }

    public function adminLogin(){
        $home = Aboutus::first();
        $setting = Setting::first();
        $categories = Category::with('blogs')->oldest()->get();
        $podcasts = Podcast::latest()->paginate(20);
        
        $events = Event::latest()->get();
        return view('front.login',[
            'home'=>$home,
            'setting'=>$setting,
            'categories'=>$categories,
            'podcasts'=>$podcasts,
            'events'=>$events,
        ]);
    }

    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            
            // Redirect admins and editors to dashboard
            if ($user->isAdminOrEditor() && $user->status === 'active') {
                return redirect()->route('dashboard')->with('success', 'Welcome back!');
            }
            
            // Normal users (guests) stay on public pages but can see "My Courses" button
            return redirect()->back()->with('success', 'You are logged in successfully!');
        }

        return redirect()->back()->withErrors(['login' => 'Invalid credentials, please try again.']);
    }


    public function subscribe(Request $request) {
        $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('subscribers', 'email'),
            ],
            'fName' => 'required',
            //'lName' => 'required',
        ]);

        $email = $request->input('email');
        $fName = $request->input('fName');
       // $lName = $request->input('lName');

        $subscribed = Subscriber::create([
            'email' => $email,
            'fName' => $fName,
            //'lName' => $lName,
        ]);


        if($subscribed){
            // $subscriber = Subscriber::where('email', $email)->firstOrFail();
            // Mail::to("mukizaemma34@gmail.com")->send(new NewSubscriberNotification($subscriber));
    
            return redirect()->back()->with('success', 'Thank you for subscribing to La Claire Fontaine newsletters');
        }

        else{
            return redirect()->back()->with('error', 'Something Went Wrong. Try again later!');
        }        
    
    }

    // public function subscribe(Request $request){
    //     $request->validate([
    //         'email' => 'required|email'
    //     ]);
    
    //     try {
    //         if (Newsletter::isSubscribed($request->email)) {
    //             return redirect()->back()->with('error', 'Email already subscribed');
    //         } else {
    //             Newsletter::subscribe($request->email);
    //             return redirect()->back()->with('success', 'Thanks for Subscribing to our Newsletters!');
    //         }
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', $e->getMessage());
    //     }
    // }
    

    public function sendMessage(Request $request) {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'names' => 'required|string',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);
    
        $message = Message::create($validatedData);
    
        // try {
        //     Mail::to("mukizaemma34@gmail.com")->send(new MessageNotification($message));
        // } catch (\Exception $e) {
        //     return redirect()->back()->with('error', 'There was an issue sending your message. Please try again later.');
        // }
    
        return redirect()->back()->with('success', 'Thank you for reaching out to La Claire Fontaine, we will get back to you');
    }

    public function testimony(Request $request){

        $review = Review::create([
            'names' => $request->input('names'),
            'email' => $request->input('email'),
            'testimony' => $request->input('testimony'),
        ]);
    
        if (!$review) {
            return redirect()->back()->with('error', 'Failed to submit your testimony. Please try again.');
        }
    
        return redirect()->back()->with('success', 'Your testimony has submitted successfully!');
    }

    public function sendComment(Request $request) {
        $user = auth()->user();
    
        $comment = BlogComment::create([
            'blog_id' => $request->input('blog_id'),
            'names' => $request->input('names'),
            'email' => $request->input('email'),
            'comment' => $request->input('comment'),
            'user_id' => $user ? $user->id : null,
        ]);
    
        if ($comment) {
            // Mail::to('mukizaemma34@gmail.com')->send(new BlogCommentsNotofications($comment));
            return redirect()->back()->with('success', 'Comment added successfully');
        }
    
        else{
            return redirect()->back()->with('error', 'Failed to add the comment. Please try again.');
        }
    }

    public function bookComment(Request $request) {
        $user = auth()->user();
    
        $comment = Bookcomment::create([
            'book_id' => $request->input('book_id'),
            'names' => $request->input('names'),
            'email' => $request->input('email'),
            'comment' => $request->input('comment'),
            'user_id' => $user ? $user->id : null,
        ]);
    
        if ($comment) {
            // Mail::to('mukizaemma34@gmail.com')->send(new BlogCommentsNotofications($comment));
            return redirect()->back()->with('success', 'Thanks for sharing your reflections. ');
        }
    
        else{
            return redirect()->back()->with('error', 'Failed to add the comment. Please try again.');
        }
    }

    // Show CMS Page
    public function showPage($slug)
    {
        $page = Page::where('slug', $slug)->where('is_published', true)->firstOrFail();
        $setting = Setting::first();
        
        return view('front.page', [
            'page' => $page,
            'setting' => $setting,
        ]);
    }

    // Courses Index
    public function coursesIndex()
    {
        $courses = Course::where('status', 'active')->latest()->get();
        $setting = Setting::first();
        
        return view('front.courses', [
            'courses' => $courses,
            'setting' => $setting,
        ]);
    }

    // Show Single Course
    public function showCourse($id)
    {
        $course = Course::where('id', $id)->where('status', 'active')->firstOrFail();
        $relatedCourses = Course::where('id', '!=', $course->id)
            ->where('status', 'active')
            ->latest()
            ->limit(3)
            ->get();
        $setting = Setting::first();
        
        return view('front.course', [
            'course' => $course,
            'relatedCourses' => $relatedCourses,
            'setting' => $setting,
        ]);
    }

}
