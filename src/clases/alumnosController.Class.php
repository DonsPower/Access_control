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

        function editarAlumno($id,$nombreAlumno,$apellidoPatAlumno,$apellidoMatAlumno, $carrera, $boleta,$telefonoMovil,$telefonoFijo,$telefonoPersonal, $emailAlumno, $NSS,$numcodqr){
            $db=new Connect;
            $user=$db->prepare("UPDATE  alumnos SET nombreAlumno=:nombre, apellidoPatAlumno:apellidop, apellidoMatAlumno=:apellidom, carrera=:carrera, boleta=:boleta, telefonoMovil=:telefonoM, telefonoFijo=:telefonofijo, telefonoPersonal=:telefonop, emailAlumno=:email, NSS=:nss,numcodqr=:numcodqr WHERE id=:id");
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
                ':nss'=> $NSS,
                ':numcodqr'=>$numcodqr

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

         
    }

?>