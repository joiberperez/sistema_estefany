<?php
if(!defined("ROOT")){
    include "../config/config.php";

}
include ROOT . "/models/modeloCliente.php";
include ROOT . "/config/clase.php";
class CrearCliente extends BaseClase{

   

    public function listar_cliente(){
        $id_cliente = $_GET["id"];
        $modelo = new ModeloCliente();
        $cliente = $modelo->getDetail("id_cliente",$id_cliente);
        return $cliente;
        
    }
    public function crearCliente(){
        try{

            $modelo = new ModeloCliente();
            
            
            $nombre_cliente = $this->parsearCadena($_POST["nombre_cliente"]);
            $apellido_cliente = $this->parsearCadena($_POST["apellido_cliente"]);
            $cedula_cliente = $this->parsearCadena($_POST["cedula_cliente"]);
            $telefono_cliente = $this->parsearCadena($_POST["telefono_cliente"]);
            $datos = [
                "nombre_cliente"=>$nombre_cliente,
                "apellido_cliente"=>$apellido_cliente,
                "cedula_cliente"=>$cedula_cliente,
                "telefono_cliente"=>$telefono_cliente,
                
            ];
            $modelo->create($datos);
            
            header("Location: /sistema_estefany/app/cliente/cliente.php");
        }catch(Exception $error){
            echo "ha ocurrido un error: ". $error;

        }
        
    }
}

$crearCliente = new CrearCliente();

if($_SERVER["REQUEST_METHOD"]==="POST"){
    
    $crearCliente->crearCliente();
   // $cliente = $actualizarCliente->listar_cliente();
}



?>
        <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Registrar Cliente</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <form action="/sistema_estefany/app/cliente/crear_cliente.php" id="registrar_cliente" method="post">

                              
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-lg-6 mb-3">
                                    <label for="nameBasic" class="form-label">Nombre</label>
                                    <input type="text" id="nameBasic" name="nombre_cliente" class="form-control" placeholder="Enter Name" />
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="nameBasic" class="form-label">Apellido</label>
                                    <input type="text" id="nameBasic" name="apellido_cliente" class="form-control" placeholder="Enter Name" />
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="nameBasic" class="form-label">Cedula</label>
                                    <input type="text" id="nameBasic" name="cedula_cliente" class="form-control" placeholder="Enter Name" />
                                  </div>
                                  <div class="col-lg-6 mb-3">
                                    <label for="nameBasic" class="form-label">Telefono</label>
                                    <input type="text" id="nameBasic" name="telefono_cliente" class="form-control" placeholder="Enter Name" />
                                  </div>
                                </div>
                               
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary">Registrar</button>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>


<script>
        // Función para evitar que se ingresen números en el campo de texto
        function evitarNumeros(event) {
            var charCode = event.which || event.keyCode;
            // Permitir solo letras (mayúsculas y minúsculas) y teclas de control como retroceso
            if ((charCode >= 48 && charCode <= 57)) {
                event.preventDefault(); // Evitar que se escriban números
            }
        }
        function permitirSoloNumeros(event) {
            var charCode = event.which || event.keyCode;

            // Permitir solo números (teclas con código entre 48 y 57), backspace (8), y delete (46)
            if ((charCode < 48 || charCode > 57) && charCode !== 8 && charCode !== 46) {
                event.preventDefault(); // Cancelar la entrada si no es un número
            }
        }
        $("#registrar_cliente").submit(function(e){

e.preventDefault();
let data = new FormData(this);
console.log("hola")
/*     $.get("/sistema_estefany/app/cliente/crear_cliente.php").done(function(data) {
    $("#modal-container").html(data);
    $(".modal").modal("show");
}) */

})
    </script>