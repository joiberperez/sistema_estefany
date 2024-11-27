<?php
session_start();
if(!defined("ROOT")){
    include "../config/config.php";

}
include ROOT . "/models/modeloLogs.php";

include ROOT . "/models/modeloProveedor.php";
include ROOT . "/config/clase.php";
class ActualizarProveedor extends BaseClase{

    function parsearCadena($cadena) {
        // Eliminar cualquier carácter no alfanumérico, excepto los espacios
        $cadenaLimpia = preg_replace("/[^a-zA-Z0-9\s]/", "", $cadena);
        
        // Retornar la cadena limpia
        return $cadenaLimpia;
    }


    public function listar_proveedor(){
        $id_proveedor = $_GET["id"];
        $modelo = new ModeloProveedor();
        $cliente = $modelo->getDetail("id",$id_proveedor);
        return $cliente;
        
    }
    public function actualizar_proveedor(){
        try{

            $modelo = new ModeloProveedor();
            
            $id = $_POST["id"];
            $nombre = $this->parsearCadena($_POST["nombre"]);
            $direccion = $this->parsearCadena($_POST["direccion"]);
            $telefono = $this->parsearCadena($_POST["telefono"]);
            
            $datos = [
                "nombre"=>$nombre,
                "direccion"=>$direccion,
                "telefono"=>$telefono
                
            ];
            $modelo->actualizarCliente($id,$datos,"id");
            $log = new ModeloLogs();
            $log->logUserAccion($_SESSION["user"]["id"], 'actualizar_cliente', 'El usuario ha actualizado un proveedor.');
            echo json_encode(["tipo"=>"success", "mensaje"=>"¡Se ha actualizado con exito!"]);
            
        }catch(Exception $error){
            
            echo json_encode(["tipo"=>"danger", "mensaje"=>$error->getMessage()]);

        }
        
    }
}

$actualizarCliente = new ActualizarProveedor();

if($_SERVER["REQUEST_METHOD"]==="POST"){
    
    $actualizarCliente->actualizar_proveedor();
}else{

    $cliente = $actualizarCliente->listar_proveedor();





?>

<form class="text-start" action="/sistema_estefany/app/proveedor/actualizar_proveedor.php" method="post" id="form_actualizar_proveedor">
    <div class="row">
        <div class="col-lg-6 mb-3">
            <label for="">Nombre</label>
            <input type="text" class="form-control" id="nombre_proveedor_input" name="nombre" onkeypress="evitarNumeros(event)" value="<?= $cliente["nombre"] ?>">
        </div>
        <div class="col-lg-6 mb-3">
            <label for="">Telefono</label>
            <input type="text" class="form-control" id="telefono_proveedor_input" name="telefono" onkeypress="permitirSoloNumeros(event)" value="<?= $cliente["telefono"] ?>" >
        </div>
        <div class="col-lg-12 mb-3">
            <label for="">Apellido</label>
            <textarea type="text" class="form-control" id="direccion_proveedor_input" name="direccion" > <?= $cliente["direccion"] ?> </textarea>
        </div>
        
    </div>
    <input type="hidden" name="id"  value="<?= $cliente["id"] ?>">
    <div class="mt-3 text-end">
        
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <button class="btn btn-danger" onclick="location.reload();">Cancelar</button>
    </div>
</form>
<script src="/sistema_estefany/public/js/proveedor.js"></script>



<?php } ?>