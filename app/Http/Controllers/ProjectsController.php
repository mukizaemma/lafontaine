<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProjectsController extends Controller
{
    public function index()
    {
        function limitText($text, $limit = 100) {
            if (strlen($text) <= $limit) {
                return $text;
            }
            return substr($text, 0, $limit) . '...';
        }

        $projects = Project::latest()->get()->map(function ($project) {
            $project->problem = limitText(strip_tags($project->problem), 100);
            return $project;
        });

        $programs = Program::latest()->get();
        return view('admin.projects',[
            'projects'=>$projects,
            'programs'=>$programs,
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'program_id' => 'required|exists:programs,id',
        ];
    
        $validate = Validator::make($request->all(), $rules);
    
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }
    
        $slug = Str::of($request->input('title'))->slug();
    
        $project = new Project();
        $project->title = $request->input('title');
        $project->program_id = $request->input('program_id');
        $project->problem = $request->input('problem');
        $project->slug = $slug;
        $project->user_id = Auth::id();
    
        $dir = 'public/images/projects/';
        if ($request->hasFile('image')) {
            $fileName = $request->file('image')->store($dir);
            $project->image = str_replace($dir, '', $fileName);
        }
    
        $project->save();
    
        return redirect()->route('getProjects')->with('success', 'Project created successfully.');
    }
    


    public function edit($id)
    {
        $project = Project::find($id);
        // $project = Project::where('id',$id)->first();
        $programs = Program::all();
        return view('admin.projectUpdate',[
            'project'=>$project,
            'programs'=>$programs,
        ]);
    }

    public function update(Request $request, string $id)
    {
        try {
            $validated = $request->validate([
                'title' => 'required',
                'problem' => 'nullable',
                'image' => 'nullable|image',
            ]);
    
            $newSlug = Str::of($validated['title'])->slug();
    
            if (Project::where('slug', $newSlug)->where('id', '<>', $id)->exists()) {
                $i = 1;
                do {
                    $i++;
                    $slugCandidate = $newSlug . '-' . $i;
                } while (Project::where('slug', $slugCandidate)->exists());
    
                $newSlug = $slugCandidate;
            }
    
            $updateData = [
                'title' => $validated['title'],
                'problem' => $validated['problem'],
                'slug' => $newSlug,
            ];
    
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $file->store('public/images/projects');
                $fileName = basename($path);
                
                $updateData['image'] = $fileName;
    
                // Remove old image
                $oldImage = Project::findOrFail($id)->image;
                if ($oldImage && Storage::exists('public/images/projects/' . $oldImage)) {
                    Storage::delete('public/images/projects/' . $oldImage);
                }
            }
    
            Project::where('id', $id)->update($updateData);
    
            return redirect()->route('getProjects')->with('success', 'Project has been updated successfully');
        } catch (\Exception $e) {
            \Log::error('Error updating project: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
    
    


    public function destroy($id)
    {
        $post = Project::findOrFail($id);

        // Delete the post
        $post->delete();

        return redirect()->route('getProjects')->with('success', 'Data has been deleted');

    
    }

    public function deleteAllProjects()
    {

        Project::query()->delete();

        return redirect()->route('getProjects')->with('success', 'All projects have been deleted successfully.');
    }
}
