@extends('adminlte::page')

@section('content_header')
    <h4>Configuración | Datos Registrados</h4>
@stop

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2"> {{-- Centrado en la página --}}
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos Registrados</h3>
            </div>

                <div class="card-body">

                    {{-- Nombre --}}
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-home"></i></span>
                            </div>
                            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingresa Nombre" value="{{ $configuracion->nombre }}" disabled>
                        </div>
                        @error('nombre')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror
                    </div>

                    {{-- Descripción --}}
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                            </div>
                            <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Ingresa una descripción breve" value="{{ $configuracion->descripcion }}" disabled>
                        </div>
                        @error('descripcion')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror
                    </div>

                    {{-- Dirección --}}
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-street-view"></i></span>
                            </div>
                            <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Ingresa tu dirección" value="{{ $configuracion->direccion }}" disabled>
                        </div>
                        @error('direccion')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror
                    </div>

                    {{-- Teléfono --}}
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="number" id="telefono" name="telefono" class="form-control" placeholder="Ingresa Teléfono" value="{{ $configuracion->telefono }}" disabled>
                        </div>
                        @error('telefono')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror
                    </div>

                    {{-- Correo electrónico --}}
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Introduce tu correo" value="{{ $configuracion->email }}" disabled>
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
                            <input type="text" id="web" name="web" class="form-control" placeholder="Ingresa tu página web" value="{{ $configuracion->web }}" disabled>
                        </div>
                    </div>

                    {{-- Moneda --}}
                    <div class="form-group">
                        <label for="moneda">Moneda</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-coins"></i></span>
                            </div>
                            <select name="moneda" id="moneda" class="form-control" disabled>
                                <option value="{{ $configuracion->moneda }}">{{ $configuracion->moneda }}</option> 
                            </select>
                        </div>
                        @error('moneda')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror
                    </div>

                    {{-- Logo --}}
                    <div class="form-group text-center">
                        <div>
                            <img src="{{ asset('storage/'.$configuracion->logo) }}" 
                                width="120px" 
                                alt="Logo de la empresa"
                                style="display: block; margin: 0 auto 8px; border-radius: 8px;">
                        </div>

                        <label for="logo" style="display: block; font-weight: bold;">Logo</label>

                        @error('logo')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>

                </div> {{-- /.card-body --}}

                <div class="card-footer text-center">

                    <a href="{{ url('/admin/configuraciones') }}" class="btn btn-secondary">Regresar</a>
                </div>

        </div>
    </div>
</div>


@stop

@push('css')
@endpush

@push('js')
@endpush