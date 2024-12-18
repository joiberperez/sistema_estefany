<?php
session_start();
if (!defined("ROOT")) {
    include "../config/config.php";
  }

?>

  <?php include ROOT . "/plantillas/head.php"  ?>

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
      <div class="form-content" id="obtenerUsuario">
        <div class="login-form">
          <div class="title">Crear cuenta</div>
          <form class="form" method="get" id="form-registrar-usuario" action="/sistema_estefany/app/usuario/recuperar_password.php">
           
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Dijite su nombre" id="usuario_input" name="usuario" required>
              </div>
              

              
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
