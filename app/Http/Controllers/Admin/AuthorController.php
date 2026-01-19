<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Setting;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::withCount('books')->latest()->paginate(20);
        $setting = Setting::first();
        return view('admin.authors.index', compact('authors', 'setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $setting = Setting::first();
        return view('admin.authors.create', compact('setting'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        Author::create($validated);

        return redirect()->route('admin.authors.index')
            ->with('success', 'Author created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        $setting = Setting::first();
        $books = $author->books()->latest()->paginate(20);
        return view('admin.authors.show', compact('author', 'books', 'setting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        $setting = Setting::first();
        return view('admin.authors.edit', compact('author', 'setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $author->update($validated);

        return redirect()->route('admin.authors.index')
            ->with('success', 'Author updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()->route('admin.authors.index')
            ->with('success', 'Author deleted successfully.');
    }
}
