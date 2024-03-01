@extends('adminlte::page')


@section('content_header')
    @include('head')

    <h1 class="m-0 text-dark">Empleados Piscícola New York</h1>
@stop

@section('content')
<!-- Boton de Agregar nuevo Empleado -->
<div class="card" style="width: 90%; margin-left: 40px;">
    <div class="card-header d-flex justify-content-between align-items-center">
        <button id="showCrearEmpleadoModalButton" class="btn btn-success" data-bs-toggle="modal"
            data-bs-target="#crearEmpleadoModal">
            <i class="fas fa-folder-plus"></i> Agregar
        </button>
    </div>
    <!-- Lista de registros de Empleados -->
    <div class="card-body">
        <table id="datatable" class="table table-striped shadow-lg mt-4" style="width:100%">
            <thead>
                <tr>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th># Documento</th>
                    <th>Área</th>
                    <th>Entrega Carnet</th>
                    <th>Detalles</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->document_number }}</td>
                        <td>{{ $employee->area->name }}</td>
                        <td>{{ $employee->delivered ? 'SI' : 'NO' }}</td>
                        <td>
                            <button type="button" class="btn btn-info" style="width: 70px;" data-bs-toggle="modal"
                                data-bs-target="#visualizarEmpleadoModal"
                                onclick="mostrarEmpleado({{ $employee->id }})">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                        <td>
                            <!-- Botones de Editar y eliminar -->
                            <div class="d-flex">
                                <form method="POST" action="{{ route('employee.update', ['id' => $employee->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal"
                                        data-bs-target="#editarEmpleadoModal"
                                        onclick="editarEmpleado('{{ $employee->id }}')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </form>
                                <form id="deleteForm{{ $employee->id }}"
                                    action="{{ route('employee.delete', ['employee' => $employee->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger"
                                        onclick="confirmDelete({{ $employee->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Fin Lista de registros de Empleados -->
</div>

<!-- modal detalles -->
<div class="modal fade" id="visualizarEmpleadoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">DETALLES DEL EMPLEADO</h5>
            </div>
            <div class="modal-body">
                {{-- Aquí se muestran los datos del registro --}}
                <div class="text-center">
                    <!-- Agrega más detalles según tus necesidades -->
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- modal detalles -->

<!-- Modal de Editar Empleado -->
<div class="modal fade" id="editarEmpleadoModal" tabindex="-1" aria-labelledby="editarEmpleadoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarEmpleadoModalLabel">EDITAR EMPLEADO</h5>
            </div>
            <div class="modal-body">
                @isset($employee)
                    <form method="POST" id="editarEmpleadoForm"
                        action="{{ route('employee.update', ['id' => $employee->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Campo oculto para el ID del empleado -->
                        <input type="hidden" id="edit_employee_id" name="id" value="{{ $employee->id }}">
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Nombre del Empleado</label>
                            <input type="text" class="form-control" id="edit_name" name="name"
                                style="text-transform: uppercase;" required value="{{ $employee->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="edit_last_name" class="form-label">Apellido del Empleado</label>
                            <input type="text" class="form-control" id="edit_last_name" name="last_name"
                                style="text-transform: uppercase;" required value="{{ $employee->last_name }}">
                        </div>
                        <div class="mb-3">
                            <label for="edit_document_number" class="form-label">Número de Documento</label>
                            <input type="number" class="form-control" id="edit_document_number" name="document_number"
                                required value="{{ $employee->document_number }}">
                        </div>
                        <div class="mb-3">
                            <label for="sex_type" class="form-label">Sexo</label>
                            <select class="form-select" id="edit_sex_type" name="sex_type" required>
                                @foreach (['M', 'F'] as $sexType)
                                    <option value="{{ $sexType }}"
                                        {{ $employee->sex_type == $sexType ? 'selected' : '' }}>
                                        {{ $sexType }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_position_id" class="form-label">Cargo</label>
                            <select class="form-select" id="edit_position_id" name="position_id" required>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}"
                                        {{ $employee->position_id == $position->id ? 'selected' : '' }}>
                                        {{ $position->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_blood_type" class="form-label">Tipo de Sangre</label>
                            <select class="form-select" id="edit_blood_type" name="blood_type" required>
                                @foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $bloodType)
                                    <option value="{{ $bloodType }}"
                                        {{ $employee->blood_type == $bloodType ? 'selected' : '' }}>
                                        {{ $bloodType }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_area_id" class="form-label">Área</label>
                            <select class="form-select" id="edit_area_id" name="area_id" required>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}"
                                        {{ $employee->area_id == $area->id ? 'selected' : '' }}>
                                        {{ $area->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_delivered" class="form-label">Entrega Carnet</label>
                            <select class="form-select" id="edit_delivered" name="delivered" required>
                                <option value="0">NO</option>
                                <option value="1">SI</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_observation" class="form-label">Observación</label>
                            <textarea class="form-control" id="edit_observation" name="observation" rows="3">{{ $employee->observation }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit_license_number" class="form-label">Número de Carnet</label>
                            <input type="number" class="form-control" id="edit_license_number" name="license_number"
                                value="{{ $employee->license_number }}">
                        </div>
                        <div class="mb-3">
                            <label for="edit_sede_id" class="form-label">Sede</label>
                            <select class="form-select" id="edit_sede_id" name="sede_id" required>
                                @foreach ($sedes as $sede)
                                    <option value="{{ $sede->id }}"
                                        {{ $employee->sede_id == $sede->id ? 'selected' : '' }}>
                                        {{ $sede->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_signature" class="form-label">Firma</label>
                            <input type="file" class="form-control" id="edit_signature" name="signature">
                            <div class="signature-preview-container">
                                <hr>
                                @if ($employee->signature)
                                    <img src="{{ asset('storage/' . $employee->signature) }}?v={{ uniqid() }}"
                                        alt="Firma" style="max-width: 100px; max-height: 100px;">
                                @else
                                    Sin firma
                                @endif
                            </div>  
                        </div>
                        <hr>
                        <center><button type="submit" class="btn btn-primary">Guardar</button></center>
                    </form>
                @endisset
            </div>
        </div>
    </div>
</div>
<!-- Fin Modal de Editar Empleado -->

<!-- Modal para crear empleado -->
    <div class="modal fade" id="crearEmpleadoModal" tabindex="-1" aria-labelledby="crearEmpleadoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearEmpleadoModalLabel">REGISTRAR NUEVO EMPLEADO</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('empleado.crearEmpleado') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="empleadoId" name="empleadoId" value="{{ $id }}">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name"
                                oninput="formatToUpper(this)" onkeypress="return allowLettersOnly(event)"
                                pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" placeholder="Ingrese Nombres" required>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                oninput="formatToUpper(this)" onkeypress="return allowLettersOnly(event)"
                                pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" placeholder="Ingrese Apellidos" required>
                        </div>
                        <div class="mb-3">
                            <label for="document_number" class="form-label">Número de documento</label>
                            <input type="number" class="form-control" id="document_number" name="document_number"
                                oninput="formatToUpper(this)" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+"
                                placeholder="Ingrese Número de Documento" required>
                        </div>
                        <div class="mb-3">
                            <label for="sex_type" class="form-label">SEXO</label>
                            <select class="form-select" id="sex_type" name="sex_type" required>
                                <option value="" disabled selected>Seleccione el tipo de Sexo</option>
                                <optgroup label="Tipos de Sexo">
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="position_id" class="form-label">Cargo</label>
                            <select class="form-control" id="position_id" name="position_id" required>
                                <option value="" disabled selected>Seleccione el cargo </option>
                                <optgroup label="Cargos Disponibles">
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="blood_type" class="form-label">Tipo de sangre</label>
                            <select class="form-select" id="blood_type" name="blood_type" required>
                                <option value="" disabled selected>Seleccione el tipo de Sangre</option>
                                <optgroup label="Tipos de Sangre">
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="area_id" class="form-label">Área a laborar</label>
                            <select class="form-control" id="area_id" name="area_id" required>
                                <option value="" disabled selected>Seleccione el área</option>
                                <optgroup label="Áreas disponibles">
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="delivered" class="form-label">Estado de entrega del carnet</label>
                            <select class="form-select" id="delivered" name="delivered">
                                <option value="0" selected>No</option>
                                <option value="1">Sí</option>
                            </select>
                        </div>                        
                        <div class="mb-3">
                            <label for="observation" class="form-label">Observación</label>
                            <textarea class="form-control" id="observation" name="observation" oninput="formatToUpper(this)"
                                onkeypress="return allowLettersOnly(event)" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="license_number" class="form-label">Número de Carnet</label>
                            <input type="number" class="form-control" id="license_number" name="license_number"
                                oninput="formatToUpper(this)" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+">
                        </div>
                        <div class="mb-3">
                            <label for="sede_id" class="form-label">Sede</label>
                            <select class="form-control" id="sede_id" name="sede_id" required>
                                <option value="" disabled selected>Seleccione la sede</option>
                                <optgroup label="Sedes disponibles">
                                    @foreach ($sedes as $sede)
                                        <option value="{{ $sede->id }}">{{ $sede->name }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="signature" class="form-label">Seleccione Foto para el Carnet</label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="signature" name="signature"
                                    onchange="previewSignature(this)">
                            </div>
                            <hr>
                            <div id="signaturePreviewContainer" class="signature-preview-container mt-2">
                                <img id="signaturePreview" src="" alt="Firma previa"
                                    style="max-width: 80%; max-height: 100px; display: block; margin: auto;">
                            </div>
                        </div>
                        <center><button type="submit" class="btn btn-primary">Guardar</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Modal para crear empleado -->

    @include('alerts')
    @include('datatable-script')
@stop


<!-- Script crear empleado -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myModal = new bootstrap.Modal(document.getElementById('crearEmpleadoModal'));

        // Mostrar el modal al hacer clic en el botón
        document.getElementById('showCrearEmpleadoModalButton').addEventListener('click', function() {
            myModal.show();
        });

        // Obtener el ID del empleado del campo oculto
        const empleadoId = document.getElementById('empleadoId').value;

        // Lógica para cargar opciones desde JSON
        axios.get(`/empleado/${empleadoId}/cargar-datos`)
            .then(response => {
                const positions = response.data.positions;
                const areas = response.data.areas;
                const sedes = response.data.sedes;

                // Llena los select con las opciones cargadas
                cargarOpciones('position_id', positions);
                cargarOpciones('area_id', areas);
                cargarOpciones('sede_id', sedes);
            })
            .catch(error => {
                console.error('Error al cargar datos:', error);
            });

        function cargarOpciones(idSelect, opciones) {
            const select = document.getElementById(idSelect);
            select.innerHTML = ''; // Limpiar opciones existentes

            opciones.forEach(opcion => {
                const option = document.createElement('option');
                option.value = opcion.id;
                option.text = opcion.name;
                select.add(option);
            });
        }
    });
</script>
{{-- estilo de la imagen en el modal EDITAR --}}
<style>
    .signature-preview-container {
        text-align: center;
        /* Centrar horizontalmente */
    }

    .signature-preview-container img {
        max-width: 80%;
        /* El ancho máximo es el 80% del contenedor */
        max-height: 100px;
        /* Altura máxima para evitar imágenes muy altas */
        margin-top: 10px;
        /* Margen superior opcional para separar la imagen del campo de entrada de archivo */
        margin: auto;
        /* Centrar verticalmente */
        display: block;
        /* Para evitar márgenes no deseados */
    }
</style>
<!-- Script previzualizacion de la firma cargada en el modal agregar -->
<script>
    function previewSignature(input) {
        var previewContainer = document.getElementById('signaturePreviewContainer');
        var previewImage = document.getElementById('signaturePreview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block'; // Muestra el contenedor de la previsualización
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            previewImage.src = '';
            previewContainer.style.display =
                'none'; // Oculta el contenedor de la previsualización si no hay imagen seleccionada
        }
    }
</script>
{{-- SCRIP PARA EL MANEJO DE DETALLES DEL EMPLEADO --}}
<script>
    function mostrarEmpleado(employeeId) {
        // Realizar una solicitud AJAX para obtener los detalles del empleado
        $.ajax({
            url: '{{ route('employee.details', ['id' => '__id__']) }}'.replace('__id__', employeeId),
            type: 'GET',
            data: {
                employee_id: employeeId
            },
            success: function(response) {
                // Manipular los datos recibidos y actualizar el contenido del modal
                actualizarContenidoModal(response.employee);
            },
            error: function(error) {
                console.error('Error al obtener los detalles del empleado', error);
            }
        });
    }

    function actualizarContenidoModal(employee) {
        // Verifica si la firma está presente
        var firmaHTML = employee.signature ?
            `<img src="{{ asset('storage/') }}/${employee.signature}" alt="Firma" style="max-width: 100px; max-height: 100px;">` :
            'Sin foto';
        // Actualizar el contenido del modal con los detalles del empleado
        $('#visualizarEmpleadoModal').find('.modal-body').html(`    
            <p class="font-weight-bold">${employee.name} ${employee.last_name}</p>
            <p><strong></strong> ${employee.position ? employee.position.name : 'N/A'}</p>
            <p><strong></strong> </p>
            <p><strong>C.C:</strong> ${employee.document_number}</p>
            <p><strong>Sexo:</strong> ${employee.sex_type}</p>
            <p><strong>Rh:</strong> ${employee.blood_type}</p>
            <p><strong>Area:</strong> ${employee.area ? employee.area.name : 'N/A'}</p>
            <p><strong>Entrega Carnet:</strong> ${employee.delivered === 1 ? 'Sí' : 'No'}</p>
            <p><strong>Observacion:</strong> ${employee.observation ? employee.observation : 'N/A'}</p>
            <p><strong>#Carnet:</strong> ${employee.license_number ? employee.license_number : 'SIN ASIGNAR'}</p>
            <p><strong>Sede:</strong> ${employee.sede ? employee.sede.name : 'N/A'}</p>
            <center><p><strong></strong> ${firmaHTML}</p></center>
            
            
        `);
        // Mostrar el modal
        $('#visualizarEmpleadoModal').modal('show');}
</script>
<!-- Script del modal editar empleado -->
<script>
    function editarEmpleado(id) {
        // Realizar una petición AJAX para obtener los datos del empleado
        fetch(`/employee/${id}/details`)
            .then(response => response.json())
            .then(data => {
                console.log('Datos del empleado:', data);

                // Verificar si 'data' está definido y contiene la propiedad 'id'
                if (data && data.id) {
                    // Actualizar los valores de los campos del formulario
                    document.getElementById('edit_employee_id').value = data.id;
                    document.getElementById('edit_name').value = data.name;
                    document.getElementById('edit_last_name').value = data.last_name;
                    document.getElementById('edit_document_number').value = data.document_number;
                    document.getElementById('sex_type').value = data.sex_type;
                    document.getElementById('edit_position_id').value = data.position_id;
                    document.getElementById('edit_blood_type').value = data.blood_type;
                    document.getElementById('edit_area_id').value = data.area_id;
                    document.getElementById('edit_delivered').value = data.delivered;
                    document.getElementById('edit_observation').value = data.observation;
                    document.getElementById('edit_license_number').value = data.license_number;
                    document.getElementById('edit_sede_id').value = data.sede_id;

                    // Mostrar la firma actual si está presente
                    var currentSignature = document.getElementById('current_signature');
                    // Verificar si el elemento existe antes de intentar asignar el src
                    if (currentSignature) {
                        currentSignature.src = '{{ asset('storage/') }}/' + data.signature;
                    } else {
                        console.error('Elemento current_signature no encontrado en el DOM.');
                    }

                    // Actualizar el formulario con la ruta correcta para la actualización
                    document.getElementById('editarEmpleadoForm').action = `/employee/${data.id}/update`;

                    // Abrir el modal de edición
                    var editarEmpleadoModal = new bootstrap.Modal(document.getElementById('editarEmpleadoModal'));
                    editarEmpleadoModal.show();
                } else {
                    console.error('Datos de empleado no válidos:', data);
                }
            })
            .catch(error => console.error('Error al obtener datos del empleado:', error));
    }
</script>
