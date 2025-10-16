@extends('adminlte::page')

@section('content_header')
    <h4>Datos del Usuario</h4>
@stop

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2"> {{-- Centrado en la página --}}
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Usuario</h3>
            </div>

                <div class="card-body">

                    {{-- Rol --}}
                    <div class="form-group">
                        <label for="name">Nombre del Rol</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                            </div>
                            <input type="text" id="name" name="rol" class="form-control" placeholder="Ingresa Nombre del Rol" value="{{ $usuario->roles->pluck('name')->implode(',') }}" disabled>
                        </div>
                        @error('rod_id')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror
                    </div>

                    {{-- Nombre --}}
                    <div class="form-group">
                        <label for="name">Nombre del Usuraio</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Ingresa Nombre del Rol" value="{{ $usuario->name }}" disabled>
                        </div>
                        @error('name')
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
                            <input type="email" id="email" name="email" class="form-control" placeholder="Introduce tu correo" value="{{ $usuario->email }}" disabled>
                        </div> 
                        @error('email')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror                               
                    </div>


                </div> {{-- /.card-body --}}

                <div class="card-footer text-center">
                    <a href="{{ url('/admin/usuarios') }}" class="btn btn-info">Regresar</a>
                </div>

        </div>
    </div>
</div>

@stop

@push('css')
@endpush

@push('js')
@endpush