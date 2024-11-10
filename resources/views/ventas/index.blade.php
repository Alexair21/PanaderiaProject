@extends('tablar::page')

@section('title', 'Ventas')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Listado de ventas
                    </div>
                    <h2 class="page-title">
                        Ventas registradas
                    </h2>
                </div>
            </div>
        </div>
    </div>


    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead style="blackground-color: #6777ef;">
                                    <th>ID</th>
                                    <th>Fecha de venta</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th>Cliente</th>
                                    <th>Pagar</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($ventas as $venta)
                                        <tr>
                                            <td>{{ $venta->id }}</td>
                                            <td>{{ $venta->fecha_venta }}</td>
                                            <td>{{ $venta->total }}</td>
                                            <td>{{ $venta->estado }}</td>
                                            <td>{{ $venta->cliente_nombre}}</td>
                                            <td>
                                                <a href="{{ route('estadoPagar', ['venta' => $venta->id]) }}" class="btn btn-primary">Proceder al pago</a>
                                            </td>
                                            <td>
                                                    {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['ventas.destroy', $venta->id],
                                                        'style' => 'display:inline',
                                                    ]) !!}
                                                    {!! Form::submit('Eliminar', ['class' => 'btn btn-sm btn-danger']) !!}
                                                    {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
