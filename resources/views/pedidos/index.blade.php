@extends('tablar::page')

@section('title', 'Pedidos')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Listado de pedidos
                    </div>
                    <h2 class="page-title">
                        Pedidos registrados
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                @foreach ($pedidos as $pedido)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Pedido #{{ $pedido->id }}</h3>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <li><strong>Cliente:</strong> {{ $pedido->nombre }}</li>
                                    <li><strong>Tipo de Pedido:</strong> {{ $pedido->TipoPedido }}</li>
                                    <li><strong>Dirección:</strong> {{ $pedido->direccion }}</li>
                                    <li><strong>Método de Pago:</strong> {{ $pedido->MetodoPago }}</li>
                                    <li><strong>Fecha:</strong>
                                        {{ \Carbon\Carbon::parse($pedido->FechaPedido)->format('d/m/Y H:i') }}</li>
                                </ul>
                                <hr>
                                <h5>Detalles:</h5>
                                <ul class="list-unstyled">
                                    @foreach ($pedido->detalles as $detalle)
                                        <li>
                                            <strong>{{ $detalle->platillo->nombre ?? 'Platillo no encontrado' }}</strong>
                                            <span class="float-right">Cantidad: {{ $detalle->cantidad }}</span>
                                            <br>
                                            <small>Precio: S/. {{ number_format($detalle->total, 2) }}</small>
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                            <div class="card-footer">
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'route' => ['pedidos.destroy', $pedido->id],
                                    'style' => 'display:inline',
                                ]) !!}
                                {!! Form::submit('Eliminar', ['class' => 'btn btn-sm btn-danger']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
