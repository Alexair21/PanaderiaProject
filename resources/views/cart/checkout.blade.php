@extends('tablar::page')

@section('title', 'Carrito (' . Cart::count() . ')')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Listado de productos
                    </div>
                    <h2 class="page-title">
                        Productos registrados
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="d-flex align-items-center">
                    @can('Acciones-barista')
                    <form action="{{ route('guardarVenta') }}" method="POST" class="d-flex align-items-center me-2">
                        @csrf
                        <div class="me-2">
                            <input type="text" class="form-control" id="cliente_nombre" name="cliente_nombre"
                                placeholder="Nombre del cliente" required>
                        </div>
                        <button type="submit" class="btn" style="background-color: #ebc60ec8; color: #f9f9f9;">Guardar
                            pedido</button>
                    </form>
                    @endcan
                    <a href="{{ route('clear') }}" class="btn me-2"
                        style="background-color: #00362f; color: #f9f9f9;">Vaciar carrito</a>
                    @can('Acciones-cliente')
                        @if (Cart::count() > 0)
                            <a href="{{ route('formaPago') }}" class="btn btn-primary">Proceder al pago</a>
                        @endif
                    @endcan
                </div>
            </div>
        </div>
    </div>



    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Productos en el carrito</h3>
                        </div>
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="text-muted">
                                    Se visualizan
                                    <div class="mx-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm"
                                            value="{{ Cart::count() }}" size="3" aria-label="Invoices count">
                                    </div>
                                    productos
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead style="background-color: #6777ef; color: white;">
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Importe</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Cart::content() as $item)
                                        <tr>
                                            <td>
                                                <img src="{{ $item->options->imagen }}" alt="{{ $item->name }}"
                                                    style="width: 100px;">
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->options->descripcion }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>S/. {{ number_format($item->price, 2) }}</td>
                                            <td>S/. {{ number_format($item->qty * $item->price, 2) }}</td>
                                            <td>
                                                <form action="{{ route('removeitem') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="rowId" value="{{ $item->rowId }}">
                                                    <input type="submit" name="btn" class="btn"
                                                        style="background-color: #00362f; color: #f9f9f9;" value="x">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5"></td>
                                        <td class="text-end"><strong>Subtotal</strong></td>
                                        <td class="text-end">S/. {{ number_format(Cart::subtotal(), 2) }}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"></td>
                                        <td class="text-end"><strong>IGV</strong></td>
                                        <td class="text-end">S/. {{ number_format(Cart::tax(), 2) }}</td>
                                        <td></td>
                                    </tr>
                                    <tr style="background-color: #00362f; color: #f9f9f9;">
                                        <td colspan="5"></td>
                                        <td class="text-end"><strong>Total</strong></td>
                                        <td class="text-end">S/. {{ number_format(Cart::total(), 2) }}</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
