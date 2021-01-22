<?php
    require_once '../clases/conexion.Class.php';
    require_once '../clases/perAcademicoController.Class.php';
    $per= new perAcademico;
    $id=$_POST['id'];
    $nombre=$id['nombrePerAcademico'];
    $apellidop=$id['apellidoPatPerAcademico'];
    $apellidom=$id['apellidoMatPerAcademico'];
    $carrera=$id['academia'];
    $boleta=$id['RFC'];
    $telefonom=$id['telefono'];
    $telefonof=$id['extension'];
    $email=$id['emailPerAcademico'];

    //TODO: VERIFICAR QUE LA BOLETA NO EXISTA
    //contador agrerar a la salida.
    //$contador=0;
    $algo=$per->addSaes3($nombre, $apellidop, $apellidom, $carrera, $boleta, $telefonom, $telefonof,  $email);
    //$contador+=$algo;
    //$algo= $visitor->deathVisitor($id);
    echo json_encode($algo);
?>