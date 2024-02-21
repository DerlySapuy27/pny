{{-- Alert Exito --}}
@if (session('success'))
    <script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Éxito",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif


{{-- Alert de Confirmación de Eliminación --}}
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: "¿Estás Seguro/a?",
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, Eliminar!",
            cancelButtonText: "Cancelar" // Cambia la palabra Cancelar aquí
        }).then((result) => {
            if (result.isConfirmed) {
                // Envías el formulario directamente
                document.getElementById('deleteForm' + id).submit();
            }
        });
    }
</script>


{{-- oninput="formatToUpper(this)" 
    pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+"
    TEXTO A MAYUSCULAS --}}

{{-- onkeypress="return allowLettersOnly(event)"
no permite numeros en el campo --}}
<script>
    /* funcion convertir mayusculas */
    function formatToUpper(input) {
        input.value = input.value.toUpperCase();
    }

    /* funcion solo letras y espacios */
    function allowLettersOnly(event) {
        const charCode = event.charCode || event.keyCode;
        return (charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122) || charCode === 32;
    }
</script>
