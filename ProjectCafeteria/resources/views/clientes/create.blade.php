@extends('tablar::page')

@section('content')
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Crear un nuevo Cliente</h1>
                                    </div>

                                    @if ($errors->any())
                                        <div class="alert alert-dark" role="alert">
                                            <Strong>¡Revise los campos!</Strong>
                                            @foreach ($errors->all() as $error)
                                                <span class="badge badge-danger">{{ $error }}</span>
                                            @endforeach
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    {!! Form::open(['route' => 'clientes.store', 'method' => 'POST']) !!}


                                    <div class="mb-3">
                                        {!! Form::label('nombre', 'Nombre', ['class' => 'form-label']) !!}
                                        {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                                    </div>

                                    <div class="mb-3">
                                        {!! Form::label('email', 'E-mail', ['class' => 'form-label']) !!}
                                        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Correo']) !!}
                                    </div>

                                    <div class="mb-3">
                                        {!! Form::label('telefono', 'Telefono', ['class' => 'form-label']) !!}
                                        {!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'Telefono']) !!}
                                    </div>

                                    <div class="mb-3">
                                        {!! Form::label('direccion', 'Direccion', ['class' => 'form-label']) !!}
                                        {!! Form::text('direccion', null, ['class' => 'form-control', 'placeholder' => 'Direccion']) !!}
                                    </div>

                                    <br>

                                    <div class= "col-x-12 col-sm-12 col-md-12 text-center">
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

    </div>
@endsection
