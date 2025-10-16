@extends('adminlte::page')

@section('content_header')
    <h4>Editar Usuario</h4>
@stop

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2"> {{-- Centrado en la página --}}
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Modifique Usuario</h3>
            </div>

            <form action="{{ url('admin/usuarios', $usuario->id) }}" method="POST" >
                @csrf
                @method('PUT')

                <div class="card-body">

                    {{-- Rol --}}
                    <div class="form-group">
                        <label for="name">Nombre del Rol</label><b> (*)</b>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                            </div>
                            <!-- <input type="text" id="name" name="name" class="form-control" placeholder="Ingresa Nombre del Rol"> -->
                            <select name="rod" id="moneda" class="form-control">
                                @foreach ( $roles as $role )
                                       <option value="{{ $role->name}}" {{ $role->name == $usuario->roles->pluck('name')->implode(',') ? 'selected' : '' }} > {{ $role->name}} </option>                                
                                @endforeach
                            </select>
                        </div>
                        @error('rod_id')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror
                    </div>

                    {{-- Nombre --}}
                    <div class="form-group">
                        <label for="name">Nombre del Usuraio</label><b> (*)</b>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Ingresa Nombre del Rol"  value="{{ $usuario->name }}" >
                        </div>
                        @error('name')
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
                            <input type="email" id="email" name="email" class="form-control" placeholder="Introduce tu correo" value="{{ $usuario->email }}" >                                    
                        </div> 
                        @error('email')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror                               
                    </div>

                    {{-- Contraseña --}}
                    <div class="form-group">
                        <label for="name">Contraseña</label><b> (*)</b>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Ingresa tu Contraseña">
                        </div>
                        @error('password')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror
                    </div>

                    {{-- Re-Contraseña --}}
                    <div class="form-group">
                        <label for="name">Repetir Contraseña</label><b> (*)</b>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" id="password" name="password_confirmation" class="form-control" placeholder="Ingresa tu Contraseña">
                        </div>
                        @error('password')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror
                    </div>

                </div> {{-- /.card-body --}}

                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-success">Modificar</button>
                    <a href="{{ url('/admin/usuarios') }}" class="btn btn-secondary">Cancelar</a>
                </div>

            </form>
        </div>
    </div>
</div>

@stop

@push('css')
@endpush

@push('js')
@endpush