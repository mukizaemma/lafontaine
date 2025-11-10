<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Setting;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationNotifications;

class GuestsController extends Controller
{
    public function index(Request $request) {
        $query = Guest::query();
    
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where('names', 'like', "%{$searchTerm}%")
                  ->orWhere('dob', 'like', "%{$searchTerm}%")
                  ->orWhere('phone', 'like', "%{$searchTerm}%")
                  ->orWhere('email', 'like', "%{$searchTerm}%")
                  ->orWhere('address', 'like', "%{$searchTerm}%")
                  ->orWhere('status', 'like', "%{$searchTerm}%");
        }
    
        $guests = $query->latest()->paginate(10); // Paginate results
        $setting = Setting::first();
    
        return view('admin.events.guests', [
            'guests' => $guests,
            'setting' => $setting,
        ]);
    }
    
    public function approveGuest(Request $request, $id) {
        $guest = Guest::findOrFail($id);
    
        if ($guest->status !== 'Confirmed') {
            $guest->status = 'Confirmed';
            $guest->save();
            
            $details = [
                'greeting' => 'Hello ' . $guest->names . '!',
                'body' => 'Your registration to La Claire Fontaine event has been approved: ' . $guest->title,
                'text' => '' . $guest->description,
                'actiontext' => 'View Story',
                'actionurl' => url('/Updates/' . $guest->slug),
                'lastline' => 'Thank you!',
            ];
    
            // Send the email to the guest
            Mail::to($guest->email)->queue(new ReservationNotifications($details));
        }
    
        return redirect()->route('getGuests')->with('success', 'Registration has been updated successfully');
    }
    
    public function deleteGuest($id){
        $post = Guest::findOrFail($id);    
        $post->delete();    
        return redirect('getGuests')->with('success', 'Data has been deleted');
    } 
}
