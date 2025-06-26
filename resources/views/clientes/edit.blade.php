@extends('adminlte::page')

@section('title', 'Editar Cliente')

@section('content_header')
    <h1>Editar Cliente</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Volver</a>

        <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nombre <span class="text-danger">*</span></label>
                <input type="text" name="nombre" value="{{ $cliente->nombre }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ $cliente->email }}" class="form-control">
            </div>

            <div class="form-group">
                <label>Teléfono</label>
                <input type="text" name="telefono" value="{{ $cliente->telefono }}" class="form-control">
            </div>

            <div class="form-group">
                <label>Empresa</label>
                <input type="text" name="empresa" value="{{ $cliente->empresa }}" class="form-control">
            </div>

            <div class="form-group">
                <label>Dirección</label>
                <input type="text" name="direccion" value="{{ $cliente->direccion }}" class="form-control">
            </div>

            <div class="form-group">
                <label>Estado</label>
                <select name="estado" class="form-control">
                    <option value="Activo" {{ $cliente->estado === 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Inactivo" {{ $cliente->estado === 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
@stop
