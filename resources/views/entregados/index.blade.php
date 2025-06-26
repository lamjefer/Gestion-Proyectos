@extends('adminlte::page')

@section('title', 'Proyectos Entregados este Mes')

@section('content_header')
    <h1><strong>Proyectos Entregados este Mes</strong></h1>
@stop

@section('content')
<div class="container-fluid">

    <div class="row mb-3">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $contador }}</h3>
                    <p>Finalizados este Mes</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">
            <i class="fas fa-check-circle text-success"></i>
            <strong>Proyectos Finalizados este Mes</strong>
        </h3>

        <a href="{{ route('entregados.excel') }}" class="btn btn-outline-success">
            <i class="fas fa-file-excel"></i> Reporte Mes
        </a>
    </div>

    <div class="card">
        <div class="card-body table-responsive">
            <table id="tablaEntregados" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Proyecto</th>
                        <th>Cliente</th>
                        <th>Fecha de Entrega</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($proyectos as $proyecto)
                        <tr>
                            <td>{{ $proyecto->id }}</td>
                            <td>{{ $proyecto->nombre_proyecto }}</td>
                            <td>{{ $proyecto->cliente }}</td>
                            <td>{{ \Carbon\Carbon::parse($proyecto->fecha_entregado)->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No hay proyectos entregados este mes.</td>
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
        $('#tablaEntregados').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            }
        });
    });
</script>
@stop


