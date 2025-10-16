
@extends('adminlte::page')

{{-- Customize layout sections --}}

@section('content_header')
<h1>Bienvenido,  {{$usuario}} </h1> 
@stop

{{-- Content body: main page content --}}
@section('content')
    <!--<p>Welcome to this beautiful admin panel.</p>-->

<div class="row" style="padding-left: 5px;">
<div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$total_usuarios}}</h3>
                <p>Usuarios Registrados</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ url('/admin/usuarios') }}" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
</div>

@stop

{{-- Push extra CSS --}}
@push('css')

@endpush

{{-- Push extra scripts --}}
@push('js')

@endpush