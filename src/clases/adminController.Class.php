<?php
    
    class admin{
        function getDataAdmin(){
            $db = new Connect;
            $user = $db-> prepare("SELECT * FROM administradores");
            $user->execute();
            $userinfo = $user->rowCount();
            return  $userinfo;
        }
        function getAdmin(){
            $db = new Connect;
            $user= $db->prepare("SELECT * FROM administradores");
            $user->execute();
            return $user;
        }
        function actualizarAdmin($id,$name,$apellidoP,$apellidoM,$puesto,$areaAdministra,$tipo,$email,$clave,$preguntaS,$respuestaS){
            $db = new Connect;
            $user= $db->prepare("UPDATE administradores SET name=:name, ApellidoPAdm=:apellidoP, ApellidoMFAdm=:apellidoM, Puesto=:puesto, AreaAdm=:areaAdministra, Tipo=:tipo, email=:email, TrabajadorAdm=:clave, PreguntaS=:preguntaS, RespuestaS=:respuestaS WHERE id=:id");
            $user->execute([
                ':id'=>$id,
                ':name'=>$name,
                ':apellidoP'=>$apellidoP,
                ':apellidoM'=>$apellidoM,
                ':puesto'=>$puesto,
                ':areaAdministra'=>$areaAdministra,
                ':tipo'=>$tipo,
                ':email'=>$email,
                ':clave'=>$clave,
                ':preguntaS'=>$preguntaS,
                ':respuestaS'=>$respuestaS
                
            ]);
            return $user;
        }
        function deleteAdmin($id){
            $db = new Connect;
            $user= $db->prepare("DELETE  FROM  administradores WHERE id=:id ");
            $user->execute([
                ':id'=>$id
            ]);
            return $user;
        }
        function agregarAdmin($name,$apellidoP,$apellidoM,$puesto,$areaAdministra,$tipo,$email,$clave,$password,$preguntaS,$respuestaS){
            $db = new Connect;
            $contAdmin=$db->prepare("SELECT * FROM administradores WHERE email=:email" );
            $contAdmin->execute([
                ':email'=>$email
            ]);
            $contador=$contAdmin->rowCount();
            if ($contador>0) {
                # Si se encutra el email registrado ya regresa un mensaje de error
                # User ya registrado.
                return 1;
            }else{
                $pass_cifrada = password_hash($password, PASSWORD_DEFAULT, array("cost"=>10));
                $user=$db->prepare("INSERT INTO administradores (name, ApellidoPAdm, ApellidoMFAdm, Puesto, AreaAdm, Tipo, email, TrabajadorAdm, contraseña, PreguntaS,RespuestaS) VALUES (:name, :apellidoP, :apellidoM, :puesto, :areaAdministra, :tipo, :email, :clave, :password, :preguntaS, :respuestaS)");
                $user->execute([
                    ':name'=>$name,
                    ':apellidoP'=>$apellidoP,
                    ':apellidoM'=>$apellidoM,
                    ':puesto'=>$puesto,
                    ':areaAdministra'=>$areaAdministra,
                    ':tipo'=>$tipo,
                    ':email'=>$email,
                    ':clave'=>$clave,
                    ':password'=>$pass_cifrada,
                    ':preguntaS'=>$preguntaS,
                    ':respuestaS'=>$respuestaS
                ]);
                return 0;
            }
            
        }
    }

?>