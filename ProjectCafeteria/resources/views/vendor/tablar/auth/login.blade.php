@extends('tablar::auth.layout')
@section('title', 'Login')

@section('content')
    <div class="container container-tight py-4"
        style="background-image: url('/path/to/your/cafe-background.jpg'); background-size: cover; background-position: center; min-height: 100vh; display: flex; justify-content: center; align-items: center;">
        <div class="card card-md shadow-lg"
            style="background: rgba(255, 255, 255, 0.9); border-radius: 15px; max-width: 500px; padding: 40px;">
            <div class="text-center mb-4">
                <a href="" class="navbar-brand navbar-brand-autodark">
                    <img src="{{ asset(config('tablar.auth_logo.img.path', 'assets/logo.svg')) }}" height="36"
                        alt="">
                </a>
            </div>
            <h2 class="h2 text-center mb-4">Inicie sesión en su cuenta</h2>
            <form action="{{ route('login') }}" method="post" autocomplete="off" novalidate>
                @csrf
                <div class="mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        placeholder="Ingrese su correo" autocomplete="off">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <div class="input-group input-group-flat">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Ingrese su contraseña" autocomplete="off">
                        <span class="input-group-text">
                            <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                            </a>
                        </span>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                </div>
            </form>
            @if (Route::has('register'))
                <div class="text-center text-muted mt-3">
                    ¿Aún no tienes cuenta? <a href="{{ route('register') }}" tabindex="-1">Regístrate</a>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/principal.css">
    <style>
        .card {
            border-radius: 15px;
        }

        .form-label {
            color: #5b3a29;
            /* Color acorde a una temática de cafetería */
        }

        .btn-primary {
            background-color: #6f4e37;
            /* Color de botón acorde a una temática de cafetería */
            border-color: #6f4e37;
        }

        .btn-primary:hover {
            background-color: #5b3a29;
            border-color: #5b3a29;
        }

        .navbar-brand-autodark img {
            max-height: 80px;
        }

        .icon {
            stroke: #6f4e37;
            /* Color del icono acorde a una temática de cafetería */
        }
    </style>
@stop
