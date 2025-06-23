@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Proyecto: {{ $project->name }}</h2>

    <form method="POST" action="{{ route('projects.update', $project) }}">
        @csrf @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ $project->name }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" class="form-control" rows="3">{{ $project->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Fecha de Inicio</label>
            <input type="date" name="start_date" class="form-control" value="{{ $project->start_date }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
