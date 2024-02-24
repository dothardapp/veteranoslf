<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use OpenAdmin\Admin\Admin;
use OpenAdmin\Admin\Controllers\Dashboard;
use OpenAdmin\Admin\Layout\Column;
use OpenAdmin\Admin\Layout\Content;
use OpenAdmin\Admin\Layout\Row;
use \App\Models\SorteoZona;
use App\Models\Campeonato;
use Illuminate\Http\Request;

class VistaZonaController extends Controller
{    

    public function index(Content $content)
    {           
        
        //Admin::js('/js/vista_sorteos.js'); 
        
        // Obtener todos los campeonatos
        $campeonatos = Campeonato::all();

        // Obtener todos los sorteos incluyendo las relaciones con campeonato y equipo
        $sorteos = SorteoZona::with(['campeonato', 'equipo'])->get();

        // Organizar los sorteos por división y luego por zona
        $sorteosPorDivisionYZona = $sorteos->groupBy(['division', 'zona']);

        // Pasar los sorteos organizados a la vista
        $zonasView = view('vista_zona', compact('sorteosPorDivisionYZona', 'campeonatos'));                     

        return $content->row(function (Row $row) use ($zonasView) {
            $row->column(12, function (Column $column) use ($zonasView) {
                $column->row($zonasView);
            });
        });
        
    }

    public function filtrarPorCampeonato(Request $request)
    {
        
        $campeonatoId = $request->query('campeonato_id');

        // Obtener el nombre del campeonato
        $nombreCampeonato = Campeonato::where('id', $campeonatoId)->value('nombre'); // Suponiendo que el campo se llama 'nombre'

        $sorteos = SorteoZona::where('campeonato_id', $campeonatoId)
                    ->with(['equipo'])
                    ->get();
    
        // Asegúrate de devolver una respuesta JSON
        return response()->json([
            'sorteosPorDivisionYZona' => $sorteos,
            'nombreCampeonato' => $nombreCampeonato, // Incluye el nombre del campeonato aquí
        ]);
    }

}
