<?php


namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects;
        return view('project_.index', compact('projects'));
    }

    public function create()
    {
        return view('project_.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
        ]);

        auth()->user()->projects()->create($request->all());

        return redirect()->route('home')->with('success', 'Proyecto creado correctamente');

    }

    public function show(Project $project)
{
    $this->authorizeAccess($project);
    $project->load('tasks'); 
    return view('project_.show', compact('project'));
}

    public function edit(Project $project)
    {
        $this->authorizeAccess($project);
        return view('project_.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $this->authorizeAccess($project);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
        ]);

        $project->update($request->all());

        return redirect()->route('home')->with('success', 'Proyecto actualizado correctamente');
    }

    public function destroy(Project $project)
    {
        $this->authorizeAccess($project);
        $project->delete();

        return redirect()->route('home')->with('success', 'Proyecto eliminado');
    }

    private function authorizeAccess(Project $project)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403, 'No autorizado');
        }
    }
}
