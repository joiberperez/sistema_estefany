<?php
if(!defined("ROOT")){
    include "../config/config.php";

}
?>
<?php
include ROOT . "/models/modeloCliente.php";
include ROOT . "/config/clase.php";

function obtener_cliente(){
    $filtro = $_GET["q"];
    $modelo = new ModeloCliente();
    $modelo =  $modelo->conn->query("select * from cliente where cedula_cliente LIKE '%$filtro%' LIMIT 5");
    $data = $modelo->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
}

obtener_cliente();