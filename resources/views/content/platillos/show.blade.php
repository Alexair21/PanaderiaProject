@extends('layouts/contentNavbarLayout')

@section('title', 'Lista de Platillos')

@section('content')

<div class="card">
    <h5 class="card-header d-flex justify-content-between align-items-center">
        Lista de Platillos
        <!-- Botón para registrar nuevo alineado a la derecha -->
        <a href="{{ route('platillos.create') }}" class="btn btn-primary">Registrar Platillo</a>
    </h5>

    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Categoría</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($platillos as $platillo)
                <tr>
                    <td>{{ $platillo->nombre }}</td>
                    <td>{{ $platillo->descripcion }}</td>
                    <td>S/.{{ number_format($platillo->precio, 2) }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $platillo->imagen) }}" alt="Imagen de {{ $platillo->nombre }}" width="50" height="50">
                    </td>
                    <td>{{ $platillo->categoria }}</td>
                    <td>
                        <span style="background-color: {{ $platillo->estado ? '#bfff00' : '#ff4d4d' }}; color: #000; padding: 5px 10px; border-radius: 5px;">
                            {{ $platillo->estado ? 'Disponible' : 'No disponible' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('platillos.edit', $platillo->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('platillos.destroy', $platillo->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este platillo?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
