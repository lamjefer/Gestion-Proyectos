<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre_proyecto',
        'cliente',
        'fecha_inicio',
        'tipo_documentacion',
        'duracion_dias',
        'fecha_estimada_entrega',
        'estado',
        'descripcion',
    ];
}
