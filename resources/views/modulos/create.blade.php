@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Registrar módulo</h2>

        <!-- Envía código y nombre para guardar el módulo -->
        <form action="{{ route('modulos.store') }}" method="POST">
            @csrf

            <div class="mb-2">
                <label>Código:</label><br>
                <input type="text" name="codigo" value="{{ old('codigo') }}" required>
            </div>

            <div class="mb-3">
                <label>Nombre:</label><br>
                <input type="text" name="nombre" value="{{ old('nombre') }}" required>
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('modulos.index') }}" class="btn btn-secondary">Regresar</a>
        </form>
    </div>
@endsection