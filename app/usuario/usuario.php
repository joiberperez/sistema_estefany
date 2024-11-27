<?php
session_start();
if (empty($_SESSION["user"])) {
    header("Location: /sistema_estefany/");
  }


?>
<?php include "../config/config.php"  ?>



<?php include ROOT . "/plantillas/head.php"  ?>


<!-- Content -->

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        <?php include ROOT . "/plantillas/sidebar.php"  ?>

        <div class="layout-page">
            <?php include ROOT . "/plantillas/navbar.php"  ?>

            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">


                    <div class="card mb-3">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">bienvenid@ a Seguridad</h5>
                                    <p class="mb-4">
                                        Aqui podras gestionar a tus usuarios y tu informacion

                                    </p>
                                    <a class="btn btn-primary rounded-0" href="/sistema_estefany/app/usuario/mi_usuario.php" > Ver mi informacion <i class="bx bx-right-arrow-circle"></i></a>


                                </div>
                            </div>
                            <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body px-0 px-md-4">
                                    <img src="/sistema_estefany/public/image/seguridad-usuario.jpg" height="120" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3>Usuarios</h3>

                    <div class="row">
                        <div class="col-md-7 col-sm-12">
                            <div class="card  rounded-0">
                                <div class="row p-3">
                                    <div class="col-md-3 offset-9">
                                        <div class="input-group input-group-merge" bis_skin_checked="1">
                                            <input type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
                                            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="table-responsive text-nowrap mt-3" id="data-table">



                                </div>
                            </div>

                        </div>
                        <div class="col-md-5 col-sm-12">
                            <div class="card">
                                <h5 class="card-header">Detalle del Usuario</h5>
                                <div class="text-center text-sm-left">
                                    <div class="card-body px-0 px-md-4" id="actualizar_cliente">
                                        <img src="/sistema_estefany/public/image/cliente_interrogacion.png" height="250" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
                                    </div>

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
    $("#btn-abrir-modal").click(function() {
        $.get("/sistema_estefany/app/producto/crear_producto.php").done(function(data) {
            $("#modal-container").html("");
            $("#id_categoria").data("categoria", "");

            $("#modal-container").html(data);
            $(".modal").modal("show");
        })

    })
</script>
<script src="/sistema_estefany/public/js/usuario.js"></script>