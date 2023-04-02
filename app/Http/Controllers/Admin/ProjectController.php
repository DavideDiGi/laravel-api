<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

// Helpers
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

// Models
use App\Models\Type;
use App\Models\Technology;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();

        if (array_key_exists('cover_pic', $data)) {
            $cover_pic_path = Storage::put('projects', $data['cover_pic']);
            $data['cover_pic'] = $cover_pic_path;
        }

        $data['slug'] = Str::slug($data['title']);

        $newProject = Project::create($data);

        if (array_key_exists('technologies', $data)) {
            $newProject->technologies()->sync($data['technologies']);
        }

        return redirect()->route('admin.projects.show', $newProject->id)->with('success', 'Progetto aggiunto con successo!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();


        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {

        $data = $request->validated();

        if (array_key_exists('delete_pic', $data)) {
            if ($project->cover_pic) {
                Storage::delete($project->cover_pic);

                $project->cover_pic = null;
                $project->save();
            }
        } else if (array_key_exists('cover_pic', $data)) {
            $cover_pic_path = Storage::put('projects', $data['cover_pic']);
            $data['cover_pic'] = $cover_pic_path;

            if ($project->cover_pic) {
                Storage::delete($project->cover_pic);
            }
        }

        // $oldTitle = $project->title;
        // $oldContent = $project->content;
        // $oldCover = $project->cover_pic;

        $data['slug'] = Str::slug($data['title']);

        $project->update($data);


        if (array_key_exists('technologies', $data)) {
            $project->technologies()->sync($data['technologies']);
        } else {
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', $project->id)->with('success', 'Progetto modificato con successo!');

        // if ($oldTitle == $project->title && $oldContent == $project->content && $oldCover == $project->cover_pic) {
        //     return redirect()->route('admin.projects.edit', $project->id)->with('success', 'Non hai modificato nessun dato');
        // } else {
        //     return redirect()->route('admin.projects.show', $project->id)->with('success', 'Progetto modificato con successo!');
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if ($project->cover_pic) {
            Storage::delete($project->cover_pic);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Progetto eliminato!');
    }
}
