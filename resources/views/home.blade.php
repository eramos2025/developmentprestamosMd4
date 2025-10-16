@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Página en construcción') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    <h3>Bienvenido, {{$usuario}} </h3>
                    <i class="fa-solid fa-user fa-2x text-primary"></i>
                    <i class="fa-brands fa-laravel fa-2x text-danger"></i>
                    <p>Estamos trabajando para mejorar tu experiencia.<br> ¡Vuelve pronto!</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
