@extends('layouts/contentNavbarLayout')

@section('title', 'Editar Platillo')

@section('content')

<!-- Formulario de edición de platillo -->
<div class="row justify-content-center">
  <div class="col-xl-8">
    <div class="card mb-6">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Editar Platillo</h5>
        <small class="text-muted float-end">Actualice los datos del platillo</small>
      </div>

      <div class="card-body">
        <!-- Mostrar mensajes de error -->
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <!-- Formulario para actualizar el platillo -->
        <form action="{{ route('platillos.update', $platillo->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <!-- Campo para Nombre -->
          <div class="mb-3">
            <label class="form-label" for="nombre">Nombre del Platillo</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $platillo->nombre) }}" />
          </div>

          <!-- Campo para Descripción -->
          <div class="mb-3">
            <label class="form-label" for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $platillo->descripcion) }}</textarea>
          </div>

          <!-- Campo para Precio -->
          <div class="mb-3">
            <label class="form-label" for="precio">Precio</label>
            <input type="number" class="form-control" id="precio" name="precio" value="{{ old('precio', $platillo->precio) }}" step="0.01" />
          </div>

          <!-- Campo para Imagen -->
          <div class="mb-3">
            <label class="form-label" for="imagen">Imagen</label>
            <input type="file" class="form-control" id="imagen" name="imagen" />
            <!-- Mostrar imagen actual -->
            @if ($platillo->imagen)
              <img src="{{ asset('storage/' . $platillo->imagen) }}" alt="Imagen actual de {{ $platillo->nombre }}" class="mt-2" width="100">
              <p class="text-muted">Imagen actual</p>
            @endif
          </div>

          <!-- Campo para Categoría -->
          <div class="mb-3">
            <label class="form-label" for="categoria">Categoría</label>
            <select class="form-control" id="categoria" name="categoria">
              <option value="Sopa" {{ old('categoria', $platillo->categoria) == 'Sopa' ? 'selected' : '' }}>Sopa</option>
              <option value="Segundo" {{ old('categoria', $platillo->categoria) == 'Segundo' ? 'selected' : '' }}>Segundo</option>
              <option value="Plato a la carta" {{ old('categoria', $platillo->categoria) == 'Plato a la carta' ? 'selected' : '' }}>Plato a la carta</option>
            </select>
          </div>

          <!-- Campo para Estado -->
          <div class="mb-3">
            <label class="form-label" for="estado">Estado</label>
            <select class="form-control" id="estado" name="estado">
              <option value="1" {{ old('estado', $platillo->estado) ? 'selected' : '' }}>Disponible</option>
              <option value="0" {{ !old('estado', $platillo->estado) ? 'selected' : '' }}>No disponible</option>
            </select>
          </div>

          <!-- Botón para actualizar -->
          <button type="submit" class="btn btn-primary">Actualizar</button>
          <a href="{{ route('platillos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
