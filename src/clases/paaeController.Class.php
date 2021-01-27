<?php
    class paae{
        function getDataPaae(){
            $db=new Connect;
            $user=$db->prepare("SELECT * FROM paaes");
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
        return "pae-".$code;
    }

    function validarToken($token){
        $db=new Connect;
        $contqr=$db->prepare("SELECT * FROM paaes WHERE numcodqr=:codigo" );
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


    function agregarPaae($nombrePaae,$apellidoPatPaae,$apellidoMatPaae,$area,$RFC,$telefono,$extension,$emailPaae){
        $db=new Connect;
       
        
        $contAdmin1=$db->prepare("SELECT * FROM paaes WHERE emailPaae=:email " );
            $contAdmin1->execute([
                ':email'=>$emailPaae
            ]);
            $contador1=$contAdmin1->rowCount();
            if($contador1>0){
                return 10;
            }else{
                $contAdmin=$db->prepare("SELECT * FROM paaes WHERE RFC=:email " );
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
                        $numcod=$this->generarToken(10);
                            $comprobarToken=$this->validarToken($numcod);
                        if($comprobarToken == 0){
                            //  no hay ninguno
                                $i=1;
                                break;
                        }
                        
                    } 
                            $user=$db->prepare("INSERT INTO paaes(nombrePaae,apellidoPatPaae,apellidoMatPaae,area,RFC,telefono,extension,emailPaae,numcodqr)
                            VALUES(:nombrePaae,:apellidoPatPaae,:apellidoMatPaae,:area,:RFC,:telefono,:extension,:emailPaae,:numcodqr)");

                            $user->execute([
                                ':nombrePaae' => $nombrePaae,
                                ':apellidoPatPaae' =>$apellidoPatPaae,
                                ':apellidoMatPaae' =>$apellidoMatPaae,
                                ':area'=> $area,
                                ':RFC' =>$RFC,
                                ':telefono'=>$telefono,
                                ':extension'=>$extension,
                                ':emailPaae'=>$emailPaae,
                                ':numcodqr'=>$numcod
                                ]);
                        return 0;  
                    }
                }  
      }

      function editarPaae($id,$nombrePaae,$apellidoPatPaae,$apellidoMatPaae,$area, $RFC, $telefono,$extension,$emailPaae){
        $db=new Connect;
        $contAdmin1=$db->prepare("SELECT * FROM paaes WHERE emailPaae=:email  and id not in (:id)" );
            $contAdmin1->execute([
                ':email'=>$emailPaae,
                ':id'=>$id
            ]);
            $contador1=$contAdmin1->rowCount();
            if($contador1>0){
                return 10;
            }else{
                $contAdmin=$db->prepare("SELECT * FROM paaes WHERE RFC=:email  and id not in (:id)" );
                $contAdmin->execute([
                    ':email'=>$RFC,
                    ':id' =>$id
                ]);
                $contador=$contAdmin->rowCount();
                if ($contador>0) {
                    # Si se encutra el email registrado ya regresa un mensaje de error
                    # User ya registrado.
                    return 1;
                }else{
        
                    $user=$db->prepare("UPDATE  paaes SET nombrePaae=:nombre, apellidoPatPaae=:apellidop, apellidoMatPaae=:apellidom, area=:carrera, RFC=:boleta, telefono=:telefonoM, extension=:telefonofijo, emailPaae=:telefonop WHERE id=:id");
                    $user->execute([
                        ':id'=>$id,
                        ':nombre'=>$nombrePaae,
                        ':apellidop' =>$apellidoPatPaae,
                        ':apellidom'=>$apellidoMatPaae,
                        ':carrera'=>$area,
                        ':boleta'=>$RFC,
                        ':telefonoM'=>$telefono,
                        ':telefonofijo'=>$extension,
                        ':telefonop'=>$emailPaae,
                    
                    ]);
                    return 0;
                }
            }
    }

      function deletePaae($id){
        $db = new Connect;
        $user= $db->prepare("DELETE  FROM  paaes WHERE id=:id ");
        $user->execute([
            ':id'=>$id
        ]);
        //TODO: Como saber si se elimino correctamente el usuario. puedo hacer una busqueda de
        //lo que se borro si lo encentra mandar mensaje de no se pudo borrar por llave foranea.
        
        return $user;
    }
        function addSaes2($nombre, $apellidop, $apellidom, $carrera, $boleta, $telefonom, $telefonof,  $email){
            $db = new Connect;
            $numcodqr=$this->generarToken(10);
            $validarCod=$this->validarToken($numcodqr);
            if($validarCod==1){
                return $this->addSaes2($nombre, $apellidop, $apellidom, $carrera, $boleta, $telefonom, $telefonof,  $email);
            }else{
                //Buscamos el usuario si existe ya en la BD.
                $buscarUser=$db->prepare("SELECT * FROM paaes WHERE RFC=:boleta");
                $buscarUser->execute([
                    ':boleta'=> $boleta
                ]);
                $userCount=$buscarUser->rowCount();
                if($userCount>0){
                    return 0;
                }else{
                    $user=$db->prepare("INSERT INTO paaes(nombrePaae,apellidoPatPaae,apellidoMatPaae,area,RFC,telefono,extension,emailPaae,numcodqr)
                    VALUES(:nombrePaae,:apellidoPatPaae,:apellidoMatPaae,:area,:RFC,:telefono,:extension,:emailPaae,:numcodqr)");

                    $user->execute([
                        ':nombrePaae' => $nombre,
                        ':apellidoPatPaae' =>$apellidop,
                        ':apellidoMatPaae' =>$apellidom,
                        ':area'=> $carrera,
                        ':RFC' =>$boleta,
                        ':telefono'=>$telefonom,
                        ':extension'=>$telefonof,
                        ':emailPaae'=>$email,
                        ':numcodqr'=>$numcodqr
                        ]);
                    return $user;    
                }
                
                
            }
            
        }
        function buscarQrpaae($codigoQr, $idAdmin, $hora){
            $db=new Connect;
            $contqro=$db->prepare("SELECT * FROM paaes WHERE numcodqr=:codigo" );
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
                    $retornar="||"."pae"."||".$userinfo['nombrePaae']."||".$hora."||"."1"."||";
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
                    $res2="||"."pae"."||".$userinfo['nombrePaae']."||".$hora."||"."2"."||";
                    return $res2;
                }
            }
            else{
                //Si no encontro el codigo qr
                return "||"."pae"."||"."No user"."||"."No hora"."||"."0"."||";
            }
        }
    }

 ?>