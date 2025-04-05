@extends('layouts.panel')

@section('title', 'Posts')

@section('content')
<main>
    <div class="container mt-3">
        <h1 class="mt-4">
            <a href="{{ route('dashboard') }}" style="color: #212529; text-decoration: none; margin-right: 10px;"><i class="fas fa-arrow-left"></i></a>
            Posts
        </h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active" style="display: flex; align-items: center;">
                <div>
                    Mostrando <b>{{ $posts->count() }}</b> resultados
                    de un total de <b>{{ $posts->total() }}</b>
                </div>
            </li>
        </ol>
        
        <div class="mb-3">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPostModal"><i class="fas fa-plus"></i> Añadir Post</button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover" style="border: 2px solid #212529; color: #212529;">
                <thead>
                    <tr>
                        <th>Registro</th>
                        <th>Id</th>
                        <th>Título</th>
                        <th>Contenido</th>
                        <th>Etiqueta</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{ $loop->index + $posts->firstItem() }}</td>
                        <td>#{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ Str::limit($post->content, 50) }}</td>
                        <td>{{ $post->label->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($post->date)->format('d/m/Y') }}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editPostModal{{$post->id}}"><i class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletePostModal{{$post->id}}"><i class="fas fa-trash-alt"></i></button>
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#showPostModal{{$post->id}}"><i class="fas fa-eye"></i> Ver</button>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Modal para mostrar detalles del Post -->
                    <div class="modal fade" id="showPostModal{{$post->id}}" tabindex="-1" aria-labelledby="showPostModalLabel{{$post->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="showPostModalLabel{{$post->id}}">Detalles del Post</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Título:</strong> {{ $post->title }}</p>
                                    <p><strong>Contenido:</strong> {{ $post->content }}</p>
                                    <p><strong>Etiqueta:</strong> {{ $post->label->name }}</p>
                                    <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($post->date)->format('d/m/Y') }}</p>
                                    <p><strong>Imagen:</strong> <img src="{{ $post->image }}" class="img-fluid" alt="Imagen del post"></p>
                                    <p><strong>Estado:</strong> {{ $post->status ? 'Activo' : 'Inactivo' }}</p>
                                    <p><strong>Asking:</strong> {{ $post->asking }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para editar Post -->
                    <div class="modal fade" id="editPostModal{{$post->id}}" tabindex="-1" aria-labelledby="editPostModalLabel{{$post->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editPostModalLabel{{$post->id}}">Editar Post</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Formulario para editar Post -->
                                    <form action="{{ route('post.update', $post->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <!-- Campos del formulario -->
                                        <div class="mb-3">
                                            <label for="edit_title" class="form-label">Título</label>
                                            <input type="text" class="form-control" id="edit_title" name="title" value="{{ $post->title }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_content" class="form-label">Contenido</label>
                                            <textarea class="form-control" id="edit_content" name="content" required>{{ $post->content }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_label_id" class="form-label">Etiqueta</label>
                                            <select class="form-select" id="edit_label_id" name="label_id" required>
                                                @foreach($labels as $label)
                                                    <option value="{{ $label->id }}" {{ $label->id == $post->label_id ? 'selected' : '' }}>
                                                        {{ $label->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>                                        
                                        <div class="mb-3">
                                            <label for="edit_date" class="form-label">Fecha</label>
                                            <input type="text" class="form-control" id="edit_date" name="date" value="{{ \Carbon\Carbon::parse($post->date)->format('d/m/Y') }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_image" class="form-label">Imagen</label>
                                            <input type="text" class="form-control" id="edit_image" name="image" value="{{ $post->image }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_asking" class="form-label">Asking</label>
                                            <input type="text" class="form-control" id="edit_asking" name="asking" value="{{ $post->asking }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_status" class="form-label">Estado</label>
                                            <select class="form-select" id="edit_status" name="status" required>
                                                <option value="1" {{ $post->status == 1 ? 'selected' : '' }}>Activo</option>
                                                <option value="0" {{ $post->status == 0 ? 'selected' : '' }}>Inactivo</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para eliminar Post -->
                    <div class="modal fade" id="deletePostModal{{$post->id}}" tabindex="-1" aria-labelledby="deletePostModalLabel{{$post->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deletePostModalLabel{{$post->id}}">Eliminar Post</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Estás seguro de que deseas eliminar este post? <strong>{{ $post->title }}</strong>?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form action="{{ route('post.destroy', $post->id) }}" method="POST" style="display: inline;">
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
                            {{ $posts->links('pagination::bootstrap-5') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div> 
</main>

<!-- Modal para agregar Post -->
<div class="modal fade" id="addPostModal" tabindex="-1" aria-labelledby="addPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPostModalLabel">Añadir Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para agregar Post -->
                <form action="{{ route('post.add') }}" method="POST">
                    @csrf
                    <!-- Campos del formulario -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Contenido</label>
                        <textarea class="form-control" id="content" name="content" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="label_id" class="form-label">Etiqueta</label>
                        <select class="form-control" id="label_id" name="label_id" required>
                            @foreach ($labels as $label)
                                <option value="{{ $label->id }}">{{ $label->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Fecha</label>
                        <input type="text" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Imagen</label>
                        <input type="text" class="form-control" id="image" name="image" required>
                    </div>
                    <div class="mb-3">
                        <label for="asking" class="form-label">Asking</label>
                        <input type="text" class="form-control" id="asking" name="asking" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Estado</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
