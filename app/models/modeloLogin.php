<?php

if (!class_exists('Model')) {
    include ROOT . "/models/base.php";
    
}



class ModeloLogin extends Model {
    public $table = "seguridad";

    //hace la seleccion del usuario
    public function selectUser($usuario){
        $query = $this->conn->query("SELECT * FROM $this->table where nombre_usuario='$usuario'");
        return $query;
    }

}
