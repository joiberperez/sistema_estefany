<?php
session_start();
if (!defined("ROOT")) {
    include "../config/config.php";
}
?>
<?php
include ROOT . "/models/modeloUsuario.php";
include ROOT . "/config/clase.php";


class UsuarioListado extends BaseClase
{


    public function listar_usuarios()
    {
        $modelo = new ModeloUsuario();


        $page = $_GET["page"] ?? "";
        // Obtener el filtro
        $filtro = $_GET["filtro"] ?? ""; // Uso del operador null coalescing

        // Contar total de registros
        $totalRegistros = $modelo->get_count(campo: 'nombre_usuario', filtro: $filtro);
        $registrosPorPagina = 5;
        $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

        // Determinar la página actual
        $paginaActual = max(1, min($totalPaginas, (int)($page ?? 1)));

        // Calcular el offset
        $offset = ($paginaActual - 1) * $registrosPorPagina;


        // Obtener los registros de la página actual
        $data = $modelo->get_page($registrosPorPagina, max(0, $offset), $filtro, campo: 'nombre_usuario');

        // Renderizar la vista


        // Mensaje si no hay resultados
        if (empty($data)) {
            echo "<h1 style='text-align:center'>No se ha encontrado los resultados</h1>";
        }

        return ["data" => $data, "paginaActual" => $paginaActual, "totalPaginas" => $totalPaginas, "page" => $page];
    }
}


$usuarioListado = new UsuarioListado();
if ($_SERVER["REQUEST_METHOD"] === "GET") {

    $context = $usuarioListado->listar_usuarios();
    extract($context);
}

?>

<table class="table">

    <thead>

        <th>Nombre</th>
        <th>Apellido</th>
        <th>Nombre de usuario</th>
        <th>Email</th>
        

    </thead>
    <tbody class="table-border-bottom-0">


        <?php foreach ($data as $usuario) { ?>
            <?php if($usuario["nombre_usuario"] != $_SESSION["user"]["nombre_usuario"]): ?>
            <tr>


                <td><?= $usuario["nombre"]; ?></td>


                <td><?= $usuario["apellido"]; ?></td>
                <td><?= $usuario["nombre_usuario"]; ?></td>
                <td><?= $usuario["email"]; ?></td>
               


                <td>
                    <button type="button" class="btn rounded-pill btn-icon btn-outline-danger" onclick="eliminar_usuario(<?= $usuario['id'] ?>)">
                        <span class="tf-icons bx bx-trash"></span>
                    </button>
                    <button type="button" class="btn rounded-pill btn-icon btn-outline-primary" onclick="detalle_usuario(<?= $usuario['id'] ?>)">

                        <span class="tf-icons bx bx-dots-vertical-rounded"></span>
                    </button>
                </td>

            </tr>

        <?php endif ?>
        <?php } ?>




    </tbody>
</table>
<input type="hidden" id="url-paginacion" data-url="/sistema_estefany/app/usuario/listado_usuario.php">
<?php include ROOT . "/plantillas/paginacion.php" ?>

