<?php include "../config/config.php"  ?>


<?php include ROOT . "/plantillas/head.php"  ?>
<style>
    .border-bottom {
        border-bottom: 2px solid !important;
        /* Cambia 'black' al color que prefieras */
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
                        <div class="col-md-4 mb-3">
                            <div class="card border-bottom  border-primary">

                                <div class="card-body">

                                    <h5 class="card-title">Cantidad de Ventas realizadas</h5>
                                    <h3 class="card-text"><span class="text-success"><i class="fa-solid fa-cart-shopping"></i></span> <span id="dolar_valor">100</span></h3>

                                </div>
                            </div>

                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card border-bottom  border-primary">

                                <div class="card-body">

                                    <h5 class="card-title">Cantidad de Ventas pendiente</h5>
                                    <h3 class="card-text"><span class="text-danger"><i class="fa-solid fa-credit-card"></i></span> <span id="dolar_valor">100</span></h3>

                                </div>
                            </div>

                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card border-bottom border-primary">

                                <div class="card-body">

                                    <h5 class="card-title">Registrar Venta</h5>

                                    <a class="btn btn-primary btn-sm text-white" href="/sistema_estefany/app/venta/nueva_venta.php/"><span class="text-success"><i class="fa-solid fa-cart-plus"></i></span> Nueva venta</a>


                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="card mt-4">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <h5>Listado de Venta</h5>
                                    
                                </div>
                                <div class="col-md-2 offset-md-1 mb-2">
                                    <select name="" class="form-select" id="select_filtro" onchange="obtenerDatosSeleccion();">

                                        <option value="todas">Todas</option>
                                        <option value="r">Realizadas</option>
                                        <option value="p">Pendientes</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <div class="input-group">

                                        <input type="text" class="form-control" placeholder="YYYY-MM-DD to YYYY-MM-DD" id="fecha_rango_venta" readonly>

                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap" id="data-table">


                        </div>



                    </div>
                </div>
                <!-- Overlay -->

                <div class="layout-overlay layout-menu-toggle"></div>
            </div>
        </div>

    </div>

    <?php include ROOT . "/plantillas/scripts.php"  ?>

    <script src="/sistema_estefany/public/js/venta.js"></script>

    <script>
        $(document).ready(function() {
            alerta();

            $('#fecha_rango_venta').daterangepicker({
                locale: {
                    format: 'DD-MM-YYYY', // Formato de las fechas
                    applyLabel: "Aplicar",
                    cancelLabel: "Cancelar",
                    daysOfWeek: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
                    monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                },
                startDate: moment().subtract(29, 'days'), // Fecha de inicio por defecto
                endDate: moment() // Fecha de fin por defecto
            });
            $('#fecha_rango_venta').on('apply.daterangepicker', function(ev, picker) {
                var fechaInicio = picker.startDate.format('DD-MM-YYYY');
                var fechaFin = picker.endDate.format('DD-MM-YYYY');

                // Muestra las fechas en la consola o úsala en tu lógica
                console.log("Fecha de inicio seleccionada: " + fechaInicio);
                console.log("Fecha de fin seleccionada: " + fechaFin);
            });
        });

        function obtenerDatosSeleccion() {
            // Obtener el elemento select
            const select = document.getElementById("select_filtro");

            // Obtener la opción seleccionada
            const opcionSeleccionada = select.options[select.selectedIndex];

            // Extraer los valores
            const id = opcionSeleccionada.value;
            console.log(id);
        }
    </script>