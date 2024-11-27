<?php include "../config/config.php"  ?>


<?php include ROOT . "/plantillas/scripts.php"  ?>
<?php

class RespaldoCrear
{

    public function respaldar()
    {

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "sistema_estefany";

        try {
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Obtener todas las tablas
            $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);

            // Mover detalle_venta y compra al final
            $tables = array_diff($tables, ['inventario', 'venta_producto', 'compra_producto']);
            $tables = array_merge($tables, ['inventario', 'venta_producto', 'compra_producto']);

            $output = '';

            // Eliminar restricciones de clave extranjera solo si las tablas existen
            foreach ($tables as $table) {
                $foreignKeys = $pdo->query("SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_NAME = '$table' AND CONSTRAINT_SCHEMA = '$dbname' AND REFERENCED_TABLE_NAME IS NOT NULL")->fetchAll(PDO::FETCH_COLUMN);
                foreach ($foreignKeys as $fk) {
                    $output .= "ALTER TABLE `$table` DROP FOREIGN KEY `$fk`;\n";
                }
            }

            // Eliminar las tablas solo si existen
            foreach ($tables as $table) {
                $output .= "DROP TABLE IF EXISTS `$table`;\n";
            }

            // Crear las tablas y agregar datos
            foreach ($tables as $table) {
                $table_create = $pdo->query("SHOW CREATE TABLE $table")->fetch();
                if ($table_create) {
                    $output .= $table_create['Create Table'] . ";\n\n";

                    $result = $pdo->query("SELECT * FROM $table");
                    $num_fields = $result->columnCount();

                    foreach ($result as $row) {
                        $output .= "INSERT INTO $table VALUES(";
                        $temp_array = [];
                        for ($i = 0; $i < $num_fields; $i++) {
                            $temp_array[] = $pdo->quote($row[$i]);
                        }
                        $output .= implode(',', $temp_array);
                        $output .= ");\n";
                    }
                    $output .= "\n\n";
                }
            }

            // Crear directorio para el respaldo si no existe
            // Obtener la ruta del directorio de documentos del usuario actual
            $backupDir = getenv('USERPROFILE') . '\Documents\respaldo/';

            // Verificar si el directorio de respaldo existe, si no, crearlo
            if (!is_dir($backupDir)) {
                mkdir($backupDir, 0777, true);
            }

            $file_name = $backupDir . $dbname . '_' . date('Y-m-d') . '.sql';
            file_put_contents($file_name, $output);
            echo  ' <script>Swal.fire({
                title: "En hora buena",
                text: "Se ha hecho el respaldo exitosamente",
                icon: "success",
                showConfirmButton: true,
                confirmButtonText: "ok",
                
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href="./respaldo.php";
                   
                }
            });</script>';
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $pdo = null;

        // Estilo para el fondo oscuro y el temporizador

        exit;
    }
}

$respaldo = new RespaldoCrear();
$respaldo->respaldar();
