@extends('layouts/contentNavbarLayout')

@section('title', 'Vertical Layouts - Forms')

@section('content')
<!-- Basic Layout -->
<div class="row justify-content-center">
  <div class="col-xl-8">
    <div class="card mb-6">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Formulario de Registro</h5>
        <small class="text-muted float-end">Ingrese los datos requeridos</small>
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

        <form action="{{ route('personal.store') }}" method="POST">
          @csrf <!-- Token de protección CSRF -->

          <!-- Agrupar Nombre y Apellidos con Teléfono en una fila -->
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label" for="nombre">Nombre y Apellidos</label>
              <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" placeholder="John Doe" />
            </div>
            <div class="col-md-6">
              <label class="form-label" for="telefono">Teléfono</label>
              <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}" placeholder="658 799 8941" />
            </div>
          </div>

          <!-- Agrupar Dirección con Email en una fila -->
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label" for="direccion">Dirección</label>
              <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion') }}" placeholder="1234 Main St" />
            </div>
            <div class="col-md-6">
              <label class="form-label" for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="example@example.com" />
            </div>
          </div>

          <!-- Agrupar Fecha de Nacimiento con Fecha de Contrato en una fila -->
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label" for="fecha_nacimiento">Fecha de Nacimiento</label>
              <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" />
            </div>
            <div class="col-md-6">
              <label class="form-label" for="fecha_contrato">Fecha de Contrato</label>
              <input type="date" class="form-control" id="fecha_contrato" name="fecha_contrato" value="{{ old('fecha_contrato') }}" />
            </div>
          </div>

          <!-- Campo individual para Salario -->
          <div class="mb-3">
            <label class="form-label" for="salario">Salario</label>
            <input type="number" class="form-control" id="salario" name="salario" value="{{ old('salario') }}" placeholder="5000" />
          </div>

          <!-- Botón para enviar el formulario -->
          <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
