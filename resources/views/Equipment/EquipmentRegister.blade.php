@extends('adminlte::page')

@section('content_header')
    @include('head')
<center>  <br>  <h1 class="m-0 text-dark">Equipos Piscícola New York</h1>
</center>
@stop
@section('content')


<!-- DataTable Equipments -->
  <div class="card" style="width: 90%; margin-left: 60px; margin-top: 15px;">
    <div class="card-header d-flex justify-content-between align-items-center">
        <button id="showRegisterEquipmentModalButton" class="btn btn-success">
            <i class="fas fa-folder-plus"></i> Agregar
        </button>
    </div>

    <!-- Equipment List -->
    <div class="card-body">
        <table id="datatable" class="table table-striped shadow-lg mt-4" style="width:100%">
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Equipments as $Equipment)
                    <tr>
                        <td>{{ $Equipment->series}}</td>
                        <td>{{ $Equipment->brand}}</td>
                        <td>{{ $Equipment->model}}</td>
                        <td>{{ $Equipment->type}}</td>                        
                        <td>
                            <!-- Edit, Delete, and View buttons -->
                          
                                <div class="row">
                            
                                    <!-- Update Button -->
                                    <div class="col">
                                        <form method="POST" action="{{ route('View.inf.Equipment.PNY', ['id' => $Equipment->id]) }}">
                                            @csrf
                                            @method('GET')
                                            <button type="button" class="btn btn-primary" style="width: 70px;" data-bs-toggle="modal" data-bs-target="#EditEquipmentModal" onclick="EquipmentEdit({{ $Equipment->id }})">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </form>       
                                  </div>
                                    <!-- End Update Button -->
                        
                                    <!-- View Button -->
                                    <div class="col">
                                        <button type="button" class="btn btn-warning view-modal-button" style="width: 70px;" data-bs-toggle="modal" data-bs-target="#ViewModal" data-equipment="{{ json_encode($Equipment) }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <!-- End View Button -->
                        
                                    <!-- Delete Button -->
                                    <div class="col">
                                        <form id="deleteForm{{ $Equipment->id}}" action="{{ route('Delete.Equipment.PNY', ['Equipment' => $Equipment->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" style="width: 70px;" onclick="confirmDelete({{ $Equipment->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>                              </div>
                                    <!-- End Delete Button -->
                                </div>
                            </div>
                            <!-- End of Edit, View, and Delete Buttons -->
                        </td>


                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- End Equipment List-->
</div>
  <!-- End DataTable Equipments -->

<!-- Register equipment modal -->
<div class="modal fade" id="RegisterEquipmentModal" tabindex="-1" aria-labelledby="RegisterEquipmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="RegisterEquipmentModalLabel">Registrar equipo</h5>
            </div>
            <div class="modal-body">
                    <form method="POST" action="{{ route('Create.Equipment.PNY') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="equipment_brand" class="form-label">Marca</label>
                            <input type="text" class="form-control" id="equipment_brand" name="brand" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="equipment_model" class="form-label">Modelo</label>
                            <input type="text" class="form-control" id="model_series" name="model" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="equipment_series" class="form-label">Serial</label>
                            <input type="text" class="form-control" id="equipment_series" name="series">
                        </div>
                
                        <div class="mb-3">
                            <label for="equipment_type" class="form-label">Tipo</label>
                            <select class="form-control" id="equipment_type" name="type" required>
                                <option value="" disabled selected>Seleccione tipo de equipo</option>
                                @foreach($equipmentTypes as $option)
                                    <option value="{{ $option }}">{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                
                        <div class="mb-3">
                            <label for="equipmen_description" class="form-label">Descripcion</label>
                            <input type="text" class="form-control" id="equipment_description" name="description" required>
                        </div>
                        
                        <center><button type="submit" class="btn btn-primary">Guardar</button></center>
                    </form>
            </div>
        </div>
    </div>
</div>
<!-- End register equipment modal -->

<!-- Edit equipment modal -->
<div class="modal fade" id="EditEquipmentModal" tabindex="-1" aria-labelledby="EditEquipmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditEquipmentModalLabel">Editar Equipo</h5>
            </div>
            <div class="modal-body">
                <form method="POST" id="editarForm" action="">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id" name="id">
                    <div class="mb-3">
                        <label for="edit_brand" class="form-label">Marca</label>
                        <input type="text" class="form-control" id="edit_brand" name="brand" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_model" class="form-label">Modelo</label>
                        <input type="text" class="form-control" id="edit_model" name="model" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_series" class="form-label">Serial</label>
                        <input type="text" class="form-control" id="edit_series" name="series">
                    </div>
            
                    <div class="mb-3">
                        <label for="edit_type" class="form-label">Tipo</label>
                        <select class="form-control" id="edit_type" name="type" required>
                                @foreach($equipmentTypes as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Descripcion</label>
                        <input type="text" class="form-control" id="edit_description" name="description" required>
                    </div>
                    <center><button type="submit" class="btn btn-primary">Guardar</button></center>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Edit equipment modal -->

<!--  Modal View  -->
<div class="modal fade" id="ViewModal" tabindex="-1" aria-labelledby="ViewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="ViewModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
       
      </div>
    </div>
  </div>
<!--  Modal View  End-->

@include('alerts')
@include('datatable-script')
@stop

@section('js')


       <!-- View Script  -->
       <script>
        $(document).ready(function () {
            // Evento para abrir el modal al hacer clic en el botón "View"
            $('.view-modal-button').click(function() {
                $('#ViewModal').modal('show');
            });
        });
    </script>

       <!-- Equipment Script  -->
              <script>
        $(document).ready(function () {
            $('#showRegisterEquipmentModalButton').click(function() {
                $('#RegisterEquipmentModal').modal('show');
            });
        });
        </script>


       <!-- Equipment Modal Edit -->
       <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Evento para cerrar el modal de edición al hacer clic en el botón "Cerrar"
            document.getElementById('editarCerrar').addEventListener('click', function() {
                var EditEquipmentModal = new bootstrap.Modal(document.getElementById('EditEquipmentModal'));
                EditEquipmentModal.hide();
            });
        });

        function EquipmentEdit(id) {
            // Realizar una petición AJAX para obtener los datos del departamento
            fetch(`/Equipment/${id}/Detail/PNY`)
                .then(response => response.json())
                .then(data => {
                    // Actualizar el valor del campo name
                    document.getElementById('edit_brand').value = data.brand;
                    document.getElementById('edit_model').value = data.model;
                    document.getElementById('edit_series').value = data.series;
                    document.getElementById('edit_type').value = data.type;
                    document.getElementById('edit_description').value = data.description;

                    // Actualizar el formulario con la ruta correcta para la actualización
                    document.getElementById('editarForm').action = `/Equipment/${data.id}/Update/PNY`;

                    // Abrir el modal de edición
                    var EditEquipmentModal = new bootstrap.Modal(document.getElementById('EditEquipmentModal'));
                    EditEquipmentModal.show();
                })
                .catch(error => console.error('Error al obtener datos del departamento:', error));
        }
 
        </script>
       <!-- Script equipment -->
       <script>
        $(document).ready(function () {
        $('.view-modal-button').click(function() {
            // Obtener la información del equipo del atributo de datos
            var equipmentData = $(this).data('equipment');

            // Mostrar la información del equipo en el modal ViewModal con estilo
            $('#ViewModal .modal-title').text('Detalles del Equipo');
            $('#ViewModal .modal-body').html(
                '<div class="container">' +
                    '<div class="row">' +
                        // Columna izquierda para series y marca
                        '<div class="col-md-6">' +
                            '<div class="mb-3">' +
                                '<label class="form-label"><strong>Series:</strong></label>' +
                                '<input type="text" class="form-control" value="' + equipmentData.series + '" readonly>' +
                            '</div>' +
                            '<div class="mb-3">' +
                                '<label class="form-label"><strong>Marca:</strong></label>' +
                                '<input type="text" class="form-control" value="' + equipmentData.brand + '" readonly>' +
                            '</div>' +
                        '</div>' +
                        // Columna derecha para modelo y tipo
                        '<div class="col-md-6">' +
                            '<div class="mb-3">' +
                                '<label class="form-label"><strong>Modelo:</strong></label>' +
                                '<input type="text" class="form-control" value="' + equipmentData.model + '" readonly>' +
                            '</div>' +
                            '<div class="mb-3">' +
                                '<label class="form-label"><strong>Tipo:</strong></label>' +
                                '<input type="text" class="form-control" value="' + equipmentData.type + '" readonly>' +
                            '</div>' +
                        '</div>' +
                        // Descripción
                        '<div class="col-12">' +
                            '<div class="mb-3">' +
                                '<label class="form-label"><strong>Descripción:</strong></label>' +
                                '<textarea class="form-control" rows="3" readonly>' + equipmentData.description + '</textarea>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>'
            );

            // Mostrar el modal
            $('#ViewModal').modal('show');
        });
    });
    </script>

<script>
    $(document).ready(function () {
        // Función para cerrar el modal cuando se hace clic en el botón "Close" o en la "X"
        $('#ViewModal .btn-close, #ViewModal [data-bs-dismiss="modal"]').click(function() {
            $('#ViewModal').modal('hide');
        });
    });
</script>
@stop
