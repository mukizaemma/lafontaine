<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use App\Models\Setting;
use Illuminate\Http\Request;

class HeroSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heroSections = HeroSection::latest()->paginate(20);
        $setting = Setting::first();
        return view('admin.hero-sections.index', compact('heroSections', 'setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $setting = Setting::first();
        return view('admin.hero-sections.create', compact('setting'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'primary_button_text' => 'nullable|string|max:255',
            'primary_button_link' => 'nullable|string|max:255',
            'secondary_button_text' => 'nullable|string|max:255',
            'secondary_button_link' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        HeroSection::create($validated);

        return redirect()->route('admin.hero-sections.index')
            ->with('success', 'Hero section created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(HeroSection $heroSection)
    {
        $setting = Setting::first();
        return view('admin.hero-sections.show', compact('heroSection', 'setting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HeroSection $heroSection)
    {
        $setting = Setting::first();
        return view('admin.hero-sections.edit', compact('heroSection', 'setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HeroSection $heroSection)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'primary_button_text' => 'nullable|string|max:255',
            'primary_button_link' => 'nullable|string|max:255',
            'secondary_button_text' => 'nullable|string|max:255',
            'secondary_button_link' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $heroSection->update($validated);

        return redirect()->route('admin.hero-sections.index')
            ->with('success', 'Hero section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HeroSection $heroSection)
    {
        $heroSection->delete();

        return redirect()->route('admin.hero-sections.index')
            ->with('success', 'Hero section deleted successfully.');
    }
}
