<?php
 require_once '../clases/conexion.Class.php';
 require_once '../clases/authController.Class.php';
 require_once "../clases/areaController.Class.php";
 require_once "../clases/validacionController.Class.php";
 $val=new validacion;
 $admin=new area;
 //AGREGAR NUEVO ususario..
 $name=$_POST['ids'];
     if($val->is_val($name)){
         echo json_encode(2);
     }
     else{
         //Mandamos la consulta con todos los datos
         $algo=$admin->almacenarArea($name);
         echo json_encode($algo);
     }




?>