@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Editar profesor</h2>

        <!-- Envía los cambios del profesor -->
        <form action="{{ route('profesores.update', $profesor['id']) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-2">
                <label>Nombre:</label><br>
                <input type="text" name="nombre" value="{{ old('nombre', $profesor['nombre']) }}" required>
            </div>

            <div class="mb-2">
                <label>Apellido:</label><br>
                <input type="text" name="apellido" value="{{ old('apellido', $profesor['apellido']) }}" required>
            </div>

            <div class="mb-2">
                <label>Cédula:</label><br>
                <input type="text" name="cedula" value="{{ old('cedula', $profesor['cedula']) }}" required>
            </div>

            <div class="mb-3">
                <label>Teléfono:</label><br>
                <input type="text" name="telefono" value="{{ old('telefono', $profesor['telefono'] ?? '') }}">
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('profesores.index') }}" class="btn btn-secondary">Regresar</a>
        </form>
    </div>
@endsection