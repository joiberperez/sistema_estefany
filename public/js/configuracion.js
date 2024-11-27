
$(document).ready(function () {
    listar_categoria();

    $("#enviar_dolar").click(function () {

        let dolar = $("#input_dolar").val();
        $.get("/sistema_estefany/app/dolar/actualizar_dolar.php", {
            dolar
        }, function (value) {
            $('#spinner').hide();

            $(".modal").modal("hide");
            $('#dolar_valor').text(value);
            $("#input_dolar").val("");

        })
    })
    $("#abrir_modal_dolar").click(function () {

        $("#RegistrarModalDolar").modal("show");


    })
    $("#abrir_modal_categoria").click(function () {

        $("#RegistrarModalCategoria").modal("show");


    })
})
function listar_categoria() {
    $.get("/sistema_estefany/app/configuracion/listado_categoria.php").done(function (data) {
        $("#data-table").html(data);
    })

}
function formatearNumero(input) {
    let valor = input.value.replace(/[.,]/g, ''); // Elimina puntos y comas previas

    // Asegúrate de que el valor sea numérico
    if (isNaN(valor)) {
        input.value = '';
        return;
    }

    // Divide en enteros y decimales después de los dos primeros dígitos
    let enteros = valor.slice(0, 2); // Los primeros dos dígitos como parte entera
    let decimales = valor.slice(2,4); // El resto como decimales
    let restoEnteros = valor.slice(4)

    // Formatea los enteros para incluir puntos cada tres dígitos
    enteros = enteros.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    
    // Concatenar enteros y decimales con coma para decimales
    input.value = decimales ? `${enteros}${restoEnteros},${decimales}` : enteros;
}
function eliminar_categoria(id) {
    Swal.fire({
        title: "Estas seguro?",
        text: "No se podra revertir la accion, ademas se borraran los productos que estén clasificados por esta categoria",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, borrar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            $.get("/sistema_estefany/app/configuracion/eliminar_categoria.php", { id }).done(function (response) {
                response = JSON.parse(response);
                Swal.fire({
                    title: "Eliminado!",
                    text: response.mensaje,
                    icon: "error"
                });
                listar_categoria();

            });
        }
    });
}

function actualizar_categoria(id) {
    $.get("/sistema_estefany/app/configuracion/actualizar_categoria.php", { id }).done(function (data) {
        $("#actualizar_categoria").html(data);
    })
}

$("#form_actualizar_categoria").submit(function (e) {

    e.preventDefault();
    let url = "/sistema_estefany/app/configuracion/actualizar_categoria.php";

    let data = new FormData(this);

    $.ajax({
        type: "POST",
        url: url,
        data: data,
        processData: false, // tell jQuery not to process the data
        contentType: false,
        success: function (response) {
            response = JSON.parse(response);
            listar_categoria();
            alerta(response.tipo, response.mensaje);

            let content = `<div class="card">
                                <h5 class="card-header">Detalle del Usuario</h5>
                                <div class="text-center text-sm-left">
                                    <div class="card-body px-0 px-md-4" id="actualizar_cliente">
                                        <img src="/sistema_estefany/public/image/cliente_interrogacion.png" height="250" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
                                    </div>

                                </div>
                            </div>`;
            $("#actualizar_categoria").html(content);



        } // tell jQuery not to set contentType

    })
    return false;


})
$("#resgistrarFormCategoria").submit(function (e) {

    e.preventDefault();
    let url = "/sistema_estefany/app/configuracion/registrar_categoria.php";

    let data = new FormData(this);

    $.ajax({
        type: "POST",
        url: url,
        data: data,
        processData: false, // tell jQuery not to process the data
        contentType: false,
        success: function (response) {
            response = JSON.parse(response);
            $("#RegistrarModalCategoria").modal("hide");
            listar_categoria();
            alerta(response.tipo, response.mensaje);
            



        } // tell jQuery not to set contentType

    })
    return false;


})