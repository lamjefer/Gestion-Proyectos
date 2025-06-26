<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Cliente;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Contadores principales
        $totalProyectos = Proyecto::count();
        $totalClientes = Cliente::count();

        // Contar proyectos pendientes (todo lo que NO esté entregado)
        $proyectosPendientes = Proyecto::where('estado', '!=', 'Entregado')->count();

        // Contar proyectos entregados este mes
        $proyectosFinalizadosMes = Proyecto::where('estado', 'Entregado')
            ->whereMonth('fecha_entregado', now()->month)
            ->whereYear('fecha_entregado', now()->year)
            ->count();

        // Datos para el gráfico de pastel
        $proyectosPorEstado = [
            'entregados' => Proyecto::where('estado', 'Entregado')->count(),
            'en_proceso' => Proyecto::where('estado', 'En Proceso')->count(),
            'en_correccion' => Proyecto::where('estado', 'En Corrección')->count(),
            'recibidos' => Proyecto::where('estado', 'Recibido')->count(),
        ];

        return view('dashboard', compact(
            'totalProyectos',
            'totalClientes',
            'proyectosPendientes',
            'proyectosFinalizadosMes',
            'proyectosPorEstado'
        ));
    }
}



