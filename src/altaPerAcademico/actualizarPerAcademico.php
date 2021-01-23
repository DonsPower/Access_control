<?php
    require_once '../clases/conexion.Class.php';
    require_once "../clases/perAcademicoController.Class.php";

    $perAcademico=new perAcademico;
    $id=($_POST['id']);
    $nombrePerAcademico = ($_POST['nombrePerAcademico']);
    $apellidoPatPerAcademico = ($_POST['apellidoPatPerAcademico']);
    $apellidoMatPerAcademico = ($_POST['apellidoMatPerAcademico']);
    $academia = ($_POST['academia']);
    $RFC = ($_POST['RFC']);
    $telefono = ($_POST['telefono']);
    $extension = ($_POST['extension']);
    $emailPerAcademico = ($_POST['emailPerAcademico']);
  

    //Mandamos la consulta con todos los datos
    $algo=$perAcademico->editarPerAcademico($id,$nombrePerAcademico,$apellidoPatPerAcademico,$apellidoMatPerAcademico, $academia, $RFC,$telefono,$extension,$emailPerAcademico);
    echo json_encode($algo);
?>