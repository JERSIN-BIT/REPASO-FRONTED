@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Alumnos</h2>
        <a href="{{ route('alumnos.create') }}" class="btn btn-primary mb-3">Nuevo alumno</a>

        <!-- Recorre la lista de alumnos que mandó el controlador -->
        @forelse($alumnos as $alumno)
            <div class="border p-3 mb-2">
                <p><strong>{{ $alumno['nombre'] }} {{ $alumno['apellidos'] }}</strong> - Expediente: {{ $alumno['expediente'] }}</p>
                <p>Módulo ID: {{ $alumno['modulo_id'] ?? 'Sin módulo' }}</p>

                <!-- Muestra la foto si el alumno tiene una -->
                @if(!empty($alumno['foto']))
                    <img src="{{ $alumno['foto'] }}" width="100" alt="Foto" class="mb-2"><br>
                @else
                    <p>Sin foto</p>
                @endif

                <a href="{{ route('alumnos.show', $alumno['id']) }}" class="btn btn-sm btn-info">Ver</a>
                <a href="{{ route('alumnos.edit', $alumno['id']) }}" class="btn btn-sm btn-warning">Editar</a>

                <!-- Botón para borrar el alumno -->
                <form action="{{ route('alumnos.destroy', $alumno['id']) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                </form>
            </div>
        @empty
            <p>No hay alumnos registrados.</p>
        @endforelse
    </div>
@endsection