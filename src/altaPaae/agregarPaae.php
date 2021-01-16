<?php
    require_once '../clases/conexion.Class.php';
    require_once "../clases/paaeController.Class.php";

    $paae=new paae;
    $nombrePaae = ($_POST['nombrePaae']);
    $apellidoPatPaae = ($_POST['apellidoPatPaae']);
    $apellidoMatPaae = ($_POST['apellidoMatPaae']);
    $area = ($_POST['area']);
    $RFC = ($_POST['RFC']);
    $telefono = ($_POST['telefono']);
    $extension = ($_POST['extension']);
    $emailPaae = ($_POST['emailPaae']);
    $numcodqr=($_POST['numcodqr']);

     //Mandamos la consulta con todos los datos
    $algo=$paae->agregarPaae($nombrePaae,$apellidoPatPaae,$apellidoMatPaae,$area,$RFC,$telefono,$extension,$emailPaae,$numcodqr);
    echo json_encode($algo);

    
     ?>