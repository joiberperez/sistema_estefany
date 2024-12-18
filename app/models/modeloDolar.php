<?php

if (!class_exists('Model')) {
    include ROOT . "/models/base.php";
    
}



class ModeloDolar extends Model {
    public $table = "dolar";

    public function actualizar_dolar($valor_dolar){
        $valor_dolar = (float)$valor_dolar;
        $this->conn->query("INSERT INTO dolar (id, valor) VALUES (1, $valor_dolar) ON DUPLICATE KEY UPDATE valor = $valor_dolar;");
      
    }

}