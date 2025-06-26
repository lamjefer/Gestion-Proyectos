@extends('adminlte::page')

@section('title', 'Detalle del Cliente')

@section('content_header')
    <h1>Detalle del Cliente</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Volver</a>

        <table class="table table-bordered">
            <tr>
                <th>Nombre:</th>
                <td>{{ $cliente->nombre }}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{ $cliente->email }}</td>
            </tr>
            <tr>
                <th>Teléfono:</th>
                <td>{{ $cliente->telefono }}</td>
            </tr>
            <tr>
                <th>Empresa:</th>
                <td>{{ $cliente->empresa }}</td>
            </tr>
            <tr>
                <th>Dirección:</th>
                <td>{{ $cliente->direccion }}</td>
            </tr>
            <tr>
                <th>Estado:</th>
                <td>
                    <span class="badge badge-{{ $cliente->estado === 'Activo' ? 'success' : 'secondary' }}">
                        {{ $cliente->estado }}
                    </span>
                </td>
            </tr>
        </table>
    </div>
</div>
@stop
