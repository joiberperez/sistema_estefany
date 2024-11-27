<?php

$host = 'localhost'; 
$user = 'root'; 
$pass = ''; 
$dbname = 'sistema_estefany';

try {
    // Conexión con PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener los años únicos
    $sql = "SELECT DISTINCT YEAR(fecha_venta) AS año FROM venta ORDER BY año DESC";
    $stmt = $conn->query($sql);

    // Recuperar los años como un array simple
    $años = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $años[] = $row['año'];
    }

    // Devolver los años en formato JSON
    echo json_encode($años);

} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}


?>