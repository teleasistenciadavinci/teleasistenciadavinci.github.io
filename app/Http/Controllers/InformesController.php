<?php

namespace App\Http\Controllers;

use App\Models\BeneficiarioInteres;
use App\Models\CitaMedica;
use App\Models\Contacto;
use App\Models\Entrante;
use App\Models\Gestion;
use App\Models\Saliente;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InformesController extends Controller
{
    public function index()
    {
        return view('informes.index');
    }
    
    // public function buscarBeneficiario(Request $request)
    // {
    //     $opcion = $request->opcion;

    //     switch ($opcion) {
    //         case 'dni':
    //             $beneficiarios = Gestion::orderBy('dni')->get();
    //             break;
    //         case 'sexo':
    //             $beneficiarios = Gestion::orderBy('sexo')->get();
    //             break;
    //         case 'tipo':
    //             $beneficiarios = Gestion::orderBy('tipo_beneficiario')->get();
    //             break;
    //         case 'provincia':
    //             $beneficiarios = Gestion::orderBy('provincia')->get();
    //             break;
    //         case 'estado_civil':
    //             $beneficiarios = Gestion::orderBy('estado_civil')->get();
    //             break;
    //         default:
    //             $beneficiarios = Gestion::all();
    //             break;
    //     }

    //     return view('informes.beneficiario_resultados', compact('beneficiarios'));
    // }
    public function beneficiarios()
    {
        return view('informes.listado_beneficiario');
    }
    public function buscarBeneficiario()
    {
        $beneficiarios = Gestion::orderBy('dni')->get();

        return view('informes.beneficiario_resultados', compact('beneficiarios'));
    }
    public function contactos()
    {
        return view('informes.listado_contactos');
    }
    public function buscarContacto()
    {
        $contactos = Contacto::orderBy('dni_beneficiario')->get();

        return view('informes.contactos_resultados', compact('contactos'));
    }
    public function interesconsultarview()
    {
        return view('informes.consultar_interes');
    }
    public function interesconsultar(Request $request)
    {
        $request->validate([
            'dni' => 'required|string|max:9'
        ]);

        $dni = $request->input('dni');
        $beneficiario = Gestion::where('dni', $dni)->first();
        $beneficiarioInteres = BeneficiarioInteres::where('dni_beneficiario', $dni)->first();

        if (!$beneficiario) {
            return redirect()->back()->with('error', 'El DNI no existe en la tabla Beneficiario.');
        } elseif (!$beneficiarioInteres) {
            return redirect()->back()->with('error', 'Datos no asignados.');
        } else {
            return view('informes.consultar_datos_interes', compact('beneficiario','beneficiarioInteres'));
        }
    }
    public function buscarprevistas(Request $request)
    {
        $opcion = $request->input('opcion');

        switch ($opcion) {
            case 'citas_medicas_hoy':
                $resultados = $this->obtenerCitasMedicasHoy();
                return view('informes.citas_medicas', compact('resultados'));
                break;
            case 'cumpleaneros_hoy':
                $resultados = $this->obtenerCumpleanerosHoy();
                return view('informes.cumpleaños', compact('resultados'));
                break;
            default:
                return redirect()->back()->with('error', 'Opción no válida.');
        }

    }
    private function obtenerCitasMedicasHoy()
    {
        $hoy = Carbon::today()->toDateString(); // Obtener la fecha de hoy
        $citas = CitaMedica::whereDate('fecha', $hoy)->get();

        return $citas;
    }
    private function obtenerCumpleanerosHoy()
    {
        $hoy = Carbon::today();
        $dia = $hoy->day;
        $mes = $hoy->month;

        $cumpleaneros = Gestion::whereDay('fecha_nacimiento', $dia)
                                    ->whereMonth('fecha_nacimiento', $mes)
                                    ->get();

        return $cumpleaneros;
    }
    public function llamadasprevistas()
    {
        return view('informes.listado_llamadas_previstas');
    }
    public function mostrarLlamadasEntrantesHoy()
    {
        // Obtener la fecha de hoy
        $hoy = Carbon::today()->toDateString();
        
        // Obtener las llamadas entrantes de hoy
        $llamadas = Entrante::whereDate('fecha', $hoy)->get();
        
        // Devolver la vista con las llamadas
        return view('informes.registro_entrantes', compact('llamadas'));
    }
    public function mostrarLlamadasSalientesHoy()
    {
        // Obtener la fecha de hoy
        $hoy = Carbon::today()->toDateString();
        
        // Obtener las llamadas salientes de hoy
        $llamadas = Saliente::whereDate('fecha', $hoy)->get();
        
        // Devolver la vista con las llamadas
        return view('informes.registro_salientes', compact('llamadas'));
    }
}
