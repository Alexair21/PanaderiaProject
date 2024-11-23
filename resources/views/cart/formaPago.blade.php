@extends('tablar::page')

@section('title', 'Forma de Pago')

@section('content')
<div class="container-xl">
    <br><br>
    <div class="row">
        <!-- Bloque para Delivery -->
        <div class="col-md-6">
            @can('Acciones-cliente')
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">¿Cómo lo quiere su pedido?</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('session') }}" method="POST">
                        @csrf
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="estadoVariable" id="delivery" value="delivery">
                            <label class="form-check-label" for="delivery">
                                Delivery
                            </label>
                        </div>
                        <div id="deliveryOptions" style="display: none;" class="mt-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="deliveryOption" id="sendHome" value="sendHome">
                                <label class="form-check-label" for="sendHome">
                                    Enviar a casa
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="deliveryOption" id="pickupStore" value="pickupStore">
                                <label class="form-check-label" for="pickupStore">
                                    Recojo en tienda
                                </label>
                            </div>
                        </div>
                        <div id="homeAddressField" class="mt-3" style="display: none;">
                            <label for="address" class="form-label">Dirección de entrega</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Ingrese su dirección">
                        </div>
                        <div id="storeAddressField" class="mt-3" style="display: none;">
                            <label for="storeAddress" class="form-label">Dirección de la tienda</label>
                            <input type="text" class="form-control" id="storeAddress" value="Calle Progreso #1161, Chepén, La Libertad" readonly>
                        </div>
                        <div class="mt-3">
                            <label for="customerName" class="form-label">Nombre del Cliente</label>
                            <input type="text" class="form-control" id="customerName" name="customerName" value="{{ Auth::user()->name }}">
                        </div>
                        <br>
                        <input type="hidden" name="total" value="{{ $total * 100 }}">
                        <input type="hidden" name="description" value="{{ json_encode($cartItems) }}">
                        <button type="submit" id="checkout-live-button" class="btn btn-success">Proceder a pagar</button>
                    </form>
                </div>
            </div>
            @endcan
        </div>

        <!-- Bloque para Mozos -->
        <div class="col-md-6">
            @can('Acciones-barista')
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Métodos de Pago</h3>
                </div>
                <div class="card-body">
                    <!-- Pago en Efectivo -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="orderOption" id="cash" value="cash">
                        <label class="form-check-label" for="cash">
                            Efectivo
                        </label>
                    </div>
                    <div id="cashFields" style="display: none;">
                        <div class="mt-3">
                            <label for="cashGiven" class="form-label">Monto entregado</label>
                            <input type="number" class="form-control" id="cashGiven" placeholder="Ingrese el monto entregado">
                        </div>
                        <div class="mt-3">
                            <label for="change" class="form-label">Vuelto</label>
                            <input type="text" class="form-control" id="change" readonly>
                        </div>
                        <button type="button" class="btn btn-success mt-3" id="confirmCashPaymentButton" disabled>Confirmar Pago</button>
                    </div>

                    <!-- Pago con Tarjeta -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="orderOption" id="card" value="card">
                        <label class="form-check-label" for="card">
                            Tarjeta
                        </label>
                    </div>
                    <form action="{{ route('session') }}" method="POST">
                        @csrf
                        <input type="hidden" name="total" value="{{ $total * 100 }}">
                        <input type="hidden" name="description" value="{{ json_encode($cartItems) }}">
                        <button type="submit" class="btn btn-success mt-3" id="cardPaymentButton" style="display: none;">Proceder a pagar</button>
                    </form>
                </div>
            </div>
            @endcan
        </div>
    </div>

    <!-- Resumen del Carrito -->
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Resumen del Carrito</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                            <tr>
                                <td>
                                    <img src="{{ $item->options->imagen }}" alt="{{ $item->name }}" style="width: 50px; border-radius: 5px;">
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->options->descripcion }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>S/. {{ number_format($item->price, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-end">
                        <p><strong>Subtotal:</strong> S/. {{ number_format($subtotal, 2) }}</p>
                        <p><strong>IGV:</strong> S/. {{ number_format($tax, 2) }}</p>
                        <p><strong>Total:</strong> S/. {{ number_format($total, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const delivery = document.getElementById('delivery');
        const sendHome = document.getElementById('sendHome');
        const pickupStore = document.getElementById('pickupStore');
        const deliveryOptions = document.getElementById('deliveryOptions');
        const homeAddressField = document.getElementById('homeAddressField');
        const storeAddressField = document.getElementById('storeAddressField');
        const cardPaymentButton = document.getElementById('cardPaymentButton');
        const cashFields = document.getElementById('cashFields');
        const cashGivenInput = document.getElementById('cashGiven');
        const changeInput = document.getElementById('change');
        const confirmCashPaymentButton = document.getElementById('confirmCashPaymentButton');

        delivery.addEventListener('change', () => {
            deliveryOptions.style.display = 'block';
        });

        sendHome.addEventListener('change', () => {
            homeAddressField.style.display = 'block';
            storeAddressField.style.display = 'none';
        });

        pickupStore.addEventListener('change', () => {
            storeAddressField.style.display = 'block';
            homeAddressField.style.display = 'none';
        });

        cashGivenInput.addEventListener('input', function() {
            const total = parseFloat({{ $total }});
            const cashGiven = parseFloat(cashGivenInput.value) || 0;
            const change = cashGiven - total;

            if (change < 0) {
                confirmCashPaymentButton.disabled = true;
                changeInput.value = "Monto insuficiente";
            } else {
                confirmCashPaymentButton.disabled = false;
                changeInput.value = change.toFixed(2);
            }
        });

        document.getElementsByName('orderOption').forEach(option => {
            option.addEventListener('change', function() {
                cashFields.style.display = this.value === 'cash' ? 'block' : 'none';
                cardPaymentButton.style.display = this.value === 'card' ? 'block' : 'none';
            });
        });
    });
</script>
@endsection
