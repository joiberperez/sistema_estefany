<?php
if(!defined("ROOT")){
    include "../config/config.php";

}
include ROOT . "/models/modeloProveedor.php";
    class EliminarProveedor {
        function eliminar_proveedor(){
            if(!empty($_GET["id"])){
                
                $modelo = new ModeloProveedor();
                $proveedor_id = $_GET["id"];
                $consulta = $modelo->eliminarRegistro($proveedor_id,"id");
                if ($consulta->rowCount() > 0) {
                    echo json_encode(["mensaje"=>"Se ha eliminado exitosamente."]);
                   
                } else {
                    echo "No se encontró el registro con el ID especificado.";
                }
                

            }
        }
    }

    
    $cliente_eliminar = new EliminarProveedor();
    $cliente_eliminar->eliminar_proveedor();
?>
