@extends('adminlte::page')

@section('content_header')
    @include('head')
    <center>
        <h1 class="m-0 text-dark">Vista Previa de Carnets</h1>
    </center>
@stop

@section('content')
    <div class="container print-employee-container">
        <div id="employee-details-container" class="employee-container">
            <div class="row">
                @if (is_array($selectedEmployeeDetails) && count($selectedEmployeeDetails) > 0)
                    @foreach ($selectedEmployeeDetails as $index => $employee)
                        <div class="col-md-4 mb-0"> <!-- Reducir espacio entre tarjetas a cero -->
                            <div class="employee-card"> <!-- Conservar la clase original -->
                                @php
                                    $imagePath = request('imagePath') ? request('imagePath') . '/' : 'storage/';
                                @endphp
                                <center>
                                    <img class="employee-image" src="{{ url($imagePath . $employee['signature']) }}"
                                        alt="Fotografía">
                                </center>
                                <center><p class="name-last-name">{{ $employee['name'] }}</p></center>
                                <center><p class="name-last-name">{{ $employee['last_name'] }}</p></center>
                                <center><p class="position">{{ $employee['position'] }}</p></center>
                                <div class="document-container">
                                    <span class="document-label">C.C</span>
                                    <span class="document-number">{{ $employee['document_number'] ?? 'N/A' }}</span>
                                </div>
                                <div class="health-sex-container">
                                    <span>RH: {{ $employee['blood_type'] ?? 'N/A' }}</span>
                                    <span>SEXO: {{ $employee['sex_type'] ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No hay empleados seleccionados para carnetizar.</p>
                @endif
            </div>
        </div>
    </div>

    @include('alerts')
    @include('datatable-script')
@stop
