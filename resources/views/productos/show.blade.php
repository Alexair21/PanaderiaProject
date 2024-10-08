@extends('tablar::page')

@section('title', 'Detalle del producto')

@section('content')
    <div class="container">
        <div class="p-4 row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-flex flex-column align-items-center">
                                <br><br>
                                <div class="descripcion p-2 text-center p-3">
                                    <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}" class="img-fluid mb-3">
                                    <h1 class="text-center">{{ $producto->nombre }}</h1>
                                    <p>{{ $producto->descripcion }}</p>
                                </div><br><br>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    @include('partials.msg')
                                    <h2>Precio: S/. <span id="precio">{{ $producto->precio }}</span></h2>
                                    <form action="{{ route('add') }}" method="POST">
                                        @csrf

                                        <input type="hidden" name="id" value="{{ $producto->id }}">

                                        <div class="mb-3">
                                            {!! Form::label('precios', 'Elige tamaño:', ['class' => 'form-label']) !!}
                                            <div>
                                                <div class="form-check">
                                                    {!! Form::radio('precio_seleccionado', 'base', true, ['class' => 'form-check-input', 'id' => 'precio_base']) !!}
                                                    {!! Form::label('precio_base', 'Precio base - S/ ' . $producto->precio, ['class' => 'form-check-label']) !!}
                                                </div>
                                                @forelse($producto->precios as $precio)
                                                    <div class="form-check">
                                                        {!! Form::radio('precio_seleccionado', $precio->id, null, [
                                                            'class' => 'form-check-input',
                                                            'id' => 'precio_' . $precio->id,
                                                            'data-precio' => $precio->precio,
                                                        ]) !!}
                                                        {!! Form::label('precio_' . $precio->id, $precio->nombre . ' - S/ ' . $precio->precio, [
                                                            'class' => 'form-check-label',
                                                        ]) !!}
                                                    </div>
                                                @empty
                                                    <p>No hay precios disponibles para este producto.</p>
                                                @endforelse
                                            </div>
                                        </div>

                                        @if ($producto->precios->isNotEmpty())
                                            <div class="mb-3">
                                                <label class="form-label">¿Deseas crema batida en tu bebida?</label>
                                                <div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="Si"
                                                            id="crema_si" name="cream">
                                                        <label class="form-check-label" for="crema_si">Sí</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="No"
                                                            id="crema_no" name="cream">
                                                        <label class="form-check-label" for="crema_no">No</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="extras" class="form-label">¿Deseas agregar algún jarabe?</label>
                                                <select class="form-select" id="extras" name="extras[]" multiple>
                                                    <option value="Chocolate">Chocolate</option>
                                                    <option value="Caramelo">Caramelo</option>
                                                    <option value="Vainilla">Vainilla</option>
                                                </select>
                                            </div>
                                        @endif

                                        <div class="mb-3 d-flex align-items-center">
                                            <button type="button" class="btn btn-outline-secondary me-3"
                                                id="decrement">-</button>
                                            <input type="number" name="quantity" id="quantity" value="1"
                                                min="1" class="form-control"
                                                style="width: 60px; text-align: center;">
                                            <button type="button" class="btn btn-outline-secondary ms-3"
                                                id="increment">+</button>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Agregar al carrito</button>
                                        <a href="{{ route('catalogos.index') }}" class="btn btn-success">Ir a Menú</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/producto.css">
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let precioBase = {{ $producto->precio }};
            const quantityInput = document.getElementById('quantity');
            const precioSpan = document.getElementById('precio');
            const radios = document.querySelectorAll('input[name="precio_seleccionado"]');
            const descripcionInput = document.createElement('input');
            descripcionInput.type = 'hidden';
            descripcionInput.name = 'descripcion';
            document.querySelector('form').appendChild(descripcionInput);

            radios.forEach(function(radio) {
                radio.addEventListener('change', function() {
                    if (radio.value !== 'base') {
                        precioBase = parseFloat(radio.dataset.precio);
                    } else {
                        precioBase = {{ $producto->precio }};
                    }
                    actualizarDescripcion();
                    actualizarPrecio();
                });
            });

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

            document.querySelectorAll('input[name="cream"]').forEach(function(creamRadio) {
                creamRadio.addEventListener('change', actualizarDescripcion);
            });

            document.getElementById('extras').addEventListener('change', actualizarDescripcion);

            function actualizarDescripcion() {
                const tamaño = document.querySelector('input[name="precio_seleccionado"]:checked').dataset
                    .descripcion;
                const cream = document.querySelector('input[name="cream"]:checked') ? document.querySelector(
                    'input[name="cream"]:checked').value : 'No';
                const extras = Array.from(document.getElementById('extras').selectedOptions).map(option => option
                    .value).join(', ');

                let descripcion = tamaño;
                descripcion += `, Crema: ${cream}`;
                if (extras) {
                    descripcion += `, Extras: ${extras}`;
                }

                descripcionInput.value = descripcion;
            }

            function actualizarPrecio() {
                const cantidad = parseInt(quantityInput.value);
                const precioTotal = precioBase * cantidad;
                precioSpan.textContent = precioTotal.toFixed(2);
            }

            actualizarDescripcion(); // Set initial description
        });
    </script>
@stop
