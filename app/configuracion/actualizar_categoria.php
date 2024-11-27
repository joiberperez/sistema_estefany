<?php
if(!defined("ROOT")){
    include "../config/config.php";

}
include ROOT . "/models/modeloCategoria.php";
include ROOT . "/config/clase.php";

session_start();
include ROOT . "/models/modeloLogs.php";
class ActualizarCategoria extends BaseClase{
    
    
    function parsearCadena($cadena) {
        // Eliminar cualquier carácter no alfanumérico, excepto los espacios
        $cadenaLimpia = preg_replace("/[^a-zA-Z0-9\s]/", "", $cadena);
        
        // Retornar la cadena limpia
        return $cadenaLimpia;
    }
    
    public function listar_categoria(){
        $id = $_GET["id"];
        $modelo = new ModeloCategoria();
        $data = $modelo->getDetail("id",$id);
        return $data;
        
    }
    public function actualizar_categoria(){
        try{
            
            $modelo = new ModeloCategoria();
            
            $id = $_POST["id"];
            $nombre = $this->parsearCadena($_POST["nombre"]);
            $descripcion = $this->parsearCadena($_POST["descripcion"]);
            
            $datos = [
                "nombre"=>$nombre,
                "descripcion"=>$descripcion
                
            ];
            $modelo->actualizarCliente($id,$datos,"id");
            $log = new ModeloLogs();
            $log->logUserAccion($_SESSION["user"]["id"], 'actualizar_categoria', 'El usuario ha actualizado una categoria.');
            echo json_encode(["tipo"=>"success", "mensaje"=>"¡Se ha actualizado con exito!"]);
            
        }catch(Exception $error){
            
            echo json_encode(["tipo"=>"danger", "mensaje"=>$error->getMessage()]);

        }
        
    }
}

$ActualizarCategoria = new ActualizarCategoria();

if($_SERVER["REQUEST_METHOD"]==="POST"){
    
    $ActualizarCategoria->actualizar_categoria();
}else{

    $cliente = $ActualizarCategoria->listar_categoria();





?>

<div class="card">
    <h5 class="card-header">Actualizar Categoria</h5>
    <div class="card-body">
        <form class="text-start" action="/sistema_estefany/app/cliente/actualizar_cliente.php" method="post" id="form_actualizar_categoria">
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control" id="nombre_input" name="nombre" onkeypress="evitarNumeros(event)" value="<?= $cliente["nombre"] ?>">
                </div>
                <div class="col-lg-12 mb-3">
                    <label for="">Descripcion</label>
                    <textarea type="text" class="form-control" id="descripcion_input" name="descripcion"><?= $cliente["descripcion"] ?></textarea>
                </div>
               
            </div>
            <input type="hidden" name="id"  value="<?= $cliente["id"] ?>">
            <div class="mt-3 text-end">
                
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <button type="button" class="btn btn-danger" onclick="location.reload();">Cancelar</button>
            </div>
        </form>

    </div>
</div>


<script src="/sistema_estefany/public/js/configuracion.js"></script>


<?php } ?>