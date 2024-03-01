@extends('adminlte::page')

@section('content_header')
    @include('head')
    <center>
        <h1 class="m-0 text-dark">Vista Previa de Carnets</h1>
    </center><br> 
@stop

@section('content')
    <div id="employee-details-container" class="employee-container">
        @if (is_array($selectedEmployeeDetails) && count($selectedEmployeeDetails) > 0)
            @foreach ($selectedEmployeeDetails as $employee)
                <div class="employee-card">
                    <center><img class="employee-image" src="{{ asset('images/logoo.jpg') }}" alt="Imagen Estática"></center>
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
            @endforeach
        @else
            <p>No hay empleados seleccionados para carnetizar.</p>
        @endif
    </div>

    @include('alerts')
    @include('datatable-script')
@stop
