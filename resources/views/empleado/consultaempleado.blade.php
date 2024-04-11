@extends('adminlte::page')

@section('content_header')
    @include('head')
    <center>
        <h1 class="m-0 text-dark">Consulta de Empleados</h1>
    </center><br>
@stop

@section('content')

<style>
    /* Estilo para el fondo de las tarjetas */
    .custom-card {
        background: linear-gradient(to bottom, #a6c0fe, #d0e4fe);
        color: black; /* Texto negro para un contraste adecuado */
        cursor: pointer; /* Cambia el cursor al pasar sobre la tarjeta */
    }
</style>

<div class="row">
    @foreach($areas as $area)
        <div class="col-md-4">
            <div class="card mb-4 custom-card" onclick="mostrarEmpleados({{ $area->id }})">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">{{ $area->name }}</h5>
                </div>
                <div class="card-body">
                    <!-- Aquí puedes agregar más detalles del área si lo necesitas -->
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Script para manejar el clic en las tarjetas y mostrar empleados -->
<script>
    function mostrarEmpleados(areaId) {
        $.ajax({
            url: '/employee/empleadosporarea/' + areaId,
            type: 'GET',
            success: function(response) {
                // Redireccionar a la página de empleados con la lista obtenida
                window.location.href = '/employee/empleadoarea/' + areaId;
            },
            error: function(xhr, status, error) {
                console.error(error);
                // Mostrar mensaje de error o manejar el error de otra forma
            }
        });
    }
</script>

@stop
