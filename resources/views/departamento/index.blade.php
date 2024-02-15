@extends('adminlte::page')

@section('content_header')
@include('head')

<h1 class="m-0 text-dark">Departamentos Piscícola New York</h1>

@stop

@section('content')
    <!-- Boton de Agregar nuevo Departemento -->
    <div class="card" style="width: 90%; margin-left: 40px;">
        <div class="card-header d-flex justify-content-between align-items-center">
            <button id="showModalButton" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearcrop">
                <i class="fas fa-folder-plus"></i> Agregar
            </button>
        </div>
        
<!-- Lista de registros de Departamentos de la empresa -->
        <div class="card-body">
            <table id="datatable" class="table table-striped shadow-lg mt-4" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Fecha de Creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $department)
                        <tr>
                            <td>{{ $department->name }}</td>
                            <td>{{ $department->created_at }}</td>
                            <td>
                                <!-- Botones de Editar y eliminar -->
                                <div class="container text-center">
                                    <div class="row">
                                        <div class="col">
                                            <form method="POST"
                                                action="{{ route('departamento.update', ['id' => $department->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="button" class="btn btn-primary" style="width: 70px;"
                                                    data-bs-toggle="modal" data-bs-target="#editarModal"
                                                    onclick="editarDepartamento({{ $department->id }})">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </form>
                                        </div>
                                        |
                                        <div class="col">
                                            <form id="deleteForm{{ $department->id }}" action="{{ route('departamento.delete', ['departamento' => $department->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger" style="width: 70px;" onclick="confirmDelete({{ $department->id }})">
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
<!-- Fin Lista de registros de Departamentos de la empresa -->
    </div>

    <!-- Modal de Crear nuevo departamento -->
    <div class="modal fade" id="creardepartamento" tabindex="-1" aria-labelledby="creardepartamentoLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ccreardepartamentoLabel">Crear Nuevo Departamento</h5>
                </div>
                <div class="modal-body">
                    <!-- Formulario para crear un nuevo departamento -->
                    <form method="POST" action="{{ route('departamento.creardepartamento') }}">
                        @csrf
                        <!-- Campo para el nombre -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre del Departamento</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <!-- Botón para guardar el departamento -->
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- <Fin Modal de Crear nuevo departamento -->

    <!-- Modal de Editar Departamento -->
    <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarModalLabel">Editar Departamento</h5>
                </div>
                <div class="modal-body">
                    <!-- Formulario para editar un departamento -->
                    <form method="POST" id="editarForm" action="">
                        @csrf
                        @method('PUT')
                        <!-- Campo oculto para el ID del departamento -->
                        <input type="hidden" id="edit_id" name="id">
                        <!-- Campo para el nombre -->
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Nombre del Departamento</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <!-- Botón para guardar la edición -->
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    <!-- Fin Modal de Editar Departamento -->



@include('alerts')

@include('datatable-script')

@stop

{{-- script del modal Crear departamento --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myModal = new bootstrap.Modal(document.getElementById('creardepartamento'));

        document.getElementById('showModalButton').addEventListener('click', function() {
            myModal.show();
        });

        /* evento para cerrar el modal agregar*/
        document.querySelector('#creardepartamento .modal-footer .btn-secondary').addEventListener('click',
            function() {
                myModal.hide();
            })
    });
</script>

<!-- Script del modal editar departamento -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Evento para cerrar el modal de edición al hacer clic en el botón "Cerrar"
        document.getElementById('editarCerrar').addEventListener('click', function() {
            var editarModal = new bootstrap.Modal(document.getElementById('editarModal'));
            editarModal.hide();
        });
    });

    function editarDepartamento(id) {
        // Realizar una petición AJAX para obtener los datos del departamento
        fetch(`/departamento/${id}/detalle`)
            .then(response => response.json())
            .then(data => {
                // Actualizar el valor del campo name
                document.getElementById('edit_name').value = data.name;

                // Actualizar el formulario con la ruta correcta para la actualización
                document.getElementById('editarForm').action = `/departamento/${data.id}/update`;

                // Abrir el modal de edición
                var editarModal = new bootstrap.Modal(document.getElementById('editarModal'));
                editarModal.show();
            })
            .catch(error => console.error('Error al obtener datos del departamento:', error));
    }
</script>

