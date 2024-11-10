@extends('tablar::page')

@section('title', 'Forma de pago')

@section('content')
    <div class="container-xl">
        <br><br>
        <div class="row">
            <div class="col-md-5">
                @can('Acciones-cliente')
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">¿Cómo lo quiere su pedido?</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="orderPreference" id="delivery" value="1">
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
                                <div id="customerNameField" class="mt-3">
                                    <label for="customerName" class="form-label">Nombre del Cliente</label>
                                    <input type="text" class="form-control" id="customerName" name="customerName" placeholder="Ingrese su nombre" disabled>
                                </div>
                                <div id="homeAddress" class="mt-3">
                                    <label for="address" class="form-label">Dirección de entrega</label>
                                    <input type="text" class="form-control" id="address" value="{{ Auth::user()->cliente->direccion }}" readonly>
                                </div>
                                <div id="storePickup" class="mt-3">
                                    <label for="storeSelect" class="form-label">Seleccione la tienda</label>
                                    <select class="form-select" id="storeSelect" disabled>
                                        <option value="tienda1">Starbucks - Av. Prol. César Vallejo 1345, Trujillo</option>
                                        <option value="tienda2">Starbucks - VXX2+363, Mall Aventura Plaza, Av América Oeste, Trujillo</option>
                                    </select>
                                </div>
                                <br>
                                <form action="{{ route('session') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="total" value="{{ $total * 100 }}">
                                    <input type="hidden" name="description" value="{{ json_encode($cartItems) }}">
                                    <input type="hidden" name="estadoVariable" id="estadoVariable" value="">
                                    <input type="hidden" name="customerNameHidden" id="customerNameHidden" value="">
                                    <button type="submit" id="checkout-live-button" class="btn btn-success">Proceder a pagar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endcan

                @can('Acciones-barista')
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
                                    <input type="text" class="form-control" id="customerNameCash" name="customerNameCash" placeholder="Ingrese su nombre" disabled>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mt-3">
                                            <label for="cashGiven" class="form-label">Monto entregado</label>
                                            <input type="number" class="form-control" id="cashGiven" placeholder="Ingrese el monto entregado" disabled>
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
                                        <input type="hidden" name="description" value="{{ json_encode($cartItems) }}">
                                        <input type="hidden" name="estadoVariable" id="estadoVariable-cash" value="2">
                                        <input type="hidden" name="customerNameHiddenCash" id="customerNameHiddenCash" value="">
                                        <button type="submit" class="btn btn-success" id="confirmCashPaymentButton" disabled>Confirmar Pago</button>
                                    </form>
                                </div>
                            </div>
                            <hr>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="card" value="3">
                                <label class="form-check-label" for="card">
                                    Tarjeta
                                </label>
                            </div>
                            <div id="cardFields">
                                <form action="{{ route('session') }}" method="POST">
                                    @csrf
                                    <div class="mt-3">
                                        <label for="customerNameCard" class="form-label">Nombre del Cliente</label>
                                        <input type="text" class="form-control" id="customerNameCard" name="customerNameCard" placeholder="Ingrese su nombre" disabled>
                                    </div>
                                    <input type="hidden" name="total" value="{{ $total * 100 }}">
                                    <input type="hidden" name="description" value="{{ json_encode($cartItems) }}">
                                    <input type="hidden" name="estadoVariable" id="estadoVariable" value="">
                                    <input type="hidden" name="customerNameHidden" id="customerNameHidden" value="">
                                    <button type="submit" id="checkout-live-button" class="btn btn-success" disabled>Proceder a pagar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
            <div class="col-md-7">
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
                                    <th>Descripcion</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                    <tr>
                                        <td>
                                            <img src="{{ $item->options->imagen }}" alt="{{ $item->name }}" style="width: 50px;">
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
                            <p style="background-color: #00362f; color: #f9f9f9;"><strong>Total:</strong> S/. {{ number_format($total, 2) }}</p>
                        </div>
                    </div>
                </div>
                <input hidden type="text" class="form-control" id="estadoVariableDisplay" readonly>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deliveryRadio = document.getElementById('delivery');
            const deliveryOptions = document.getElementById('deliveryOptions');
            const sendHomeRadio = document.getElementById('sendHome');
            const pickupStoreRadio = document.getElementById('pickupStore');
            const homeAddress = document.getElementById('homeAddress');
            const storePickup = document.getElementById('storePickup');
            const customerNameInput = document.getElementById('customerName');
            const customerNameHiddenInput = document.getElementById('customerNameHidden');
            const estadoVariableInput = document.getElementById('estadoVariable');
            const checkoutLiveButton = document.getElementById('checkout-live-button');

            deliveryRadio.addEventListener('change', function() {
                if (this.checked) {
                    deliveryOptions.style.display = 'block';
                    customerNameInput.disabled = false;
                    estadoVariableInput.value = '1'; // Set estadoVariable to 'Delivery'
                } else {
                    deliveryOptions.style.display = 'none';
                    customerNameInput.disabled = true;
                }
            });

            sendHomeRadio.addEventListener('change', function() {
                if (this.checked) {
                    homeAddress.style.display = 'block';
                    storePickup.style.display = 'none';
                }
            });

            pickupStoreRadio.addEventListener('change', function() {
                if (this.checked) {
                    homeAddress.style.display = 'none';
                    storePickup.style.display = 'block';
                }
            });

            customerNameInput.addEventListener('input', function() {
                customerNameHiddenInput.value = customerNameInput.value;
            });

            checkoutLiveButton.addEventListener('click', function() {
                if (deliveryRadio.checked) {
                    estadoVariableInput.value = '1'; // Delivery
                } else if (document.getElementById('cash').checked) {
                    estadoVariableInput.value = '2'; // Efectivo
                } else if (document.getElementById('card').checked) {
                    estadoVariableInput.value = '3'; // Tarjeta
                }
            });
        });
    </script>
@endsection
