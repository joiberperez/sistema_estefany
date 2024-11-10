$(document).ready(function () {
    listar_venta();
    listar_producto_agotado();

})

function listar_venta() {
    $.get("/sistema_estefany/app/reporte/listado_reportes_venta.php").done(function (data) {
        $("#data-table-venta").html(data);
    })

}
function listar_producto_agotado() {
    $.get("/sistema_estefany/app/reporte/listado_reporte_producto_agotado.php").done(function (data) {
        $("#data-table-producto").html(data);
    })

}

    function cargarPaginaProducto(page,url) {
       //let url = $("#url-paginacion").data("url");
       console.log(url);
       $.get(url,{page}).done(function(e) {
            
                $("#data-table-producto").html(e)

            
            
        })
    }
    function cargarPaginaVenta(page,url) {
       //let url = $("#url-paginacion").data("url");
       console.log(url);
       $.get(url,{page}).done(function(e) {
            
            
         
                $("#data-table-venta").html(e)

            
            
        })
    }
