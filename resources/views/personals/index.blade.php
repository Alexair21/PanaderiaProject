@extends('tablar::page')

@section('title', 'Personal')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Listado de personal
                    </div>
                    <h2 class="page-title">
                        Personal registrado
                    </h2>
                </div>
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('personal.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            Registrar nuevo personal
                        </a>
                    </div>
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
                            <h3 class="card-title">Listado</h3>
                        </div>
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="text-muted">
                                    Mostrando
                                    <div class="mx-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm"
                                            value="{{ $personals->count() }}" size="3" aria-label="Personals count">
                                    </div>
                                    registros
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead style="background-color: #6777ef;">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Teléfono</th>
                                        <th>Dirección</th>
                                        <th>Cargo</th>
                                        <th>DNI</th>
                                        <th>Sueldo</th>
                                        <th>Estado</th>
                                        @can('editar-personal')
                                            <th>Acciones</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($personals as $personal)
                                        <tr>
                                            <td>{{ $personal->nombre }}</td>
                                            <td>{{ $personal->email }}</td>
                                            <td>{{ $personal->telefono }}</td>
                                            <td>{{ $personal->direccion }}</td>
                                            <td>{{ $personal->cargo }}</td>
                                            <td>{{ $personal->dni }}</td>
                                            <td>S/. {{ number_format($personal->sueldo, 2) }}</td>
                                            <td>
                                                @if ($personal->estado == 'Disponible')
                                                    <span style="color:white" class="badge bg-success">{{ $personal->estado }}</span>
                                                @else
                                                    <span style="color:white" class="badge bg-danger">{{ $personal->estado }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('personal.edit', $personal->id) }}"
                                                    class="btn btn-sm btn-primary">Editar</a>

                                                {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['personal.destroy', $personal->id],
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
