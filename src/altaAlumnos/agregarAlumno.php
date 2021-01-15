<?php
    require_once '../clases/conexion.Class.php';
    require_once "../clases/alumnosController.Class.php";

    $alumno=new alumno;
    $nombreAlumno = ($_POST['nombre']);
    $apellidoPatAlumno = ($_POST['apellidop']);
    $apellidoMatAlumno = ($_POST['apellidom']);
    $carrera = ($_POST['carrera']);
    $boleta = ($_POST['boleta']);
    $telefonoMovil = ($_POST['telefonomovil']);
    $telefonoFijo = ($_POST['telefonoFijo']);
    $telefonoPersonal = ($_POST['telefonoPersonal']);
    $NSS = ($_POST['nss']);
    $emailAlumno = ($_POST['email']);
    $numcodqr = ($_POST['numcodqr']);
    //Mandamos la consulta con todos los datos
    $algo=$alumno->agregarAlum($nombreAlumno,$apellidoPatAlumno,$apellidoMatAlumno, $carrera, $boleta,$telefonoMovil,$telefonoFijo,$telefonoPersonal, $emailAlumno, $NSS,$numcodqr);
    echo json_encode($algo);
    
?>