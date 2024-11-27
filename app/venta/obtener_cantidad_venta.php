<?php 
if(!defined("ROOT")){
    include "../config/config.php";

}
?>
<?php
include ROOT . "/models/modeloVenta.php";
include ROOT . "/config/clase.php";

class CantidadVenta {
    function cantidad(){
        $modelo = new ModeloVenta();
        $cantidad = $modelo->get_count();
        return $cantidad;
    }
}

$cantidad = new CantidadVenta();
echo $cantidad->cantidad();