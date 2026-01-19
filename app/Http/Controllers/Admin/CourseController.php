<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Setting;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::latest()->paginate(20);
        $setting = Setting::first();
        return view('admin.courses.index', compact('courses', 'setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $setting = Setting::first();
        return view('admin.courses.create', compact('setting'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:Children,Youth,Professional',
            'level' => 'required|in:Beginner,Intermediate,Advanced',
            'description' => 'required|string',
            'duration' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        Course::create($validated);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $setting = Setting::first();
        $registrations = $course->registrations()->latest()->paginate(20);
        return view('admin.courses.show', compact('course', 'registrations', 'setting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $setting = Setting::first();
        return view('admin.courses.edit', compact('course', 'setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:Children,Youth,Professional',
            'level' => 'required|in:Beginner,Intermediate,Advanced',
            'description' => 'required|string',
            'duration' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        $course->update($validated);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course deleted successfully.');
    }
}
