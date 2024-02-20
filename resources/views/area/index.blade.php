@extends('adminlte::page')

@section('content_header')
    @include('head')
    <h1 class="m-0 text-dark">Areas Piscícola New York</h1>
@stop

@section('content')
    <!-- Boton de Agregar nueva Área -->
    <div class="card" style="width: 90%; margin-left: 40px;">
        <div class="card-header d-flex justify-content-between align-items-center">
            <button id="showModalButton" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearAreaModal">
                <i class="fas fa-folder-plus"></i> Agregar
            </button>
        </div>

        <!-- Lista de registros de Áreas -->
        <div class="card-body">
            <table id="datatable" class="table table-striped shadow-lg mt-4" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre Área</th>
                        <th>Departamento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($areas as $area)
                        <tr>
                            <td>{{ $area->name }}</td>
                            <td>{{ $area->department->name }}</td>
                            <td>
                                <!-- Botones de Editar y eliminar -->
                                <div class="container text-center">
                                    <div class="row">
                                        <div class="col">
                                            <form method="POST" action="{{ route('area.update', ['id' => $area->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="button" class="btn btn-primary" style="width: 70px;"
                                                        data-bs-toggle="modal" data-bs-target="#editarAreaModal"
                                                        onclick="editarArea({{ $area->id }})">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </form>
                                        </div>
                                        
                                        <div class="col">
                                            <form id="deleteForm{{ $area->id }}"
                                                action="{{ route('area.delete', ['area' => $area->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger" style="width: 70px;"
                                                    onclick="confirmDelete({{ $area->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Fin Botones de Editar y eliminar -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Fin Lista de registros de Áreas -->
    </div>

    <!-- Modal de Crear nueva Área -->
    <div class="modal fade" id="crearAreaModal" tabindex="-1" aria-labelledby="crearAreaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearAreaModalLabel">Crear Nueva Área</h5>
                </div>
                <div class="modal-body">
                    <!-- Formulario para crear una nueva área -->
                    <form method="POST" action="{{ route('area.creararea') }}">
                        @csrf
                        <!-- Campo para el nombre del área -->
                        <div class="mb-3">
                            <label for="area_name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="area_name" name="name" required>
                        </div>
                        <!-- Campo para seleccionar el departamento -->
                        <div class="mb-3">
                            <label for="area_department" class="form-label">Departamento</label>
                            <select class="form-control" id="area_department" name="department_id" required>
                                <option value="" disabled selected>Seleccione el departamento</option>
                                <optgroup label="Departamentos disponibles">
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <!-- Botón para guardar el área -->
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- <Fin Modal de Crear nueva Área -->

<!-- Modal de Editar Área -->
<div class="modal fade" id="editarAreaModal" tabindex="-1" aria-labelledby="editarAreaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarAreaModalLabel">Editar Área</h5>
            </div>
            <div class="modal-body">
                <!-- Formulario para editar un área -->
                <form method="POST" id="editarAreaForm" action="">
                    @csrf
                    @method('PUT')
                    <!-- Campo oculto para el ID del área -->
                    <input type="hidden" id="edit_area_id" name="id">
                    <!-- Campo para el nombre del área -->
                    <div class="mb-3">
                        <label for="edit_area_name" class="form-label">Nombre del Área</label>
                        <input type="text" class="form-control" id="edit_area_name" name="name" required>
                    </div>
                    <!-- Campo para seleccionar el departamento -->
                    <div class="mb-3">
                        <label for="edit_area_department" class="form-label">Departamento</label>
                        <select class="form-control" id="edit_area_department" name="department_id" required>
                            <!-- Puedes agregar las opciones dinámicamente con JavaScript -->
                        </select>
                    </div>
                    <!-- Botón para guardar la edición -->
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin Modal de Editar Área -->

@include('alerts')
@include('datatable-script')
@stop
{{-- script del modal Crear Área --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myModal = new bootstrap.Modal(document.getElementById('crearAreaModal'));

        document.getElementById('showModalButton').addEventListener('click', function() {
            myModal.show();
        });

        /* evento para cerrar el modal agregar*/
        document.querySelector('#crearAreaModal .modal-footer .btn-secondary').addEventListener('click',
            function() {
                myModal.hide();
            })
    });
</script>
{{-- Fin script del modal Crear Área --}}

<!-- Script del modal editar área -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Evento para cerrar el modal de edición al hacer clic en el botón "Cerrar"
            document.getElementById('editarAreaCerrar').addEventListener('click', function() {
                var editarAreaModal = new bootstrap.Modal(document.getElementById('editarAreaModal'));
                editarAreaModal.hide();
            });
        });

        function editarArea(id) {
            // Realizar una petición AJAX para obtener los datos del área
            fetch(`/area/${id}/detalle`)
                .then(response => response.json())
                .then(data => {
                    // Actualizar el valor del campo name
                    document.getElementById('edit_area_name').value = data.name;

                    // Obtener el elemento del campo department_id
                    var editAreaDepartment = document.getElementById('edit_area_department');

                    // Limpiar opciones actuales
                    editAreaDepartment.innerHTML = '';

                    // Crear y agregar las nuevas opciones del departamento
                    data.departments.forEach(function(department) {
                        var option = document.createElement('option');
                        option.value = department.id;
                        option.text = department.name;
                        editAreaDepartment.add(option);
                    });

                    // Seleccionar el departamento asociado al área
                    editAreaDepartment.value = data.selected_department_id;

                    // Actualizar el formulario con la ruta correcta para la actualización
                    document.getElementById('editarAreaForm').action = `/area/${data.id}/update`;

                    // Abrir el modal de edición
                    var editarAreaModal = new bootstrap.Modal(document.getElementById('editarAreaModal'));
                    editarAreaModal.show();
                })
                .catch(error => console.error('Error al obtener datos del área:', error));
        }
    </script>
<!-- Script del modal editar área -->

