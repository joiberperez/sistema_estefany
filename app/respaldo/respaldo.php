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

                    <h4 class="text-start mb-5">Respaldo</h4>

                    <div class="row ">
                        <div class="col-md-6">
                            <h5 class="text-start text-primary mb-3">Repaldar</h5>
                            <p>Puedes respaldar los datos</p>

                            <div class="card">
                                <div class="card-body">

                                    <div class="text-center" id="archivo_sql">
                                        <div class="mb-3">
                                            <img src="/sistema_estefany/public/image/descarga_archivo.png" width="150" alt="">

                                        </div>



                                        <a class="btn btn-primary w-50" href="/sistema_estefany/app/respaldo/respaldo_crear.php" id="btn_respaldar">Respaldar</a>

                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <h5 class="text-start text-primary mb-3">Restaurar</h5>

                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center" id="archivo_sql">

                                        <img src="/sistema_estefany/public/image/sql.png" width="150" alt="">
                                        <div class="">
                                            <label for="formFile" class="form-label">Selecciona el respaldo</label>

                                        </div>
                                        <form action="" method="post" id="form_restaurar">
                                            <input class="form-control mb-3" type="file" id="fileInput" name="archivo_sql">
                                            <button type="submit" class="btn btn-primary w-50" disabled="true" id="btn_restaurar">Restaurar</button>

                                        </form>


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
        const btn = document.getElementById("btn_restaurar");
        const file = event.target.files[0];
        const archivo_sql = document.getElementById("archivo_sql"); // Obtiene el archivo seleccionado
        if (file) {

            btn.disabled = false;
            console.log(btn)

        } else {
            archivo_sql.style.display = "none"

        }
    });
    $("#form_restaurar").submit(function(e) {
        e.preventDefault();
        Swal.fire({
            title: "Estas seguro?",
            text: "Si la respaldas, no se podrá revertir la accion",
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                let data = new FormData(this);
                let url = "/sistema_estefany/app/respaldo/restaurar.php"
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    processData: false, // tell jQuery not to process the data
                    contentType: false,
                    success: function(response) {
                        response = JSON.parse(response);
                        Swal.fire({
                            title: "Datos Restaurados",
                            text: response.mensaje,
                            icon: "success",
                        }).then((result)=>{
                            window.location.reload();

                        })




                    } // tell jQuery not to set contentType
                })

            }
        });
    })

    function confirmarRespaldar(e) {

    }
</script>