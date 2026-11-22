@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Detalle del profesor</h2>

        <p><strong>ID:</strong> {{ $profesor['id'] }}</p>
        <p><strong>Nombre:</strong> {{ $profesor['nombre'] }} {{ $profesor['apellido'] }}</p>
        <p><strong>Cédula:</strong> {{ $profesor['cedula'] }}</p>
        <p><strong>Teléfono:</strong> {{ $profesor['telefono'] ?? 'No registrado' }}</p>

        <!-- Muestra los módulos asociados al profesor si vienen en la respuesta -->
        <h4>Módulos asignados</h4>
        @if(!empty($profesor['modulos']))
            <ul>
                @foreach($profesor['modulos'] as $modulo)
                    <li>{{ $modulo['codigo'] }} - {{ $modulo['nombre'] }}</li>
                @endforeach
            </ul>
        @else
            <p>Sin módulos asignados.</p>
        @endif

        <a href="{{ route('profesores.index') }}" class="btn btn-secondary mt-2">Regresar</a>
    </div>
@endsection