$(document).ready(function () {
    listar_clientes();

})

function listar_clientes() {
    $.get("/sistema_estefany/app/cliente/listar_cliente.php").done(function (data) {
        $("#data-table").html(data);
    })

}

function eliminar_cliente(id){
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
            $.get("/sistema_estefany/app/cliente/eliminar_cliente.php", {id}).done(function(response){
                response = JSON.parse(response);
                Swal.fire({
                  title: "Eliminado!",
                  text: response.mensaje,
                  icon: "error"
                });
                listar_clientes();
                
            });
        }
      });
    
}



function actualizarCliente(id) {
    $.get("/sistema_estefany/app/cliente/actualizar_cliente.php", {
        id
    }).done(function (data) {
        $("#actualizar_cliente").html(data);
    })
}

$(document).ready(function () {

    $("#registrar_cliente").submit(function (e) {

        e.preventDefault();
        let url = "/sistema_estefany/app/cliente/crear_cliente.php";
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
                console.log(response)
                $(".modal").modal("hide");
                


            } // tell jQuery not to set contentType
        })
        return false;

        /*     $.post("/sistema_estefany/app/cliente/crear_cliente.php").done(function(data) {
              $("#modal-container").html(data);
              $(".modal").modal("show");
            }) */

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
$("#form_actualizar_cliente").submit(function (e) {

    e.preventDefault();
    let url = "/sistema_estefany/app/cliente/actualizar_cliente.php";
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
            listar_clientes();
            alerta(response.tipo, response.mensaje);

            $("#nombre_cliente_input").val("");
            $("#apellido_cliente_input").val("");
            $("#cedula_cliente_input").val("");
            $("#telefono_cliente_input").val("");



        } // tell jQuery not to set contentType

    })
    return false;
   

})