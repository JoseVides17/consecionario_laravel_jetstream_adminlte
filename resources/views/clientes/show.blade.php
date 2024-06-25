@extends('adminlte::page')

@section('title', 'Cliente')

@section('content_header')
    <h1>Cliente</h1>
@stop

@section('content')
    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="m-0">{{ $cliente->nombre }} {{ $cliente->apellido }}</h5>
                    <img src="{{ asset('/assets/images/usuario.png') }}" class="img-fluid rounded-circle" style="width: 50px;">
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-2"><strong>DNI:</strong> {{ $cliente->dni }}</p>
                        <p class="mb-2"><strong>Email:</strong> {{ $cliente->email }}</p>
                        <p class="mb-2"><strong>Telefono:</strong> {{ $cliente->telefono }}</p>
                        <p class="mb-2"><strong>Direccion:</strong> {{ $cliente->direccion }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Creado:</strong> {{ $cliente->created_at }}</p>
                        <p class="mb-2"><strong>Actualizado:</strong> {{ $cliente->updated_at }}</p>
                    </div>
                </div>
                <div class="mt-3">
                    @if(\Illuminate\Support\Facades\Auth::user()->rol->nombre == 'Administrador')
                        <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning mr-2"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mr-2"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    @endif
                    <a href="{{ route('clientes.index') }}" class="btn btn-primary">Volver</a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')

@stop
