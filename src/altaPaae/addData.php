<?php
    require_once '../clases/conexion.Class.php';
    require_once '../clases/paaeController.Class.php';
    $paae= new paae;
    $id=$_POST['id'];
    $nombre=$id['nombrePaae'];
    $apellidop=$id['apellidoPatPaae'];
    $apellidom=$id['apellidoMatPaae'];
    $carrera=$id['area'];
    $boleta=$id['RFC'];
    $telefonom=$id['telefono'];
    $telefonof=$id['extension'];
    $email=$id['emailPaae'];

    //TODO: VERIFICAR QUE LA BOLETA NO EXISTA
    //contador agrerar a la salida.
    //$contador=0;
    $algo=$paae->addSaes2($nombre, $apellidop, $apellidom, $carrera, $boleta, $telefonom, $telefonof,  $email);
    //$contador+=$algo;
    //$algo= $visitor->deathVisitor($id);
    echo json_encode($algo);
?>