<?php
session_start();
if (!defined("ROOT")) {
    include "../config/config.php";
  }
  include ROOT . "/models/modeloUsuario.php";
  include ROOT . "/config/clase.php";
   


    
    class CrearUsuario extends BaseClase{
        

        public function crear_usuario(){
            try {

                $modelo = new ModeloUsuario();
          
          
                $nombre = $this->parsearCadena($_POST["nombre"]);
                $apellido = $this->parsearCadena($_POST["apellido"]);
                $usuario = $_POST["usuario"];
                $email = $_POST["email"];
                if(!empty($nombre) && !empty($apellido) && !empty($usuario) && !empty($email)){
                    $password = password_hash($_POST["password"],PASSWORD_DEFAULT);
                    $pruebaAdministrador = $modelo->conn->query("SELECT * FROM seguridad");
                    if($pruebaAdministrador->rowCount() < 1){
                      $datos = [
                        "nombre" => $nombre,
                        "apellido" => $apellido,
                        "nombre_usuario" => $usuario,
                        "email" => $email,
                        "contrasena" => $password,
                        "rol" => "a"
                
                      ];

                    }else{

                      $datos = [
                        "nombre" => $nombre,
                        "apellido" => $apellido,
                        "nombre_usuario" => $usuario,
                        "email" => $email,
                        "contrasena" => $password
                
                      ];
                    }
                  $id = $modelo->create($datos);
                  $_SESSION["usuario_creado_id"] = $id;

                  
        }
    }catch(Exception $e){
        echo "error";
    }
 }   
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
  //se instancian las clases
  $autenticacion = new CrearUsuario();
  $autenticacion->crear_usuario();

}

?>
<!DOCTYPE html>

<html lang="en" dir="ltr">

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
          <div class="title">Crear cuenta</div>
          <form class="form" method="post" action="/sistema_estefany/app/usuario/crear_usuario.php" id="form-registrar-usuario">
            <?php
            //verifica que la variable este en la session
            if (isset($_SESSION['error'])) { ?>
              <div class="error">
              <i class="fa-solid fa-triangle-exclamation"></i>
                <?php
                //si esta, imprime el mensaje de error
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>

              
              </div>
            <?php } ?>
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Dijite su nombre" name="nombre" required>
              </div>
              <div class="input-box">
                  <i class="fas fa-user"></i>
                <input type="text" placeholder="Dijite su apellido" name="apellido" required>
              </div>
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Dijite su usuario" name="usuario" required>
              </div>
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Dijite su email" name="email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Dijite su contraseña" name="password" required>
              </div>
              <div class="text">Ya tienes cuenta? <a href="/sistema_estefany/">Ve al login</a></div>

              
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
            url: "/sistema_estefany/app/usuario/crear_usuario.php",
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
                        
                         window.location.href = "/sistema_estefany/app/usuario/usuario_crear_pregunta.php";
                        
                    
                  });
               
            } // tell jQuery not to set contentType
        })

return false;
})
</script>