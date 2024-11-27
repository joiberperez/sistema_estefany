<?php

if (!class_exists('Model')) {
    include ROOT . "/models/base.php";
    
}

class ModeloUsuario extends Model
{

    public $table = "seguridad";
    public function selectUser($usuario){
        $query = $this->conn->query("SELECT * FROM $this->table where nombre_usuario='$usuario'");
        return $query;
    }
    
    function create($array_data){
        try {
            $db = $this->conn->prepare($this->create_insert_sql($array_data)); # Prepara el registro
            $db->execute($array_data); # Ejecuta y pasa los datos
            $id = $this->conn->lastInsertId();
            return $id;
        } catch (Exception $e) {
            echo json_encode(["tipo"=>"danger", "mensaje"=>$e->getMessage()]); // Manejo de excepciones
            exit(); # Mata la ejecucion del codigo
        }
    }
}