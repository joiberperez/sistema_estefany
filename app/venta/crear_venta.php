<?php
if (!defined("ROOT")) {
    include "../config/config.php";
}
?>
<?php
include ROOT . "/models/modeloVenta.php";
include ROOT . "/models/modeloInventario.php";

include ROOT . "/config/clase.php";

class NuevaVenta
{
    function calcular_total()
    {
        $venta_productos = json_decode($_POST["venta_productos"]);
        
        $total = 0;
        foreach ($venta_productos as $venta_producto) {
            
            $total += (float)$venta_producto->precio_total_producto;
        }
        return $total;
    }
    function generar_venta()
    {
        try {


            $venta_productos = json_decode($_POST["venta_productos"]);
            $modelo = new ModeloVenta();
            $total = $this->calcular_total();
            $cliente_id = $_POST["cliente_id"];
            $forma_pago = $_POST["forma_pago"];
            
            $venta = [
                "cliente_id" => (int)$cliente_id,
                "metodo_pago_id" => (int)$forma_pago,
                
                "total" => $total
            ];
            $id_venta = $modelo->create($venta);
            $modelo_detalle_venta = new ModeloDetalleVenta();
            foreach ($venta_productos as $venta_producto) {
                $id = preg_replace('/\D/', '', $venta_producto->codigo);
                $detalle_venta = [
                    "venta_id" => $id_venta,
                    "producto_id" => (int)$id,
                    "cantidad" => (float)$venta_producto->cantidad,
                    "precio_unitario" => (float)$venta_producto->precio_total_producto
                ];
                $modelo_detalle_venta->create($detalle_venta);
                $modelo_inventario = new ModeloInventario();
                $cantidad_vendida = (float)$venta_producto->cantidad;
                
                $producto_inventario = $modelo_inventario->getDetail("producto_id",$id); 
                $producto_inventario["cantidad_disponible"] = $producto_inventario["cantidad_disponible"] - (float)$venta_producto->cantidad;
                $modelo_inventario->actualizarCliente($id,$producto_inventario,"producto_id"); 
            }
            echo json_encode(["tipo"=>"success","mensaje"=>"Se ha registrado la venta con exito!"]);
        } catch (Exception $e) {
            echo $e;
        }
    }
}



$venta = new NuevaVenta();
$venta->generar_venta();


?>