<?php 
if(!defined("ROOT")){
    include "../config/config.php";

}
?>
<?php
include ROOT . "/models/modeloProveedor.php";
include ROOT . "/config/clase.php";

class CantidadProveedores {
    function cantidad(){
        $modelo = new ModeloProveedor();
        $cantidad = $modelo->get_count();
        return $cantidad;
    }
}

$cantidad = new CantidadProveedores();
echo $cantidad->cantidad();