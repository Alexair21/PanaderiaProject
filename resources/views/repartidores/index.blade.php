@extends('tablar::page')

@section('title', 'Repartidores')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Listado de repartidores
                    </div>
                    <h2 class="page-title">
                        Repartidores registrados
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Listado de Repartidores</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap">
                                <thead style="background-color: #6777ef;">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Teléfono</th>
                                        <th>Dirección</th>
                                        <th>Estado</th>
                                        <th>Asignaciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($repartidores as $repartidor)
                                        <tr>
                                            <td>{{ $repartidor->nombre }}</td>
                                            <td>{{ $repartidor->email }}</td>
                                            <td>{{ $repartidor->telefono }}</td>
                                            <td>{{ $repartidor->direccion }}</td>
                                            <td>
                                                @if ($repartidor->estado == 'Disponible')
                                                    <span style="color:white" class="badge bg-success">{{ $repartidor->estado }}</span>
                                                @else
                                                    <span style="color:white" class="badge bg-danger">{{ $repartidor->estado }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($repartidor->asignaciones->isEmpty())
                                                    Sin asignaciones
                                                @else
                                                    <ul>
                                                        @foreach ($repartidor->asignaciones as $asignacion)
                                                            <li>
                                                                Pedido ID: {{ $asignacion->pedido_id }} - Estado: {{ $asignacion->estado }}
                                                                <button type="button" class="btn btn-sm btn-info"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#detallePedidoModal"
                                                                    data-pedido-id="{{ $asignacion->pedido_id }}">
                                                                    Ver detalles
                                                                </button>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para detalles del pedido -->
    <div class="modal fade" id="detallePedidoModal" tabindex="-1" aria-labelledby="detallePedidoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detallePedidoModalLabel">Detalles del Pedido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="pedidoDetalles">
                        <p>Cargando detalles...</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('detallePedidoModal');
            const pedidoDetalles = document.getElementById('pedidoDetalles');

            modal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const pedidoId = button.getAttribute('data-pedido-id');

                // Limpia contenido previo
                pedidoDetalles.innerHTML = 'Cargando detalles...';

                // Fetch para obtener los detalles del pedido
                fetch(`/repartidores/pedido/${pedidoId}`)
                    .then(response => response.json())
                    .then(data => {
                        pedidoDetalles.innerHTML = `
                            <p><strong>Cliente:</strong> ${data.cliente}</p>
                            <p><strong>Dirección:</strong> ${data.direccion}</p>
                            <p><strong>Método de Pago:</strong> ${data.metodo_pago}</p>
                            <p><strong>Total:</strong> S/. ${data.total}</p>
                            <p><strong>Detalle:</strong></p>
                            <ul>
                                ${data.detalles.map(detalle => `
                                    <li>${detalle.cantidad} x ${detalle.nombre} (S/. ${detalle.total})</li>
                                `).join('')}
                            </ul>
                        `;
                    })
                    .catch(error => {
                        console.error('Error al cargar los detalles:', error);
                        pedidoDetalles.innerHTML = '<p>Error al cargar los detalles del pedido.</p>';
                    });
            });
        });
    </script>
@endsection
