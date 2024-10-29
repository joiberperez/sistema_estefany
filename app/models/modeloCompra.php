<?php

if (!class_exists('Model')) {
    include ROOT . "/models/base.php";
    
}



class ModeloCompra extends Model
{
    public $table = "compra_producto";

    function get_page($registrosPorPagina, $offset, $filtro, $campo)
    {
        // Validar campo
        $camposPermitidos = ['id', 'fecha_compra']; // Cambia según tus campos válidos
        if (!in_array($campo, $camposPermitidos)) {
            throw new Exception("Campo no válido.");
        }
    
        // Preparar la declaración SQL para recuperar registros con JOINs
        $sql = "
            SELECT 
                cp.*, 
                p.nombre AS nombre_producto, 
                pr.nombre AS nombre_proveedor
            FROM 
                compra_producto cp
            LEFT JOIN 
                producto p ON cp.producto_id = p.id
            LEFT JOIN 
                proveedor pr ON cp.proveedor_id = pr.id
            WHERE 
                cp.$campo LIKE :filtro
            LIMIT 
                :limit OFFSET :offset";
    
        $stmt = $this->conn->prepare($sql);
    
        // Vincular parámetros
        $likeFiltro = "%$filtro%";
        $stmt->bindParam(':filtro', $likeFiltro, PDO::PARAM_STR);
        $stmt->bindParam(':limit', $registrosPorPagina, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        
        // Ejecutar y manejar errores
        if (!$stmt->execute()) {
            throw new Exception("Error en la consulta: " . implode(", ", $stmt->errorInfo()));
        }
    
        // Obtener resultados
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    function get_count($campo = null, $filtro = null)
    {
        // Si se proporciona un campo y un filtro
        if (!empty($campo) && !empty($filtro)) {
            // Validar el campo para evitar inyecciones SQL
            $camposPermitidos = ['cantidad', 'fecha_compra']; // Actualiza con tus campos válidos
            if (!in_array($campo, $camposPermitidos)) {
                throw new Exception("Campo no válido.");
            }
    
            // Preparar la consulta SQL
            $sql = "SELECT COUNT(*) AS total
                    FROM compra_producto cp
                    LEFT JOIN producto p ON cp.producto_id = p.id
                    LEFT JOIN proveedor pr ON cp.proveedor_id = pr.id
                    WHERE cp.$campo LIKE :filtro";
    
            $stmt = $this->conn->prepare($sql);
            $likeFiltro = "%$filtro%";
            $stmt->bindParam(':filtro', $likeFiltro, PDO::PARAM_STR);
        } else {
            // Consulta para contar todos los registros
            $sql = "SELECT COUNT(*) FROM compra_producto";
            $stmt = $this->conn->query($sql);
        }
    
        // Ejecutar la consulta
        $stmt->execute();
        $totalRegistros = $stmt->fetchColumn();
        
        return $totalRegistros;
    }
}
