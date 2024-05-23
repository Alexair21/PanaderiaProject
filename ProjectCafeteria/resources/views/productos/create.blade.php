@extends('tablar::page')

@section('content')
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-8 col-md-8">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Crear un nuevo producto</h1>
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

                                    {!! Form::open(['route' => 'productos.store', 'method' => 'POST', 'files' => true]) !!}


                                    <div class="mb-3">
                                        {!! Form::label('nombre', 'Nombre', ['class' => 'form-label']) !!}
                                        {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                                    </div>

                                    <div class="mb-3">
                                        {!! Form::label('descripcion', 'Descripcion', ['class' => 'form-label']) !!}
                                        {!! Form::text('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Descripcion']) !!}
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                {!! Form::label('stock', 'Stock', ['class' => 'form-label']) !!}
                                                {!! Form::number('stock', null, ['class' => 'form-control', 'placeholder' => 'Stock']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                {!! Form::label('precio', 'Precio', ['class' => 'form-label']) !!}
                                                {!! Form::number('precio', null, ['class' => 'form-control', 'placeholder' => 'Precio', 'step' => '0.01']) !!}
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                {!! Form::label('imagen', 'Imagen', ['class' => 'form-label']) !!}
                                                {!! Form::text('imagen', null, ['class' => 'form-control', 'placeholder' => 'Imagen']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                {!! Form::label('categoria_id', 'Categoria', ['class' => 'form-label']) !!}
                                                {!! Form::select('categoria_id', $categoria->pluck('nombre', 'id'), null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
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
