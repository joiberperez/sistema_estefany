<?php
session_start();
if (empty($_SESSION["user"])) {
  header("Location: /sistema_estefany/");
}


?>
<?php include "config/config.php"  ?>


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
            <div class="col-md-3">
              <div class="card mb-3">
                <div class="card-body d-flex  align-items-center justify-content-between ">
                  <img src="/sistema_estefany/public/image/ventas.png" width="100" alt="">
                  <div class="">
                    <h6>Ventas Realizadas</h6>
                    <p class="fs-3"><span class="text-success" id="cantidad_venta"></span></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card mb-3">
                <div class="card-body d-flex  align-items-center justify-content-between ">
                  <img src="/sistema_estefany/public/image/productos.png" width="100" alt="">
                  <div class="">
                    <h6>Productos Registrados</h6>
                    <p class="fs-3"><span class="text-success" id="cantidad_producto"></span></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card mb-3">
                <div class="card-body d-flex  align-items-center justify-content-between ">
                  <img src="/sistema_estefany/public/image/cliente_home.png" width="130" alt="">
                  <div class="">
                    <h6>Clientes Registrados</h6>
                    <p class="fs-3"><span class="text-success" id="cantidad_cliente"></span></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card mb-3">
                <div class="card-body d-flex  align-items-center justify-content-between ">
                  <img src="/sistema_estefany/public/image/lista.png" width="105" alt="">
                  <div class="">
                    <h6>Cantidad de Proveedores</h6>
                    <p class="fs-3"><span class="text-success" id="cantidad_proveedor"></span></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mb-3">
              <div class="card">
                <div class="card-body">
                  <label for="year">Selecciona el Año:</label>
                  <div class="d-flex gap-2">
                    <select class="form-select w-25" id="year">
                    </select>
                    <button class="btn btn-primary" onclick="actualizar_ventas_mes_graficos()">Filtrar</button>

                  </div>
                  <div>
                    <canvas id="myChart"></canvas>
                  </div>

                </div>

              </div>

            </div>
            <div class="col-md-6 ">
              <div class="card">
                <div class="card-body">
                  <div>
                    <canvas id="pie_chart_producto_mas_vendido"></canvas>
                  </div>

                </div>

              </div>

            </div>
            <div class="col-md-6 ">
              <div class="card">
                <div class="card-body">
                  <div>
                    <canvas id="pie_chart_producto_menos_vendido"></canvas>
                  </div>

                </div>

              </div>

            </div>
          </div>
          <?php include ROOT . "/plantillas/scripts.php"  ?>
          
          <script src="/sistema_estefany/public/js/home.js"></script>
          


        </div>
        <!-- Overlay -->

        <div class="layout-overlay layout-menu-toggle"></div>
      </div>
    </div>



