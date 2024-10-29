<?php

if (!class_exists('Model')) {
    include ROOT . "/models/base.php";
    
}

class ModeloProveedor extends Model
{

    public $table = "proveedor";

}