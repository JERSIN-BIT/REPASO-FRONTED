@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Registrar profesor</h2>

        <!-- Envía los datos del nuevo profesor -->
        <form action="{{ route('profesores.store') }}" method="POST">
            @csrf

            <div class="mb-2">
                <label>Nombre:</label><br>
                <input type="text" name="nombre" value="{{ old('nombre') }}" required>
            </div>

            <div class="mb-2">
                <label>Apellido:</label><br>
                <input type="text" name="apellido" value="{{ old('apellido') }}" required>
            </div>

            <div class="mb-2">
                <label>Cédula:</label><br>
                <input type="text" name="cedula" value="{{ old('cedula') }}" required>
            </div>

            <div class="mb-3">
                <label>Teléfono:</label><br>
                <input type="text" name="telefono" value="{{ old('telefono') }}">
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('profesores.index') }}" class="btn btn-secondary">Regresar</a>
        </form>
    </div>
@endsection