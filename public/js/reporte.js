let filtroProductoAgotado;
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

function cargarPaginaProducto(page, url) {
    let filtro = filtroProductoAgotado;
    console.log(url);
    $.get(url, { page, filtro }).done(function (e) {

        $("#data-table-producto").html(e)


    })
}
function filtrarProductosAgotado(e) {
    let filtro = $("#buscarProductoAgotado").val();
    filtroProductoAgotado = filtro;
    console.log(filtro);
    $.get("/sistema_estefany/app/reporte/listado_reporte_producto_agotado.php", { filtro }).done(function (e) {

        $("#data-table-producto").html(e)
        $('#btn-reporte-producto').prop('disabled', false);



    })

}
function habilitarBotonFiltrarProducto() {
    $('#btn-filtrar-producto').prop('disabled', false);

}
function cargarPaginaVenta(page, url) {
    //let url = $("#url-paginacion").data("url");
    console.log(url);
    $.get(url, { page }).done(function (e) {



        $("#data-table-venta").html(e)



    })
}
function generar_pdf_venta() {

    window.open(`/sistema_estefany/app/reporte/pdf_venta.php?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`, '_blank');

}
function generar_pdf_producto() {
    let filtro = $("#buscarProductoAgotado").val();
    window.open(`/sistema_estefany/app/reporte/pdf_producto.php?filtro=${filtro}`, '_blank');


}
