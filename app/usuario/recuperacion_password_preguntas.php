<?php
session_start();
if (!defined("ROOT")) {
    include "../config/config.php";
}
include ROOT . "/models/modeloUsuario.php";
include ROOT . "/config/clase.php";


include ROOT . "/models/modeloLogs.php";



class CambiarPasswordUsuario extends BaseClase
{
    
    
    public function cambiar_password()
    {
        try {
            
            $modelo = new ModeloUsuario();
            
            $id = $_SESSION["id_usuario_recuperar_password"];
            
            if (!empty($_POST["nueva_password"]) && !empty($_POST["confirmar_password"])) {
                $password = $_POST["nueva_password"];
                $password_confirmar = $_POST["confirmar_password"];
                
                if($password === $password_confirmar){
                    $password = password_hash($password,PASSWORD_DEFAULT);
                    $datos = [
                        "contrasena" => $password,
                    ];
                    $modelo->actualizarCliente($id,$datos,"id");
                    
                    $log = new ModeloLogs();
                    $log->logUserAccion($id, 'actualizar_usuario', 'El usuario ha actualizado su contraseña.');
                    echo json_encode(["tipo"=>"success","mensaje"=>"¡Tu contraseña se ha cambiado con exito!"]);
                    
                }else{
                    
                    echo json_encode(["tipo"=>"danger","mensaje"=>"la confirmacion de la contraseña no coincide"]);
                    
                }
                
                
            }else{
                echo json_encode(["tipo"=>"danger","mensaje"=>"Los campos no pueden estar vacios"]);

            }
        } catch (Exception $e) {
            echo "error";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //se instancian las clases
    $autenticacion = new CambiarPasswordUsuario();
    $autenticacion->cambiar_password();
}else { ?>


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
          <div class="title">Reestablecimiento de Contraseña</div>
          <form class="form" method="post" id="form-registrar-usuario">
          
            <div class="input-boxes">
                <label for="">Nueva Contraseña</label>
                <input type="text" class="form-control rounded-0 mb-3" name="nueva_password">
                
                <label for="">Confirmar Contraseña</label>
                <input type="text" class="form-control rounded-0" name="confirmar_password">
                
              
            
              
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
            url: "/sistema_estefany/app/usuario/recuperacion_password_preguntas.php",
            data: data,
            processData: false, // tell jQuery not to process the data
            contentType: false,
            dataType: "json",
            success: function (response) {
              Swal.fire({
                        title: "Registro de Usuario",
                        text: response.mensaje,
                        icon: response.tipo,
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "ok",
                        
                    }).then((result) => {
                        
                        window.location.href = "/sistema_estefany/";
                        
                    
                  });
               
            } // tell jQuery not to set contentType
        })

return false;
})
</script>
<?php } ?>