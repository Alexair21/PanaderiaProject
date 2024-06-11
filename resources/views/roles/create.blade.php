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
                                        <h1 class="h4 text-gray-900 mb-4">Crear un nuevo Usuario</h1>
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

                                    {{ Form::open(['route' => 'roles.store', 'method' => 'POST']) }}
                                    <div class="form-group">
                                        {!! Form::label('name', 'Nombre del Rol', ['class' => 'form-label']) !!}
                                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre del Rol']) }}
                                    </div>
                                    <br>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            {!! Form::label('name', 'Permisos para este Rol', ['class' => 'form-label']) !!}
                                            <br>
                                            @foreach ($permission as $value)
                                                <div class="form-check form-check-inline">

                                                    <input class="form-check-input" type="checkbox" name="permission[]"
                                                        value="{{ $value->id }}">


                                                    <label class="form-check-label">{{ $value->name }}</label>
                                                </div>
                                                <br>
                                                @if ($value->id == 4 || $value->id == 8 || $value->id == 12 || $value->id == 16 || $value->id == 17 || $value->id == 20)
                                                    <hr>
                                                @endif
                                            @endforeach
                                        </div>

                                    </div>

                                    <center>
                                        <div class="form-group">
                                            {{ Form::submit('Guardar', ['class' => 'btn btn-primary']) }}
                                        </div>
                                    </center>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
