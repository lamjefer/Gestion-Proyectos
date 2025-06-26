@extends('adminlte::page')

@section('title', 'Editar Perfil')

@section('content_header')
    <h1><strong>Editar Perfil</strong></h1>
@stop

@section('content')

@if(session('status'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: '¡Éxito!',
                text: '{{ session('status') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif


<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="name">Nombre</label>
                <input id="name" name="name" type="text" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input id="email" name="email" type="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
            </div>

            <div class="form-group">
                <label for="password">Nueva Contraseña <small class="text-muted">(Opcional)</small></label>
                <input id="password" name="password" type="password" class="form-control" placeholder="Escriba una nueva contraseña">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Confirma la contraseña">
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
</div>
@stop



