<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\ProfesorController;
use Illuminate\Support\Facades\Route;

// Pantalla principal al entrar a la página
Route::view('/', 'home')->name('home');

// Rutas automáticas para listar, crear, ver, editar y borrar
Route::resource('alumnos', AlumnoController::class);
Route::resource('modulos', ModuloController::class);
Route::resource('profesores', ProfesorController::class);

// Ruta para asignar un profesor a un módulo desde su detalle
Route::post('modulos/{id}/asignar-profesor', [ModuloController::class, 'asignarProfesor'])->name('modulos.asignarProfesor');
