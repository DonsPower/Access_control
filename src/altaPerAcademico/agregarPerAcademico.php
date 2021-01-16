<?php
    require_once '../clases/conexion.Class.php';
    require_once "../clases/perAcademicoController.Class.php";

    $perAcademico=new perAcademico;
 
    $nombrePerAcademico = ($_POST['nombrePerAcademico']);
    $apellidoPatPerAcademico = ($_POST['apellidoPatPerAcademico']);
    $apellidoMatPerAcademico = ($_POST['apellidoMatPerAcademico']);
    $academia = ($_POST['academia']);
    $RFC = ($_POST['RFC']);
    $telefono = ($_POST['telefono']);
    $extension = ($_POST['extension']);
    $emailPerAcademico = ($_POST['emailPerAcademico']);
    $numcodqr = ($_POST['numcodqr']);

    //Mandamos la consulta con todos los datos
    $algo=$perAcademico->agregarPerAcademico($nombrePerAcademico,$apellidoPatPerAcademico,$apellidoMatPerAcademico, $academia, $RFC,$telefono,$extension,$emailPerAcademico,$numcodqr);
    echo json_encode($algo);
?>