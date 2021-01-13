<?php
 
    class auth{
        //Verificamos si existe el usuario o no?
        function addUser($usuario,$password){
            $password= strtolower($password);
            $db = new Connect;
            $pass_cifrada = password_hash($password, PASSWORD_DEFAULT, array("cost"=>10));
            $user = $db->prepare("SELECT * FROM administradores where email=:email");
            $user->execute([
                ':email' =>$usuario
            ]);
            $userinfo= $user->fetch(PDO::FETCH_ASSOC);
            if(empty($userinfo['email'])){
                return 2;
            }else{
                $pass=$userinfo['contraseña'];
                if(password_verify($password,$pass)){
                    return 1;
                }
                
            }

        }
        function lifeSession($time, $location){
            //Tiempo en segundos para dar vida a la sesión.
            $inactivo = 1200;//20 min en este caso.

            //Calculamos tiempo de vida inactivo.
            $vida_session = time() - $time;
            if($vida_session > $inactivo)
            {
                //Removemos sesión.
                session_unset();
                //Destruimos sesión.
                session_destroy();              
                //Redirigimos pagina.
                header("Location: ".$location);
                //header("Refresh: 0; url=index.php");
                //header('Refresh: '.$location);
                exit();
            } else {  // si no ha caducado la sesion, actualizamos
                $time = time();
            }
        }
        function userInfo($usuario){
            $db = new Connect;
            $user = $db->prepare("SELECT * FROM administradores where email=:email ");
            $user->execute([
                ':email' =>$usuario,
                
            ]);
            $userinfo= $user->fetch(PDO::FETCH_ASSOC);
            return $userinfo;
        }
    }


?>