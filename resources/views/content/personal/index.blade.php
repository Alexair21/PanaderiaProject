@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')

<!-- Bootstrap Table with Header - Footer -->
<div class="card">
  <h5 class="card-header d-flex justify-content-between align-items-center">
    Lista de personal
    <!-- Botón para registrar nuevo alineado a la derecha -->
    <a href="{{ route('personal.create') }}" class="btn btn-primary">Registrar</a>
  </h5>

  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>Nombre y Apellidos</th>
          <th>Telefono</th>
          <th>Fecha nacimineto</th>
          <th>Fecha contrato</th>
          <th>Salario</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($personales as $personal)
        <tr>
          <td>{{ $personal->nombre }}</td>
          <td>{{ $personal->telefono }}</td>
          <td>{{ $personal->fecha_nacimiento }}</td>
          <td>{{ $personal->fecha_contrato }}</td>
          <td>S/.{{ $personal->salario }}</td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('personal.edit', $personal->id) }}"><i class="bx bx-edit-alt me-1"></i> Editar</a>
                <form action="{{ route('personal.destroy', $personal->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este registro?');">
                  @csrf
                  @method('DELETE')
                  <button class="dropdown-item" type="submit"><i class="bx bx-trash me-1"></i> Eliminar</button>
                </form>
              </div>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
      <tfoot class="table-border-bottom-0">
        <tr>
          <th>Nombre y Apellidos</th>
          <th>Telefono</th>
          <th>Fecha nacimineto</th>
          <th>Fecha contrato</th>
          <th>Salario</th>
          <th>Acciones</th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>

@endsection
