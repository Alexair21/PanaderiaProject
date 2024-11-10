@extends('tablar::page')

@section('title', 'Forma de pago')

@section('content')
    <div class="container-xl">
        <br><br>
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Métodos de Pago</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="cash" value="2">
                            <label class="form-check-label" for="cash">
                                Efectivo
                            </label>
                        </div>
                        <div id="cashFields">
                            <div class="mt-3">
                                <label for="customerNameCash" class="form-label">Nombre del Cliente</label>
                                <input type="text" class="form-control" id="customerNameCash" name="customerNameCash"
                                    value="{{ $venta->cliente_nombre }}" disabled>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mt-3">
                                        <label for="cashGiven" class="form-label">Monto entregado</label>
                                        <input type="number" class="form-control" id="cashGiven"
                                            placeholder="Ingrese el monto entregado" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mt-3">
                                        <label for="change" class="form-label">Vuelto</label>
                                        <input type="text" class="form-control" id="change" readonly>
                                    </div>
                                </div>
                            </div>
                            <div id="insufficientAmountWarning" class="alert alert-danger mt-3" style="display: none;">
                                El monto entregado no es suficiente.
                            </div>
                            <div class="mt-3">
                                <form action="{{ route('confirmarPagoEfectivo') }}" method="POST" id="cashPaymentForm">
                                    @csrf
                                    <input type="hidden" name="total" value="{{ $total * 100 }}">
                                    <input type="hidden" name="description" value="{{ json_encode($pedidos) }}">
                                    <input type="hidden" name="estadoVariable" id="estadoVariable-cash" value="2">
                                    <input type="hidden" name="customerNameHiddenCash" id="customerNameHiddenCash"
                                        value="{{ $venta->cliente_nombre }}">
                                    <button type="submit" class="btn btn-success" id="confirmCashPaymentButton"
                                        disabled>Confirmar Pago</button>
                                </form>
                            </div>
                        </div>
                        <hr>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="card"
                                value="3">
                            <label class="form-check-label" for="card">
                                Tarjeta
                            </label>
                        </div>
                        <div id="cardFields">
                            <form action="{{ route('session') }}" method="POST">
                                @csrf
                                <div class="mt-3">
                                    <label for="customerNameCard" class="form-label">Nombre del Cliente</label>
                                    <input type="text" class="form-control" id="customerNameCard" name="customerNameCard"
                                        value="{{ $venta->cliente_nombre }}" disabled>
                                </div>
                                <input type="hidden" name="total" value="{{ $total * 100 }}">
                                <input type="hidden" name="description" value="{{ json_encode($pedidos) }}">
                                <input type="hidden" name="estadoVariable" id="estadoVariable-card" value="3">
                                <input type="hidden" name="customerNameHiddenCard" id="customerNameHiddenCard"
                                    value="{{ $venta->cliente_nombre }}">
                                <input type="hidden" name="venta_id" value="{{ $venta->id }}">
                                <!-- Este es el ID de la venta -->
                                <button type="submit" id="checkout-live-button" class="btn btn-success">Proceder a
                                    pagar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Resumen del Pedido</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pedidos as $pedido)
                                    <tr>
                                        <td>
                                            <img src="{{ $pedido->producto->imagen }}"
                                                alt="{{ $pedido->producto->nombre }}" style="width: 50px;">
                                        </td>
                                        <td>{{ $pedido->producto->nombre }}</td>
                                        <td>{{ $pedido->cantidad }}</td>
                                        <td>S/. {{ number_format($pedido->precio_unitario, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-end">
                            <p><strong>Subtotal:</strong> S/. {{ number_format($subtotal, 2) }}</p>
                            <p><strong>IGV:</strong> S/. {{ number_format($tax, 2) }}</p>
                            <p style="background-color: #00362f; color: #f9f9f9;"><strong>Total:</strong> S/.
                                {{ number_format($total, 2) }}</p>
                        </div>
                    </div>
                </div>
                <input hidden type="text" class="form-control" id="estadoVariableDisplay" readonly>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cashRadio = document.getElementById('cash');
            const cardRadio = document.getElementById('card');
            const cashFields = document.getElementById('cashFields');
            const cardFields = document.getElementById('cardFields');
            const customerNameCashInput = document.getElementById('customerNameCash');
            const cashGivenInput = document.getElementById('cashGiven');
            const confirmCashPaymentButton = document.getElementById('confirmCashPaymentButton');
            const customerNameCardInput = document.getElementById('customerNameCard');
            const checkoutLiveButton = document.getElementById('checkout-live-button');
            const insufficientAmountWarning = document.getElementById('insufficientAmountWarning');
            const totalAmount = {{ $total }};
            const changeInput = document.getElementById('change');

            function updateChange() {
                const cashGiven = parseFloat(cashGivenInput.value) || 0;
                const change = cashGiven - totalAmount;
                changeInput.value = change >= 0 ? `S/. ${change.toFixed(2)}` : 'Monto insuficiente';

                if (change < 0) {
                    confirmCashPaymentButton.disabled = true;
                    insufficientAmountWarning.style.display = 'block';
                } else {
                    confirmCashPaymentButton.disabled = false;
                    insufficientAmountWarning.style.display = 'none';
                }
            }

            cashRadio.addEventListener('change', function() {
                if (this.checked) {
                    customerNameCashInput.disabled = false;
                    cashGivenInput.disabled = false;
                    confirmCashPaymentButton.disabled = false;
                    customerNameCardInput.disabled = true;
                    checkoutLiveButton.disabled = true;
                    updateChange();
                }
            });

            cardRadio.addEventListener('change', function() {
                if (this.checked) {
                    customerNameCardInput.disabled = false;
                    checkoutLiveButton.disabled = false;
                    customerNameCashInput.disabled = true;
                    cashGivenInput.disabled = true;
                    confirmCashPaymentButton.disabled = true;
                    insufficientAmountWarning.style.display = 'none';
                }
            });

            cashGivenInput.addEventListener('input', updateChange);

            customerNameCashInput.addEventListener('input', function() {
                document.getElementById('customerNameHiddenCash').value = customerNameCashInput.value;
            });

            customerNameCardInput.addEventListener('input', function() {
                document.getElementById('customerNameHiddenCard').value = customerNameCardInput.value;
            });
        });
    </script>
@endsection
