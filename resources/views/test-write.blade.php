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
                    {{-- ====== NAV TABS ====== --}}
                    <ul class="nav nav-tabs" id="config-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-datos-tab" data-toggle="tab" href="#tab-datos" role="tab" aria-controls="tab-datos" aria-selected="true">
                                <i class="fas fa-users-cog"></i> Datos Generales
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-archivos-tab" data-toggle="tab" href="#tab-archivos" role="tab" aria-controls="tab-archivos" aria-selected="false">
                                <i class="fas fa-cloud-upload-alt"></i> Archivos Relacionados
                            </a>
                        </li>
                    </ul>

                    {{-- ====== CONTENIDO DE LAS PESTAÑAS ====== --}}
                    <div class="tab-content mt-3" id="config-tabs-content">

                        {{-- ===== TAB 1: DATOS GENERALES ===== --}}
                        <div class="tab-pane fade show active" id="tab-datos" role="tabpanel" aria-labelledby="tab-datos-tab">
                            
                            {{-- Número de Documento y Foto --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nro_documento">Nro de Documento</label><b> (*)</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                            </div>
                                            <input type="text" id="nro_documento" name="nro_documento" class="form-control" value="{{ $cliente->nro_documento }}"  placeholder="Ingresa Número de documento">
                                        </div>
                                        @error('nro_documento')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre">Nombres</label><b> (*)</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $cliente->nombre }}"  placeholder="Ingresa Nombres">
                                        </div>
                                        @error('nombre')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="apellido">Apellidos</label><b> (*)</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input type="text" id="apellido" name="apellido" class="form-control" value="{{ $cliente->apellido }}"  placeholder="Ingresa Apellidos">
                                        </div>
                                        @error('apellido')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>


{{-- Teléfono y Teléfono de Referencia (2 columnas) --}}
<div class="row">

    {{-- Correo electrónico --}}
    <div class="col-md-4">
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label><b> (*)</b>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" id="email" name="email" class="form-control" value="{{ $cliente->email }}"  placeholder="Introduce tu correo">                                    
                        </div> 
                        @error('email')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror                               
                    </div>

    </div>    

    {{-- Teléfono --}}
    <div class="col-md-4">
        <div class="form-group">
            <label for="telefono">Teléfono</label><b> (*)</b>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                </div>
                <input type="number" id="telefono" name="telefono" class="form-control" value="{{ $cliente->telefono }}"  placeholder="Ingresa Teléfono" >
            </div>
            @error('telefono')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    {{-- Teléfono de Referencia --}}
    <div class="col-md-4">
        <div class="form-group">
            <label for="telefono_ref">Teléfono de Referencia</label><b> (*)</b>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
                <input type="number" id="telefono_ref" name="telefono_ref" class="form-control" value="{{ $cliente->telefono_ref }}"  placeholder="Ingresa Teléfono de Referencia" >
            </div>
            @error('telefono_ref')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

</div>


            {{-- Dirección --}}
        <div class="form-group">
            <label for="direccion">Dirección</label><b> (*)</b>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-street-view"></i></span>
                </div>
                <!--<input type="text" id="direccion" name="direccion" class="form-control" placeholder="Ingresa tu dirección">-->
                <textarea id="direccion" name="direccion" class="form-control" rows="2" placeholder="Ingresa tu dirección" >{{ $cliente->direccion }}</textarea>
            </div>
            @error('direccion')
                <small style="color:red"> {{ $message }} </small>
            @enderror
        </div>


    {{-- País y Departamento (2 columnas) --}}
    <div class="row">

        {{-- Departamento --}}
        <div class="col-md-4">
            <div class="form-group">
                <label for="departamento">Departamento</label><b> (*)</b>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-map"></i></span>
                    </div>
                    <input type="text" id="departamento" name="departamento" class="form-control" value="{{ $cliente->departamento }}" placeholder="Ingresa tu Departamento">
                </div>
                @error('departamento')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        {{-- Provincia --}}
        <div class="col-md-4">
            <div class="form-group">
                <label for="provincia">Provincia</label><b> (*)</b>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-map-marked"></i></span>
                    </div>
                    <input type="text" id="provincia" name="provincia" class="form-control" value="{{ $cliente->provincia }}" placeholder="Ingresa tu Provincia">
                </div>
                @error('provincia')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        {{-- Distrito --}}
        <div class="col-md-4">
            <div class="form-group">
                <label for="distrito">Distrito</label><b> (*)</b>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                    </div>
                    <input type="text" id="distrito" name="distrito" class="form-control" value="{{ $cliente->distrito }}" placeholder="Ingresa tu Distrito">
                </div>
                @error('distrito')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

    </div>

{{-- Ocupación e Ingreso Mensual (2 columnas) --}}
<div class="row">
    {{-- Ocupación --}}
    <div class="col-md-6">
        <div class="form-group">
            <label for="ocupacion">Ocupación</label><b> (*)</b>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-id-badge"></i></span>
                </div>
                <input type="text" id="ocupacion" name="ocupacion" class="form-control" value="{{ $cliente->ocupacion }}" placeholder="Ingresa tu Ocupación" >
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
                <input type="text" id="ing_mensual" name="ing_mensual" class="form-control" value="{{ $cliente->ing_mensual }}" placeholder="Ingresa tu Ingreso Mensual" >
                <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                </div>
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
                            <!--<input type="text" id="comentarios" name="comentarios" class="form-control" placeholder="Ingresa Comentarios">-->
                            <textarea id="comentarios" name="comentarios"  class="form-control" rows="2" placeholder="Ingresa Comentarios" >{{ $cliente->comentarios }}</textarea>
                        </div>
                        @error('comentarios')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror
                    </div>

                        </div>

                        {{-- ===== TAB 2: ARCHIVOS RELACIONADOS ===== --}}
                        <div class="tab-pane fade" id="tab-archivos" role="tabpanel" aria-labelledby="tab-archivos-tab">
                            <div class="form-group">
                                <label for="logo">Archivos Relacionados</label>
                                <input type="file" name="logo" id="logo" accept=".jpg, .jpeg, .png" class="form-control">
                                @error('logo')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="mt-3 text-center">
                                    <output id="preview"></output>
                                </div>
                            </div>
                        </div>

                    </div> {{-- /tab-content --}}
                </div> {{-- /card-body --}}



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

    //document.getElementById('foto').addEventListener('change', mostrarVistaPrevia);
</script>
@stop

@push('css')
@endpush

@push('js')
@endpush