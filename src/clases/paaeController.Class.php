<?php
    class paae{
        function getDataPaae(){
            $db=new Connect;
            $user=$db->prepare("SELECT * FROM paaes");
            $user->execute();
            $userinfo=$user->rowCount();
            return $userinfo;
        }
    function agregarPaae($nombrePaae,$apellidoPatPaae,$apellidoMatPaae,$area,$RFC,$telefono,$extension,$emailPaae,$numcodqr){
        $db=new Connect;
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
                ':numcodqr'=>$numcodqr
                ]);
          return $user;    
      }

      function editarPaae($id,$nombrePaae,$apellidoPatPaae,$apellidoMatPaae,$area, $RFC, $telefono,$extension,$emailPaae,$numcodqr){
        $db=new Connect;
        $user=$db->prepare("UPDATE  paaes SET nombrePaae=:nombre, apellidoPatPaae=:apellidop, apellidoMatPaae=:apellidom, area=:carrera, RFC=:boleta, telefono=:telefonoM, extension=:telefonofijo, emailPaae=:telefonop,numcodqr=:numcodqr WHERE id=:id");
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
            ':numcodqr'=>$numcodqr
        ]);
        return $user;
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
        return "paae-".$code;
    }
    }

 ?>