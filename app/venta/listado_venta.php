<?php
if(!defined("ROOT")){
    include "../config/config.php";
}
?>
<?php
include ROOT . "/models/modeloVenta.php";
include ROOT . "/config/clase.php";


class ProductoListado extends BaseClase
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

        // Obtener los registros de la página actual
        $data = $modelo->get_page($registrosPorPagina, max(0, $offset), $filtro, campo: 'id');
        
        // Renderizar la vista
        
        
        // Mensaje si no hay resultados
        if (empty($data)) {
            echo "<h1 style='text-align:center'>No se ha encontrado los resultados</h1>";
        }

        return ["data"=>$data,"paginaActual"=>$paginaActual,"totalPaginas"=>$totalPaginas,"page"=>$page];
    }

  


}


$productoListado = new ProductoListado();
if($_SERVER["REQUEST_METHOD"]==="GET"){
    
    $context = $productoListado->listar_productos(); 
    extract($context);
    
    
}

?>
<table class="table" >

    <thead>
        
        <th>#</th>
        <th>Cliente</th>
        <th>Estado</th>
        <th>Total</th>
    </thead>
    <tbody class="table-border-bottom-0">

        <?php foreach ($data as $producto) { ?>
            <tr>

            
                <td><?= $producto["id"]; ?></td>
                <td>$<?= $producto["cliente_cedula"]; ?></td>

                <td><?= $producto["metodo_pago"]; ?></td>
                <td>
                    <?php if($producto["estado"] === "realizado" ):?>
                        <span class="badge  bg-label-success"><?= $producto["estado"]; ?></span>
                    <?php else: ?>
                        <span class="badge  bg-label-danger"><?= $producto["estado"]; ?></span>
                    
                    <?php endif; ?>
                    
                </td>
                
                <td>
                    <button type="button" class="btn rounded-pill btn-icon btn-outline-danger" onclick="eliminar_producto(<?= $producto['id'] ?>)"> 
                        <span class="tf-icons bx bx-trash"></span>
                    </button>
                    <button type="button" class="btn rounded-pill btn-icon btn-outline-primary" onclick="actualizarProducto(<?= $producto['id'] ?>)">

                        <span class="tf-icons bx bx-pencil"></span>
                    </button>
                </td>

            </tr>
        <?php } ?>




    </tbody>
</table>
<input type="hidden" id="url-paginacion" data-url="/sistema_estefany/app/venta/listado_venta.php">
<?php include ROOT . "/plantillas/paginacion.php" ?>