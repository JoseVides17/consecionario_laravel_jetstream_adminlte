@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
@stop

@section('content')
    <div class="container-fluid">
        <div class="card card-primary" style="margin-top: 10px">
            <div class="card-header">
                <h3 class="card-title">Buscar Usuarios</h3>
            </div>
            <div class="card-body">
                <form id="searchForm" method="GET" action="{{ route('users.index') }}">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="form-group">
                                <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}" placeholder="Nombres" />
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="form-group">
                                <input type="email" name="email" id="email" class="form-control" value="{{ request('email') }}" placeholder="Email" />
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="form-group">
                                <input type="date" name="created_at" id="created_at" class="form-control" value="{{ request('created_at') }}" />
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <button type="submit" id="btn_buscar" class="btn btn-primary btn-md mb-1" data-url="{{ route('users.index') }}"><i class="fas fa-search"></i></button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary btn-md mb-1">Resetear</a>
                            @if(\Illuminate\Support\Facades\Auth::user()->rol->nombre == 'Administrador')
                                <a href="{{ route('users.create') }}" class="btn btn-success btn-md mb-1"><i class="fas fa-plus"></i></a>
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
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Creado</th>
                        <th>Actualizado</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody id="userTableBody">
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->rol->nombre ?? 'Sin Rol' }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                            <td>
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                @if(\Illuminate\Support\Facades\Auth::user()->rol->nombre == 'Administrador')
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <form id="frmData" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
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
    @if(session('user_reg'))
        <script>
            Swal.fire("Usuario Registrado");
        </script>
    @endif
    @if(session('delete'))
        <script>
            Swal.fire("Usuario Eliminado");
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
                                    text: "El usuario ha sido eliminado.",
                                    icon: "success"
                                }).then(() => {
                                    form.submit();
                                });
                            } else if (result.dismiss === Swal.DismissReason.cancel) {
                                swalWithBootstrapButtons.fire({
                                    title: "Cancelado",
                                    text: "El usuario está a salvo :)",
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
