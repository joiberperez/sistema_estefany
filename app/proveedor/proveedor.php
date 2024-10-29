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
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">Inicio</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="javascript:void(0);">Proveedor</a>
                            </li>
                            <!-- <li class="breadcrumb-item active">Data</li> -->
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-lg-8 mb-2">
                            <div class="card">
                                <div class="d-flex align-items-end row">
                                    <div class="col-sm-6">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary">bienvenid@ a Proveedores</h5>
                                            <p class="mb-4">
                                                Aqui podras gestionar a tus proveedores
    
                                            </p>


                                        </div>
                                    </div>
                                    <div class="col-sm-4 text-center text-sm-left">
                                        <div class="card-body px-0 px-md-4 p-1">
                                            <img src="/sistema_estefany/public/image/camion.png" height="150" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">

                                    <span class="fw-semibold d-block mb-1 text-primary ">Proveedores Registrados</span>
                                    <h3 class="card-title mt-3 mb-3">100</h3>
                                    <button type="button" class="btn btn-sm btn-primary" id="btn-abrir-modal" >
                                        Nuevo Proveedor
                                    </button>
                                    

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-7 col-sm-12">
                            <div class="card mt-5">
                                <h5 class="card-header">Listado de Proveedores</h5>
                                <div class="table-responsive text-nowrap" id="data-table">



                                </div>
                            </div>

                        </div>
                        <div class="col-lg-5">
                            <div class="card mt-5">
                                <h5 class="card-header">Actualizar Proveedor</h5>
                                <div class="text-center text-sm-left">
                                    <div class="card-body px-0 px-md-4" id="actualizar_proveedor">
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

<script src="/sistema_estefany/public/js/proveedor.js"></script>
<script>
 
    $("#btn-abrir-modal").click(function(){
        $.get("/sistema_estefany/app/proveedor/crear_proveedor.php").done(function(data) {
            $("#modal-container").html(data);
            $(".modal").modal("show");
        })

    })
   
 



</script>


