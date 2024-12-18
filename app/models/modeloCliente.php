<?php

if (!class_exists('Model')) {
    include ROOT . "/models/base.php";
    
}

class ModeloCliente extends Model
{

    public $table = "cliente";

}