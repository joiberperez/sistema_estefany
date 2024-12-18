<?php
if (!defined("ROOT")) {
  include "../config/config.php";
}
include ROOT . "/models/modeloCompra.php";

include ROOT . "/config/clase.php";
class ActualizarProducto extends BaseClase
{


  function parsearCadena($cadena)
  {
    // Eliminar cualquier carácter no alfanumérico, excepto los espacios
    $cadenaLimpia = preg_replace("/[^a-zA-Z0-9\s]/", "", $cadena);

    // Retornar la cadena limpia
    return $cadenaLimpia;
  }

  public function listar_cliente()
  {
    $id = $_GET["id"];
    
    $modelo = new ModeloCompra();
    $producto = $modelo->getDetail("id", $id);

    return $producto;
  }
 
}



$ActualizarProducto = new ActualizarProducto();



  $compra = $ActualizarProducto->listar_cliente();

  function formatear_fecha($fecha_completa){
    
    $fecha_corta = date("d-m-Y", strtotime($fecha_completa));
    $hora = date("h:i A", strtotime($fecha_completa));

    return $fecha_corta . " a las " . $hora;  
  }
  
  






?>



  <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Detalle de la Compra</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <form action="/sistema_estefany/app/producto/crear_producto.php" id="registrar_cliente" method="post">

          
          <div class="modal-body">
          <div class="row">
            <div class="col-6">
              <p><strong>Codigo</strong></p>
              <p><?= $compra["id"] ?></p>
            </div>
            <div class="col-6">
              <p><strong>Nombre del Producto</strong></p>
              <p><?= $compra["nombre_producto"] ?></p>
            </div>
            <div class="col-6">
              <p><strong>Proveedor</strong></p>
              <p><?= $compra["nombre_proveedor"] ?></p>
            </div>
            <div class="col-6">
              <p><strong>Cantidad del Producto Comprada</strong></p>
              <p><?= $compra["cantidad"] ?></p>
            </div>
            <div class="col-6">
              <p><strong>Fecha de la Compra</strong></p>
              <p><?= formatear_fecha($compra["fecha_compra"]) ?></p>
            </div>
          </div>


          </div>


      </div>
    </div>
  </div>

  <script src="/sistema_estefany/public/js/compra.js"></script>



