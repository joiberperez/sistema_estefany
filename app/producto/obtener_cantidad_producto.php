<?php 
if(!defined("ROOT")){
    include "../config/config.php";

}
?>
<?php
include ROOT . "/models/modeloProducto.php";
include ROOT . "/config/clase.php";

class CantidadProductos {
    function cantidad(){
        $modelo = new ModeloProducto();
        $cantidad = $modelo->get_count();
        return $cantidad;
    }
}

$cantidad = new CantidadProductos();
echo $cantidad->cantidad();