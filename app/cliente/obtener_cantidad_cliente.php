<?php 
if(!defined("ROOT")){
    include "../config/config.php";

}
?>
<?php
include ROOT . "/models/modeloCliente.php";
include ROOT . "/config/clase.php";

class CantidadClientes {
    function cantidad(){
        $modelo = new ModeloCliente();
        $cantidad = $modelo->get_count();
        return $cantidad;
    }
}

$cantidad = new CantidadClientes();
echo $cantidad->cantidad();