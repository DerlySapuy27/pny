@extends('adminlte::page')

@section('content_header')
    @include('head')
    <h1 class="m-0 text-dark">Sedes Piscícola New York</h1>
@stop
@section('content')
    <!-- Boton de Agregar nueva Posición -->
    <div class="card" style="width: 90%; margin-left: 40px;">
        <div class="card-header d-flex justify-content-between align-items-center">
            <button id="showCrearsedeModalButton" class="btn btn-success" data-bs-toggle="modal"
                data-bs-target="#crearsedeModal">
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
                    @foreach ($sede as $sede)
                        <tr>
                            <td>{{ $sede->name }}</td>
                            <td>
                                <!-- Botones de Editar y Eliminar -->
                                <div class="container text-center">
                                    <div class="row">
                                        <div class="col">
                                            <form method="POST"
                                                action="{{ route('sede.update', ['id' => $sede->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="button" class="btn btn-primary" style="width: 70px;"
                                                    data-bs-toggle="modal" data-bs-target="#editarModal"
                                                    onclick="editarsede({{ $sede->id }})">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col">
                                            <form id="deleteForm{{ $sede->id }}"
                                                action="{{ route('sede.delete', ['sede' => $sede->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger" style="width: 70px;"
                                                    onclick="confirmDelete({{ $sede->id }})">
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

<!-- Modal de Crear nuevo sedes -->
    <div class="modal fade" id="crearsedeModal" tabindex="-1" aria-labelledby="crearsedeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearsedeModalLabel">CREAR NUEVA SEDE</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('sede.crearsede') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="sede_name" class="form-label">Nombre de la sede</label>
                            <input type="text" class="form-control" id="sede_name" name="name"
                                oninput="formatToUpper(this)" onkeypress="return allowLettersOnly(event)"
                                pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" required>
                        </div>
                        <center><button type="submit" class="btn btn-primary">Guardar</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Fin Modal de Crear nuevo sedes -->

<!-- Modal de Editar sedes -->
    <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarModalLabel">EDITAR SEDES</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" id="editarForm" action="">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_id" name="id">
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Nombre de la sedes</label>
                            <input type="text" class="form-control" id="edit_name" name="name"
                                oninput="formatToUpper(this)" onkeypress="return allowLettersOnly(event)"
                                pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" required>
                        </div>
                        <center><button type="submit" class="btn btn-primary">Guardar</button></center>
                    </form>
                </div>
            </div>
        </div>
<!-- Fin Modal de Editar Departamento -->

    @include('alerts')
    @include('datatable-script')
    @stop

    {{-- Script del modal Crear sedes --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('crearsedeModal'));

            document.getElementById('showCrearsedeModalButton').addEventListener('click', function() {
                myModal.show();
            });

            // Evento para cerrar el modal de crear sedes
            document.querySelector('#crearsedeModal .modal-footer .btn-secondary').addEventListener('click',
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

        function editarsede(id) {
            // Realizar una petición AJAX para obtener los datos del departamento
            fetch(`/sede/${id}/detalle`)
                .then(response => response.json())
                .then(data => {
                    // Actualizar el valor del campo name
                    document.getElementById('edit_name').value = data.name;

                    // Actualizar el formulario con la ruta correcta para la actualización
                    document.getElementById('editarForm').action = `/sede/${data.id}/update`;

                    // Abrir el modal de edición
                    var editarModal = new bootstrap.Modal(document.getElementById('editarModal'));
                    editarModal.show();
                })
                .catch(error => console.error('Error al obtener datos del departamento:', error));
        }
    </script>
