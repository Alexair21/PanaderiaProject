@extends('tablar::page')

@section('title', 'Resumen de Compra')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Resumen de la Compra</h3>
            </div>
            <div class="card-body">
                <center>
                    @can('Acciones-cliente')
                        <div class="descripcion p-2 text-center">
                            <p><strong>Su pedido está siendo enviado a: {{ $pedido->direccion }}</strong></p>
                        </div><br>
                    @endcan
                    @can('Acciones-cajero')
                        <div class="descripcion p-2 text-center">
                            <p><strong>Su pedido está en proceso</strong></p>
                        </div><br>
                    @endcan
                </center>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>SubTotal</th>
                            <th>IGV</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedido->detalles as $detalle)
                            <tr>
                                <td>
                                    <img src="{{ $detalle->platillo->imagen }}" alt="{{ $detalle->platillo->nombre }}"
                                        style="width: 80px;">
                                </td>
                                <td>{{ $detalle->platillo->nombre }}</td>
                                <td>{{ $detalle->cantidad }}</td>
                                <td>S/. {{ number_format($detalle->platillo->precio, 2) }}</td>
                                <td>S/. {{ number_format($detalle->platillo->precio * $detalle->cantidad, 2) }}</td>
                                <td>S/. {{ number_format($detalle->platillo->precio * $detalle->cantidad * 0.18, 2) }}</td>
                                <td>S/. {{ number_format($detalle->platillo->precio * $detalle->cantidad * 1.18, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-end">
                    <p><strong>Total:</strong> S/. {{ number_format($pedido->detalles->sum(fn($detalle) => $detalle->platillo->precio * $detalle->cantidad * 1.18), 2) }}</p>
                </div>
                <div class="mt-3">
                    <a href="{{ route('vouchers.generate', $voucher->id) }}" class="btn btn-primary">Imprimir Voucher</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .descripcion {
            background-color: #00362f;
            color: #ffffff;
            padding: 1rem;
            border-radius: 0.25rem;
            margin-top: 1rem;
            text-align: center;
        }

        p {
            color: #ffffff;
            font-size: 1rem;
            font-family: sans-serif;
        }

        .descripcion {
            width: 950px;
        }
    </style>
@endsection
