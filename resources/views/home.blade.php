@extends('tablar::page')

@section('title', 'Inicio')

@section('content')
    <!-- Page body -->
    <div class="page-body">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="custom-card bg-c-blue">
                        <div class="custom-card-block">
                            <h6 class="custom-card-title">Usuarios</h6>
                            <h2 class="custom-card-count">{{ $users }}</h2>
                            <i class="fa fa-user custom-card-icon"></i>
                            <p class="custom-card-link"><a href="/usuarios">Ver más</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="custom-card bg-c-pink">
                        <div class="custom-card-block">
                            <h6 class="custom-card-title">Productos</h6>
                            <h2 class="custom-card-count">{{ $productos }}</h2>
                            <i class="fa fa-box custom-card-icon"></i>
                            <p class="custom-card-link"><a href="/productos">Ver más</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="custom-card bg-c-green">
                        <div class="custom-card-block">
                            <h6 class="custom-card-title">Ventas</h6>
                            <h2 class="custom-card-count">{{ $ventas }}</h2>
                            <i class="fa fa-shopping-cart custom-card-icon"></i>
                            <p class="custom-card-link"><a href="/ventas">Ver más</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="custom-card bg-c-yellow">
                        <div class="custom-card-block">
                            <h6 class="custom-card-title">Ganancias</h6>
                            <h2 class="custom-card-count">S/. {{ $ganancias }}</h2>
                            <i class="fa fa-dollar-sign custom-card-icon"></i>
                            <p class="custom-card-link"><a href="/ventas">Ver más</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Gráficos -->
            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="chart-container">
                        <h5 class="chart-title text-center">Top 3 Productos Más Vendidos</h5>
                        <canvas id="topProductsPieChart"></canvas>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="chart-container">
                        <h5 class="chart-title text-center">Total de Productos Vendidos</h5>
                        <canvas id="totalProductsBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/css/home.css">
    <style>
        .custom-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            overflow: hidden;
            position: relative;
            margin-bottom: 20px;
            border-left: 5px solid;
        }

        .custom-card-block {
            padding: 20px;
            position: relative;
        }

        .custom-card-title {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 0;
        }

        .custom-card-count {
            font-size: 32px;
            color: #333;
            margin: 10px 0;
        }

        .custom-card-icon {
            position: absolute;
            right: 20px;
            top: 20px;
            font-size: 48px;
            color: rgba(0, 0, 0, 0.1);
        }

        .custom-card-link a {
            color: #007bff;
            text-decoration: none;
        }

        .custom-card-link a:hover {
            text-decoration: underline;
        }

        .custom-card.bg-c-blue {
            border-left-color: #007bff;
        }

        .custom-card.bg-c-pink {
            border-left-color: #e83e8c;
        }

        .custom-card.bg-c-green {
            border-left-color: #28a745;
        }

        .custom-card.bg-c-yellow {
            border-left-color: #ffc107;
        }

        .chart-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
            height: 450px; /* Ajuste de la altura del contenedor del gráfico */
            overflow: hidden;
        }

        .chart-title {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }

        canvas {
            width: 100% !important; /* Asegura que el canvas no exceda el tamaño del contenedor */
            height: 100% !important; /* Asegura que el canvas no exceda el tamaño del contenedor */
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Datos para los gráficos
            const topProducts = @json($topProducts); // Reemplaza con los datos reales
            const totalProducts = @json($totalProducts); // Reemplaza con los datos reales

            // Gráfico tipo pie para los productos más vendidos
            const topProductsPieCtx = document.getElementById('topProductsPieChart').getContext('2d');
            const topProductsPieChart = new Chart(topProductsPieCtx, {
                type: 'pie',
                data: {
                    labels: topProducts.map(product => product.nombre),
                    datasets: [{
                        data: topProducts.map(product => product.count),
                        backgroundColor: ['#007bff', '#28a745', '#ffc107'],
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                },
            });

            // Gráfico de barras para los productos totales vendidos
            const totalProductsBarCtx = document.getElementById('totalProductsBarChart').getContext('2d');
            const totalProductsBarChart = new Chart(totalProductsBarCtx, {
                type: 'bar',
                data: {
                    labels: totalProducts.map(product => product.nombre),
                    datasets: [{
                        label: 'Total Vendidos',
                        data: totalProducts.map(product => product.count),
                        backgroundColor: '#007bff',
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                        x: {
                            ticks: {
                                autoSkip: false,
                                maxRotation: 90,
                                minRotation: 45
                            }
                        }
                    },
                },
            });
        });
    </script>
@stop
