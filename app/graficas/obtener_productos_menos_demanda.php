<?php
$host = 'localhost'; 
$user = 'root'; 
$pass = ''; 
$dbname = 'sistema_estefany';

try {
    // Conexión con PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener los 10 productos más vendidos
    $sql = " SELECT p.nombre AS producto, SUM(vp.cantidad) AS total_vendido FROM venta_producto vp JOIN producto p ON vp.producto_id = p.id GROUP BY vp.producto_id ORDER BY total_vendido ASC LIMIT 10";
    $stmt = $conn->query($sql);

    // Obtener los resultados
    $productos = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $productos[] = $row; // Agregar cada fila al array
    }

    // Devolver los resultados como JSON
    echo json_encode($productos);

} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
?>