<?php

if (!defined("ROOT")) {
    include "./app/config/config.php";
  }
   require './app/models/modeloLogin.php';
   require './app/models/modeloLogs.php';
   


    
    class Autenticacion {
        private $usuario = null;
        private $password = null;
        public function login(){
            //var_dump($_GET);
            //verifica si los campos no estan vacios
            if(isset($_POST['usuario']) && isset($_POST['password'])){
                $this->usuario = $_POST['usuario'];
                $this->password = $_POST['password'];
                //se instancia con el modelo
                $conexion = new ModeloLogin();
                //llamo al metodo para optener usuario
                $datosUsuario = $conexion->selectUser($this->usuario);
                //verifica si existe un usuario con ese nombre
                if($datosUsuario->rowCount() == 1){
                    //se convierte en una array asociativo
                    $datosUsuario = $datosUsuario->fetch();
                    $passwordModel = $datosUsuario['contrasena'];
                    //verifica que la contraseña sea la misma que en la base de datos
                    if(password_verify($this->password, $passwordModel)){
                        if(isset($_SESSION['error'])){
                            //si existe la variable error la borra
                           unset($_SESSION['error']);

                        }
                        //se crean las variables para los datos del usuario
                        $log = new ModeloLogs();
                        $log->logUserAccion($datosUsuario["id"], 'login', 'El usuario inició sesión.');
                        $_SESSION['user'] = $datosUsuario;
                       

                        //redirige al home
                        header('Location: ./app/home.php');
                    }else{
                        
                        $_SESSION['error'] = 'contraseña incorrecta';
                        header('Location: ./index.php');
                    }
                }else{
                    $_SESSION['error'] = 'usuario incorrecto';
                    header('Location: ./index.php');
                }
                

                
                
            }

        }
    }
    //se instancian las clases
    $autenticacion = new Autenticacion();
    $autenticacion->login();

?>