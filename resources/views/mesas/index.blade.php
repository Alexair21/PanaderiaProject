@extends('tablar::page')
@section('title', 'Mesas')
@section('content')

    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <h2 class="page-title">Mesas en {{ $sala->nombre }}</h2>
        </div>
    </div>

    <!-- Mesas -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards justify-content-center">
                @foreach ($mesas as $mesa)
                    <div class="col-sm-6 col-md-4 col-lg-3 mt-4">
                        <a href="{{ route('mesas.show', $mesa->id) }}" class="text-decoration-none">
                            <div class="card text-center ">
                                <!-- Imagen de la mesa -->
                                <center><img src="{{ asset('images/mesa.png') }}" class="card-img-top mesa-img" style="width: 50%" alt="Mesa {{ $mesa->numero }}"></center>
                                <div class="card-body mb-4">
                                    <h5 class="card-title" style="color: {{ $mesa->estado === 'disponible' ? 'green' : 'red' }};">
                                        Mesa {{ $mesa->numero }}
                                    </h5>
                                    <p class="card-text">
                                        Estado: {{ $mesa->estado === 'disponible' ? 'Disponible' : 'Ocupada' }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@section('css')
    <style>
        /* Imagen dentro de la tarjeta */
        .mesa-img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }

        /* Espaciado entre tarjetas */
        .card {
            margin: 10px;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Título de la mesa */
        .card-title {
            font-weight: bold;
        }
    </style>
@endsection
