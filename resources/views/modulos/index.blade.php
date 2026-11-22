@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Módulos</h2>
        <a href="{{ route('modulos.create') }}" class="btn btn-primary mb-3">Nuevo módulo</a>

        <!-- Recorre todos los módulos que llegaron del API -->
        @forelse($modulos as $modulo)
            <div class="border p-3 mb-2">
                <p><strong>{{ $modulo['codigo'] }}</strong> - {{ $modulo['nombre'] }}</p>

                <a href="{{ route('modulos.show', $modulo['id']) }}" class="btn btn-sm btn-info">Ver</a>
                <a href="{{ route('modulos.edit', $modulo['id']) }}" class="btn btn-sm btn-warning">Editar</a>

                <!-- Botón para borrar el módulo -->
                <form action="{{ route('modulos.destroy', $modulo['id']) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                </form>
            </div>
        @empty
            <p>No hay módulos registrados.</p>
        @endforelse
    </div>
@endsection