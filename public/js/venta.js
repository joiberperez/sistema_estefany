$(document).ready(function () {

    listar_venta();
    

})

function listar_venta() {
    $.get("/sistema_estefany/app/venta/listado_venta.php").done(function (data) {
        $("#data-table").html(data);
    })

}

function eliminar_producto(id){
    Swal.fire({
        title: "Estas seguro?",
        text: "No se podra revertir la accion",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
            $.get("/sistema_estefany/app/producto/eliminar_producto.php", {id}).done(function(response){
                response = JSON.parse(response);
                Swal.fire({
                  title: "Eliminado!",
                  text: response.mensaje,
                  icon: "error"
                });
                listar_productos();
                
            });
        }
      });
    
}









// Función para evitar que se ingresen números en el campo de texto
function evitarNumeros(event) {
    var charCode = event.which || event.keyCode;
    // Permitir solo letras (mayúsculas y minúsculas) y teclas de control como retroceso
    if ((charCode >= 48 && charCode <= 57)) {
        event.preventDefault(); // Evitar que se escriban números
    }
}
function permitirSoloNumeros(event) {
    var charCode = event.which || event.keyCode;

    // Permitir solo números (teclas con código entre 48 y 57), backspace (8), y delete (46)
    if ((charCode < 48 || charCode > 57) && charCode !== 8 && charCode !== 46) {
        event.preventDefault(); // Cancelar la entrada si no es un número
    }
}
