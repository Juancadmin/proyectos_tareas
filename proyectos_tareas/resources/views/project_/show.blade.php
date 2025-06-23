@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $project->name }}</h2>
    <p>{{ $project->description }}</p>
    <p><strong>Fecha de inicio:</strong> {{ $project->start_date }}</p>

    <a href="{{ route('projects.tasks.create', $project) }}" class="btn btn-primary mb-3">+ Nueva Tarea</a>

    <h4 class="mt-4">Tareas del Proyecto</h4>

    @if($project->tasks->count())
        <div class="list-group">
            @foreach($project->tasks as $task)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $task->title }}</strong>
                        <div class="text-muted">
                            Estado: {{ $task->status }} |
                            Fecha límite: {{ $task->due_date }}
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('projects.tasks.destroy', [$project, $task]) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar tarea?')">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info mt-3">Este proyecto no tiene tareas aún.</div>
    @endif

    <a href="{{ route('home') }}" class="btn btn-secondary mt-4">Volver</a>
</div>
@endsection
