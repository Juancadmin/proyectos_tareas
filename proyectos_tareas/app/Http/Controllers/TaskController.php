<?php
use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Project $project)
    {
        $tasks = $project->tasks;
        return view('tasks.index', compact('project', 'tasks'));
    }

    public function create(Project $project)
    {
        return view('tasks.create', compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:pendiente,en progreso,completada',
            'due_date' => 'required|date',
        ]);

        $project->tasks()->create($request->all());

        return redirect()->route('projects.tasks.index', $project)->with('success', 'Tarea creada');
    }

    public function edit(Project $project, Task $task)
    {
        return view('tasks.edit', compact('project', 'task'));
    }

    public function update(Request $request, Project $project, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:pendiente,en progreso,completada',
            'due_date' => 'required|date',
        ]);

        $task->update($request->all());

        return redirect()->route('projects.tasks.index', $project)->with('success', 'Tarea actualizada');
    }

    public function destroy(Project $project, Task $task)
    {
        $task->delete();
        return redirect()->route('projects.tasks.index', $project)->with('success', 'Tarea eliminada');
    }
}
