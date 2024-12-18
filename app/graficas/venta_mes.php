<?php
// Establece la conexión con la base de datos (ajusta los valores según tu configuración)
$host = 'localhost'; 
$user = 'root'; 
$pass = ''; 
$dbname = 'sistema_estefany';

try {
    // Establecer conexión con PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener el año enviado por AJAX
    $year = isset($_GET['year']) ? $_GET['year'] : date("Y");

    // Consulta SQL para obtener ventas por mes del año específico
    $sql = "
        SELECT
            MONTH(fecha_venta) AS mes,
            COUNT(*) AS cantidad_ventas
        FROM venta
        WHERE YEAR(fecha_venta) = :year
        GROUP BY MONTH(fecha_venta)
        ORDER BY mes ASC
    ";

    // Preparar la consulta
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':year', $year, PDO::PARAM_INT);
    $stmt->execute();

    // Inicializamos un array para las ventas de cada mes (en caso de que no haya ventas en algunos meses)
    $ventas_por_mes = array_fill(0, 12, 0); // Array de 12 elementos, todos con valor 0

    // Rellenamos el array con los datos obtenidos
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $ventas_por_mes[$row['mes'] - 1] = $row['cantidad_ventas']; // Usamos índices del 0 al 11
    }

    // Mostrar los resultados como una tabla
    

  
    echo json_encode($ventas_por_mes);

} catch (PDOException $e) {
    die("Conexión fallida: " . $e->getMessage());
}
