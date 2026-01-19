<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseRegistration;
use App\Models\Course;
use App\Models\Setting;
use Illuminate\Http\Request;

class CourseRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = CourseRegistration::with('course')->latest();

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $registrations = $query->paginate(20);
        $setting = Setting::first();
        
        return view('admin.course-registrations.index', compact('registrations', 'setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $setting = Setting::first();
        return view('admin.course-registrations.create', compact('setting'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $course)
    {
        // Handle both route model binding and ID
        $courseId = is_object($course) ? $course->id : $course;
        
        // Verify course exists
        $courseModel = Course::findOrFail($courseId);
        
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'motivation' => 'required|string',
        ]);

        $validated['course_id'] = $courseId;
        $validated['status'] = 'pending';

        $registration = CourseRegistration::create($validated);

        // Send email notification
        try {
            Mail::to('info@lacfontaine.org')->send(new CourseRegistrationNotification($registration));
        } catch (\Exception $e) {
            \Log::error('Failed to send course registration email: ' . $e->getMessage());
        }

        return redirect()->back()
            ->with('success', 'Your registration for "' . $courseModel->title . '" has been submitted successfully! We will review it and get back to you soon.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseRegistration $courseRegistration)
    {
        $setting = Setting::first();
        return view('admin.course-registrations.show', compact('courseRegistration', 'setting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseRegistration $courseRegistration)
    {
        $setting = Setting::first();
        return view('admin.course-registrations.edit', compact('courseRegistration', 'setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseRegistration $courseRegistration)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'motivation' => 'required|string',
            'status' => 'required|in:pending,approved,rejected',
            'admin_comment' => 'nullable|string',
        ]);

        $courseRegistration->update($validated);

        return redirect()->route('admin.course-registrations.index')
            ->with('success', 'Registration updated successfully.');
    }

    /**
     * Approve a registration
     */
    public function approve(CourseRegistration $courseRegistration)
    {
        $courseRegistration->update([
            'status' => 'approved',
        ]);

        return redirect()->back()
            ->with('success', 'Registration approved successfully.');
    }

    /**
     * Reject a registration
     */
    public function reject(Request $request, CourseRegistration $courseRegistration)
    {
        $validated = $request->validate([
            'admin_comment' => 'nullable|string',
        ]);

        $courseRegistration->update([
            'status' => 'rejected',
            'admin_comment' => $validated['admin_comment'] ?? null,
        ]);

        return redirect()->back()
            ->with('success', 'Registration rejected.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseRegistration $courseRegistration)
    {
        $courseRegistration->delete();

        return redirect()->route('admin.course-registrations.index')
            ->with('success', 'Registration deleted successfully.');
    }
}
