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
                        Vouchers registrados
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
                            <h3 class="card-title">Listado de Vouchers</h3>
                        </div>
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="text-muted">
                                    Se visualizan
                                    <div class="mx-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm" value="{{ $vouchers->count() }}"
                                            size="3" aria-label="Vouchers count" readonly>
                                    </div>
                                    vouchers
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Fecha</th>
                                        <th>Estado</th>
                                        <th>Pedido Asociado</th>
                                        <th>PDF</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vouchers as $voucher)
                                        <tr>
                                            <td>{{ $voucher->codigo }}</td>
                                            <td>{{ $voucher->fecha }}</td>
                                            <td>{{ $voucher->estado }}</td>
                                            <td>
                                                @if ($voucher->pedido)
                                                    Pedido #{{ $voucher->pedido->id }}
                                                @else
                                                    Sin pedido asociado
                                                @endif
                                            </td>
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
