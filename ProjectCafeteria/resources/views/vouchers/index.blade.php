@extends('tablar::page')

@section('title', 'Vouchers')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Listado de vouchers
                    </div>
                    <h2 class="page-title">
                        Vouchers registradas
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
                        <div class="card-header">
                            <h3 class="card-title">Invoices</h3>
                        </div>
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="text-muted">
                                    Se vizualizan
                                    <div class="mx-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm" value="8"
                                            size="3" aria-label="Invoices count">
                                    </div>
                                    usuarios
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead style="blackground-color: #6777ef;">
                                    <th>Codigo</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                    <th>Venta</th>
                                    <th>PDF</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($vouchers as $voucher)
                                        <tr>
                                            <td>{{ $voucher->codigo }}</td>
                                            <td>{{ $voucher->fecha }}</td>
                                            <td>{{ $voucher->estado }}</td>
                                            <td>{{ $voucher->venta->id}}</td>
                                            <td>
                                                <a href="{{ route('vouchers.generate', $voucher->id) }}" class="btn btn-sm btn-primary">Ver</a>
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
