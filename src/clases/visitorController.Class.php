<?php 

    //PHP Data Objects
    class visitor {
       //get data visitor
        function getVisitorData(){
            $db = new Connect;
            $user = $db-> prepare("SELECT * FROM visitantes");
            $user->execute();
            $userinfo = $user->rowCount();
            return  $userinfo;
        }
        function getVisitorActive(){
            $db = new Connect;
            $user = $db-> prepare("SELECT * FROM visitantes WHERE estado=1");
            $user->execute();
            $userinfo = $user->rowCount();
            return  $userinfo;
        }
        function deathVisitor(){
           
            $db = new Connect;
            $user = $db-> prepare("UPDATE visitantes SET estado= 0 WHERE estado=1");
            $user->execute();
            $userinfo= $user->fetch(PDO::FETCH_ASSOC);
            return $userinfo;
         
            
        }



        //Imprimir resultados
        function imprimir_resultados($id){
            $db = new Connect;
            $user = $db-> prepare("SELECT * FROM visitantes WHERE id=:id");
            $user->execute([
                ':id' =>intval($id)
            ]);
            $userinfo = $user->fetch(PDO::FETCH_ASSOC);
            return  $userinfo["nombre"]. " ". $userinfo["apellidop"]." ".$userinfo["apellidom"];
        }
        //Checamos que el usuario este dentro.
        function user_activo($id){
            //me conecto a la BD
            $db = new Connect;
            $user = $db-> prepare("SELECT id FROM visitantes WHERE id=:id");
            $user->execute([
                ':id' =>intval($id)
            ]);
            $userinfo= $user->fetch(PDO::FETCH_ASSOC);
            if (!$userinfo) {
                return FALSE;
            }else{
                return TRUE;
            }
        }
        //gemerar token
        function generar_token($tamaño){
            $char = "qwertywDns07";
            $code = "";
            $clean = strlen($char) -1;
            //$random_number = intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) );
            //$random_string = chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90));
            
            while(strlen($code) < $tamaño){
                //si se agrega al sistema aumentar rango.
                $code .= $char[rand(0,$clean)];
            }
            return $code;
        }      
    }
?>