<?php


if (!class_exists('Model')) {
    include ROOT . "/models/base.php";
    
}


class ModeloProducto extends Model
{

    public $table = "producto";

    function create($array_data){
        try {
            $db = $this->conn->prepare($this->create_insert_sql($array_data)); # Prepara el registro
            $db->execute($array_data); # Ejecuta y pasa los datos
            $id = $this->conn->lastInsertId();
            return $id;
        } catch (Exception $e) {
            echo json_encode(["tipo"=>"danger", "mensaje"=>$e->getMessage()]); // Manejo de excepciones
            exit(); # Mata la ejecucion del codigo
        }
    }
 
    function get_data_filter($campo1,$campo2,$filtro){
        $sql = "
        SELECT 
            p.*, 
            c.nombre AS categoria_nombre, 
            i.cantidad_disponible AS cantidad
        FROM 
            producto p
        LEFT JOIN 
            categoria c ON p.categoria_id = c.id
        LEFT JOIN 
            inventario i ON p.id = i.producto_id
        WHERE 
            p.$campo1 LIKE :filtro
        OR 
            p.$campo2 LiKE :filtro

        LIMIT 5";

    $stmt = $this->conn->prepare($sql);

    // Vincular parámetros
    $likeFiltro = "%$filtro%";
    $stmt->bindParam(':filtro', $likeFiltro, PDO::PARAM_STR);
    
    
    // Ejecutar y obtener resultados
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $data;
    }

    function get_page($registrosPorPagina, $offset, $filtro, $campo)
{
    // Preparar la declaración SQL para recuperar registros con JOINs
    $sql = "
        SELECT 
            p.*, 
            c.nombre AS categoria_nombre, 
            i.cantidad_disponible AS cantidad
        FROM 
            producto p
        LEFT JOIN 
            categoria c ON p.categoria_id = c.id
        LEFT JOIN 
            inventario i ON p.id = i.producto_id
        WHERE 
            p.$campo LIKE :filtro
        LIMIT 
            :limit OFFSET :offset";

    $stmt = $this->conn->prepare($sql);

    // Vincular parámetros
    $likeFiltro = "%$filtro%";
    $stmt->bindParam(':filtro', $likeFiltro, PDO::PARAM_STR);
    $stmt->bindParam(':limit', $registrosPorPagina, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    
    // Ejecutar y obtener resultados
    $stmt->execute();
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $clientes;
}
function get_count($campo=null,$filtro=null)
{
    if(!empty($campo)) $sql = "SELECT COUNT(*) AS total
            FROM producto p
        LEFT JOIN 
            categoria c ON p.categoria_id = c.id
        LEFT JOIN 
            inventario i ON p.id = i.producto_id
        WHERE 
            p.$campo LIKE '%$filtro%'";
    else $sql = "SELECT COUNT(*) FROM $this->table";
    $stmt = $this->conn->query($sql);
    $totalRegistros = $stmt->fetchColumn();
    return $totalRegistros;
}


}

