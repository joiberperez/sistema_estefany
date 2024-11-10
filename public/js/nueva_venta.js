let productos = [];
let cliente_id;
$(document).ready(function () {

    $("#select_cliente").select2({
        theme: 'bootstrap-5', // Aplicar tema Bootstrap 5 (requiere configuración)
        placeholder: 'Selecciona una o más opciones',
        minimumInputLength: 3,
        language: "es",
        ajax: {
            url: '/sistema_estefany/app/cliente/obtener_cliente.php', // URL del servidor que devuelve datos
            dataType: 'json', // Tipo de datos esperados
            delay: 250, // Retardo antes de realizar la solicitud
            processResults: function (data) {
                console.log(data);
                // Procesar los resultados recibidos del servidor

                return {
                    results: data.map(function (cliente) {
                        return {
                            id: cliente.id_cliente, // El valor del ID del país
                            text: cliente.nombre_cliente // El texto a mostrar en el dropdown
                        };
                    })
                };
            },
            cache: true
        }
    });

})
function habilitar_boton() {
    const boton = document.getElementById("btn_venta")
    if (cliente_id && (productos.length > 0)) {

        boton.disabled = false;

    } else {
        boton.disabled = true;

    }

}

$('#select_cliente').on('select2:select', function (e) {
    const data = e.params.data;  // Datos de la opción seleccionada
    console.log(data);
    cliente_id = data.id;
    habilitar_boton();

});
function listarProductosVenta() {
    let filtro = $("#buscarProducto").val();
    $.get("/sistema_estefany/app/venta/busqueda_producto.php", {
        filtro
    }).done(function (data) {
        $("#listado_producto").html(data);
    })
}
function cargar_producto(id_producto) {

    $.get("/sistema_estefany/app/venta/obtener_detalle_producto.php", {
        id: id_producto
    }).done(function (data) {
        $("#detalle_producto").html(data);
        $("#listado_producto").html("");
        $("#buscarProducto").val("");
    })
}
function calcular_precio_producto(precio) {
    let cantidad = $("#cantidad").val();
    cantidad = cantidad.replace(",", ".")
    $("#precio_total").val((parseFloat(cantidad) * parseFloat(precio)).toFixed(2))

}
function increment(cantidad, precio) {

    let input = $("#cantidad").val();

    if (input !== cantidad) {
        $("#cantidad").val(parseInt(input) + 1)
        $("#precio_total_producto").val(((parseInt(input) + 1) * parseFloat(precio)).toFixed(2))

    } else {

        alerta("danger", "la cantidad seleccionada no puede sobrepasar a la registrada");

    }

}
function borrarProducto(event) {
    console.log(event);
    const fila = event.target.closest('tr');
    const indice = fila.getAttribute('data-index');

    // Elimina el producto del array
    productos.splice(indice, 1);

    // Actualiza la tabla
    crearTablaProductos();

}
function crearTablaProductos() {
    const total_venta = document.getElementById('total_venta');
    let total = 0;


    const tablaCuerpo = document.getElementById('productosTabla').querySelector('tbody');
    tablaCuerpo.innerHTML = '';
    productos.forEach((producto, index) => {
        const fila = document.createElement('tr');
        fila.setAttribute('data-index', index);
        console.log(producto);
        // Columnas
        fila.innerHTML = `
        <td>${producto.codigo}</td>
        <td>${producto.nombre}</td>
        <td>${producto.cantidad}</td>
        <td>$${producto.precio}</td>
        <td>$${producto.precio_total_producto}</td>
        
      `;
        const botonEliminar = document.createElement('button');
        botonEliminar.className = 'btn rounded-pill btn-icon btn-outline-danger';
        botonEliminar.innerHTML = '<span class="tf-icons bx bx-trash"</span>';

        // Asigna la función borrarProducto pasando el evento
        botonEliminar.onclick = borrarProducto;

        // Crear celda para el botón y añadirlo a la fila
        const celdaAccion = document.createElement('td');
        celdaAccion.appendChild(botonEliminar);
        fila.appendChild(celdaAccion);
        tablaCuerpo.appendChild(fila);
        total = total + producto.precio_total_producto;
    });

    total_venta.innerHTML = `$${total}`;
    habilitar_boton();
}
function agregarProducto() {
    const codigo = $("#codigo").val();
    const nombre = $("#nombre").val();
    const cantidad = $("#cantidad").val();
    const precio = $("#precio").val();
    const precio_total_producto = parseFloat($("#precio_total_producto").val());
    const producto = { codigo, nombre, cantidad, precio, precio_total_producto };
    productos.push(producto);
    limpiarCampos();
    crearTablaProductos();

}
function limpiarCampos() {
    $("#codigo").val("");
    $("#nombre").val("");
    $("#cantidad").val("");
    $("#precio").val("");
    $("#precio_total").val("");
}
function decrement(precio) {
    let input = $("#cantidad").val();
    if (input > 1) {
        $("#cantidad").val(parseInt(input) - 1)
        $("#precio_total_producto").val(((parseInt(input) - 1) * parseFloat(precio)).toFixed(2))

    }

}

function abrirModal() {
    let data = new FormData();
    data.append("venta", JSON.stringify(productos));
    $.get("/sistema_estefany/app/venta/forma_pago.php").done(response => $("#select_container").html(response));
    $('#basicModal').modal("show");
    /* const peticion = fetch("/sistema_estefany/app/venta/forma_pago.php",{method:"POST",body:data});
    peticion.then((response)=>response.text())
    .then(response => console.log(response)); */
}
$("#registrar_venta").submit(function (e) {

    e.preventDefault();
    let url = "/sistema_estefany/app/venta/crear_venta.php";
    let data = new FormData(this);
    data.append("venta_productos", JSON.stringify(productos));
    data.append("cliente_id", cliente_id);

    $.ajax({
        type: "POST",
        url: url,
        data: data,
        processData: false, // tell jQuery not to process the data
        contentType: false,
        success: function (response) {
            response = JSON.parse(response);
            $(".modal").modal("hide");
            Swal.fire({
                title: "En hora buena",
                text: response.mensaje,
                icon: response.tipo,
                showConfirmButton: true,
                confirmButtonText: "ok",
                
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.reload();
                   
                }
            });





        } // tell jQuery not to set contentType
    })
    return false;

    /*     $.post("/sistema_estefany/app/cliente/crear_cliente.php").done(function(data) {
          $("#modal-container").html(data);
          $(".modal").modal("show");
        }) */

})