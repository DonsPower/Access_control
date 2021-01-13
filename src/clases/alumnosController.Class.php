<?php
    class alumno{

        function getDataAlumno(){
            $db=new Connect;
            $user=$db->prepare("SELECT * FROM alumnos");
            $user->execute();
            $userinfo=$user->rowCount();
            return $userinfo;
        }
        function agregarAlum($nombreAlumno,$apellidoPatAlumno,$apellidoMatAlumno, $carrera, $boleta,$telefonoMovil,$telefonoFijo,$telefonoPersonal, $emailAlumno, $NSS){
            $db=new Connect;
            $user=$db->prepare("INSERT INTO alumnos(nombreAlumno, apellidoPatAlumno, apellidoMatAlumno, carrera, boleta, telefonoMovil, telefonoFijo, telefonoPersonal, emailAlumno, NSS) VALUES ( :nombre, :apellidop, :apellidom, :carrera, :boleta, :telefonoM, :telefonofijo, :telefonop, :email, :nss)");
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
                ':nss'=> $NSS
            ]);
            return $user;
        }

    }

?>