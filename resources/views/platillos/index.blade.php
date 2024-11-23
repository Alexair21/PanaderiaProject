@extends('tablar::page')

@section('title', 'Platillos')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl d-flex justify-content-between align-items-center">
            <h2 class="page-title">Platillos registrados</h2>
            <a href="{{ route('platillos.create') }}" class="btn btn-primary">Registrar nuevo platillo</a>
        </div>
    </div>

    <br>
    <!-- Notificaciones -->
    @if (session('success') || session('error') || session('info'))
        <div id="notification" class="notification {{ session('success') ? 'bg-success' : (session('error') ? 'bg-danger' : 'bg-info') }}">
            <i class="fa {{ session('success') ? 'fa-check-circle' : (session('error') ? 'fa-times-circle' : 'fa-info-circle') }}"></i>
            {{ session('success') ?? session('error') ?? session('info') }}
        </div>
    @endif

    <!-- Filtros -->
    <div class="container-xl mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" id="search" class="form-control" placeholder="Buscar platillos...">
            </div>
            <div class="col-md-4">
                <select id="filter-category" class="form-control">
                    <option value="">Filtrar por categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <select id="filter-availability" class="form-control">
                    <option value="">Filtrar por disponibilidad</option>
                    <option value="1">Disponibles</option>
                    <option value="0">No disponibles</option>
                </select>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Platillos</h3>
                        </div>
                        <div class="table-responsive">
                            <table id="platillos-table" class="table card-table table-vcenter text-nowrap datatable">
                                <thead style="background-color: #6777ef;">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Precio S/.</th>
                                        <th>Imagen</th>
                                        <th>Categoría</th>
                                        <th>Estado</th>
                                        <th>Destacado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($platillos as $platillo)
                                        <tr data-category="{{ $platillo->categoria_id }}" data-availability="{{ $platillo->estado }}">
                                            <td>{{ $platillo->id }}</td>
                                            <td>{{ $platillo->nombre }}</td>
                                            <td>S/. {{ $platillo->precio }}</td>
                                            <td>
                                                <img src="{{ asset($platillo->imagen) }}" alt="Imagen del platillo" style="width: 100px; height: 100px; border-radius: 10px;">
                                            </td>
                                            <td>{{ $platillo->categoria->nombre ?? 'Sin categoría' }}</td>
                                            <td>
                                                <form action="{{ route('platillos.toggleEstado', $platillo->id) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-sm {{ $platillo->estado ? 'btn-success' : 'btn-danger' }}">
                                                        {{ $platillo->estado ? 'Disponible' : 'No disponible' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('platillos.toggleDestacado', $platillo->id) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-sm {{ $platillo->destacado ? 'btn-success' : 'btn-secondary' }}">
                                                        {{ $platillo->destacado ? 'Destacado' : 'No destacado' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modal-{{ $platillo->id }}">Ver</button>
                                                <a href="{{ route('platillos.edit', $platillo->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                                <form action="{{ route('platillos.destroy', $platillo->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-{{ $platillo->id }}" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">{{ $platillo->nombre }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Descripción:</strong> {{ $platillo->descripcion }}</p>
                                                        <p><strong>Precio:</strong> S/. {{ $platillo->precio }}</p>
                                                        <p><strong>Categoría:</strong> {{ $platillo->categoria->nombre ?? 'Sin categoría' }}</p>
                                                        <img src="{{ asset($platillo->imagen) }}" alt="Imagen del platillo" class="img-fluid">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: fade-in-out 5s ease-in-out;
            z-index: 1000;
        }

        .notification.bg-success {
            background-color: #4CAF50; /* Verde */
        }

        .notification.bg-danger {
            background-color: #FF5252; /* Rojo */
        }

        .notification.bg-info {
            background-color: #2196F3; /* Azul */
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
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const notification = document.getElementById('notification');
            if (notification) {
                setTimeout(() => {
                    notification.remove();
                }, 5000); // Se oculta después de 5 segundos
            }

            // Filtro por búsqueda
            document.getElementById('search').addEventListener('input', function () {
                const query = this.value.toLowerCase();
                document.querySelectorAll('#platillos-table tbody tr').forEach(row => {
                    row.style.display = row.textContent.toLowerCase().includes(query) ? '' : 'none';
                });
            });

            // Filtro por categoría
            document.getElementById('filter-category').addEventListener('change', function () {
                const category = this.value;
                document.querySelectorAll('#platillos-table tbody tr').forEach(row => {
                    row.style.display = category === '' || row.dataset.category === category ? '' : 'none';
                });
            });

            // Filtro por disponibilidad
            document.getElementById('filter-availability').addEventListener('change', function () {
                const availability = this.value;
                document.querySelectorAll('#platillos-table tbody tr').forEach(row => {
                    row.style.display = availability === '' || row.dataset.availability === availability ? '' : 'none';
                });
            });
        });
    </script>
@stop
