@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Detalle del módulo</h2>

        <!-- Datos básicos del módulo -->
        <p><strong>ID:</strong> {{ $modulo['id'] }}</p>
        <p><strong>Código:</strong> {{ $modulo['codigo'] }}</p>
        <p><strong>Nombre:</strong> {{ $modulo['nombre'] }}</p>

        <hr>

        <!-- Formulario para asignar un profesor a este módulo -->
        <h4>Asignar profesor</h4>
        <form action="{{ route('modulos.asignarProfesor', $modulo['id']) }}" method="POST" class="mb-3">
            @csrf
            <select name="profesor_id" required>
                <option value="">Elige un profesor</option>
                @foreach($profesores as $profesor)
                    <option value="{{ $profesor['id'] }}">
                        {{ $profesor['nombre'] }} {{ $profesor['apellido'] }} ({{ $profesor['cedula'] }})
                    </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-sm btn-success">Asignar</button>
        </form>

        <!-- Lista de profesores asignados al módulo -->
        <h4>Profesores del módulo</h4>
        @if(!empty($modulo['profesores']))
            <ul>
                @foreach($modulo['profesores'] as $profesor)
                    <li>{{ $profesor['nombre'] }} {{ $profesor['apellido'] }}</li>
                @endforeach
            </ul>
        @else
            <p>Sin profesores asignados.</p>
        @endif

        <!-- Lista de alumnos inscritos en el módulo -->
        <h4>Alumnos del módulo</h4>
        @if(!empty($modulo['alumnos']))
            <ul>
                @foreach($modulo['alumnos'] as $alumno)
                    <li>{{ $alumno['nombre'] }} {{ $alumno['apellidos'] }}</li>
                @endforeach
            </ul>
        @else
            <p>Sin alumnos registrados.</p>
        @endif

        <a href="{{ route('modulos.index') }}" class="btn btn-secondary mt-2">Regresar</a>
    </div>
@endsection