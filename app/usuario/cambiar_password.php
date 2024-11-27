<?php

if (!defined("ROOT")) {
    include "../config/config.php";
}
include ROOT . "/models/modeloUsuario.php";
include ROOT . "/config/clase.php";
session_start();
include ROOT . "/models/modeloLogs.php";



class CambiarPasswordUsuario extends BaseClase
{
    
    
    public function cambiar_password()
    {
        try {
            
            $modelo = new ModeloUsuario();
            
            $id = $_POST["id"];
            
            if (!empty($_POST["password"]) && !empty($_POST["password_confirmar"])) {
                $password = $_POST["password"];
                $password_confirmar = $_POST["password_confirmar"];
                
                if($password === $password_confirmar){
                    $password = password_hash($password,PASSWORD_DEFAULT);
                    $datos = [
                        "contrasena" => $password,
                    ];
                    $modelo->actualizarCliente($id,$datos,"id");
                    
                    $log = new ModeloLogs();
                    $log->logUserAccion($_SESSION["user"]["id"], 'actualizar_usuario', 'El usuario ha actualizado su contraseña.');
                    echo json_encode(["tipo"=>"success","mensaje"=>"¡Tu contraseña se ha cambiado con exito!"]);
                    
                }else{
                    
                    echo json_encode(["tipo"=>"danger","mensaje"=>"la confirmacion de la contraseña no coincide"]);
                    
                }
                
                
            }else{
                echo json_encode(["tipo"=>"danger","mensaje"=>"Los campos no pueden estar vacios"]);

            }
        } catch (Exception $e) {
            echo "error";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //se instancian las clases
    $autenticacion = new CambiarPasswordUsuario();
    $autenticacion->cambiar_password();
}

?>