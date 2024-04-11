@extends('adminlte::page')

@section('content_header')
    @include('head')
    <center>
        <h1 class="m-0 text-dark">ACTA DE ENTREGA CARNET PROFESIONAL</h1>
    </center><br>
@stop

@section('content')

    <div class="card" style="width: 90%; margin-left: 40px;">
        <div class="card-header d-flex justify-content-between align-items-center">
            <button id="generateCertificates" class="btn btn-success">
                <i class="fas fa-folder-plus"></i> GENERAR ACTAS DE ENTREGA CARNET EMPRESARIAL
            </button>
        </div>
        <!-- Lista de registros de Empleados -->
        <div class="card-body">
            <table id="datatable" class="table table-striped shadow-lg mt-4" style="width:100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Cargo</th>
                        <th>Número de Documento</th>
                        <th>Tipo de Sangre</th>
                        <th>Sexo</th>
                        <th>Fotografia</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        @if (!$employee->delivered)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="selectedEmployees[]"
                                            value="{{ $employee->id }}" data-name="{{ $employee->name }}"
                                            data-last_name="{{ $employee->last_name }}"
                                            data-position="{{ $employee->position->name }}"
                                            data-document_number="{{ $employee->document_number }}"
                                            data-blood_type="{{ $employee->blood_type }}"
                                            data-sex_type="{{ $employee->sex_type }}"
                                            data-signature="{{ $employee->signature }}">
                                    </div>
                                </td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->last_name }}</td>
                                <td>{{ $employee->position->name }}</td>
                                <td>{{ $employee->document_number }}</td>
                                <td>{{ $employee->blood_type }}</td>
                                <td>{{ $employee->sex_type }}</td>
                                <td>
                                    @if ($employee->signature)
                                        <!-- Muestra la imagen si está presente -->
                                        <img src="{{ asset('storage/' . $employee->signature) }}" alt="Fotografía"
                                            style="max-width: 50px; max-height: 50px;">
                                    @else
                                        Sin fotografía
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            </form>
        </div>
        @include('alerts')

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('generateCertificates').addEventListener('click', function() {
                    // Obtener los empleados seleccionados
                    const selectedEmployees = document.querySelectorAll('input[name="selectedEmployees[]"]:checked');

                    // Verificar si se seleccionó al menos un empleado
                    if (selectedEmployees.length > 0) {
                        // Crear un array para almacenar los IDs de los empleados seleccionados
                        const selectedEmployeeIds = [];

                        // Recorrer los empleados seleccionados y agregar sus IDs al array
                        selectedEmployees.forEach(function(employee) {
                            selectedEmployeeIds.push(employee.value);
                        });

                        // Convertir el array de IDs en una cadena separada por comas
                        const employeeIdsString = selectedEmployeeIds.join(',');

                        // Redireccionar al controlador con los IDs de los empleados seleccionados
                        window.location.href = `/carnet/generate-actas/${employeeIdsString}`;
                    } else {
                        // Mostrar un mensaje de error si no se seleccionó ningún empleado
                        console.error('Error: No se ha seleccionado ningún empleado');
                    }
                });
            });
        </script>


@stop
