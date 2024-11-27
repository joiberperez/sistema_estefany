<?php
session_start();
if(!defined("ROOT")){
    include "../config/config.php";

}
include ROOT . "/models/modeloCliente.php";
include ROOT . "/config/clase.php";
include ROOT . "/models/modeloLogs.php";

class ActualizarCliente extends BaseClase{

   

    public function listar_cliente(){
        $id_cliente = $_GET["id"];
        $modelo = new ModeloCliente();
        $cliente = $modelo->getDetail("id_cliente",$id_cliente);
        return $cliente;
        
    }
    public function actualizar_cliente(){
        try{

            $modelo = new ModeloCliente();
            
            $id_cliente = $_POST["id_cliente"];
            $nombre_cliente = $this->parsearCadena($_POST["nombre_cliente"]);
            $apellido_cliente = $this->parsearCadena($_POST["apellido_cliente"]);
            $cedula_cliente = $this->parsearCadena($_POST["cedula_cliente"]);
            $telefono_cliente = $this->parsearCadena($_POST["telefono_cliente"]);
            $datos = [
                "nombre_cliente"=>$nombre_cliente,
                "apellido_cliente"=>$apellido_cliente,
                "cedula_cliente"=>$cedula_cliente,
                "telefono_cliente"=>$telefono_cliente,
                
            ];
            $modelo->actualizarCliente($id_cliente,$datos,"id_cliente");
            $log = new ModeloLogs();
            $log->logUserAccion($_SESSION["user"]["id"], 'actualizar_cliente', 'El usuario ha actualizado un cliente.');
            echo json_encode(["tipo"=>"success", "mensaje"=>"¡Se ha actualizado con exito!"]);
            
        }catch(Exception $error){
            
            echo json_encode(["tipo"=>"danger", "mensaje"=>$error->getMessage()]);

        }
        
    }
}

$actualizarCliente = new ActualizarCliente();

if($_SERVER["REQUEST_METHOD"]==="POST"){
    
    $actualizarCliente->actualizar_cliente();
}else{

    $cliente = $actualizarCliente->listar_cliente();





?>

<form class="text-start" action="/sistema_estefany/app/cliente/actualizar_cliente.php" method="post" id="form_actualizar_cliente">
    <div class="row">
        <div class="col-lg-6 mb-3">
            <label for="">Nombre</label>
            <input type="text" class="form-control" id="nombre_cliente_input" name="nombre_cliente" onkeypress="evitarNumeros(event)" value="<?= $cliente["nombre_cliente"] ?>">
        </div>
        <div class="col-lg-6 mb-3">
            <label for="">Apellido</label>
            <input type="text" class="form-control" id="apellido_cliente_input" name="apellido_cliente" value="<?= $cliente["apellido_cliente"] ?>" >
        </div>
        <div class="col-lg-6 mb-3">
            <label for="">Cedula</label>
            <input type="text" class="form-control" id="cedula_cliente_input" name="cedula_cliente" onkeypress="permitirSoloNumeros(event)" value="<?= $cliente["cedula_cliente"] ?>" >
        </div>
        <div class="col-lg-6 mb-3">
            <label for="">Telefono</label>
            <input type="text" class="form-control" id="telefono_cliente_input" name="telefono_cliente" onkeypress="permitirSoloNumeros(event)" value="<?= $cliente["telefono_cliente"] ?>" >
        </div>
    </div>
    <input type="hidden" name="id_cliente"  value="<?= $cliente["id_cliente"] ?>">
    <div class="mt-3 text-end">
        
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <button type="button" class="btn btn-danger" onclick="location.reload();">Cancelar</button>
    </div>
</form>

<script src="/sistema_estefany/public/js/cliente.js"></script>


<?php } ?>