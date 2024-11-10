
<?php
$host = 'localhost';
$user = 'jr';
$password = 'jr12345';
$database = 'sistema_estefany';

$backup_file = 'respaldo_' . date('Y-m-d_H-i-s') . '.sql';

// Comando de mysqldump
$command = "mysqldump -u=$user -p=$password $database > $backup_file";

// Ejecuta el comando
exec($command, $output, $return_var);

if ($return_var === 0) {
    echo "Respaldo creado con éxito: $backup_file";
} else {
    echo "Error al crear el respaldo.";
}


?>