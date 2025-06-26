<?php

namespace App\Exports;

use App\Models\Proyecto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class ProyectosExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Proyecto::where('estado', 'Entregado')
            ->whereNotNull('fecha_entregado') // Asegura que la fecha esté definida
            ->whereMonth('fecha_entregado', Carbon::now()->month)
            ->whereYear('fecha_entregado', Carbon::now()->year)
            ->get();
    }

    public function headings(): array
    {
        return ['ID', 'Nombre del Proyecto', 'Cliente', 'Fecha de Entrega'];
    }

    public function map($proyecto): array
    {
        return [
            $proyecto->id,
            $proyecto->nombre_proyecto,
            $proyecto->cliente,
            Carbon::parse($proyecto->fecha_entregado)->format('d/m/Y H:i'),
        ];
    }
}



