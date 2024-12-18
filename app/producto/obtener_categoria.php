<?php
if (!defined("ROOT")) {
    include "../config/config.php";
}
?>
<?php
include ROOT . "/models/modeloCategoria.php";
include ROOT . "/config/clase.php";


class ObtenerCategoria
{
    public function obtener_categoria()
    {
        $modelo_categoria = new ModeloCategoria();
        return $modelo_categoria->getAll();
    }
}

$obtener_categoria = new ObtenerCategoria();
$categorias = $obtener_categoria->obtener_categoria();



?>

<select class="form-select" name="categoria" id="">
    <?php foreach ($categorias as $categoria): ?>

        <option value="<?= $categoria["id"] ?>"
            <?php
            if (!empty($_GET["categoria_id"])):
                if ($categoria["id"] == $_GET["categoria_id"]):
            ?> selected
            <?php endif ?>
            <?php endif ?>><?= $categoria["nombre"] ?></option>
    <?php endforeach; ?>
</select>