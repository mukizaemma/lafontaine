<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImpactStat;
use App\Models\Setting;
use Illuminate\Http\Request;

class ImpactStatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stats = ImpactStat::latest()->paginate(20);
        $setting = Setting::first();
        return view('admin.impact-stats.index', compact('stats', 'setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $setting = Setting::first();
        return view('admin.impact-stats.create', compact('setting'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
        ]);

        ImpactStat::create($validated);

        return redirect()->route('admin.impact-stats.index')
            ->with('success', 'Impact stat created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ImpactStat $impactStat)
    {
        $setting = Setting::first();
        return view('admin.impact-stats.show', compact('impactStat', 'setting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ImpactStat $impactStat)
    {
        $setting = Setting::first();
        return view('admin.impact-stats.edit', compact('impactStat', 'setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ImpactStat $impactStat)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
        ]);

        $impactStat->update($validated);

        return redirect()->route('admin.impact-stats.index')
            ->with('success', 'Impact stat updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ImpactStat $impactStat)
    {
        $impactStat->delete();

        return redirect()->route('admin.impact-stats.index')
            ->with('success', 'Impact stat deleted successfully.');
    }
}
