@extends('adminlte::page')

@section('title', 'Proyectos Totales')

@section('content_header')
    <h1><strong>Listado de Proyectos</strong></h1>
@stop

@section('content')
<!--Contador de proyectos-->
<div class="row mb-3">
    <div class="col-md-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalProyectos ?? 0 }}</h3>
                <p>Proyectos Totales</p>
            </div>
            <div class="icon">
                <i class="fas fa-project-diagram"></i>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">

    {{-- Botón: Nuevo Proyecto --}}
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-success" data-toggle="modal" data-target="#modalNuevoProyecto">
            <i class="fas fa-plus-circle"></i> Nuevo Proyecto
        </button>
    </div>

    {{-- Tabla de Proyectos --}}
    <div class="card">
        <div class="card-body table-responsive">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table id="tablaProyectos" class="table table-bordered table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Cliente</th>
                        <th>Inicio</th>
                        <th>Entrega Estimada</th>
                        <th>Estado</th>
                        <th>Ticket</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($proyectos as $proyecto)
                        <tr>
                            <td>{{ $proyecto->id }}</td>
                            <td>{{ $proyecto->nombre_proyecto }}</td>
                            <td>{{ $proyecto->cliente }}</td>
                            <td>{{ $proyecto->fecha_inicio }}</td>
                            <td>{{ $proyecto->fecha_estimada_entrega }}</td>
                            <td>{{ $proyecto->estado }}</td>
                            <td class="text-center">
                                <a href="{{ route('proyectos.ticket', $proyecto->id) }}" class="btn btn-outline-danger btn-sm" title="Descargar Ticket">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('proyectos.show', $proyecto->id) }}" class="btn btn-info btn-sm" title="Ver"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('proyectos.edit', $proyecto->id) }}" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('proyectos.destroy', $proyecto->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este proyecto?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center">No hay proyectos registrados.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

     <!-- Boton Eliminar Todos -->

    <form action="{{ route('proyectos.eliminarTodos') }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar *todos* los proyectos? Esta acción no se puede deshacer.')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mb-3">
            <i class="fas fa-trash-alt"></i> Eliminar Todos
        </button>
    </form>


    
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
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="documentos[]" value="Planos Arquitectónicos" id="doc1">
                                <label class="form-check-label" for="doc1">Planos Arquitectónicos</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="documentos[]" value="Planos Estructurales" id="doc2">
                                <label class="form-check-label" for="doc2">Planos Estructurales</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="documentos[]" value="Memorias de Cálculo" id="doc3">
                                <label class="form-check-label" for="doc3">Memorias de Cálculo</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="documentos[]" value="Estudios de Suelos" id="doc4">
                                <label class="form-check-label" for="doc4">Estudios de Suelos</label>
                            </div>

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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const otrosCheckbox = document.getElementById('otrosCheckbox');
        const otrosInputGroup = document.getElementById('otrosInputGroup');

        otrosCheckbox?.addEventListener('change', function () {
            otrosInputGroup.style.display = this.checked ? 'block' : 'none';
        });
    });
</script>
@stop



