<?php
if (!defined("ROOT")) {
    include "../config/config.php";
}
?>
<?php
include ROOT . "/models/modeloProducto.php";
include ROOT . "/config/clase.php";


class ReporteProductoListado extends BaseClase
{


    public function listar_productos()
    {
        $modelo = new ModeloProducto();


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
        $sql = "
        SELECT 
            p.*, 
            c.nombre AS categoria_nombre, 
            i.cantidad_disponible AS cantidad
        FROM 
            producto p
        LEFT JOIN 
            categoria c ON p.categoria_id = c.id
        LEFT JOIN 
            inventario i ON p.id = i.producto_id
        WHERE 
            i.cantidad_disponible <= 5 
        LIMIT 
            :limit OFFSET :offset";
        // Obtener los registros de la página actual
        $stmt = $modelo->conn->prepare($sql);
        $stmt->bindParam(':limit', $registrosPorPagina, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Renderizar la vista


        // Mensaje si no hay resultados
        if (empty($data)) {
            echo "<h1 style='text-align:center'>No se ha encontrado los resultados</h1>";
        }

        return ["data" => $data, "paginaActual" => $paginaActual, "totalPaginas" => $totalPaginas, "page" => $page];
    }
}


$productoListado = new ReporteProductoListado();
if ($_SERVER["REQUEST_METHOD"] === "GET") {

    $context = $productoListado->listar_productos();
    extract($context);
}

?>

<table class="table">

    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
        </tr>
    </thead>
    <tbody class="table-border-bottom-0">

        <?php foreach ($data as $venta) { ?>
            <tr>


                <td><?= $venta["id"]; ?></td>
                <td><?= $venta["nombre"]; ?></td>
                <td>$<?= $venta["precio"]; ?></td>
                <td><?= $venta["cantidad"]; ?></td>
                


            </tr>
        <?php } ?>




    </tbody>
</table>
</table>
<input type="hidden" id="url-paginacion" data-url="/sistema_estefany/app/reporte/listado_reporte_producto_agotado.php">
<input type="hidden" id="contenedor-tabla" data-contenedor="data-table-producto" >
<nav aria-label="Page navigation">
    <ul class="pagination">
        <?php if ($paginaActual > 1) { ?>
            <li class="page-item">
                <a class='page-link' href="javascript:void(0);" onclick='cargarPaginaProducto(<?= ($paginaActual - 1) ?>,"/sistema_estefany/app/reporte/listado_reporte_producto_agotado.php")' aria-label="Previous">
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
            echo '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="cargarPaginaProducto(1,"/sistema_estefany/app/reporte/listado_reporte_producto_agotado.php")">1</a></li>';
            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }

        for ($i = $start; $i <= $end; $i++) {
            if ($i == $paginaActual) { ?>
                <li class="page-item active">
                    <span class='page-link'><?= $i ?></span>
                </li>
            <?php } else { ?>
                <li class="page-item">
                    <a class='page-link' href="javascript:void(0);" onclick='cargarPaginaProducto(<?= $i ?>,"/sistema_estefany/app/reporte/listado_reporte_producto_agotado.php")'><?= $i ?></a>
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
                <a class='page-link' href="javascript:void(0);" onclick='cargarPaginaProducto(<?= $totalPaginas ?>,"/sistema_estefany/app/reporte/listado_reporte_producto_agotado.php")'><?= $totalPaginas ?></a>
            </li>
        <?php } ?>

        <?php if ($paginaActual < $totalPaginas) { ?>
            <li class="page-item">
                <a class='page-link' href="javascript:void(0);" onclick='cargarPaginaProducto(<?= ($paginaActual + 1) ?>,"/sistema_estefany/app/reporte/listado_reporte_producto_agotado.php")' aria-label="Next">
                    <i class="tf-icon bx bx-chevrons-right"></i>
                </a>
            </li>
        <?php } ?>
    </ul>
</nav>