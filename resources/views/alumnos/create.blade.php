@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Registrar alumno</h2>

        <!-- enctype="multipart/form-data" es obligatorio para mandar archivos/fotos -->
        <form action="{{ route('alumnos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-2">
                <label>Nombre:</label><br>
                <input type="text" name="nombre" value="{{ old('nombre') }}" required>
            </div>

            <div class="mb-2">
                <label>Apellidos:</label><br>
                <input type="text" name="apellidos" value="{{ old('apellidos') }}" required>
            </div>

            <div class="mb-2">
                <label>Fecha de nacimiento:</label><br>
                <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}">
            </div>

            <div class="mb-2">
                <label>Expediente:</label><br>
                <input type="text" name="expediente" value="{{ old('expediente') }}" required>
            </div>

            <div class="mb-2">
                <label>Módulo ID:</label><br>
                <input type="number" name="modulo_id" value="{{ old('modulo_id') }}">
            </div>

            <div class="mb-3">
                <label>Foto:</label><br>
                <input type="file" name="foto" accept=".jpg,.jpeg,.png,.webp">
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('alumnos.index') }}" class="btn btn-secondary">Regresar</a>
        </form>
    </div>
@endsection