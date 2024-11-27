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
                                        Aqui podras gestionar las configuraciones principales, como establecer el valor del dolar, registrar categorias

                                    </p>



                                </div>
                            </div>
                            <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body px-0 px-md-4">
                                    <img src="/sistema_estefany/public/image/configuracion.jpg" height="120" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3>Dolar</h3>

                    <div class="row">
                        <div class="col-md-8 col-sm-12 mb-3">


                            <div class="card">
                                <div class="card-body">

                                    <h5 class="card-title">Obtener Dolar</h5>
                                    <p class="card-text">Podras ingresar el dolar manualmente</p>
                                    <button class="btn btn-primary rounded-0" id="abrir_modal_dolar">Ingresar <i class="bx bx-up-arrow-circle"></i></button>

                                </div>
                            </div>


                            
                        </div>
                        <div class="col-md-4 mb-3">

                            <div class="card">

                                <div class="card-body pb-4">

                                    <h5 class="card-title mb-5">Valor del Dolar</h5>
                                    <h3 class="card-text"><span class="text-success">$ = </span> <span id="dolar_valor">42.89</span> BS</h3>

                                </div>
                            </div>
                        </div>

                    </div>
                    <h3>Categoria</h3>
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <div class="card">
                                
                                <div class="card-body">
                                <div class="text-end">
                                    <button class="btn btn-primary" id="abrir_modal_categoria"><i class="bx bx-plus"></i> Agregar</button>

                                </div>
                                <div class="table-responsive text-nowrap mt-3" id="data-table">
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div id="actualizar_categoria"></div>
                        </div>

                    </div>

                </div>


            </div>

        </div>
    </div>
    <div class="modal fade" id="RegistrarModalDolar"  tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Actualizar Dolar</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>



                <div class="modal-body">
                    <div class="input-group" bis_skin_checked="1">
                        <input type="text" class="form-control" id="input_dolar" aria-label="Recipient's username" aria-describedby="button-addon2"  oninput="formatearNumero(this)">
                        <button class="btn btn-outline-primary btn-sm" id="enviar_dolar" type="button" id="button-addon2">Enviar</button>
                    </div>

                </div>


            </div>
        </div>
    </div>
    <div class="modal fade" id="RegistrarModalCategoria" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Registrar Categoria</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>



                <div class="modal-body">
                    <form action="" method="post" id="resgistrarFormCategoria">
                        <label for="">Nombre de categoria</label>
                        <input type="text" class="form-control" name="nombre" id="input_dolar">
                        <label for="">Descripcion</label>
                        <textarea class="form-control mb-3" name="descripcion" id=""></textarea>
     
                        
                        
                        <div class="row">
                            
                            
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary w-100">Registrar</button>
                                
                            </div>
                            <div class="col-6">
                                
                                <button class="btn btn-danger w-100">Cancelar</button>
                            </div>
                        </div>
                    </form>
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

<script src="/sistema_estefany/public/js/configuracion.js"></script>
<script>

</script>