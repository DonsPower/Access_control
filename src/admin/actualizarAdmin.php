<?php

    require_once "../clases/conexion.Class.php";
    require_once "../clases/adminController.Class.php";
    $admin=new admin;
    //Actualizar los datos.
    $id=$_POST['id'];
    $name=$_POST['name'];
    $apellidoP=$_POST['apellidoP'];
    $apellidoM=$_POST['apellidoM'];
    $puesto=$_POST['puesto'];
    $areaAdministra=$_POST['areaAdministra'];
    $tipo=$_POST['tipo'];
    $email=$_POST['email'];
    $clave=$_POST['clave'];
    $preguntaS=$_POST['preguntaS'];
    $respuestaS=$_POST['respuestaS'];
    
    //$algo=$admin->actualizarAdmin($id,$name,$apellidoP,$apellidoM,$puesto,$areaAdministra,$tipo,$email,$clave,$preguntaS,$respuestaS);

    echo json_encode($areaAdministra." ".$tipo);



?>