<?php
session_start();
if (empty($_SESSION["user"])) {
    header("Location: /sistema_estefany/");
}
if (!defined("ROOT")) {
    include "../config/config.php";
}

include ROOT . "/models/modeloUsuario.php";
include ROOT . "/config/clase.php";

class DetalleMiUsuario extends BaseClase
{



    public function obtener_usuario()
    {
        $id = $_SESSION["user"]["id"];
        $modelo = new ModeloUsuario();
        $usuario = $modelo->getDetail("id", $id);
        return $usuario;
    }
}

$actualizarusuario = new DetalleMiUsuario();



$usuario = $actualizarusuario->obtener_usuario();






?>







<?php include ROOT . "/plantillas/head.php"  ?>


<!-- Content -->

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        <?php include ROOT . "/plantillas/sidebar.php"  ?>

        <div class="layout-page">
            <?php include ROOT . "/plantillas/navbar.php"  ?>

            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">


                    <div class="card mb-3 w-50 ">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">bienvenid@ a tu Usuario <?= $_SESSION["user"]["nombre_usuario"] ?> </h5>
                                    <p class="mb-4">
                                        Aqui podras gestionar tu informacion

                                    </p>



                                </div>
                            </div>
                            <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body px-0 px-md-4">
                                    <img src="/sistema_estefany/public/image/user.png" height="120" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <div class="card  rounded-0">

                                <h5 class="card-header">Mi informacion</h5>
                                <div class="text-center text-sm-left">
                                    <div class="card-body">
                                        <form action="" method="post" id="form_actualizar_usuario">
                                            <div class="row">
                                                <div class="col-lg-6 mb-3">
                                                    <label for="">Nombre</label>
                                                    <input type="text" class="form-control" id="nombre_usuario_input" name="nombre" onkeypress="evitarNumeros(event)" value="<?= $usuario["nombre"] ?>">
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label for="">Apellido</label>
                                                    <input type="text" class="form-control" id="apellido_usuario_input" name="apellido" value="<?= $usuario["apellido"] ?>">
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label for="">Nombre de Usuario</label>
                                                    <input type="text" class="form-control" id="usuario_usuario_input" name="nombre_usuario" value="<?= $usuario["nombre_usuario"] ?>">
                                                </div>

                                                <div class="col-lg-6 mb-3">
                                                    <label for="">Correo</label>
                                                    <input type="text" class="form-control" id="correo_usuario_input" name="email" onkeypress="permitirSoloNumeros(event)" value="<?= $usuario["email"] ?>">
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label for="">Fecha de creacion del usuario</label>
                                                    <input type="text" class="form-control" id="fecha_usuario_input" name="fecha" onkeypress="permitirSoloNumeros(event)" value="<?= $usuario["fecha_creacion"] ?>" readonly>
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" value="<?= $usuario["id"] ?>">
                                            <div class="mt-3 text-end">
                                                
                                                
                                                <button type="button" class="btn btn-danger" onclick="location.reload();">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                            </div>
                                            
                                        </form>
                                        
                                    </div>
                                    
                                    
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="card">
                                <h5 class="card-header">Cambiar Contraseña</h5>
                                <div class="card-body">
                                    <form action="" method="post" id="form_cambiar_password">
                                        <label for="">Nueva Contraseña</label>
                                        <input type="text" class="form-control mb-3" id="password" name="password">
                                        <label for="">Confirmar Contraseña</label>
                                        <input type="text" class="form-control mb-3" id="password_confirmar" name="password_confirmar">
                                        <div class="d-flex gap-1">
                                            <button class="btn btn-primary w-50">Cambiar</button>
                                            <button class="btn btn-danger w-50">Cancelar</button>
                                            
                                        </div>
                                        <input type="hidden" name="id" value="<?= $usuario["id"] ?>">
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
        <div id="modal-container"></div>
        <div class="toast-container"></div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
</div>

<?php include ROOT . "/plantillas/scripts.php"  ?>

<script>
    $("#form_actualizar_usuario").submit(function(e) {

        e.preventDefault();
        let url = "/sistema_estefany/app/usuario/actualizar_usuario.php";
        console.log(this);
        let data = new FormData(this);

        $.ajax({
            type: "POST",
            url: url,
            data: data,
            processData: false, // tell jQuery not to process the data
            contentType: false,
            success: function(response) {
                response = JSON.parse(response);
                $("#usuario_usuario_input").val(response.usuario.nombre_usuario)
                alerta(response.tipo, response.mensaje);


            } // tell jQuery not to set contentType

        })
        return false;

    })
    $("#form_cambiar_password").submit(function(e) {

        e.preventDefault();
        let url = "/sistema_estefany/app/usuario/cambiar_password.php";
        console.log(this);
        let data = new FormData(this);

        $.ajax({
            type: "POST",
            url: url,
            data: data,
            processData: false, // tell jQuery not to process the data
            contentType: false,
            success: function(response) {
                response = JSON.parse(response);
                $("#password").val("");
                $("#password_confirmar").val("");
                alerta(response.tipo, response.mensaje);


            } // tell jQuery not to set contentType

        })
        return false;

    })
</script>