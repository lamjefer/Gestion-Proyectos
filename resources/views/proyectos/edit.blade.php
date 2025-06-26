@extends('adminlte::page')

@section('title', 'Editar Proyecto')

@section('content_header')
    <h1><b>Editar Proyecto</b></h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('proyectos.update', $proyecto->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nombre del Proyecto</label>
                <input type="text" name="nombre_proyecto" value="{{ $proyecto->nombre_proyecto }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Cliente</label>
                <input type="text" name="cliente" value="{{ $proyecto->cliente }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Fecha de Inicio</label>
                <input type="date" name="fecha_inicio" value="{{ $proyecto->fecha_inicio }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Días Estimados</label>
                <input type="number" name="duracion_dias" value="{{ $proyecto->duracion_dias }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Estado</label>
                <select name="estado" class="form-control" required>
                    <option value="Recibido" {{ $proyecto->estado == 'Recibido' ? 'selected' : '' }}>Recibido</option>
                    <option value="En Proceso" {{ $proyecto->estado == 'En Proceso' ? 'selected' : '' }}>En Proceso</option>
                    <option value="En Corrección" {{ $proyecto->estado == 'En Corrección' ? 'selected' : '' }}>En Corrección</option>
                    <option value="Entregado" {{ $proyecto->estado == 'Entregado' ? 'selected' : '' }}>Entregado</option>
                </select>
            </div>

            <div class="form-group">
                <label>Descripción</label>
                <textarea name="descripcion" class="form-control">{{ $proyecto->descripcion }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@stop
