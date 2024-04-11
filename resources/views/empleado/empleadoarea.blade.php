@extends('adminlte::page')

@section('content_header')
    @include('head')
    <center>
        <h1 class="m-0 text-dark">LISTA DE EMPLEADOS {{ $area->name }}</h1>
    </center><br>
@stop

@section('content')
<div class="card" style="width: 90%; margin-left: 40px;">
    <!-- Lista de registros de Empleados -->
    <div class="card-body">
        <table id="datatable" class="table table-striped shadow-lg mt-4" style="width:100%">
            <thead>
                <tr>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th># Documento</th>
                    <th>Area</th>
                    <th>Cargo</th>
                    <th>ID ZKT</th>
                    <th>#Carnet</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($empleados as $empleado)
                    <tr>
                        <td>{{ $empleado->name }}</td>
                        <td>{{ $empleado->last_name }}</td>
                        <td>{{ $empleado->document_number }}</td>
                        <td>{{ $empleado->area->name }}</td>
                        <td>{{ $empleado->position->name }}</td>
                        <td>{{ $empleado->id_ZKT }}</td>
                        <td>{{ $empleado->license_number}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    <!-- Fin Lista de registros de Empleados -->
    @include('datatable-script')
@stop
