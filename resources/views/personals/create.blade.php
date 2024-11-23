@extends('tablar::page')

@section('title', 'Crear Personal')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Crear un nuevo Personal</h1>
                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-dark" role="alert">
                                        <strong>¡Revise los campos!</strong>
                                        @foreach ($errors->all() as $error)
                                            <span class="badge badge-danger">{{ $error }}</span>
                                        @endforeach
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                {!! Form::open(['route' => 'personal.store', 'method' => 'POST']) !!}

                                <!-- Nombre y Email en la misma fila -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        {!! Form::label('nombre', 'Nombre', ['class' => 'form-label']) !!}
                                        {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre completo']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::label('email', 'Correo Electrónico', ['class' => 'form-label']) !!}
                                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el correo electrónico']) !!}
                                    </div>
                                </div>

                                <!-- Teléfono y Dirección en la misma fila -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        {!! Form::label('telefono', 'Teléfono', ['class' => 'form-label']) !!}
                                        {!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el teléfono']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::label('direccion', 'Dirección', ['class' => 'form-label']) !!}
                                        {!! Form::text('direccion', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la dirección']) !!}
                                    </div>
                                </div>

                                <!-- DNI y Cargo en la misma fila -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        {!! Form::label('dni', 'DNI', ['class' => 'form-label']) !!}
                                        {!! Form::text('dni', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el número de DNI']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::label('cargo', 'Cargo', ['class' => 'form-label']) !!}
                                        {!! Form::select('cargo', ['mozo' => 'Mozo', 'repartidor' => 'Repartidor', 'otro' => 'Otro'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione un cargo', 'id' => 'cargo']) !!}
                                    </div>
                                </div>

                                <!-- Campos adicionales: Licencia y Vehículo -->
                                <div id="repartidorFields" style="display: none;">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            {!! Form::label('licencia', 'Licencia', ['class' => 'form-label']) !!}
                                            {!! Form::text('licencia', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el número de licencia']) !!}
                                        </div>
                                        <div class="col-md-6">
                                            {!! Form::label('vehiculo', 'Vehículo', ['class' => 'form-label']) !!}
                                            {!! Form::text('vehiculo', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el tipo de vehículo']) !!}
                                        </div>
                                    </div>
                                </div>

                                <!-- Fecha de Contrato y Sueldo en la misma fila -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        {!! Form::label('fecha_contrato', 'Fecha de Contrato', ['class' => 'form-label']) !!}
                                        {!! Form::date('fecha_contrato', null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::label('sueldo', 'Sueldo', ['class' => 'form-label']) !!}
                                        {!! Form::number('sueldo', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el sueldo', 'step' => '0.01']) !!}
                                    </div>
                                </div>

                                <!-- Botón de guardar -->
                                <div class="text-center">
                                    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para habilitar campos dinámicamente -->
    <script>
        document.getElementById('cargo').addEventListener('change', function () {
            const repartidorFields = document.getElementById('repartidorFields');
            if (this.value === 'repartidor') {
                repartidorFields.style.display = 'block';
            } else {
                repartidorFields.style.display = 'none';
            }
        });
    </script>
@endsection
