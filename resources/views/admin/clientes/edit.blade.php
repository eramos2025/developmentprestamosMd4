@extends('adminlte::page')

@section('content_header')
    <h4>Editar Cliente</h4>
@stop

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1"> {{-- Centrado en la página --}}
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Modificar Cliente</h3>
            </div>

            <form action="{{ url('admin/clientes', $cliente->id) }}" method="POST"  enctype="multipart/form-data">
                @csrf
                @method('PUT')
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
                        <i class="fas fa-image"></i> Adjuntos
                    </a>
                </li>
            </ul>

            <div class="tab-content mt-3" id="config-tabs-content">

                {{-- TAB 1: Datos Generales --}}
                <div class="tab-pane fade show active" id="tab-datos" role="tabpanel" aria-labelledby="tab-datos-tab">

{{-- Número de Documento y Logo en dos columnas --}}
<div class="row">
    {{-- Número de Documento --}}
    <div class="col-md-6">
        <div class="form-group">
            <label for="nro_documento">Número de Documento</label><b> (*)</b>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                </div>
                <input type="text" id="nro_documento" name="nro_documento" class="form-control" 
                value="{{ $cliente->nro_documento }}"
                placeholder="Ingresa Número de documento" >
            </div>
            @error('nro_documento')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    {{-- Foto --}}
    <div class="col-md-6">
        <div class="form-group text-center">
            <label for="foto">Foto</label><b> (*)</b>
            <input type="file" id="foto" name="foto" accept=".jpg, .jpeg, .png" class="form-control" >
            @error('foto')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="mt-3">
                            <output id="list">
                            <img src="{{ asset($cliente->foto =='images/default-avatar.png' ? 'images/default-avatar.png' : 'storage/'.$cliente->foto) }}" 
                                width="120px" 
                                alt="imagen">
                            </output>
            </div>
        </div>
    </div>
</div>


{{-- Nombres y Apellidos del Cliente (2 columnas) --}}
<div class="row">
    {{-- Nombres del Cliente --}}
    <div class="col-md-6">
        <div class="form-group">
            <label for="nombre">Nombres del Cliente</label><b> (*)</b>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" id="nombre" name="nombre" class="form-control" 
                value="{{ $cliente->nombre }}"
                       placeholder="Ingresa Nombres del Cliente">
            </div>
            @error('nombre')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    {{-- Apellidos del Cliente --}}
    <div class="col-md-6">
        <div class="form-group">
            <label for="apellido">Apellidos del Cliente</label><b> (*)</b>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" id="apellido" name="apellido" class="form-control" 
                value="{{ $cliente->apellido }}"
                       placeholder="Ingresa Apellidos del Cliente">
            </div>
            @error('apellido')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>

{{-- NUEVO: (En 2 columnas) --}}
<div class="row">
    {{-- Fecha de Nacimiento --}}
    <div class="col-md-6">
        <div class="form-group">
            <label for="fecha_nacimiento">Fecha de Nacimiento</label><b> (*)</b>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                </div>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control"
                value="{{ $cliente->fecha_nacimiento }}"
                    placeholder="Ingresa Fecha de Nacimiento">
            </div>
            @error('fecha_nacimiento') 
                <small class="text-danger">{{ $message }}</small> 
            @enderror
        </div>
    </div>

    {{-- Género --}}
    <div class="col-md-6">
        <div class="form-group">
            <label for="genero">Género</label><b> (*)</b>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                </div>
                <select name="genero" id="genero" class="form-control">
                    <option value="M" {{ $cliente->genero =='M' ? 'selected' : '' }}>Masculino</option> 
                    <option value="F" {{ $cliente->genero =='F' ? 'selected' : '' }}>Femenino</option> 
                </select>
            </div>
            @error('genero')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>


{{-- Teléfono y Teléfono de Referencia (2 columnas) --}}
<div class="row">
    {{-- Teléfono --}}
    <div class="col-md-6">
        <div class="form-group">
            <label for="telefono">Teléfono</label><b> (*)</b>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                </div>
                <input type="number" id="telefono" name="telefono" class="form-control"
                value="{{ $cliente->telefono }}"
                       placeholder="Ingresa Teléfono" >
            </div>
            @error('telefono')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    {{-- Teléfono de Referencia --}}
    <div class="col-md-6">
        <div class="form-group">
            <label for="telefono_ref">Teléfono de Referencia</label><b> (*)</b>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
                <input type="number" id="telefono_ref" name="telefono_ref" class="form-control"
                value="{{ $cliente->telefono_ref }}"
                       placeholder="Ingresa Teléfono de Referencia" >
            </div>
            @error('telefono_ref')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>


                    {{-- Correo electrónico --}}
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label><b> (*)</b>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" id="email" name="email" class="form-control" 
                            value="{{ $cliente->email }}"
                            placeholder="Introduce tu correo">                                    
                        </div> 
                        @error('email')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror                               
                    </div>

                    {{-- Dirección --}}
                    <div class="form-group">
                        <label for="direccion">Dirección</label><b> (*)</b>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-street-view"></i></span>
                            </div>
                            <input type="text" id="direccion" name="direccion" class="form-control" 
                            value="{{ $cliente->direccion }}"
                            placeholder="Ingresa tu dirección">
                        </div>
                        @error('direccion')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror
                    </div>

                    {{-- Número de Cuenta --}}
                    <div class="form-group">
                        <label for="direccion">Número de Cuenta</label><b> (*)</b>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-file-invoice-dollar"></i></span>
                            </div>
                            <input type="text" id="direccion" name="nro_cuenta" class="form-control" 
                            value="{{ $cliente->nro_cuenta }}"
                            placeholder="Ingresa tu Número de Cuenta">
                        </div>
                        @error('nro_cuenta')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror
                    </div>

{{-- Ocupación e Ingreso Mensual (2 columnas) --}}
<div class="row">
    {{-- Ocupación --}}
    <div class="col-md-6">
        <div class="form-group">
            <label for="ocupacion">Ocupación</label><b> (*)</b>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                </div>
                <input type="text" id="ocupacion" name="ocupacion" class="form-control"
                value="{{ $cliente->ocupacion }}"
                       placeholder="Ingresa tu Ocupación" >
            </div>
            @error('ocupacion')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    {{-- Ingreso Mensual --}}
    <div class="col-md-6">
        <div class="form-group">
            <label for="ing_mensual">Ingreso Mensual</label><b> (*)</b>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-coins"></i></span>
                </div>
                <input type="text" id="ing_mensual" name="ing_mensual" class="form-control"
                value="{{ $cliente->ing_mensual }}"
                       placeholder="Ingresa tu Ingreso Mensual" >
            </div>
            @error('ing_mensual')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>


                    {{-- Comentarios --}}
                    <div class="form-group">
                        <label for="direccion">Comentarios</label><b> (*)</b>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-clipboard"></i></span>
                            </div>
                            <input type="text" id="comentarios" name="comentarios" class="form-control" 
                            value="{{ $cliente->comentarios }}"
                            placeholder="Ingresa Comentarios">
                        </div>
                        @error('comentarios')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror
                    </div>

                </div>

                {{-- TAB 2: Ubicación --}}
                <div class="tab-pane fade" id="tab-ubicacion" role="tabpanel" aria-labelledby="tab-ubicacion-tab">

                    {{-- Pais --}}
                    <div class="form-group">
                        <label for="direccion">Pais</label><b> (*)</b>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-street-view"></i></span>
                            </div>
                            <input type="text" id="direccion" name="pais" class="form-control" placeholder="Ingresa tu Pais">
                        </div>
                        @error('pais')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror
                    </div>

                    {{-- Departamento --}}
                    <div class="form-group">
                        <label for="direccion">Departamento</label><b> (*)</b>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-street-view"></i></span>
                            </div>
                            <input type="text" id="direccion" name="departamento" class="form-control" placeholder="Ingresa tu Departamento">
                        </div>
                        @error('departamento')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror
                    </div>

                    {{-- Provincia --}}
                    <div class="form-group">
                        <label for="direccion">Provincia</label><b> (*)</b>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-street-view"></i></span>
                            </div>
                            <input type="text" id="provincia" name="provincia" class="form-control" placeholder="Ingresa tu Provincia">
                        </div>
                        @error('provincia')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror
                    </div>

                    {{-- Distrito --}}
                    <div class="form-group">
                        <label for="direccion">Distrito</label><b> (*)</b>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-street-view"></i></span>
                            </div>
                            <input type="text" id="provincia" name="distrito" class="form-control" placeholder="Ingresa tu Distrito">
                        </div>
                        @error('distrito')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror
                    </div>

                    {{-- Código Postal --}}
                    <div class="form-group">
                        <label for="direccion">Código Postal</label><b> (*)</b>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-street-view"></i></span>
                            </div>
                            <input type="text" id="provincia" name="codigo_postal" class="form-control" placeholder="Ingresa tu Código Postal">
                        </div>
                        @error('codigo_postal')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror
                    </div>


                </div>

                {{-- TAB 3: Archivos --}}
                <div class="tab-pane fade" id="tab-logo" role="tabpanel" aria-labelledby="tab-logo-tab">
                    <div class="form-group">
                        <label for="logo">Archivos Relacionados</label>
                        <input type="file" name="logo" id="logo" accept=".jpg, .jpeg, .png" class="form-control">
                        @error('logo') <small class="text-danger">{{ $message }}</small> @enderror

                        <div class="mt-3 text-center">
                            <output id="preview"></output>
                        </div>
                    </div>
                </div>
                {{-- TAB 3: Logo Fin--}}

            </div>

                </div> {{-- /.card-body --}}

                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-success">Modificar</button>
                    <a href="{{ url('/admin/clientes') }}" class="btn btn-secondary">Cancelar</a>
                </div>

            </form>
        </div>
    </div>
</div>


{{-- Script de vista previa --}}
<script>
    function mostrarVistaPrevia(event) {
        const files = event.target.files;
        const lista = document.getElementById('list');
        lista.innerHTML = '';

        for (const file of files) {
            if (!file.type.match('image.*')) continue;

            const reader = new FileReader();
            reader.onload = (e) => {
                lista.innerHTML = `<img src="${e.target.result}" class="img-fluid mt-2 rounded" style="max-width: 60%; border: 2px solid #ddd; padding: 5px;">`;
            };
            reader.readAsDataURL(file);
        }
    }

    document.getElementById('foto').addEventListener('change', mostrarVistaPrevia);
</script>
@stop

@push('css')
@endpush

@push('js')
@endpush