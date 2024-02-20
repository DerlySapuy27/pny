@extends('adminlte::page')


@section('content_header')
    @include('head')
    <h1 class="m-0 text-dark">Cargos Piscícola New York</h1>
@stop

@section('content')
    <!-- Boton de Agregar nueva Posición -->
    <div class="card" style="width: 90%; margin-left: 40px;">
        <div class="card-header d-flex justify-content-between align-items-center">
            <button id="showCrearCargoModalButton" class="btn btn-success" data-bs-toggle="modal"
                data-bs-target="#crearCargoModal">
                <i class="fas fa-folder-plus"></i> Agregar
            </button>

        </div>

        <!-- Lista de registros de Posiciones -->
        <div class="card-body">
            <table id="datatable" class="table table-striped shadow-lg mt-4" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre Posición</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($positions as $position)
                        <tr>
                            <td>{{ $position->name }}</td>
                            <td>
                                <!-- Botones de Editar y Eliminar -->
                                <div class="container text-center">
                                    <div class="row">
                                        <div class="col">
                                            <form method="POST"
                                                action="{{ route('cargo.update', ['id' => $position->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="button" class="btn btn-primary" style="width: 70px;"
                                                    data-bs-toggle="modal" data-bs-target="#editarModal"
                                                    onclick="editarCargo({{ $position->id }})">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col">
                                            <form id="deleteForm{{ $position->id }}" action="{{ route('cargo.delete', ['position' => $position->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger" style="width: 70px;" onclick="confirmDelete({{ $position->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Fin Botones de Editar y Eliminar -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Fin Lista de registros de Posiciones -->
    </div>

    <!-- Modal de Crear nuevo Cargo -->
    <div class="modal fade" id="crearCargoModal" tabindex="-1" aria-labelledby="crearCargoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearCargoModalLabel">Crear Nuevo Cargo</h5>
                </div>
                <div class="modal-body">
                    <!-- Formulario para crear un nuevo cargo -->
                    <form method="POST" action="{{ route('cargo.crearCargo') }}">
                        @csrf
                        <!-- Campo para el nombre -->
                        <div class="mb-3">
                            <label for="cargo_name" class="form-label">Nombre del Cargo</label>
                            <input type="text" class="form-control" id="cargo_name" name="name" required>
                        </div>
                        <!-- Botón para guardar el cargo -->
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Modal de Crear nuevo Cargo -->

    <!-- Modal de Editar Cargo -->
    <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarModalLabel">Editar Cargo</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" id="editarForm" action="">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_id" name="id">
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Nombre del Cargo</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    <!-- Fin Modal de Editar Departamento -->



@include('alerts')
@include('datatable-script')
@stop

{{-- Script del modal Crear Cargo --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myModal = new bootstrap.Modal(document.getElementById('crearCargoModal'));

        document.getElementById('showCrearCargoModalButton').addEventListener('click', function() {
            myModal.show();
        });

        // Evento para cerrar el modal de crear cargo
        document.querySelector('#crearCargoModal .modal-footer .btn-secondary').addEventListener('click',
            function() {
                myModal.hide();
            });
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

    function editarCargo(id) {
        // Realizar una petición AJAX para obtener los datos del departamento
        fetch(`/cargo/${id}/detalle`)
            .then(response => response.json())
            .then(data => {
                // Actualizar el valor del campo name
                document.getElementById('edit_name').value = data.name;

                // Actualizar el formulario con la ruta correcta para la actualización
                document.getElementById('editarForm').action = `/cargo/${data.id}/update`;

                // Abrir el modal de edición
                var editarModal = new bootstrap.Modal(document.getElementById('editarModal'));
                editarModal.show();
            })
            .catch(error => console.error('Error al obtener datos del departamento:', error));
    }
</script>