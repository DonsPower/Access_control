<?php
    require_once "../../clases/conexion.Class.php";
    require_once "../../clases/visitorController.Class.php";
    require_once "../../clases/alumnosController.Class.php";
    require_once "../../clases/paaeController.Class.php";
    require_once "../../clases/perAcademicoController.Class.php";
    //Si se agrega una clase nueva para el registro del token importar la clase y tambien crear objeto
    $visitor=new visitor;
    $alumno=new alumno;
    $paae=new paae;
    $perAcademico=new perAcademico;
    $codigoQr=$_POST['id'];
    $idAdmin=$_POST['id2'];
    $segundos=$_POST['segundos'];
    $minutos=$_POST['minutos'];
    $hora=$_POST['horas'];
    $dia=$_POST['dia'];
    $mes=$_POST['mes'];
    $anio=$_POST['anio'];
    // $hora=$_POST['hora'];
    $fecha=$anio."-".$mes."-".$dia." ".$hora.":".$minutos.":".$segundos;
    if($codigoQr[3]!="-"){
        echo json_encode(10);
    }else{
        //Me separa el codigo para saber el tipo de usuario que va a ingresar.
        $tipoUser=explode("-", $codigoQr); 
        
        if($tipoUser[0]=="vis"){
            $res=$visitor->buscarQrVis($codigoQr, $idAdmin, $fecha);
            echo json_encode($res);
        }else if($tipoUser[0]=="alu"){
            //Aqui va la funcion alumno.
            $res=$alumno->buscarQrAlum($codigoQr, $idAdmin, $fecha);
            echo json_encode($res);
        }else if($tipoUser[0]=="pae"){ 
            //Aquí va la funcion paae 
            $res=$paae->buscarQrpaae($codigoQr, $idAdmin, $fecha);
            echo json_encode($res);
        }else if($tipoUser[0]=="pro"){
        //Aqui va la funcion profesores. si falta una mas por favor contacte con los programadores XDDD jaja 
            $res=$perAcademico->buscarQrProf($codigoQr, $idAdmin, $fecha);
            echo json_encode($res);
        }
    }
    
    //TODO:  ¿Solicitaste la cámara frontal aunque no hay ninguna? */
?>
