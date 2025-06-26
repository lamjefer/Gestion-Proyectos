@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Panel de Control</strong></h1>
@stop

@section('content')
<div class="container-fluid">

    {{-- Mensaje de Bienvenida --}}
    @if(Auth::check())
        <p class="mb-4" style="font-size: 1.1rem;">
            Bienvenido, <strong>{{ Auth::user()->name }}</strong>. Este es tu Gestor de Proyectos. Ahora estarás más organizado.
        </p>
    @endif

    {{-- Botón Nuevo Proyecto --}}
    <div class="row mb-3">
        <div class="col-12 text-right">
            <button class="btn btn-success" data-toggle="modal" data-target="#modalNuevoProyecto">
                <i class="fas fa-plus-circle"></i> Nuevo Proyecto
            </button>
        </div>
    </div>

    {{-- Tarjetas resumen --}}
    <div class="row">

        <!-- Proyectos Totales -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalProyectos ?? 0 }}</h3>
                    <p>Proyectos Totales</p>
                </div>
                <div class="icon">
                    <i class="fas fa-project-diagram"></i>
                </div>
                <a href="{{ route('proyectos.index') }}" class="small-box-footer">Ver Proyectos <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- Clientes Registrados -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalClientes ?? 0 }}</h3>
                    <p>Clientes Registrados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('clientes.index') }}" class="small-box-footer">
                    Ver Clientes <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- Proyectos Pendientes -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $proyectosPendientes }}</h3>
                    <p>Proyectos Pendientes</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tasks"></i>
                </div>
                <a href="{{ route('pendientes.index') }}" class="small-box-footer">
                    Ver Pendientes <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>




        <!-- Finalizados este Mes -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $proyectosFinalizadosMes ?? 0 }}</h3>
                    <p>Finalizados este Mes</p>
                </div>
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <a href="{{ route('entregados.mes') }}" class="small-box-footer">Más Detalles <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

    

    <!-- Gráfico de Torta -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Resumen de Proyectos por Estado</h3>
        </div>
        <div class="card-body">
            <canvas id="graficoProyectosEstado" style="height: 420px !important; max-height: 420px !important;"></canvas>
        </div>
    </div>

    <!-- Modal: Nuevo Proyecto -->
    <div class="modal fade" id="modalNuevoProyecto" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Registrar Nuevo Proyecto</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('proyectos.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <!-- Campos del formulario -->
                        <div class="form-group">
                            <label for="nombre">Nombre del Proyecto</label>
                            <input type="text" name="nombre_proyecto" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="cliente">Cliente</label>
                            <input type="text" name="cliente" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label><strong>Documentos a realizar</strong></label><br>
                            @php
                                $docs = ['Planos Arquitectónicos', 'Planos Estructurales', 'Memorias de Cálculo', 'Estudios de Suelos'];
                            @endphp
                            @foreach($docs as $i => $doc)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="documentos[]" value="{{ $doc }}" id="doc{{ $i }}">
                                    <label class="form-check-label" for="doc{{ $i }}">{{ $doc }}</label>
                                </div>
                            @endforeach
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" id="otrosCheckbox">
                                <label class="form-check-label" for="otrosCheckbox">Otros</label>
                            </div>
                            <div class="form-group mt-2" id="otrosInputGroup" style="display: none;">
                                <label for="otros_documentos">Especificar otros documentos u observaciones:</label>
                                <textarea name="otros_documentos" class="form-control" rows="2"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="fecha_inicio">Fecha de Inicio</label>
                            <input type="date" name="fecha_inicio" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('graficoProyectosEstado').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Entregados', 'En Proceso', 'En Corrección', 'Recibidos'],
            datasets: [{
                data: [
                    {{ $proyectosPorEstado['entregados'] }},
                    {{ $proyectosPorEstado['en_proceso'] }},
                    {{ $proyectosPorEstado['en_correccion'] }},
                    {{ $proyectosPorEstado['recibidos'] }}
                ],
                backgroundColor: ['#28a745', '#ffc107', '#fd7e14', '#17a2b8']
            }]
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        const otrosCheckbox = document.getElementById('otrosCheckbox');
        const otrosInputGroup = document.getElementById('otrosInputGroup');
        otrosCheckbox?.addEventListener('change', function () {
            otrosInputGroup.style.display = this.checked ? 'block' : 'none';
        });
    });
</script>
@stop







