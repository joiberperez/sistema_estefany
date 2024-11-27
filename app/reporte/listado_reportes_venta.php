<?php
if (!defined("ROOT")) {
    include "../config/config.php";
}
?>
<?php
include ROOT . "/models/modeloVenta.php";
include ROOT . "/config/clase.php";


class ReporteVentaListado extends BaseClase
{


    public function listar_productos()
    {
        $modelo = new ModeloVenta();


        $page = $_GET["page"] ?? "";
        // Obtener el filtro
        $filtro = $_GET["filtro"] ?? ""; // Uso del operador null coalescing

        // Contar total de registros

        $totalRegistros = $modelo->get_count(campo: 'id', filtro: $filtro);
        $registrosPorPagina = 5;
        $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

        // Determinar la página actual
        $paginaActual = max(1, min($totalPaginas, (int)($page ?? 1)));

        // Calcular el offset
        $offset = ($paginaActual - 1) * $registrosPorPagina;

        // Obtener los registros de la página actual
        $data = $modelo->get_page($registrosPorPagina, max(0, $offset), $filtro, campo: 'id');

        // Renderizar la vista


        // Mensaje si no hay resultados
        if (empty($data)) {
            echo "<h1 style='text-align:center'>No se ha encontrado los resultados</h1>";
        }

        return ["data" => $data, "paginaActual" => $paginaActual, "totalPaginas" => $totalPaginas, "page" => $page];
    }
}


$productoListado = new ReporteVentaListado();
if ($_SERVER["REQUEST_METHOD"] === "GET") {

    $context = $productoListado->listar_productos();
    extract($context);
}

?>

<table class="table">

    <thead>
        <tr>
            <th>#</th>
            <th>Cliente</th>
            <th>Total</th>
            <th>Metodo Pago</th>
        </tr>
    </thead>
    <tbody class="table-border-bottom-0">

        <?php foreach ($data as $venta) { ?>
            <tr>


                <td><?= $venta["id"]; ?></td>
                <td><?= $venta["cliente_cedula"]; ?></td>
                <td>$<?= $venta["total"]; ?></td>
                <td><?= $venta["metodo_pago_nombre"]; ?></td>
                


            </tr>
        <?php } ?>




    </tbody>
</table>
</table>
<input type="hidden" id="url-paginacion" data-url="/sistema_estefany/app/reporte/listado_reportes_venta.php">
<input type="hidden" id="contenedor-tabla" data-contenedor="data-table-venta" >
<nav aria-label="Page navigation">
    <ul class="pagination">
        <?php if ($paginaActual > 1) { ?>
            <li class="page-item">
                <a class='page-link' href="javascript:void(0);" onclick='cargarPaginaVenta(<?= ($paginaActual - 1) ?>,"/sistema_estefany/app/reporte/listado_reportes_venta.php")' aria-label="Previous">
                    <i class="tf-icon bx bx-chevrons-left"></i>
                </a>
            </li>
        <?php } ?>

        <?php
        // Mostrar páginas
        $start = max(1, $paginaActual - 4); // Muestra hasta 4 páginas hacia atrás
        $end = min($totalPaginas, $start + 8); // Muestra hasta 8 páginas hacia adelante

        // Asegura que siempre se muestren al menos 9 páginas
        if ($end - $start < 8) {
            $start = max(1, $end - 8);
        }

        // Mostrar "..." y la primera página si es necesario
        if ($start > 2) {
            echo '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="cargarPaginaVenta(1,"/sistema_estefany/app/reporte/listado_reportes_venta.php")">1</a></li>';
            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }

        for ($i = $start; $i <= $end; $i++) {
            if ($i == $paginaActual) { ?>
                <li class="page-item active">
                    <span class='page-link'><?= $i ?></span>
                </li>
            <?php } else { ?>
                <li class="page-item">
                    <a class='page-link' href="javascript:void(0);" onclick='cargarPaginaVenta(<?= $i ?>,"/sistema_estefany/app/reporte/listado_reportes_venta.php")'><?= $i ?></a>
                </li>
            <?php }
        }

        // Si hay más de 9 páginas y la última no está en el rango, mostrar "..."
        if ($totalPaginas > 9 && $end < $totalPaginas) {
            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }

        // Mostrar la última página solo si no está visible
        if ($end < $totalPaginas) { ?>
            <li class="page-item">
                <a class='page-link' href="javascript:void(0);" onclick='cargarPaginaVenta(<?= $totalPaginas ?>,"/sistema_estefany/app/reporte/listado_reportes_venta.php")'><?= $totalPaginas ?></a>
            </li>
        <?php } ?>

        <?php if ($paginaActual < $totalPaginas) { ?>
            <li class="page-item">
                <a class='page-link' href="javascript:void(0);" onclick='cargarPaginaVenta(<?= ($paginaActual + 1) ?>,"/sistema_estefany/app/reporte/listado_reportes_venta.php")' aria-label="Next">
                    <i class="tf-icon bx bx-chevrons-right"></i>
                </a>
            </li>
        <?php } ?>
    </ul>
</nav>
