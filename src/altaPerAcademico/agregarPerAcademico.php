<?php
    require_once '../clases/conexion.Class.php';
    require_once "../clases/perAcademicoController.Class.php";
    require_once "../clases/validacionController.Class.php";
    $val=new validacion;
    $perAcademico=new perAcademico;
 
    $nombrePerAcademico = ($_POST['nombrePerAcademico']);
    $apellidoPatPerAcademico = ($_POST['apellidoPatPerAcademico']);
    $apellidoMatPerAcademico = ($_POST['apellidoMatPerAcademico']);
    $academia = ($_POST['academia']);
    $RFC = ($_POST['RFC']);
    $telefono = ($_POST['telefono']);
    $extension = ($_POST['extension']);
    $emailPerAcademico = ($_POST['emailPerAcademico']);
    
    
    if($val->is_val($nombrePerAcademico)){
        echo json_encode(2);
    }else if($val->is_val($apellidoPatPerAcademico)){
        echo json_encode(3);
    }else if($val->is_val($apellidoMatPerAcademico)){
        echo json_encode(4);
    }else if($val->RFC($RFC)){
        echo json_encode(5);
    }else if($val->telefono($telefono)){
        echo json_encode(6);
    }else if($val->ext($extension)){
        echo json_encode(7);
    }else if(!$val->is_valid_email($emailPerAcademico)){
        echo json_encode(8);
    }else{
        $algo=$perAcademico->agregarPerAcademico($nombrePerAcademico,$apellidoPatPerAcademico,$apellidoMatPerAcademico, $academia, $RFC,$telefono,$extension,$emailPerAcademico);
        echo json_encode($algo);
    }
    //Mandamos la consulta con todos los datos
    
?>