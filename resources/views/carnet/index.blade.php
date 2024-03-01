    @extends('adminlte::page')

    @section('content_header')
        @include('head')
        <center>
            <h1 class="m-0 text-dark">Gestión de Carnets Piscicola New York-Personal sin Carnetizar</h1>
        </center><br>
    @stop

    @section('content')

        <div class="card" style="width: 90%; margin-left: 40px;">
            <div class="card-header d-flex justify-content-between align-items-center">
                <button id="empleadocarnet" class="btn btn-success">
                    <i class="fas fa-folder-plus"></i> Adjuntar a la Plantilla
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
                                                data-sex_type="{{ $employee->sex_type }}">
                                                
                                        </div>
                                    </td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->last_name }}</td>
                                    <td>{{ $employee->position->name }}</td>
                                    <td>{{ $employee->document_number }}</td>
                                    <td>{{ $employee->blood_type }}</td>
                                    <td>{{ $employee->sex_type }}</td>
                                </tr>
                            @endif
                        @endforeach

                    </tbody>
                </table>
                </form>
            </div>


            @include('alerts')
            {{-- @include('datatable-script') --}}

            <!-- Script para manejar la generación de la plantilla y la vista previa -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('empleadocarnet').addEventListener('click', function() {
                        // Obtener los empleados seleccionados
                        const selectedEmployees = document.querySelectorAll(
                            'input[name="selectedEmployees[]"]:checked');

                        // Obtener los detalles de los empleados seleccionados
                        const selectedEmployeeDetails = [];
                        selectedEmployees.forEach(employee => {
                            const details = {
                                name: employee.getAttribute('data-name'),
                                last_name: employee.getAttribute('data-last_name'),
                                position: employee.getAttribute('data-position'),
                                document_number: employee.getAttribute('data-document_number'),
                                blood_type: employee.getAttribute('data-blood_type'),
                                sex_type: employee.getAttribute('data-sex_type'),
                                // Agrega más campos según tus necesidades
                            };
                            selectedEmployeeDetails.push(details);
                        });

                        // Convertir detalles a JSON y codificarlo para enviar como parámetro
                        const encodedDetails = encodeURIComponent(JSON.stringify(selectedEmployeeDetails));

                        // Redirigir a la ruta para mostrar la vista previa con los detalles
                        window.location.href = `/carnet/preview?details=${encodedDetails}`;
                    });
                });
            </script>


        @stop
