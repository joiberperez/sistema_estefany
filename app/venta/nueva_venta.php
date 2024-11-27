<?php 
session_start();
?>
<?php include "../config/config.php"  ?>


<?php include ROOT . "/plantillas/head.php"  ?>
<style>
    .border-bottom {
        border-bottom: 2px solid !important;
        /* Cambia 'black' al color que prefieras */
    }

    .select2-container--bootstrap-5 .select2-selection--single {
        height: calc(2.25rem + 2px);
        /* Tamaño adecuado para inputs de Bootstrap */
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border: 1px solid #ced4da;
        border-radius: 5px;
    }
</style>


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
                                <a href="javascript:void(0);">Venta</a>
                            </li>
                            <!-- <li class="breadcrumb-item active">Data</li> -->
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card mb-3 p-3">
                                        <h5 class="card-title">Buscar Producto</h5>


                                        <div class="input-group input-group-merge border-bottom border-primary shadow-none mb-3" bis_skin_checked="1">
                                            <span class="input-group-text border-0" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                                            <input type="text" class="form-control border-0" placeholder="Search..." aria-label="Search..." id="buscarProducto" onkeyup="listarProductosVenta();" aria-describedby="basic-addon-search31">
                                        </div>
                                        <div id="listado_producto"></div>

                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="card border-bottom border-primary">

                                        <div class="card-body">

                                            <h5 class="card-title">Buscar Cliente</h5>

                                            <select class="form-select" name="" id="select_cliente">
                                                <option value="">Hola</option>
                                                <option value="">pendejo</option>
                                            </select>


                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="col-md-7 mb-3">

                            <div class="card border-bottom  border-primary border-rounded-0">

                                <div class="card-body">

                                    <h5 class="card-title">Detalle Producto</h5>
                                    <div id="detalle_producto">
                                        <div class="text-center text-sm-left">
                                            <div class="card-body px-0 px-md-4" id="actualizar_proveedor">
                                                <img src="/sistema_estefany/public/image/caja_interrogacion.png" style="width: 150px;" height="100" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md-12">

                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="mt-3">Listado de Productos</h5>

                                        </div>
                                        <div class="col-6 text-end">
                                            <button disabled class="btn btn-primary rounded-0" id="btn_venta" onclick="abrirModal()"><i class="fas fa-plus"></i> Generar Venta</button>

                                        </div>
                                    </div>




                                </div>
                                <div class="">
                                    <table class="table" id="productosTabla">
                                        <thead>
                                            <tr>
                                                <th>Código</th>
                                                <th>Nombre</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                <th>Precio Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Las filas de datos se insertarán aquí -->
                                        </tbody>
                                        <tfoot>

                                        </tfoot>
                                    </table>
                                    <p class="m-3 text-end"><strong>Total: </strong><span id="total_venta">$0</span> </p>

                                </div>



                            </div>
                        </div>


                    </div>
                </div>

            </div>
            <!-- Overlay -->

            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
    </div>
    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Forma de pago</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>



                <div class="modal-body">
                    <form action="" id="registrar_venta" method="post">
                        <div id="select_container"></div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <button type="button" class="btn btn-outline-secondary w-100" data-bs-dismiss="modal">
                                    Cancelar
                                </button>
                                
                            </div>
                            <div class="col-6">
                                <button type="submit"  class="btn btn-primary w-100">Registrar</button>
        
                            </div>
                        
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal-container"></div>
<div class="toast-container"></div>
<?php include ROOT . "/plantillas/scripts.php"  ?>

<script src="/sistema_estefany/public/js/nueva_venta.js"></script>