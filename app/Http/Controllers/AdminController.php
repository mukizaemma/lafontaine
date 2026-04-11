<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Setting;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Models\Articlecomment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use App\Mail\CommentApprovalNotification;
use App\Models\BlogComment;
use App\Models\Book;
use App\Models\Message;
use App\Models\Reader;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $subscribers = Subscriber::latest()->paginate(20);

        $totalBooks = Book::count();

        if ($totalBooks == 0) {
            // Show a message
            echo "No books available yet.";
        } else {
            echo "Total books: " . $totalBooks;
        }
        $data = Setting::first();

        $messages = Message::latest()->paginate(10);
        $messageCount = $messages->count();

        $setting = Setting::first();
        return view('admin.dashboard',[
            // 'blogCommetsCount' =>$blogCommetsCount,
            'messageCount'=>$messageCount,
            'subscribers'=>$subscribers,
            'users'=>$users,
            'data'=>$data,
            'totalBooks'=>$totalBooks,
            'setting'=>$setting,
        ]);
    }

    public function users(){
        $users = User::all();
        $setting = Setting::first();
        return view('admin.users',[
            'users'=>$users,
            'setting'=>$setting
        ]);
    }

    public function makeAdmin($id)
    {
        $user = User::findOrFail($id);

        if ($user->isSuperAdmin()) {
            return redirect()->back()->with('error', 'Cannot change the super admin account.');
        }

        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        return redirect()->back()->with('success', 'User is now an admin');
    }

    public function resetUserPassword(Request $request, User $user)
    {
        $validated = $request->validate([
            'password' => ['required', 'string', Password::defaults(), 'confirmed'],
        ]);

        $user->password = Hash::make($validated['password']);
        $user->save();

        return redirect()->back()->with('success', 'Password updated for '.$user->email.'.');
    }

    public function toggleUserLogin(User $user)
    {
        if ($user->isSuperAdmin()) {
            return redirect()->back()->with('error', 'Super admin accounts cannot be restricted.');
        }

        if (Auth::id() === $user->id) {
            return redirect()->back()->with('error', 'You cannot change your own login access here.');
        }

        $user->status = $user->status === 'active' ? 'inactive' : 'active';
        $user->save();

        $message = $user->status === 'active'
            ? 'Login access enabled for '.$user->email.'.'
            : 'Login access restricted for '.$user->email.'.';

        return redirect()->back()->with('success', $message);
    }

    public function destroyUser(User $user)
    {
        if ($user->isSuperAdmin()) {
            return redirect()->back()->with('error', 'Cannot delete the super admin account.');
        }

        if (Auth::id() === $user->id) {
            return redirect()->back()->with('error', 'Cannot delete your own account.');
        }

        $user->delete();

        return redirect()->back()->with('success', 'User removed.');
    }


    public function blogsComment(Request $request)
    {
        $filter = $request->input('filter', 'all'); // Get the filter type, default to 'all'
    
        $comments = BlogComment::query();
        $setting = Setting::first();
        if ($filter === 'published') {
            $comments->where('status', 'Published');
        } elseif ($filter === 'unpublished') {
            $comments->where('status', 'Unpublished');
        }
    
        $comments = $comments->latest()->paginate(2);
    
        return view('admin.posts.comments', [
            'comments' => $comments,
            'filter' => $filter,
            'setting' => $setting,
        ]);
    }
    

    public function commentApprove(BlogComment $comment){

        if($comment->status !=='Published'){
            $comment->status='Published';
            $comment->save();

            $user = $comment->user;

            if($user){
                $details = [
                    'greeting' => 'Hello ' . $user->name . '!',
                    'body' => 'Thank you so much for your helpful comment',
                    'lastline' => 'Blessings!',
                ];
                Mail::to($user->email)->queue(new CommentApprovalNotification($details));
                return redirect()->route('blogsComment')->with('success', 'Comment approved successfully');
            }
        }
        return redirect()->back()->with('error', 'Unable to approve comment');

    }

    public function destroyBlogComment($id)
    {
        $comment = BlogComment::find($id); 
        $comment->delete($id);
        return back()
            ->with('success', 'Comment deleted successfully');
    }

    public function subscribers(){
        $setting = Setting::first();
        $subscribers = Reader::latest()->paginate(20);
        $totalSubs = $subscribers->count();
        return view('admin.posts.subscribers',[
            'subscribers'=>$subscribers,
            'totalSubs'=>$totalSubs,
            'setting'=>$setting,
        ]);
    }

    public function exportSubscribers()
{
    // Get all subscribers
    $subscribers = Reader::all();

    // Define the filename
    $filename = 'subscribers_' . now()->format('Y_m_d_H_i_s') . '.csv';

    // Open a file in write mode
    $handle = fopen('php://output', 'w');

    // Set the headers for the CSV file
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Pragma: no-cache');
    header('Expires: 0');

    // Add the column headers to the CSV
    fputcsv($handle, ['Emails']);

    // Add the subscriber data to the CSV
    foreach ($subscribers as $subscriber) {
        fputcsv($handle, [$subscriber->email]);
    }

    // Close the file handle
    fclose($handle);
    exit();
}

    
    public function destroySub($id)
    {
        $subscriber = Reader::find($id); 
        $subscriber->delete($id);
        return back()
            ->with('success', 'Subscriber deleted successfully');
    }
    public function getMessages(){
        $messages = Message::latest()->paginate(10);
        return view('admin.posts.messages',[
            'messages'=>$messages,
        ]);
    }

    
    public function deleteMessages($id)
    {
        $subscriber = Message::find($id); 
        $subscriber->delete($id);
        return back()
            ->with('success', 'Message deleted successfully');
    }

    // public function visits()
    // {
    //     $totalVisits = DB::table('visits')->count();
    //     $uniqueVisitors = DB::table('visits')->distinct('ip_address')->count();


    //     return view('admin.dashboard',[
    //         'totalVisits'=>$totalVisits,
    //         'uniqueVisitors'=>$uniqueVisitors,
    //     ]);
    // }

}
