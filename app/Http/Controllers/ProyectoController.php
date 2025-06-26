<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ProyectoController extends Controller
{
    // Listar proyectos
    public function index()
    {
        $proyectos = Proyecto::latest()->get();
        $totalProyectos = $proyectos->count();

        return view('proyectos.index', compact('proyectos', 'totalProyectos'));
    }

    // Guardar nuevo proyecto
    public function store(Request $request)
    {
        $request->validate([
            'nombre_proyecto' => 'required|string|max:255',
            'cliente' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'documentos' => 'nullable|array',
            'otros_documentos' => 'nullable|string',
        ]);

        $documentos = $request->input('documentos', []);
        $otros = $request->input('otros_documentos');

        // Construcción de descripción
        $descripcion = '';
        if (count($documentos)) {
            $descripcion .= "Documentos solicitados: " . implode(', ', $documentos) . ". ";
        }
        if (!empty($otros)) {
            $descripcion .= "Observaciones: " . $otros;
        }

        // Calcular duración y fecha estimada
        $diasEstimados = $this->calcularDuracionPorTipo($documentos);

        $proyecto = new Proyecto();
        $proyecto->nombre_proyecto = $request->nombre_proyecto;
        $proyecto->cliente = $request->cliente;
        $proyecto->fecha_inicio = $request->fecha_inicio;
        $proyecto->descripcion = $descripcion;
        $proyecto->estado = 'Recibido';
        $proyecto->duracion_dias = $diasEstimados;
        $proyecto->fecha_estimada_entrega = Carbon::parse($request->fecha_inicio)->addDays($diasEstimados);
        $proyecto->save();

        return redirect()->route('proyectos.index')->with('success', 'Proyecto registrado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        return view('proyectos.edit', compact('proyecto'));
    }

    // Actualizar proyecto
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_proyecto' => 'required|string|max:255',
            'cliente' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'estado' => 'required|string',
            'descripcion' => 'nullable|string',
        ]);

        $proyecto = Proyecto::findOrFail($id);

        // Si cambia a "Entregado" y aún no tiene fecha_entregado, la asignamos
        if ($proyecto->estado !== $request->estado && $request->estado === 'Entregado' && !$proyecto->fecha_entregado) {
            $proyecto->fecha_entregado = now();
        }

        // Actualizamos el resto de campos
        $proyecto->nombre_proyecto = $request->nombre_proyecto;
        $proyecto->cliente = $request->cliente;
        $proyecto->fecha_inicio = $request->fecha_inicio;
        $proyecto->estado = $request->estado;
        $proyecto->descripcion = $request->descripcion;

        $proyecto->save();

        return redirect()->route('proyectos.index')->with('success', 'Proyecto actualizado correctamente.');
    }


    // eliminar todos
    public function eliminarTodos()
    {
        Proyecto::truncate(); // Elimina todos los registros sin restricciones

        return redirect()->route('proyectos.index')->with('success', 'Todos los proyectos fueron eliminados.');
    }





    // Mostrar proyecto individual
    public function show($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        return view('proyectos.show', compact('proyecto'));
    }

    // Eliminar proyecto
    public function destroy($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->delete();

        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado correctamente.');
    }

    // Generar PDF tipo ticket
    public function generarTicket($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $pdf = Pdf::loadView('proyectos.ticket', compact('proyecto'));
        return $pdf->download('ticket_proyecto_' . $proyecto->id . '.pdf');
    }

    // Calcular duración estimada según los documentos seleccionados
    private function calcularDuracionPorTipo($documentos)
    {
        $dias = 0;

        foreach ($documentos as $doc) {
            switch ($doc) {
                case 'Planos Arquitectónicos':
                    $dias += 5;
                    break;
                case 'Planos Estructurales':
                    $dias += 7;
                    break;
                case 'Memorias de Cálculo':
                    $dias += 4;
                    break;
                case 'Estudios de Suelos':
                    $dias += 6;
                    break;
            }
        }

        return $dias > 0 ? $dias : 3; // valor mínimo por defecto
    }


    // Mostrar proyectos pendientes (que no están entregados)
    public function pendientes()
    {
        $proyectos = Proyecto::where('estado', '!=', 'Entregado')
                            ->orderBy('fecha_estimada_entrega', 'asc')
                            ->get();

        return view('pendientes.index', compact('proyectos'));
    }


    // Mostrar proyectos entregados en el mes actual
    public function entregadosMes()
    {
        $inicioMes = Carbon::now()->startOfMonth();
        $finMes = Carbon::now()->endOfMonth();

        $proyectos = Proyecto::where('estado', 'Entregado')
            ->whereBetween('fecha_entregado', [$inicioMes, $finMes])
            ->get();

        $contador = $proyectos->count();

        return view('entregados.index', compact('proyectos', 'contador'));
    }





}
