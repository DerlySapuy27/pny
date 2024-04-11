@extends('adminlte::page')

@section('content_header')
    @include('head')
@stop

@section('content')
@foreach ($employees as $employee)


    <br><br><br><br><br>
    <div class="acta" style="width: 21cm; height: 29.7cm; margin: auto; padding: 1cm; ">

        <!-- Encabezado con imagen -->
        <img src="{{ asset('images/actaentrega.png') }}" alt="Encabezado"
            style="max-width: 100%; height: auto; margin-bottom: 20px;">

        <!-- Información del acta -->
        <!-- Información del acta -->
        <p style="margin-bottom: 10px;">CIUDAD Y FECHA: <u>RIVERA-HUILA &nbsp;&nbsp;&nbsp;
            {{ \Carbon\Carbon::now()->format('d-m-Y') }}___________________________________________</u></p>
        <p style="margin-bottom: 10px;">NOMBRE: <u>{{ $employee->name }} {{ $employee->last_name }}___________________________________________</u></p>
        <p style="margin-bottom: 10px;">C.C No: <u>{{ $employee->document_number }}________________________________________________________________________</u></p>
        <table style="width: 100%;">
            <tr>
                <td style="width: 45%; text-align: left;">CARGO: <u>{{ $employee->position->name }}</u></td>
                <td style="width: 50%; text-align: center; padding-left: 10px;">ÁREA: <u>{{ $employee->area->name }}</u>
                </td>
            </tr>
        </table>
        <p style="margin-bottom: 10px;">No. CARNET: <u>{{ $employee->license_number }}__________________________________________</u></p>

        <br>

        <p style="margin-bottom: 20px; text-align: justify;">Por medio del presente documento, manifiesto que he
            recibido el carnet empresarial,
            y he conocido el procedimiento para el manejo y disposición del mismo:</p>

        <ul style="margin-bottom: 20px; text-align: justify;">
            <li>El carnet, es el documento que acredita ser Colaborador activo de la organización.</li>
            <li>El carnet es un documento personal e intransferible, NO se debe modificar, debe ser utilizado para fines
                laborales. El titular está en la obligación de mantenerlo en perfecto estado y, por ende, se hace
                responsable de su correcta utilización.</li>
            <li>El carnet es de uso OBLIGATORIO, Pórtelo adecuadamente, de forma permanente y visible durante la jornada
                laboral. El uso indebido de esta identificación acarreará las sanciones determinadas por la
                organización, acorde con lo previsto en el Reglamento Interno de trabajo.</li>
            <li>El otorgamiento del carnet es gratuito por primera vez para los Colaboradores de la organización, en
                caso de pérdida, deterioro o robo, su reposición tendrá un costo de VEINTE MIL PESOS M/CTE ($20.000,oo).
            </li>
            <li>Los colaboradores deben portar y presentar el carnet para la identificación, ingreso y acceso al casino;
                y en los casos que sea requerido por terceros.</li>
            <li>Una vez terminada la vinculación laboral con la organización, el carnet debe ser entregado al área de la
                Tecnología informática, y en caso de pérdida o robo debe presentar el soporte de la denuncia y cancelar
                el valor de la reposición.</li>
        </ul>

        <br><br>
        <!-- Contenedor para "Entrega" y "Recibe" -->
        <table style="width: 100%;">
            <tr>
                <td style="width: 45%; text-align: left;">Entrega:</td>
                <td style="width: 50%; text-align: center; padding-left: 20px;">Recibe:</td>
            </tr>
        </table>
        <br>

        <!-- Imagen de firma -->

        <table style="width: 100%;">
            <tr>
                <img src="{{ asset('images/firma.png') }}" alt="Firma" style="max-width: 200px; max-height: 200px;">
                <td style="width: 45%; text-align: left;">____________________________________________</td>
                <td style="width: 50%; text-align: center; padding-left: 20px;">
                    ____________________________________________</td>
            </tr>
        </table>

        <table style="width: 100%;">
            <tr>
                <td style="width: 45%; text-align: left;">Área Tecnología Informática</td>
                <td style="width: 50%; text-align: center; padding-left: 20px;">Colaborador</td>
            </tr>
        </table>

    </div>
<!-- Aquí va tu contenido de acta con la información del empleado -->
@endforeach
@stop
