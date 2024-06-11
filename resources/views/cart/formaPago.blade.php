@extends('tablar::page')

@section('title', 'Forma de pago')

@section('content')
    <div class="container-xl">
        <br><br>
        <div class="row">
            <!-- Left Column: Order Preference and Payment Methods -->
            <div class="col-md-5">
                @can('Acciones-cliente')
                    <!-- Order Preference Section -->
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
                                <div id="homeAddress" style="display: none;" class="mt-3">
                                    <label for="address" class="form-label">Dirección de entrega</label>
                                    <input type="text" class="form-control" id="address" value="{{ Auth::user()->cliente->direccion }}" readonly>
                                </div>
                                <div id="storePickup" style="display: none;" class="mt-3">
                                    <label for="storeSelect" class="form-label">Seleccione la tienda</label>
                                    <select class="form-select" id="storeSelect">
                                        <option value="tienda1">Starbucks - Av. Prol. César Vallejo 1345, Trujillo</option>
                                        <option value="tienda2">Starbucks - VXX2+363, Mall Aventura Plaza, Av América Oeste, Trujillo</option>
                                    </select>
                                </div>
                                <br>
                                <form action="{{ route('session') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="total" value="{{ $total * 100 }}">
                                    <!-- El total debe estar en céntimos -->
                                    <input type="hidden" name="description" value="{{ json_encode($cartItems) }}">
                                    <input type="hidden" name="estadoVariable" id="estadoVariable" value="">
                                    <button type="submit" id="checkout-live-button" class="btn btn-success">Proceder a pagar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endcan

                @can('Acciones-barista')
                    <!-- Payment Methods Section -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Métodos de Pago</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="cash" value="2">
                                <label class="form-check-label" for="cash">
                                    Efectivo
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="card" value="3">
                                <label class="form-check-label" for="card">
                                    Tarjeta
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
                                <div id="insufficientAmountWarning" class="alert alert-danger mt-3" style="display: none;">
                                    El monto entregado no es suficiente.
                                </div>
                                <div class="mt-3">
                                    <form action="{{ route('confirmarPagoEfectivo') }}" method="POST" id="cashPaymentForm">
                                        @csrf
                                        <input type="hidden" name="total" value="{{ $total * 100 }}">
                                        <input type="hidden" name="description" value="{{ json_encode($cartItems) }}">
                                        <input type="hidden" name="estadoVariable" id="estadoVariable-cash" value="2">
                                        <button type="submit" class="btn btn-success" id="confirmCashPaymentButton" disabled>Confirmar Pago</button>
                                    </form>
                                </div>
                            </div>

                            <div id="cardFields" style="display: none;">
                                <form action="{{ route('session') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="total" value="{{ $total * 100 }}">
                                    <!-- El total debe estar en céntimos -->
                                    <input type="hidden" name="description" value="{{ json_encode($cartItems) }}">
                                    <input type="hidden" name="estadoVariable" id="estadoVariable-card" value="3">
                                    <button type="submit" id="checkout-live-button" class="btn btn-success">Proceder a pagar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>

            <!-- Right Column: Cart Summary -->
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
            const cashRadio = document.getElementById('cash');
            const cardRadio = document.getElementById('card');
            const cashFields = document.getElementById('cashFields');
            const cardFields = document.getElementById('cardFields');
            const cardButton = document.getElementById('checkout-live-button');
            const cashGivenInput = document.getElementById('cashGiven');
            const changeInput = document.getElementById('change');
            const totalAmount = {{ $total }};
            const detailsInput = document.getElementById('details');
            const estadoVariableInput = document.getElementById('estadoVariable');
            const estadoVariableDisplay = document.getElementById('estadoVariableDisplay');
            const confirmCashPaymentButton = document.getElementById('confirmCashPaymentButton');
            const insufficientAmountWarning = document.getElementById('insufficientAmountWarning');

            const deliveryRadio = document.getElementById('delivery');
            const deliveryOptions = document.getElementById('deliveryOptions');
            const sendHomeRadio = document.getElementById('sendHome');
            const pickupStoreRadio = document.getElementById('pickupStore');
            const homeAddress = document.getElementById('homeAddress');
            const storePickup = document.getElementById('storePickup');

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

            function updateEstadoVariable(value) {
                estadoVariableInput.value = value;
                estadoVariableDisplay.value = value;
            }

            cashRadio.addEventListener('change', function() {
                if (this.checked) {
                    cashFields.style.display = 'block';
                    cardFields.style.display = 'none';
                    cardButton.style.display = 'none'; // Oculta el botón cuando se selecciona efectivo
                    updateEstadoVariable('2');
                }
            });

            cardRadio.addEventListener('change', function() {
                if (this.checked) {
                    cashFields.style.display = 'none';
                    cardFields.style.display = 'block';
                    cardButton.style.display = 'block'; // Muestra el botón cuando se selecciona tarjeta
                    updateEstadoVariable('3');
                }
            });

            cashGivenInput.addEventListener('input', updateChange);

            deliveryRadio.addEventListener('change', function() {
                if (this.checked) {
                    deliveryOptions.style.display = 'block';
                    updateEstadoVariable('1');
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

            // Crear descripción para voucher
            function createDescription() {
                const cartItems = @json($cartItems);
                let description = cartItems.map(item =>
                    `${item.name} (${item.options.descripcion}), Cantidad: ${item.qty}`).join('; ');
                if (!description) {
                    description = 'Tamaño base';
                }
                detailsInput.value = description;
            }

            // Crear descripción al cargar la página
            createDescription();
        });
    </script>
@endsection
