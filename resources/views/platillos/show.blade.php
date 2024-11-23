@extends('tablar::page')

@section('title', 'Detalle del Platillo')

@section('content')

    <!-- Botón de WhatsApp -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <a href="https://api.whatsapp.com/send?phone=51947810132&text={{ urlencode($mensajeWhatsapp) }}" class="float">
        <i class="fa fa-whatsapp my-float"></i>
    </a>

    <div class="container mt-5">
        <!-- Notificación de éxito -->
        @if (session('success'))
            <div id="notification" class="notification">
                <i class="fa fa-check-circle"></i> <!-- Ícono de éxito -->
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-lg p-5" style="border-radius: 15px; background-color: #ffffff;">
            <div class="row">
                <!-- Imagen del platillo -->
                <div class="col-md-6 d-flex justify-content-center">
                    <img src="{{ asset($platillo->imagen) }}" class="img-fluid rounded custom-image"
                        alt="{{ $platillo->nombre }}">
                </div>

                <!-- Detalles del platillo -->
                <div class="col-md-6 d-flex flex-column justify-content-center">
                    <h2 class="font-weight-bold text-uppercase" style="color: #E4C590; font-size: 2.5rem;">
                        {{ $platillo->nombre }}</h2>
                    <h5 class="text-muted mb-4">{{ $platillo->categoria->nombre }}</h5>
                    <p style="font-size: 1.1rem; color: #333;"><strong>Descripción:</strong> {{ $platillo->descripcion }}
                    </p>

                    <!-- Formulario de agregar al carrito -->
                    <form action="{{ route('add') }}" method="POST">
                        @csrf

                        <input type="hidden" name="id" value="{{ $platillo->id }}">

                        <!-- Observaciones -->
                        <div class="form-group mt-4">
                            <label for="observaciones" class="font-weight-bold" style="font-size: 1.1rem;">Observaciones del
                                producto</label>
                            <input type="text" id="observaciones" name="observaciones" class="form-control"
                                placeholder="Especifica tus preferencias" maxlength="30" style="font-size: 1rem;">
                            <small class="text-muted">Máximo 30 caracteres</small>
                        </div>

                        <!-- Precio total -->
                        <div class="mt-4">
                            <h4 class="font-weight-bold" style="font-size: 2rem; color: #E4C590;">S/. <span
                                    id="precio">{{ number_format($platillo->precio, 2) }}</span></h4>
                        </div>

                        <!-- Cantidad -->
                        <div class="form-group mt-4">
                            <label class="font-weight-bold" style="font-size: 1.1rem;">Cantidad</label>
                            <div class="input-group" style="width: 140px;">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-outline-secondary" id="decrement"
                                        style="color:black">-</button>
                                </div>
                                <input type="number" name="quantity" id="quantity" value="1" min="1"
                                    class="form-control text-center">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary" id="increment"
                                        style="color:black">+</button>
                                </div>
                            </div>
                        </div>

                        <!-- Botones de agregar al carrito y volver al menú -->
                        <div class="d-flex mt-4">
                            <a href="{{ route('catalogos.index') }}" class="btn btn-link text-dark mr-3"
                                style="font-size: 1.1rem;">
                                Atrás
                            </a>
                            <button type="submit" class="btn font-weight-bold d-flex align-items-center"
                                style="background-color: #E4C590; border-color: #E4C590; color: white; font-size: 1rem; padding: 10px 20px;">
                                AGREGAR AL CARRITO
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        /* Botón de WhatsApp */
        .float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            left: 40px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
        }

        .float:hover {
            text-decoration: none;
            color: #25d366;
            background-color: #fff;
        }

        .my-float {
            margin-top: 16px;
        }

        /* Imagen del platillo */
        .custom-image {
            width: 450px;
            height: 450px;
            object-fit: cover;
            border-radius: 15px;
        }

        /* Botón de cantidad */
        .input-group-prepend .btn,
        .input-group-append .btn {
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
            font-weight: bold;
        }

        /* Notificación de éxito */
        .notification {
            position: fixed;
            bottom: 20px; /* Parte inferior */
            right: 20px; /* Esquina derecha */
            background-color: #4CAF50; /* Verde para éxito */
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            font-size: 1rem;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: fade-in-out 5s ease-in-out;
        }

        /* Icono de notificación */
        .notification i {
            font-size: 1.5rem;
        }

        /* Animación de notificación */
        @keyframes fade-in-out {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            10%, 90% {
                opacity: 1;
                transform: translateY(0);
            }
            100% {
                opacity: 0;
                transform: translateY(20px);
            }
        }
    </style>
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let precioBase = {{ $platillo->precio }};
            const quantityInput = document.getElementById('quantity');
            const precioSpan = document.getElementById('precio');

            document.getElementById('increment').addEventListener('click', function() {
                quantityInput.value = parseInt(quantityInput.value) + 1;
                actualizarPrecio();
            });

            document.getElementById('decrement').addEventListener('click', function() {
                if (quantityInput.value > 1) {
                    quantityInput.value = parseInt(quantityInput.value) - 1;
                    actualizarPrecio();
                }
            });

            function actualizarPrecio() {
                const cantidad = parseInt(quantityInput.value);
                const precioTotal = precioBase * cantidad;
                precioSpan.textContent = precioTotal.toFixed(2);
            }

            const notification = document.getElementById('notification');
            if (notification) {
                setTimeout(() => {
                    notification.remove();
                }, 5000); // Se oculta después de 5 segundos
            }
        });
    </script>
@stop
