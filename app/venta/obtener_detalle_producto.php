<?php
if (!defined("ROOT")) {
    include "../config/config.php";
}
include ROOT . "/models/modeloProducto.php";
include ROOT . "/models/modeloInventario.php";

include ROOT . "/config/clase.php";
class ObtenerDetalleProduto extends BaseClase
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
        $modelo = new ModeloProducto();
        $modeloInventario = new ModeloInventario();
        $producto = $modelo->getDetail("id", $id);
        $producto_inventario = $modeloInventario->getDetail("producto_id", $id);
        $producto["cantidad"] = $producto_inventario["cantidad_disponible"];

        return $producto;
    }
    public function actualizar_cliente()
    {
        try {

            $modelo = new ModeloProducto();

            $id = $_POST["id"];
            $nombre = $this->parsearCadena($_POST["nombre"]);
            $descripcion = $this->parsearCadena($_POST["descripcion"]);
            $precio = $_POST["precio"];
            $categoria = $this->parsearCadena($_POST["categoria"]);
            $datos = [
                "nombre" => $nombre,
                "descripcion" => $descripcion,
                "precio" => $precio,
                "categoria_id" => $categoria,

            ];
            $modelo->actualizarCliente($id, $datos, "id");
            echo json_encode(["tipo" => "success", "mensaje" => "¡Se ha actualizado con exito!"]);
        } catch (Exception $error) {

            echo json_encode(["tipo" => "danger", "mensaje" => $error->getMessage()]);
        }
    }
}



$ActualizarProducto = new ObtenerDetalleProduto();


$producto = $ActualizarProducto->listar_cliente();







?>


<?php if($producto["cantidad"] > 0): ?>
    <div class="row">
        <div class="col-lg-4 mb-3">
            <label for="">Codigo</label>
            <input type="text" class="form-control"  name="codigo" id="codigo" value="cod_<?= $producto["id"] ?>" readonly>
        </div>
        <div class="col-lg-8 mb-3">
            <label for="">Nombre</label>
            <input type="text" class="form-control"  name="nombre" id="nombre"  onkeypress="evitarNumeros(event)" value="<?= $producto["nombre"] ?>" readonly>
        </div>
        <div class="col-lg-5 mb-3">
            <label for="">Cantidad</label>
            <div class="input-group mb-3">
                <button class="btn btn-outline-primary" onclick="decrement('<?= $producto['precio'] ?>')" type="button" id="button-addon1">-</button>
                <input type="text" class="form-control" id="cantidad" onkeyup="calcular_precio_producto('<?= $producto['precio'] ?>');" value="1" placeholder="" aria-label="Texto de ejemplo con complemento de botón" aria-describedby="button-addon1">
                <button class="btn btn-outline-primary" onclick="increment('<?= $producto['cantidad'] ?>','<?= $producto['precio'] ?>')" type="button">+</button>
            </div>

        </div>

        <div class="col-lg-3 mb-3">
            <label for="">Precio</label>
            <input type="text" class="form-control"  name="precio" id="precio" onkeypress="permitirSoloNumeros(event)" value="<?= $producto["precio"] ?>" readonly>
        </div>
        <div class="col-lg-4 mb-3">
            <label for="">Precio Total</label>
            <input type="text" class="form-control"  name="precio" id="precio_total_producto" onkeypress="permitirSoloNumeros(event)" value="<?= $producto["precio"] ?>" readonly>
        </div>
        <div class="text-end">
            <button class="btn btn-success rounded-1" onclick="agregarProducto()">Listar</button>
            <button class="btn btn-danger rounded-1">Borrar</button>

        </div>
        
    </div>

<?php else: ?>
    <div class="col-md-6 col-12 mb-6" bis_skin_checked="1">
            <label for="dateRangePicker" class="form-label">Date Range</label>
            <div class="input-group input-daterange" id="bs-datepicker-daterange" bis_skin_checked="1">
              <input type="text" id="dateRangePicker" placeholder="MM/DD/YYYY" class="form-control">
              <span class="input-group-text">to</span>
              <input type="text" placeholder="MM/DD/YYYY" class="form-control">
            </div>
          </div>
    <h4 class="text-center m-5 text-danger">El producto no esta disponible</h4>
<?php endif ?>
