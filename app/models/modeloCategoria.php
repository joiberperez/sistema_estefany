<?php

if (!class_exists('Model')) {
    include ROOT . "/models/base.php";
    
}



class ModeloCategoria extends Model {
    public $table = "categoria";

}
