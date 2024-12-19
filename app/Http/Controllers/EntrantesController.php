<?php

namespace App\Http\Controllers;

use App\Models\CitaMedica;
use App\Models\Entrante;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EntrantesController extends Controller
{
    public function index()
    {
        return view('entrantes.index');
    }
    public function create()
    {
        return view('entrantes.registrar_llamada');
    }
    public function register()
    {
        return view('entrantes.registrar_cita');
    }
    public function registrarcita(Request $request)
    {
        $validatedData = $request->validate([
            'dni_beneficiario' => 'required|string|max:255',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'observaciones' => 'nullable|string',
        ]);

        try {
            CitaMedica::create($validatedData);
            return redirect()->route('entrantes.error')->with('success', 'Cita médica registrada con éxito');
        } catch (\Exception $e) {
            Log::error('Error al registrar la cita médica: '.$e->getMessage());
            return redirect()->route('entrantes.error')->with('error', 'Error al registrar la cita médica')->withInput();
        }
    }
    public function register_citas(Request $request)
    {
        // Validación de los datos recibidos del formulario
        $request->validate([
            'email' => 'required|string|max:100',
            'email_users' => 'required|string|max:100',
            'quien_llama' => 'required|string|max:255',
            'beneficiario' => 'required|in:Si,No',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'duracion' => 'required|string|max:10',
            'tipo_llamada' => 'required|string|max:255',
            'observaciones' => 'nullable|string',
        ]);

        // Creación de un nuevo registro en la tabla 'entrantes' utilizando el modelo Entrante
        $entrante = new Entrante();
        $entrante->email = $request->email;
        $entrante->email_users = $request->email_users;
        $entrante->quien_llama = $request->quien_llama;
        $entrante->beneficiario = $request->beneficiario;
        $entrante->fecha = $request->fecha;
        $entrante->hora = $request->hora;
        $entrante->duracion = $request->duracion;
        $entrante->tipo_llamada = $request->tipo_llamada;
        $entrante->observaciones = $request->observaciones;
        $entrante->save();

        // Redireccionar a una vista o ruta específica después de guardar los datos
        return redirect()->route('entrantes.error')->with('success', '¡Registro de llamada entrante exitoso!');
    }
    public function store(Request $request)
    {
        // Validación de los datos recibidos del formulario
        $request->validate([
            'email' => 'required|string|max:100',
            'email_users' => 'required|string|max:100',
            'quien_llama' => 'required|string|max:255',
            'beneficiario' => 'required|in:Si,No',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'duracion' => 'required|string|max:10',
            'tipo_llamada' => 'required|string|max:255',
            'observaciones' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:mp3,wav,aac,ogg',

        ]);

        if ($request->hasFile('archivo')) {
            $fileName = time().'.'.$request->archivo->extension();
            $request->file('archivo')->storeAs('audios', $fileName, 'public');
        } else {
            return back()->withErrors(['archivo' => 'Error al subir el archivo. Intente de nuevo.']);
        }
        // Creación de un nuevo registro en la tabla 'entrantes' utilizando el modelo Entrante
        $entrante = new Entrante();
        $entrante->email = $request->email;
        $entrante->email_users = $request->email_users;
        $entrante->quien_llama = $request->quien_llama;
        $entrante->beneficiario = $request->beneficiario;
        $entrante->fecha = $request->fecha;
        $entrante->hora = $request->hora;
        $entrante->duracion = $request->duracion;
        $entrante->tipo_llamada = $request->tipo_llamada;
        $entrante->observaciones = $request->observaciones;
        $entrante->archivo = $fileName;
        $entrante->save();

        // Redireccionar a una vista o ruta específica después de guardar los datos
        return redirect()->route('entrantes.error')->with('success', '¡Registro de llamada entrante exitoso!');
    }
    
    public function error()
    {
        return view('entrantes.error');
    }
}
