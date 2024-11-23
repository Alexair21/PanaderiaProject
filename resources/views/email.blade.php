<!DOCTYPE html>
<html>
<head>
    <title>Pedido Asignado</title>
</head>
<body>
    <h1>Hola {{ $repartidor->nombre }},</h1>
    <p>Se te ha asignado un nuevo pedido.</p>
    <p><strong>Detalles del Pedido:</strong></p>
    <ul>
        <li><strong>Cliente:</strong> {{ $pedido->nombre }}</li>
        <li><strong>Dirección:</strong> {{ $pedido->direccion }}</li>
        <li><strong>Método de Pago:</strong> {{ $pedido->MetodoPago }}</li>
        <li><strong>Total:</strong> S/. {{ number_format($pedido->detalles->sum('total'), 2) }}</li>
    </ul>
    <p>Por favor, revisa la plataforma para más detalles.</p>
</body>
</html>
