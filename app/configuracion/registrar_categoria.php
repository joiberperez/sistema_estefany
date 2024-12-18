<?php
if(!defined("ROOT")){
    include "../config/config.php";

}
session_start();
include ROOT . "/models/modeloLogs.php";
include ROOT . "/models/modeloCategoria.php";
include ROOT . "/config/clase.php";

class RegistrarCategoria extends BaseClase {
    function parsearCadena($cadena) {
        // Eliminar cualquier carácter no alfanumérico, excepto los espacios
        $cadenaLimpia = preg_replace("/[^a-zA-Z0-9\s]/", "", $cadena);
        
        // Retornar la cadena limpia
        return $cadenaLimpia;
    }
    
    public function registrar_categoria(){
        try{
            
            $modelo = new ModeloCategoria();
            
            if(!empty($_POST["nombre"]) and !empty($_POST["descripcion"])){
                $nombre = $this->parsearCadena($_POST["nombre"]);
                $descripcion = $this->parsearCadena($_POST["descripcion"]);
                
                $datos = [
                    "nombre"=>$nombre,
                    "descripcion"=>$descripcion
                    
                ];
                $modelo->create($datos);
                $log = new ModeloLogs();
                $log->logUserAccion($_SESSION["user"]["id"], 'registro_categoria', 'El usuario ha registrado una categoria.');
                echo json_encode(["tipo"=>"success", "mensaje"=>"¡Se ha registrado con exito!"]);
                
            }else{
                echo json_encode(["tipo"=>"danger", "mensaje"=>"Los campos no pueden estar vacios"]);

            }
            
        }catch(Exception $error){
            
            echo json_encode(["tipo"=>"danger", "mensaje"=>$error->getMessage()]);

        }
        
    }
}


$categoria = new RegistrarCategoria();
$categoria->registrar_categoria();
?>
