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

   // $producto = $ActualizarProducto->listar_cliente();
 






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
        <div class="nav-align-top nav-tabs-shadow mb-6" bis_skin_checked="1">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item" role="presentation">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="false" tabindex="-1">Home</button>
        </li>
        <li class="nav-item" role="presentation">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false" tabindex="-1">Profile</button>
        </li>
        <li class="nav-item" role="presentation">
          <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-messages" aria-controls="navs-top-messages" aria-selected="true">Messages</button>
        </li>
      </ul>
      <div class="tab-content" bis_skin_checked="1">
        <div class="tab-pane fade" id="navs-top-home" role="tabpanel" bis_skin_checked="1">
          <p>
            Icing pastry pudding oat cake. Lemon drops cotton candy caramels cake caramels sesame snaps powder. Bear
            claw
            candy topping.
          </p>
          <p class="mb-0">
            Tootsie roll fruitcake cookie. Dessert topping pie. Jujubes wafer carrot cake jelly. Bonbon jelly-o
            jelly-o ice
            cream jelly beans candy canes cake bonbon. Cookie jelly beans marshmallow jujubes sweet.
          </p>
        </div>
        <div class="tab-pane fade" id="navs-top-profile" role="tabpanel" bis_skin_checked="1">
          <p>
            Donut dragée jelly pie halvah. Danish gingerbread bonbon cookie wafer candy oat cake ice cream. Gummies
            halvah
            tootsie roll muffin biscuit icing dessert gingerbread. Pastry ice cream cheesecake fruitcake.
          </p>
          <p class="mb-0">
            Jelly-o jelly beans icing pastry cake cake lemon drops. Muffin muffin pie tiramisu halvah cotton candy
            liquorice caramels.
          </p>
        </div>
        <div class="tab-pane fade active show" id="navs-top-messages" role="tabpanel" bis_skin_checked="1">
          <p>
            Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon gummies cupcake gummi
            bears
            cake chocolate.
          </p>
          <p class="mb-0">
            Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake. Sweet roll icing
            sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding jelly jelly-o tart brownie
            jelly.
          </p>
        </div>
      </div>
    </div>
       
    
    </div>
  </div>
</div>

<script src="/sistema_estefany/public/js/producto.js"></script>



<?php } ?>