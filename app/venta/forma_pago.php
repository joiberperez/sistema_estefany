<?php
if(!defined("ROOT")){
    include "../config/config.php";

}
?>
<?php
include ROOT . "/models/modeloFormaPago.php";
include ROOT . "/config/clase.php";

function obtener_forma_pago(){
    
    $modelo = new ModeloFormaPago();
    $data =  $modelo->getAll();
    
    return $data;
}

$pagos = obtener_forma_pago();



?>

<select class="form-select" name="forma_pago" id="forma_pago">
    <?php  foreach ($pagos as $pago):  ?>
            <option value="<?= $pago['id'] ?>"><?= $pago['nombre'] ?></option>
    <?php  endforeach ?>
</select>
