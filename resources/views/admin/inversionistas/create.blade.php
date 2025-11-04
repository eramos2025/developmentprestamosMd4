@extends('adminlte::page')

@section('content_header')
    <h4>Nuevo Inversionista</h4>
@stop

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Ingrese nuevo Inversionista</h3>
            </div>

            <form action="{{ url('admin/inversionistas/create') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    {{-- ====== NAV TABS ====== --}}
                    <ul class="nav nav-tabs" id="config-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-datos-tab" data-toggle="tab" href="#tab-datos" role="tab" aria-controls="tab-datos" aria-selected="true">
                                <i class="fas fa-users-cog"></i> Datos Generales
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="tab-financiera-tab" data-toggle="tab" href="#tab-financiera" role="tab" aria-controls="tab-financiera" aria-selected="false">
                                <i class="fas fa-credit-card"></i> Información Financiera
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
                                            <input type="text" id="nro_documento" name="nro_documento" class="form-control" placeholder="Ingresa Número de documento">
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
                                            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingresa Nombres">
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
                                            <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Ingresa Apellidos">
                                        </div>
                                        @error('apellido')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>


{{-- Teléfono y Teléfono de Referencia (2 columnas) --}}
<div class="row">

    {{-- Estado Civil --}}
    <div class="col-md-4">
                    <div class="form-group">
                        <label for="estado_civil">Estado Civil</label><b> (*)</b>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-place-of-worship"></i>
                            </div>
                <select name="estado_civil" id="estado_civil" class="form-control">
                    <option value="">Seleccione...</option>
                    <option value="S">Soltero</option> 
                    <option value="C">Casado</option>
                    <option value="V">Viudo</option>
                    <option value="D">Divorciado</option>
                    <option value="E">Separado</option>
                    <option value="U">Unión de hecho</option>
                </select>
                        </div> 
                        @error('estado_civil')
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
                <input type="number" id="telefono" name="telefono" class="form-control"
                       placeholder="Ingresa Teléfono" >
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
                <input type="number" id="telefono_ref" name="telefono_ref" class="form-control"
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
                            <input type="email" id="email" name="email" class="form-control" placeholder="Ingresa tu correo">                                    
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
                <!--<input type="text" id="direccion" name="direccion" class="form-control" placeholder="Ingresa tu dirección">-->
                <textarea id="direccion" name="direccion" class="form-control" rows="2" placeholder="Ingresa tu dirección"></textarea>
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
                    <input type="text" id="departamento" name="departamento" class="form-control" placeholder="Ingresa tu Departamento">
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
                    <input type="text" id="provincia" name="provincia" class="form-control" placeholder="Ingresa tu Provincia">
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
                    <input type="text" id="distrito" name="distrito" class="form-control" placeholder="Ingresa tu Distrito">
                </div>
                @error('distrito')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

    </div>

{{-- Ocupación e Ingreso Mensual (2 columnas) --}}
<div class="row">


    {{-- Número de Cuenta Principal --}}
    <div class="col-md-6">
        <div class="form-group">
            <label for="nro_cuenta_principal">Número de Cuenta Principal</label><b> (*)</b>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-file-invoice-dollar"></i></span>
                </div>
                <input type="text" id="nro_cuenta_principal" name="nro_cuenta_principal" class="form-control"
                       placeholder="Ingresa tu Número de Cuenta Principal" >
            </div>
            @error('nro_cuenta_principal')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>    


    {{-- Ingreso Mensual --}}
    <div class="col-md-6">
        <div class="form-group">
            <label for="monto_inversion">Monto Aproximado de Inversión</label><b> (*)</b>
            <div class="input-group mb-3">
                <input type="text" id="monto_inversion" name="monto_inversion" class="form-control"
                placeholder="Ingresa un Monto Aproximado de Inversión" >
                <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                </div>
            </div>
            @error('monto_inversion')
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
                            <textarea id="comentarios" name="comentarios"  class="form-control" rows="2" placeholder="Ingresa Comentarios" ></textarea>
                        </div>
                        @error('comentarios')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror
                    </div>

                        </div>

                        {{-- ===== TAB 3: INFORMACIÓN FINANCIERA ===== --}}
                        <div class="tab-pane fade" id="tab-financiera" role="tabpanel" aria-labelledby="tab-financiera-tab">

    {{-- Contador (se genera automáticamente con JS) --}}    
    {{-- Contenedor de Cuentas Adicionales --}}
    <div id="cuentas-container">
        <div class="form-group cuenta-item">
            <label>Cuenta Adicional #1</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-file-invoice-dollar"></i></span>
                </div>
                <input type="text" 
                       name="nro_cuenta[]" 
                       class="form-control @error('nro_cuenta.0') is-invalid @enderror"
                       placeholder="Ej: 1234567890123456"
                       maxlength="20"
                       value="{{ old('nro_cuenta.0') }}"
                       oninput="this.value = this.value.replace(/\D/g, '')">
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger" onclick="eliminarCuenta(this)">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            @error('nro_cuenta.0')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <button type="button" class="btn btn-primary btn-sm" onclick="agregarCuenta()">
        <i class="fas fa-plus"></i> Agregar cuenta adicional
    </button>

                        </div>

                        {{-- ===== TAB 2: ARCHIVOS RELACIONADOS ===== --}}
                        <div class="tab-pane fade" id="tab-archivos" role="tabpanel" aria-labelledby="tab-archivos-tab">
                            <div class="form-group">
                                <label for="archivos">Archivos Relacionados</label>
                                
                                {{-- Botón personalizado para subir --}}
                                <div class="text-center p-4 border rounded" 
                                    style="background: #f8f9fa; cursor: pointer;"
                                    onclick="document.getElementById('archivos').click()">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-2"></i>
                                    <p class="mb-0">Haz clic aquí para seleccionar archivos</p>
                                    <small class="text-muted">JPG, PNG, PDF (máx. 5MB cada uno)</small>
                                </div>
                                
                                <input type="file" 
                                    class="d-none" 
                                    id="archivos" 
                                    name="archivos[]" 
                                    multiple
                                    accept=".jpg,.jpeg,.png,.pdf"
                                    onchange="mostrarArchivosConPreview(this)">
                                
                                {{-- Preview de archivos --}}
                                <div id="preview-archivos" class="row mt-3"></div>
                            </div>
                        </div>

                    </div> {{-- /tab-content --}}
                </div> {{-- /card-body --}}

                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                    <a href="{{ url('/admin/inversionistas') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@stop


@push('css')
<style>
.card {
    transition: transform 0.2s;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
</style>
@endpush

@push('js')
<script>

/* ============================================================
   GESTIÓN SIMPLIFICADA DE CUENTAS ADICIONALES - LARAVEL 11
   ============================================================ */

let contadorCuentas = 1;

// Crear nuevo campo de cuenta
function crearCampoCuenta() {
    contadorCuentas++;
    const div = document.createElement('div');
    div.classList.add('form-group', 'cuenta-item');
    
    div.innerHTML = `
        <label>Cuenta Adicional #${contadorCuentas}</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-file-invoice-dollar"></i></span>
            </div>
            <input type="text" 
                   name="nro_cuenta[]" 
                   class="form-control"
                   placeholder="Ej: 1234567890123456"
                   maxlength="20"
                   oninput="this.value = this.value.replace(/\\D/g, '')">
            <div class="input-group-append">
                <button type="button" class="btn btn-danger" onclick="eliminarCuenta(this)">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    `;
    
    return div;
}

// Agregar nueva cuenta
function agregarCuenta() {
    const contenedor = document.getElementById('cuentas-container');
    const total = contenedor.querySelectorAll('.cuenta-item').length;
    
    if (total >= 10) {
        alert('Máximo 10 cuentas adicionales permitidas');
        return;
    }
    
    contenedor.appendChild(crearCampoCuenta());
}

// Eliminar cuenta
function eliminarCuenta(boton) {
    const item = boton.closest('.cuenta-item');
    if (item) {
        item.remove();
        renumerarCuentas();
    }
}

// Renumerar etiquetas
function renumerarCuentas() {
    const cuentas = document.querySelectorAll('.cuenta-item');
    cuentas.forEach((cuenta, index) => {
        const label = cuenta.querySelector('label');
        if (label) {
            label.textContent = `Cuenta Adicional #${index + 2}`;
        }
    });
    contadorCuentas = cuentas.length + 1;
}

// Limpiar campos vacíos antes de enviar
function limpiarCamposVacios() {
    const inputs = document.querySelectorAll('input[name="nro_cuenta[]"]');
    inputs.forEach(input => {
        if (input.value.trim() === '') {
            const item = input.closest('.cuenta-item');
            if (item) item.remove();
        }
    });
}

// Inicializar
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function() {
            limpiarCamposVacios();
        });
    }
});


/* ============================================================
   FUNCIONES PARA MANEJAR CARGA DE ARCHIVOS
   ============================================================ */

function mostrarArchivosConPreview(input) {
    const preview = document.getElementById('preview-archivos');
    const files = input.files;
    
    if (files.length === 0) {
        preview.innerHTML = '';
        return;
    }
    
    preview.innerHTML = '';
    
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const size = (file.size / 1024 / 1024).toFixed(2);
        
        const col = document.createElement('div');
        col.className = 'col-md-2 col-sm-4 col-6 mb-3'; // Más columnas = más pequeño
        
        // Si es imagen, mostrar preview
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                col.innerHTML = `
                    <div class="card preview-card-small h-100">
                        <img src="${e.target.result}" class="card-img-top" style="height: 100px; object-fit: cover;">
                        <div class="card-body p-2">
                            <p class="mb-1 small text-truncate" style="font-size: 0.75rem;" title="${file.name}">${file.name}</p>
                            <p class="mb-0 text-muted" style="font-size: 0.7rem;">${size} MB</p>
                        </div>
                    </div>
                `;
            };
            reader.readAsDataURL(file);
        } else {
            // Si es PDF u otro
            const icon = file.type === 'application/pdf' ? 'fa-file-pdf text-danger' : 'fa-file text-secondary';
            col.innerHTML = `
                <div class="card preview-card-small h-100">
                    <div class="card-body text-center p-2">
                        <i class="fas ${icon}" style="font-size: 2.5rem;"></i>
                        <p class="mb-1 small text-truncate mt-2" style="font-size: 0.75rem;" title="${file.name}">${file.name}</p>
                        <p class="mb-0 text-muted" style="font-size: 0.7rem;">${size} MB</p>
                    </div>
                </div>
            `;
        }
        
        preview.appendChild(col);
    }
}
</script>
@endpush
