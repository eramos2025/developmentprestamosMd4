@extends('adminlte::page')

{{-- Customize layout sections --}}

@section('content_header')
<h1>Configuraciones</h1>
@stop

{{-- Content body: main page content --}}
@section('content')
    <!--<p>Welcome to this beautiful admin panel.</p>-->

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Configuraciones registrados</h3>
            <div class="card-tools">
                <a href="{{ url('/admin/configuraciones/create') }}" class="btn btn-primary"> Crear nuevo</a> 
            </div>
            <!-- /.card-tools -->
        </div>
 <!-- /.card-header -->
<div class="card-body">
    <table id="table1" class="table table-bordered table-hover table-striped table-sm">
       <thead>
        <tr class="thead-dark">
            <th>Nro</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Direccion</th>
            <th>Telefono</th>
            <th>Email</th>
            <!--<th>Web</th>-->
            <th>Moneda</th>
            <th>Logo</th>
            <th>Accion</th>
        </tr>
       </thead>
       @php
           $contador = 1;
       @endphp
    <tbody>
    @foreach ($configuraciones as $configuracion)
        <tr>
            <td>{{ $contador++ }} </td>
            <td>{{ $configuracion->nombre }} </td>
            <td>{{ $configuracion->descripcion }} </td>
            <td>{{ $configuracion->direccion }} </td>
            <td>{{ $configuracion->telefono }} </td>
            <td>{{ $configuracion->email }} </td>
            <!--<td>{{ $configuracion->web }} </td>-->
            <td>{{ $configuracion->moneda }} </td>
            <td style="text-align: center">
                <img src="{{ asset('storage/'.$configuracion->logo) }}" width="25px" alt="imagen" >
            </td>
            <!-- Botones de Acciones CRUD ... -->
            <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                    {{-- Ver --}}
                    <a href="{{ url('/admin/configuraciones/'.$configuracion->id) }}" class="btn btn-info btn-sm">
                        <i class="fa fa-eye"></i>
                    </a>

                    {{-- Editar --}}
                    <a href="{{ url('/admin/configuraciones/'.$configuracion->id . '/edit') }}" class="btn btn-success btn-sm">
                        <i class="fa fa-pencil-alt"></i>
                    </a>

                    {{-- Eliminar --}}
                    <form action="{{ url('/admin/configuraciones/'.$configuracion->id) }}" method="POST" id="miFormulario{{ $configuracion->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="preguntar{{ $configuracion->id }}(event)">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </div>

                <script>
                    function preguntar{{ $configuracion->id }}(event) {
                        event.preventDefault();
                        Swal.fire({
                            title: '¿Desea eliminar este registro?',
                            text: '',
                            icon: 'question',
                            showDenyButton: true,
                            confirmButtonText: 'Eliminar',
                            confirmButtonColor: '#dc3545',
                            denyButtonColor: '#6c757d',
                            denyButtonText: 'Cancelar',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('miFormulario{{ $configuracion->id }}').submit();
                            }
                        });
                    }
                </script>
            </td>

        </tr>
    @endforeach
    </tbody>
    </table>
</div>

        </div>
    </div>
</div>



@stop




{{-- Push extra CSS --}}
@push('css')
<style>
/* Fondo transparente y sin borde en el contenedor de botones */
#table1_wrapper .dt-buttons {
    background-color: transparent;
    box-shadow: none;
    border: none;
    display: flex;
    justify-content: center; /* Centra los botones */
    gap: 10px;               /* Espaciado entre botones */
    margin-bottom: 15px;     /* Separa los botones de la tabla */
}

/* Estilo general de los botones */
#table1_wrapper .btn {
    color: #fff;             /* Texto blanco */
    border-radius: 4px;      /* Bordes redondeados */
    padding: 6px 14px;       /* Espaciado interno */
    font-size: 14px;         /* Tamaño de fuente */
    transition: all 0.2s ease-in-out; /* Efecto suave */
}

/* Colores personalizados por tipo de botón */
.btn-danger  { background-color: #dc3545; border: none; }
.btn-success { background-color: #28a745; border: none; }
.btn-info    { background-color: #17a2b8; border: none; }
.btn-warning { background-color: #ffc107; color: #212529; border: none; }
.btn-default { background-color: #6c757d; color: #fff; border: none; }

/* Efecto hover para todos los botones */
#table1_wrapper .btn:hover {
    opacity: 0.85;
    transform: translateY(-1px);
}
</style>
@endpush



{{-- Push extra scripts --}}
@push('js')
<script>
/*
    $(document).ready(function() {
        $('#table1').DataTable();
    });
*/

$(function () {
    $("#table1").DataTable({
        pageLength: 5,
        language: {
            emptyTable: "No hay información",
            info: "Mostrando _START_ a _END_ de _TOTAL_ configuraciones",
            infoEmpty: "Mostrando 0 a 0 de 0 configuraciones",
            infoFiltered: "(filtrado de _MAX_ configuraciones totales)",
            lengthMenu: "Mostrar _MENU_ configuraciones",
            loadingRecords: "Cargando...",
            processing: "Procesando...",
            search: "Buscador:",
            zeroRecords: "Sin resultados encontrados",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            }
        },
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        buttons: [
            { text: '<i class="fa fa-copy"></i> COPIAR', extend: 'copy', className: 'btn btn-default' },
            { text: '<i class="fa fa-file-pdf"></i> PDF', extend: 'pdf', className: 'btn btn-danger' },
            { text: '<i class="fa fa-file-csv"></i> CSV', extend: 'csv', className: 'btn btn-info' },
            { text: '<i class="fa fa-file-excel"></i> EXCEL', extend: 'excel', className: 'btn btn-success' },
            { text: '<i class="fa fa-print"></i> IMPRIMIR', extend: 'print', className: 'btn btn-warning' }
        ]
    }).buttons().container().appendTo('#table1_wrapper .col-md-6:eq(0)');
});
</script>
@endpush
