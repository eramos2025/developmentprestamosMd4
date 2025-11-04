@extends('adminlte::page')

@section('content_header')
    <h4>Inversionista | Datos Registrados</h4>
@stop

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Inversionista Registrado</h3>
            </div>

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
                                        <label for="nro_documento">Nro de Documento</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                            </div>
                                            <input type="text" id="nro_documento" name="nro_documento" class="form-control" value="{{ $inversionista->nro_documento }}" disabled placeholder="Ingresa Número de documento">
                                        </div>
                                        @error('nro_documento')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre">Nombres</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $inversionista->nombre }}" disabled placeholder="Ingresa Nombres">
                                        </div>
                                        @error('nombre')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="apellido">Apellidos</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input type="text" id="apellido" name="apellido" class="form-control" value="{{ $inversionista->apellido }}" disabled placeholder="Ingresa Apellidos">
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
                        <label for="estado_civil">Estado Civil</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-place-of-worship"></i>
                            </div>
                            <select name="estado_civil" id="estado_civil" class="form-control" disabled>
                                <option value="{{ $inversionista->estado_civil }}">
                                            @switch($inversionista->estado_civil)
                                                @case('S') Soltero @break
                                                @case('C') Casado @break
                                                @case('V') Viudo @break
                                                @case('D') Divorciado @break
                                                @case('E') Separado @break
                                                @case('U') Unión de hecho @break
                                            @endswitch
                                </option> 
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
                <input type="number" id="telefono" name="telefono" class="form-control" value="{{ $inversionista->telefono }}" disabled
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
                <input type="number" id="telefono_ref" name="telefono_ref" class="form-control" value="{{ $inversionista->telefono_ref }}" disabled
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
                            <input type="email" id="email" name="email" class="form-control" value="{{ $inversionista->email }}" disabled placeholder="Ingresa tu correo">                                    
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
                <textarea id="direccion" name="direccion" class="form-control" rows="2" placeholder="Ingresa tu dirección" disabled >{{ $inversionista->direccion }}</textarea>
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
                    <input type="text" id="departamento" name="departamento" class="form-control" value="{{ $inversionista->departamento }}" disabled placeholder="Ingresa tu Departamento">
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
                    <input type="text" id="provincia" name="provincia" class="form-control" value="{{ $inversionista->provincia }}" disabled placeholder="Ingresa tu Provincia">
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
                    <input type="text" id="distrito" name="distrito" class="form-control" value="{{ $inversionista->distrito }}" disabled placeholder="Ingresa tu Distrito">
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
                <input type="text" id="nro_cuenta_principal" name="nro_cuenta_principal" class="form-control" value="{{ $inversionista->nro_cuenta_principal }}" disabled
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
                <input type="text" id="monto_inversion" name="monto_inversion" class="form-control" value="{{ $inversionista->monto_inversion }}" disabled
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
                            <textarea id="comentarios" name="comentarios"  class="form-control" rows="2" placeholder="Ingresa Comentarios" disabled >{{ $inversionista->comentarios }}</textarea>
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

                            @if($inversionista->cuentas->count() > 0)
                                @foreach($inversionista->cuentas as $index => $cuenta)
                                <div class="form-group cuenta-item">
                                    <label>Cuenta Adicional #{{ $index + 1 }}</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-file-invoice-dollar"></i></span>
                                        </div>
                                        <input type="text" 
                                            class="form-control"
                                            maxlength="20"
                                            value="{{ $cuenta->nro_cuenta }}"
                                            disabled
                                            >
                                        <div class="input-group-append">
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="form-group cuenta-item">
                                    <label>Cuenta Adicional #0</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-file-invoice-dollar"></i></span>
                                        </div>
                                        <input type="text" 
                                            class="form-control"
                                            placeholder="No hay Cuentas Adicionales rgistradas"
                                            maxlength="20"
                                            disabled
                                            >
                                        <div class="input-group-append">
                                        </div>
                                    </div>
                                </div>

                            @endif
                            </div>
                        </div>

                        {{-- ===== TAB 2: ARCHIVOS RELACIONADOS ===== --}}
                        <div class="tab-pane fade" id="tab-archivos" role="tabpanel" aria-labelledby="tab-archivos-tab">

                            <div class="form-group">
                                <label for="archivos">Archivos Relacionados {{ $inversionista->archivos->count() }}</label>
                                
        @if($inversionista->archivos->count() > 0)
            <div class="row mt-3">
                @foreach($inversionista->archivos as $archivo)
                    @php
                        $extension = pathinfo($archivo->nombre, PATHINFO_EXTENSION);
                        $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
                        $isPdf = strtolower($extension) === 'pdf';
                    @endphp
                    
                    {{-- Columnas más pequeñas: col-md-2 en lugar de col-md-3 --}}
                    <div class="col-md-2 col-sm-4 col-6 mb-3">
                        <div class="card h-100 shadow-sm">
                            @if($isImage)
                                {{-- Preview de imagen reducido --}}
                                <img src="{{ asset('storage/' . $archivo->ruta) }}" 
                                     class="card-img-top" 
                                     style="height: 100px; object-fit: cover; cursor: pointer;"
                                     alt="{{ $archivo->nombre }}"
                                     onclick="verImagenGrande(this.src)">
                            @else
                                {{-- Icono reducido --}}
                                <div class="card-body text-center p-2" style="background: #f8f9fa; min-height: 100px; display: flex; align-items: center; justify-content: center;">
                                    @if($isPdf)
                                        <i class="fas fa-file-pdf text-danger" style="font-size: 2.5rem;"></i>
                                    @elseif(in_array(strtolower($extension), ['doc', 'docx']))
                                        <i class="fas fa-file-word text-primary" style="font-size: 2.5rem;"></i>
                                    @elseif(in_array(strtolower($extension), ['xls', 'xlsx']))
                                        <i class="fas fa-file-excel text-success" style="font-size: 2.5rem;"></i>
                                    @else
                                        <i class="fas fa-file text-secondary" style="font-size: 2.5rem;"></i>
                                    @endif
                                </div>
                            @endif
                            
                            {{-- Información del archivo con texto más pequeño --}}
                            <div class="card-body p-2">
                                <p class="mb-1 text-truncate" style="font-size: 0.75rem;" title="{{ $archivo->nombre }}">
                                    <i class="fas fa-file-alt text-muted"></i> 
                                    <strong>{{ $archivo->nombre }}</strong>
                                </p>
                                <p class="mb-0 text-muted" style="font-size: 0.7rem;">
                                    <i class="fas fa-hdd"></i> {{ $archivo->tamanio }}
                                </p>
                                <p class="mb-0 text-muted" style="font-size: 0.7rem;">
                                    <i class="fas fa-calendar"></i> {{ $archivo->created_at->format('d/m/Y') }}
                                </p>
                            </div>
                            
                            {{-- Botones más compactos --}}
                            <div class="card-footer p-1 text-center bg-light">
                                <a href="{{ asset('storage/' . $archivo->ruta) }}" 
                                   target="_blank" 
                                   class="btn btn-xs btn-primary"
                                   style="font-size: 0.7rem; padding: 0.25rem 0.5rem;"
                                   title="Ver archivo">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
                                
                                <a href="{{ asset('storage/' . $archivo->ruta) }}" 
                                   download="{{ $archivo->nombre }}"
                                   class="btn btn-xs btn-success"
                                   style="font-size: 0.7rem; padding: 0.25rem 0.5rem;"
                                   title="Descargar">
                                    <i class="fas fa-download"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center mt-3">
                <i class="fas fa-info-circle fa-2x mb-2"></i>
                <p class="mb-0">No hay archivos relacionados con este inversionista.</p>
            </div>
        @endif
                            </div>
                        </div>

{{-- Modal para ver imágenes grandes --}}
<div id="modalImagen" style="display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.9); z-index: 9999; cursor: pointer;" onclick="cerrarModal()">
    <div style="display: flex; align-items: center; justify-content: center; height: 100%; padding: 20px;">
        <img id="imagenGrande" src="" style="max-width: 90%; max-height: 90%; border-radius: 8px; box-shadow: 0 0 30px rgba(255,255,255,0.3);">
    </div>
    <button onclick="cerrarModal()" style="position: absolute; top: 20px; right: 20px; background: white; border: none; border-radius: 50%; width: 40px; height: 40px; font-size: 20px; cursor: pointer; box-shadow: 0 2px 10px rgba(0,0,0,0.3);">
        ×
    </button>
</div>

                    </div> {{-- /tab-content --}}
                </div> {{-- /card-body --}}

                <div class="card-footer text-center">
                    <a href="{{ url('/admin/inversionistas') }}" class="btn btn-info">Regresar</a>
                </div>



        </div>
    </div>
</div>
@stop


@push('css')
<style>
.card {
    transition: transform 0.2s, box-shadow 0.2s;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.15) !important;
}

/* Ajustes para tarjetas pequeñas */
.card-body p {
    line-height: 1.4;
}

/* Responsive: ajustar en móviles */
@media (max-width: 576px) {
    .card-body {
        font-size: 0.65rem !important;
    }
    
    .card-footer .btn {
        font-size: 0.6rem !important;
        padding: 0.2rem 0.4rem !important;
    }
}

/* Animación del modal */
#modalImagen {
    animation: fadeIn 0.2s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
</style>
@endpush

@push('js')
<script>
function verImagenGrande(src) {
    document.getElementById('imagenGrande').src = src;
    document.getElementById('modalImagen').style.display = 'block';
    document.body.style.overflow = 'hidden'; // Prevenir scroll
}

function cerrarModal() {
    document.getElementById('modalImagen').style.display = 'none';
    document.body.style.overflow = 'auto'; // Restaurar scroll
}

// Cerrar con tecla ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        cerrarModal();
    }
});

// Prevenir que el click en la imagen cierre el modal
document.getElementById('imagenGrande')?.addEventListener('click', function(e) {
    e.stopPropagation();
});
</script>
@endpush
