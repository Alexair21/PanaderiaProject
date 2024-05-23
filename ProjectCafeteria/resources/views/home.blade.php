@extends('tablar::page')

@section('content')
        <!-- Page body -->
        <div class="page-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card bg-c-blue order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">Usuarios</h6>
                                @php
                                    use App\Models\User;
                                    $users = User::count();
                                @endphp
                                <h2 class="text-right"><i class="fa fa-user f-left"></i><span>{{$users}}</span></h2>
                                <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver más</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-c-pink order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">Clientes</h6>
                                @php
                                    use App\Models\Cliente;
                                    $clientes = Cliente::count();
                                @endphp
                                <h2 class="text-right"><i class="fa fa-user f-left"></i><span>{{$clientes}}</span></h2>
                                <p class="m-b-0 text-right"><a href="/clientes" class="text-white">Ver más</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('css')
    <link rel="stylesheet" href="/css/home.css">
@stop
