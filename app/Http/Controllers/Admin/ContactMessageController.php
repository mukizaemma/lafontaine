<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Setting;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ContactMessage::latest();

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $messages = $query->paginate(20);
        $setting = Setting::first();
        
        return view('admin.contact-messages.index', compact('messages', 'setting'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactMessage $contactMessage)
    {
        $setting = Setting::first();
        
        // Mark as responded if it's new
        if ($contactMessage->status === 'new') {
            $contactMessage->update(['status' => 'responded']);
        }
        
        return view('admin.contact-messages.show', compact('contactMessage', 'setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContactMessage $contactMessage)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,responded,closed',
        ]);

        $contactMessage->update($validated);

        return redirect()->route('admin.contact-messages.index')
            ->with('success', 'Message status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()->route('admin.contact-messages.index')
            ->with('success', 'Message deleted successfully.');
    }
}
