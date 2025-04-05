@extends('layouts.panel')

@section('title', 'Usuarios')

@section('content')
<main>
    <div class="container mt-3">
        <h1 class="mt-4">
            <a href="{{ route('dashboard') }}" style="color: #212529; text-decoration: none; margin-right: 10px;"><i class="fas fa-arrow-left"></i></a>
            Usuarios
        </h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active" style="display: flex; align-items: center;">
                <div>
                    Mostrando <b>{{ $users->count() }}</b> resultados
                    de un total de <b>{{ $users->total() }}</b>
                </div>
            </li>
        </ol>
        
        <div class="mb-3">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal"><i class="fas fa-plus"></i> Añadir Usuario</button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover" style="border: 2px solid #212529; color: #212529;">
                <thead>
                    <tr>
                        <th>Registro</th>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Telefono</th>
                        <th>Nivel</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->index + $users->firstItem() }}</td>
                        <td>#{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->surname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->level_id }}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal{{$user->id}}"><i class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUserModal{{$user->id}}"><i class="fas fa-trash-alt"></i></button>
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#showUserModal{{$user->id}}"><i class="fas fa-eye"></i> Ver</button>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Modal para mostrar detalles del Usuario -->
                    <div class="modal fade" id="showUserModal{{$user->id}}" tabindex="-1" aria-labelledby="showUserModalLabel{{$user->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="showUserModalLabel{{$user->id}}">Detalles de Usuario</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Nombre:</strong> {{ $user->name }}</p>
                                    <p><strong>Apellido:</strong> {{ $user->surname }}</p>
                                    <p><strong>Correo:</strong> {{ $user->email }}</p>
                                    <p><strong>Teléfono:</strong> {{ $user->phone }}</p>
                                    <p><strong>Nivel de Cuenta:</strong> 
                                        @switch($user->level_id)
                                            @case(1)
                                                Usuario
                                                @break
                                            @case(2)
                                                Inversionista
                                                @break
                                            @case(3)
                                                Administrador
                                                @break
                                        @endswitch
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para editar Usuario -->
                    <div class="modal fade" id="editUserModal{{$user->id}}" tabindex="-1" aria-labelledby="editUserModalLabel{{$user->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editUserModalLabel{{$user->id}}">Editar Usuario</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Formulario para editar Usuario -->
                                    <form action="{{ route('user.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <!-- Campos del formulario -->
                                        <div class="mb-3">
                                            <label for="edit_name" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="edit_name" name="name" value="{{ $user->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_surname" class="form-label">Apellido</label>
                                            <input type="text" class="form-control" id="edit_surname" name="surname" value="{{ $user->surname }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_email" class="form-label">Correo</label>
                                            <input type="text" class="form-control" id="edit_email" name="email" value="{{ $user->email }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_phone" class="form-label">Telefono</label>
                                            <input type="text" class="form-control" id="edit_phone" name="phone" value="{{ $user->phone }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_password" class="form-label">Contraseña</label>
                                            <input type="password" class="form-control" id="edit_password" name="password">
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_level_id" class="form-label">Nivel de cuenta</label>
                                            <select class="form-select" id="edit_level_id" name="level_id" required>
                                                <option value="1" {{ $user->level_id == 1 ? 'selected' : '' }}>Usuario</option>
                                                <option value="2" {{ $user->level_id == 2 ? 'selected' : '' }}>Inversionista</option>
                                                <option value="3" {{ $user->level_id == 3 ? 'selected' : '' }}>Administrador</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para eliminar usuario -->
                    <div class="modal fade" id="deleteUserModal{{$user->id}}" tabindex="-1" aria-labelledby="deleteUserModalLabel{{$user->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteUserModalLabel{{$user->id}}">Eliminar Usuario</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Estás seguro de que deseas eliminar a este usuario? <strong>{{ $user->name }}</strong>?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="ulpgcds-pager">
                            {{-- Enlaces de paginación --}}
                            {{ $users->links('pagination::bootstrap-5') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div> 
</main>

<!-- Modal para agregar Usuario -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Añadir Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para agregar Usuario -->
                <form action="{{ route('user.add') }}" method="POST">
                    @csrf
                    <!-- Campos del formulario -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="surname" name="surname" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Telefono</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="level_id" class="form-label">Nivel de cuenta</label>
                        <select class="form-select" id="level_id" name="level_id" required>
                            <option value="1">Usuario</option>
                            <option value="2">Inversionista</option>
                            <option value="3">Administrador</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
