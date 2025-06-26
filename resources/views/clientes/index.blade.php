@extends('adminlte::page')

@section('title', 'Clientes Registrados')

@section('content_header')
    <h1><strong>Clientes Registrados</strong></h1>
@stop

@section('content')
<div class="container-fluid">

    {{-- Caja: Clientes Activos --}}
    <div class="row mb-3">
        <div class="col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $clientesActivos }}</h3>
                    <p>Clientes Activos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-check"></i>
                </div>
            </div>
        </div>

        {{-- Botón: Nuevo Cliente --}}
        <div class="col-md-9 d-flex justify-content-end align-items-end">
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevoCliente">
                <i class="fas fa-user-plus"></i> Nuevo Cliente
            </button>
        </div>
    </div>

    {{-- Tabla de Clientes --}}
    <div class="card">
        <div class="card-body table-responsive">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table id="tablaClientes" class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Empresa</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->id }}</td>
                            <td>{{ $cliente->nombre }}</td>
                            <td>{{ $cliente->email }}</td>
                            <td>{{ $cliente->telefono }}</td>
                            <td>{{ $cliente->empresa }}</td>
                            <td>
                                <span class="badge badge-{{ $cliente->estado === 'Activo' ? 'success' : 'secondary' }}">
                                    {{ $cliente->estado }}
                                </span>
                            </td>
                            <td class="text-center">
                                {{-- Ver --}}
                                <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-sm btn-info" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- Editar --}}
                                <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- Eliminar (todos pueden) --}}
                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('¿Deseas eliminar este cliente?')" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No hay clientes registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal: Nuevo Cliente --}}
    <div class="modal fade" id="modalNuevoCliente" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('clientes.store') }}" method="POST">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Registrar Nuevo Cliente</h5>
                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nombre <span class="text-danger">*</span></label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Teléfono</label>
                            <input type="text" name="telefono" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Empresa</label>
                            <input type="text" name="empresa" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Dirección</label>
                            <input type="text" name="direccion" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Estado</label>
                            <select name="estado" class="form-control">
                                <option value="Activo" selected>Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
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
    $(document).ready(function () {
        $('#tablaClientes').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            }
        });
    });
</script>
@stop


