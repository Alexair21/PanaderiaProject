@extends('tablar::page')

@section('title', 'Menu')

@section('content')
    <!-- Page header with background image -->
    <div class="page-header d-print-none" style="background-image: url('https://vip-restaurant.vamtam.com/wp-content/uploads/2015/01/slider-shop-bg.jpg'); background-size: cover; background-position: center; padding: 150px 0;">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col text-center">
                    <h2 class="page-title text-white">
                        Menú de productos
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Categories -->
                            <div class="categories text-center mb-4">
                                @foreach ($categorias as $categoria)
                                    <a href="#categoria-{{ $categoria->id }}" class="btn category-btn m-1">{{ $categoria->nombre }}</a>
                                @endforeach
                            </div>
                            <!-- Products -->
                            <div class="products">
                                @foreach ($categorias as $categoria)
                                    <div id="categoria-{{ $categoria->id }}" class="category-section mb-5">
                                        <h3 class="text-center">{{ $categoria->nombre }}</h3>
                                        <div class="row">
                                            @forelse ($categoria->productos as $producto)
                                                <div class="col-md-3 mb-4">
                                                    <div class="card h-100">
                                                        <div class="product-image-wrapper">
                                                            <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}" class="product-image">
                                                        </div>
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                                                            <p class="card-text">Desde: S/.{{ $producto->precio }}</p>
                                                            <a href="{{ route('productos.verProducto', $producto->id) }}" class="btn btn-primary">Ver Producto</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col-12">
                                                    <p class="text-center">No hay productos en esta categoría</p>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
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
        .categories a {
            color: green;
            text-decoration: none;
            padding: 10px 20px;
            font-size: 1.2rem;
        }
        .categories a:hover {
            border-bottom: 2px solid green;
        }
        .category-section {
            margin-top: 20px;
        }
        .product-image-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 150px; /* Adjust the height as needed */
        }
        .product-image {
            max-height: 150px; /* Adjust the max-height as needed */
            max-width: 100%;
            object-fit: contain;
        }
        .card {
            border: none;
        }
    </style>
@endsection
