<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voucher</title>
    <style>
        body {
            font-family: sans-serif;
        }
        .container {
            width: 50%;
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #00362f;
            border-radius: 10px;
            box-sizing: border-box;
        }
        .header, .footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2, .footer p {
            margin: 0;
        }
        .details {
            margin-bottom: 20px;
        }
        .details p {
            margin: 2px 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border-bottom: 1px solid #00362f;
            padding: 5px;
            text-align: left;
        }
        .total {
            text-align: right;
            margin-top: 10px;
        }
        .qr-code {
            text-align: center;
            margin-top: 20px;
        }
        .qr-code img {
            width: 100px;
            height: 100px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Cabecera -->
        <div class="header">
            <h2>La Gota de Café</h2>
            <p>Calle 123, Ciudad</p>
            <p>Tel: (555) 555-5555</p>
        </div>

        <!-- Detalles del Pedido -->
        <div class="details">
            <p><strong>Fecha:</strong> {{ date('d/m/Y H:i') }}</p>
            <p><strong>Cliente:</strong> {{ $pedido->nombre }}</p>
            <p><strong>Pedido #:</strong> {{ $pedido->id }}</p>
            <p><strong>Dirección:</strong> {{ $pedido->direccion }}</p>
            <p><strong>Código del Voucher:</strong> {{ $voucher->codigo }}</p>
        </div>

        <!-- Tabla de Detalles -->
        <table class="table">
            <thead>
                <tr>
                    <th>Artículo</th>
                    <th>Cant.</th>
                    <th>P. Unit.</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedido->detalles as $detalle)
                    <tr>
                        <td>{{ $detalle->platillo->nombre }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>S/. {{ number_format($detalle->platillo->precio, 2) }}</td>
                        <td>S/. {{ number_format($detalle->cantidad * $detalle->platillo->precio, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totales -->
        <div class="total">
            <p><strong>Subtotal:</strong> S/. {{ number_format($subtotal, 2) }}</p>
            <p><strong>IGV (18%):</strong> S/. {{ number_format($subtotal * 0.18, 2) }}</p>
            <p><strong>Total con IGV:</strong> S/. {{ number_format($total, 2) }}</p>
        </div>

        <!-- QR Code -->
        <div class="qr-code">
            <p>Escanea el código QR para más información:</p>
            <img src="data:image/svg+xml;base64,{{ $qrCode }}" alt="QR Code">
        </div>

        <!-- Pie de Página -->
        <div class="footer">
            <p>Gracias por su compra</p>
            <p>www.lagotadecafe.com</p>
            <p>{{ date('d/m/Y H:i') }}</p>
        </div>
    </div>
</body>
</html>
