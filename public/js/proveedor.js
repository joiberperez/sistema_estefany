
$(document).ready(function() {
    listar_proveedor();
    
   
})

function eliminar_proveedor(id){
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
            $.get("/sistema_estefany/app/proveedor/eliminar_proveedor.php", {id}).done(function(data){
                Swal.fire({
                  title: "Eliminado!",
                  text: "Se eliminado sactifastoriamente",
                  icon: "success"
                });
                listar_proveedor();
                console.log(data)
            });
        }
      });
    
}

function listar_proveedor() {
    $.get("/sistema_estefany/app/proveedor/listar_proveedor.php").done(function(data) {
        $("#data-table").html(data);
    })
    
}



function actualizarProveedor(id) {
    $.get("/sistema_estefany/app/proveedor/actualizar_proveedor.php", {
        id
    }).done(function(data) {
        $("#actualizar_proveedor").html(data);
    })
}


$(document).ready(function () {

    $("#registrar_proveedor").submit(function (e) {

        e.preventDefault();
        let url = "/sistema_estefany/app/proveedor/crear_proveedor.php";
        let data = new FormData(this);

        $.ajax({
            type: "POST",
            url: url,
            data: data,
            processData: false, // tell jQuery not to process the data
            contentType: false,
            success: function (response) {
                response = JSON.parse(response);

                alerta(response.tipo, response.mensaje);
                
                $(".modal").modal("hide");
                listar_proveedor();
                


            } // tell jQuery not to set contentType
        })
        return false;


    })
})


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
$("#form_actualizar_proveedor").submit(function (e) {

    e.preventDefault();
    let url = "/sistema_estefany/app/proveedor/actualizar_proveedor.php";
    console.log(this);
    let data = new FormData(this);

    $.ajax({
        type: "POST",
        url: url,
        data: data,
        processData: false, // tell jQuery not to process the data
        contentType: false,
        success: function (response) {
            response = JSON.parse(response);
            listar_proveedor();
            alerta(response.tipo, response.mensaje);

            $("#nombre_proveedor_input").val("");
            $("#telefono_proveedor_input").val("");
            $("#direccion_proveedor_input").val("");
         



        } // tell jQuery not to set contentType

    })
    return false;
 

})