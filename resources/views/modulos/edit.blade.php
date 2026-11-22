@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Editar módulo</h2>

        <!-- Envía los cambios del módulo -->
        <form action="{{ route('modulos.update', $modulo['id']) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-2">
                <label>Código:</label><br>
                <input type="text" name="codigo" value="{{ old('codigo', $modulo['codigo']) }}" required>
            </div>

            <div class="mb-3">
                <label>Nombre:</label><br>
                <input type="text" name="nombre" value="{{ old('nombre', $modulo['nombre']) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('modulos.index') }}" class="btn btn-secondary">Regresar</a>
        </form>
    </div>
@endsection