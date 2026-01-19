<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PartnershipRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class PartnershipRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PartnershipRequest::latest();

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $requests = $query->paginate(20);
        $setting = Setting::first();
        
        return view('admin.partnership-requests.index', compact('requests', 'setting'));
    }

    /**
     * Display the specified resource.
     */
    public function show(PartnershipRequest $partnershipRequest)
    {
        $setting = Setting::first();
        return view('admin.partnership-requests.show', compact('partnershipRequest', 'setting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PartnershipRequest $partnershipRequest)
    {
        $setting = Setting::first();
        return view('admin.partnership-requests.edit', compact('partnershipRequest', 'setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PartnershipRequest $partnershipRequest)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,reviewed,approved,rejected',
            'admin_feedback' => 'nullable|string',
        ]);

        $partnershipRequest->update($validated);

        return redirect()->route('admin.partnership-requests.index')
            ->with('success', 'Partnership request updated successfully.');
    }

    /**
     * Approve a partnership request
     */
    public function approve(PartnershipRequest $partnershipRequest)
    {
        $partnershipRequest->update([
            'status' => 'approved',
        ]);

        return redirect()->back()
            ->with('success', 'Partnership request approved successfully.');
    }

    /**
     * Reject a partnership request
     */
    public function reject(Request $request, PartnershipRequest $partnershipRequest)
    {
        $validated = $request->validate([
            'admin_feedback' => 'nullable|string',
        ]);

        $partnershipRequest->update([
            'status' => 'rejected',
            'admin_feedback' => $validated['admin_feedback'] ?? null,
        ]);

        return redirect()->back()
            ->with('success', 'Partnership request rejected.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PartnershipRequest $partnershipRequest)
    {
        $partnershipRequest->delete();

        return redirect()->route('admin.partnership-requests.index')
            ->with('success', 'Partnership request deleted successfully.');
    }
}
