<?php
if(!defined("ROOT")){
    include "../config/config.php";

}
include ROOT . "/models/modeloCliente.php";
include ROOT . "/config/clase.php";
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
            echo "se ha actualizado el registro N° ". $id_cliente;
            header("Location: /sistema_estefany/app/cliente/cliente.php");
        }catch(Exception $error){
            echo "ha ocurrido un error: ". $error;

        }
        
    }
}

$actualizarCliente = new ActualizarCliente();

if($_SERVER["REQUEST_METHOD"]==="GET"){
    
    $cliente = $actualizarCliente->listar_cliente();
}else{
    $actualizarCliente->actualizar_cliente();

}



?>

<form class="text-start" action="/sistema_estefany/app/cliente/actualizar_cliente.php" method="post">
    <div class="row">
        <div class="col-lg-6 mb-3">
            <label for="">Nombre</label>
            <input type="text" class="form-control" name="nombre_cliente" onkeypress="evitarNumeros(event)" value="<?= $cliente["nombre_cliente"] ?>">
        </div>
        <div class="col-lg-6 mb-3">
            <label for="">Apellido</label>
            <input type="text" class="form-control" name="apellido_cliente" value="<?= $cliente["apellido_cliente"] ?>" >
        </div>
        <div class="col-lg-6 mb-3">
            <label for="">Cedula</label>
            <input type="text" class="form-control" name="cedula_cliente" onkeypress="permitirSoloNumeros(event)" value="<?= $cliente["cedula_cliente"] ?>" >
        </div>
        <div class="col-lg-6 mb-3">
            <label for="">Telefono</label>
            <input type="text" class="form-control" name="telefono_cliente" onkeypress="permitirSoloNumeros(event)" value="<?= $cliente["telefono_cliente"] ?>" >
        </div>
    </div>
    <input type="hidden" name="id_cliente" value="<?= $cliente["id_cliente"] ?>">
    <div class="mt-3 text-end">
        
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <button class="btn btn-danger">Cancelar</button>
    </div>
</form>

<script>
        // Función para evitar que se ingresen números en el campo de texto
        function evitarNumeros(event) {
            var charCode = event.which || event.keyCode;
            // Permitir solo letras (mayúsculas y minúsculas) y teclas de control como retroceso
            if ((charCode >= 48 && charCode <= 57)) {
                event.preventDefault(); // Evitar que se escriban números
            }
        }
        function permitirSoloNumeros(event) {
            var charCode = event.which || event.keyCode;

            // Permitir solo números (teclas con código entre 48 y 57), backspace (8), y delete (46)
            if ((charCode < 48 || charCode > 57) && charCode !== 8 && charCode !== 46) {
                event.preventDefault(); // Cancelar la entrada si no es un número
            }
        }
    </script>