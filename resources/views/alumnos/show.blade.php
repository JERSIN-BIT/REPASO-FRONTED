@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Detalle del alumno</h2>

        <p><strong>ID:</strong> {{ $alumno['id'] }}</p>
        <p><strong>Nombre:</strong> {{ $alumno['nombre'] }} {{ $alumno['apellidos'] }}</p>
        <p><strong>Fecha de nacimiento:</strong> {{ $alumno['fecha_nacimiento'] ?? 'No registrada' }}</p>
        <p><strong>Expediente:</strong> {{ $alumno['expediente'] }}</p>
        <p><strong>Módulo ID:</strong> {{ $alumno['modulo_id'] ?? 'Sin módulo' }}</p>

        @if(!empty($alumno['foto']))
            <p><strong>Foto:</strong></p>
            <img src="{{ $alumno['foto'] }}" width="150" alt="Foto" class="mb-3"><br>
        @else
            <p><strong>Foto:</strong> Sin foto</p>
        @endif

        <a href="{{ route('alumnos.index') }}" class="btn btn-secondary">Regresar</a>
    </div>
@endsection