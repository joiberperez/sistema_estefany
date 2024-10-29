<?php
if(!defined("ROOT")){
    include "../config/config.php";

}
include ROOT . "/models/modeloProducto.php";
    class EliminarProducto {
        function eliminar_producto(){
            if(!empty($_GET["id"])){
                
                $modelo = new ModeloProducto();
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

    
    $cliente_eliminar = new EliminarProducto();
    $cliente_eliminar->eliminar_producto();
?>
