@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Mis Proyectos</h2>

    <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">+ Nuevo Proyecto</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($projects->count())
        <div class="list-group">
            @foreach($projects as $project)
                <div class="list-group-item mb-2">
                    <h5 class="mb-1">{{ $project->name }}</h5>
                    <p>{{ $project->description }}</p>
                    <small>Inicio: {{ $project->start_date }}</small>
                    <div class="mt-2">
                        <a href="{{ route('projects.show', $project) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este proyecto?')">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">Aún no tienes proyectos creados.</div>
    @endif
</div>
@endsection
