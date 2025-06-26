@extends('adminlte::page')

@section('title', 'Detalle del Proyecto')

@section('content_header')
    <h1><b>Detalles del Proyecto</b></h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <p><strong>ID:</strong> {{ $proyecto->id }}</p>
        <p><strong>Nombre:</strong> {{ $proyecto->nombre_proyecto }}</p>
        <p><strong>Cliente:</strong> {{ $proyecto->cliente }}</p>
        <p><strong>Fecha de Inicio:</strong> {{ $proyecto->fecha_inicio }}</p>
        <p><strong>Días Estimados:</strong> {{ $proyecto->duracion_dias }}</p>
        <p><strong>Fecha Estimada de Entrega:</strong> {{ $proyecto->fecha_estimada_entrega }}</p>
        <p><strong>Estado:</strong> {{ $proyecto->estado }}</p>
        <p><strong>Descripción:</strong> {{ $proyecto->descripcion }}</p>
    </div>
</div>
<a href="{{ route('proyectos.index') }}" class="btn btn-secondary mt-2">Volver</a>
@stop
