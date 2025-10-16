
@extends('adminlte::page')

@section('content_header')
    <h1>Configuración | Datos Registrados</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos Registrados</h3>
            </div>
                <div class="card-body">
                    <div class="row">
                        {{-- Columna izquierda --}}
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label><b> (*)</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-home"></i></span>
                                            </div>
                                            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $configuracion->nombre }}" placeholder="Ingresa Nombre" disabled>
                                        </div>
                                        @error('nombre')
                                            <small style="color:red"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="descripcion">Descripción</label><b> (*)</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                            </div>
                                            <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Ingresa una descripción breve">
                                        </div>
                                        @error('descripcion')
                                            <small style="color:red"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="direccion">Dirección</label><b> (*)</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-street-view"></i></span>
                                            </div>
                                            <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Ingresa tu dirección">
                                        </div>
                                        @error('direccion')
                                            <small style="color:red"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="telefono">Teléfono</label><b> (*)</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="number" id="telefono" name="telefono" class="form-control" placeholder="Ingresa Teléfono">
                                        </div>
                                        @error('telefono')
                                            <small style="color:red"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="ejemploInputEmail">Correo Electrónico</label><b> (*)</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                            <input type="email" id="email" name="email" class="form-control" placeholder="Introduce tu correo">                                    
                                        </div> 
                                        @error('email')
                                            <small style="color:red"> {{ $message }} </small>
                                        @enderror                               
                                    </div>
                                </div>                             
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="web">Página Web</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                            </div>
                                            <input type="text" id="web" name="web" class="form-control" placeholder="Ingresa Web">
                                        </div>
                                    </div>
                                </div>   
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="moneda">Moneda</label><b> (*)</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-coins"></i></span>
                                            </div>
                                            <select name="moneda" class="form-control">
                                                <option value="pen">Sol Peruano (PEN)</option> 
                                                <option value="usd">Dolar Estadounidense (USD) </option>
                                                <option value="eur">Euro (EUR)</option>
                                            </select>
                                        </div>
                                        @error('moneda')
                                            <small style="color:red"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>   
                            </div>    
                        </div>

                    {{-- Columna derecha (Logo) --}}
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="logo">Logo</label><b> (*)</b>
                            <input type="file" id="logo" name="logo" accept=".jpg, .jpeg, .png" class="form-control" required>

                            @error('logo')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <br>
                            <center>
                                <output id="list"></output>
                            </center>

                            <script>
                                function mostrarVistaPrevia(event) {
                                    const files = event.target.files; // Lista de archivos seleccionados
                                    const lista = document.getElementById('list');
                                    lista.innerHTML = ''; // Limpiar vistas previas anteriores

                                    for (let i = 0; i < files.length; i++) {
                                        const file = files[i];

                                        // Solo permitir imágenes
                                        if (!file.type.match('image.*')) {
                                            continue;
                                        }

                                        const reader = new FileReader();

                                        reader.onload = function(e) {
                                            const img = document.createElement('img');
                                            img.src = e.target.result;
                                            img.title = file.name;
                                            img.className = 'thumb thumbnail img-fluid mt-2';
                                            img.style.maxWidth = '70%';
                                            img.style.borderRadius = '8px';
                                            lista.innerHTML = ''; // Solo mostrar una imagen (logo)
                                            lista.appendChild(img);
                                        };

                                        reader.readAsDataURL(file);
                                    }
                                }

                                // Asignar evento al input file
                                document.getElementById('logo').addEventListener('change', mostrarVistaPrevia, false);
                            </script>
                        </div>
                    </div>
                    </div>
                </div>

             <div class="row">
                <div class="col-md-12">
                        <!-- <div class="card-footer text-right"> -->
                        <div class="card-footer form-group" >
                            <!-- <button type="reset" class="btn btn-danger">Limpiar</button> -->
                            <a href="{{ url('/admin/configuraciones') }}" class="btn btn-secondary">Regresar</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('css')
@endpush

@push('js')
<script>
    // $(document).ready(function() {
    //     $('#table1').DataTable();
    // });
</script>
@endpush





public function update(Request $request, Configuracion $configuracion)
{
    // Validación
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string|max:255',
        'direccion' => 'required|string|max:255',
        'telefono' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'web' => 'nullable|string|max:255',
        'moneda' => 'required|string|max:10',
        'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Actualiza los campos de texto
    $configuracion->nombre = $request->nombre;
    $configuracion->descripcion = $request->descripcion;
    $configuracion->direccion = $request->direccion;
    $configuracion->telefono = $request->telefono;
    $configuracion->email = $request->email;
    $configuracion->web = $request->web;
    $configuracion->moneda = $request->moneda;

    // Si se subió un nuevo logo
    if ($request->hasFile('logo')) {
        // Eliminar logo anterior si existe
        if ($configuracion->logo && Storage::disk('public')->exists($configuracion->logo)) {
            Storage::disk('public')->delete($configuracion->logo);
        }

        // Guardar nuevo logo
        $path = $request->file('logo')->store('logos', 'public');
        $configuracion->logo = $path;
    }

    // Guardar cambios
    $configuracion->save();

    // Redirigir con mensaje de éxito
    return redirect()->route('admin.configuracion.index')
        ->with('mensaje', 'Configuración modificada correctamente.')
        ->with('icono', 'success');
}
