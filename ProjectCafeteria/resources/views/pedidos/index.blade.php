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
                @php
                    $pedidosPorVenta = $pedidos->groupBy('venta_id');
                @endphp

                @foreach ($pedidosPorVenta as $venta_id => $pedidosVenta)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Código Venta: {{ $venta_id }}</h3>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    @foreach ($pedidosVenta as $pedido)
                                        <li>
                                            <strong>{{ $pedido->producto->nombre }}</strong>
                                            <span class="float-right">Cantidad: {{ $pedido->cantidad }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card-footer">
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'route' => ['pedidos.destroy', $pedidosVenta->first()->id],
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
