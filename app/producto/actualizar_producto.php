<?php
if(!defined("ROOT")){
    include "../config/config.php";

}
include ROOT . "/models/modeloProducto.php";

include ROOT . "/config/clase.php";
class ActualizarProducto extends BaseClase{

    
    function parsearCadena($cadena) {
        // Eliminar cualquier carácter no alfanumérico, excepto los espacios
        $cadenaLimpia = preg_replace("/[^a-zA-Z0-9\s]/", "", $cadena);
        
        // Retornar la cadena limpia
        return $cadenaLimpia;
    }

    public function listar_cliente(){
        $id = $_GET["id"];
        $modelo = new ModeloProducto();
        $producto = $modelo->getDetail("id",$id);

        return $producto;
        
    }
    public function actualizar_cliente(){
        try{

            $modelo = new ModeloProducto();
            
            $id = $_POST["id"];
            $nombre = $this->parsearCadena($_POST["nombre"]);
            $descripcion = $this->parsearCadena($_POST["descripcion"]);
            $precio = $_POST["precio"];
            $categoria = $this->parsearCadena($_POST["categoria"]);
            $datos = [
                "nombre"=>$nombre,
                "descripcion"=>$descripcion,
                "precio"=>$precio,
                "categoria_id"=>$categoria,
                
            ];
            $modelo->actualizarCliente($id,$datos,"id");
            echo json_encode(["tipo"=>"success", "mensaje"=>"¡Se ha actualizado con exito!"]);
            
        }catch(Exception $error){
            
            echo json_encode(["tipo"=>"danger", "mensaje"=>$error->getMessage()]);

        }
        
    }
}



$ActualizarProducto = new ActualizarProducto();

if($_SERVER["REQUEST_METHOD"]==="POST"){
    
    $ActualizarProducto->actualizar_cliente();
}else{

    $producto = $ActualizarProducto->listar_cliente();
 






?>

<form class="text-start" action="/sistema_estefany/app/cliente/actualizar_cliente.php" method="post" id="form_actualizar_cliente">
    <div class="row">
        <div class="col-lg-6 mb-3">
            <label for="">Nombre</label>
            <input type="text" class="form-control" id="nombre_input" name="nombre" onkeypress="evitarNumeros(event)" value="<?= $producto["nombre"] ?>">
        </div>
        <div class="col-lg-6 mb-3" >
            <label for="">Categoria</label>
            <div class="categoria_producto"></div>
            
            
            
            
        </div>
        <div class="col-lg-8 mb-3">
            <label for="">descripcion</label>
            <textarea class="form-control" name="descripcion" id=""><?= $producto["descripcion"] ?></textarea>
            
        </div>
        <div class="col-lg-4 mb-3">
            <label for="">Precio</label>
            <input type="text" class="form-control" id="precio_input" name="precio" onkeypress="permitirSoloNumeros(event)" value="<?= $producto["precio"] ?>" >
        </div>
    </div>

    <input type="hidden" name="id"  value="<?= $producto["id"] ?>">
    <input type="hidden" name="id_categoria"  id="categoria_producto_id" data-categoria="<?= $producto["categoria_id"] ?>">
    <div class="mt-3 text-end">
        
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <button type="button" class="btn btn-danger" onclick="location.reload();">Cancelar</button>
    </div>
</form>

<script src="/sistema_estefany/public/js/producto.js"></script>



<?php } ?>