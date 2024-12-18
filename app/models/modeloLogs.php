<?php

if (!class_exists('Model')) {
    include ROOT . "/models/base.php";
}



class ModeloLogs extends Model
{
    public $table = "user_Logs";



    function logUserAccion($userId, $accion, $descripcion)
    {
        // Conexión a la base de datos
        

        // SQL para insertar el log
        $stmt = $this->conn->prepare("INSERT INTO user_logs (usuario_id, accion, descripcion) VALUES (:userId, :accion, :descripcion)");
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':accion', $accion);
        $stmt->bindParam(':descripcion', $descripcion);

        // Ejecutar la consulta
        $stmt->execute();
    }
}
