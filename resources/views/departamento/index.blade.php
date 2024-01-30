@extends('adminlte::page')


@section('content_header')
    <h1 class="m-0 text-dark">Departamentos Piscícola New York</h1>
@stop

@section('content')
    <!-- Boton de Agregar nuevo Departemento -->
    <div class="card" style="width: 90%; margin-left: 40px">
        <div class="card-header d-flex justify-content-end">
            <button id="showModalButton" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearcrop">
                <i class="fas fa-folder-plus"></i>
            </button>
        </div>
    </div>
    {{-- Lista de Departamentos de la empresa --}}
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Fecha de Creación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($departments as $department)
                <tr>
                    <td>{{ $department->id }}</td>
                    <td>{{ $department->name }}</td>
                    <td>{{ $department->created_at }}</td>
                    <td>
                        <i class="fas fa-edit" data-bs-toggle="modal" data-bs-target="#editarModal" onclick="editarDepartamento({{ $department->id }})"></i>
                        <i class="fas fa-trash"></i>
                    </td>
                    
                    
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal de Crear nuevo departamento -->
    <div class="modal fade" id="creardepartamento" tabindex="-1" aria-labelledby="creardepartamentoLabel" aria-hidden="true">
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

    <!-- < Modal de Editar Departamento -->
    <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarModalLabel">Editar Departamento</h5>
                </div>
                <div class="modal-body">
                    <!-- Formulario para editar un departamento -->
                    <form method="POST" action="{{ route('departamento.update', ['departamento' => $department->id]) }}">
                        @csrf
                        @method('PUT') <!-- Agrega este campo para indicar que es una actualización -->
                        <!-- Campo para el nombre -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre del Departamento</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $department->name }}" required>
                        </div>
                        <!-- Botón para guardar la edición -->
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
        <!-- Fin Modal de Editar Departamento -->




@stop


{{-- script del modal Crear departamento --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myModal = new bootstrap.Modal(document.getElementById('creardepartamento'));

        document.getElementById('showModalButton').addEventListener('click', function() {
            myModal.show();
        });

        /* evento para cerrar el modal agregar*/
        document.querySelector('#creardepartamento .modal-footer .btn-secondary').addEventListener('click', function() {
            myModal.hide();
        })
    });
</script>


{{-- script del modal editar departamento --}}
<script>
    function editarDepartamento(id) {
        // Aquí puedes utilizar JavaScript/jQuery para cargar los datos del departamento en el formulario
        var department = obtenerDatosDepartamento(id);

        // Luego, actualiza el valor del campo name
        document.getElementById('edit_name').value = department.name;

        // Finalmente, abre el modal
        var editarModal = new bootstrap.Modal(document.getElementById('editarModal'));
        editarModal.show();
    }

    // Función de ejemplo para obtener los datos del departamento (puedes personalizarla según tu estructura)
    function obtenerDatosDepartamento(id) {
        // Puedes realizar una petición AJAX para obtener los datos del departamento
        // o simplemente cargar los datos directamente desde la página si están disponibles
        return {
            id: id,
            name: 'Nombre del Departamento', // Reemplaza esto con los datos reales
            // Otros campos...
        };
    }
</script>
