<?php

if (!class_exists('Model')) {
    include ROOT . "/models/base.php";
    
}



class ModeloInventario extends Model {
    public $table = "inventario";

}
