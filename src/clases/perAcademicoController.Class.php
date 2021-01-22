<?php
    class perAcademico{
        function getDataPerAcademico(){
            $db=new Connect;
            $user=$db->prepare("SELECT * FROM personalacademico");
            $user->execute();
            $userinfo=$user->rowCount();
            return $userinfo;
        }
    function agregarPerAcademico($nombrePerAcademico,$apellidoPatPerAcademico,$apellidoMatPerAcademico,$academia,$RFC,$telefono,$extension,$emailPerAcademico,$numcodqr){
        $db=new Connect;
            $user=$db->prepare("INSERT INTO personalacademico(nombrePerAcademico,apellidoPatPerAcademico,apellidoMatPerAcademico,academia,RFC,telefono,extension,emailPerAcademico,numcodqr)
            VALUES(:nombrePerAcademico,:apellidoPatPerAcademico,:apellidoMatPerAcademico,:academia,:RFC,:telefono,:extension,:emailPerAcademico,:numcodqr)");

            $user->execute([
                ':nombrePerAcademico' => $nombrePerAcademico,
                ':apellidoPatPerAcademico' =>$apellidoPatPerAcademico,
                ':apellidoMatPerAcademico' =>$apellidoMatPerAcademico,
                ':academia'=> $academia,
                ':RFC' =>$RFC,
                ':telefono'=>$telefono,
                ':extension'=>$extension,
                ':emailPerAcademico'=>$emailPerAcademico,
                ':numcodqr'=>$numcodqr
                ]);
          return $user;    
      }

      function editarPerAcademico($id,$nombrePerAcademico,$apellidoPatPerAcademico,$apellidoMatPerAcademico,$academia,$RFC,$telefono,$extension,$emailPerAcademico,$numcodqr){
        $db=new Connect;
        $user=$db->prepare("UPDATE  personalacademico SET nombrePerAcademico=:nombre, apellidoPatPerAcademico=:apellidop, apellidoMatPerAcademico=:apellidom, academia=:carrera, RFC=:boleta, telefono=:telefonoM, extension=:telefonofijo, emailPerAcademico=:telefonop, numcodqr=:numcodqr WHERE id=:id");
        $user->execute([
            ':id'=>$id,
            ':nombre'=>$nombrePerAcademico,
            ':apellidop' =>$apellidoPatPerAcademico,
            ':apellidom'=>$apellidoMatPerAcademico,
            ':carrera'=>$academia,
            ':boleta'=>$RFC,
            ':telefonoM'=>$telefono,
            ':telefonofijo'=>$extension,
            ':telefonop'=>$emailPerAcademico,
            ':numcodqr'=>$numcodqr
        ]);
        return $user;
    }

      function deletePerAcademico($id){
        $db = new Connect;
        $user= $db->prepare("DELETE  FROM  personalacademico WHERE id=:id ");
        $user->execute([
            ':id'=>$id
        ]);
        //TODO: Como saber si se elimino correctamente el usuario. puedo hacer una busqueda de
        //lo que se borro si lo encentra mandar mensaje de no se pudo borrar por llave foranea.
        
        return $user;
    }

     //generar token
     function generarToken($tamaño){
        $char = "qwertywDns07";
        $code = "";
        $clean = strlen($char) -1;
        //$random_number = intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) );
        //$random_string = chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90));
        
        while(strlen($code) < $tamaño){
            //si se agrega al sistema aumentar rango.
            $code .= $char[rand(0,$clean)];
        }
        return "per-".$code;
    }
        function validarToken($token){
            $db=new Connect;
            $contqr=$db->prepare("SELECT * FROM personalacademico WHERE numcodqr=:codigo" );
            $contqr->execute([
                ':codigo'=>$token
            ]);
            $contador=$contqr->rowCount();
            if($contador>0){
                //Si existe el codigo qr
                return 1;
            }else{
                return 0;
            }
        }
        function addSaes3($nombre, $apellidop, $apellidom, $carrera, $boleta, $telefonom, $telefonof,  $email){
            $db = new Connect;
            $numcodqr=$this->generarToken(10);
            $validarCod=$this->validarToken($numcodqr);
            if($validarCod==1){
                return $this->addSaes3($nombre, $apellidop, $apellidom, $carrera, $boleta, $telefonom, $telefonof,  $email);
            }else{
                //Buscamos el usuario si existe ya en la BD.
                $buscarUser=$db->prepare("SELECT * FROM personalacademico WHERE RFC=:boleta");
                $buscarUser->execute([
                    ':boleta'=> $boleta
                ]);
                $userCount=$buscarUser->rowCount();
                if($userCount>0){
                    return 0;
                }else{
                    $user=$db->prepare("INSERT INTO personalacademico(nombrePerAcademico,apellidoPatPerAcademico,apellidoMatPerAcademico,academia,RFC,telefono,extension,emailPerAcademico,numcodqr)
                    VALUES(:nombrePerAcademico,:apellidoPatPerAcademico,:apellidoMatPerAcademico,:academia,:RFC,:telefono,:extension,:emailPerAcademico,:numcodqr)");
        
                    $user->execute([
                        ':nombrePerAcademico' => $nombre,
                        ':apellidoPatPerAcademico' =>$apellidop,
                        ':apellidoMatPerAcademico' =>$apellidom,
                        ':academia'=> $carrera,
                        ':RFC' =>$boleta,
                        ':telefono'=>$telefonom,
                        ':extension'=>$telefonof,
                        ':emailPerAcademico'=>$email,
                        ':numcodqr'=>$numcodqr
                        ]);
                  return $user;    
                }
                
                
            }
            
        }
    }
    
    

 ?>