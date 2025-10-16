@extends('adminlte::page')

@section('content_header')
    <h1>Configuración | Nuevo Registro</h1>
@stop

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Formulario de Registro por Secciones</h3>
    </div>

    <form action="{{ route('admin.configuracion.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card-body">
            
            <ul class="nav nav-tabs" id="config-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-datos-tab" data-toggle="tab" href="#tab-datos" role="tab" aria-controls="tab-datos" aria-selected="true">
                        <i class="fas fa-user"></i> Datos Generales
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-ubicacion-tab" data-toggle="tab" href="#tab-ubicacion" role="tab" aria-controls="tab-ubicacion" aria-selected="false">
                        <i class="fas fa-map-marker-alt"></i> Ubicación
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-logo-tab" data-toggle="tab" href="#tab-logo" role="tab" aria-controls="tab-logo" aria-selected="false">
                        <i class="fas fa-image"></i> Logo
                    </a>
                </li>
            </ul>

            <div class="tab-content mt-3" id="config-tabs-content">

                {{-- TAB 1: Datos Generales --}}
                <div class="tab-pane fade show active" id="tab-datos" role="tabpanel" aria-labelledby="tab-datos-tab">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese el nombre">
                        @error('nombre') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Ingrese una descripción">
                        @error('descripcion') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Ingrese el teléfono">
                        @error('telefono') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                {{-- TAB 2: Ubicación --}}
                <div class="tab-pane fade" id="tab-ubicacion" role="tabpanel" aria-labelledby="tab-ubicacion-tab">
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Ingrese la dirección">
                        @error('direccion') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Ingrese el correo">
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group">
                        <label for="web">Página Web</label>
                        <input type="text" name="web" id="web" class="form-control" placeholder="Ingrese la página web">
                    </div>
                </div>

                {{-- TAB 3: Logo --}}
                <div class="tab-pane fade" id="tab-logo" role="tabpanel" aria-labelledby="tab-logo-tab">
                    <div class="form-group">
                        <label for="logo">Logo</label>
                        <input type="file" name="logo" id="logo" accept=".jpg, .jpeg, .png" class="form-control">
                        @error('logo') <small class="text-danger">{{ $message }}</small> @enderror

                        <div class="mt-3 text-center">
                            <output id="preview"></output>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ url('/admin/configuraciones') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@stop

@push('css')
@endpush

@push('js')
<script>
    // Vista previa del logo
    document.getElementById('logo').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('preview').innerHTML =
                    `<img src="${e.target.result}" width="150" class="rounded shadow-sm">`;
            };
            reader.readAsDataURL(file);
        } else {
            document.getElementById('preview').innerHTML = '';
        }
    });
</script>
@endpush
