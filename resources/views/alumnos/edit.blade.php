@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Editar alumno</h2>

        <!-- Envía los cambios del alumno -->
        <form action="{{ route('alumnos.update', $alumno['id']) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-2">
                <label>Nombre:</label><br>
                <input type="text" name="nombre" value="{{ old('nombre', $alumno['nombre']) }}" required>
            </div>

            <div class="mb-2">
                <label>Apellidos:</label><br>
                <input type="text" name="apellidos" value="{{ old('apellidos', $alumno['apellidos']) }}" required>
            </div>

            <div class="mb-2">
                <label>Fecha de nacimiento:</label><br>
                <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $alumno['fecha_nacimiento'] ?? '') }}">
            </div>

            <div class="mb-2">
                <label>Expediente:</label><br>
                <input type="text" name="expediente" value="{{ old('expediente', $alumno['expediente']) }}" required>
            </div>

            <div class="mb-2">
                <label>Módulo ID:</label><br>
                <input type="number" name="modulo_id" value="{{ old('modulo_id', $alumno['modulo_id'] ?? '') }}">
            </div>

            <!-- Muestra la foto que tiene actualmente -->
            @if(!empty($alumno['foto']))
                <p>Foto actual:</p>
                <img src="{{ $alumno['foto'] }}" width="100" alt="Foto" class="mb-2"><br>
            @endif

            <!-- Si no subes foto nueva, mantiene la anterior -->
            <div class="mb-3">
                <label>Nueva foto (opcional):</label><br>
                <input type="file" name="foto" accept=".jpg,.jpeg,.png,.webp">
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('alumnos.index') }}" class="btn btn-secondary">Regresar</a>
        </form>
    </div>
@endsection