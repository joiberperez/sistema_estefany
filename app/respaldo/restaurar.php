<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_estefany";

// Crear conexión PDO
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// Verificar si se ha subido un archivo
if (isset($_FILES['archivo_sql']) && $_FILES['archivo_sql']['error'] == UPLOAD_ERR_OK) {
    // Obtener el archivo subido
    $archivo_sql = $_FILES['archivo_sql']['tmp_name'];
    
    // Leer el contenido del archivo SQL
    $sql = file_get_contents($archivo_sql);


    // Ejecutar el SQL
    try {
        $pdo->exec($sql);
        echo json_encode(["tipo"=>"success","mensaje"=>"Base de datos restaurada correctamente"]);
    } catch(PDOException $e) {
        echo "Error al restaurar la base de datos: " . $e->getMessage();
    }
} else {
    echo json_encode(["tipo"=>"danger","mensaje"=>"Error al subir el archivo"]);
    
}