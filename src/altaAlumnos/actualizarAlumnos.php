<?php
    require_once '../clases/conexion.Class.php';
    require_once "../clases/alumnosController.Class.php";

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
    
    
    //Mandamos la consulta con todos los datos
    $algo=$alumno->editarAlumno($id,$nombreAlumno, $apellidoPatAlumno, $apellidoMatAlumno, $carrera, $boleta, $telefonoMovil, $telefonoFijo, $telefonoPersonal , $emailAlumno, $NSS);
    echo json_encode($algo);
    //echo json_encode($id);
?>