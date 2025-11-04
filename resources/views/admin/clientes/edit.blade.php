@extends('adminlte::page')

@section('content_header')
   <h4>Editar Cliente</h4>
@stop

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1">
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
                                            <input type="text" id="nro_documento" name="nro_documento" class="form-control" value="{{ $cliente->nro_documento }}" placeholder="Ingresa Número de documento">
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
                                            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $cliente->nombre }}" placeholder="Ingresa Nombres">
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
                                            <input type="text" id="apellido" name="apellido" class="form-control" value="{{ $cliente->apellido }}" placeholder="Ingresa Apellidos">
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
                            <input type="email" id="email" name="email" class="form-control" value="{{ $cliente->email }}" placeholder="Introduce tu correo">                                    
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
                <input type="number" id="telefono" name="telefono" class="form-control" value="{{ $cliente->telefono }}"
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
                <input type="number" id="telefono_ref" name="telefono_ref" class="form-control" value="{{ $cliente->telefono_ref }}"
                       placeholder="Ingresa Teléfono de Referencia" >
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
                <textarea id="direccion" name="direccion" class="form-control" rows="2" placeholder="Ingresa tu dirección">{{ $cliente->direccion }}</textarea>
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
                <input type="text" id="ocupacion" name="ocupacion" class="form-control" value="{{ $cliente->ocupacion }}"
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
                <input type="text" id="ing_mensual" name="ing_mensual" class="form-control" value="{{ $cliente->ing_mensual }}"
                placeholder="Ingresa tu Ingreso Mensual" >
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
    
    {{-- ARCHIVOS EXISTENTES --}}
    @if($cliente->archivos->count() > 0)
        <div class="mb-4">
            <label>Archivos Actuales ({{ $cliente->archivos->count() }})</label>
            <div class="row mt-2">
                @foreach($cliente->archivos as $archivo)
                    @php
                        $extension = pathinfo($archivo->nombre, PATHINFO_EXTENSION);
                        $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
                        $isPdf = strtolower($extension) === 'pdf';
                    @endphp
                    
                    <div class="col-md-2 col-sm-4 col-6 mb-3" id="archivo-{{ $archivo->id }}">
                        <div class="card h-100 shadow-sm">
                            @if($isImage)
                                <img src="{{ asset('storage/' . $archivo->ruta) }}" 
                                     class="card-img-top" 
                                     style="height: 100px; object-fit: cover; cursor: pointer;"
                                     alt="{{ $archivo->nombre }}"
                                     onclick="verImagenGrande(this.src)">
                            @else
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
                            
                            <div class="card-body p-2">
                                <p class="mb-1 text-truncate" style="font-size: 0.75rem;" title="{{ $archivo->nombre }}">
                                    <strong>{{ $archivo->nombre }}</strong>
                                </p>
                                <p class="mb-0 text-muted" style="font-size: 0.7rem;">
                                    <i class="fas fa-hdd"></i> {{ $archivo->tamanio }}
                                </p>
                            </div>
                            
                            <div class="card-footer p-1 text-center bg-light">
                                <a href="{{ asset('storage/' . $archivo->ruta) }}" 
                                   target="_blank" 
                                   class="btn btn-xs btn-primary"
                                   style="font-size: 0.7rem; padding: 0.25rem 0.5rem;"
                                   title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                <button type="button" 
                                        onclick="eliminarArchivo({{ $archivo->id }})"
                                        class="btn btn-xs btn-danger"
                                        style="font-size: 0.7rem; padding: 0.25rem 0.5rem;"
                                        title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <hr>
    @endif
    
    {{-- AGREGAR NUEVOS ARCHIVOS --}}
    <div class="form-group">
        <label for="archivos">Agregar Nuevos Archivos</label>
        
        <div class="text-center p-4 border rounded" 
            style="background: #f8f9fa; cursor: pointer;"
            onclick="document.getElementById('archivos').click()">
            <i class="fas fa-cloud-upload-alt fa-3x text-success mb-2"></i>
            <p class="mb-0">Haz clic aquí para seleccionar archivos nuevos</p>
            <small class="text-muted">JPG, PNG, PDF (máx. 5MB cada uno)</small>
        </div>
        
        <input type="file" 
            class="d-none" 
            id="archivos" 
            name="archivos[]" 
            multiple
            accept=".jpg,.jpeg,.png,.pdf"
            onchange="mostrarArchivosConPreview(this)">
        
        {{-- Preview de nuevos archivos --}}
        <div id="preview-archivos" class="row mt-3"></div>
    </div>
</div>

{{-- Modal para ver imágenes grandes --}}
<div id="modalImagen" style="display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.9); z-index: 9999; cursor: pointer;" onclick="cerrarModal()">
    <div style="display: flex; align-items: center; justify-content: center; height: 100%; padding: 20px;">
        <img id="imagenGrande" src="" style="max-width: 90%; max-height: 90%; border-radius: 8px;">
    </div>
    <button onclick="cerrarModal()" style="position: absolute; top: 20px; right: 20px; background: white; border: none; border-radius: 50%; width: 40px; height: 40px; font-size: 20px; cursor: pointer;">
        ×
    </button>
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
// Mostrar preview de archivos nuevos
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
        col.className = 'col-md-2 col-sm-4 col-6 mb-3';
        
        // Si es imagen, mostrar preview
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                col.innerHTML = `
                    <div class="card h-100 border-success">
                        <div class="badge badge-success" style="position: absolute; top: 5px; right: 5px; z-index: 1;">NUEVO</div>
                        <img src="${e.target.result}" class="card-img-top" style="height: 100px; object-fit: cover;">
                        <div class="card-body p-2">
                            <p class="mb-1 text-truncate" style="font-size: 0.75rem;" title="${file.name}">${file.name}</p>
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
                <div class="card h-100 border-success">
                    <div class="badge badge-success" style="position: absolute; top: 5px; right: 5px; z-index: 1;">NUEVO</div>
                    <div class="card-body text-center p-2">
                        <i class="fas ${icon}" style="font-size: 2.5rem;"></i>
                        <p class="mb-1 text-truncate mt-2" style="font-size: 0.75rem;" title="${file.name}">${file.name}</p>
                        <p class="mb-0 text-muted" style="font-size: 0.7rem;">${size} MB</p>
                    </div>
                </div>
            `;
        }
        
        preview.appendChild(col);
    }
}

// Eliminar archivo existente
function eliminarArchivo(archivoId) {
    if (!confirm('¿Estás seguro de eliminar este archivo?')) {
        return;
    }
    
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    fetch(`/admin/clientes/archivos/${archivoId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': token,
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Eliminar visualmente el archivo
            const elemento = document.getElementById(`archivo-${archivoId}`);
            if (elemento) {
                elemento.style.transition = 'opacity 0.3s';
                elemento.style.opacity = '0';
                setTimeout(() => elemento.remove(), 300);
            }
            
            // Mostrar mensaje
            mostrarAlerta('Archivo eliminado correctamente', 'success');
        } else {
            mostrarAlerta('Error al eliminar el archivo', 'danger');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        mostrarAlerta('Error al eliminar el archivo', 'danger');
    });
}

// Ver imagen grande
function verImagenGrande(src) {
    document.getElementById('imagenGrande').src = src;
    document.getElementById('modalImagen').style.display = 'block';
    document.body.style.overflow = 'hidden';
}

// Cerrar modal
function cerrarModal() {
    document.getElementById('modalImagen').style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Mostrar alerta temporal
function mostrarAlerta(mensaje, tipo) {
    const alerta = document.createElement('div');
    alerta.className = `alert alert-${tipo} alert-dismissible fade show`;
    alerta.style.cssText = 'position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    alerta.innerHTML = `
        ${mensaje}
        <button type="button" class="close" onclick="this.parentElement.remove()">
            <span>&times;</span>
        </button>
    `;
    document.body.appendChild(alerta);
    
    setTimeout(() => alerta.remove(), 3000);
}

// Cerrar modal con ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        cerrarModal();
    }
});
</script>
@endpush