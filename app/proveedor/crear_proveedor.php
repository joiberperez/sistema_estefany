<?php

if (!defined("ROOT")) {
  include "../config/config.php";
}
include ROOT . "/models/modeloProveedor.php";
include ROOT . "/config/clase.php";
class CrearProveedor extends BaseClase
{
    function parsearCadena($cadena) {
        // Eliminar cualquier carácter no alfanumérico, excepto los espacios
        $cadenaLimpia = preg_replace("/[^a-zA-Z0-9\s]/", "", $cadena);
        
        // Retornar la cadena limpia
        return $cadenaLimpia;
    }


  
  public function crearProveedor()
  
  {
    try {

      $modelo = new ModeloProveedor();
      $nombre = $this->parsearCadena($_POST["nombre"]);
      $direccion = $this->parsearCadena($_POST["direccion"]);
      $telefono = $this->parsearCadena($_POST["telefono"]);
      
  
      if(!empty($nombre) && !empty($direccion) && !empty($telefono)){
          $datos = [
              "nombre"=>$nombre,
              "direccion"=>$direccion,
              "telefono"=>$telefono
              
          ];
        
        $modelo->create($datos);
        return ["tipo" => "success", "mensaje" => "Se ha registrado con exito!"];

      }
      return ["tipo" => "danger", "mensaje" => "los campos cedula, nombre, apellido son obligatorios"];
      

      
    } catch (Exception $e) {
      
      echo json_encode(["tipo"=>"danger", "mensaje"=>"algo ha salido mal"]);
    }
  }
}

$crearProveedor = new CrearProveedor();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  
  // $cliente = $actualizarCliente->listar_cliente();
  echo json_encode($crearProveedor->crearProveedor());
}else{





?>
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Registrar Proveedor</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <form action="/sistema_estefany/app/proveedor/crear_proveedor.php" id="registrar_proveedor" method="post">


        <div class="modal-body">
          <div class="row">
            <div class="col-lg-6 mb-3">
              <label for="nameBasic" class="form-label">Nombre</label>
              <input type="text" id="nameBasic" name="nombre" class="form-control" placeholder="Enter Name" required />
            </div>
            <div class="col-lg-6 mb-3">
              <label for="nameBasic" class="form-label">Telefono</label>
              <input type="text" id="nameBasic" name="telefono" required class="form-control" placeholder="ingresa el telefono " />
            </div>
            
            <div class="col-lg-12 mb-3">
              <label for="nameBasic" class="form-label">Direccion</label>
              <textarea name="direccion" class="form-control" id="" required placeholder="ingresa la direccion"></textarea>
              
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Cancelar
          </button>
          <button type="submit" class="btn btn-primary">Registrar</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script src="/sistema_estefany/public/js/proveedor.js"></script>

<?php } ?>