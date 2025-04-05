@extends('layouts.panel')

@section('title', 'Comentarios')

@section('content')
<main>
    <div class="container mt-3">
        <h1 class="mt-4">
            <a href="{{ route('dashboard') }}" style="color: #212529; text-decoration: none; margin-right: 10px;">
                <i class="fas fa-arrow-left"></i>
            </a>
            Comentarios
        </h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active" style="display: flex; align-items: center;">
                <div>
                    Mostrando <b>{{ $comments->count() }}</b> resultados
                    de un total de <b>{{ $comments->total() }}</b>
                </div>
            </li>
        </ol>
        
        <div class="mb-3">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCommentModal">
                <i class="fas fa-plus"></i> Añadir Comentario
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover" style="border: 2px solid #212529; color: #212529;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Post</th>
                        <th>Contenido</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comments as $comment)
                    <tr>
                        <td>{{ $loop->index + $comments->firstItem() }}</td>
                        <td>{{ optional($comment->user)->name ?? 'Usuario no encontrado' }}</td>
                        <td>{{ optional($comment->post)->title ?? 'Post no disponible' }}</td>
                        <td>{{ Str::limit($comment->content, 50) }}</td>
                        <td>{{ optional($comment->created_at)->format('d-m-Y H:i') ?? 'Sin fecha' }}</td>
                        <td>
    <div class="btn-group" role="group" aria-label="Acciones">
        <!-- Botón para editar -->
        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editCommentModal{{ $comment->id }}">
            <i class="fas fa-edit"></i>
        </button>

        <!-- Botón para eliminar -->
        <form action="{{ route('comment.destroy', $comment->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">
                <i class="fas fa-trash-alt"></i>
            </button>
        </form>

        <!-- Botón para ver -->
        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#showCommentModal{{ $comment->id }}">
            <i class="fas fa-eye"></i>
        </button>
    </div>
</td>
                    </tr>

                    <!-- Modal para mostrar detalles del Comentario -->
                    <div class="modal fade" id="showCommentModal{{ $comment->id }}" tabindex="-1" aria-labelledby="showCommentModalLabel{{ $comment->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="showCommentModalLabel{{ $comment->id }}">Detalles del Comentario</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Usuario:</strong> {{ optional($comment->user)->name ?? 'Usuario no encontrado' }}</p>
                                    <p><strong>Post:</strong> {{ optional($comment->post)->title ?? 'Post no disponible' }}</p>
                                    <p><strong>Contenido:</strong> {{ $comment->content }}</p>
                                    <p><strong>Fecha:</strong> {{ optional($comment->created_at)->format('d-m-Y H:i') ?? 'Sin fecha' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para editar comentario -->
                    <div class="modal fade" id="editCommentModal{{ $comment->id }}" tabindex="-1" aria-labelledby="editCommentModalLabel{{ $comment->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editCommentModalLabel{{ $comment->id }}">Editar Comentario</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('comment.update', $comment->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="content" class="form-label">Contenido</label>
                                            <textarea class="form-control" id="content" name="content" rows="3" required>{{ $comment->content }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para eliminar comentario -->
                    <div class="modal fade" id="deleteCommentModal{{ $comment->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Eliminar Comentario</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Estás seguro de que deseas eliminar este comentario?</p>
                                    <strong>{{ $comment->content }}</strong>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form action="{{ route('comment.destroy', $comment->id) }}" method="POST">
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
            </table>
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-center">
            {{ $comments->links() }}
        </div>
    </div>

    <!-- Modal para añadir comentario -->
    <div class="modal fade" id="addCommentModal" tabindex="-1" aria-labelledby="addCommentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCommentModalLabel">Añadir Comentario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('comment.add') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="content" class="form-label">Contenido</label>
                            <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
