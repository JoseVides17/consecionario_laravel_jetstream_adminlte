@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Clientes</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card card-primary" style="margin-top: 10px">
            <div class="card-header">
                <h3 class="card-title">Buscar Clientes</h3>
            </div>
            <div class="card-body">
                <form id="searchForm" method="GET" action="{{ route('clientes.index') }}">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="form-group">
                                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ request('nombre') }}" placeholder="Nombres" />
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="form-group">
                                <input type="email" name="email" id="email" class="form-control" value="{{ request('email') }}" placeholder="Email" />
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="form-group">
                                <input type="text" name="dni" id="dni" class="form-control" value="{{ request('dni') }}" placeholder="dni" />
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <button type="submit" id="btn_buscar" class="btn btn-primary btn-md mb-1" data-url="{{ route('clientes.index') }}"><i class="fas fa-search"></i></button>
                            <a href="{{ route('clientes.index') }}" class="btn btn-secondary btn-md mb-1">Resetear</a>
                            @if(\Illuminate\Support\Facades\Auth::user()->rol->nombre == 'Administrador')
                                <a href="{{ route('clientes.create') }}" class="btn btn-success btn-md mb-1"><i class="fas fa-plus"></i></a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card card-primary mt-4">
            <div class="card-header">
                <h3 class="card-title">Lista de Usuarios</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>DNI</th>
                        <th>Email</th>
                        <th>Telefono</th>
                        <th>Direccion</th>
                        <th>Creado</th>
                        <th>Actualizado</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody id="userTableBody">
                    @foreach($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->id }}</td>
                            <td>{{ $cliente->nombre }}</td>
                            <td>{{ $cliente->apellido }}</td>
                            <td>{{ $cliente->dni }}</td>
                            <td>{{ $cliente->email }}</td>
                            <td>{{ $cliente->telefono }}</td>
                            <td>{{ $cliente->direccion }}</td>
                            <td>{{ $cliente->created_at }}</td>
                            <td>{{ $cliente->updated_at }}</td>
                            <td>
                                <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                @if(\Illuminate\Support\Facades\Auth::user()->rol->nombre == 'Administrador')
                                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <form id="frmData" action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">

            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
    @if(session('cliente_reg'))
        <script>
            Swal.fire("Cliente Registrado");
        </script>
    @endif
    @if(session('cliente_del'))
        <script>
            Swal.fire("Cliente Eliminado");
        </script>
    @endif
    <script>
        @if(Auth::user()->rol->nombre == 'Administrador')
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('#frmData').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: "btn btn-success",
                            cancelButton: "btn btn-danger"
                        },
                        buttonsStyling: false
                    });

                    swalWithBootstrapButtons.fire({
                        title: "¿Estás seguro?",
                        text: "¡No podrás revertir esto!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Sí, eliminar!",
                        cancelButtonText: "No, cancelar!",
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            swalWithBootstrapButtons.fire({
                                title: "Eliminado",
                                text: "El cliente ha sido eliminado.",
                                icon: "success"
                            }).then(() => {
                                form.submit();
                            });
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            swalWithBootstrapButtons.fire({
                                title: "Cancelado",
                                text: "El cliente está a salvo :)",
                                icon: "error"
                            });
                        }
                    });
                });
            });
        });
        @endif
    </script>
@stop
