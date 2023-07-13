@extends('layouts.app')

@section('title', 'Home')

@section('content-header')
    <div class="row mb-2">
        <div class="col-6">
            <h2>Usuarios</h2>
        </div>
        <div class="col-6 text-right mt-4">
            <button class="btn btn-success btn-add-user" data-toggle="modal" data-target="#addUserModal">Añadir Usuario</button>
        </div>
    </div>
@endsection

@section('content')
    <!-- Tabla con usuarios -->
    <div class="table-responsive shadow p-3 mb-5 bg-light-grey">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Alta</th>
                    <th>Email</th>
                    <th>Activado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->email }}</td>
                    <td>@if($user->is_active) <img src="{{ asset('check.png') }}" alt="Edit" class="img-fluid" width=30> @else <img src="{{ asset('error.png') }}" alt="Edit" class="img-fluid" width=30> @endif</td>
                    <td class="flex">
                        <button class="btn btn-edit-user" data-toggle="modal" data-target="#editUserModal{{$user->id}}" data-user-id="{{ $user->id }}" id="editUserBtn_{{ $user->id }}"><img src="{{ asset('edit.png') }}" alt="Edit" class="img-fluid" width=30></button>
                        <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn" type="submit"><img src="{{ asset('delete.png') }}" alt="Delete" class="img-fluid" width=30></button>
                        </form>
                    </td>
                    <!-- Modal para editar usuario -->
                    <div class="modal fade" id="editUserModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editUserModalLabel">Editar Usuario</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Formulario para editar usuario -->
                                    <form id="editUserForm" action="{{ route('users.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="editUserName">Nombre</label>
                                            <input type="text" class="form-control" id="editUserName" name="name" placeholder="Nombre" value="{{$user->name}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editUserEmail">Email</label>
                                            <input type="email" class="form-control" id="editUserEmail" name="email" placeholder="Email" value="{{$user->email}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editUserIsActive">¿Activo?</label>
                                            @if($user->is_active)
                                            <input type="checkbox" class="form-control" id="editUserIsActive" name="is_active" placeholder="is_active" checked>
                                            @else
                                            <input type="checkbox" class="form-control" id="editUserIsActive" name="is_active" placeholder="is_active">
                                            @endif
                                        </div>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal para añadir usuario -->
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Añadir Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para añadir usuario -->
                    <form id="addUserForm" action="{{ route('users.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="addUserName">Nombre</label>
                            <input type="text" class="form-control" id="addUserName" name="name" placeholder="Nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="addUserEmail">Email</label>
                            <input type="email" class="form-control" id="addUserEmail" name="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label for="addUserPassword">Contraseña</label>
                            <input type="password" class="form-control" id="addUserPassword" name="password" placeholder="Contraseña" required>
                        </div>
                        <div class="form-group">
                            <label for="addUserPassword2">Repita Contraseña</label>
                            <input type="password" class="form-control" id="addUserPassword2" name="password2" placeholder="Repita contraseña" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Añadir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Acción de añadir usuario
        $('.btn-add-user').on('click', function() {
            $('#addUserModal').modal('show');
        });
    });
</script>
@endsection
