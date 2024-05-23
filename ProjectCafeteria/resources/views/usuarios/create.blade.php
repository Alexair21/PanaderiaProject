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

                                    {!! Form::open(['route' => 'usuarios.store', 'method' => 'POST']) !!}


                                    <div class="mb-3">
                                        {!! Form::label('name', 'Nombre', ['class' => 'form-label']) !!}
                                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                                    </div>

                                    <div class="mb-3">
                                        {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}
                                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                                    </div>

                                    <div class="mb-3">
                                        {!! Form::label('password', 'Contraseña', ['class' => 'form-label']) !!}
                                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Contraseña']) !!}
                                    </div>

                                    <div class="mb-3">
                                        {!! Form::label('password_confirmation', 'Confirmar contraseña', ['class' => 'form-label']) !!}
                                        {{ Form::password('confirm-password', ['class' => 'form-control', 'placeholder' => 'Confirmar Contraseña']) }}
                                    </div>

                                    <div class="mb-3">
                                        {!! Form::label('roles', 'Rol', ['class' => 'form-label']) !!}
                                        {{ Form::select('roles[]', $roles, [], ['class' => 'form-control']) }}
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
