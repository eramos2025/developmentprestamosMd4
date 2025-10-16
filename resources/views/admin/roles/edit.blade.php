@extends('adminlte::page')

@section('content_header')
    <h4>Editar Rol</h4>
@stop

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2"> {{-- Centrado en la página --}}
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Modificar Rol</h3>
            </div>

            <form action="{{ url('admin/roles', $role->id) }}" method="POST" >
                @csrf
                @method('PUT')

                <div class="card-body">

                    {{-- Nombre --}}
                    <div class="form-group">
                        <label for="name">Nombre del Rol</label><b> (*)</b>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                            </div>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Ingresa Nombre del Rol" value="{{ $role->name }}">
                        </div>
                        @error('name')
                            <small style="color:red"> {{ $message }} </small>
                        @enderror
                    </div>

                </div> {{-- /.card-body --}}

                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-success">Modificar</button>
                    <a href="{{ url('/admin/roles') }}" class="btn btn-secondary">Cancelar</a>
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