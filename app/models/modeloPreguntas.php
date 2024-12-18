<?php

if (!class_exists('Model')) {
    include ROOT . "/models/base.php";
    
}



class ModeloPreguntas extends Model {
    public $table = "pregunta_usuario";

}
