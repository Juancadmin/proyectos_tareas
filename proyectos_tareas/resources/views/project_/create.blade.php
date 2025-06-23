@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Nuevo Proyecto</h2>

    <form method="POST" action="{{ route('projects.store') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Proyecto</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Fecha de Inicio</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar Proyecto</button>
    </form>
</div>
@endsection
