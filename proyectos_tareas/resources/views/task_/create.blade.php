@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Tarea para el Proyecto: {{ $project->name }}</h2>

    <form action="{{ route('projects.tasks.store', $project) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Título de la Tarea</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Estado</label>
            <select name="status" class="form-select" required>
                <option value="pendiente">Pendiente</option>
                <option value="en progreso">En Progreso</option>
                <option value="completada">Completada</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Fecha Límite</label>
            <input type="date" name="due_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar Tarea</button>
        <a href="{{ route('projects.show', $project) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
