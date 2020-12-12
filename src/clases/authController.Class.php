<?php
    //Obtenemos los datos de la DB
    //include('pdoConfig.php');
    
    //Create connection
    class Connect extends PDO{
        //Conexion a la base de datos
        public function __construct(){
            parent::__construct("mysql:host=localhost;dbname=autenticaciónca",'root', '',
            array(PDO::MYSQL_ATTR_INIT_COMMAND=> "SET NAMES utf8"));
        }
    }
    class auth{
        function addUser($usuario,$password){
            //TODO: Encriptar
            $db = new Connect;
            $user = $db->prepare("SELECT * FROM administradores where email=:email and contraseña=:pasword");
            $user->execute([
                ':email' =>$usuario,
                ':pasword'=> $password
            ]);
            $userinfo= $user->rowCount();
            return $userinfo;
        }
        function lifeSession($time, $location){
            //Tiempo en segundos para dar vida a la sesión.
            $inactivo = 120;//2 min en este caso.

            //Calculamos tiempo de vida inactivo.
            $vida_session = time() - $time;
            if($vida_session > $inactivo)
            {
                //Removemos sesión.
                session_unset();
                //Destruimos sesión.
                session_destroy();              
                //Redirigimos pagina.
                header("Location: $location");
                exit();
            } else {  // si no ha caducado la sesion, actualizamos
                $time = time();
            }
        }
        function userInfo($usuario, $password){
            $db = new Connect;
            $user = $db->prepare("SELECT * FROM administradores where email=:email and contraseña=:pasword");
            $user->execute([
                ':email' =>$usuario,
                ':pasword'=> $password
            ]);
            $userinfo= $user->fetch(PDO::FETCH_ASSOC);
            return $userinfo;
        }
    }


?>