@extends('layouts.panel')

@section('title', 'Ofertas')

@section('content')
<main>
    <div class="container mt-3">
        <h1 class="mt-4">
            <a href="{{ route('dashboard') }}" style="color: #212529; text-decoration: none; margin-right: 10px;">
                <i class="fas fa-arrow-left"></i>
            </a>
            Ofertas
        </h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">
                Mostrando <b>{{ $offers->count() }}</b> resultados
                de un total de <b>{{ $offers->total() }}</b>
            </li>
        </ol>

        <div class="mb-3">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addOfferModal">
                <i class="fas fa-plus"></i> Añadir Oferta
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Registro</th>
                        <th>ID de Oferta</th>
                        <th>Publicación</th>
                        <th>Inversionista</th>
                        <th>Oferta</th>
                        <th>Fecha de Creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($offers as $offer)
                    <tr>
                        <td>{{ $loop->index + $offers->firstItem() }}</td>
                        <td>#{{ $offer->id }}</td>
                        <td>{{ $offer->post->title ?? 'No disponible' }}</td>
                        <td>{{ $offer->investor ? $offer->investor->name : 'No asignado' }}</td>
                        <td>{{ $offer->offer }}</td>
                        <td>{{ optional($offer->created_at)->format('d-m-Y H:i') ?? 'Sin fecha' }}</td>
                        <td>
                            <div class="btn-group">
                                <!-- Botón para editar -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editOfferModal{{ $offer->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <!-- Botón para eliminar -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteOfferModal{{ $offer->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal para editar oferta -->
                    <div class="modal fade" id="editOfferModal{{ $offer->id }}" tabindex="-1" aria-labelledby="editOfferModalLabel{{ $offer->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editOfferModalLabel{{ $offer->id }}">Editar Oferta</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Formulario para editar oferta -->
                                    <form action="{{ route('offer.update', $offer->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="post_id" class="form-label">Publicación</label>
                                            <select class="form-select" id="post_id" name="post_id" required>
                                                @foreach($posts as $post)
                                                    <option value="{{ $post->id }}" @if($offer->post_id == $post->id) selected @endif>{{ $post->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="investor_id" class="form-label">Inversionista</label>
                                            <select class="form-select" id="investor_id" name="investor_id" required>
                                                @foreach($investors as $investor)
                                                    <option value="{{ $investor->id }}" @if($offer->investor_id == $investor->id) selected @endif>{{ $investor->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="offer" class="form-label">Oferta</label>
                                            <input type="text" class="form-control" id="offer" name="offer" value="{{ $offer->offer }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="created_at" class="form-label">Fecha de Creación</label>
                                            <input type="datetime-local" class="form-control" id="created_at" name="created_at" value="{{ $offer->created_at ? $offer->created_at->format('Y-m-d\TH:i') : '' }}" required>

                                        </div>
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para eliminar oferta -->
                    <div class="modal fade" id="deleteOfferModal{{ $offer->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Eliminar Oferta</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Estás seguro de que deseas eliminar esta oferta?</p>
                                    <strong>Oferta: {{ $offer->offer }}</strong>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form action="{{ route('offer.destroy', $offer->id) }}" method="POST">
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
                        <td colspan="7" class="text-center">
                            {{ $offers->links('pagination::bootstrap-5') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</main>

<!-- Modal para agregar oferta -->
<div class="modal fade" id="addOfferModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Añadir Oferta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('offer.add') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="post_id" class="form-label">Publicación</label>
                        <select class="form-select" id="post_id" name="post_id" required>
                            @foreach($posts as $post)
                                <option value="{{ $post->id }}">{{ $post->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="investor_id" class="form-label">Inversionista</label>
                        <select class="form-select" id="investor_id" name="investor_id" required>
                            @foreach($investors as $investor)
                                <option value="{{ $investor->id }}">{{ $investor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="offer" class="form-label">Oferta</label>
                        <input type="text" class="form-control" id="offer" name="offer" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
