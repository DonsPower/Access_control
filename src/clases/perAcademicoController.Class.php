<?php
    class perAcademico{
        function getDataPerAcademico(){
            $db=new Connect;
            $user=$db->prepare("SELECT * FROM personalacademico");
            $user->execute();
            $userinfo=$user->rowCount();
            return $userinfo;
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
        return "pro-".$code;
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

    function agregarPerAcademico($nombrePerAcademico,$apellidoPatPerAcademico,$apellidoMatPerAcademico,$academia,$RFC,$telefono,$extension,$emailPerAcademico){
        $db = new Connect;
        
        $contAdmin1=$db->prepare("SELECT * FROM personalacademico WHERE emailPerAcademico=:email " );
            $contAdmin1->execute([
                ':email'=>$emailPerAcademico
            ]);
            $contador1=$contAdmin1->rowCount();
            if($contador1>0){
                return 10;
            }else{
                $contAdmin=$db->prepare("SELECT * FROM personalacademico WHERE RFC=:email " );
                $contAdmin->execute([
                    ':email'=>$RFC,
                    
                ]);
                $contador=$contAdmin->rowCount();
                if ($contador>0) {
                    # Si se encutra el email registrado ya regresa un mensaje de error
                    # User ya registrado.
                    return 1;
                }else{

                        $i=0;
                        while ($i==0){
                            $numcodqr=$this->generarToken(10);
                            $comprobarToken=$this->validarToken($numcodqr);
                            if($comprobarToken == 0){
                                //no hay ninguno
                                $i=1;
                                break;
                            }
                        
                        } 
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
                    return 0;    
                        }
                    }
            
      }

      function editarPerAcademico($id,$nombrePerAcademico,$apellidoPatPerAcademico,$apellidoMatPerAcademico,$academia,$RFC,$telefono,$extension,$emailPerAcademico){
        $db = new Connect;
        $contAdmin1=$db->prepare("SELECT * FROM personalacademico WHERE emailPerAcademico=:email " );
            $contAdmin1->execute([
                ':email'=>$emailPerAcademico
            ]);
            $contador1=$contAdmin1->rowCount();
            if($contador1>0){
                return 10;
            }else{
                $contAdmin=$db->prepare("SELECT * FROM personalacademico WHERE RFC=:email " );
                $contAdmin->execute([
                    ':email'=>$RFC,
                    
                ]);
                $contador=$contAdmin->rowCount();
                if ($contador>0) {
                    # Si se encutra el email registrado ya regresa un mensaje de error
                    # User ya registrado.
                    return 1;
                }else{
                    $user=$db->prepare("UPDATE  personalacademico SET nombrePerAcademico=:nombre, apellidoPatPerAcademico=:apellidop, apellidoMatPerAcademico=:apellidom, academia=:carrera, RFC=:boleta, telefono=:telefonoM, extension=:telefonofijo, emailPerAcademico=:telefonop WHERE id=:id");
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
                        
                    ]);
                    return 0;
                }
            }
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
        function buscarQrProf($codigoQr, $idAdmin, $hora){
            $db=new Connect;
            $contqro=$db->prepare("SELECT * FROM personalacademico WHERE numcodqr=:codigo" );
            $contqro->execute([
                ':codigo'=>$codigoQr
            ]);
            $userinfo = $contqro->fetch(PDO::FETCH_ASSOC);
            
            if($userinfo){
                //Obtengo el id del visitante.
                $idVis=$userinfo['id'];
                //Como saber cuando entro y salio. con un ID 
                //Primero buscamos si no existe ningun registro en la BD.
                $buscarRegistro=$db->prepare("SELECT * FROM registro WHERE numcodqr=:idVis AND id_administrador=:idAdmin AND estado=:estado");
                $buscarRegistro->execute([
                    ':idVis'=>$codigoQr,
                    ':idAdmin'=>$idAdmin,
                    ':estado' => "1"
                ]);
                $res=$buscarRegistro->fetch(PDO::FETCH_ASSOC);
                //SI $res>1 entonces si hay un registro y buscar en que estado esta el campo 'ESTADO'
                if($res){
                    //Buscar si es 0 o 1 el campo 'ESTADO'
                    //1 es igual a la entrada. cero es la salida
                    $checarEstado=$db->prepare("UPDATE registro SET estado=0 WHERE numcodqr=:idVis AND id_administrador=:idAdmin AND estado=1");
                    $checarEstado->execute([
                        'idVis'=>$codigoQr,
                        'idAdmin'=>$idAdmin
                    ]);
                    $retornar="||"."pro"."||".$userinfo['nombrePerAcademico']."||".$hora."||"."1"."||";
                    return $retornar;
                }else{
                    //Activamos el estado del codigo QR y activamos la entrada al area del registro
                    $user=$db->prepare("INSERT INTO  registro (numcodqr, id_administrador, entrada, estado) VALUES (:idVis, :idAdmin, :entrada, :estado)");
                    $user->execute([
                        ':idVis'=>$codigoQr,
                        ':idAdmin'=>$idAdmin,
                        ':entrada'=>$hora,
                        ':estado'=>"1" 
                    ]);
                    // $userActive=$db->prepare("UPDATE visitantes SET estado= 1 WHERE id=:id");
                    // $userActive->execute([
                    //     ':id'=>$idVis
                    // ]);
                    $res2="||"."pro"."||".$userinfo['nombrePerAcademico']."||".$hora."||"."2"."||";
                    return $res2;
                }
            }
            else{
                //Si no encontro el codigo qr
                return "||"."pro"."||"."No user"."||"."No hora"."||"."0"."||";
            }
        }
    }
    
    

 ?>