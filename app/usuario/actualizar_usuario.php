<?php

session_start();
if (!defined("ROOT")) {
    include "../config/config.php";
}
include ROOT . "/models/modeloUsuario.php";
include ROOT . "/config/clase.php";


include ROOT . "/models/modeloLogs.php";

class ActualizarUsuario extends BaseClase
{
    
    
    public function actualizar_usuario()
    {
        try {
            
            $modelo = new ModeloUsuario();
            
            $id = $_POST["id"];
            $nombre = $this->parsearCadena($_POST["nombre"]);
            $apellido = $this->parsearCadena($_POST["apellido"]);
            $nombreUsuario = $_POST["nombre_usuario"];
            
            
            $email = $_POST["email"];
            
            if (!empty($nombre) && !empty($apellido) && !empty($nombreUsuario) && !empty($email)) {
                $usuario_verificacion = $modelo->selectUser($nombreUsuario);
                $usuario_verificacion = $usuario_verificacion->fetch();;
                
                if(empty($usuario_verificacion) || $usuario_verificacion["id"] == $id){
                    $datos = [
                        "nombre" => $nombre,
                        "apellido" => $apellido,
                        "nombre_usuario" => $nombreUsuario,
                        "email" => $email
                    ];
                    $modelo->actualizarCliente($id,$datos,"id");
                    $usuario = $modelo->getDetail("id",$id);
                    $log = new ModeloLogs();
                    $log->logUserAccion($_SESSION["user"]["id"], 'actualizar_usuario', 'El usuario ha actualizado sus datos.');
                    echo json_encode(["tipo"=>"success","mensaje"=>"¡Tu datos se han actualizado con exito!","usuario"=>$usuario]);
                    
                }else{
                    $usuario = $modelo->getDetail("id",$id);
                    echo json_encode(["tipo"=>"danger","mensaje"=>"El nombre de usuario ya esta ocupado, ingrese otro","usuario"=>$usuario]);

                }
                

            }
        } catch (Exception $e) {
            echo "error";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //se instancian las clases
    $autenticacion = new ActualizarUsuario();
    $autenticacion->actualizar_usuario();
}

?>

