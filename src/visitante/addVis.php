<?php
    require_once '../clases/conexion.Class.php';
    require_once "../clases/visitorController.Class.php";
    require_once "../clases/validacionController.Class.php";
    $val=new validacion;
    $visitor=new visitor;
    //AGREGAR NUEVO ususario..
    $name=$_POST['name'];
    $apellidoP=$_POST['apellidoP'];
    $apellidoM=$_POST['apellidoM'];
    $razon=$_POST['razon'];
    $codigoQr=$_POST['codigoQr'];
    //Validación
    if($val->is_val($name)){
        echo json_encode(2);
    }else if($val->is_val($apellidoP)){
        echo json_encode(3);
    }else if($val->is_val($apellidoM)){
        echo json_encode(4);
    }else{
        $razon=$val->preResSeg($razon);
        //Mandamos la consulta con todos los datos
        $algo=$visitor->agregarVis($name,$apellidoP,$apellidoM,$razon,$codigoQr);
        echo json_encode($algo);
    }

?>