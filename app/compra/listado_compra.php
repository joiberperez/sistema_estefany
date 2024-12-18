    <?php
if(!defined("ROOT")){
    include "../config/config.php";
}
?>
<?php
include ROOT . "/models/modeloCompra.php";
include ROOT . "/config/clase.php";

class CompraListado extends BaseClase
{
    

    public function listar_compra()
    {
        $modelo = new ModeloCompra();

        
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


$compra_listado = new CompraListado();
if($_SERVER["REQUEST_METHOD"]==="GET"){
    
    $context = $compra_listado->listar_compra(); 
    extract($context);
    
    
}


?>
<table class="table" >

    <thead>
        
        <th>#</th>
        <th>producto</th>
        <th>proveedor</th>
        <th>Cantidad</th>
        
    </thead>
    <tbody class="table-border-bottom-0">

        <?php foreach ($data as $compra) { ?>
            <tr>

                
                <td><?= $compra["id"]; ?></td>
                <td><?= $compra["nombre_producto"]; ?></td>

                <td><?= $compra["nombre_proveedor"]; ?></td>
                <td><?= $compra["cantidad"]; ?></td>
                <td>
                    <button type="button" class="btn rounded-pill btn-icon btn-outline-primary" onclick="detalle_compra(<?= $compra['id'] ?>)">

                        <span class="tf-icons bx bx-pencil"></span>
                    </button>
                </td>

            </tr>
        <?php } ?>




    </tbody>
</table>
<input type="hidden" id="url-paginacion" data-url="/sistema_estefany/app/compra/listado_compra.php">
<?php include ROOT . "/plantillas/paginacion.php" ?>
