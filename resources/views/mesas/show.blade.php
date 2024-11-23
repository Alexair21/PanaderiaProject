@extends('tablar::page')
@section('title', 'Pedido en Mesa')

@section('content')

<div class="container mt-4">
    <div class="row">
        <!-- Columna izquierda: Platillos disponibles -->
        <div class="col-md-8">
            <!-- Filtro por subcategorías -->
            <h5 class="mb-3">Filtrar por Subcategorías:</h5>
            <select class="form-control mb-4" id="filtro-subcategoria" onchange="filtrarPlatillos()">
                <option value="all">Todas</option>
                @foreach ($subcategorias as $subcategoria)
                    <option value="{{ $subcategoria->id }}">{{ $subcategoria->nombre }}</option>
                @endforeach
            </select>

            <!-- Platillos disponibles -->
            <h5 class="mb-3">Platillos Disponibles:</h5>
            <div class="d-flex flex-wrap mb-4" id="lista-platillos">
                @foreach ($platillos as $platillo)
                    @if ($platillo->estado == 1)
                        <div class="platillo-item text-center mx-2" data-subcategoria="{{ $platillo->categoria_id }}"
                             onclick="agregarPlatillo({{ $platillo->id }}, '{{ $platillo->nombre }}', {{ $platillo->precio }})">
                            <img src="{{ asset($platillo->imagen) }}" class="platillo-img" alt="{{ $platillo->nombre }}">
                            <p class="mt-1 platillo-nombre">{{ $platillo->nombre }}</p>
                            <p class="text-muted">S/. {{ number_format($platillo->precio, 2) }}</p>
                        </div>
                    @endif
                @endforeach
            </div>


            <!-- Tabla de pedido -->
            <h5>Resumen del Pedido:</h5>
            <table class="table table-bordered" id="tabla-pedido">
                <thead style="background-color: #0d6efd; color: white;">
                    <tr>
                        <th>Cantidad</th>
                        <th>Descripción de Platillo</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody id="pedido-detalle">
                    <tr id="no-platillos">
                        <td colspan="5" class="text-center text-muted">No hay platillos en el pedido</td>
                    </tr>
                </tbody>
            </table>

            <!-- Total -->
            <h5 class="mt-3">Total a Confirmar: S/. <span id="pedido-total">0.00</span></h5>
        </div>

        <!-- Columna derecha: Detalles del cliente -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header" style="background-color: #dc3545; color: white;">
                    SALA: {{ $mesa->sala->nombre }} - MESA {{ $mesa->numero }}
                </div>
                <div class="card-body">
                    <h6>Búsqueda de Cliente:</h6>
                    <input type="text" class="form-control mb-3" id="buscar-cliente" placeholder="Ingrese nombre o DNI" onblur="buscarCliente()">
                    <div id="cliente-datos">
                        <!-- Datos del cliente (se llenarán dinámicamente) -->
                    </div>
                    <button class="btn btn-success w-100" onclick="confirmarPedido()">Confirmar Pedido</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('css')
    <style>
        .platillo-item {
            width: 120px;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .platillo-item:hover {
            transform: scale(1.1);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        .platillo-img {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }
        .platillo-nombre {
            font-size: 12px;
            font-weight: bold;
            color: #333;
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
    </style>
@endsection

@section('js')
    <script>
        let pedido = [];
        let totalPedido = 0;

        function agregarPlatillo(id, nombre, precio) {
            const index = pedido.findIndex(item => item.id === id);
            if (index !== -1) {
                pedido[index].cantidad += 1;
                pedido[index].total = pedido[index].cantidad * precio;
            } else {
                pedido.push({ id, nombre, precio, cantidad: 1, total: precio });
            }
            actualizarTabla();
        }

        function eliminarPlatillo(id) {
            pedido = pedido.filter(item => item.id !== id);
            actualizarTabla();
        }

        function actualizarTabla() {
            const tablaDetalle = document.getElementById('pedido-detalle');
            tablaDetalle.innerHTML = '';
            totalPedido = 0;

            if (pedido.length === 0) {
                tablaDetalle.innerHTML = `<tr id="no-platillos"><td colspan="5" class="text-center text-muted">No hay platillos en el pedido</td></tr>`;
            } else {
                pedido.forEach(item => {
                    totalPedido += item.total;
                    tablaDetalle.innerHTML += `
                        <tr>
                            <td>${item.cantidad}</td>
                            <td>${item.nombre}</td>
                            <td>S/. ${item.precio.toFixed(2)}</td>
                            <td>S/. ${item.total.toFixed(2)}</td>
                            <td><button class="btn btn-danger btn-sm" onclick="eliminarPlatillo(${item.id})"><i class="fa fa-trash"></i></button></td>
                        </tr>`;
                });
            }

            document.getElementById('pedido-total').innerText = totalPedido.toFixed(2);
        }

        function buscarCliente() {
            const cliente = document.getElementById('buscar-cliente').value;
            if (!cliente) return;

            // Simulación de datos: Reemplaza esto con una solicitud AJAX
            const clientes = @json($clientes);
            const encontrado = clientes.find(c => c.nombre === cliente || c.dni === cliente);

            const clienteDatos = document.getElementById('cliente-datos');
            if (encontrado) {
                clienteDatos.innerHTML = `
                    <p><strong>Nombre:</strong> ${encontrado.nombre}</p>
                    <p><strong>Teléfono:</strong> ${encontrado.telefono}</p>
                    <p><strong>Dirección:</strong> ${encontrado.direccion}</p>`;
            } else {
                clienteDatos.innerHTML = `
                    <h6>Registrar Nuevo Cliente:</h6>
                    <input type="text" class="form-control mb-2" placeholder="Nombre" id="nuevo-cliente-nombre">
                    <input type="text" class="form-control mb-2" placeholder="Teléfono" id="nuevo-cliente-telefono">
                    <input type="text" class="form-control mb-2" placeholder="Dirección" id="nuevo-cliente-direccion">
                `;
            }
        }

        function filtrarPlatillos() {
            const subcategoriaId = document.getElementById('filtro-subcategoria').value;
            const platillos = document.querySelectorAll('.platillo-item');

            platillos.forEach(platillo => {
                if (subcategoriaId === 'all' || platillo.getAttribute('data-subcategoria') === subcategoriaId) {
                    platillo.style.display = 'block';
                } else {
                    platillo.style.display = 'none';
                }
            });
        }
    </script>
@endsection
