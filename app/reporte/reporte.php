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

                    <h4 class="text-start mb-5">Reportes</h4>

                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-start text-primary">Reporte de Venta</h5>
                            <div class="row">
                                <div class="col-md-7 mb-3">
                                    <label class="mb-2" for="">Por fecha</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="YYYY-MM-DD to YYYY-MM-DD" id="fecha_rango_venta" readonly>
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>

                                </div>
                                <div class="col-md-5 mb-3">
                                    <label class="mb-2" for="">Por Cedula Cliente</label>
                                    <div class="input-group input-group-merge" bis_skin_checked="1">
                                        <input type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
                                        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                                    </div>

                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="card rounded-0">
                                        <div class="card-body">
                                            <div class="text-end">
                                                <button class="btn btn-sm btn-primary rounded-0 mb-2" id="btn-reporte-venta" onclick="generar_pdf_venta()" disabled>Generar <i class="fa-regular fa-file-pdf"></i></button>

                                            </div>
                                            <div class="table-responsive text-nowrap" id="data-table-venta">


                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                        <div class="col-md-6">
                            <h5 class="text-start text-primary">Reporte de Productos agotados</h5>
                            <div class="row">
                               
                                <div class="col-md-7 mb-3">
                                    <label class="mb-2" for="">Por Cantidad de agotamiento</label>
                                    <div class="input-group input-group-merge" bis_skin_checked="1" >
                                        <input type="text" class="form-control" placeholder="Search..." id="buscarProductoAgotado" onkeyup="habilitarBotonFiltrarProducto()">
                                    </div>

                                </div>
                                <div class="col-md-3 mb-3 align-self-end" >
                                    
                                    <button class="btn btn-primary btn-sm " id="btn-filtrar-producto"  disabled style="height:40px" onclick="filtrarProductosAgotado()"> <i class="bx bx-search"></i></button>

                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="card rounded-0">
                                        <div class="card-body">
                                            <div class="text-end">
                                                <button class="btn btn-sm btn-primary rounded-0 mb-2" id="btn-reporte-producto" onclick="generar_pdf_producto()" disabled>Generar <i class="fa-regular fa-file-pdf"></i></button>

                                            </div>
                                            <div class="table-responsive text-nowrap" id="data-table-producto">


                                            </div>
                                        </div>
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
    let fechaInicio;
    let fechaFin;
    
    $(document).ready(function() {

        $('#fecha_rango_venta').daterangepicker({
            maxDate: moment(),
            locale: {
                format: 'DD-MM-YYYY', // Formato de las fechas
                applyLabel: "Aplicar",
                cancelLabel: "Cancelar",
                daysOfWeek: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
                monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            },
            startDate: moment().subtract(0, 'days'), // Fecha de inicio por defecto
            endDate: moment() // Fecha de fin por defecto
        });
        $('#fecha_rango_venta').on('apply.daterangepicker', function(ev, picker) {
            fechaInicio = picker.startDate.format('DD-MM-YYYY');
            fechaFin = picker.endDate.format('DD-MM-YYYY');
            $('#btn-reporte-venta').prop('disabled', false);

            // Muestra las fechas en la consola o úsala en tu lógica
            console.log("Fecha de inicio seleccionada: " + fechaInicio);
            console.log("Fecha de fin seleccionada: " + fechaFin);
        });
    });

    
</script>