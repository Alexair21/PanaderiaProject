@extends('tablar::page')

@section('title', 'Resumen compra')


@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Resumen de la Compra</h3>
            </div>
            <div class="card-body">
                <center>
                    @can('Acciones-cliente')
                        <div class="descripcion p-2 text-center p-2">
                            <p><strong>Su pedido esta siendo enviado a: {{ Auth::user()->cliente->direccion }}</strong></p>
                        </div><br>
                    @endcan
                    <div class="descripcion p-2 text-center p-2">
                        <p><strong>Su pedido está en proceso</strong></p>
                    </div><br>
                </center>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>SubTotal</th>
                            <th>Igv</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                            <tr>
                                <td>
                                    <img src="{{ $item['options']['imagen'] }}" alt="{{ $item['name'] }}" style="width: 80px;">
                                </td>

                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['options']['descripcion'] }}</td>
                                <td>{{ $item['qty'] }}</td>
                                <td>S/. {{ number_format($item['price'], 2) }}</td>
                                <td>S/. {{ number_format($item['price'] * $item['qty'], 2) }}</td>
                                <td>S/. {{ number_format($item['price'] * $item['qty'] * 0.18, 2) }}</td>
                                <td>S/. {{ number_format($item['price'] * $item['qty'] * 1.18, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-end">
                    <p><strong>Total:</strong> S/. {{ number_format($total, 2) }}</p>
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