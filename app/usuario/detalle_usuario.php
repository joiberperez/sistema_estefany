<?php
if(!defined("ROOT")){
    include "../config/config.php";

}
include ROOT . "/models/modeloUsuario.php";
include ROOT . "/config/clase.php";
class DetalleUsuario extends BaseClase{

   

    public function detalle_usuario(){
        $id = $_GET["id"];
        $modelo = new ModeloUsuario();
        $usuario = $modelo->getDetail("id",$id);
        return $usuario;
        
    }
    
}

$actualizarusuario = new DetalleUsuario();



    $usuario = $actualizarusuario->detalle_usuario();






?>


    <div class="row">
        <div class="col-lg-6 mb-3">
            <label for="">Nombre</label>
            <input type="text" class="form-control" id="nombre_usuario_input" name="nombre_usuario" onkeypress="evitarNumeros(event)" value="<?= $usuario["nombre"] ?>" readonly>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="">Apellido</label>
            <input type="text" class="form-control" id="apellido_usuario_input" name="apellido_usuario" value="<?= $usuario["apellido"] ?>" readonly >
        </div>
        <div class="col-lg-6 mb-3">
            <label for="">Nombre de usuario</label>
            <input type="text" class="form-control" id="cedula_usuario_input" name="cedula_usuario" onkeypress="permitirSoloNumeros(event)" value="<?= $usuario["nombre_usuario"] ?>" readonly>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="">Correo</label>
            <input type="text" class="form-control" id="telefono_usuario_input" name="telefono_usuario" onkeypress="permitirSoloNumeros(event)" value="<?= $usuario["email"] ?>" readonly>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="">Fecha de creacion del usuario</label>
            <input type="text" class="form-control" id="telefono_usuario_input" name="telefono_usuario" onkeypress="permitirSoloNumeros(event)" value="<?= $usuario["fecha_creacion"] ?>" readonly>
        </div>
    </div>
    <input type="hidden" name="id_usuario"  value="<?= $usuario["id"] ?>">
    <div class="mt-3 text-end">
        
        
        <button type="button" class="btn btn-danger" onclick="location.reload();">Limpiar</button>
    </div>





