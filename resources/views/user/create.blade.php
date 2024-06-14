@extends('adminlte::page')

@section('title', 'Crear Usuario')

@section('content_header')
@stop

@section('content')
    <div class="container">
        <form id="formCrear" action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div>
                <label for="rol_id" class="form-label">Seleccionar Rol</label>
                <select name="rol_id" id="rol_id" class="form-control" required>
                    <option value="" disabled selected>Seleccionar</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">
                            {{ $role->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Crear</button>
            </div>
        </form>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
