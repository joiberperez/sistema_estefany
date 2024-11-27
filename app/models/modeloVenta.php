<?php


if (!class_exists('Model')) {
    include ROOT . "/models/base.php";
    
}


class ModeloVenta extends Model
{

    public $table = "venta";

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
 

    function get_page($registrosPorPagina, $offset, $filtro, $campo)
{
    // Preparar la declaración SQL para recuperar registros con JOINs
    if($campo === "fecha_venta"){
        
        $sql = "
            SELECT 
                v.*, 
                c.nombre_cliente AS cliente_nombre,
                
            FROM 
                venta v
            LEFT JOIN 
                cliente c ON v.cliente_id = c.id_cliente
            
            WHERE 
                v.$campo BETWEEN :inicio AND :final
            LIMIT 
                :limit OFFSET :offset";
        
                $stmt = $this->conn->prepare($sql);

                // Vincular parámetros
                $likeFiltro = "%$filtro%";
                $stmt->bindParam(':inicio', $$filtro["inicio"], PDO::PARAM_STR);
                $stmt->bindParam(':final', $$filtro["final"], PDO::PARAM_STR);
                $stmt->bindParam(':limit', $registrosPorPagina, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                
                // Ejecutar y obtener resultados
                $stmt->execute();
    }else{
        
        $sql = "
        SELECT 
            venta.*, 
            cliente.cedula_cliente AS cliente_cedula, mp.nombre as metodo_pago_nombre
            
        FROM 
            venta 
        LEFT JOIN 
            cliente ON venta.cliente_id = cliente.id_cliente
        LEFT JOIN 
            metodo_pago mp ON venta.metodo_pago_id = mp.id
        
        WHERE 
            venta.$campo LIKE :filtro
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
    }
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $clientes;
}
function get_count($campo=null,$filtro=null)
{
    if(!empty($campo)){
        
        if($campo === "fecha_venta"){
        $rango_inicio = $filtro["inicio"];
        $rango_final = $filtro["final"];
        $sql = "SELECT COUNT(*) AS total
            FROM 
            venta v
        LEFT JOIN 
            cliente c ON v.cliente_id = c.id_cliente
        WHERE 
            v.$campo BETWEEN $rango_inicio AND $rango_final";
    
        }else{
        $sql = "SELECT COUNT(*) AS total
            FROM 
            venta v
        LEFT JOIN 
            cliente c ON v.cliente_id = c.id_cliente
        LEFT JOIN 
            metodo_pago mp ON v.metodo_pago_id = mp.id
        WHERE 
            v.$campo LIKE '%$filtro%'";

        }
    }else $sql = "SELECT COUNT(*) FROM $this->table";
    $stmt = $this->conn->query($sql);
    $totalRegistros = $stmt->fetchColumn();
    return $totalRegistros;
}


}
class ModeloDetalleVenta extends Model{
    public $table = "venta_producto";
}