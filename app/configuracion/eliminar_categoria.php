<?php
if(!defined("ROOT")){
    include "../config/config.php";

}
session_start();
include ROOT . "/models/modeloLogs.php";
include ROOT . "/models/modeloCategoria.php";
class EliminarCategoria {
    function eliminar_categoria(){
        if(!empty($_GET["id"])){
            
            $modelo = new ModeloCategoria();
            $id = $_GET["id"];
            $consulta = $modelo->eliminarRegistro($id,campo:"id");
            if ($consulta->rowCount() > 0) {
                $log = new ModeloLogs();
                $log->logUserAccion($_SESSION["user"]["id"], 'eliminar_categoria', 'El usuario ha eliminado una categoria.');
                echo json_encode(["mensaje"=>"Se ha eliminado exitosamente."]);
                   
                } else {
                    echo "No se encontró el registro con el ID especificado.";
                }
                

            }
        }
    }

    
    $cliente_eliminar = new EliminarCategoria();
    $cliente_eliminar->eliminar_categoria();
?>
