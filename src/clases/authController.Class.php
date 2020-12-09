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
            $db = new Connect;
            $user = $db->prepare("SELECT * FROM administradores where email=:email and contraseña=:pasword");
            $user->execute([
                ':email' =>$usuario,
                ':pasword'=> $password
            ]);
            $userinfo= $user->rowCount();
            return $userinfo;
        }
    }

?>