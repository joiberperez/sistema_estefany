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

                    <h4 class="text-start mb-5">Respaldo</h4>

                    <div class="row ">
                        <div class="col-md-6">
                            <h5 class="text-start text-primary mb-3">Repaldar</h5>

                            <div class="card rounded-0">
                                <div class="card-body">

                                    <button class="btn btn-primary">Respaldar</button>

                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <h5 class="text-start text-primary mb-3">Restaurar</h5>

                            <div class="card rounded-0">
                                <div class="card-body">
                                    <div class="text-center" id="archivo_sql">
                                        <img src="/sistema_estefany/public/image/sql.png" width="150" alt="">
                                        <div class="">
                                            <label for="formFile" class="form-label">Selecciona el respaldo</label>
                                            
                                        </div>
                                        <input class="form-control mb-3" type="file" id="formFile">
                                        <button class="btn btn-primary w-50">Restaurar</button>

                                        
                                    </div>
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
<script src="/sistema_estefany/public/js/reporte.js"></script>
<script>
    document.getElementById('fileInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const archivo_sql = document.getElementById("archivo_sql"); // Obtiene el archivo seleccionado
        if (file) {
            const fileName = file.name; // Obtiene el nombre del archivo
            archivo_sql.style.display = "block"
            document.getElementById('fileName').textContent = `${fileName}`;
        } else {
            archivo_sql.style.display = "none"

        }
    });
</script>