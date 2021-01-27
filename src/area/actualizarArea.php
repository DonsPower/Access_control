<?php
    require_once '../clases/conexion.Class.php';
    require_once "../clases/areaController.Class.php";
    require_once "../clases/validacionController.Class.php";
    $val=new validacion;
    $area=new area;
    $id=($_POST['id']);
    $nombreAlumno = ($_POST['nombreAlumno']);
    if($val->is_val($nombreAlumno)){
        echo json_encode(2);
    }else{
         //Mandamos la consulta con todos los datos
        $algo=$area->editarArea($id,$nombreAlumno);
        echo json_encode($algo);
        //echo json_encode($id);
    }
   
?>