<?php
if(!defined("ROOT")){
    include "../config/config.php";
}
?>
<?php
include ROOT . "/models/modeloProducto.php";
include ROOT . "/config/clase.php";

class BusquedaProducto {
    static function buscar_producto(){
        $filtro = $_GET["filtro"];
        if(strlen($filtro) >= 5){
            $filtro = str_replace("cod_","",$filtro);
            $modelo = new ModeloProducto();
            $productos = $modelo->get_data_filter(campo1:"id",campo2:"nombre",filtro:$filtro);
            if(!empty($productos)){
                return $productos;

            }
            return "No se ha encontrdo ningun producto";

        }
    }
}

$data = BusquedaProducto::buscar_producto();
if(is_array($data)){
    $productos = $data;
}else{
    $error = $data;
}

?>



<div class="rounded-1">

    <?php if (!empty($productos)) { ?>
        <li class="list-group-item bg-primary text-white text-center">Productos</li>
        <?php foreach ($productos as $producto) { ?>
            <?php 
                // Utilizar json_encode() con flags para asegurar la validez del JSON
                $producto_serializer = json_encode($producto); 
                
                ?>
                
            <button class="list-group-item list-group-item-action text-center" 
                    onclick="cargar_producto(`<?= $producto['id']?>`)">
                <?= htmlspecialchars($producto["nombre"]) ?> -- $<?= number_format($producto["precio"], 2) ?>
            </button>
        <?php } ?>
    <?php } ?>
    
    <?php if (isset($error)) { ?>
        <p class="text-center mt-2"><?= htmlspecialchars($error) ?></p>
    <?php } ?>
</div>