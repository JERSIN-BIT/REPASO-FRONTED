@extends('layouts.app')

@section('content')
    <!-- Pantalla inicial con accesos rápidos -->
    <div class="container mt-4">
        <h2>Inicio</h2>
        <p>Elige una sección para trabajar:</p>

        <a href="{{ route('alumnos.index') }}" class="btn btn-primary">Alumnos</a>
        <a href="{{ route('modulos.index') }}" class="btn btn-secondary">Módulos</a>
        <a href="{{ route('profesores.index') }}" class="btn btn-secondary">Profesores</a>
    </div>
@endsection
