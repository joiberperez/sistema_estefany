<?php

if (!class_exists('Model')) {
    include ROOT . "/models/base.php";
    
}

class ModeloFormaPago extends Model
{

    public $table = "metodo_pago";

}