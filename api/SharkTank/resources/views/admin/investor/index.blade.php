@extends('layouts.panel')

@section('title', 'Investors')

@section('content')
<main>
    <div class="container mt-3">
        <h1 class="mt-4">
            <a href="{{ route('dashboard') }}" style="color: #212529; text-decoration: none; margin-right: 10px;">
                <i class="fas fa-arrow-left"></i>
            </a>
            Investors
        </h1>
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active" style="display: flex; align-items: center;">
                <div>
                    Mostrando <b>{{ $investors->count() }}</b> resultados
                    de un total de <b>{{ $investors->total() }}</b>
                </div>
            </li>
        </ol>
        
        <div class="mb-3">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addInvestorModal"><i class="fas fa-plus"></i> Añadir Investor</button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover" style="border: 2px solid #212529; color: #212529;">
                <thead>
                    <tr>
                        <th>Registro</th>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Fecha de nacimiento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($investors as $investor)
                    <tr>
                        <td>{{ $loop->index + $investors->firstItem() }}</td>
                        <td>#{{ $investor->id }}</td>
                        <td>{{ $investor->name }}</td>
                        <td>{{ $investor->surname }}</td>
                        <td>{{ $investor->email }}</td>
                        <td>{{ $investor->dob }}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editInvestorModal{{$investor->id}}"><i class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteInvestorModal{{$investor->id}}"><i class="fas fa-trash-alt"></i></button>
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#showInvestorModal{{$investor->id}}"><i class="fas fa-eye"></i> Ver</button>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Modal para mostrar detalles del Investor -->
                    <div class="modal fade" id="showInvestorModal{{$investor->id}}" tabindex="-1" aria-labelledby="showInvestorModalLabel{{$investor->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="showInvestorModalLabel{{$investor->id}}">Detalles de Investor</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Nombre:</strong> {{ $investor->name }}</p>
                                    <p><strong>Apellido:</strong> {{ $investor->surname }}</p>
                                    <p><strong>Correo:</strong> {{ $investor->email }}</p>
                                    <p><strong>Fecha de Nacimiento:</strong> {{ $investor->dob }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para editar Investor -->
                    <div class="modal fade" id="editInvestorModal{{$investor->id}}" tabindex="-1" aria-labelledby="editInvestorModalLabel{{$investor->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editInvestorModalLabel{{$investor->id}}">Editar Investor</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('investor.update', $investor->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="edit_name" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="edit_name" name="name" value="{{ $investor->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_surname" class="form-label">Apellido</label>
                                            <input type="text" class="form-control" id="edit_surname" name="surname" value="{{ $investor->surname }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_email" class="form-label">Correo</label>
                                            <input type="text" class="form-control" id="edit_email" name="email" value="{{ $investor->email }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_dob" class="form-label">Fecha de nacimiento</label>
                                            <input type="date" class="form-control" id="edit_dob" name="dob" value="{{ $investor->dob }}" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para eliminar Investor -->
                    <div class="modal fade" id="deleteInvestorModal{{$investor->id}}" tabindex="-1" aria-labelledby="deleteInvestorModalLabel{{$investor->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteInvestorModalLabel{{$investor->id}}">Eliminar Investor</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Estás seguro de que deseas eliminar a este investor? <strong>{{ $investor->name }}</strong>?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form action="{{ route('investor.destroy', $investor->id) }}" method="POST" style="display: inline;">
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
                        <td colspan="7" class="ulpgcds-pager">
                            {{ $investors->links('pagination::bootstrap-5') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div> 
</main>

<!-- Modal para agregar Investor -->
<div class="modal fade" id="addInvestorModal" tabindex="-1" aria-labelledby="addInvestorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addInvestorModalLabel">Añadir Investor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('investor.add') }}" method="POST">
                    @csrf
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
                        <label for="dob" class="form-label">Fecha de nacimiento</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
