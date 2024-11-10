@extends('tablar::page')

@section('title', 'Delivery')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Listado de Delivery's
                    </div>
                    <h2 class="page-title">
                        Delivery's registradas
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
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                    <th>N° Venta</th>
                                    <th>PDF</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($vouchers as $voucher)
                                        @if ($voucher->estado == 'Delivery')
                                            <tr>
                                                <td>{{ $voucher->fecha }}</td>
                                                <td>{{ $voucher->estado }}</td>
                                                <td>{{ $voucher->venta->id }}</td>
                                                <td>
                                                    <a href="{{ route('vouchers.generate', $voucher->id) }}"
                                                        class="btn btn-sm btn-primary">Ver</a>
                                                </td>
                                                <td>
                                                    {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['vouchers.destroy', $voucher->id],
                                                        'style' => 'display:inline',
                                                    ]) !!}
                                                    {!! Form::submit('Eliminar', ['class' => 'btn btn-sm btn-danger']) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endif
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
