<?php
    
 
    class Model {

        # Propiedades contenedoras de los datos de la conexion
        private $driver;
        private $host;
        private $database;
        private $user;
        private $passwd;

        public $conn; # Almacena el objeto con la conexion a la base de datos
        public $table; # Guarda el nombre de la tabla
        
        # Carga las variables que contienen los datos de la conexion
        private function load_vars_db() { 
            include ROOT .  "/config/db.php";
         }

        # Crea el DSN para realizar la conexion
        private function get_dsn() { return "{$this->driver}:host={$this->host};dbname={$this->database}"; }

        # Crea la conexion con la base de datos y la guarda
        private function connection_create() {
            try {
                $connection = new PDO($this->get_dsn(), $this->user, $this->passwd); # Se crea
                return $connection;
            }
            catch (PDOException $e) {
                echo "" .$e->getMessage(); # Se muestra el mensaje de error
                exit(); # Mata la ejecucion de PHP
            }
        }

        # Metodo que se ejecuta al instanciar o heredar la clase
        public function __construct(){
            $this->load_vars_db(); # Carga las variables
            $this->conn = $this->connection_create(); # Crea y guarda la conexion a la base de datos
        }

        # Genera un sql de registro
        protected function create_insert_sql($array_data) {
            try {
                # Valida que se ha proporcionado un nombre de tabla, de no encontrarla dispara un error
                if ($this->table == '') { throw new Exception('Tabla no asignada'); }

                $fields = implode(',', array_keys($array_data)); # Toma las claves del arreglo como nombres de columnas
                $placeholders = implode(',', array_map(fn($key) => ":$key", array_keys($array_data))); # No hay nescesidad de explicar esto
        
                $sql = "INSERT INTO {$this->table} ($fields) VALUES ($placeholders)"; # Genera el SQL

                return $sql; # Devuelve el sql

            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();  // Manejo de excepciones
                exit(); # Mata la ejecucion del codigo
            }
        }

        # Metodo para crear o registrar elementos en base de datos
        function create($array_data){
            try {
                $db = $this->conn->prepare($this->create_insert_sql($array_data)); # Prepara el registro
                $db->execute($array_data); # Ejecuta y pasa los datos
            } catch (Exception $e) {
                echo json_encode(["tipo"=>"danger", "mensaje"=>$e->getMessage()]); // Manejo de excepciones
                exit(); # Mata la ejecucion del codigo
            }
        }

        # Obtiene toos los registros de una tabla
        function getAll(){
            $query = $this->conn->query("SELECT * FROM $this->table");
            $query = $query->fetchAll(PDO::FETCH_ASSOC);
            return $query;
        }

        /**Para prevenir la inyeccion SQL se utiliza prepare junto con el bind param */
        function getDetail($campo,$valor){
            $query = $this->conn->prepare("SELECT * FROM $this->table WHERE $campo=:valor"); # prepara la consulta
            $query->bindParam(':valor', $valor, PDO::PARAM_INT); # Pasa el parametro
            $query->execute(); # Ejecuta
            return $query->fetch(PDO::FETCH_ASSOC); # Devuelve el resutado
        }

        function get_page($registrosPorPagina,$offset,$filtro,$campo)
        {
            $sql = "SELECT * FROM $this->table WHERE $campo LIKE '%$filtro%' LIMIT :limit OFFSET :offset";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':limit', $registrosPorPagina, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
    
            $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $clientes;
        }
        function actualizarCliente($condicion, $datos,$campo) {
            try {
                $db = $this->conn->prepare($this->actualizar_sql($condicion, $datos,$campo)); # Prepara el registro
                $db->execute($datos); # Ejecuta y pasa los datos
            } catch (Exception $e) {
                echo json_encode(["tipo"=>"danger", "mensaje"=>$e->getMessage()]);
                 // Manejo de excepciones
                exit(); # Mata la ejecucion del codigo
            }
        }
        
        function actualizar_sql($condicion, $datos,$campo){
            try {
                # Valida que se ha proporcionado un nombre de tabla, de no encontrarla dispara un error
                if ($this->table == '') {
                    throw new Exception('Tabla no asignada');
                }
            
                # Asegúrate de que el arreglo de datos no esté vacío
                if (empty($datos)) {
                    throw new Exception('No hay datos para actualizar');
                }
            
                # Construye el SQL dinámicamente
                $set_clause = implode(',', array_map(fn($key) => "$key = :$key", array_keys($datos))); # Genera la cláusula SET
                $sql = "UPDATE {$this->table} SET $set_clause WHERE $campo = $condicion";  # Genera el SQL con la condición WHERE
            
                return $sql;  # Devuelve el SQL
            
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();  # Manejo de excepciones
                exit();  # Mata la ejecución del código
            }
               
        }
        function get_count($campo=null,$filtro=null)
        {
            if(!empty($campo)) $sql = "SELECT COUNT(*) FROM $this->table WHERE $campo LIKE '%$filtro%'";
            else $sql = "SELECT COUNT(*) FROM $this->table";
            $stmt = $this->conn->query($sql);
            $totalRegistros = $stmt->fetchColumn();
            return $totalRegistros;
        }

        function eliminarRegistro($id,$campo) {
            try {
                // Preparar la consulta SQL
                $consulta = $this->conn->prepare("DELETE FROM $this->table WHERE $campo = :id");
                
                // Asignar el valor al parámetro
                $consulta->bindParam(':id', $id, PDO::PARAM_INT);
                
                // Ejecutar la consulta
                $consulta->execute();
                return $consulta;
                
                // Verificar si se eliminó alguna fila
                
            } catch (PDOException $e) {
                echo "Error al eliminar el registro: " . $e->getMessage();
            }
        }
}
