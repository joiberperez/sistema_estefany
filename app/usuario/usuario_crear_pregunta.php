<?php 
session_start();
if (!defined("ROOT")) {
    include "../config/config.php";
  }
  include ROOT . "/models/modeloPreguntas.php";
?>
<?php
 class CrearPreguntasUsuario{
        

        public function crear_pregunta(){
            try {

                $modelo = new ModeloPreguntas();
          
                $id_usuario =  $_SESSION["usuario_creado_id"];
                $pregunta = $_POST["pregunta"];
                $respuesta = $_POST["respuesta"];
               

                      $datos = [
                        "id_usuario" => $id_usuario,
                        "pregunta" => $pregunta,
                        "respuesta" => $respuesta
                
                      ];
                    
                  $modelo->create($datos);
                  unset($_SESSION["usuario_creado_id"]);

                  
        
    }catch(Exception $e){
        echo "error";
    }
 }   
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
  //se instancian las clases
  $autenticacion = new CrearPreguntasUsuario();
  $autenticacion->crear_pregunta();

}

?>
<!DOCTYPE html>

<html lang="en" dir="ltr">

    <?php include ROOT . "/plantillas/head.php"  ?>
<head>
  <meta charset="UTF-8">

  <link rel="stylesheet" href="/sistema_estefany/public/css/style_login.css">
  <link rel="stylesheet" href="/sistema_estefany/public/lib/fontawesome/css/all.min.css">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="/sistema_estefany/public/image/frontImg.jpg" alt="">
        <div class="text">
          <span class="text-1">Donde encontraras<br>todo lo que necesites</span>
          <span class="text-2">para tus postres</span>
        </div>
      </div>
      <div class="back">
        <img class="backImg" src="./public/image/frontImg.jpg" alt="">
        <div class="text">
          <span class="text-1">Donde encontraras<br>todo lo que necesites</span>
          <span class="text-2">para tus postres</span>
        </div>
      </div>
    </div>
    <div class="forms">
      <div class="form-content">
        <div class="login-form">
          <div class="title">Registrar Pregunta de Seguridad</div>
          <form class="form" method="post" action="/sistema_estefany/app/usuario/usuario_crear_pregunta.php" id="form-registrar-usuario">
          
            <div class="input-boxes">
                <label for="">Pregunta</label>
                <textarea type="text" class="form-control rounded-0 mb-3" name="pregunta"></textarea>
                
                <label for="">Respuesta</label>
                <textarea type="text" class="form-control rounded-0" name="respuesta"></textarea>
              
            
              
              <div class="button input-box">
                <input type="submit" value="Ingresar">
              </div>
             
              
             
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</body>

<?php include ROOT . "/plantillas/scripts.php"  ?>
<script>
    $("#form-registrar-usuario").submit(function(e){
e.preventDefault();
let data = new FormData(this);
$.ajax({
            type: "POST",
            url: "/sistema_estefany/app/usuario/usuario_crear_pregunta.php",
            data: data,
            processData: false, // tell jQuery not to process the data
            contentType: false,
            success: function (response) {
              Swal.fire({
                        title: "Registro de Usuario",
                        text: "Usuario creado con exito",
                        icon: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "ok",
                        
                    }).then((result) => {
                        
                        // window.location.href = "/sistema_estefany/";
                        
                    
                  });
               
            } // tell jQuery not to set contentType
        })

return false;
})
</script>
