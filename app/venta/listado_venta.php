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
        
        <th>Metodo Pago</th>
        <th>Total</th>
    </thead>
    <tbody class="table-border-bottom-0">

        <?php foreach ($data as $producto) { ?>
            <tr>

            
                <td><?= $producto["id"]; ?></td>
                <td><?= $producto["cliente_cedula"]; ?></td>

                <td><?= $producto["metodo_pago_nombre"]; ?></td>
                <td>$<?= $producto["total"]; ?></td>
                
                
                <td>
                    <a type="button" href="/sistema_estefany/app/venta/pdf_venta.php?venta_id=<?=  $producto["id"]; ?>" class="btn rounded-pill btn-icon btn-outline-primary">

                    <i class="fa-regular fa-file-pdf"></i>
        </a>
                </td>

            </tr>
        <?php } ?>




    </tbody>
</table>
<input type="hidden" id="url-paginacion" data-url="/sistema_estefany/app/venta/listado_venta.php">
<?php include ROOT . "/plantillas/paginacion.php" ?>