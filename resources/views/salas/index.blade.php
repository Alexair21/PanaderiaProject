@extends('tablar::page')
@section('title', 'Salas')

@section('content')

    <!-- Notificación de éxito -->
    @if (session('success'))
        <div id="notification" class="notification">
            <i class="fa fa-check-circle"></i> <!-- Ícono de éxito -->
            {{ session('success') }}
        </div>
    @endif

    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">Listado de Salas</div>
                    <h2 class="page-title">Salas registradas</h2>
                </div>
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createSalaModal">
                        Registrar nueva sala
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Salas en formato de tarjetas -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                @foreach ($salas as $sala)
                    <div class="col-sm-6 col-lg-4">
                        <div class="card text-center">
                            <!-- Imagen referencial -->
                            <img src="{{ asset('images/sala.jpg') }}" class="card-img-top img-circle" alt="Imagen de Sala">
                            <div class="card-body">
                                <h3 class="card-title">{{ $sala->nombre }}</h3>
                                <p class="card-text">
                                    <strong>Número de Mesas:</strong> {{ $sala->numero_mesas }}
                                </p>
                                <div class="d-flex justify-content-center">
                                    <!-- Botón para ver mesas -->
                                    <a href="{{ route('mesas.indexMesas', $sala->id) }}" class="btn btn-success me-2">Ver Mesas</a>

                                    <!-- Botón Editar -->
                                    <a href="{{ route('salas.edit', $sala->id) }}" class="btn btn-primary me-2">Editar</a>

                                    <!-- Botón Eliminar -->
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['salas.destroy', $sala->id],
                                        'style' => 'display:inline',
                                    ]) !!}
                                    {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Paginación -->
            <div class="pagination justify-content-center mt-4">
                {!! $salas->links() !!}
            </div>
        </div>
    </div>

    <!-- Modal para crear nueva sala -->
    <div class="modal fade" id="createSalaModal" tabindex="-1" aria-labelledby="createSalaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('salas.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createSalaModalLabel">Registrar Nueva Sala</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre de la Sala</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="numero_mesas" class="form-label">Número de Mesas</label>
                            <input type="number" class="form-control" id="numero_mesas" name="numero_mesas" required min="1">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <style>
        .img-circle {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin: 0 auto;
        }

        .notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border-radius: 8px;
            font-size: 1rem;
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: fade-in-out 5s ease-in-out;
        }

        .notification i {
            font-size: 1.5rem;
        }

        @keyframes fade-in-out {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            10%, 90% {
                opacity: 1;
                transform: translateY(0);
            }
            100% {
                opacity: 0;
                transform: translateY(20px);
            }
        }
    </style>
@endsection
