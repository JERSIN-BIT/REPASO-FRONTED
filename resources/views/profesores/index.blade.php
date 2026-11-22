@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Profesores</h2>
        <a href="{{ route('profesores.create') }}" class="btn btn-primary mb-3">Nuevo profesor</a>

        <!-- Recorre la lista de profesores -->
        @forelse($profesores as $profesor)
            <div class="border p-3 mb-2">
                <p><strong>{{ $profesor['nombre'] }} {{ $profesor['apellido'] }}</strong> - Cédula: {{ $profesor['cedula'] }}</p>
                <p>Teléfono: {{ $profesor['telefono'] ?? 'No registrado' }}</p>

                <a href="{{ route('profesores.show', $profesor['id']) }}" class="btn btn-sm btn-info">Ver</a>
                <a href="{{ route('profesores.edit', $profesor['id']) }}" class="btn btn-sm btn-warning">Editar</a>

                <!-- Botón para borrar el profesor -->
                <form action="{{ route('profesores.destroy', $profesor['id']) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                </form>
            </div>
        @empty
            <p>No hay profesores registrados.</p>
        @endforelse
    </div>
@endsection