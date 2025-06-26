@extends('adminlte::page')

@section('title', 'Proyectos Pendientes')

@section('content_header')
    <h1><strong>Proyectos Pendientes</strong></h1>
@stop

@section('content')
<div class="container-fluid">

    {{-- Card de Proyectos Pendientes --}}
    <div class="row mb-3">
        <div class="col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $proyectos->count() }}</h3>
                    <p>Proyectos Pendientes</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tasks"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabla de Proyectos Pendientes --}}
    <div class="card">
        <div class="card-body table-responsive">
            <table id="tablaPendientes" class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Proyecto</th>
                        <th>Cliente</th>
                        <th>Fecha Estimada de Entrega</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($proyectos as $proyecto)
                        <tr>
                            <td>{{ $proyecto->id }}</td>
                            <td>{{ $proyecto->nombre_proyecto }}</td>
                            <td>{{ $proyecto->cliente }}</td>
                            <td>{{ \Carbon\Carbon::parse($proyecto->fecha_estimada_entrega)->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No hay proyectos pendientes.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@stop

@section('js')
<script>
    $(document).ready(function () {
        $('#tablaPendientes').DataTable({
            order: [[3, 'asc']], // Ordenar por fecha de entrega (columna 4)
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            }
        });
    });
</script>
@stop


