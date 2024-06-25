@extends('adminlte::page')

@section('title', 'Editar Cliente')

@section('content_header')
    <h1>Editar Cliente</h1>
@stop

@section('content')
    <div class="container">
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $cliente->nombre }}" required>
                    </div>

                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" name="apellido" id="apellido" class="form-control" value="{{ $cliente->apellido }}" required>
                    </div>

                    <div class="form-group">
                        <label for="dni">DNI</label>
                        <input type="number" name="dni" id="dni" class="form-control" value="{{ $cliente->dni }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $cliente->email }}" required>
                    </div>

                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="number" name="telefono" id="telefono" class="form-control" value="{{ $cliente->telefono }}" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <input type="text" name="direccion" id="direccion" class="form-control" value="{{ $cliente->direccion }}" required>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-success btn-block" style="margin-top: 10px">Actualizar</button>
                        <a href="{{ route('clientes.index') }}" class="btn btn-secondary btn-block" style="margin-top: 10px">Regresar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')

@stop
