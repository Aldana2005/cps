<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use App\Models\Dependence;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Define la lista de colores
        $colores = ['#FFB6C1', '#90EE90', '#FFDAB9', '#ADD8E6'];
        $colorIndex = 0;

        // Obtén las dependencias y cuenta los contratistas
        $dependences = Dependence::withCount('contractors')->get();

        // Asigna un color aleatorio a cada dependencia
        foreach ($dependences as $dependence) {
            $dependence->color = $colores[$colorIndex];
            $colorIndex = ($colorIndex + 1) % count($colores);
        }

        return view('home', compact('dependences'));
    }

    public function consultarContratistas($id)
    {

        // Obtener la dependencia por ID
        $dependencia = Dependence::find($id);

        // Pasar la dependencia a la vista
        return view('consultar', compact('dependencia'));
    }

    public function consulta(Request $request)
{
    // Validar los datos de entrada
    $request->validate([
        'cedula' => 'required|string',
        'fecha_expedicion' => 'required|date',
    ]);

    // Consultar los contratistas con la relación 'dependence'
    $contractors = Contractor::with('dependence')
                             ->where('numero_cedula', $request->input('cedula'))
                             ->whereDate('fecha_expedicion_cedula', $request->input('fecha_expedicion'))
                             ->get();

    // Asignar colores si no están presentes
    $colores = ['#FFB6C1', '#90EE90', '#FFDAB9', '#ADD8E6'];
    $colorIndex = 0;
    foreach ($contractors as $contractor) {
        if (!$contractor->dependence->color) {
            $contractor->dependence->color = $colores[$colorIndex];
            $colorIndex = ($colorIndex + 1) % count($colores);
        }
    }

    // Retornar la vista con los resultados y un indicador de vacíos
    return view('resultado', [
        'contractors' => $contractors,
        'noContractors' => $contractors->isEmpty()
    ]);
}




}
