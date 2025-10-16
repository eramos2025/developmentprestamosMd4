@extends('adminlte::page')

@section('content_header')
    <h4>Configuración | Editar</h4>
@stop

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2"> {{-- Centrado en la página --}}
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Modifica datos</h3>
            </div>

            <form action="{{ url('admin/configuraciones', $configuracion->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">

                    {{-- Nombre --}}
                    <div class="form-group">
                        <label for="nombre">Nombre</label><b> (*)</b>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-home"></i></span>
                            </div>
                            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $configuracion->nombre }}" placeholder="Ingresa Nombre">
                        </div>
                        @error('nombre')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror
                    </div>

                    {{-- Descripción --}}
                    <div class="form-group">
                        <label for="descripcion">Descripción</label><b> (*)</b>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                            </div>
                            <input type="text" id="descripcion" name="descripcion" class="form-control" value="{{ $configuracion->descripcion }}" placeholder="Ingresa una descripción breve">
                        </div>
                        @error('descripcion')
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
                            <input type="text" id="direccion" name="direccion" class="form-control" value="{{ $configuracion->direccion }}" placeholder="Ingresa tu dirección">
                        </div>
                        @error('direccion')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror
                    </div>

                    {{-- Teléfono --}}
                    <div class="form-group">
                        <label for="telefono">Teléfono</label><b> (*)</b>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="number" id="telefono" name="telefono" class="form-control" value="{{ $configuracion->telefono }}" placeholder="Ingresa Teléfono">
                        </div>
                        @error('telefono')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror
                    </div>

                    {{-- Correo electrónico --}}
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label><b> (*)</b>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" id="email" name="email" class="form-control" value="{{ $configuracion->email }}" placeholder="Introduce tu correo">                                    
                        </div> 
                        @error('email')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror                               
                    </div>

                    {{-- Página web --}}
                    <div class="form-group">
                        <label for="web">Página Web</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-globe"></i></span>
                            </div>
                            <input type="text" id="web" name="web" class="form-control" value="{{ $configuracion->web }}" placeholder="Ingresa tu página web">
                        </div>
                    </div>

                    {{-- Moneda --}}
                    <div class="form-group">
                        <label for="moneda">Moneda</label><b> (*)</b>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-coins"></i></span>
                            </div>
                            <select name="moneda" id="moneda" class="form-control">
                                <option value="pen" {{ $configuracion->moneda =='pen' ? 'selected' : '' }}>Sol Peruano (PEN)</option> 
                                <option value="usd" {{ $configuracion->moneda =='usd' ? 'selected' : '' }}>Dólar Estadounidense (USD)</option>
                                <option value="eur" {{ $configuracion->moneda =='eur' ? 'selected' : '' }}>Euro (EUR)</option>
                            </select>
                        </div>
                        @error('moneda')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror
                    </div>

                    {{-- Logo --}}
                    <div class="form-group text-center">
                        <label for="logo">Logo</label><b> (*)</b>
                        <input type="file" id="logo" name="logo" accept=".jpg, .jpeg, .png" class="form-control">
                        @error('logo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <div class="mt-3">
                            <output id="list">
                            <img src="{{ asset('storage/'.$configuracion->logo) }}" 
                                width="120px" 
                                alt="imagen">
                            </output>
                        </div>
                    </div>

                </div> {{-- /.card-body --}}

                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-success">Modificar</button>
                    <a href="{{ url('/admin/configuraciones') }}" class="btn btn-secondary">Cancelar</a>
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

    document.getElementById('logo').addEventListener('change', mostrarVistaPrevia);
</script>
@stop

@push('css')
@endpush

@push('js')
@endpush