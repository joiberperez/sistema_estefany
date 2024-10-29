<?php
if(!defined("ROOT")){
    include "../config/config.php";

}
include ROOT . "/models/modeloCliente.php";
    class EliminarCliente {
        function eliminar_cliente(){
            if(!empty($_GET["id"])){
                
                $modelo = new ModeloCliente();
                $cliente_id = $_GET["id"];
                $consulta = $modelo->eliminarRegistro($cliente_id,campo:"id_cliente");
                if ($consulta->rowCount() > 0) {
                    echo json_encode(["mensaje"=>"Se ha eliminado exitosamente."]);
                   
                } else {
                    echo "No se encontró el registro con el ID especificado.";
                }
                

            }
        }
    }

    
    $cliente_eliminar = new EliminarCliente();
    $cliente_eliminar->eliminar_cliente();
?>
