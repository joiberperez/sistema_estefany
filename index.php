<?php
//se inicia la session
session_start();
if(isset($_SESSION["usuario"])){
  header("Location: /sistema_estefany/app/home.php");
}
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">

  <link rel="stylesheet" href="./public/css/style_login.css">
  <link rel="stylesheet" href="./public/lib/fontawesome/css/all.min.css">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="./public/image/frontImg.jpg" alt="">
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
          <div class="title">Inicio de sesion</div>
          <form class="form" method="post" action="./index.php">
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
                <input type="text" placeholder="Dijite su usuario" name="usuario" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Dijite su contraseña" name="password" required>
              </div>

              <div class="text"><a href="/sistema_estefany/app/usuario/obtener_usuario_password.php">Olvido su contraseña?</a></div>
              <div class="button input-box">
                <input type="submit" value="Ingresar">
              </div>

              <div class="text">No tienes cuenta? <a href="/sistema_estefany/app/usuario/crear_usuario.php">crea una</a></div>
              
              <div class="text sign-up-text"></div>
              <div class="text sign-up-text"></div>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</body>
<?php require "./app/login/login.php" ?>
</html>
