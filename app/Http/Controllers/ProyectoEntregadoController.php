<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use Carbon\Carbon;

class ProyectoEntregadoController extends Controller
{
    public function index()
    {
        $proyectos = Proyecto::where('estado', 'Entregado')
            ->whereMonth('fecha_entregado', Carbon::now()->month)
            ->whereYear('fecha_entregado', Carbon::now()->year)
            ->get();

        $contador = $proyectos->count();

        return view('entregados.index', compact(
            'proyectos', 
            'contador'
        ));
    }
}

