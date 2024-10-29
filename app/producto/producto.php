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
                    <div class="row">
                        <div class="col-10 mt-2">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="javascript:void(0);">Inicio</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        <a href="javascript:void(0);">Producto</a>
                                    </li>
                                    <!-- <li class="breadcrumb-item active">Data</li> -->
                                </ol>
                            </nav>

                        </div>
                        <div class="col-2 text-end">

                            <button class="btn btn-primary" id="btn-abrir-modal">Registrar Producto</button>
                        </div>
                    </div>
             
                    <div class="row">
                        <div class="col-lg-8 col-sm-12">
                            <div class="card mt-5">
                                <h5 class="card-header">Listado de Productos</h5>
                                <div class="table-responsive text-nowrap" id="data-table">



                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4">
                            <div class="card mt-5">
                                <h5 class="card-header">Detalle Producto</h5>
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
    $("#btn-abrir-modal").click(function () {
    $.get("/sistema_estefany/app/producto/crear_producto.php").done(function (data) {
        $("#modal-container").html("");
        $("#id_categoria").data("categoria", "");
        
        $("#modal-container").html(data);
        $(".modal").modal("show");
    })

})
</script>
<script src="/sistema_estefany/public/js/producto.js"></script>