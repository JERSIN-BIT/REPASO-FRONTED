<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AlumnoController extends Controller
{
    public function index()
    {
        // Trae la lista de alumnos desde la API
        $url = env('URL_SERVER_API');
        $res = Http::withoutVerifying()
            ->acceptJson()
            ->get("{$url}/alumnos");
        $alumnos = $res->successful() ? $res->json() : [];

        return view('alumnos.index', compact('alumnos'));
    }

    public function create()
    {
        // Abre el formulario para crear un alumno
        return view('alumnos.create');
    }

    public function store(Request $request)
    {
        // Revisa los campos que llegan del formulario
        $request->validate([
            'nombre' => 'required|string',
            'apellidos' => 'required|string',
            'fecha_nacimiento' => 'nullable|date',
            'expediente' => 'required|string',
            'modulo_id' => 'nullable|integer',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $url = env('URL_SERVER_API');
        $peticion = Http::withoutVerifying()->acceptJson();

        // Arma solo los campos que vienen llenos para evitar problemas en multipart
        $datos = [
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'expediente' => $request->expediente,
        ];

        if ($request->filled('fecha_nacimiento')) {
            $datos['fecha_nacimiento'] = $request->fecha_nacimiento;
        }

        if ($request->filled('modulo_id')) {
            $datos['modulo_id'] = $request->modulo_id;
        }

        // Si eligió foto, la adjunta para que el backend la suba a Cloudinary
        if ($request->hasFile('foto')) {
            $archivo = $request->file('foto');
            $peticion = $peticion->attach('foto', file_get_contents($archivo->getRealPath()), $archivo->getClientOriginalName());
        }

        // Envía los datos del nuevo alumno a la API
        $res = $peticion->post("{$url}/alumnos", $datos);

        if ($res->failed()) {
            return back()
                ->withInput()
                ->with('error', $res->json('message') ?? ($res->json('mensaje') ?? 'No se pudo guardar el alumno'));
        }

        return redirect()->route('alumnos.index')->with('ok', 'Alumno creado');
    }

    public function show($id)
    {
        // Busca un alumno por ID para ver su detalle
        $url = env('URL_SERVER_API');
        $res = Http::withoutVerifying()
            ->acceptJson()
            ->get("{$url}/alumnos/{$id}");

        if ($res->failed()) {
            return redirect()->route('alumnos.index')->with('error', 'Alumno no encontrado');
        }

        $alumno = $res->json();
        return view('alumnos.show', compact('alumno'));
    }

    public function edit($id)
    {
        // Busca el alumno para llenar el formulario de editar
        $url = env('URL_SERVER_API');
        $res = Http::withoutVerifying()
            ->acceptJson()
            ->get("{$url}/alumnos/{$id}");

        if ($res->failed()) {
            return redirect()->route('alumnos.index')->with('error', 'Alumno no encontrado');
        }

        $alumno = $res->json();
        return view('alumnos.edit', compact('alumno'));
    }

    public function update(Request $request, $id)
    {
        // Revisa los campos editados
        $request->validate([
            'nombre' => 'required|string',
            'apellidos' => 'required|string',
            'fecha_nacimiento' => 'nullable|date',
            'expediente' => 'required|string',
            'modulo_id' => 'nullable|integer',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $url = env('URL_SERVER_API');
        $peticion = Http::withoutVerifying()->acceptJson();

        // Arma los campos editados y fuerza PUT para que Laravel acepte archivos
        $datos = [
            '_method' => 'PUT',
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'expediente' => $request->expediente,
        ];

        if ($request->filled('fecha_nacimiento')) {
            $datos['fecha_nacimiento'] = $request->fecha_nacimiento;
        }

        if ($request->filled('modulo_id')) {
            $datos['modulo_id'] = $request->modulo_id;
        }

        // Si subió foto nueva, la adjunta al envío
        if ($request->hasFile('foto')) {
            $archivo = $request->file('foto');
            $peticion = $peticion->attach('foto', file_get_contents($archivo->getRealPath()), $archivo->getClientOriginalName());
        }

        // Manda la actualización a la API
        $res = $peticion->post("{$url}/alumnos/{$id}", $datos);

        if ($res->failed()) {
            return back()
                ->withInput()
                ->with('error', $res->json('message') ?? ($res->json('mensaje') ?? 'No se pudo actualizar el alumno'));
        }

        return redirect()->route('alumnos.index')->with('ok', 'Alumno actualizado');
    }

    public function destroy($id)
    {
        // Borra el alumno en la API
        $url = env('URL_SERVER_API');
        $res = Http::withoutVerifying()
            ->acceptJson()
            ->delete("{$url}/alumnos/{$id}");

        if ($res->failed()) {
            return redirect()->route('alumnos.index')->with('error', 'No se pudo eliminar el alumno');
        }

        return redirect()->route('alumnos.index')->with('ok', 'Alumno eliminado');
    }
}
