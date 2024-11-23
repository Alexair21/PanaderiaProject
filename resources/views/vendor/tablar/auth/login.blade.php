@extends('tablar::auth.layout')
@section('title', 'Login')

@section('content')
    <div
        style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background-image: url('/path/to/your/cafe-background.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; z-index: -2;">
    </div>

    <div
        style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background-color: rgba(0, 0, 0, 0.5); z-index: -1;">
    </div>

    <div class="container-xxl"
        style="position: relative; display: flex; align-items: center; justify-content: center; min-height: 100vh;">
        <div class="card px-sm-6 px-0" style="border: none; background-color: rgba(0, 0, 0, 0.5);">
            <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center">
                    <a href="{{ url('/') }}" class="app-brand-link gap-2">
                        <span class="app-brand-logo demo">
                            <center><img src="{{ asset('icon.png') }}" alt="Logo" height="80"></center>
                        </span>
                    </a>
                </div>
                <!-- /Logo -->
                <h4 class="mb-1 text-center" style="color: #ffffff;">Bienvenido! 👋</h4>
                <p class="mb-4 text-center" style="color: #ffffff;">Por favor inicia sesión para ingresar</p>

                <form action="{{ route('login') }}" method="post" autocomplete="off" novalidate>
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="form-label" style="color: #ffffff;">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            placeholder="Ingrese su correo" autocomplete="off" style="color:rgb(0, 0, 0)" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4 form-password-toggle">
                        <label class="form-label" for="password" style="color: #ffffff;">Contraseña</label>
                        <div class="input-group input-group-merge">
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Ingrese su contraseña" autocomplete="off" style="color:rgb(0, 0, 0)" required>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <button class="btn btn-primary d-grid w-100" type="submit"
                            style="background-color: #E4C590; border-color: #ffff; color:black">Iniciar sesión</button>
                    </div>
                </form>

                @if (Route::has('register'))
                    <p class="text-center" style="color:white;">
                        ¿Eres nuevo? <a href="{{ route('register') }}" style="color: #E4C590;">Regístrate en el sistema</a>
                    </p>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/principal.css">
    <style>
        .form-label {
            color: #ffffff;
        }

        .btn-primary {
            background-color: #E4C590;
            /* Color de botón acorde a una temática de cafetería */
            border-color: #ffff;
            color: black;
        }

        .btn-primary:hover {
            background-color: #D0B18D;
            border-color: #D0B18D;
        }

        .navbar-brand-autodark img {
            max-height: 80px;
        }

        .icon {
            stroke: #E4C590;
            /* Color del icono acorde a una temática de cafetería */
        }
    </style>
@stop
