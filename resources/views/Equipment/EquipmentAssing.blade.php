@extends('adminlte::page')

@section('content_header')
    @include('head')
<center>  <br>  <h1 class="m-0 text-dark">Asignacion de equipos Piscícola New York</h1>
</center>
@stop
@section('content')


<!-- DataTable Equipments -->
  <div class="card" style="width: 90%; margin-left: 60px; margin-top: 15px;">
    <div class="card-header d-flex justify-content-between align-items-center">
        <button id="showRegisterEquipmentModalButton" class="btn btn-success">
            <i class="fas fa-folder-plus"></i> Asignar
        </button>
    </div>

    <!-- Equipment List -->
    <div class="card-body">
        <table id="datatable" class="table table-striped shadow-lg mt-4" style="width:100%;">
            <thead>
                <tr>
                    <th>Identificacion</th>
                    <th>Nombre</th>
                    <th>Area</th>
                    <th>Sede</th>
                    <th>Acciones</th>
                    
                </tr>
            </thead>
            <tbody>
              
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                                    <button class="btn btn-success">Vizualizar</button>|     
                                    <button class="btn btn-danger">Eliminar</button>                                     
                           </td>

                    </tr>
           
            </tbody>
        </table>
    </div>
    <!-- End Equipment List-->
</div>
  <!-- End DataTable Equipments -->

<!-- Register equipment modal -->
<div class="modal fade" id="RegisterEquipmentModal" tabindex="-1" aria-labelledby="RegisterEquipmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="RegisterEquipmentModalLabel">Registrar equipo</h5>
            </div>
            <div class="modal-body">
                    <form method="POST" action="">
                        @csrf
                       
                        
                    </form>
            </div>
        </div>
    </div>
</div>
<!-- End register equipment modal -->




@include('alerts')
@include('datatable-script')
@stop

@section('js')


@stop
