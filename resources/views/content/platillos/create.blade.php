@extends('layouts/contentNavbarLayout')

@section('title', 'Vertical Layouts - Formulario de Platillo')

@section('content')
    <!-- Basic Layout -->
    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Formulario de Registro de Platillo</h5>
                    <small class="text-muted float-end">Ingrese los datos del platillo</small>
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

                    <form action="{{ route('platillos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf <!-- Token de protección CSRF -->

                        <!-- Campo para Nombre -->
                        <div class="mb-3">
                            <label class="form-label" for="nombre">Nombre del Platillo</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                value="{{ old('nombre') }}" placeholder="Ej. Hamburguesa Especial" />
                        </div>

                        <!-- Campo para Descripción -->
                        <div class="mb-3">
                            <label class="form-label" for="descripcion">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"
                                placeholder="Descripción breve del platillo">{{ old('descripcion') }}</textarea>
                        </div>

                        <!-- Campo para Precio -->
                        <div class="mb-3">
                            <label class="form-label" for="precio">Precio</label>
                            <input type="number" class="form-control" id="precio" name="precio"
                                value="{{ old('precio') }}" placeholder="Ej. 20.50" step="0.01" />
                        </div>

                        <!-- Campo para estado -->
                        <div class="mb-3">
                            <label class="form-label" for="estado">Estado</label>
                            <select class="form-control" id="estado" name="estado">
                                <option value="Disponible" {{ old('estado') == 'Disponible' ? 'selected' : '' }}>Disponible
                                </option>
                                <option value="No disponible" {{ old('estado') == 'No disponible' ? 'selected' : '' }}>No
                                    disponible</option>
                            </select>
                        </div>

                        <!-- Campo para Imagen -->
                        <div class="mb-3">
                            <label class="form-label" for="imagen">Imagen</label>
                            <input type="file" class="form-control" id="imagen" name="imagen" />
                        </div>

                        <!-- Campo para Categoría -->
                        <div class="mb-3">
                            <label class="form-label" for="categoria">Categoría</label>
                            <select class="form-control" id="categoria" name="categoria">
                                <option value="Sopa" {{ old('categoria') == 'Sopa' ? 'selected' : '' }}>Sopa</option>
                                <option value="Segundo" {{ old('categoria') == 'Segundo' ? 'selected' : '' }}>Segundo
                                </option>
                                <option value="Plato a la carta"
                                    {{ old('categoria') == 'Plato a la carta' ? 'selected' : '' }}>Plato a la carta</option>
                            </select>
                        </div>


                        <!-- Botón para enviar el formulario -->
                        <button type="submit" class="btn btn-primary">Registrar Platillo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
