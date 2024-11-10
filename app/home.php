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
            <div class="col-lg-6 mb-3">
              <div class="card">
                <div class="card-body">

                  <h5 class="card-title">Obtener Dolar</h5>
                  <p class="card-text">Podras obtener el dolar mediante una conexion a internet o manualmente ingresando el valor</p>
                  <button class="btn btn-primary" id="abrir_modal_dolar">Ingreso manual</button>
                  <button class="btn btn-primary" id="btn_dolar">
                    <div id="spinner" class="spinner-border text-success spinner-border-sm"  role="status" style="display:none;">
                      <span class="sr-only" style="width: 4px;">Cargando...</span>
                    </div>
                    <div id="titulo_boton_dolar">
                      Obtener Dolar
                    </div>


                  </button>
                </div>
              </div>
            </div>
            <div class="col-lg-3  offset-md-3 mb-3">

              <div class="card">
  
                <div class="card-body">
  
                  <h5 class="card-title">Valor del Dolar</h5>
                  <h3 class="card-text"><span class="text-success">$</span>  <span id="dolar_valor">42.89</span> BS</h3>
                  
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
        <h5 class="modal-title" id="exampleModalLabel1">Actualizar Dolar</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
     


        <div class="modal-body">
        <div class="input-group" bis_skin_checked="1">
          <input type="text" class="form-control" id="input_dolar"  aria-label="Recipient's username" aria-describedby="button-addon2">
          <button class="btn btn-outline-primary btn-sm" id="enviar_dolar" type="button" id="button-addon2">Enviar</button>
        </div>

        </div>
        
      
    </div>
  </div>
</div>

  <?php include ROOT . "/plantillas/scripts.php"  ?>

  <script>
    $(document).ready(function() {
      $("#btn_dolar").click(function() {

        $('#titulo_boton_dolar').hide();
        $('#spinner').show();
        $.get("/sistema_estefany/app/dolar/actualizar_dolar.php",function(value){
          $('#spinner').hide();
          $('#titulo_boton_dolar').show();
          $('#dolar_valor').text(value);

        }).error()
      })
      $("#enviar_dolar").click(function() {

        let dolar = $("#input_dolar").val();
        $.get("/sistema_estefany/app/dolar/actualizar_dolar.php",{dolar},function(value){
          $('#spinner').hide();
          
          $(".modal").modal("hide");
          $('#dolar_valor').text(value);
          $("#input_dolar").val("");

        }).error()
      })
      $("#abrir_modal_dolar").click(function() {
        
        $(".modal").modal("show");

        
      })
    })
    
  </script>