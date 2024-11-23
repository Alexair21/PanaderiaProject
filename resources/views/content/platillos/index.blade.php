@extends('layouts/contentNavbarLayout')

@section('title', 'Platillos - Lista de Platillos')

@section('content')

<!-- Botón para crear un nuevo platillo -->
<div class="mb-4 text-end">
    <a href="{{ route('platillos.create') }}" class="btn btn-primary">Crear Platillo</a>
</div>

<!-- Grid de Cards para Platillos -->
<div class="row">
    @foreach ($platillos as $platillo)
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
            <!-- Imagen del platillo -->
            <img src="{{ asset('storage/' . $platillo->imagen) }}" class="card-img-top" alt="Imagen de {{ $platillo->nombre }}" style="height: 200px; object-fit: cover;">

            <div class="card-body">
                <!-- Categoría resaltada -->
                <span class="badge bg-primary" style="font-size: 0.9rem;">{{ $platillo->categoria }}</span>

                <!-- Nombre del platillo -->
                <h5 class="card-title mt-2">{{ $platillo->nombre }}</h5>

                <!-- Descripción -->
                <p class="card-text">{{ $platillo->descripcion }}</p>

                <!-- Estado con fondo dinámico -->
                <p class="card-text">
                    <strong>Estado:</strong>
                    <span style="background-color: {{ $platillo->estado ? '#bfff00' : '#ff4d4d' }}; color: #000; padding: 5px 10px; border-radius: 5px;">
                        {{ $platillo->estado ? 'Disponible' : 'No disponible' }}
                    </span>
                </p>

                <!-- Precio -->
                <p class="card-text"><strong>Precio:</strong> S/.{{ number_format($platillo->precio, 2) }}</p>

                <!-- Botones de acción -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('platillos.edit', $platillo->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('platillos.destroy', $platillo->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este platillo?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
