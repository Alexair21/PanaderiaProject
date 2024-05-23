@extends('tablar::auth.layout')
@section('title', 'Login')


@section('content')
<div class="container container-tight py-4" style="background-image: url('/path/to/your/cafe-background.jpg'); background-size: cover; background-position: center; min-height: 100vh;">
    <div class="text-center mb-1 mt-5">
        <a href="" class="navbar-brand navbar-brand-autodark">
            <img src="{{ asset(config('tablar.auth_logo.img.path', 'assets/logo.svg')) }}" height="36" alt="">
        </a>
    </div>
    <div class="card card-md shadow-lg" style="background: rgba(255, 255, 255, 0.9); border-radius: 15px;">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">Inicie sesión en su cuenta</h2>
            <form action="{{ route('login') }}" method="post" autocomplete="off" novalidate>
                @csrf
                <div class="mb-3">
                    <label class="form-label">Correo</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="your@email.com" autocomplete="off">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <div class="input-group input-group-flat">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Your password" autocomplete="off">
                        <span class="input-group-text">
                            <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <circle cx="12" cy="12" r="2" />
                                    <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                                </svg>
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
        </div>
    </div>
    @if (Route::has('register'))
        <div class="text-center text-muted mt-3">
            ¿Aún no tienes cuenta? <a href="{{ route('register') }}" tabindex="-1">Regístrate</a>
        </div>
    @endif
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/principal.css">
    <style>
        body {
            background: url('/path/to/your/cafe-background.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .card {
            border-radius: 15px;
        }
        .form-label {
            color: #5b3a29; /* Color acorde a una temática de cafetería */
        }
        .btn-primary {
            background-color: #6f4e37; /* Color de botón acorde a una temática de cafetería */
            border-color: #6f4e37;
        }
        .btn-primary:hover {
            background-color: #5b3a29;
            border-color: #5b3a29;
        }
        .navbar-brand-autodark img {
            max-height: 60px;
        }
        .icon {
            stroke: #6f4e37; /* Color del icono acorde a una temática de cafetería */
        }
    </style>
@stop
