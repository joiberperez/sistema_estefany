<?php
if(!defined("ROOT")){
    include "../config/config.php";

}
include ROOT . "/models/modeloUsuario.php";
    class EliminarUsuario {
        function eliminar_usuario(){
            if(!empty($_GET["id"])){
                
                $modelo = new ModeloUsuario();
                $usuario_id = $_GET["id"];
                $consulta = $modelo->eliminarRegistro($usuario_id,"id");
                if ($consulta->rowCount() > 0) {
                    echo json_encode(["mensaje"=>"Se ha eliminado exitosamente."]);
                   
                } else {
                    echo "No se encontró el registro con el ID especificado.";
                }
                

            }
        }
    }

    
    $usuario_eliminar = new EliminarUsuario();
    $usuario_eliminar->eliminar_usuario();
?>