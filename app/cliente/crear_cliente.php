<?php

if (!defined("ROOT")) {
  include "../config/config.php";
}
include ROOT . "/models/modeloCliente.php";
include ROOT . "/config/clase.php";
class CrearCliente extends BaseClase
{



  public function listar_cliente()
  {
    $id_cliente = $_GET["id"];
    $modelo = new ModeloCliente();
    $cliente = $modelo->getDetail("id_cliente", $id_cliente);
    return $cliente;
  }
  public function crearCliente()
  {
    try {

      $modelo = new ModeloCliente();


      $nombre_cliente = $this->parsearCadena($_POST["nombre_cliente"]);
      $apellido_cliente = $this->parsearCadena($_POST["apellido_cliente"]);
      $cedula_cliente = $this->parsearCadena($_POST["cedula_cliente"]);
      $telefono_cliente = $this->parsearCadena($_POST["telefono_cliente"]);
      if(!empty($nombre_cliente) && !empty($apellido_cliente) && !empty($cedula_cliente) && !empty($telefono_cliente)){
        $datos = [
          "nombre_cliente" => $nombre_cliente,
          "apellido_cliente" => $apellido_cliente,
          "cedula_cliente" => $cedula_cliente,
          "telefono_cliente" => $telefono_cliente,
  
        ];
        $modelo->create($datos);
        return ["tipo" => "success", "mensaje" => "Se ha registrado con exito!"];

      }
      return ["tipo" => "danger", "mensaje" => "los campos cedula, nombre, apellido son obligatorios"];
      

      // header("Location: /sistema_estefany/app/cliente/cliente.php");
    } catch (Exception $error) {
      
      echo json_encode(["tipo"=>"danger", "mensaje"=>"algo ha salido mal"]);
    }
  }
}

$crearCliente = new CrearCliente();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  
  // $cliente = $actualizarCliente->listar_cliente();
  echo json_encode($crearCliente->crearCliente());
}else{





?>
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Registrar Cliente</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <form action="/sistema_estefany/app/cliente/crear_cliente.php" id="registrar_cliente" method="post">


        <div class="modal-body">
          <div class="row">
            <div class="col-lg-6 mb-3">
              <label for="nameBasic" class="form-label">Nombre</label>
              <input type="text" id="nameBasic" name="nombre_cliente" class="form-control" placeholder="Enter Name" />
            </div>
            <div class="col-lg-6 mb-3">
              <label for="nameBasic" class="form-label">Apellido</label>
              <input type="text" id="nameBasic" name="apellido_cliente" class="form-control" placeholder="Enter Name" />
            </div>
            <div class="col-lg-6 mb-3">
              <label for="nameBasic" class="form-label">Cedula</label>
              <input type="text" id="nameBasic" name="cedula_cliente" class="form-control" placeholder="Enter Name" />
            </div>
            <div class="col-lg-6 mb-3">
              <label for="nameBasic" class="form-label">Telefono</label>
              <input type="text" id="nameBasic" name="telefono_cliente" class="form-control" placeholder="Enter Name" />
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


<script src="/sistema_estefany/public/js/cliente.js"></script>

<?php } ?>