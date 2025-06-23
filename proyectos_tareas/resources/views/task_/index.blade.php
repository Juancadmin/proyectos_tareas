@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tareas del Proyecto: {{ $project->name }}</h2>

    <a href="{{ route('projects.tasks.create', $project) }}" class="btn btn-primary mb-3">
        + Nueva Tarea
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($tasks->count())
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Título</th>
                <th>Estado</th>
                <th>Fecha Límite</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ ucfirst($task->status) }}</td>
                <td>{{ $task->due_date }}</td>
                <td>
                    <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="btn btn-sm btn-warning">
                        Editar
                    </a>

                    <form action="{{ route('projects.tasks.destroy', [$project, $task]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta tarea?')">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <p>No hay tareas registradas para este proyecto.</p>
    @endif
</div>
@endsection
