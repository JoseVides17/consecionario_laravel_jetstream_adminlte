@extends('adminlte::page')

@section('title', 'Registrar Cliente')

@section('content_header')
@stop

@section('content')
    <x-authentication-card>
    <div class="container">
        <form id="formCrear" action="{{ route('clientes.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombres</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
            </div>
            <div>
                <label for="dni" class="form-label">DNI</label>
                <input type="number" class="form-control" id="dni" name="dni" required>
            </div>
            <div>
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Telefono</label>
                <input type="number" class="form-control" id="telefono" name="telefono" required>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Direccion</label>
                <input type="text" class="form-control" id="direccion" name="direccion" required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Crear</button>
            </div>
        </form>
    </div>
    </x-authentication-card>
@stop

@section('css')
@stop

@section('js')

@stop
