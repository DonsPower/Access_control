<?php
    require_once '../clases/conexion.Class.php';
    require_once "../clases/visitorController.Class.php";
    $visitor=new visitor;
    //AGREGAR NUEVO ususario..
    $name=$_POST['name'];
    $apellidoP=$_POST['apellidoP'];
    $apellidoM=$_POST['apellidoM'];
    $razon=$_POST['razon'];
    $codigoQr=$_POST['codigoQr'];
    

    //Mandamos la consulta con todos los datos
    $algo=$visitor->agregarVis($name,$apellidoP,$apellidoM,$razon,$codigoQr);

    echo json_encode($algo);

?>