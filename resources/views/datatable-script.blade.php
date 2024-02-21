{{-- Datatables scripts --}}
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

{{-- Fin Datatables scripts --}}


{{-- script para mostrar 5 registros por pagina en datatable --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new DataTable('#datatable', {
            "lengthMenu": [[5, 10, 50, -1], [5, 10, 50, "All"]],

            "language": {
            "lengthMenu": "MOSTRAR _MENU_ REGISTROS POR PÁGINA",
            "zeroRecords": "NO HAY REGISTROS - no existe",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
        });

    });
</script>
