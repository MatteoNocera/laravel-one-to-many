<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderByDesc('id')->paginate(5);
        //dd($projects);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.create', compact('project', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        if (Auth::id() === 1) {

            $project = new Project();

            $val_data = $request->validated();

            if ($request->has('cover_image')) {

                $cover_image_path = Storage::put('placeholders', $request->cover_image);

                if (!is_null($project->cover_image) && Storage::fileExists($project->cover_image)) {
                    Storage::delete($project->cover_image);
                }
                $val_data['cover_image'] = $cover_image_path;
            }

            $val_data['slug'] = Str::slug($request->title, '-');

            //dd($val_data);
            $project->create($val_data);

            return to_route('projects.index', compact('project'))->with('message', 'New Project Created ✅');
        }

        abort(403, '😡🤬You don\'t have permissions');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {

        $trashed_projects = Project::onlyTrashed()->get();
        return view('admin.projects.show', compact('project', 'trashed_projects'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {

        if (Auth::id() === 1) {
            $types = Type::all();
            return view('admin.projects.edit', compact('project', 'types'));
        }
        abort(403, '😡🤬You don\'t have permissions');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {

        if (Auth::id() === 1) {
            $val_data = $request->validated();
            if ($request->has('cover_image')) {
                $path = Storage::put('placeholders', $request->cover_image);
                $val_data['cover_image'] = $path;
            }

            $project->update($val_data);

            return to_route('projects.index')->with('message', 'Project updated successfully ✅');
        }

        abort(403, '😡🤬You don\'t have permissions');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        /* Controllare se c'è la foto nel public se si cancellala */
        /* if (!is_null($project->cover_image)) {
            Storage::delete($project->cover_image);
        } */

        if (Auth::id() === 1) {
            $project->delete();

            return to_route('projects.index')->with('message', 'Delete succesfully ✅');
        }

        abort(403, '😡🤬You don\'t have permissions');
    }

    public function trashed()
    {
        $projects = Project::onlyTrashed()->get();

        return view('admin.projects.trashed', compact('projects'));
    }

    public function restore($id)
    {
        $project = Project::onlyTrashed()->find($id);

        $project->restore();

        return to_route('projects.index')->with('message', 'Restore succesfully ✅');
    }

    public function forceDelete($id)
    {
        $project = Project::onlyTrashed()->find($id);

        $project->forceDelete();

        return to_route('admin.trashed')->with('message', 'Total delete succesfully ✅');
    }
}
