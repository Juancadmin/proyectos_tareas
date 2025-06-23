<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Project $project)
    {
        $tasks = $project->tasks;
        return view('task_.index', compact('project', 'tasks'));
    }

    public function create(Project $project)
    {
        return view('task_.create', compact('project'));
    }

   public function store(Request $request, Project $project)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'status' => 'required|in:pendiente,en progreso,completada',
        'due_date' => 'required|date',
    ]);

    $project->tasks()->create($request->only(['title', 'status', 'due_date']));

    return redirect()->route('projects.show', $project)->with('success', 'Tarea creada correctamente');
}


    public function edit(Project $project, Task $task)
    {
        return view('task_.edit', compact('project', 'task'));
    }

    public function update(Request $request, Project $project, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:pendiente,en progreso,completada',
            'due_date' => 'required|date',
        ]);

        $task->update($request->all());

        return redirect()->route('projects.task_.index', $project)->with('success', 'Tarea actualizada');
    }

    public function destroy(Project $project, Task $task)
    {
        $task->delete();
        return redirect()->route('projects.task_.index', $project)->with('success', 'Tarea eliminada');
    }
}
