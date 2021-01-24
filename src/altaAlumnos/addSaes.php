<?php
    require_once '../clases/conexion.Class.php';
    require_once '../clases/alumnosController.Class.php';
    $alumno= new alumno;
    $id=$_POST['id'];
    $nombre=$id['nombreAlumno'];
    $apellidop=$id['apellidoPatAlumno'];
    $apellidom=$id['apellidoMatAlumno'];
    $carrera=$id['carrera'];
    $boleta=$id['boleta'];
    $telefonom=$id['telefonoMovil'];
    $telefonof=$id['telefonoFijo'];
    $telefonop=$id['telefonoPersonal'];
    $email=$id['emailAlumno'];
    $nss=$id['NSS'];
    //TODO: VERIFICAR QUE LA BOLETA NO EXISTA
    //contador agrerar a la salida.
    $contador=0;
    $algo=$alumno->addSaes($nombre, $apellidop, $apellidom, $carrera, $boleta, $telefonom, $telefonof, $telefonop, $email, $nss);
    $contador+=$algo;
    //$algo= $visitor->deathVisitor($id);
    echo json_encode($contador);
?>