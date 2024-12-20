@extends('tablar::page')

@section('title', 'Inicio')

@section('content')
    <div class="page-body">
        <div class="container">
            <div class="row">
                <!-- Tarjetas de información general -->
                <div class="col-md-4">
                    <div class="custom-card bg-c-blue">
                        <div class="custom-card-block">
                            <h6 class="custom-card-title">Usuarios Registrados</h6>
                            <h2 class="custom-card-count">{{ $users }}</h2>
                            <i class="fa fa-user custom-card-icon"></i>
                            <p class="custom-card-link"><a href="/usuarios">Ver más</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="custom-card bg-c-pink">
                        <div class="custom-card-block">
                            <h6 class="custom-card-title">Platillos Disponibles</h6>
                            <h2 class="custom-card-count">{{ $platillos }}</h2>
                            <i class="fa fa-utensils custom-card-icon"></i>
                            <p class="custom-card-link"><a href="/platillos">Ver más</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="custom-card bg-c-green">
                        <div class="custom-card-block">
                            <h6 class="custom-card-title">Pedidos Realizados</h6>
                            <h2 class="custom-card-count">{{ $pedidos }}</h2>
                            <i class="fa fa-shopping-cart custom-card-icon"></i>
                            <p class="custom-card-link"><a href="/pedidos">Ver más</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráficos -->
            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="chart-container">
                        <h5 class="chart-title text-center">Top 3 Platillos Más Vendidos</h5>
                        <canvas id="topPlatillosPieChart"></canvas>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="chart-container">
                        <h5 class="chart-title text-center">Total de Platillos Vendidos</h5>
                        <canvas id="totalPlatillosBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Estilo de las tarjetas */
        .custom-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
            margin-bottom: 20px;
            border-left: 5px solid;
        }

        .custom-card-block {
            padding: 20px;
        }

        .custom-card-title {
            font-size: 14px;
            color: #6c757d;
        }

        .custom-card-count {
            font-size: 32px;
            color: #333;
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

        .custom-card.bg-c-blue {
            border-left-color: #007bff;
        }

        .custom-card.bg-c-pink {
            border-left-color: #e83e8c;
        }

        .custom-card.bg-c-green {
            border-left-color: #28a745;
        }

        /* Gráficos */
        .chart-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 18px;
            margin-bottom: 20px;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Datos para los gráficos
            const topPlatillos = @json($topPlatillos);
            const totalPlatillos = @json($totalPlatillos);

            // Gráfico de pastel para los platillos más vendidos
            const topPlatillosPieCtx = document.getElementById('topPlatillosPieChart').getContext('2d');
            const topPlatillosPieChart = new Chart(topPlatillosPieCtx, {
                type: 'pie',
                data: {
                    labels: topPlatillos.map(platillo => platillo.nombre),
                    datasets: [{
                        data: topPlatillos.map(platillo => platillo.count),
                        backgroundColor: ['#007bff', '#28a745', '#ffc107'],
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                },
            });

            // Gráfico de barras para los platillos totales vendidos
            const totalPlatillosBarCtx = document.getElementById('totalPlatillosBarChart').getContext('2d');
            const totalPlatillosBarChart = new Chart(totalPlatillosBarCtx, {
                type: 'bar',
                data: {
                    labels: totalPlatillos.map(platillo => platillo.nombre),
                    datasets: [{
                        label: 'Total Vendidos',
                        data: totalPlatillos.map(platillo => platillo.count),
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
                                minRotation: 45,
                            },
                        },
                    },
                },
            });
        });
    </script>
@stop
