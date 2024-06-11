@extends('tablar::auth.layout')
@section('title', 'Register')
@section('content')
    <div class="container container-tight py-4 shadow-lg">
        <form class="card card-md shadow-lg" action="{{ route('register') }}" method="post" autocomplete="off" novalidate>
            @csrf
            <div class="card-body shadow-lg">
                <div class="text-center">
                    <a href="" class="navbar-brand navbar-brand-autodark">
                        <img src="{{ asset(config('tablar.auth_logo.img.path', 'assets/logo.svg')) }}" height="36"
                            alt=""></a>
                </div>
                <h2 class="card-title text-center mb-4">Crea una nueva cuenta!</h2>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Nombres y Apellidos">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input type="text" name="direccion"
                                class="form-control @error('direccion') is-invalid @enderror" placeholder="Dirección">
                            @error('direccion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input type="text" name="telefono"
                                class="form-control @error('telefono') is-invalid @enderror" placeholder="Teléfono">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Correo Electrónico">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="input-group input-group-flat">
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña"
                                    autocomplete="off">
                                <span class="input-group-text">
                                    <a href="#" class="link-secondary" title="Show password"
                                        data-bs-toggle="tooltip"></a>
                                </span>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="input-group input-group-flat">
                                <input type="password" name="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    placeholder="Confirmar contraseña" autocomplete="off">
                                <span class="input-group-text">
                                    <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                                    </a>
                                </span>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Crear cuenta</button>
                </div>
                <div class="text-center text-muted mt-3">
                    ¿Ya tienes cuenta? <a href="{{ route('login') }}" tabindex="-1">Inicia Sesión</a>
                </div>
            </div>
        </form>

    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="/css/principal.css">
    <style>
        .card {
            border-radius: 15px;
        }
    </style>
@endsection
