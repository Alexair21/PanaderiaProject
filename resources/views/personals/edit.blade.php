@extends('tablar::page')

@section('title', 'Editar Personal')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Editar Personal</h1>
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

                                {!! Form::model($personal, ['route' => ['personal.update', $personal->id], 'method' => 'PUT']) !!}

                                <!-- Nombre y Email -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        {!! Form::label('nombre', 'Nombre', ['class' => 'form-label']) !!}
                                        {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::label('email', 'Correo Electrónico', ['class' => 'form-label']) !!}
                                        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Correo']) !!}
                                    </div>
                                </div>

                                <!-- Teléfono y Dirección -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        {!! Form::label('telefono', 'Teléfono', ['class' => 'form-label']) !!}
                                        {!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'Teléfono']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::label('direccion', 'Dirección', ['class' => 'form-label']) !!}
                                        {!! Form::text('direccion', null, ['class' => 'form-control', 'placeholder' => 'Dirección']) !!}
                                    </div>
                                </div>

                                <!-- DNI y Cargo -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        {!! Form::label('dni', 'DNI', ['class' => 'form-label']) !!}
                                        {!! Form::text('dni', null, ['class' => 'form-control', 'placeholder' => 'DNI']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::label('cargo', 'Cargo', ['class' => 'form-label']) !!}
                                        {!! Form::select('cargo', ['mozo' => 'Mozo', 'repartidor' => 'Repartidor', 'otro' => 'Otro'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione un cargo', 'id' => 'cargo']) !!}
                                    </div>
                                </div>

                                <!-- Licencia y Vehículo (solo si cargo es Repartidor) -->
                                <div id="repartidorFields" style="display: {{ $personal->cargo === 'repartidor' ? 'block' : 'none' }};">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            {!! Form::label('licencia', 'Licencia', ['class' => 'form-label']) !!}
                                            {!! Form::text('licencia', $personal->licencia ?? null, ['class' => 'form-control', 'placeholder' => 'Licencia de conducir']) !!}
                                        </div>
                                        <div class="col-md-6">
                                            {!! Form::label('vehiculo', 'Vehículo', ['class' => 'form-label']) !!}
                                            {!! Form::text('vehiculo', $personal->vehiculo ?? null, ['class' => 'form-control', 'placeholder' => 'Vehículo asignado']) !!}
                                        </div>
                                    </div>
                                </div>

                                <!-- Fecha de Contrato y Sueldo -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        {!! Form::label('fecha_contrato', 'Fecha de Contrato', ['class' => 'form-label']) !!}
                                        {!! Form::date('fecha_contrato', null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::label('sueldo', 'Sueldo', ['class' => 'form-label']) !!}
                                        {!! Form::number('sueldo', null, ['class' => 'form-control', 'placeholder' => 'Sueldo', 'step' => '0.01']) !!}
                                    </div>
                                </div>

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

    <!-- Script para habilitar campos dinámicos -->
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
