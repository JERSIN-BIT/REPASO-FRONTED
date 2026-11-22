<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ModuloController extends Controller
{
    public function index()
    {
        // Trae los módulos desde la API
        $url = env('URL_SERVER_API');
        $res = Http::withoutVerifying()
            ->acceptJson()
            ->get("{$url}/modulos");
        $modulos = $res->successful() ? $res->json() : [];

        return view('modulos.index', compact('modulos'));
    }

    public function create()
    {
        // Abre el formulario para crear un módulo
        return view('modulos.create');
    }

    public function store(Request $request)
    {
        // Revisa código y nombre del módulo
        $request->validate([
            'codigo' => 'required|string',
            'nombre' => 'required|string',
        ]);

        // Guarda el módulo en la API
        $url = env('URL_SERVER_API');
        $res = Http::withoutVerifying()
            ->acceptJson()
            ->post("{$url}/modulos", [
                'codigo' => $request->codigo,
                'nombre' => $request->nombre,
            ]);

        if ($res->failed()) {
            return back()
                ->withInput()
                ->with('error', $res->json('message') ?? ($res->json('mensaje') ?? 'No se pudo guardar el módulo'));
        }

        return redirect()->route('modulos.index')->with('ok', 'Módulo creado');
    }

    public function show($id)
    {
        // Busca el módulo por ID (ya viene con profesores y alumnos)
        $url = env('URL_SERVER_API');
        $res = Http::withoutVerifying()
            ->acceptJson()
            ->get("{$url}/modulos/{$id}");

        if ($res->failed()) {
            return redirect()->route('modulos.index')->with('error', 'Módulo no encontrado');
        }

        $modulo = $res->json();

        // Trae la lista de profesores para elegir cuál asignar
        $resProfes = Http::withoutVerifying()
            ->acceptJson()
            ->get("{$url}/profesores");
        $profesores = $resProfes->successful() ? $resProfes->json() : [];

        return view('modulos.show', compact('modulo', 'profesores'));
    }

    public function edit($id)
    {
        // Busca el módulo para llenar el formulario de editar
        $url = env('URL_SERVER_API');
        $res = Http::withoutVerifying()
            ->acceptJson()
            ->get("{$url}/modulos/{$id}");

        if ($res->failed()) {
            return redirect()->route('modulos.index')->with('error', 'Módulo no encontrado');
        }

        $modulo = $res->json();
        return view('modulos.edit', compact('modulo'));
    }

    public function update(Request $request, $id)
    {
        // Revisa código y nombre al editar
        $request->validate([
            'codigo' => 'required|string',
            'nombre' => 'required|string',
        ]);

        // Envía los cambios del módulo a la API
        $url = env('URL_SERVER_API');
        $res = Http::withoutVerifying()
            ->acceptJson()
            ->put("{$url}/modulos/{$id}", [
                'codigo' => $request->codigo,
                'nombre' => $request->nombre,
            ]);

        if ($res->failed()) {
            return back()
                ->withInput()
                ->with('error', $res->json('message') ?? ($res->json('mensaje') ?? 'No se pudo actualizar el módulo'));
        }

        return redirect()->route('modulos.index')->with('ok', 'Módulo actualizado');
    }

    public function destroy($id)
    {
        // Borra el módulo en la API
        $url = env('URL_SERVER_API');
        $res = Http::withoutVerifying()
            ->acceptJson()
            ->delete("{$url}/modulos/{$id}");

        if ($res->failed()) {
            return redirect()->route('modulos.index')->with('error', 'No se pudo eliminar el módulo');
        }

        return redirect()->route('modulos.index')->with('ok', 'Módulo eliminado');
    }

    public function asignarProfesor(Request $request, $id)
    {
        // Revisa que haya seleccionado un profesor
        $request->validate([
            'profesor_id' => 'required',
        ]);

        // Asigna el profesor al módulo en la API
        $url = env('URL_SERVER_API');
        $res = Http::withoutVerifying()
            ->acceptJson()
            ->post("{$url}/modulos/{$id}/asignar-profesor", [
                'profesor_id' => $request->profesor_id,
            ]);

        if ($res->failed()) {
            return back()->with('error', $res->json('message') ?? ($res->json('mensaje') ?? 'No se pudo asignar el profesor'));
        }

        return redirect()->route('modulos.show', $id)->with('ok', 'Profesor asignado');
    }
}
