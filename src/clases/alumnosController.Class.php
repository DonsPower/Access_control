<?php
    class alumno{

        function getDataAlumno(){
            $db=new Connect;
            $user=$db->prepare("SELECT * FROM alumnos");
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
            return "alu-".$code;
        }

        function validarToken($token){
            $db=new Connect;
            $contqr=$db->prepare("SELECT * FROM alumnos WHERE numcodqr=:codigo" );
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

        
        function agregarAlum($nombreAlumno,$apellidoPatAlumno,$apellidoMatAlumno, $carrera, $boleta,$telefonoMovil,$telefonoFijo,$telefonoPersonal, $emailAlumno, $NSS,$numcodqr){
            $db=new Connect;
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
                $user=$db->prepare("INSERT INTO alumnos(nombreAlumno, apellidoPatAlumno, apellidoMatAlumno, carrera, boleta, telefonoMovil, telefonoFijo, telefonoPersonal, emailAlumno, NSS, numcodqr) VALUES ( :nombre, :apellidop, :apellidom, :carrera, :boleta, :telefonoM, :telefonofijo, :telefonop, :email, :nss,:numcodqr)");
                $user->execute([
                    ':nombre'=>$nombreAlumno,
                    ':apellidop' =>$apellidoPatAlumno,
                    ':apellidom'=>$apellidoMatAlumno,
                    ':carrera'=>$carrera,
                    ':boleta'=>$boleta,
                    ':telefonoM'=>$telefonoMovil,
                    ':telefonofijo'=>$telefonoFijo,
                    ':telefonop'=>$telefonoPersonal,
                    ':email'=>$emailAlumno,
                    ':nss'=> $NSS,
                    ':numcodqr'=>$numcodqr
                ]);
            
                return $user;
                
        }

        function editarAlumno($id,$nombreAlumno,$apellidoPatAlumno,$apellidoMatAlumno, $carrera, $boleta,$telefonoMovil,$telefonoFijo,$telefonoPersonal, $emailAlumno, $NSS){
            $db=new Connect;
            $user=$db->prepare("UPDATE  alumnos SET nombreAlumno=:nombre, apellidoPatAlumno=:apellidop, apellidoMatAlumno=:apellidom, carrera=:carrera, boleta=:boleta, telefonoMovil=:telefonoM, telefonoFijo=:telefonofijo, telefonoPersonal=:telefonop, emailAlumno=:email, NSS=:nss WHERE id=:id");
            $user->execute([
                ':id'=>$id,
                ':nombre'=>$nombreAlumno,
                ':apellidop' =>$apellidoPatAlumno,
                ':apellidom'=>$apellidoMatAlumno,
                ':carrera'=>$carrera,
                ':boleta'=>$boleta,
                ':telefonoM'=>$telefonoMovil,
                ':telefonofijo'=>$telefonoFijo,
                ':telefonop'=>$telefonoPersonal,
                ':email'=>$emailAlumno,
                ':nss'=> $NSS
            ]);
            return $user;
        }

        function deleteAlumno($id){
            $db = new Connect;
            $user= $db->prepare("DELETE  FROM  alumnos WHERE id=:id ");
            $user->execute([
                ':id'=>$id
            ]);
            //TODO: Como saber si se elimino correctamente el usuario. puedo hacer una busqueda de
            //lo que se borro si lo encentra mandar mensaje de no se pudo borrar por llave foranea.
            
            return $user;
        }

         //generar token
         
        function addSaes($nombre, $apellidop, $apellidom, $carrera, $boleta, $telefonom, $telefonof, $telefonop, $email, $nss){
            $db = new Connect;
            $numcodqr=$this->generarToken(10);
            $validarCod=$this->validarToken($numcodqr);
            if($validarCod==1){
                return $this->addSaes($nombre, $apellidop, $apellidom, $carrera, $boleta, $telefonom, $telefonof, $telefonop, $email, $nss);
            }else{
                //Buscamos el usuario si existe ya en la BD.
                $buscarUser=$db->prepare("SELECT * FROM alumnos WHERE boleta=:boleta");
                $buscarUser->execute([
                    ':boleta'=> $boleta
                ]);
                $userCount=$buscarUser->rowCount();
                if($userCount>0){
                    return 0;
                }else{
                    $user=$db->prepare("INSERT INTO alumnos(nombreAlumno, apellidoPatAlumno, apellidoMatAlumno, carrera, boleta, telefonoMovil, telefonoFijo, telefonoPersonal, emailAlumno, NSS, numcodqr) VALUES ( :nombre, :apellidop, :apellidom, :carrera, :boleta, :telefonoM, :telefonofijo, :telefonop, :email, :nss,:numcodqr)");
                    $user->execute([
                        ':nombre'=>$nombre,
                        ':apellidop' =>$apellidop,
                        ':apellidom'=>$apellidom,
                        ':carrera'=>$carrera,
                        ':boleta'=>$boleta,
                        ':telefonoM'=>$telefonom,
                        ':telefonofijo'=>$telefonof,
                        ':telefonop'=>$telefonop,
                        ':email'=>$email,
                        ':nss'=> $nss,
                        ':numcodqr'=>$numcodqr
                    ]);
                    return 1;
                }
                
                
            }
            
        }
        function buscarQrAlum($codigoQr, $idAdmin, $hora){
            $db=new Connect;
            $contqro=$db->prepare("SELECT * FROM alumnos WHERE numcodqr=:codigo" );
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
                    $retornar="||"."alu"."||".$userinfo['nombreAlumno']."||".$hora."||"."1"."||";
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
                    $res2="||"."alu"."||".$userinfo['nombreAlumno']."||".$hora."||"."2"."||";
                    return $res2;
                }
            }
            else{
                //Si no encontro el codigo qr
                return "||"."alu"."||"."No user"."||"."No hora"."||"."0"."||";
            }
        }
    }

?>