<?php

if (!defined("ROOT")) {
  include "../config/config.php";
}
include ROOT . "/models/modeloProducto.php";
include ROOT . "/config/clase.php";
class CrearProducto extends BaseClase
{




  public function crear_producto()
  {
    try {

      $modelo = new ModeloProducto();


      $nombre = $this->parsearCadena($_POST["nombre"]);
      $descripcion = $this->parsearCadena($_POST["descripcion"]);
      $categoria = $this->parsearCadena($_POST["categoria"]);
      $precio = $_POST["precio"];
      if(!empty($nombre) && !empty($descripcion) && !empty($categoria) && !empty($precio)){
        $datos = [
          "nombre" => $nombre,
          "descripcion" => $descripcion,
          "categoria_id" => $categoria,
          "precio" => $precio,
  
        ];
        $modelo->create($datos);
        return ["tipo" => "success", "mensaje" => "Se ha registrado con exito!"];

      }
      return ["tipo" => "danger", "mensaje" => "los campos precio, nombre, descripcion, categoria son obligatorios"];
      

      // header("Location: /sistema_estefany/app/cliente/cliente.php");
    } catch (Exception $error) {
      
      echo json_encode(["tipo"=>"danger", "mensaje"=>"algo ha salido mal"]);
    }
  }
}

$CrearProducto = new CrearProducto();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  
  // $cliente = $actualizarCliente->listar_cliente();
  echo json_encode($CrearProducto->crear_producto());
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
      <form action="/sistema_estefany/app/producto/crear_producto.php" id="registrar_cliente" method="post">


        <div class="modal-body">
          <div class="row">
            <div class="col-lg-6 mb-3">
              <label for="nameBasic" class="form-label">Nombre</label>
              <input type="text" id="nameBasic" name="nombre" class="form-control" placeholder="Enter Name" />
            </div>
            <div class="col-lg-6 mb-3">
              <label for="nameBasic" class="form-label">Categoria</label>
            <div class="categoria_producto"></div>
              
            </div>
            <div class="col-lg-8 mb-3">
              <label for="nameBasic" class="form-label">Descripcion</label>
              <textarea class="form-control" name="descripcion" id=""></textarea>
              
            </div>
            <div class="col-lg-4 mb-3">
              <label for="nameBasic" class="form-label">Precio</label>
              <input type="text" id="nameBasic" name="precio" class="form-control" placeholder="Enter Name" />
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


<script src="/sistema_estefany/public/js/producto.js"></script>

<?php } ?>