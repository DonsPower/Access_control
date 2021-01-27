<?php
    require_once '../clases/conexion.Class.php';
    require_once "../clases/alumnosController.Class.php";
    require_once "../clases/validacionController.Class.php";
    $val=new validacion;
    $alumno=new alumno;
    $id=($_POST['id']);
    $nombreAlumno = ($_POST['nombreAlumno']);
    $apellidoPatAlumno = ($_POST['apellidoPatAlumno']);
    $apellidoMatAlumno = ($_POST['apellidoMatAlumno']);
    $carrera = ($_POST['carrera']);
    $boleta = ($_POST['boleta']);
    $telefonoMovil = ($_POST['telefonoMovil']);
    $telefonoFijo = ($_POST['telefonoFijo']);
    $telefonoPersonal = ($_POST['telefonoPersonal']);
    $emailAlumno = ($_POST['emailAlumno']);
    $NSS = ($_POST['NSS']);
    
    
    if($val->is_val($nombreAlumno)){
        echo json_encode(2);
    }else if($val->is_val($apellidoPatAlumno)){
        echo json_encode(3);
    }else if($val->is_val($apellidoMatAlumno)){
        echo json_encode(4);
    }else if($val->telefono($boleta)){
        echo json_encode(5);
    }else if($val->telefono($telefonoMovil)){
        echo json_encode(6);
    }else if($val->telefono($telefonoFijo)){
        echo json_encode(7);
    }else if($val->telefono($telefonoPersonal)){
        echo json_encode(8);
    }else if($val->solo_numeros($NSS)){
        echo json_encode(9);
    }else if(!$val->is_valid_email($emailAlumno)){
        echo json_encode(11);
    }else{
         //Mandamos la consulta con todos los datos
        $algo=$alumno->editarAlumno($id,$nombreAlumno, $apellidoPatAlumno, $apellidoMatAlumno, $carrera, $boleta, $telefonoMovil, $telefonoFijo, $telefonoPersonal , $emailAlumno, $NSS);
        echo json_encode($algo);
        //echo json_encode($id);
    }
   
?>