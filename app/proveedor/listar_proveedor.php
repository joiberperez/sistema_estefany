<?php
if(!defined("ROOT")){
    include "../config/config.php";

}
?>
<?php
include ROOT . "/models/modeloProveedor.php";
include ROOT . "/config/clase.php";
class Proveedor extends BaseClase
{
    

    public function listarProveedor()
    {
        $modelo = new ModeloProveedor();

        
        $page = $_GET["page"] ?? "";
        // Obtener el filtro
        $filtro = $_GET["filtro"] ?? ""; // Uso del operador null coalescing

        // Contar total de registros
        $totalRegistros = $modelo->get_count(campo: 'nombre', filtro: $filtro);
        $registrosPorPagina = 5;
        $totalPaginas = ceil($totalRegistros / $registrosPorPagina);
        
        // Determinar la página actual
        $paginaActual = max(1, min($totalPaginas, (int)($page ?? 1)));

        // Calcular el offset
        $offset = ($paginaActual - 1) * $registrosPorPagina;

        // Obtener los registros de la página actual
        $data = $modelo->get_page($registrosPorPagina, max(0, $offset), $filtro, campo: 'nombre');
        
        // Renderizar la vista
        
        
        // Mensaje si no hay resultados
        if (empty($data)) {
            echo "<h1 style='text-align:center'>No se ha encontrado los resultados</h1>";
        }

        return ["data"=>$data,"paginaActual"=>$paginaActual,"totalPaginas"=>$totalPaginas,"page"=>$page];
    }

  


}

$clienteListado = new Proveedor();
if($_SERVER["REQUEST_METHOD"]==="GET"){
    
    $context = $clienteListado->listarProveedor(); 
    extract($context);
    
}


?>


<table class="table" >

    <thead>
        
        <th>id</th>
        <th>nombre</th>
        
        <th>Telefono</th>
    </thead>
    <tbody class="table-border-bottom-0">

        <?php foreach ($data as $proveedor) { ?>
            <tr>

                
                <td><?= $proveedor["id"]; ?></td>
                <td><?= $proveedor["nombre"]; ?></td>
                
                <td><?= $proveedor["telefono"]; ?></td>

                <td>
                    <button type="button" class="btn rounded-pill btn-icon btn-outline-danger">
                        <span class="tf-icons bx bx-trash" onclick="eliminar_proveedor(<?= $proveedor['id'] ?>)"></span>
                    </button>
                    <button type="button" class="btn rounded-pill btn-icon btn-outline-primary" onclick="actualizarProveedor(<?= $proveedor['id'] ?>)">

                        <span class="tf-icons bx bx-pencil"></span>
                    </button>
                </td>

            </tr>
        <?php } ?>




    </tbody>
</table>
<input type="hidden" id="url-paginacion" data-url="/sistema_estefany/app/proveedor/listar_proveedor.php">
<?php include ROOT . "/plantillas/paginacion.php" ?>

