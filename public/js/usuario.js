$(document).ready(function () {

    listar_usuario();
    

})

function listar_usuario() {
    $.get("/sistema_estefany/app/usuario/listado_usuario.php").done(function (data) {
        $("#data-table").html(data);
    })

}
function detalle_usuario(id){
    $.get("/sistema_estefany/app/usuario/detalle_usuario.php",{id}).done(function(data){
        $("#actualizar_cliente").html(data);
    })
}
function eliminar_usuario(id){
    Swal.fire({
        title: "Estas seguro?",
        text: "No se podra revertir la accion",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, borrar"
      }).then((result) => {
        if (result.isConfirmed) {
            $.get("/sistema_estefany/app/usuario/eliminar_usuario.php", {id}).done(function(response){
                response = JSON.parse(response);
                Swal.fire({
                  title: "Eliminado!",
                  text: response.mensaje,
                  icon: "error"
                });
                listar_usuario();
                
            });
        }
      });
}