@extends('adminlte::page')

@section('title', 'Usuario')

@section('content_header')
    <h1>Usuario</h1>
@stop

@section('content')
    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="m-0">{{ $user->name }}</h5>
                    <img src="{{ asset('/assets/images/usuario.png') }}" class="img-fluid rounded-circle" style="width: 50px;">
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Email:</strong> {{ $user->email }}</p>
                        <p class="mb-2"><strong>Rol:</strong> {{ $user->rol->nombre ?? 'Sin rol' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Creado:</strong> {{ $user->created_at }}</p>
                        <p class="mb-2"><strong>Actualizado:</strong> {{ $user->updated_at }}</p>
                    </div>
                </div>
                <div class="mt-3">
                    @if(\Illuminate\Support\Facades\Auth::user()->rol->nombre == 'Administrador')
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning mr-2"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mr-2"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    @endif
                    <a href="{{ route('users.index') }}" class="btn btn-primary">Volver</a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
