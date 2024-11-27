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
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">Inicio</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="javascript:void(0);">Cliente</a>
                            </li>
                            <!-- <li class="breadcrumb-item active">Data</li> -->
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-lg-8 mb-2">
                            <div class="card">
                                <div class="d-flex align-items-end row">
                                    <div class="col-sm-7">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary">bienvenid@ a Clientes</h5>
                                            <p class="mb-4">
                                                Aqui podras gestionar a tus clientes

                                            </p>


                                        </div>
                                    </div>
                                    <div class="col-sm-5 text-center text-sm-left">
                                        <div class="card-body px-0 px-md-4">
                                            <img src="/sistema_estefany/public/image/cliente.png" height="120" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">

                                    <span class="fw-semibold d-block mb-1 text-primary ">Clientes Registrados</span>
                                    <h3 class="card-title mt-3 mb-3">100</h3>
                                    <button type="button" class="btn btn-sm btn-primary" id="btn-abrir-modal">
                                        Nuevo Cliente
                                    </button>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-7 col-sm-12">
                            <div class="card mt-5">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-header">Listado de Clientes</h5>
                                    <div class="w-25 m-3">
                                        <input type="text" class="form-control" id="busqueda-tabla" onkeyup="filtrarTabla()">

                                    </div>

                                </div>

                                <div class="table-responsive text-nowrap" id="data-table">



                                </div>
                            </div>

                        </div>
                        <div class="col-lg-5">
                            <div class="card mt-5">
                                <h5 class="card-header">Actualizar Cliente</h5>
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
    $.get("/sistema_estefany/app/cliente/crear_cliente.php").done(function (data) {
        $("#modal-container").html("");
        $("#modal-container").html(data);
        $(".modal").modal("show");
    })

})
function filtrarTabla(){
            let filtro = $("#busqueda-tabla").val();
            
            $.get("/sistema_estefany/app/cliente/listar_cliente.php",{ filtro }).done(function(data){
                console.log("hola")
                $("#data-table").html(data);
            })
        }
</script>
<script src="/sistema_estefany/public/js/cliente.js"></script>