<?php
if(!defined("ROOT")){
    include "../config/config.php";

}
?>
<?php
include ROOT . "/models/modeloCliente.php";
include ROOT . "/config/clase.php";
class Cliente extends BaseClase
{
    

    public function listarCliente()
    {
        $modelo = new ModeloCliente();

        
        $page = $_GET["page"] ?? "";
        // Obtener el filtro
        $filtro = $_GET["filtro"] ?? ""; // Uso del operador null coalescing

        // Contar total de registros
        $totalRegistros = $modelo->get_count(campo: 'cedula_cliente', filtro: $filtro);
        $registrosPorPagina = 5;
        $totalPaginas = ceil($totalRegistros / $registrosPorPagina);
        
        // Determinar la página actual
        $paginaActual = max(1, min($totalPaginas, (int)($page ?? 1)));

        // Calcular el offset
        $offset = ($paginaActual - 1) * $registrosPorPagina;

        // Obtener los registros de la página actual
        $data = $modelo->get_page($registrosPorPagina, max(0, $offset), $filtro, campo: 'cedula_cliente');
        
        // Renderizar la vista
        
        
        // Mensaje si no hay resultados
        if (empty($data)) {
            echo "<h1 style='text-align:center'>No se ha encontrado los resultados</h1>";
        }

        return ["data"=>$data,"paginaActual"=>$paginaActual,"totalPaginas"=>$totalPaginas,"page"=>$page];
    }

  


}

$clienteListado = new Cliente();
if($_SERVER["REQUEST_METHOD"]==="GET"){
    
    $context = $clienteListado->listarCliente(); 
    extract($context);
    
}


?>


<table class="table" >

    <thead>
        
        <th>nombre</th>
        <th>Cedula</th>
        <th>Direccion</th>
        <th>Telefono</th>
    </thead>
    <tbody class="table-border-bottom-0">

        <?php foreach ($data as $cliente) { ?>
            <tr>

                
                <td><?= $cliente["nombre_cliente"]; ?></td>
                <td>V- <?= $cliente["cedula_cliente"]; ?></td>

                <td><?= $cliente["telefono_cliente"]; ?></td>
                <td>
                    <button type="button" class="btn rounded-pill btn-icon btn-outline-danger" onclick="eliminar_cliente(<?= $cliente['id_cliente'] ?>)"> 
                        <span class="tf-icons bx bx-trash"></span>
                    </button>
                    <button type="button" class="btn rounded-pill btn-icon btn-outline-primary" onclick="actualizarCliente(<?= $cliente['id_cliente'] ?>)">

                        <span class="tf-icons bx bx-pencil"></span>
                    </button>
                </td>

            </tr>
        <?php } ?>




    </tbody>
</table>
<input type="hidden" id="url-paginacion" data-url="/sistema_estefany/app/cliente/listar_cliente.php">
<?php include ROOT . "/plantillas/paginacion.php" ?>