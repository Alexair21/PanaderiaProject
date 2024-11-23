@extends('tablar::page')
@section('title', 'Platillo')
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
                                        <h1 class="h4 text-gray-900 mb-4">Editar Platillo</h1>
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

                                    {!! Form::model($platillo, ['route' => ['platillos.update', $platillo->id], 'method' => 'PUT', 'files' => true]) !!}

                                    <div class="mb-3">
                                        {!! Form::label('nombre', 'Nombre', ['class' => 'form-label']) !!}
                                        {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                                    </div>

                                    <div class="mb-3">
                                        {!! Form::label('descripcion', 'Descripción', ['class' => 'form-label']) !!}
                                        {!! Form::text('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Descripción']) !!}
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                {!! Form::label('precio', 'Precio', ['class' => 'form-label']) !!}
                                                {!! Form::number('precio', null, ['class' => 'form-control', 'placeholder' => 'Precio', 'step' => '0.01']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                {!! Form::label('estado', 'Estado', ['class' => 'form-label']) !!}
                                                {!! Form::select('estado', [1 => 'Disponible', 0 => 'No disponible'], null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                {!! Form::label('imagen', 'Imagen actual', ['class' => 'form-label']) !!}
                                                @if ($platillo->imagen)
                                                    <div class="mb-2">
                                                        <img src="{{ asset('storage/' . $platillo->imagen) }}" alt="Imagen actual" style="width: 100%; max-width: 150px;">
                                                    </div>
                                                @else
                                                    <p>No hay imagen disponible</p>
                                                @endif
                                                {!! Form::label('imagen', 'Seleccionar nueva imagen', ['class' => 'form-label']) !!}
                                                {!! Form::file('imagen', ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                {!! Form::label('categoria_id', 'Categoría', ['class' => 'form-label']) !!}
                                                {!! Form::select('categoria_id', $categorias->pluck('nombre', 'id'), null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="col-x-12 col-sm-12 col-md-12 text-center">
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
