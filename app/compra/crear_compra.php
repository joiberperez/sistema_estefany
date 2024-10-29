<?php

if (!defined("ROOT")) {
  include "../config/config.php";
}
include ROOT . "/models/modeloCompra.php";
include ROOT . "/models/modeloProducto.php";
include ROOT . "/models/modeloProveedor.php";
include ROOT . "/config/clase.php";
class CrearCompra extends BaseClase
{


  public function listar_producto(){
    $modelo = new ModeloProducto();
    return $modelo->getAll();
  }
  public function listar_proveedor(){
    $modelo = new ModeloProveedor();
    return $modelo->getAll();
  }


  public function crear_producto()
  {
    try {

      $modelo = new ModeloCompra();


      $producto = $this->parsearCadena($_POST["producto"]);
      $proveedor = $this->parsearCadena($_POST["proveedor"]);
      $cantidad = $this->parsearCadena($_POST["cantidad"]);
      
      if(!empty($producto) && !empty($proveedor) && !empty($cantidad)){
        $datos = [
          "producto_id" => $producto,
          "proveedor_id" => $proveedor,
          "cantidad" => $cantidad
          
  
        ];
        $modelo->create($datos);
        return ["tipo" => "success", "mensaje" => "Se ha registrado con exito!"];

      }
      return ["tipo" => "danger", "mensaje" => "los campos precio, producto, proveedor, cantidad son obligatorios"];
      

      // header("Location: /sistema_estefany/app/cliente/cliente.php");
    } catch (Exception $error) {
      
      echo json_encode(["tipo"=>"danger", "mensaje"=>"algo ha salido mal"]);
    }
  }
}

$crearCompra = new CrearCompra();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  
  // $cliente = $actualizarCliente->listar_cliente();
  echo json_encode($crearCompra->crear_producto());
}else{

$productos = $crearCompra->listar_producto();
$proveedores = $crearCompra->listar_proveedor();



?>
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
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
            <div class="col-lg-12 mb-3">
              <label for="nameBasic" class="form-label">Producto</label>
              <select class="form-select" name="producto" id="">
                <?php foreach($productos as $producto): ?>
                  <option value="<?=$producto['id']?>"><?=$producto['nombre']?></option>
                <?php endforeach ?>
              </select>
              
            </div>
            <div class="col-lg-12 mb-3">
              <label for="nameBasic" class="form-label">Proveedores</label>
              <select class="form-select" name="proveedor" id="">
                <?php foreach($proveedores as $proveedor): ?>
                  <option value="<?=$proveedor['id']?>"><?=$proveedor['nombre']?></option>
                <?php endforeach ?>
              </select>
              
            </div>
            
            <div class="col-lg-12 mb-3">
              <label for="nameBasic" class="form-label">Cantidad</label>
              <input type="text" id="nameBasic" name="cantidad" class="form-control" placeholder="Enter Name" />
            </div>
            

        </div>
        <div class="modal-footer text-center">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Cancelar
          </button>
          <button type="submit" class="btn btn-primary">Registrar</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script src="/sistema_estefany/public/js/compra.js"></script>

<?php } ?>