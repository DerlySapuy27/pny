@extends('adminlte::page')

@section('content_header')
    @include('head')
    <link rel="icon" type="image/png" href="{{ asset('../images/LOGOPNY.png') }}">

    <h1 class="m-0 text-dark"> Prestamo de Proyector PNY</h1>
@stop


@section('content')
  
<div class="card" style="width: 90%; margin-left: 60px; margin-top: 15px;"  >
  
    <div class="card-header d-flex justify-content-between aling-items-center">
        <button id="ModalpinterLoan" class="btn btn-success" data-toggle="modal" data-target="#ModalpinterLoanModal">
            <i class="fas fa-folder-plus"></i> Prestamo
        </button>
        
    </div>

    <div class="card-body">
        <table id="datatable" class="table table-striped shadow-lg mt-4"  style="width: 100%;">
            <thead>
                <tr>
                  <th>Identificacion</th>
                  <th>Nombre</th>
                  <th>Hora</th>
                  <th>Fecha</th>
                  <th>Motivo de solicitud</th>
                  <th>Estado de solicitud</th>
                <th>Acciones</th>
                </tr>                
             </thead>
             <tbody>
                <tr>
                  <td>1079508239</td>
                  <td>David Cadena</td>
                  <td>4:29 am</td>
                  <td>27/05/2024</td>
                  <td>capacitacion 3er piso</td>
                  <td>pendiente</td>
                  <td>
                        <button class="btn btn-success"> <i class="fas fa-eye">ㅤVer</i></button></td>      
                  </tr>
             </tbody>
        </table>
    </div>



    <div class="modal fade" id="ModalpinterLoanModal" tabindex="-1" aria-labelledby="ModalpinterLoanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="ModalpinterLoanModalLabel">Prestamo de Proyector</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="">
                        <div class="mb-3">
                            <label for="Cc" class="form-label">Ingrese numero de cedula</label>
                            <input id="Cc" class="form-control" type="number">
                        </div>      
                        <a href="" class="btn btn-primary">Agendar</a>
    
                    </form>
                </div>

            </div>
        </div>
    </div>



</div>









@include('alerts')




@include('datatable-script')
@stop

@section('js')
   

@stop
