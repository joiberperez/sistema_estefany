<?php
session_start();
if (!defined("ROOT")) {
  include "../config/config.php";
}
include ROOT . "/models/modeloPreguntas.php";
include ROOT . "/models/modeloUsuario.php";
include ROOT . "/config/clase.php";


class RecuperarAcceso
{
  private $pregunta;

  function mostrarPregunta()
  {
    $usuario = $_GET["usuario"];
    $usuarioModel = new ModeloUsuario();
    $usuarioModel = $usuarioModel->selectUser($usuario);
    if ($usuarioModel->rowCount() == 1) {
      $usuario = $usuarioModel->fetch(PDO::FETCH_ASSOC);
      $usuario_id = $usuario["id"];

      $preguntaModelo = new ModeloPreguntas();
      $pregunta = $preguntaModelo->getDetail("id_usuario", $usuario_id);
      if (!empty($pregunta)) {
        $this->pregunta = $pregunta;
        return ["pregunta" => $pregunta, "usuario_id" => $usuario_id];
      } else {
        return ["error" => "no se ha encontrado ninguna pregunta"];
      }
    } else {
      return ["error" => "no se ha encontrado un usuario"];
    }
  }
  function verificar_respuesta()
  {
    $respuesta = $_POST["respuesta"];
    $usuario_id = $_POST["usuario_id"];
    $preguntaModelo = new ModeloPreguntas();
    $pregunta = $preguntaModelo->getDetail("id_usuario", $usuario_id);
    if ($respuesta == $pregunta["respuesta"]) {
      $_SESSION["id_usuario_recuperar_password"] = $usuario_id;
      return json_encode(["success" => "respuesta incorrecta"]);
    } else {
      return json_encode(["error" => "respuesta incorrecta"]);
    }
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //se instancian las clases
  $autenticacion = new RecuperarAcceso();
  $data = $autenticacion->verificar_respuesta();
  echo $data;
} else {
  $recuperar = new RecuperarAcceso();
  $data = $recuperar->mostrarPregunta();
  extract($data);

?>
  <?php include ROOT . "/plantillas/head.php"  ?>

  <link rel="stylesheet" href="/sistema_estefany/public/css/style_login.css">
  <link rel="stylesheet" href="/sistema_estefany/public/lib/fontawesome/css/all.min.css">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>

  <body>
    <div class="container">
      <input type="checkbox" id="flip">
      <div class="forms">
        <div class="form-content" id="obtenerUsuario">
          <div class="login-form">
            <div class="title">Pregunta de seguridad</div>
            <?php if (!empty($pregunta)): ?>
              <form class="form" method="post" action="/sistema_estefany/app/usuario/recuperar_password.php" id="form-comprobar-respuesta">
                <p class="text-dark fs-4 mt-5"><?= $pregunta["pregunta"] ?></p>
                <div class="input-boxes">
                  <div class="input-box">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Escriba su respuesta" name="respuesta" required>
                    <input type="hidden" name="usuario_id" value="<?= $usuario_id ?>">
                  </div>




                  <div class="button input-box">
                    <input type="submit" value="Ingresar">
                  </div>



                </div>
              </form>

            <?php else: ?>
              <div class="alert alert-danger mt-3" role="alert">
                <?= $error ?>
              </div>
              <div class="button input-box">
                <input type="button" value="Regresar" onclick="window.location.href='/sistema_estefany/app/usuario/obtener_usuario_password.php'">
              </div>
            <?php endif ?>
          </div>
        </div>
      </div>
    </div>


    <?php include ROOT . "/plantillas/scripts.php"  ?>
    <script>
      $("#form-comprobar-respuesta").submit(function(e) {
        e.preventDefault();
        let data = new FormData(this);
        $.ajax({
          type: "POST",
          url: "/sistema_estefany/app/usuario/recuperar_password.php",
          data: data,
          processData: false, // tell jQuery not to process the data
          contentType: false,
          dataType: "json",
          success: function(response) {
            console.log(response);
            if ("error" in response) {
              let div = `<div class="alert alert-danger mt-3" role="alert">
            ${response.error}
            </div>`;
              $(".text-dark").html(div);
            } else {
              window.location.href = "/sistema_estefany/app/usuario/recuperacion_password_preguntas.php"
            };



          } // tell jQuery not to set contentType
        })

        return false;
      })
    </script>
  </body>

<?php } ?>