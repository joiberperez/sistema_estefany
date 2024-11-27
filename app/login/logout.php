<?php
if(!defined("ROOT")){
    include "../config/config.php";

}
?>
<?php
include ROOT . "/models/modeloLogs.php";

session_start();
$log = new ModeloLogs();
$log->logUserAccion($_SESSION["user"]["id"], 'login', 'El usuario cerró sesión.');
unset($_SESSION["user"]);

header("Location: /sistema_estefany/");

?>