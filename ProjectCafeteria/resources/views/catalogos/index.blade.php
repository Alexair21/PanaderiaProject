@extends('tablar::page')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Menú de productos
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Categorías</h3>
                        </div>
                        <div class="list-group list-group-flush">
                            @foreach ($categorias as $categoria)
                                <a href="#categoria-{{ $categoria->id }}" class="list-group-item list-group-item-action">{{ $categoria->nombre }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="card">
                        <div class="container">
                            <div class="row">
                                @foreach ($categorias as $categoria)
                                    <div id="categoria-{{ $categoria->id }}" class="col-12 mb-4">
                                        <br>
                                        <center><h1 class=" ">{{ $categoria->nombre }}</h1></center>
                                        <br><br>
                                        <div class="row">
                                            @forelse ($categoria->productos as $producto)
                                                <div class="col-md-6 mb-4">
                                                    <a href="{{ route('productos.verProducto', $producto->id) }}" class="product-card d-flex align-items-center">
                                                        <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}" class="img-fluid product-image me-3">
                                                        <div>
                                                            <h3 class="product-name">{{ $producto->nombre }}</h3>
                                                            <p> Desde: S/.{{ $producto->precio }}</p>
                                                        </div>
                                                    </a>
                                                </div>
                                            @empty
                                                <p>No hay productos en esta categoría</p>
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

<!-- Add some custom CSS for better appearance -->
@section('css')
    <style>
        .list-group-item {
            cursor: pointer;
        }
        .product-card {
            text-decoration: none;
            color: inherit;
        }
        .product-image {
            max-width: 100px;
            max-height: 100px;
        }
        .page-body .row {
            margin-left: 0;
            margin-right: 0;
        }
        .page-body .col-3, .page-body .col-9 {
            display: flex;
            flex-direction: column;
        }
        .page-body .col-3 .card, .page-body .col-9 .card {
            flex: 1;
        }
    </style>
@endsection
