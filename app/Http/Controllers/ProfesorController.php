<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProfesorController extends Controller
{
    public function index()
    {
        // Trae la lista de profesores desde la API
        $url = env('URL_SERVER_API');
        $res = Http::withoutVerifying()
            ->acceptJson()
            ->get("{$url}/profesores");
        $profesores = $res->successful() ? $res->json() : [];

        return view('profesores.index', compact('profesores'));
    }

    public function create()
    {
        // Abre el formulario para registrar un profesor
        return view('profesores.create');
    }

    public function store(Request $request)
    {
        // Revisa los datos del profesor
        $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'telefono' => 'nullable|string',
            'cedula' => 'required|string',
        ]);

        // Guarda el profesor nuevo en la API
        $url = env('URL_SERVER_API');
        $res = Http::withoutVerifying()
            ->acceptJson()
            ->post("{$url}/profesores", [
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'telefono' => $request->telefono,
                'cedula' => $request->cedula,
            ]);

        if ($res->failed()) {
            return back()
                ->withInput()
                ->with('error', $res->json('message') ?? ($res->json('mensaje') ?? 'No se pudo guardar el profesor'));
        }

        return redirect()->route('profesores.index')->with('ok', 'Profesor creado');
    }

    public function show($id)
    {
        // Busca un profesor por ID para ver su detalle
        $url = env('URL_SERVER_API');
        $res = Http::withoutVerifying()
            ->acceptJson()
            ->get("{$url}/profesores/{$id}");

        if ($res->failed()) {
            return redirect()->route('profesores.index')->with('error', 'Profesor no encontrado');
        }

        $profesor = $res->json();
        return view('profesores.show', compact('profesor'));
    }

    public function edit($id)
    {
        // Busca el profesor para llenar el formulario de editar
        $url = env('URL_SERVER_API');
        $res = Http::withoutVerifying()
            ->acceptJson()
            ->get("{$url}/profesores/{$id}");

        if ($res->failed()) {
            return redirect()->route('profesores.index')->with('error', 'Profesor no encontrado');
        }

        $profesor = $res->json();
        return view('profesores.edit', compact('profesor'));
    }

    public function update(Request $request, $id)
    {
        // Revisa los datos editados del profesor
        $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'telefono' => 'nullable|string',
            'cedula' => 'required|string',
        ]);

        // Envía los cambios del profesor a la API
        $url = env('URL_SERVER_API');
        $res = Http::withoutVerifying()
            ->acceptJson()
            ->put("{$url}/profesores/{$id}", [
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'telefono' => $request->telefono,
                'cedula' => $request->cedula,
            ]);

        if ($res->failed()) {
            return back()
                ->withInput()
                ->with('error', $res->json('message') ?? ($res->json('mensaje') ?? 'No se pudo actualizar el profesor'));
        }

        return redirect()->route('profesores.index')->with('ok', 'Profesor actualizado');
    }

    public function destroy($id)
    {
        // Borra el profesor en la API
        $url = env('URL_SERVER_API');
        $res = Http::withoutVerifying()
            ->acceptJson()
            ->delete("{$url}/profesores/{$id}");

        if ($res->failed()) {
            return redirect()->route('profesores.index')->with('error', 'No se pudo eliminar el profesor');
        }

        return redirect()->route('profesores.index')->with('ok', 'Profesor eliminado');
    }
}
