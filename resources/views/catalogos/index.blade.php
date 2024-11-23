@extends('tablar::page')

@section('title', 'Menú')

@section('content')
    <!-- Botón de WhatsApp -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <a href="https://api.whatsapp.com/send?phone=51947810132&text=Hola%21%20Quisiera%20m%C3%A1s%20informaci%C3%B3n%20sobre%20un%20pedido."
        class="float" target="_blank">
        <i class="fa fa-whatsapp my-float"></i>
    </a>

    <!-- Page header con imagen de fondo -->
    <div class="page-header d-print-none"
        style="background-image: url('https://vip-restaurant.vamtam.com/wp-content/uploads/2015/01/slider-shop-bg.jpg'); background-size: cover; background-position: center; padding: 150px 0;">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col text-center">
                    <h2 class="page-title text-white">
                        Menú
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Cuerpo de la página -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Categorías -->
                            <div class="categories text-center mb-4">
                                @foreach ($categorias as $categoria)
                                    @if ($categoria->estado)
                                        <!-- Solo mostrar categorías activas -->
                                        <a href="#categoria-{{ $categoria->id }}"
                                            class="btn category-btn m-1">{{ $categoria->nombre }}</a>
                                    @endif
                                @endforeach
                            </div>
                            <!-- Productos -->
                            <div class="products">
                                @foreach ($categorias as $categoria)
                                    @if ($categoria->estado)
                                        <!-- Solo mostrar categorías activas -->
                                        <div id="categoria-{{ $categoria->id }}" class="category-section mb-5">
                                            <h3 class="text-center">{{ $categoria->nombre }}</h3>
                                            <div class="row">
                                                @forelse ($categoria->platillos->where('estado', true) as $platillo)
                                                    <div class="col-md-3 mb-4">
                                                        <div class="card h-100">
                                                            <div class="product-image-wrapper">
                                                                <img src="{{ asset($platillo->imagen) }}"
                                                                    alt="{{ $platillo->nombre }}"
                                                                    class="product-image rounded-circle">
                                                            </div>
                                                            <div class="card-body text-center">
                                                                <h5 class="card-title">
                                                                    {{ $platillo->nombre }}
                                                                    @if ($platillo->destacado)
                                                                        <i class="fa fa-star text-warning"></i> <!-- Estrellita -->
                                                                    @endif
                                                                </h5>
                                                                <p class="card-text">Desde:
                                                                    S/.{{ number_format($platillo->precio, 2) }}</p>
                                                                <a href="{{ route('platillos.verplatillo', $platillo->id) }}"
                                                                    class="btn btn-primary">Ver platillo</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="col-12">
                                                        <p class="text-center">No hay platillos disponibles en esta categoría</p>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            left: 40px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
        }

        .float:hover {
            text-decoration: none;
            color: #25d366;
            background-color: #fff;
        }

        .my-float {
            margin-top: 16px;
        }

        /* Page Header Styles */
        .page-header {
            text-align: center;
            padding: 100px 0;
            background-image: url('https://vip-restaurant.vamtam.com/wp-content/uploads/2015/01/slider-shop-bg.jpg');
            background-size: cover;
            background-position: center;
        }

        .page-title {
            font-size: 2.5rem;
            color: #fff;
        }

        /* Categories Styles */
        .categories a {
            color: #28a745;
            text-decoration: none;
            padding: 10px 20px;
            font-size: 1.2rem;
            border: 2px solid transparent;
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        .categories a:hover {
            background-color: #28a745;
            color: #fff;
            border: 2px solid #28a745;
        }

        /* Category Section Styles */
        .category-section {
            margin-top: 20px;
        }

        /* Product Image Wrapper Styles */
        .product-image-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 150px;
        }

        /* Product Image Styles */
        .product-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 3px solid #ddd;
            transition: transform 0.3s ease;
        }

        .product-image:hover {
            transform: scale(1.1);
            border-color: #28a745;
        }

        /* Card Styles */
        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .card-body h5 {
            font-size: 1.1rem;
            font-weight: bold;
        }

        .card-body p {
            color: #555;
            font-size: 0.9rem;
        }

        .fa-star {
            font-size: 1rem;
        }

        .text-warning {
            color: #ffc107 !important;
        }
    </style>
@endsection
