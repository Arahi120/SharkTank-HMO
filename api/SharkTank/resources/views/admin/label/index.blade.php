@extends('layouts.panel')

@section('title', 'Labels')

@section('content')
<main>
    <div class="container mt-3">
        <h1 class="mt-4">
            <a href="{{ route('dashboard') }}" style="color: #212529; text-decoration: none; margin-right: 10px;"><i class="fas fa-arrow-left"></i></a>
            Labels
        </h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active" style="display: flex; align-items: center;">
                <div>
                    Mostrando <b>{{ $labels->count() }}</b> resultados
                    de un total de <b>{{ $labels->total() }}</b>
                </div>
            </li>
        </ol>
        
        <div class="mb-3">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addLabelModal"><i class="fas fa-plus"></i> Añadir Label</button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover" style="border: 2px solid #212529; color: #212529;">
                <thead>
                    <tr>
                        <th>Registro</th>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($labels as $label)
                    <tr>
                        <td>{{ $loop->index + $labels->firstItem() }}</td>
                        <td>#{{ $label->id }}</td>
                        <td>{{ $label->name }}</td>
                        <td>{{ Str::limit($label->description, 50) }}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editLabelModal{{$label->id}}"><i class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteLabelModal{{$label->id}}"><i class="fas fa-trash-alt"></i></button>
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#showLabelModal{{$label->id}}"><i class="fas fa-eye"></i> Ver</button>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Modal para mostrar detalles del Label -->
                    <div class="modal fade" id="showLabelModal{{$label->id}}" tabindex="-1" aria-labelledby="showLabelModalLabel{{$label->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="showLabelModalLabel{{$label->id}}">Detalles de Label</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Nombre:</strong> {{ $label->name }}</p>
                                    <p><strong>Descripción:</strong> {{ $label->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para editar Label -->
                    <div class="modal fade" id="editLabelModal{{$label->id}}" tabindex="-1" aria-labelledby="editLabelModalLabel{{$label->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editLabelModalLabel{{$label->id}}">Editar Label</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Formulario para editar Label -->
                                    <form action="{{ route('label.update', $label->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="edit_name" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="edit_name" name="name" value="{{ $label->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_description" class="form-label">Descripción</label>
                                            <textarea class="form-control" id="edit_description" name="description" required>{{ $label->description }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para eliminar Label -->
                    <div class="modal fade" id="deleteLabelModal{{$label->id}}" tabindex="-1" aria-labelledby="deleteLabelModalLabel{{$label->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteLabelModalLabel{{$label->id}}">Eliminar Label</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Estás seguro de que deseas eliminar este Label: <strong>{{ $label->name }}</strong>?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form action="{{ route('label.destroy', $label->id) }}" method="POST" style="display: inline;">
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
                        <td colspan="5" class="ulpgcds-pager">
                            {{-- Enlaces de paginación --}}
                            {{ $labels->links('pagination::bootstrap-5') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</main>

<!-- Modal para agregar Label -->
<div class="modal fade" id="addLabelModal" tabindex="-1" aria-labelledby="addLabelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLabelModalLabel">Añadir Label</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para agregar Label -->
                <form action="{{ route('label.add') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
