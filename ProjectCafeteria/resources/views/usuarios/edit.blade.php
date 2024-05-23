@extends('tablar::page')

@section('content')

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Bienvenido!</h1>
                                    </div>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    {!! Form::model($user, ['method' => 'PUT', 'route' => ['usuarios.update', $user->id]]) !!}


                                    <div class="mb-3">
                                        {!! Form::label('name', 'Nombre', ['class' => 'form-label']) !!}
                                        {!! Form::text('name', null, array('class' => 'form-control')) !!}
                                    </div>

                                    <div class="mb-3">
                                        {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}
                                        {!! Form::email('email', null,array('class' => 'form-control')) !!}
                                    </div>

                                    <div class="mb-3">
                                        {!! Form::label('password', 'Contraseña', ['class' => 'form-label']) !!}
                                        {!! Form::password('password',array('class' => 'form-control')) !!}
                                    </div>

                                    <div class="mb-3">
                                        {!! Form::label('password_confirmation', 'Confirmar contraseña', ['class' => 'form-label']) !!}
                                        {!! Form::password('comfirm-password',array('class' => 'form-control')) !!}
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
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
